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
                    <li><a href="{{ route('admin.users.index') }}" class="text-orange">Clientes</a></li>
                </ul>
            </nav>

            <a href="{{ route('admin.users.create') }}" class="btn btn-orange icon-user ml-1">Criar Cliente</a>
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
                        <th>Categoria</th>
                        <th>Descrição</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td><a href="{{ route('admin.categories.edit', ['category' => $category->id]) }}" class="text-orange">
                                {{ $category->name  }}</a></td>
                        <td>{{ $category->description }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection