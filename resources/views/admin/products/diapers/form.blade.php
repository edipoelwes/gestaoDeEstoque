@extends('admin.master.master')

@section('content')
<section class="dash_content_app">

  <header class="dash_content_app_header">
    <h2 class="icon-search">
      {{ isset($diaper->id) ? 'Editar Produto' : 'Cadastrar Novo Produto' }}
    </h2>

    <div class="dash_content_app_header_actions">
      <nav class="dash_content_app_breadcrumb">
        <ul>
          <li><a href="{{ route('admin.home') }}">Dashboard</a></li>
          <li class="separator icon-angle-right icon-notext"></li>
          <li><a href="{{ route('admin.diapers.index') }}">Produtos</a></li>
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
          <a href="#data" class="nav_tabs_item_link active">Dados Cadastrais</a>
        </li>
        <li class="nav_tabs_item">
          <a href="#images" class="nav_tabs_item_link">Imagens</a>
        </li>
      </ul>

      @if(! isset($diaper))
      <form action="{{ route('admin.diapers.store') }}" method="post" class="app_form" enctype="multipart/form-data">
        @else
        <form action="{{ route('admin.diapers.update', ['diaper' => $diaper->id]) }}" method="post" class="app_form"
          enctype="multipart/form-data">
          @method('PUT')
          @endif
          @csrf
          <div class="nav_tabs_content">
            <div id="data">
              <div class="label_g2">
                <label class="label">
                  <span class="legend">Categoria:</span>
                  <select name="category_id" class="select2">
                    <option value="{{ $category->id }}"
                      {{ set_selected($category->id, old('category_id', $diaper->category_id ?? null)) }}>
                      {{ $category->name }}</option>
                  </select>
                </label>
                <label class="label">
                  <span class="legend">Marca:</span>
                  <select name="brand_id" class="select2">
                    <option value="">Selecione uma marca</option>
                    @foreach ($brands as $brand)
                    <option value="{{ $brand->id }}"
                      {{ set_selected($brand->id, old('brand_id', $diaper->brand_id ?? null)) }}>{{ $brand->name }}
                    </option>
                    @endforeach
                  </select>
                </label>
              </div>

              <label class="label">
                <span class="legend">Descrição:</span>
                <input type="text" name="description" placeholder="modelo do produto" autocomplete="off"
                  value="{{ old('description', $diaper->description ?? null) }}" />

                @error('description')
                <span class="message-color" role="alert">
                  <p class="icon-asterisk">{{ $message }}</p>
                </span>
                @enderror
              </label>

              <div class="label_g2">
                <label class="label">
                  <span class="legend">Tamanho:</span>
                  <select name="size" class="select2">
                    <option value="">Selecione o tamanho</option>
                    @foreach ($sizes as $size)
                    <option value="{{ $size }}" {{ set_selected($size, old('size', $diaper->size ?? null)) }}>
                      {{ $size }}</option>
                    @endforeach
                  </select>
                </label>

                <label class="label">
                  <span class="legend">Preço:</span>
                  <input type="text" name="price" class="mask-money"
                    value="{{ old('price', $diaper->price ?? null) }}" />

                  @error('price')
                  <span class="message-color" role="alert">
                    <p class="icon-asterisk">{{ $message }}</p>
                  </span>
                  @enderror
                </label>
              </div>
            </div>

            <div id="images" class="d-none">
              <label class="label">
                <span class="legend">Imagens</span>
                <input type="file" name="files[]" multiple>
              </label>

              <div class="content_image"></div>
            </div>
          </div>

          <div class="text-right mt-2">
            <button class="btn btn-large btn-green icon-check-square-o" type="submit">Salvar Produto</button>
          </div>
        </form>
    </div>
  </div>
</section>
@endsection
@section('js')
<script>
  $(function () {
        $('input[name="files[]"]').change(function (files) {

            $('.content_image').text('');

            $.each(files.target.files, function (key, value) {
                var reader = new FileReader();
                reader.onload = function (value) {
                    $('.content_image').append(
                        '<div class="property_image_item">' +
                        '<div class="embed radius" ' +
                        'style="background-image: url(' + value.target.result + '); background-size: cover; background-position: center center;">' +
                        '</div>' +
                        '</div>');
                };
                reader.readAsDataURL(value);
            });
        });
    });
</script>
@endsection
