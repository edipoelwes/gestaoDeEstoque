<?php

namespace App\Http\Controllers;

use App\{Company, User};
use App\Http\Requests\User as UserRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

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
      return view('admin.users.index', [
         'users' => $users,
      ]);
   }

   public function team()
   {
      $users = User::where('admin', 1)->get();
      return view('admin.users.team', [
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

      return view('admin.users.create', [
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

      $userCreate = User::create($request->all());

      if (!empty($request->file('cover'))) {
         $userCreate->cover = $request->file('cover')->store('user');
         $userCreate->save();
      }

      return redirect()->route('users.edit', [
         'user' => $userCreate->id,
      ])->with(['color' => 'green', 'message' => 'Usuario cadastrado com sucesso!']);
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
      $user = User::where('id', $id)->first();

      return view('admin.users.edit', [
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
   public function update(UserRequest $request, $id)
   {
      $user = User::where('id', $id)->first();

      if (!empty($request->file('cover'))) {
         Storage::delete($user->cover);
         $user->cover = '';
      }

      $user->fill($request->all());

      if (!empty($request->file('cover'))) {
         $user->cover = $request->file('cover')->store('user');
      }

      if (!$user->save()) {
         return redirect()->back()->withInput()->withErros();
      }

      return redirect()->route('users.edit', [
         'user' => $user->id,
      ])->with(['color' => 'green', 'message' => 'Cliente atualizado com sucesso!']);
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
}
