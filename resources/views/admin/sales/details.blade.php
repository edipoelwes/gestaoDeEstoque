@extends('admin.master.master')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/badge.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/tables.css') }}">
@endpush

@section('content')
<section class="dash_content_app">
   <header class="dash_content_app_header">
      <h2>Relatorio de Venda</h2>

      <div class="dash_content_app_header_actions">
         <nav class="dash_content_app_breadcrumb">
            <ul>
               <li><a href="{{ route('home') }}">Dashboard</a></li>
               <li class="separator icon-angle-right icon-notext"></li>
               <li><a href="{{ route('inventories.index') }}" class="text-orange">Produtos</a></li>
            </ul>
         </nav>
         <a href="{{ route('sales.create') }}" class="btn btn-orange icon-user ml-1">Criar Pedido</a>
      </div>
   </header>

   <div class="dash_content_app_box">
      <div class="dash_content_app_box_stage">
         <div>
            <p>Vendedor: {{ $details->user->name }}</p>
            <p>Cliente: {{ $details->client->name }}</p>
            <p>Status: {{ $details->status }}</p>
            @if ($details->discount != 0)
            <p>Desconto: {{ money_br($details->discount) }}</p>
            @endif
            <p>Total: {{ money_br($details->total_price) }}</p>
            <p>Data: {{ date_br($details->created_at) }}</p>
            @if ($details->description)
            <p>Descrição: {{ $details->description }}</p>
            @endif
         </div>
      </div>
   </div>

   <div class="dash_content_app_box">
      <div class="dash_content_app_box_stage">

         <h3>Lista de produtos</h3>
         <br>

         <table class="table table-striped table-bordered">
            <thead>
               <tr>
                  <th>#</th>
                  <th>Produto</th>
                  <th>Quantidade</th>
                  <th>Preço Unit.</th>
                  <th>SubTotal</th>
               </tr>
            </thead>
            <tbody>
               @foreach ($products as $product)
               <tr>
                  <td>{{ $product->id }}</td>
                  <td>{{ $product->inventory->name }}</td>
                  <td>{{ $product->amount }}</td>
                  <td>R$ {{ money_br($product->price) }}</td>
                  <td>R$ {{ money_br($product->sub_total) }}</td>
               </tr>
               @endforeach
               <td colspan="3"></td>
               <td><b>Total</b></td>
               <td>R$ {{ $details->total_price }}</td>
            </tbody>
         </table>
      </div>
   </div>
</section>
@endsection
