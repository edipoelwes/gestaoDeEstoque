@extends('admin.master.master')

@section('content')

<section class="dash_content_app">

   <header class="dash_content_app_header">
      <h2 class="icon-search">Cadastrar Nova Categoria</h2>

      <div class="dash_content_app_header_actions">
         <nav class="dash_content_app_breadcrumb">
            <ul>
               <li><a href="">Dashboard</a></li>
               <li class="separator icon-angle-right icon-notext"></li>
               <li><a href="{{ route('categories.index') }}" class="text-orange">Categoria</a></li>
            </ul>
         </nav>
      </div>
   </header>

   <div class="dash_content_app_box">

      <div class="nav">
         <ul class="nav_tabs">
            <li class="nav_tabs_item">
               <a href="#data" class="nav_tabs_item_link active">Dados Cadastrais</a>
            </li>
         </ul>

         @if(! isset($category))
            <form action="{{ route('categories.store') }}" method="post" class="app_form"
               enctype="multipart/form-data">
            @else
               <form
                  action="{{ route('categories.update', ['category' => $category->id]) }}"
                  method="post" class="app_form" enctype="multipart/form-data">
                  @method('PUT')
         @endif

         @csrf

         <div class="nav_tabs_content">
            <div id="data">
               <div class="label">
                  <label class="label">
                     <span class="legend">*Categoria:</span>
                     <input type="text" name="name" placeholder="Nome da categoria" value="{{ old('name', $category->name ?? null) }}" />
                  </label>
               </div>
            </div>
         </div>

         @if( isset($category))
            <div class="text-right mt-2">
               <button class="btn btn-large btn-green icon-check-square-o" type="submit">Atualizar Dados</button>
            </div>
         @else
            <div class="text-right mt-2">
               <button class="btn btn-large btn-green icon-check-square-o" type="submit">Salvar Dados</button>
            </div>
         @endif
         </form>
      </div>
   </div>
</section>
@endsection
