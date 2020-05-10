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
               <li><a href="{{ route('clients.index') }}" class="text-orange">Clientes</a></li>
            </ul>
         </nav>

         <a href="{{ route('clients.create') }}" class="btn btn-orange icon-user ml-1">Criar Cliente</a>
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
                  <th>Nome Completo</th>
                  <th>CPF</th>
                  <th>E-mail</th>
                  <th>Telefone</th>
               </tr>
            </thead>
            <tbody>
               @foreach ($clients as $client)
               <tr>
                  <td>{{ $client->id }}</td>
                  <td><a href="{{ route('clients.edit', ['client' => $client->id]) }}" class="text-orange">
                        {{ $client->name  }}</a></td>
                  <td>{{ $client->document }}</td>
                  <td><a href="mailto:{{ $client->email }}" class="text-orange">{{  $client->email  }}</a></td>
                  <td>{{ $client->phone }}</td>
               </tr>
               @endforeach
            </tbody>
         </table>
      </div>
   </div>
</section>
@endsection
