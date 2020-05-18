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
               <li><a href="{{ route('roles.index') }}" class="text-orange">Perfil</a></li>
            </ul>
         </nav>

         <a href="{{ route('roles.create') }}" class="btn btn-blue icon-key ml-1">Cadastrar Perfil</a>

      </div>
   </header>

   <div class="dash_content_app_box">
      <div class="dash_content_app_box_stage">
         <table id="dataTable" class="nowrap stripe" width="100" style="width: 100% !important;">
            <thead>
               <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th class="text-center">Ações</th>

               </tr>
            </thead>
            <tbody>
               @foreach ($roles as $role)
               <tr>
                  <td>{{ $role->id }}</td>
                  <td class="text-orange">{{ $role->name }}</td>
                  <td>
                     <a href="{{ route('roles.edit', ['role' => $role->id]) }}" class="text-blue icon-pencil-square-o"
                     title="Editar Perfil">
                     </a>

                     <a href="{{ route('roles.permission', ['role' => $role->id]) }}" class="text-green icon-key"
                        title="Permissões">
                     </a>

                     <a href="javascript:;" class="text-orange icon-trash" onclick="confirmDelete({{ $role->id }})"
                        title="Excluir Perfil">
                     </a>

                     <form id="btn-delete-{{ $role->id }}"
                        action="{{ route('roles.destroy', ['role' => $role->id]) }}" method="post"
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
