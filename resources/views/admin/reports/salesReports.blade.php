@extends('admin.master.master')

@section('content')
<div style="flex-basis: 100%;">
   <section class="dash_content_app">
      <header class="dash_content_app_header">
         <h2 class="icon-tachometer">Relatorios de Vendas</h2>
      </header>

      <div class="dash_content_app_box">

         <div class="nav">

            <ul class="nav_tabs">
               <li class="nav_tabs_item">
                  <a href="#data" class="nav_tabs_item_link active">Dados do Relatorio</a>
               </li>
            </ul>


            <form action="{{ route('reports.sales-pdf') }}" method="get" target="_blank" class="app_form" enctype="multipart/form-data">
               <div class="nav_tabs_content">
                  <div id="data">
                     <div class="label_g4">
                        <label class="label">
                           <span class="legend">Cliente:</span>
                           <select name="client_id" class="select2">
                              <option value="">Selecione um Cliente</option>
                              @foreach ($clients as $client)
                              <option value="{{ $client->id }}" {{ set_selected($client->id, old('client_id')) }}>
                                 {{ $client->name }} ({{ $client->document }})</option>
                              @endforeach
                           </select>
                        </label>

                        <label class="label">
                           <span class="legend">Periodo:</span>
                           <input type="date" name="start_date"/>
                           até
                           <input type="date" name="end_date"/>
                        </label>

                        <label class="label">
                           <span class="legend">Status:</span>
                           <select name="status" class="select2">
                              <option value="">Todos os status</option>
                              <option value="1">Confirmado</option>
                              <option value="2">Cancelado</option>
                              <option value="3">Pendente</option>
                           </select>
                        </label>

                        <label class="label">
                           <span class="legend">Ordenação:</span>
                           <select name="order" class="select2">
                              <option value="desc">Mais Recente</option>
                              <option value="asc">Mais Antigo</option>
                           </select>
                        </label>
                     </div>
                  </div>
               </div>


               <div class="text-center mt-2">
                  <button class="btn btn-large btn-green icon-check-square-o" type="submit">Gerar Relatório</button>
               </div>
            </form>
         </div>
      </div>
   </section>
</div>
@endsection
