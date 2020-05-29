<?php

namespace App\Http\Controllers;

use App\{Client, Inventory, Sale, SaleProduct, User};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, DB};
use Spatie\Permission\Exceptions\UnauthorizedException;

class SaleController extends Controller
{
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
      if(!Auth::user()->hasPermissionTo('Visualizar Vendas')) {
         throw new UnauthorizedException('403', 'You do not have the required authorization!');
      }

      return view('admin.sales.index', [
         'sales' => Sale::where('company_id', Auth::user()->company_id)->get(),
      ]);
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create()
   {
      if(!Auth::user()->hasPermissionTo('Cadastrar Venda')) {
         throw new UnauthorizedException('403', 'You do not have the required authorization!');
      }

      return view('admin.sales.form', [
         'clients' => Client::all(['id', 'name', 'document']),
      ]);
   }

   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(Request $request)
   {
      if(!Auth::user()->hasPermissionTo('Cadastrar Venda')) {
         throw new UnauthorizedException('403', 'You do not have the required authorization!');
      }

      $user = Auth::user();
      $sales = $request->all();

      $discount = str_replace(',', '.', $sales['discount']);

      $sales['user_id'] = $user->id;
      $sales['company_id'] = $user->company_id;
      $sales['discount'] = $discount;

      $itens = $sales['amount'];

      if ($salesCreate = Sale::create($sales)) {

         foreach ($itens as $id => $item) {
            $product_item = [];
            $amount = intval($item);
            $product = DB::table('inventories')
               ->select('price')
               ->where('id', $id)
               ->first();

            $subTotal = $amount * $product->price;

            $product_item['sale_id'] = $salesCreate->id;
            $product_item['company_id'] = $user->company_id;
            $product_item['inventory_id'] = $id;
            $product_item['amount'] = $amount;
            $product_item['price'] = $product->price;
            $product_item['sub_total'] = $subTotal;

            SaleProduct::create($product_item);

            $this->downInventory($id, $user->company_id, $amount);
         }
      }

      $this->updateTotalPrice($salesCreate->id, $discount);

      return redirect()->route('sales.index', [
         'sale' => $salesCreate->id,
      ])->withToastSuccess('Pedido cadastrado com sucesso!');
   }

   /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function show($id)
   {
      $user = Auth::user();
      $detail = Sale::where([['id', $id], ['company_id', $user->company_id]])->first();
      $products = SaleProduct::where([['sale_id', $id], ['company_id', $user->company_id]])->get();

      return view('admin.sales.details', [
         'detail' => $detail,
         'products' => $products,
      ]);
   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function edit($id)
   {
      if(!Auth::user()->hasPermissionTo('Editar Venda')) {
         throw new UnauthorizedException('403', 'You do not have the required authorization!');
      }

      $sale = Sale::where('id', $id)->first();

      return view('admin.sales.form', [
         'sale' => $sale,
         'clients' => Client::all('id', 'name'),
      ]);
   }

   /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function update(Request $request, $id)
   {
      //
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

   public function changeStatus(Request $request, $id)
   {
      $st = $request->only('status');
      $status = Sale::find($id);
      $status->status = $st['status'];
      $status->save();

      if ($status->status == 2) {

         $products = DB::table('sale_products')
            ->select('amount', 'inventory_id', 'company_id')
            ->where([['sale_id', $id], ['company_id', $status->company_id]])
            ->get();

         foreach ($products as $product) {

            $inventory = Inventory::find($product->inventory_id);

            $inventory->amount += $product->amount;
            $inventory->save();
         }
      }

      return redirect()->route('sales.show', [
         'sale' => $id,
      ])->withToastSuccess('Status atualizado com sucesso!');
   }

   public function destroy($id)
   {
      //
   }


   public function search_products(Request $request)
   {

      $data = array();
      $user = Auth::user();
      $product = new Inventory();
      $item = $request->all();

      $data = $product->searchProductByName($item, $user->company_id);

      return json_encode($data);
   }

   private function updateTotalPrice($id, $discount)
   {
      $sale_price = SaleProduct::where('sale_id', $id)->sum('sub_total');
      $saleTotal = Sale::find($id);
      $saleTotal->total_price = $sale_price - (floatval($discount));

      $saleTotal->save();
   }

   private function downInventory($id, $company_id, $amount)
   {
      $product_inventory = DB::table('inventories')
         ->select('amount')
         ->where([['id', $id], ['company_id', $company_id]])
         ->first();


      $total = $product_inventory->amount - $amount;

      $inventory = Inventory::find($id);
      $inventory->amount = $total;

      $inventory->save();
   }
}
