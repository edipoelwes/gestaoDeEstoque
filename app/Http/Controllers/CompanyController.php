<?php

namespace App\Http\Controllers;

use App\{User, Company};
use App\Http\Controllers\Controller;
use App\Http\Requests\Company as CompanyRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
      return view('admin.companies.index', [
         'companies' => Company::where('id', Auth::user()->company_id)->get(),
      ]);
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create(Request $request)
   {
      if (!empty($request->user)) {
         $user = User::where('id', $request->user)->first();
      }

      return view('admin.companies.create');
   }

   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(CompanyRequest $request)
   {
      $companyCreate = Company::create($request->all());

      return redirect()->route('companies.edit', [
         'company' => $companyCreate->id,
      ])->withSuccess('Cliente cadastrado com sucesso!');
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
      $company = Company::where('id', $id)->first();

      return view('admin.companies.edit', [
         'company' => $company,
      ]);
   }

   /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function update(CompanyRequest $request, $id)
   {
      $company = Company::where('id', $id)->first();

      $company->fill($request->all());
      $company->save();

      return redirect()->route('companies.edit', [
         'company' => $company->id,
      ])->withSuccess('Empresa atualizado com sucesso!');
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
