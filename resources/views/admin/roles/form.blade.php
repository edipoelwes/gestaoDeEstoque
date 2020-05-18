@extends('admin.master.master')

@section('content')
<section class="dash_content_app">

   <header class="dash_content_app_header">
      <h2 class="icon-search">
         {{ isset($role->id) ? 'Editar Perfil' : 'Cadastrar Perfil' }}
      </h2>

      <div class="dash_content_app_header_actions">
         <nav class="dash_content_app_breadcrumb">
            <ul>
               <li><a href="{{ route('home') }}">Dashboard</a></li>
               <li class="separator icon-angle-right icon-notext"></li>
               <li><a href="{{ route('roles.index') }}">Perfil</a></li>
            </ul>
         </nav>
      </div>
   </header>


   <div class="dash_content_app_box">

      <div class="nav">

         <ul class="nav_tabs">
            <li class="nav_tabs_item">
               <a href="#data" class="nav_tabs_item_link active">Dados do Perfil</a>
            </li>
         </ul>

         @if(! isset($role))
         <form action="{{ route('roles.store') }}" method="post" class="app_form" enctype="multipart/form-data">
            @else
            <form action="{{ route('roles.update', ['role' => $role->id]) }}" method="post"
               class="app_form" enctype="multipart/form-data">
               @method('PUT')
               @endif
               @csrf
               <div class="nav_tabs_content">
                  <div id="data">

                     <label class="label">
                        <span class="legend">Nome:</span>
                        <input type="text" name="name" placeholder="nome do perfil" autocomplete="off"
                           value="{{ old('name', $role->name ?? null) }}" />

                        @error('name')
                        <span class="message-color" role="alert">
                           <p class="icon-asterisk">{{ $message }}</p>
                        </span>
                        @enderror
                     </label>
                  </div>
               </div>

               @if ( isset($role))
               <div class="text-right mt-2">
                  <button class="btn btn-large btn-green icon-check-square-o" type="submit">Atualizar Perfil</button>
               </div>
               @else
               <div class="text-right mt-2">
                  <button class="btn btn-large btn-green icon-check-square-o" type="submit">Salvar Perfil</button>
               </div>
               @endif
            </form>
      </div>
   </div>
</section>
@endsection
