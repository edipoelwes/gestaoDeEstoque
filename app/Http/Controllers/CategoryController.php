<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Exceptions\UnauthorizedException;

class CategoryController extends Controller
{
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
      if(!Auth::user()->hasPermissionTo('Visualizar Categorias')) {
         throw new UnauthorizedException('403', 'You do not have the required authorization!');
      }

      $categories = Category::where('company_id', Auth::user()->company_id)->get();

      return view('admin.categories.index', [
         'categories' => $categories,
      ]);
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create()
   {
      if(!Auth::user()->hasPermissionTo('Cadastrar Categoria')) {
         throw new UnauthorizedException('403', 'You do not have the required authorization!');
      }

      return view('admin.categories.form');
   }

   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(Request $request)
   {
      if(!Auth::user()->hasPermissionTo('Cadastrar Categoria')) {
         throw new UnauthorizedException('403', 'You do not have the required authorization!');
      }

      $request['company_id'] = Auth::user()->company_id;

      $category = Category::create($request->all());

      return redirect()->route('categories.edit', [
         'category' => $category->id,
      ])->withToastSuccess('Categoria cadastrado com sucesso!');
   }

   /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function show(Category $category)
   {
      //
   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function edit(Category $category)
   {
      if(!Auth::user()->hasPermissionTo('Editar Categoria')) {
         return back()->withToastWarning('Usuario não tem permissão para editar a categoria!');
      }

      return view('admin.categories.form', [
         'category' => $category,
      ]);
   }

   /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function update(Request $request, Category $category)
   {
      if(!Auth::user()->hasPermissionTo('Editar Categoria')) {
         return back()->withToastWarning('Usuario não tem permissão para editar uma categoria!');
      }

      $category->update($request->all());

      return redirect()->route('categories.edit', [
         'category' => $category->id,
      ])->withToastSuccess('Categoria atualizada com sucesso!');
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function destroy(Category $category)
   {
      if(!Auth::user()->hasPermissionTo('Deletar Categoria')) {
         return back()->withToastWarning('Usuario não tem permissão para deletar uma categoria!');
      }

      $category->delete();
      return back()->withToastSuccess('Categoria removida com sucesso!');
   }
}
