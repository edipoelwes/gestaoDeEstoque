@extends('admin.master.master')

@section('content')
<section class="dash_content_app">
   <header class="dash_content_app_header">
      <h2 class="icon-search">Filtro</h2>

      <div class="dash_content_app_header_actions">
         <nav class="dash_content_app_breadcrumb">
            <ul>
               <li><a href="{{ route('home') }}">Dashboard</a></li>
               <li class="separator icon-angle-right icon-notext"></li>
               <li><a href="{{ route('clients.index') }}" class="text-orange">Clientes</a></li>
            </ul>
         </nav>

         <a href="{{ route('expenses.create') }}" class="btn btn-blue icon-user ml-1">Retiradas</a>
      </div>
   </header>

   <div class="dash_content_app_box">
      <div class="dash_content_app_box_stage">
         <table id="dataTable" class="nowrap stripe" width="100" style="width: 100% !important;">
            <thead>
               <tr>
                  <th>#</th>
                  <th>Responsavel</th>
                  <th>Despesa</th>
                  <th>Status</th>
                  <th>Valor</th>
                  <th>Data da retirada</th>
                  <th>Ações</th>
               </tr>
            </thead>
            <tbody>
               @foreach($expenses as $expense)
                  <tr>
                     <td>{{ $expense->id }}</td>
                     <td class="text-orange">{{ $expense->user->name }}</td>
                     <td>{{ $expense->name }}</td>
                     <td
                        class="badge badge-pill {{ ($expense->status == 3 ? 'badge-danger' : ($expense->status == 1 ? 'badge-success' : 'badge-warning')) }}">
                        {{ ($expense->status == 2 ? 'pendente' : ($expense->status == 1 ? 'confirmado' : 'cancelado')) }}
                     </td>
                     <td>R$ {{ money_br($expense->value) }}</td>
                     <td>{{ date_br($expense->due_date) }}</td>
                     <td>

                        <a href="{{ route('expenses.edit', ['expense' => $expense->id]) }}"
                           class="text-blue icon-pencil-square-o" title="Editar Retirada">
                        </a>

                        <a href="{{ route('expenses.show', ['expense' => $expense->id]) }}"
                           class="icon-file-text text-green"></a>

                        <a href="javascript:;" class="text-orange icon-trash"
                           onclick="confirmDelete({{ $expense->id }})" title="Excluir Retirada">
                        </a>

                        <form id="btn-delete-{{ $expense->id }}"
                           action="{{ route('expenses.destroy', ['expense' => $expense->id]) }}"
                           method="post" class="hidden">
                           @method('DELETE')
                           @csrf
                        </form>
                     </td>
                  </tr>
               @endforeach
            </tbody>
         </table>
      </div>
   </div>
</section>
@endsection
