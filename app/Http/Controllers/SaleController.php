<?php

namespace App\Http\Controllers;

use App\{Client, Inventory, Sale, SaleProduct, User};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {

      // dd(Inventory::all(['id', 'name']));


      return view('admin.sales.index', [
         'sales' => Sale::all(),
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



      if($salesCreate = Sale::create($sales)){
         $array = array();
         $total = 0;
         foreach($itens as $id => $item){
            $product_iten = array();
            $amount = $item;
            $product = DB::table('inventories')
            ->select('price')
            ->where('id', $id)
            ->first();

            $subTotal = $amount * $product->price;

            $product_iten['sale_id'] = $salesCreate->id;
            $product_iten['company_id'] = $user->company_id;
            $product_iten['inventory_id'] = $amount;
            $product_iten['sale_price'] = $subTotal;

            array_push($array, $product_iten);

            $total += $subTotal;

            // $saleTotal = Sale::find($salesCreate->id);
            // $saleTotal['total_price'] = $total;
            // $saleTotal->update();
         }

         $save = new SaleProduct;
         $save->attach($array);


         // dd($array);
      };


      return redirect()->route('sales.edit', [
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
      //
   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function edit($id)
   {
      //
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
}
