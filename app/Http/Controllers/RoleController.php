<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\{Role, Permission};

class RoleController extends Controller
{
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
      $roles = Role::all();

      return view('admin.roles.index', [
         'roles' => $roles,
      ]);
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create()
   {
      return view('admin.roles.form');
   }

   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(Request $request)
   {
      $role = Role::where('name', $request->name)->get();
      if($role->count() > 0) {
         return back()->withToastWarning('Perfil ja existe!');
      }

      $roleCreate = Role::create($request->all());

      return redirect()->route('roles.edit', [
         'role' => $roleCreate->id,
      ])->withToastSuccess('Perfil Cadastrado com Sucesso!');
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
      $role = Role::where('id', $id)->first();
      return view('admin.roles.form', [
         'role' => $role
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
      $role = Role::where([['name', $request->name], ['id', '!=', $id]])->get();
      if($role->count() > 0) {
         return back()->withToastWarning('Perfil ja existe!');
      }

      $roleCreate = Role::where('id', $id)->first();
      $roleCreate->update($request->all());

      return redirect()->route('roles.index', [
         'role' => $roleCreate->id,
      ])->withToastSuccess('Perfil Cadastrado com Sucesso!');

   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function destroy($id)
   {
      $roleDelete = Role::where('id', $id)->first();
      $roleDelete->delete();

      return back()->withToastSuccess('Perfil excluído com sucesso!');
   }

   public function permissions ($role)
   {
      $role = Role::where('id', $role)->first();
      $permissions = Permission::all();

      foreach($permissions as $permission) {
         if($role->hasPermissionTo($permission->name)) {
            $permission->can = true;
         } else {
            $permission->can = false;
         }
      }
      return view('admin.roles.permissions', [
         'role' => $role,
         'permissions' => $permissions,
      ]);
   }

   public function permissionsSync (Request $request, $role)
   {
      $permissionsRequest = $request->except(['_token', '_method']);

      foreach($permissionsRequest as $key => $value) {
         $permissions[] = Permission::where('id', $key)->first();
      }

      $role = Role::where('id', $role)->first();

      if(!empty($permissions)) {
         $role->syncPermissions($permissions);
      } else {
         $role->syncPermissions(null);
      }
      return redirect()->route('roles.permission', [
         'role' => $role->id,
      ])->withToastSuccess('Permissões sincronizada com sucesso!');
   }
}
