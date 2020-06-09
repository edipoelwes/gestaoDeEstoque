@extends('admin.master.master')

@section('content')
<div style="flex-basis: 100%;">
   @can('Visualizar itens')
      <section class="dash_content_app">
         <header class="dash_content_app_header">
            <h2 class="icon-tachometer">Dashboard</h2>
         </header>

         <div class="dash_content_app_box">
            <section class="app_dash_home_stats">
               <article class="control radius">
                  <h4 class="text-center icon-usd">Vendas Mensal</h4>
                  <h1 class="text-center" style="margin-top: 40px">
                     <p class="text-orange">R$ <span class="text-blue">{{ money_br($total - $discount) }}</span>
                     </p>
                  </h1>
                  <br><br>
               </article>

               <article class="users radius">
                  <h4 class="text-center icon-usd">Vendas Pendentes</h4>
                  <h1 class="text-center" style="margin-top: 40px">
                     <p class="text-orange">R$ <span class="text-blue">{{ money_br($pending - $discount_pending) }}</span></p>
                  </h1>
               </article>

               <article class="blog radius">
                  <h4 class="text-center icon-usd">Despesas</h4>
                  <h1 class="text-center" style="margin-top: 40px">
                     <p class="text-orange">R$ <span class="text-blue">{{ money_br($expense + $expense_pending) }}</span></p>
                  </h1>
               </article>

            </section>
         </div>
      </section>
   @endcan

   <section class="dash_content_app" style="margin-top: 40px;">
      <header class="dash_content_app_header">
         <h2 class="icon-tachometer">Últimos vendas Realizadas</h2>
      </header>

      <div class="dash_content_app_box">
         <div class="dash_content_app_box_stage">
            <table id="dataTable" class="nowrap hover stripe" width="100" style="width: 100% !important;">
               <thead>
                  <tr>
                     <th>#</th>
                     <th>Cliente</th>
                     <th>Status</th>
                     <th>Total</th>
                     <th>Data</th>
                     <th>Detalhes</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($sales as $sale)
                     <tr>
                        <td>{{ $sale->id }}</td>
                        <td>{{ $sale->client->name }}</td>
                        <td
                           class="badge badge-pill {{ ($sale->status == 2 ? 'badge-warning' : ($sale->status == 1 ? 'badge-success' : 'badge-danger')) }}">
                           {{ ($sale->status == 2 ? 'pendente' : ($sale->status == 1 ? 'confirmado' : 'cancelado')) }}
                        </td>
                        <td>R$ {{ money_br($sale->total_price) }}</td>
                        <td>{{ date_br($sale->created_at) }}</td>
                        <td><a href="{{ route('sales.show', ['sale' => $sale->id]) }}"
                              class="icon-file-text text-orange"></a></td>
                     </tr>
                  @endforeach
               </tbody>
            </table>
         </div>
      </div>
   </section>
</div>
@endsection
