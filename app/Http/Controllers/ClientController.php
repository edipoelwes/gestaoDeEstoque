<?php

namespace App\Http\Controllers;

use App\{Client, Company};
use App\Http\Requests\Client as ClientRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
      return view('admin.clients.index', [
         'clients' => Client::where('company_id', Auth::user()->company_id)->get(),
      ]);
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create()
   {
      return view('admin.clients.form', [
         'companies' => Company::all(['id', 'social_name']),
      ]);
   }

   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(ClientRequest $request)
   {
      // var_dump($request->all()); die;
      $clientCreate = Client::create($request->all());

      return redirect()->route('clients.edit', [
         'client' => $clientCreate->id,
      ])->withToastSuccess('Cliente cadastrado com sucesso!');
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
      $client = Client::where('id', $id)->first();
      return view('admin.clients.form', [
         'client' => $client,
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
   public function update(ClientRequest $request, $id)
   {
      $client = Client::where('id', $id)->first();
      $client->update($request->all());

      return redirect()->route('clients.edit', [
         'client' => $client->id,
      ])->withToastSuccess('Cliente atualizado com sucesso!');
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function destroy($id)
   {
      $product = Client::find($id);

      $product->delete();

      return back()->withToastSuccess('Cliente excluído com sucesso!');
   }
}
