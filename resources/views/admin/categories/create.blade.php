@extends('admin.master.master')

@section('content')
    

<section class="dash_content_app">

    <header class="dash_content_app_header">
        <h2 class="icon-search">Cadastrar Nova Categoria</h2>

        <div class="dash_content_app_header_actions">
            <nav class="dash_content_app_breadcrumb">
                <ul>
                    <li><a href="">Dashboard</a></li>
                    <li class="separator icon-angle-right icon-notext"></li>
                    <li><a href="" class="text-orange">Categoria</a></li>
                </ul>
            </nav>

            <button class="btn btn-green icon-search icon-notext ml-1 search_open"></button>
        </div>
    </header>

    @include('admin.categories.filter')
    
    <div class="dash_content_app_box">

        <div class="nav">
            <ul class="nav_tabs">
                <li class="nav_tabs_item">
                    <a href="#data" class="nav_tabs_item_link active">Dados Cadastrais</a>
                </li>
            </ul>

            <form action="{{ route('admin.categories.store') }}" method="post" class="app_form" enctype="multipart/form-data">

                @csrf

                <div class="nav_tabs_content">
                    <div id="data">
                        <div class="label">
                            <label class="label">
                                <span class="legend">*Categoria:</span>
                                <input type="text" name="name" placeholder="Nome da categoria" value="{{ old('name') }}" />
                            </label>
                        </div>
                        <div class="app_collapse">
                            <div class="app_collapse_header mt-2 collapse">
                                <h3>Características</h3>
                                <span class="icon-plus-circle icon-notext"></span>
                            </div>

                            <div class="app_collapse_content d-none">
                                <label class="label">
                                    <span class="legend">Descrição da Categoria:</span>
                                    <textarea name="description" cols="30" rows="10" >{{ old('description') }}</textarea>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-right mt-2">
                    <button class="btn btn-large btn-green icon-check-square-o">Criar Categoria</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection