@extends('admin.master.master')

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

    {{-- @include('admin.users.filter') --}}

    <div class="dash_content_app_box">
        <div class="dash_content_app_box_stage">
            <table id="dataTable" class="nowrap stripe" width="100" style="width: 100% !important;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <th>Preço</th>
                        <th>SubTotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($details as $detail)
                    <tr>
                        <td>{{ $detail->id }}</td>
                        <td><a href="{{ route('admin.sales.edit', ['sale' => $detail->id]) }}"
                                class="text-orange">
                                {{ $detail->product->category->name }} / {{ $detail->product->brand->name }} /
                                {{ $detail->product->description }} / {{ $detail->product->size }}</a>
                        </td>
                        <td>{{ $detail->amount }}</td>
                        <td>R$ {{ money_br($detail->unitary_price) }}</td>
                        <td>R$ {{ money_br($detail->amount * $detail->unitary_price) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection
