@extends('admin.master.master')

@section('content')
<section class="dash_content_app">

   <header class="dash_content_app_header">
      <h2 class="icon-search">
         {{ isset($stock->id) ? 'Editar Entrada' : 'Entrada de Produto' }}
      </h2>

      <div class="dash_content_app_header_actions">
         <nav class="dash_content_app_breadcrumb">
            <ul>
               <li><a href="{{ route('admin.home') }}">Dashboard</a></li>
               <li class="separator icon-angle-right icon-notext"></li>
               <li><a href="{{ route('admin.stocks.index') }}" class="text-orange">Entradas</a></li>
            </ul>
         </nav>
      </div>
   </header>

   @include('admin.properties.filter')

   <div class="dash_content_app_box">

      <div class="nav">

         @if(session()->exists('message'))
            @message(['color' => session()->get('color')])
               <p class="icon-asterisk">{{ session()->get('message') }}</p>
            @endmessage
         @endif

         <ul class="nav_tabs">
            <li class="nav_tabs_item">
               <a href="#data" class="nav_tabs_item_link active">Dados da Entrada</a>
            </li>
         </ul>

         @if(! isset($stock))
            <form action="{{ route('admin.stocks.store') }}" method="post" class="app_form" enctype="multipart/form-data">
         @else
            <form action="{{ route('admin.stocks.update', ['stock' => $stock->id]) }}" method="post" class="app_form" enctype="multipart/form-data">
               @method('PUT')
         @endif
            @csrf
            <div class="nav_tabs_content">
               <div id="data">
                  <div class="label">
                     <label class="label">
                        <span class="legend">Produto:</span>
                        <select name="product_id" class="select2">
                           <option value="">Selecione um produto</option>
                           @foreach ($products as $product)
                              <option value="{{ $product->id }}" {{ set_selected($product->id, old('product_id', $stock->product_id ?? null )) }}>
                                 {{ $product->category->name }} / {{ $product->brand->name }} / {{ $product->description }} / {{ $product->size }}
                              </option>
                           @endforeach
                        </select>
                     </label>
                  </div>

                  <div class="label_g2">
                     <label class="label">
                        <span class="legend">Quantidade:</span>
                        <input type="number" name="quantity" placeholder="quantidade do produto" value="{{ old('quantity', $stock->quantity ?? null ) }}" />
                        
                        @error('quantity')
                        <span class="message-color" role="alert">
                           <p class="icon-asterisk">{{ $message }}</p>
                        </span>
                        @enderror
                     </label>

                     <label class="label">
                        <span class="legend">Preço:</span>
                        <input type="text" name="price" class="mask-money" value="{{ old('price', $stock->price ?? null) }}" />

                        @error('price')
                        <span class="message-color" role="alert">
                           <p class="icon-asterisk">{{ $message }}</p>
                        </span>
                        @enderror
                     </label>
                  </div>
               </div>
            </div>

            <div class="text-right mt-2">
               <button class="btn btn-large btn-green icon-check-square-o" type="submit">Salvar Entrada</button>
            </div>
         </form>
      </div>
   </div>
</section>
@endsection
