@extends('admin.master.master')

@section('content')
<section class="dash_content_app">
   <header class="dash_content_app_header">
      <h2 class="icon-search">
         {{ isset($expense->id) ? 'Editar Retirada' : 'Lançar Nova Retirada' }}
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
               <a href="#data" class="nav_tabs_item_link active">Dados da Retirada</a>
            </li>
         </ul>

         @if(! isset($expense))
            <form action="{{ route('expenses.store') }}" method="post" class="app_form"
               enctype="multipart/form-data">
            @else
               <form
                  action="{{ route('expenses.update', ['expense' => $expense->id]) }}"
                  method="post" class="app_form" enctype="multipart/form-data">
                  @method('PUT')
         @endif
         @csrf
         <div class="nav_tabs_content">
            <div id="data">

               <label class="label">
                  <span class="legend">Nome:</span>
                  <input type="text" name="name"
                     value="{{ old('name', $expense->name ?? null) }}" />
               </label>

               <div class="label_g4">
                  <label class="label">
                     <span class="legend">Valor:</span>
                     <input type="text" name="value" class="mask-money"
                        value="{{ old('value', $expense->value ?? null) }}" />

                     @error('value')
                        <span class="message-color" role="alert">
                           <p class="icon-asterisk">{{ $message }}</p>
                        </span>
                     @enderror
                  </label>

                  <label class="label">
                     <span class="legend">Data da Retirada:</span>
                     <input type="date" name="due_date"
                        value="{{ old('due_date', $expense->due_date ?? null) }}" />
                  </label>

                  <label class="label">
                     <span class="legend">Status:</span>
                     <select name="status" class="select2">
                        <option value="">Selecione o status da venda</option>
                        <option value="1">Confirmado</option>
                        <option value="2">Pendente</option>
                     </select>
                  </label>
               </div>

               <label class="label">
                  <span class="legend">Observações:</span>
                  <textarea name="description" id="" cols="30"
                     rows="10">{{ old('description', $expense->description ?? null) }}</textarea>

                  @error('description')
                     <span class="message-color" role="alert">
                        <p class="icon-asterisk">{{ $message }}</p>
                     </span>
                  @enderror
               </label>
            </div>

         </div>
      </div>

      @if( isset($expense))
         <div class="text-right mt-2">
            <button class="btn btn-large btn-green icon-check-square-o" type="submit">Atualizar Atualizar</button>
         </div>
      @else
         <div class="text-right mt-2">
            <button class="btn btn-large btn-green icon-check-square-o" type="submit">Salvar Retirada</button>
         </div>
      @endif
      </form>
   </div>
</section>
@endsection
