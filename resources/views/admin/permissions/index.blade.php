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
               <li><a href="{{ route('permissions.index') }}" class="text-orange">Permissões</a></li>
            </ul>
         </nav>

         <a href="{{ route('permissions.create') }}" class="btn btn-blue icon-key ml-1">Cadastrar Permissão</a>

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
               @foreach ($permissions as $permission)
               <tr>
                  <td>{{ $permission->id }}</td>
                  <td class="text-orange">{{ $permission->name }}</td>
                  <td>
                     <a href="{{ route('permissions.edit', ['permission' => $permission->id]) }}" class="text-blue icon-pencil-square-o"
                     title="Editar Permissao">
                     </a>

                     <a href="javascript:;" class="text-orange icon-trash" onclick="confirmDelete({{ $permission->id }})"
                        title="Excluir Permissao">
                     </a>

                     <form id="btn-delete-{{ $permission->id }}"
                        action="{{ route('permissions.destroy', ['permission' => $permission->id]) }}" method="post"
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
