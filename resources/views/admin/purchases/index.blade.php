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
               <li><a href="{{ route('users.index') }}" class="text-orange">Usuarios</a></li>
            </ul>
         </nav>

         <a href="{{ route('purchases.create') }}" class="btn btn-orange icon-user ml-1">Repor Estoque</a>
         <button class="btn btn-green icon-search icon-notext ml-1 search_open"></button>
      </div>
   </header>



   <div class="dash_content_app_box">
      <div class="dash_content_app_box_stage">
         <table id="dataTable" class="nowrap stripe" width="100" style="width: 100% !important;">
            <thead>
               <tr>
                  <th>#</th>
                  <th>Usuario</th>
                  <th>Status</th>
                  <th>F. Pagamento</th>
                  <th>Fornecedor</th>
                  <th>Total</th>
                  <th>Data</th>
                  <th>Detalhes</th>
               </tr>
            </thead>
            <tbody>
               @foreach ($purchases as $purchase)
               <tr>
                  <td>{{ $purchase->id }}</td>
                  <td>{{ $purchase->user->name }}</td>
                  <td>{{ $purchase->status }}</td>
                  <td>{{ $purchase->payment_method }}</td>
                  <td>{{ $purchase->provider }}</td>
                  <td>{{ money_br($purchase->total) }}</td>
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
