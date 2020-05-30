@extends('admin.master.master')

@section('content')
<section class="dash_content_app">

   <header class="dash_content_app_header">
      <h2 class="icon-search">
         {{ isset($product->id) ? 'Editar Produto' : 'Cadastrar Novo Produto' }}
      </h2>

      <div class="dash_content_app_header_actions">
         <nav class="dash_content_app_breadcrumb">
            <ul>
               <li><a href="{{ route('home') }}">Dashboard</a></li>
               <li class="separator icon-angle-right icon-notext"></li>
               <li><a href="{{ route('inventories.index') }}">Produtos</a></li>
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

         @if(! isset($product))
         <form action="{{ route('inventories.store') }}" method="post" class="app_form" enctype="multipart/form-data">
            @else
            <form action="{{ route('inventories.update', ['inventory' => $product->id]) }}" method="post"
               class="app_form" enctype="multipart/form-data">
               @method('PUT')
               @endif
               @csrf
               <div class="nav_tabs_content">
                  <div id="data">

                     <label class="label">
                        <span class="legend">Nome:</span>
                        <input type="text" name="name" placeholder="modelo do produto" autocomplete="off"
                           value="{{ old('name', $product->name ?? null) }}" />

                        @error('name')
                        <span class="message-color" role="alert">
                           <p class="icon-asterisk">{{ $message }}</p>
                        </span>
                        @enderror
                     </label>

                     <div class="label_g2">
                        <label class="label">
                           <span class="legend">Categoria:</span>
                           <select name="category_id" class="select2">
                              <option value="">Selecione uma Categoria</option>
                              @foreach ($categories as $category)
                              <option value="{{ $category->id }}" {{ $category->id == old('category_id', $product->category_id) ? 'selected' : '' }}>
                                 {{ $category->name }}</option>
                              @endforeach
                           </select>
                        </label>

                        <label class="label">
                           <span class="legend">Preço:</span>
                           <input type="text" name="price" class="mask-money"
                              value="{{ old('price', $product->price ?? null) }}" />

                           @error('price')
                           <span class="message-color" role="alert">
                              <p class="icon-asterisk">{{ $message }}</p>
                           </span>
                           @enderror
                        </label>
                     </div>

                     <div class="label_g2">

                        <label class="label">
                           <span class="legend">Quantidade:</span>
                           <input type="number" name="amount" min="0" placeholder="0"
                              value="{{ old('amount', $product->amount ?? null) }}" />

                           @error('amount')
                           <span class="message-color" role="alert">
                              <p class="icon-asterisk">{{ $message }}</p>
                           </span>
                           @enderror
                        </label>

                        <label class="label">
                           <span class="legend">Quantidade Minima:</span>
                           <input type="number" name="min_amount" min="0" placeholder="0"
                              value="{{ old('min_amount', $product->min_amount ?? null) }}" />

                           @error('min_amount')
                           <span class="message-color" role="alert">
                              <p class="icon-asterisk">{{ $message }}</p>
                           </span>
                           @enderror
                        </label>
                     </div>
                  </div>
               </div>

               @if ( isset($product))
               <div class="text-right mt-2">
                  <button class="btn btn-large btn-green icon-check-square-o" type="submit">Atualizar Dados</button>
               </div>
               @else
               <div class="text-right mt-2">
                  <button class="btn btn-large btn-green icon-check-square-o" type="submit">Salvar Produto</button>
               </div>
               @endif
            </form>
      </div>
   </div>
</section>
@endsection
