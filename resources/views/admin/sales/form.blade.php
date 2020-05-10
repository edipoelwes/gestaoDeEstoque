@extends('admin.master.master')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/badge.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/tables.css') }}">
@endpush

@section('content')
<section class="dash_content_app">
   <header class="dash_content_app_header">
      <h2 class="icon-search">
         {{ isset($sale->id) ? 'Editar Pedido' : 'Lançar Novo Pedido' }}
      </h2>

      <div class="dash_content_app_header_actions">
         <nav class="dash_content_app_breadcrumb">
            <ul>
               <li><a href="{{ route('home') }}">Dashboard</a></li>
               <li class="separator icon-angle-right icon-notext"></li>
               <li><a href="{{ route('sales.index') }}" class="text-orange">Pedidos</a></li>
               <li class="separator icon-angle-right icon-notext"></li>
               <li><a href="{{ route('clients.create') }}" class="text-blue">Criar Cliente</a></li>
            </ul>
         </nav>
      </div>
   </header>

   {{-- @include('admin.properties.filter') --}}

   <div class="dash_content_app_box">
      <div class="nav">
         @if(session()->exists('message'))
         @message(['color' => session()->get('color')])
         <p class="icon-asterisk">{{ session()->get('message') }}</p>
         @endmessage
         @endif

         <ul class="nav_tabs">
            <li class="nav_tabs_item">
               <a href="#data" class="nav_tabs_item_link active">Dados do Pedido</a>
            </li>
         </ul>

         @if(! isset($sale))
         <form action="{{ route('sales.store') }}" method="post" class="app_form" enctype="multipart/form-data">
            @else
            <form action="{{ route('sales.update', ['sale' => $sale->id]) }}" method="post" class="app_form"
               enctype="multipart/form-data">
               @method('PUT')
               @endif
               @csrf
               <div class="nav_tabs_content">
                  <div id="data">
                     <div class="label_g2">
                        <label class="label">
                           <span class="legend">Cliente:</span>
                           <select name="client_id" class="select2">
                              <option value="">Selecione um Cliente</option>
                              @foreach ($clients as $client)
                              <option value="{{ $client->id }}" {{ set_selected($client->id, old('client_id')) }}>
                                 {{ $client->name }} ({{ $client->document }})</option>
                              @endforeach
                           </select>
                        </label>
                     </div>

                     <label class="label">
                        <span class="legend">Descrição:</span>
                        <textarea name="description" id="" cols="30"
                           rows="10">{{ old('description', $sale->description ?? null) }}</textarea>

                        @error('description')
                        <span class="message-color" role="alert">
                           <p class="icon-asterisk">{{ $message }}</p>
                        </span>
                        @enderror
                     </label>

                     <div class="label_g2">
                        <label class="label">
                           <span class="legend">Total:</span>
                           <input type="text" name="total_price" class="mask-money" disabled
                              value="{{ old('total_price', $product->total_price ?? null) }}" />

                           @error('total_price')
                           <span class="message-color" role="alert">
                              <p class="icon-asterisk">{{ $message }}</p>
                           </span>
                           @enderror
                        </label>

                        <label class="label">
                           <span class="legend">Status:</span>
                           <select name="status" class="select2">
                              <option value="">Selecione o status da venda</option>
                              <option value="0">Pendente</option>
                              <option value="1">Confirmado</option>
                              <option value="1">Cancelado</option>
                           </select>
                        </label>
                     </div>
                  </div>
                  <br><br>

                  <div class="nav_tabs_content">
                     <h2>Adicionar Produtos</h2>
                     <br><br>

                     <div class="label_g2">
                        <label class="label">
                           <span class="legend">Id produto:</span>
                           <input type="text" id="add_prod" data-type="search-products" autocomplete="off" />
                        </label>
                     </div>
                     <br><br>

                     <table id="products_table" class="table table-striped table-bordered">
                        <thead>
                        <tr class="table-active">
                           <th>#</th>
                           <th>Nome do Produto</th>
                           <th>Quant.</th>
                           <th>Preço Unit.</th>
                           <th>Sub-Total</th>
                           <th>Excluir</th>
                        </tr>
                     </thead>
                     <tbody>

                     </tbody>
                     </table>
                  </div>
               </div>
      </div>

      @if ( isset($sale))
      <div class="text-right mt-2">
         <button class="btn btn-large btn-green icon-check-square-o" type="submit">Atualizar Pedido</button>
      </div>
      @else
      <div class="text-right mt-2">
         <button class="btn btn-large btn-green icon-check-square-o" type="submit">Salvar Pedido</button>
      </div>
      @endif
      </form>
   </div>
</section>
@endsection



@push('js')

<script type="text/javascript">
   var BASE_URL = {!! json_encode(url('/')) !!};

   console.log(BASE_URL);
</script>

<script src="{{ asset('assets/js/productsAjax.js') }}"></script>


@endpush
