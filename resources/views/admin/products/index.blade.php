@extends('admin.master.master')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/badge.css') }}">
@endpush

@section('content')

<section class="dash_content_app">
   <header class="dash_content_app_header">
      <h2 class="icon-search">Filtro</h2>

      <div class="dash_content_app_header_actions">
         <nav class="dash_content_app_breadcrumb">
            <ul>
               <li><a href="{{ route('home') }}">Dashboard</a></li>
               <li class="separator icon-angle-right icon-notext"></li>
               <li><a href="{{ route('inventories.index') }}" class="text-orange">Produtos</a></li>
            </ul>
         </nav>

         <a href="{{ route('inventories.create') }}" class="btn btn-orange icon-user ml-1">Cadastrar Produto</a>

      </div>
   </header>

   <div class="dash_content_app_box">
      <div class="dash_content_app_box_stage">
         <table id="dataTable" class="nowrap stripe" width="100" style="width: 100% !important;">
            <thead>
               <tr>
                  <th>#</th>
                  <th>Produto</th>
                  <th>Quant.</th>
                  <th>Preço</th>
                  <th>Quant. Min</th>
                  <th class="text-center">Ações</th>
               </tr>
            </thead>
            <tbody>
               @foreach ($products as $product)
               <tr>
                  <td>{{ $product->id }}</td>
                  <td><a href="{{ route('inventories.edit', ['inventory' => $product->id]) }}" class="text-orange">
                        {{ $product->name }}</a>
                  </td>
                  <td class="badge badge-pill {{ ($product->amount > $product->min_amount + 3 ? 'badge-success' :
              ($product->amount < $product->min_amount ? 'badge-danger' : 'badge-warning')) }}">{{ $product->amount }}
                  </td>
                  <td>R$ {{ money_br($product->price) }}</td>
                  <td class="badge badge-pill badge-primary">{{ $product->min_amount }}</td>

                  <td>

                     @can('Editar Produto')
                     <a href="{{ route('inventories.edit', ['inventory' => $product->id]) }}" class="text-blue icon-pencil-square-o"
                     title="Editar Usuário">
                     </a>
                     @endcan

                     @can('Deletar Produto')
                     <a href="javascript:;" class="text-orange icon-trash" onclick="confirmDelete({{ $product->id }})"
                        title="Excluir Usuário">
                     </a>
                     @endcan

                     <form id="btn-delete-{{ $product->id }}"
                        action="{{ route('inventories.destroy', ['inventory' => $product->id]) }}" method="post"
                        class="hidden">
                        @method('DELETE')
                        @csrf
                     </form>
                  </td>

               </tr>
               @endforeach
            </tbody>
         </table>
      </div>
   </div>
</section>
@endsection

@push('js')
<script src="{{ asset('assets/js/functions.js') }}" defer></script>
@endpush
