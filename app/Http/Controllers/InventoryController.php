<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Inventory as InventoryRequest;
use App\{Inventory, InventoryHistory};
use Illuminate\Support\Facades\{Auth, DB};

class InventoryController extends Controller
{
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
      return view('admin.products.index', [
         'products' => Inventory::all(),
      ]);
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create()
   {
      return view('admin.products.form');
   }

   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(InventoryRequest $request)
   {
      $user = Auth::user();

      $product = $request->all();
      $product['company_id'] = $user->company_id;


      if ($createProduct = Inventory::create($product)) {

         $action = 'inserted';

         $this->inventary_history($user, $createProduct, $action);
      }

      return redirect()->route('inventories.edit', [
         'inventory' => $createProduct->id,
      ])->with(['color' => 'green', 'message' => 'Produto cadastrado com sucesso!']);
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
      $product = Inventory::where('id', $id)->first();
      return view('admin.products.form', [
         'product' => $product,
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
      $productUpdate = Inventory::where('id', $id)->first();

      if ($productUpdate->update($request->all())) {
         $user = Auth::user();

         $action = 'updated';

         $this->inventary_history($user, $productUpdate, $action);
      }

      return redirect()->route('inventories.edit', [
         'inventory' => $productUpdate->id,
      ])->with(['color' => 'green', 'message' => 'Produto atualizado com sucesso!']);
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


   private function inventary_history($user, $product, $action)
   {

      $data = array(
         'company_id' => $user->company_id,
         'inventory_id' => $product->id,
         'user_id' => $user->id,
         'action' => $action
      );

      InventoryHistory::create($data);
   }

}
