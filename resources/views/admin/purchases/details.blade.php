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
         <a href="{{ route('purchases.create') }}" class="btn btn-orange icon-user ml-1">Comprar</a>
      </div>
   </header>

   <div class="dash_content_app_box">
      <div class="dash_content_app_box_stage">
         <div>
            <p><b>Vendedor:</b> {{ $purchase->user->name }}</p>

            @php
               switch ($purchase->payment_method) {
               case 0:
                  $payment = 'Boleto Bancario';
                  break;
               case 1:
                  $payment = 'Cartão de Credito';
                  break;
               case 2:
                  $payment = 'Transferência Bancaria';
                  break;
               case 3:
                  $payment = 'dinheiro';
                  break;

               default:
                  $payment = 'não Informado';
                  break;
               }
            @endphp
            <p><b>Forma de Pagamento:</b> {{ $payment }}</p>

            @if ($purchase->status != 3)
            <form action="{{ route('purchases.details-status', ['purchase' => $purchase->id]) }}" method="post"
               enctype="multipart/form-data">
               @method('PUT')
               @csrf
               <label class="label">
                  <span class="legend"><b>Status:</b></span>

                  <select name="status" class="btn btn-large">
                     <option value="1" {{ ($purchase->status == 1 ? 'selected' : '') }}>Confirmado</option>
                     <option value="2" {{ ($purchase->status == 2 ? 'selected' : '') }}>Pendente</option>
                     <option value="3" {{ ($purchase->status == 3 ? 'selected' : '') }}>Cancelado</option>
                  </select>
               </label>
               <button class="btn btn-large btn-blue" type="submit">Atualizar Status</button>
            </form>
            @else
            <p><b>Status:</b> {{ ($purchase->status == 3 ? 'cancelado' : '') }}</p>
            @endif

            <br>
            <p><b>Total:</b> {{ money_br($purchase->total) }}</p>
            <p><b>Data:</b> {{ date_br($purchase->created_at) }}</p>
            @if ($purchase->obs)
            <p><b>Descrição:</b> {{ $purchase->obs }}</p>
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
                  <td>R$ {{ money_br($product->sub_total / $product->amount) }}</td>
                  <td>R$ {{ money_br($product->sub_total) }}</td>
               </tr>
               @endforeach
               <tr>
                  <td colspan="3"></td>
                  <td><b>Total</b></td>
                  <td>R$ {{ money_br($purchase->total) }}</td>
               </tr>
            </tbody>
         </table>
      </div>
   </div>
</section>
@endsection
