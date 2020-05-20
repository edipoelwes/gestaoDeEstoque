@extends('admin.master.master')

@section('content')
<div style="flex-basis: 100%;">
   <section class="dash_content_app">
      <header class="dash_content_app_header">
         <h2 class="icon-tachometer">Relatorios</h2>
      </header>

      <div class="dash_content_app_box">
         <section class="app_dash_home_stats">
            <article class="control radius">
               <a href="{{ route('reports.sales') }}">
                  <h2 class="text-green text-center icon-file-text" style="margin-top: 15px">Vendas</h2>
               </a>
            </article>

            <article class="control radius">
               <a href="http://" target="_blank" rel="noopener noreferrer">
                  <h2 class="text-green text-center icon-file-text" style="margin-top: 15px">Compras</h2>
               </a>
            </article>

            <article class="control radius">
               <a href="http://" target="_blank" rel="noopener noreferrer">
                  <h2 class="text-green text-center icon-file-text" style="margin-top: 15px">Estoque</h2>
               </a>
            </article>
         </section>

      </div>
   </section>
</div>
@endsection
