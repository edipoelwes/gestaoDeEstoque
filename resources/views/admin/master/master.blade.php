<!DOCTYPE html>
<html lang="pt-br">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0">

   <link rel="stylesheet" href="{{ asset('assets/css/reset.css') }}" />
   <link rel="stylesheet" href="{{ asset('assets/css/libs.css') }}">
   <link rel="stylesheet" href="{{ asset('assets/css/boot.css') }}" />
   <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
   <link rel="stylesheet" href="{{ asset('assets/css/badge.css') }}">
   <link rel="stylesheet" href="{{ asset('assets/css/tables.css') }}">

   @stack('styles')

   <link rel="icon" type="image/png" href="#" />

   <meta name="csrf-token" content="{{ csrf_token() }}">


   <title>Site Control</title>
</head>

<body>
   @include('sweetalert::alert')

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
            <img class="dash_sidebar_user_thumb"
               src="{{ url(asset('assets/images/avatar.jpg')) }}" alt="" title="" />

            <h1 class="dash_sidebar_user_name">
               <a href="">{{ Auth::user()->name }}</a>
            </h1>
         </article>

         <ul class="dash_sidebar_nav">
            <li class="dash_sidebar_nav_item {{ isActive('home') }}">
               <a class="icon-tachometer" href="{{ route('home') }}">Dashboard</a>
            </li>


            @can('Visualizar Configurações')
               <li
                  class="dash_sidebar_nav_item {{ isActive('permissions') }} {{ isActive('roles') }}
                  {{ isActive('root') }} {{ isActive('companies') }} {{ isActive('categories') }}">

                  <a class="icon-cogs" href="javascript:;">Configurações</a>
                  <ul class="dash_sidebar_nav_submenu">
                     <li class="{{ isActive('root.companies.index') }}"><a
                           href="{{ route('root.companies.index') }}">Empresas</a>
                     </li>
                     <li class="{{ isActive('root.users.index') }}"><a
                           href="{{ route('root.users.index') }}">Usuarios</a></li>
                     <li class="{{ isActive('categories.index') }}"><a
                           href="{{ route('categories.index') }}">Categorias</a></li>
                     @can('Visualizar Perfil')
                        <li class="{{ isActive('roles.index') }}"><a
                              href="{{ route('roles.index') }}">Perfil</a></li>
                     @endcan

                     @can('Visualizar Permissões')
                        <li class="{{ isActive('permissions.index') }}"><a
                              href="{{ route('permissions.index') }}">Permissões</a></li>
                     @endcan
                     <li><a href="{{ route('icons') }}">Icons</a></li>
                  </ul>
               </li>
            @endcan


            @can('Visualizar Usuarios')
               <li class="dash_sidebar_nav_item {{ isActive('users') }}">
                  <a class="icon-user" href="{{ route('users.index') }}">Usuarios</a>
                  <ul class="dash_sidebar_nav_submenu">
                     <li class="{{ isActive('users.index') }}"><a
                           href="{{ route('users.index') }}">
                           Ver Todos</a></li>
                     <li class="{{ isActive('users.company') }}"><a
                           href="{{ route('users.company') }}">Empresas</a>
                     </li>
                     <li class="{{ isActive('users.team') }}"><a
                           href="{{ route('users.team') }}">Time</a></li>
                  </ul>
               </li>
            @endcan

            @can('Visualizar Clientes')
               <li class="dash_sidebar_nav_item {{ isActive('clients') }}"><a class="icon-users"
                     href="{{ route('clients.index') }}">Clientes</a>
                  <ul class="dash_sidebar_nav_submenu">
                     <li class="{{ isActive('clients.index') }}"><a
                           href="{{ route('clients.index') }}">Ver Todos</a></li>
                     <li class="{{ isActive('clients.create') }}"><a
                           href="{{ route('clients.create') }}">Criar Novo</a></li>
                  </ul>
               </li>
            @endcan

            @can('Visualizar Produtos')
               <li class="dash_sidebar_nav_item {{ isActive('inventories') }}">
                  <a class="icon-home" href="{{ route('inventories.index') }}">Produtos</a>
                  <ul class="dash_sidebar_nav_submenu">
                     <li class="{{ isActive('inventories.index') }}"><a
                           href="{{ route('inventories.index') }}">Fraldas</a>
                     </li>
                     @can('Cadastrar Produto')
                        <li class="{{ isActive('inventories.create') }}"><a
                              href="{{ route('inventories.create') }}">Criar
                              Novo</a></li>
                     @endcan
                  </ul>
               </li>
            @endcan

            <li class="dash_sidebar_nav_item {{ isActive('sales') }}">
               <a class="icon-cart-plus" href="{{ route('sales.index') }}">Vendas</a>
               <ul class="dash_sidebar_nav_submenu">
                  <li class="{{ isActive('sales.index') }}"><a
                        href="{{ route('sales.index') }}">Vendas</a></li>
                  <li class="{{ isActive('sales.create') }}"><a
                        href="{{ route('sales.create') }}">Criar Novo</a></li>
               </ul>
            </li>

            @can('Visualizar Compras')
               <li class="dash_sidebar_nav_item {{ isActive('purchases') }} {{ isActive('expenses') }}">
                  <a class="icon-shopping-cart" href="javascript:;">Despesas</a>
                  <ul class="dash_sidebar_nav_submenu">
                     <li class="{{ isActive('purchases.index') }}"><a
                           href="{{ route('purchases.index') }}">Compras</a>
                     </li>
                     <li class="{{ isActive('expenses.index') }}"><a
                           href="{{ route('expenses.index') }}">Outras Saidas</a>
                     </li>
                  </ul>
               </li>
            @endcan

            @can('Visualizar Relatorios')
               <li class="dash_sidebar_nav_item {{ isActive('reports') }}"><a class="icon-file-text"
                     href="{{ route('reports.index') }}">Relatorios</a>
                  <ul class="dash_sidebar_nav_submenu">
                     <li class="{{ isActive('reports.index') }}"><a
                           href="{{ route('reports.index') }}">Opções de
                           Relatorios</a></li>
                  </ul>
               </li>
            @endcan



            <li class="dash_sidebar_nav_item"><a class="icon-reply" href="">Ver Site</a></li>
            <li class="dash_sidebar_nav_item"><a class="icon-sign-out on_mobile"
                  href="{{ route('logout') }}">Sair</a>
            </li>


         </ul>

      </aside>

      <section class="dash_content">

         <div class="dash_userbar">
            <div class="dash_userbar_box">
               <div class="dash_userbar_box_content">
                  <span class="icon-align-justify icon-notext mobile_menu transition btn btn-green"></span>
                  <h1 class="transition">
                     <i class="icon-smile-o text-orange"></i><a
                        href="{{ route('home') }}">Sonhosde<b>Ninar</b></a>
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
   <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}" defer></script>
   <script src="{{ asset('assets/js/functions.js') }}" defer></script>

   <script type="text/javascript">
      var BASE_URL = {!! json_encode(url('/')) !!};

      console.log(BASE_URL);
   </script>

   @stack('js')
</body>

</html>
