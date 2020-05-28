<!DOCTYPE html>
<html lang="pt-br">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>PDF</title>
   <!-- CSS only -->
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
      integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>

<body>
   <div style="text-align: center" class="mb-5">
      <h1>Relatorio de Vendas</h1>
      <h3>Sonhos de ninar</h3>
   </div>

   <b>filtro:</b>
   <p class="mb-3">
      {{ $order }}
   </p>
   <table class="table table-striped">
      <thead>
         <tr>
            <th>#</th>
            <th>Cliente</th>
            <th>Status</th>
            <th>Data</th>
            <th>Desconto</th>
            <th>Total</th>
         </tr>
      </thead>
      <tbody>
         @foreach ($reports as $report)
         <tr>
            <td>{{ $report->id }}</td>
            <td>{{ $report->client->name }}</td>
            <td>{{ ($report->status == 1 ? 'Confirmado' : ($report->status == 2 ? 'Cancelado' : 'Pendente')) }}</td>
            <td>{{ date_br($report->created_at) }}</td>
            <td>R$ {{ money_br($report->discount) }}</td>
            <td>R$ {{ money_br($report->total_price) }}</td>
         </tr>
         @endforeach
         <tr>
            <td colspan="4"></td>
            <td><b>Total</b></td>
            <td>R$ {{ money_br($total) }}</td>
         </tr>
         <tr>
            <td colspan="4"></td>
            <td><b>Desconto</b></td>
            <td>R$ {{ money_br($discount) }}</td>
         </tr>
         <tr>
            <td colspan="4"></td>
            <td><b>Total Geral</b></td>
            <td>R$ {{ money_br($total - $discount) }}</td>
         </tr>

      </tbody>
   </table>

   <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
      integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
   </script>
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
      integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
   </script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
      integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
   </script>
</body>

</html>
