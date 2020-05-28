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
                  <th>Telefone</th>
                  <th>Ações</th>
               </tr>
            </thead>
            <tbody>
               @foreach ($clients as $client)
               <tr>
                  <td>{{ $client->id }}</td>
                  <td class="text-orange">{{ $client->name  }}</td>
                  <td>{{ document_view($client->document) }}</td>
                  <td class="phone">{{ $client->phone }}</td>
                  <td>

                     <a href="{{ route('clients.edit', ['client' => $client->id]) }}" class="text-blue icon-pencil-square-o"
                        title="Editar Usuário">
                        </a>

                     <a href="javascript:;" class="text-orange icon-trash" onclick="confirmDelete({{ $client->id }})"
                        title="Excluir Usuário">
                     </a>

                     <form id="btn-delete-{{ $client->id }}"
                        action="{{ route('clients.destroy', ['client' => $client->id]) }}" method="post"
                        class="hidden">
                        @method('DELETE')
                        @csrf
                     </form>
                  </td>
               </tr>
               @endforeach
            </tbody>
         </table>
      </div>
   </div>
</section>
@endsection
