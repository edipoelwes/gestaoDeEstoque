<?php

namespace App\Http\Controllers;

use App\{Company, User};
use App\Http\Requests\User as UserRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\{Auth, Storage};
use Spatie\Permission\Models\Role;
use Spatie\Permission\Exceptions\UnauthorizedException;

class UserController extends Controller
{
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
      if(!Auth::user()->hasPermissionTo('Visualizar Usuarios')) {
         throw new UnauthorizedException('403', 'You do not have the required authorization!');
      }

      $users = User::where('company_id', Auth::User()->company_id)->get();
      return view('admin.users.index', [
         'users' => $users,
      ]);
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create()
   {
      if(!Auth::user()->hasPermissionTo('Cadastrar Usuario')) {
         throw new UnauthorizedException('403', 'You do not have the required authorization!');
      }

      return view('admin.users.form', [
         'companies' => Company::all(['id', 'social_name']),
      ]);
   }

   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(UserRequest $request)
   {
      if(!Auth::user()->hasPermissionTo('Cadastrar Usuario')) {
         throw new UnauthorizedException('403', 'You do not have the required authorization!');
      }

      $user = $request->all();
      $user['company_id'] = Auth::user()->company_id;
      $userCreate = User::create($user);

      // if (!empty($request->file('cover'))) {
      //    $userCreate->cover = $request->file('cover')->store('user');
      //    $userCreate->save();
      // }

      return redirect()->route('users.edit', [
         'user' => $userCreate->id,
      ])->withToastSuccess('Usuario cadastrado com sucesso!');
   }

   /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function show(User $user)
   {
      //
   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function edit(User $user)
   {
      if(!Auth::user()->hasPermissionTo('Editar Usuario')) {
         return back()->withToastWarning('Usuario não tem permissão para editar um usuario!');
      }

      return view('admin.users.form', [
         'user' => $user,
         'companies' => Company::all(['id', 'social_name']),
      ]);
   }

   /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function update(UserRequest $request, User $user)
   {
      if(!Auth::user()->hasPermissionTo('Editar Usuario')) {
         return back()->withToastWarning('Usuario não tem permissão para editar um usuario!');
      }

      $user->update($request->all());

      // if (!empty($request->file('cover'))) {
      //    Storage::delete($user->cover);
      //    $user->cover = '';
      // }

      // $user->fill($request->all());

      // if (!empty($request->file('cover'))) {
      //    $user->cover = $request->file('cover')->store('user');
      // }

      // if (!$user->save()) {
      //    return redirect()->back()->withInput()->withErros();
      // }

      return redirect()->route('users.edit', [
         'user' => $user->id,
      ])->withToastSuccess('Usuario atualizado com sucesso!');
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function destroy(User $user)
   {
      if(!Auth::user()->hasPermissionTo('Deletar Usuario')) {
         return back()->withToastWarning('Usuario não tem permissão para remover um usuario!');
      }

      $user->delete();
      return back()->withToastSuccess('Usuario removido com sucesso!');
   }

   public function company()
   {
      if(!Auth::user()->hasPermissionTo('Visualizar Empresas')) {
         throw new UnauthorizedException('403', 'You do not have the required authorization!');
      }

      return view('admin.users.company', [
         'company' => Company::where('id', Auth::user()->company_id)->first(),
      ]);
   }

   public function team()
   {
      if(!Auth::user()->hasPermissionTo('Visualizar Time')) {
         throw new UnauthorizedException('403', 'You do not have the required authorization!');
      }
      $users = User::where([['company_id', Auth::User()->company_id], ['admin', 1]])->get();
      return view('admin.users.team', [
         'users' => $users,
      ]);
   }

   public function roles ($user)
   {
      $user = User::where('id', $user)->first();
      $roles = Role::all();

      foreach($roles as $role) {
         if($user->hasRole($role->name)) {
            $role->can = true;
         } else {
            $role->can = false;
         }
      }
      return view('admin.users.roles', [
         'user' => $user,
         'roles' => $roles,
      ]);
   }

   public function rolesSync (Request $request, $user)
   {
      $rolesRequest = $request->except(['_token', '_method']);

      foreach($rolesRequest as $key => $value) {
         $roles[] = Role::where('id', $key)->first();
      }

      $user = User::where('id', $user)->first();

      if(!empty($roles)) {
         $user->syncRoles($roles);
      } else {
         $user->syncRoles(null);
      }
      return redirect()->route('users.roles', [
         'user' => $user->id,
      ])->withToastSuccess('Perfil sincronizado com sucesso!');
   }
}
