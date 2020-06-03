@extends('admin.master.master')

@section('content')
<section class="dash_content_app">

   <header class="dash_content_app_header">
      <h2 class="icon-search">
         Perfis de {{ $user->name }}
      </h2>

      <div class="dash_content_app_header_actions">
         <nav class="dash_content_app_breadcrumb">
            <ul>
               <li><a href="{{ route('home') }}">Dashboard</a></li>
               <li class="separator icon-angle-right icon-notext"></li>
               <li><a href="{{ route('users.index') }}">Usuários</a></li>
            </ul>
         </nav>
      </div>
   </header>

   <div class="dash_content_app_box">
      <div class="nav">
         <ul class="nav_tabs">
            <li class="nav_tabs_item">
               <a href="#data" class="nav_tabs_item_link active">Dados</a>
            </li>
         </ul>


         <form
            action="{{ route('users.rolesSync', ['user' => $user->id]) }}"
            method="post" class="app_form" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="nav_tabs_content">
               @foreach($roles as $role)
                  <div>
                     <label class="label">
                        @can('Super Usuario')
                           <input type="checkbox" id="{{ $role->id }}" name="{{ $role->id }}"
                              {{ ($role->can == 1 ? 'checked' : '') }}><span>{{ $role->name }}</span>
                        @else
                           @if($role->name != 'Desenvolvedor')
                              <input type="checkbox" id="{{ $role->id }}" name="{{ $role->id }}"
                                 {{ ($role->can == 1 ? 'checked' : '') }}><span>{{ $role->name }}</span>
                           @endif
                        @endcan
                     </label>
                  </div>
               @endforeach

            </div>
            <div class="text-left mt-2">
               <button class="btn btn-large btn-green icon-check-square-o" type="submit">Sincronizar Usuário</button>
            </div>

         </form>
      </div>
   </div>
</section>
@endsection
