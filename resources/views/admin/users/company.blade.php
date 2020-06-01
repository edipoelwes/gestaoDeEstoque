@extends('admin.master.master')

@section('content')
<section class="dash_content_app">

   <header class="dash_content_app_header">
      <h2 class="icon-search">Filtro</h2>

      <div class="dash_content_app_header_actions">
         <nav class="dash_content_app_breadcrumb">
            <ul>
               <li><a href="{{ route('home') }}">Dashboard</a></li>
               <li class="separator icon-angle-right icon-notext"></li>
               <li><a href="{{ route('users.index') }}">Clientes</a></li>
               <li class="separator icon-angle-right icon-notext"></li>
               <li><a href="{{ route('sales.index') }}" class="text-orange">Vendas</a></li>
            </ul>
         </nav>
      </div>
   </header>

   <div class="dash_content_app_box">
      <div class="dash_content_app_box_stage">
         <table id="dataTable" class="nowrap hover stripe" width="100" style="width: 100% !important;">
            <thead>
               <tr>
                  <th>Razão Social</th>
                  <th>Nome Fantasia</th>
                  <th>CNPJ</th>
                  <th>IE</th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td><a href="{{ route('companies.edit', ['company' => $company->id]) }}"
                        class="text-orange">{{ $company->social_name }}</a></td>
                  <td>{{ $company->alias_name }}</td>
                  <td>{{ $company->document_company }}</td>
                  <td>{{ $company->document_company_secondary }}</td>
               </tr>
            </tbody>
         </table>
      </div>
   </div>
</section>
@endsection
