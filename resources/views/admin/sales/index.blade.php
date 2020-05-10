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
               <li><a href="{{ route('users.index') }}" class="text-orange">Clientes</a></li>
            </ul>
         </nav>

         <a href="{{ route('sales.create') }}" class="btn btn-orange icon-user ml-1">Criar Pedido</a>
         <button class="btn btn-green icon-search icon-notext ml-1 search_open"></button>
      </div>
   </header>

   {{-- @include('admin.users.filter') --}}

   <div class="dash_content_app_box">
      <div class="dash_content_app_box_stage">
         <table id="dataTable" class="nowrap stripe" width="100" style="width: 100% !important;">
            <thead>
               <tr>
                  <th>#</th>
                  <th>cliente</th>
                  <th>valor total</th>
                  <th>status</th>
                  <th>responsável</th>
                  <th>data</th>
               </tr>
            </thead>
            <tbody>
               @foreach ($sales as $sale)
               <tr>
                  <td>{{ $sale->id }}</td>
                  <td><a href="{{ route('sales.edit', ['sale' => $sale->id]) }}" class="text-orange">
                        {{ $sale->client->name  }}</a></td>
                  <td>{{ $sale->total_price }}</td>
                  <td class="badge badge-pill {{ ($sale->status == 0 ? 'badge-warning' : ($sale->status == 1 ? 'badge-success' : 'badge-danger')) }}">
                     {{ ($sale->status == 0 ? 'pendente' : ($sale->status == 1 ? 'confirmado' : 'cancelado')) }}</td>
                  <td>{{ $sale->user->name }}</td>
                  <td>{{ $sale->created_at }}</td>
               </tr>
               @endforeach
            </tbody>
         </table>
      </div>
   </div>
</section>
@endsection
