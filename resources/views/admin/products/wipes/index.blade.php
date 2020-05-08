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
                    <li><a href="{{ route('admin.wipes.index') }}" class="text-orange">Produtos</a></li>
                </ul>
            </nav>

            <a href="{{ route('admin.wipes.create') }}" class="btn btn-orange icon-user ml-1">Criar Produto</a>
            
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
                        <th>Quantidade</th>
                        {{-- <th>Media de Custo</th> --}}
                        <th>Preço</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($wipes as $wipe)
                    <tr>
                        <td>{{ $wipe->id }}</td>
                        <td><a href="{{ route('admin.wipes.edit', ['wipe' => $wipe->id]) }}"
                                class="text-orange">
                                {{ $wipe->category->name }} / {{ $wipe->brand->name }} / {{ $wipe->description  }}</a>
                        </td>

                        @php
                            $quantity = $wipe->stocks->sum('quantity');
                        @endphp

                        <td class="badge badge-pill 
                        {{ ($quantity > 4 ? 'badge-success' : ($quantity == 0 ? 'badge-danger' : 'badge-warning')) }}">
                            {{ $quantity }}</td>
                        {{-- <td>R$ {{ money_br($wipe->stocks->avg('price')) }}</td> --}}
                        <td>R$ {{ $wipe->price }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection