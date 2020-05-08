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
                    <li><a href="{{ route('admin.home') }}">Dashboard</a></li>
                    <li class="separator icon-angle-right icon-notext"></li>
                    <li><a href="{{ route('admin.diapers.index') }}" class="text-orange">Produtos</a></li>
                </ul>
            </nav>

            <a href="{{ route('admin.stocks.create') }}" class="btn btn-orange icon-user ml-1">Nova Entrada</a>
            <button class="btn btn-green icon-search icon-notext ml-1 search_open"></button>
        </div>
    </header>

    @include('admin.users.filter')

    <div class="dash_content_app_box">
        <div class="dash_content_app_box_stage">
            <table id="dataTable" class="nowrap stripe" width="100" style="width: 100% !important;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <th>Preço de Custo</th>
                        <th>Data</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($stocks as $stock)
                    <tr>
                        <td>{{ $stock->id }}</td>
                        @php
                            $product = $stock->product->category->name. " / " .$stock->product->brand->name . " / " .$stock->product->description . " / " . $stock->product->size;
                        @endphp
                        <td><a href="{{ route('admin.stocks.edit', ['stock' => $stock->id]) }}" class="text-orange">
                            {{ $product }}</a></td>
                       
                        <td class="badge badge-pill badge-primary">{{ $stock->quantity }}</td>
                        <td>R$ {{ $stock->price }}</td>
                        <td>{{ date_br($stock->created_at) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection