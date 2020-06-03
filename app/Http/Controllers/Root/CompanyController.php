<?php

namespace App\Http\Controllers\Root;

use App\{User, Company};
use App\Http\Controllers\Controller;
use App\Http\Requests\Company as CompanyRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Exceptions\UnauthorizedException;

class CompanyController extends Controller
{
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
      if (!Auth::user()->hasPermissionTo('Visualizar Empresas')) {
         throw new UnauthorizedException('403', 'You do not have the required authorization!');
      }

      return view('root.companies.index', [
         'companies' => Company::all(),
      ]);
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create(Request $request)
   {
      if (!Auth::user()->hasPermissionTo('Cadastrar Empresa')) {
         throw new UnauthorizedException('403', 'You do not have the required authorization!');
      }

      if (!empty($request->user)) {
         $user = User::where('id', $request->user)->first();
      }

      return view('root.companies.form');
   }

   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(CompanyRequest $request)
   {
      if (!Auth::user()->hasPermissionTo('Cadastrar Empresa')) {
         throw new UnauthorizedException('403', 'You do not have the required authorization!');
      }

      $companyCreate = Company::create($request->all());

      return redirect()->route('root.companies.edit', [
         'company' => $companyCreate->id,
      ])->withToastSuccess('Empresa cadastrada com sucesso!');
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
      if (!Auth::user()->hasPermissionTo('Editar Empresa')) {
         return back()->withToastWarning('Usuario não tem permissão para editar uma Empresa!');
      }

      $company = Company::where('id', $id)->first();

      return view('root.companies.form', [
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
      if (!Auth::user()->hasPermissionTo('Editar Empresa')) {
         return back()->withToastWarning('Usuario não tem permissão para editar uma Empresa!');
      }

      $company = Company::where('id', $id)->first();

      $company->fill($request->all());
      $company->save();

      return redirect()->route('root.companies.edit', [
         'company' => $company->id,
      ])->withToastSuccess('Empresa atualizada com sucesso!');
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function destroy($id)
   {
      if (!Auth::user()->hasPermissionTo('Deletar Empresa')) {
         return back()->withToastWarning('Usuario não tem permissão para remover uma Empresa!');
      }

      $company = Company::find($id);
      $company->delete();

      return back()->withToastSuccess('Empresa excluído com sucesso!');
   }
}
