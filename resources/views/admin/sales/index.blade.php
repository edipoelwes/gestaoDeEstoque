@extends('admin.master.master')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/badge.css') }}">
@endpush

@section('content')
<section class="dash_content_app">
   <header class="dash_content_app_header">
      <h2 class="icon-search">Filtro</h2>

      <div class="dash_content_app_header_actions">
         <nav class="dash_content_app_breadcrumb">
            <ul>
               <li><a href="{{ route('home') }}">Dashboard</a></li>
               <li class="separator icon-angle-right icon-notext"></li>
               <li><a href="{{ route('inventories.index') }}" class="text-orange">Produto</a></li>
            </ul>
         </nav>

         <a href="{{ route('sales.create') }}" class="btn btn-orange icon-user ml-1">Cadastrar Venda</a>
      </div>
   </header>

   <div class="dash_content_app_box">
      <div class="dash_content_app_box_stage">
         <table id="dataTable" class="nowrap stripe" width="100" style="width: 100% !important;">
            <thead>
               <tr>
                  <th>#</th>
                  <th>Cliente</th>
                  <th>Total</th>
                  <th>Status</th>
                  <th>Responsável</th>
                  <th>Data</th>
                  <th>Detalhes</th>

               </tr>
            </thead>
            <tbody>
               @foreach ($sales as $sale)
               <tr>
                  <td>{{ $sale->id }}</td>
                  <td class="text-orange"> {{ $sale->client->name  }}</td>
                  <td>{{ money_br($sale->total_price) }}</td>
                  <td class="badge badge-pill {{ ($sale->status == 3 ? 'badge-danger' : ($sale->status == 1 ? 'badge-success' : 'badge-warning')) }}">
                     {{ ($sale->status == 2 ? 'pendente' : ($sale->status == 1 ? 'confirmado' : 'cancelado')) }}</td>
                  <td>{{ $sale->user->name }}</td>
                  <td>{{ date_br($sale->created_at) }}</td>
                  <td><a href="{{ route('sales.show', ['sale' => $sale->id]) }}" class="icon-file-text text-orange"></a></td>
               </tr>
               @endforeach
            </tbody>
         </table>
      </div>
   </div>
</section>
@endsection
