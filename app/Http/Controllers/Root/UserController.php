<?php

namespace App\Http\Controllers\Root;

use App\Http\Controllers\Controller;
use App\{Company, User};
use Illuminate\Http\Request;

class UserController extends Controller
{
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
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
      $user->delete();
      return back()->withToastSuccess('Usuario removido com sucesso!');
   }
}
