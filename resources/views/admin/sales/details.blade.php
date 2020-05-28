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
            <p><b>Vendedor:</b> {{ $detail->user->name }}</p>
            <p><b>Cliente:</b> {{ $detail->client->name }}</p>

            @if ($detail->status != 3)
            <form action="{{ route('sales.details-status', ['sale' => $detail->id]) }}" method="post"
               enctype="multipart/form-data">
               @method('PUT')
               @csrf
               <label class="label">
                  <span class="legend"><b>Status:</b></span>

                  <select name="status" class="btn btn-large">
                     <option value="1" {{ ($detail->status == 1 ? 'selected' : '') }}>Confirmado</option>
                     <option value="2" {{ ($detail->status == 2 ? 'selected' : '') }}>Pendente</option>
                     <option value="3" {{ ($detail->status == 3 ? 'selected' : '') }}>Cancelado</option>
                  </select>
               </label>
               <button class="btn btn-large btn-blue" type="submit">Atualizar Status</button>
            </form>
            @else
            <p><b>Status:</b> {{ ($detail->status == 3 ? 'cancelado' : '') }}</p>
            @endif



            <br>
            <p><b>Desconto:</b> {{ money_br($detail->discount) }}</p>
            <p><b>Total:</b> {{ money_br($detail->total_price) }}</p>
            <p><b>Data:</b> {{ date_br($detail->created_at) }}</p>
            @if ($detail->description)
            <p><b>Descrição:</b> {{ $detail->description }}</p>
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
               <tr>
                  <td colspan="3"></td>
                  <td><b>Desconto</b></td>
                  <td>R$ {{ money_br($detail->discount) }}</td>
               </tr>

               <tr>
                  <td colspan="3"></td>
                  <td><b>Total</b></td>
                  <td>R$ {{ money_br($detail->total_price) }}</td>
               </tr>
            </tbody>
         </table>
      </div>
   </div>
</section>
@endsection
