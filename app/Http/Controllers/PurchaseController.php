<?php

namespace App\Http\Controllers;

use App\{Inventory, PaymentMethod, Purchase, PurchaseProduct, Status};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
      return view('admin.purchases.index', [
         'purchases' => Purchase::where('company_id', Auth::user()->company_id)->get(),
      ]);
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create()
   {
      return view('admin.purchases.form', [
         'status' => Status::all(),
         'payments' => PaymentMethod::all(),
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
      $data = $request->all();
      $company = Auth::user()->company_id;
      $purchase['company_id'] = $company;
      $purchase['user_id'] = Auth::user()->id;
      $purchase['status'] = $data['status'];
      $purchase['payment_method'] = $data['payment_method'];
      $purchase['obs'] = $data['obs'];
      $purchase['provider'] = $data['provider'];

      $amount = $data['amount'];
      $price = $data['price'];

      if ($purchaseCreate = Purchase::create($purchase)) {
         foreach($amount as $id => $value){
            $purch_prod['company_id'] = $company;
            $purch_prod['purchase_id'] = $purchaseCreate->id;
            $purch_prod['inventory_id'] = $id;
            $purch_prod['amount'] = $value;

            PurchaseProduct::create($purch_prod);

            $this->upInventory($id, $company, $value);

         }

      }

      foreach($price as $id => $value){
         $item = PurchaseProduct::where([['purchase_id', $purchaseCreate->id], ['inventory_id', $id], ['company_id', Auth::user()->company_id]])->first();
         $item['sub_total'] = $item->amount * $value;

         $item->save();
      }

      $total = PurchaseProduct::where('purchase_id', $purchaseCreate->id)->sum('sub_total');
      $product = Purchase::find($purchaseCreate->id);
      $product->total = $total;
      $product->save();

      return redirect()->route('purchases.index', [
         'purchase' => $purchaseCreate->id,
      ])->withToastSuccess('Compra cadastrada com sucesso!');

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

   private function upInventory($id, $company_id, $amount)
   {
      $product_inventory = DB::table('inventories')
         ->select('amount')
         ->where([['id', $id], ['company_id', $company_id]])
         ->first();


      $total = $product_inventory->amount + $amount;

      $inventory = Inventory::find($id);
      $inventory->amount = $total;

      $inventory->save();
   }
}
