@extends('admin.master.master')

@section('content')
<section class="dash_content_app">

   <header class="dash_content_app_header">
      <h2 class="icon-search">
         Permissões para {{ $role->name }}
      </h2>

      <div class="dash_content_app_header_actions">
         <nav class="dash_content_app_breadcrumb">
            <ul>
               <li><a href="{{ route('home') }}">Dashboard</a></li>
               <li class="separator icon-angle-right icon-notext"></li>
               <li><a href="{{ route('roles.index') }}">Perfil</a></li>
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


         <form action="{{ route('roles.permissionSync', ['role' => $role->id]) }}" method="post" class="app_form" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="nav_tabs_content">
               @foreach ($permissions as $permission)
               <div>
                  <label class="label">
                     <input type="checkbox" id="{{ $permission->id }}" name="{{ $permission->id }}" {{ ($permission->can == 1 ? 'checked' : '') }}><span>{{ $permission->name }}</span>
                 </label>
               </div>
               @endforeach

            </div>
            <div class="text-left mt-2">
               <button class="btn btn-large btn-green icon-check-square-o" type="submit">Sincronizar Perfil</button>
            </div>

         </form>
      </div>
   </div>
</section>
@endsection
