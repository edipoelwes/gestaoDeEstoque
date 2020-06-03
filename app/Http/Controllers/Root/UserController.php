<?php

namespace App\Http\Controllers\Root;

use App\Http\Controllers\Controller;
use App\{Company, User};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
      if(!Auth::user()->hasPermissionTo('Super Usuario')) {
         throw new UnauthorizedException('403', 'You do not have the required authorization!');
      }

      $users = User::all();

      return view('root.users.index', [
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
      if(!Auth::user()->hasPermissionTo('Super Usuario')) {
         throw new UnauthorizedException('403', 'You do not have the required authorization!');
      }


      return view('root.users.form', [
         'companies' => Company::all(['id', 'social_name']),
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
      if(!Auth::user()->hasPermissionTo('Super Usuario')) {
         throw new UnauthorizedException('403', 'You do not have the required authorization!');
      }

      $user = User::create($request->all());

      return redirect()->route('root.users.edit', [
         'user' => $user->id,
      ])->withToastSuccess('Usuario cadastrado com sucesso!');
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
   public function edit(User $user)
   {
      if(!Auth::user()->hasPermissionTo('Super Usuario')) {
         return back()->withToastWarning('Permissão negada!');
      }

      return view('root.users.form', [
         'user' => $user,
         'companies' => Company::all(),
      ]);
   }

   /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function update(Request $request, User $user)
   {
      if(!Auth::user()->hasPermissionTo('Super Usuario')) {
         return back()->withToastWarning('Permissão negada!');
      }

      $user->update($request->all());

      return redirect()->route('root.users.edit', [
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
      if(!Auth::user()->hasPermissionTo('Super Usuario')) {
         return back()->withToastWarning('Permissão negada!');
      }

      $user->delete();
      return back()->withToastSuccess('Usuario removido com sucesso!');
   }
}
