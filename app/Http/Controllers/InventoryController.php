<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Inventory as InventoryRequest;
use App\{Category, Inventory, InventoryHistory, SaleProduct};
use Illuminate\Support\Facades\{Auth, DB};
use Spatie\Permission\Exceptions\UnauthorizedException;


class InventoryController extends Controller
{
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
      if (!Auth::user()->hasPermissionTo('Visualizar Produtos')) {
         throw new UnauthorizedException('403', 'You do not have the required authorization!');
      }

      return view('admin.products.diapers.index', [
         'products' => Inventory::where([
            ['company_id', Auth::user()->company_id],
            ['category_id', 1]])->get(),
      ]);
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create()
   {
      if (!Auth::user()->hasPermissionTo('Cadastrar Produto')) {
         throw new UnauthorizedException('403', 'You do not have the required authorization!');
      }

      $categories = Category::where('company_id', Auth::user()->company_id)->get();

      return view('admin.products.form', [
         'categories' => $categories,
      ]);
   }

   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(InventoryRequest $request)
   {
      if (!Auth::user()->hasPermissionTo('Cadastrar Produto')) {
         throw new UnauthorizedException('403', 'You do not have the required authorization!');
      }

      $user = Auth::user();

      $product = $request->all();
      $product['company_id'] = $user->company_id;

      if ($createProduct = Inventory::create($product)) {

         $action = 'inserted';

         $this->inventary_history($user, $createProduct, $action);
      }

      return redirect()->route('inventories.edit', [
         'inventory' => $createProduct->id,
      ])->withToastSuccess('Producto Cadastro com Sucesso!');
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
      if (!Auth::user()->hasPermissionTo('Editar Produto')) {
         return back()->withToastWarning('Usuario não tem permissão para editar um Produto!');
      }

      $product = Inventory::where('id', $id)->first();
      $categories = Category::where('company_id', Auth::user()->company_id)->get();

      return view('admin.products.form', [
         'product' => $product,
         'categories' => $categories,
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
      if (!Auth::user()->hasPermissionTo('Editar Produto')) {
         return back()->withToastWarning('Usuario não tem permissão para editar um Produto!');
      }
      $productUpdate = Inventory::where('id', $id)->first();

      if ($productUpdate->update($request->all())) {
         $user = Auth::user();

         $action = 'updated';

         $this->inventary_history($user, $productUpdate, $action);
      }

      return redirect()->route('inventories.edit', [
         'inventory' => $productUpdate->id,
      ])->withToastSuccess('Producto Atualizado com Sucesso!');
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function destroy($id)
   {
      if (!Auth::user()->hasPermissionTo('Deletar Produto')) {
         return back()->withToastWarning('Usuario não tem permissão para deletar um Produto!');
      }

      $product = Inventory::find($id);

      if (SaleProduct::where('inventory_id', $id)->count() > 0) {
         return back()->withToastWarning('Produto não pode ser excluído!');
      }
      $product->delete();

      return back()->withToastSuccess('Produto excluído com sucesso!');
   }


   public function clothes()
   {
      if (!Auth::user()->hasPermissionTo('Visualizar Produtos')) {
         throw new UnauthorizedException('403', 'You do not have the required authorization!');
      }

      return view('admin.products.clothes.index', [
         'products' => Inventory::where([
            ['company_id', Auth::user()->company_id],
            ['category_id', 3]])->get(),
      ]);
   }

   public function changingDiapers()
   {
      if (!Auth::user()->hasPermissionTo('Visualizar Produtos')) {
         throw new UnauthorizedException('403', 'You do not have the required authorization!');
      }

      return view('admin.products.changingDiapers.index', [
         'products' => Inventory::where([
            ['company_id', Auth::user()->company_id],
            ['category_id', 2]])->get(),
      ]);
   }

   public function footwear()
   {
      if (!Auth::user()->hasPermissionTo('Visualizar Produtos')) {
         throw new UnauthorizedException('403', 'You do not have the required authorization!');
      }

      return view('admin.products.footwear.index', [
         'products' => Inventory::where([
            ['company_id', Auth::user()->company_id],
            ['category_id', 4]])->get(),
      ]);
   }

   public function babyLayette()
   {
      if (!Auth::user()->hasPermissionTo('Visualizar Produtos')) {
         throw new UnauthorizedException('403', 'You do not have the required authorization!');
      }

      return view('admin.products.babyLayette.index', [
         'products' => Inventory::where([
            ['company_id', Auth::user()->company_id],
            ['category_id', 6]])->get(),
      ]);
   }

   public function hygiene()
   {
      if (!Auth::user()->hasPermissionTo('Visualizar Produtos')) {
         throw new UnauthorizedException('403', 'You do not have the required authorization!');
      }

      return view('admin.products.hygiene.index', [
         'products' => Inventory::where([
            ['company_id', Auth::user()->company_id],
            ['category_id', 5]])->get(),
      ]);
   }

   public function accessories()
   {
      if (!Auth::user()->hasPermissionTo('Visualizar Produtos')) {
         throw new UnauthorizedException('403', 'You do not have the required authorization!');
      }

      return view('admin.products.accessories.index', [
         'products' => Inventory::where([
            ['company_id', Auth::user()->company_id],
            ['category_id', 7]])->get(),
      ]);
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
