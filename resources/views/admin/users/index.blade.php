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

         <a href="{{ route('users.create') }}" class="btn btn-orange icon-user ml-1">Criar Usuario</a>
      </div>
   </header>

   <div class="dash_content_app_box">
      <div class="dash_content_app_box_stage">
         <table id="dataTable" class="nowrap stripe" width="100" style="width: 100% !important;">
            <thead>
               <tr>
                  <th>#</th>
                  <th>Nome Completo</th>
                  <th>CPF</th>
                  <th>E-mail</th>
                  <th>Ações</th>
               </tr>
            </thead>
            <tbody>
               @foreach ($users as $user)
               <tr>
                  <td>{{ $user->id }}</td>
                  <td class="text-orange">{{ $user->name  }}</td>
                  <td>{{ $user->document }}</td>
                  <td><a href="mailto:{{ $user->email }}" class="text-orange">{{  $user->email  }}</a></td>
                  <td>
                     <a href="{{ route('users.edit', ['user' => $user->id]) }}" class="text-blue icon-pencil-square-o"
                        title="Editar Usuario">
                     </a>

                     <a href="{{ route('users.roles', ['user' => $user->id]) }}" class="text-green icon-user"
                        title="Perfis">
                     </a>

                     <a href="javascript:;" class="text-orange icon-trash" onclick="confirmDelete({{ $user->id }})"
                        title="Excluir Usuario">
                     </a>

                     <form id="btn-delete-{{ $user->id }}" action="{{ route('users.destroy', ['user' => $user->id]) }}"
                        method="post" class="hidden">
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
