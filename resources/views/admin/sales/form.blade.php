@extends('admin.master.master')

@section('content')
<section class="dash_content_app">
  <header class="dash_content_app_header">
    <h2 class="icon-search">
      {{ isset($sale->id) ? 'Editar Pedido' : 'Lançar Novo Pedido' }}
    </h2>

    <div class="dash_content_app_header_actions">
      <nav class="dash_content_app_breadcrumb">
        <ul>
          <li><a href="{{ route('admin.home') }}">Dashboard</a></li>
          <li class="separator icon-angle-right icon-notext"></li>
          <li><a href="{{ route('admin.sales.index') }}">Pedidos</a></li>
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
          <a href="#data" class="nav_tabs_item_link active">Dados do Pedido</a>
        </li>
      </ul>

      @if(! isset($sale))
      <form action="{{ route('admin.sales.store') }}" method="post" class="app_form" enctype="multipart/form-data">
        @else
        <form action="{{ route('admin.sales.update', ['sale' => $sale->id]) }}" method="post" class="app_form"
          enctype="multipart/form-data">
          @method('PUT')
          @endif
          @csrf
          <div class="nav_tabs_content">
            <div id="data">
              <div class="label_g2">
                <label class="label">
                  <span class="legend">Responsável:</span>
                  <select name="user_id" class="select2">
                    <option value="">Selecione um Responsável</option>
                    @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ set_selected($user->id, old('user_id')) }}>{{ $user->name }}
                    </option>
                    @endforeach
                  </select>
                </label>
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

              <div class="label">
                <label class="label">
                  <span class="legend">Pagamento:</span>
                  <select name="payment" class="select2">
                    <option value="">Selecione a situação do Pedido</option>
                    <option value="0">Pendente</option>
                    <option value="1">Confirmado</option>
                  </select>
                </label>
              </div>
            </div>
          </div>
          <div class="nav_tabs_content myTable">
            <div id="data">
              <div class="label_g2">
                <label class="label">

                </label>
              </div>
            </div>

            <button id="addItem" class="btn btn-blue">Inserir Produto</button>
          </div>

          <div class="text-right mt-2">
            <button class="btn btn-large btn-green icon-check-square-o" type="submit">Lançar Pedido</button>
          </div>
        </form>
    </div>
  </div>
</section>
