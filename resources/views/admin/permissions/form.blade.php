@extends('admin.master.master')

@section('content')
<section class="dash_content_app">

   <header class="dash_content_app_header">
      <h2 class="icon-search">
         {{ isset($permission->id) ? 'Editar Permissão' : 'Cadastrar Permissão' }}
      </h2>

      <div class="dash_content_app_header_actions">
         <nav class="dash_content_app_breadcrumb">
            <ul>
               <li><a href="{{ route('home') }}">Dashboard</a></li>
               <li class="separator icon-angle-right icon-notext"></li>
               <li><a href="{{ route('permissions.index') }}">Permissões</a></li>
            </ul>
         </nav>
      </div>
   </header>


   <div class="dash_content_app_box">

      <div class="nav">

         <ul class="nav_tabs">
            <li class="nav_tabs_item">
               <a href="#data" class="nav_tabs_item_link active">Dados da Permissão</a>
            </li>
         </ul>

         @if(! isset($permission))
         <form action="{{ route('permissions.store') }}" method="post" class="app_form" enctype="multipart/form-data">
            @else
            <form action="{{ route('permissions.update', ['permission' => $permission->id]) }}" method="post"
               class="app_form" enctype="multipart/form-data">
               @method('PUT')
               @endif
               @csrf
               <div class="nav_tabs_content">
                  <div id="data">

                     <label class="label">
                        <span class="legend">Nome:</span>
                        <input type="text" name="name" placeholder="nome da permissão" autocomplete="off"
                           value="{{ old('name', $permission->name ?? null) }}" />

                        @error('name')
                        <span class="message-color" role="alert">
                           <p class="icon-asterisk">{{ $message }}</p>
                        </span>
                        @enderror
                     </label>
                  </div>
               </div>

               @if ( isset($permission))
               <div class="text-right mt-2">
                  <button class="btn btn-large btn-green icon-check-square-o" type="submit">Atualizar Permissão</button>
               </div>
               @else
               <div class="text-right mt-2">
                  <button class="btn btn-large btn-green icon-check-square-o" type="submit">Salvar Permissão</button>
               </div>
               @endif
            </form>
      </div>
   </div>
</section>
@endsection
