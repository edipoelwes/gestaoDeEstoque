@extends('admin.master.master')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/badge.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/tables.css') }}">
@endpush

@section('content')
<section class="dash_content_app">
   <header class="dash_content_app_header">
      <h2 class="icon-search">
         {{ isset($purchase->id) ? 'Editar Compra' : 'Lançar Nova Compra' }}
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

   <div class="dash_content_app_box">
      <div class="nav">

         <ul class="nav_tabs">
            <li class="nav_tabs_item">
               <a href="#data" class="nav_tabs_item_link active">Dados da Compra</a>
            </li>
         </ul>

         @if(! isset($purchase))
         <form action="{{ route('purchases.store') }}" method="post" class="app_form" enctype="multipart/form-data">
            @else
            <form action="{{ route('purchases.update', ['purchase' => $purchase->id]) }}" method="post" class="app_form"
               enctype="multipart/form-data">
               @method('PUT')
               @endif
               @csrf
               <div class="nav_tabs_content">
                  <div id="data">
                     <div class="label_g4">
                        <label class="label">
                           <span class="legend">Forma de Pagamento:</span>
                           <select name="payment_method" class="select2">
                              <option value="">Selecione a forma de pagamento</option>
                              @foreach ($payments as $payment)
                              <option value="{{ $payment->id }}"{{ set_selected($payment->id, old('payment_method', $purchase->id ?? null)) }}>
                                 {{ $payment->name }}
                              </option>
                              @endforeach
                           </select>
                        </label>

                        <label class="label">
                           <span class="legend">Status:</span>
                           <select name="status" class="select2">
                              <option value="">Selecione o status da venda...</option>
                              @foreach ($status as $item)
                              <option value="{{ $item->id }}"{{ set_selected($item->id, old('status', $purchase->id ?? null)) }}>
                                 {{ $item->name }}
                              </option>
                              @endforeach
                           </select>
                        </label>

                        <label class="label">
                           <span class="legend">Total:</span>
                           <input type="text" name="total" class="mask-money" disabled
                              value="{{ old('total', $product->total ?? null) }}" />

                           @error('total')
                           <span class="message-color" role="alert">
                              <p class="icon-asterisk">{{ $message }}</p>
                           </span>
                           @enderror
                        </label>
                     </div>

                     <div class="label">
                        <label class="label">
                           <span class="legend">Fornecedores:</span>
                           <input type="text" name="provider" value="{{ old('provider', $product->provider ?? null) }}" />
                        </label>
                     </div>

                     <label class="label">
                        <span class="legend">Observações:</span>
                        <textarea name="obs" id="" cols="30"
                           rows="10">{{ old('obs', $sale->obs ?? null) }}</textarea>

                        @error('obs')
                        <span class="message-color" role="alert">
                           <p class="icon-asterisk">{{ $message }}</p>
                        </span>
                        @enderror
                     </label>
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

</script>

<script src="{{ asset('assets/js/purchase.js') }}"></script>

@endpush
