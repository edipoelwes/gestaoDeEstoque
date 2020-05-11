<?php

namespace App\Http\Controllers;

use App\{Client, Inventory, Sale, SaleProduct, User};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, DB};

class SaleController extends Controller
{
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
      $user = Auth::user();

      return view('admin.sales.index', [
         'sales' => Sale::where('company_id', $user->company_id)->get(),
      ]);
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create()
   {
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
      $user = Auth::user();
      $sales = $request->all();

      $sales['user_id'] = $user->id;
      $sales['company_id'] = $user->company_id;

      $itens = $sales['amount'];

      if ($salesCreate = Sale::create($sales)) {

         foreach ($itens as $id => $item) {
            $product_item = array();
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

      $this->updateTotalPrice($salesCreate->id);

      return redirect()->route('sales.index', [
         'sale' => $salesCreate->id,
      ])->with(['color' => 'green', 'message' => 'Pedido cadastrado com sucesso!']);
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
      $details = Sale::where([['id', $id], ['company_id', $user->company_id]])->first();
      $products = SaleProduct::where([['sale_id', $id], ['company_id', $user->company_id]])->get();

      return view('admin.sales.details', [
         'details' => $details,
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

      echo json_encode($data);
   }

   private function updateTotalPrice($id)
   {
      $sale_price = SaleProduct::where('sale_id', $id)->sum('sub_total');
      $saleTotal = Sale::find($id);
      $saleTotal->total_price = $sale_price;

      $saleTotal->save();
   }

   private function downInventory($id, $company_id, $amount)
   {
      $product_inventory = DB::table('inventories')
      ->select('amount')
      ->where([['id', $id], ['company_id', $company_id]])
      ->first();

      if($product_inventory->amount > 0 && $product_inventory->amount >= $amount) {
         $total = $product_inventory->amount - $amount;

         $inventory = Inventory::find($id);
         $inventory->amount = $total;

         $inventory->save();

      }

   }
}
