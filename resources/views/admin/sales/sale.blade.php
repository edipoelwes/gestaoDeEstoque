@extends('admin.master.master')

@section('content')

<div>
  <table id="" class="myTable nowrap" width="100" style="width: 100% !important;">

    <div>
      <thead>
        <tr>
          <th>Produto</th>
          <th>Quantidade</th>
          <th>Preço</th>
          <th>SubTotal</th>
        </tr>
      </thead>
      <tbody>

      </tbody>
    </div>

  </table>
</div>

<div>
  <button id="addItem" class="btn">+</button>
</div>



@push('js')
<script>
  $(function () {});
</script>
@endpush

@endsection
