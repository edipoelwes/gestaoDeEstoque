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

            <a href="{{ route('admin.diapers.create') }}" class="btn btn-orange icon-user ml-1">Criar Produto</a>

            <a href="{{ route('admin.stocks.create') }}" class="btn btn-blue icon-user ml-1">Entrada de Produto</a>
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
                        {{-- <th>Tamanho</th> --}}
                        <th>Quantidade</th>
                        {{-- <th>Media de Custo</th> --}}
                        <th>Preço</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($diapers as $diaper)
                    <tr>
                        <td>{{ $diaper->id }}</td>
                        <td><a href="{{ route('admin.diapers.edit', ['diaper' => $diaper->id]) }}"
                                class="text-orange">
                                {{ $diaper->category->name }} / {{ $diaper->brand->name }} / {{ $diaper->description  }} / {{ $diaper->size }}</a>
                        </td>

                        @php
                        $quantity = ($diaper->stocks->sum('quantity') - $diaper->saleItens->sum('amount'));
                        @endphp

                        <td class="badge badge-pill
                        {{ ($quantity > 4 ? 'badge-success' : ($quantity == 0 ? 'badge-danger' : 'badge-warning')) }}">
                            {{ $quantity }}</td>
                        {{-- <td>R$ {{ money_br($diaper->stocks->avg('price')) }}</td> --}}
                        <td>R$ {{ $diaper->price }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection
