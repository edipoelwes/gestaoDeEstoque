@extends('admin.master.master')

@section('content')
<section class="dash_content_app">
   <header class="dash_content_app_header">
      <h2>Retirada</h2>

      <div class="dash_content_app_header_actions">
         <nav class="dash_content_app_breadcrumb">
            <ul>
               <li><a href="{{ route('home') }}">Dashboard</a></li>
               <li class="separator icon-angle-right icon-notext"></li>
               <li><a href="{{ route('expenses.index') }}" class="text-orange">Retiradas</a></li>
            </ul>
         </nav>
         <a href="{{ route('expenses.create') }}" class="btn btn-orange icon-user ml-1">Retirada</a>
      </div>
   </header>

   <div class="dash_content_app_box">
      <div class="dash_content_app_box_stage">
         <div>
            <p><b>Usuario:</b> {{ $detail->user->name }}</p>
            <p><b>nome:</b> {{ $detail->name }}</p>
            <p><b>Valor:</b> {{ money_br($detail->value) }}</p>
            <p><b>Data:</b> {{ date_br($detail->due_date) }}</p>
            @if ($detail->description)
            <p><b>Descrição:</b> {{ $detail->description }}</p>
            @endif

            <br><br>
            <form action="{{ route('expenses.details-status', ['expense' => $detail->id]) }}" method="post"
               enctype="multipart/form-data">
               @method('PUT')
               @csrf
               <label class="label">
                  <span class="legend"><b>Status:</b></span>

                  <select name="status" class="btn btn-large">
                     <option value="1" {{ ($detail->status == 1 ? 'selected' : '') }}>Confirmado</option>
                     <option value="2" {{ ($detail->status == 2 ? 'selected' : '') }}>Pendente</option>
                     <option value="3" {{ ($detail->status == 3 ? 'selected' : '') }}>Cancelado</option>
                  </select>
               </label>
               <button class="btn btn-large btn-blue" type="submit">Atualizar Status</button>
            </form>
         </div>
      </div>
   </div>
</section>
@endsection
