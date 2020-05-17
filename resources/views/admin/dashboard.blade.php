@extends('admin.master.master')

@section('content')
<div style="flex-basis: 100%;">
   <section class="dash_content_app">
      <header class="dash_content_app_header">
         <h2 class="icon-tachometer">Dashboard</h2>
      </header>

      <div class="dash_content_app_box">
         <section class="app_dash_home_stats">
            <article class="control radius">
               <h4 class="icon-users">Clientes</h4>
               <p><b>Locadores:</b> 100</p>
               <p><b>Locatários:</b> 100</p>
               <p><b>Time:</b> 3</p>
            </article>

            <article class="blog radius">
               <h4 class="icon-home">Imóveis</h4>
               <p><b>Disponíveis:</b> 100</p>
               <p><b>Locados:</b> 100</p>
               <p><b>Total:</b> 200</p>
            </article>

            <article class="users radius">
               <h4 class="icon-file-text">Contratos</h4>
               <p><b>Oficializados:</b> 455</p>
            </article>
         </section>
      </div>
   </section>

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
                  </tr>
               </thead>
               <tbody>
                  @foreach ($sales as $sale)
                  <tr>
                     <td>{{ $sale->id }}</td>
                     <td>{{ $sale->client->name }}</td>
                     <td class="badge badge-pill {{ ($sale->status == 0 ? 'badge-warning' : ($sale->status == 1 ? 'badge-success' : 'badge-danger')) }}">
                        {{ ($sale->status == 0 ? 'pendente' : ($sale->status == 1 ? 'confirmado' : 'cancelado')) }}</td>
                     <td>{{ money_br($sale->total_price) }}</td>
                     <td>{{ date_br($sale->created_at) }}</td>
                  </tr>
                  @endforeach
               </tbody>
            </table>
         </div>
      </div>
   </section>

   {{-- <section class="dash_content_app" style="margin-top: 40px;">
      <header class="dash_content_app_header">
         <h2 class="icon-tachometer">Últimos Contratos Cadastrados</h2>
      </header>

      <div class="dash_content_app_box">
         <div class="dash_content_app_box_stage">
            <table id="dataTable" class="nowrap hover stripe" width="100" style="width: 100% !important;">
               <thead>
                  <tr>
                     <th>Locador</th>
                     <th>Locatário</th>
                     <th>Negócio</th>
                     <th>Início</th>
                     <th>Vigência</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td><a href="" class="text-orange">Robson V. Leite</a></td>
                     <td><a href="" class="text-orange">Gustavo Web</a></td>
                     <td>Locação</td>
                     <td>{{ date('d/m/Y') }}</td>
                     <td>12 meses</td>
                  </tr>
               </tbody>
            </table>
         </div>
      </div>
   </section> --}}

</div>
@endsection
