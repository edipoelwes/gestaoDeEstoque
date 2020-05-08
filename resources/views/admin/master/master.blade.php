<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0">

  <link rel="stylesheet" href="{{ asset('assets/css/reset.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/libs.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/boot.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />

  @stack('styles')

  <link rel="icon" type="image/png" href="#" />

  <meta name="csrf-token" content="{{ csrf_token() }}">


  <title>Site Control</title>
</head>

<body>

  <div class="ajax_load">
    <div class="ajax_load_box">
      <div class="ajax_load_box_circle"></div>
      <p class="ajax_load_box_title">Aguarde, carregando...</p>
    </div>
  </div>

  <div class="ajax_response"></div>

  <div class="dash">
    <aside class="dash_sidebar">
      <article class="dash_sidebar_user">
        <img class="dash_sidebar_user_thumb" src="{{ url(asset('assets/images/avatar.jpg')) }}" alt="" title="" />

        <h1 class="dash_sidebar_user_name">
          <a href="">Edipo Elwes</a>
        </h1>
      </article>

      <ul class="dash_sidebar_nav">
        <li class="dash_sidebar_nav_item {{ isActive('home') }}">
          <a class="icon-tachometer" href="{{ route('home') }}">Dashboard</a>
        </li>

        <li class="dash_sidebar_nav_item {{ isActive('users') }} {{ isActive('companies') }}"><a class="icon-user"
            href="{{ route('users.index') }}">Usuarios</a>
          <ul class="dash_sidebar_nav_submenu">
            <li class="{{ isActive('users.index') }}"><a href="{{ route('users.index') }}">
                Ver Todos</a></li>
            <li class="{{ isActive('companies.index') }}"><a href="{{ route('companies.index') }}">Empresas</a></li>
            <li class="{{ isActive('users.team') }}"><a href="{{ route('users.team') }}">Time</a></li>
            <li class="{{ isActive('users.create') }}"><a href="{{ route('users.create') }}">Criar
                Novo</a></li>
          </ul>
        </li>

        <li class="dash_sidebar_nav_item {{ isActive('clients') }}"><a class="icon-users"
            href="{{ route('clients.index') }}">Clientes</a>
          <ul class="dash_sidebar_nav_submenu">
            <li class="{{ isActive('clients.index') }}"><a href="{{ route('clients.index') }}">Ver
                Todos</a></li>
            <li class="{{ isActive('clients.create') }}"><a href="{{ route('clients.create') }}">Criar
                Novo</a></li>
          </ul>
        </li>

        <li class="dash_sidebar_nav_item {{ isActive('inventories') }}">
          <a class="icon-home" href="{{ route('inventories.index') }}">Produtos</a>
          <ul class="dash_sidebar_nav_submenu">
            <li class="{{ isActive('inventories.index') }}"><a href="{{ route('inventories.index') }}">Fraldas</a></li>
            <li class="{{ isActive('inventories.create') }}"><a href="{{ route('inventories.create') }}">Criar Novo</a></li>
          </ul>
        </li>

        <li class="dash_sidebar_nav_item {{ isActive('sales') }}">
          <a class="icon-home" href="{{ route('sales.index') }}">Vendas</a>
          <ul class="dash_sidebar_nav_submenu">
            <li class="{{ isActive('sales.index') }}"><a href="{{ route('sales.index') }}">Vendas</a></li>
            <li class="{{ isActive('sales.create') }}"><a href="{{ route('sales.create') }}">Criar Novo</a></li>
          </ul>
        </li>

        {{-- <li class="dash_sidebar_nav_item {{ isActive('admin.stocks') }}"><a class="icon-home"
          href="{{ route('admin.stocks.index') }}">Entrada</a>
        <ul class="dash_sidebar_nav_submenu">
          <li class="{{ isActive('admin.stocks.index') }}"><a href="{{ route('admin.stocks.index') }}">Ver
              Todos</a></li>
          <li class="{{ isActive('admin.stocks.create') }}"><a href="{{ route('admin.stocks.create') }}">Criar Novo</a>
          </li>
        </ul>
        </li> --}}

        {{-- <li class="dash_sidebar_nav_item {{ isActive('admin.sales') }}"><a class="icon-home"
          href="{{ route('admin.stocks.index') }}">Vendas</a>
        <ul class="dash_sidebar_nav_submenu">
          <li class="{{ isActive('admin.sales.index') }}"><a href="{{ route('admin.sales.index') }}">Ver
              Todos</a></li>
          <li class="{{ isActive('admin.sales.create') }}"><a href="{{ route('admin.sales.create') }}">Criar Novo</a>
          </li>
        </ul>
        </li> --}}

        <li class="dash_sidebar_nav_item"><a class="icon-file-text"
            href="dashboard.php?app=contracts/index">Contratos</a>
          <ul class="dash_sidebar_nav_submenu">
            <li class=""><a href="dashboard.php?app=contracts/index">Ver Todos</a></li>
            <li class=""><a href="dashboard.php?app=contracts/create">Criar Novo</a></li>
          </ul>
        </li>
        <li class="dash_sidebar_nav_item"><a class="icon-reply" href="">Ver Site</a></li>
        <li class="dash_sidebar_nav_item"><a class="icon-sign-out on_mobile" href="{{ route('logout') }}">Sair</a></li>
      </ul>

    </aside>

    <section class="dash_content">

      <div class="dash_userbar">
        <div class="dash_userbar_box">
          <div class="dash_userbar_box_content">
            <span class="icon-align-justify icon-notext mobile_menu transition btn btn-green"></span>
            <h1 class="transition">
              <i class="icon-imob text-orange"></i><a href="{{ route('home') }}">Sonhosde<b>Ninar</b></a>
            </h1>
            <div class="dash_userbar_box_bar no_mobile">
              <a class="text-red icon-sign-out" href="{{ route('logout') }}">Sair</a>
            </div>
          </div>
        </div>
      </div>

      <div class="dash_content_box">
        @yield('content')
      </div>
    </section>
  </div>

  <script src="{{ asset('assets/js/jquery.js') }}"></script>
  <script src="{{ asset('assets/js/libs.js') }}"></script>
  <script src="{{ asset('assets/js/scripts.js') }}"></script>

  @stack('js')
</body>

</html>
