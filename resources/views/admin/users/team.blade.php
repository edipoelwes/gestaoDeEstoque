@extends('admin.master.master')

@section('content')
<section class="dash_content_app">

  <header class="dash_content_app_header">
    <h2 class="icon-users">Time</h2>

    <div class="dash_content_app_header_actions">
      <nav class="dash_content_app_breadcrumb">
        <ul>
          <li><a href="{{ route('home') }}">Dashboard</a></li>
          <li class="separator icon-angle-right icon-notext"></li>
          <li><a href="#" class="text-orange">Time</a></li>
        </ul>
      </nav>

      <a href="{{ route('users.create') }}" class="btn btn-orange icon-user-plus ml-1">Criar Usuário</a>
    </div>
  </header>

  <div class="dash_content_app_box">
    <section class="app_users_home">
      @foreach ($users as $user)
      <article class="user radius">
        <div class="cover" style="background-size: cover; background-image: url({{ $user->url_cover }});">
        </div>
        <h4>{{ $user->name }}</h4>

        <div class="info">
          <p>{{ $user->email }}</p>
          <p>Desde {{ date('d/m/Y', strtotime($user->created_at)) }}</p>
          @if($user->last_login_at)
          <p>Ultimo login {{ date('d/m/Y', strtotime($user->last_login_at))  }}</p>
          @endif
        </div>

        <div class="actions">
          <a class="icon-cog btn btn-orange" href="{{ route('users.edit', ['user'=>$user->id]) }}">Gerenciar</a>
        </div>
      </article>
      @endforeach
    </section>
  </div>
</section>
@endsection
