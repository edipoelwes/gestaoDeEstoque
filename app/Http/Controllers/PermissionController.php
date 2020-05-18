<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
      $permissions = Permission::all();

      return view('admin.permissions.index', [
         'permissions' => $permissions,
      ]);
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create()
   {
      return view('admin.permissions.form');
   }

   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(Request $request)
   {
      $permissionCreate = Permission::create($request->all());

      return redirect()->route('permissions.edit', [
         'permission' => $permissionCreate->id,
      ])->withToastSuccess('Permissão Cadastrada com Sucesso!');
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
      $permission = Permission::where('id', $id)->first();

      return view('admin.permissions.form', [
         'permission' => $permission
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
      $permissionCreate = Permission::where('id', $id)->first();
      $permissionCreate->update($request->all());

      return redirect()->route('permissions.index', [
         'permission' => $permissionCreate->id,
      ])->withToastSuccess('Permissão Cadastrada com Sucesso!');
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function destroy($id)
   {
      $permissionDelete = Permission::where('id', $id)->first();
      $permissionDelete->delete();

      return back()->withToastSuccess('Permissão excluído com sucesso!');
   }
}
