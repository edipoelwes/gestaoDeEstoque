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
               <li><a href="{{ route('users.index') }}" class="text-orange">Usuarios</a></li>
            </ul>
         </nav>

         <a href="{{ route('purchases.create') }}" class="btn btn-orange icon-user ml-1">Registrar Compra</a>
      </div>
   </header>



   <div class="dash_content_app_box">
      <div class="dash_content_app_box_stage">
         <table id="dataTable" class="nowrap stripe" width="100" style="width: 100% !important;">
            <thead>
               <tr>
                  <th>#</th>
                  <th>F. Pagamento</th>
                  <th>Status</th>
                  <th>Total</th>
                  <th>Vencimento</th>
                  <th>Detalhes</th>
               </tr>
            </thead>
            <tbody>
               @foreach ($purchases as $purchase)
               <tr>
                  <td>{{ $purchase->id }}</td>
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
                  <td class="text-orange">{{ $payment }}</td>
                  <td
                     class="badge badge-pill {{ ($purchase->status == 3 ? 'badge-danger' : ($purchase->status == 1 ? 'badge-success' : 'badge-warning')) }}">
                     {{ ($purchase->status == 3 ? 'cancelado' : ($purchase->status == 1 ? 'confirmado' : 'pendente')) }}
                  </td>
                  <td>R$ {{ money_br($purchase->total) }}</td>
                  <td>{{ date_br($purchase->created_at) }}</td>
                  <td><a href="{{ route('purchases.show', ['purchase' => $purchase->id]) }}"
                        class="icon-file-text text-orange"></a>
                  </td>
               </tr>
               @endforeach
            </tbody>
         </table>
      </div>
   </div>
</section>
@endsection
