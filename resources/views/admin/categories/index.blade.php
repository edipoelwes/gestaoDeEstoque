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
               <li><a href="{{ route('users.index') }}" class="text-orange">Clientes</a></li>
            </ul>
         </nav>

         <a href="{{ route('categories.create') }}" class="btn btn-orange icon-user ml-1">Criar Categoria</a>
      </div>
   </header>

   <div class="dash_content_app_box">
      <div class="dash_content_app_box_stage">
         <table id="dataTable" class="nowrap stripe" width="100" style="width: 100% !important;">
            <thead>
               <tr>
                  <th>#</th>
                  <th>Categoria</th>
                  <th>Ações</th>
               </tr>
            </thead>
            <tbody>
               @foreach($categories as $category)
                  <tr>
                     <td>{{ $category->id }}</td>
                     <td class="text-orange">{{ $category->name }}</a></td>
                     <td>
                        <a href="{{ route('categories.edit', ['category' => $category->id]) }}"
                           class="text-blue icon-pencil-square-o" title="Editar Usuário">
                        </a>

                        <a href="javascript:;" class="text-orange icon-trash"
                           onclick="confirmDelete({{ $category->id }})" title="Excluir Usuário">
                        </a>

                        <form id="btn-delete-{{ $category->id }}"
                           action="{{ route('categories.destroy', ['category' => $category->id]) }}"
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
