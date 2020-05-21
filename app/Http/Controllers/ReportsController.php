<?php

namespace App\Http\Controllers;

use App\Client;
use App\Sale;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportsController extends Controller
{
   public function index()
   {
      return view('admin.reports.reports');
   }

   public function salesReport()
   {
      return view('admin.reports.salesReports', [
         'clients' => Client::where('company_id', Auth::user()->company_id)->get(),
      ]);
   }

   public function salesPdf(Request $request)
   {
      $company = Auth::user()->company_id;
      $data = $request->all();
      // $data['status'] = intval($data['status']);

      $reports = $this->filterSales(
         $company,
         $data['client_id'],
         $data['start_date'],
         $data['end_date'],
         $data['status'],
         $data['order']
      );

      $pdf = PDF::loadView('admin.reports.sales_pdf', [
         'reports' => $reports['data'],
         'order' => $reports['order'],
         'total' => $reports['total'],
      ]);


      return $pdf->setPaper('A4')->stream('relatorio.pdf');
   }

   private function filterSales($company, $client, $startDate, $endDate, $status, $order)
   {
      if (empty($client) && empty($startDate) && empty($endDate) && empty($status)) {

         $query['order'] = '';
         $query['data'] = Sale::where('company_id', $company)
            ->orderBy('created_at', $order)
            ->get();

         $query['total'] = Sale::where('company_id', $company)
            ->orderBy('created_at', $order)
            ->sum('total_price');

         return $query;
      } else if (!empty($client) && empty($startDate) && empty($endDate) && empty($status)) {

         $query['order'] = '';
         $query['data'] = Sale::where([['company_id', $company], ['client_id', $client]])
            ->orderBy('created_at', $order)
            ->get();

         $query['total'] = Sale::where([['company_id', $company], ['client_id', $client]])
            ->orderBy('created_at', $order)
            ->sum('total_price');

         return $query;
      } else if (!empty($client) && empty($startDate) && empty($endDate) && !empty($status)) {

         $query['order'] = '';
         $query['data'] = Sale::where([['company_id', $company], ['client_id', $client], ['status', $status]])
            ->orderBy('created_at', $order)
            ->get();

         $query['total'] = Sale::where([['company_id', $company], ['client_id', $client], ['status', $status]])
            ->orderBy('created_at', $order)
            ->sum('total_price');

         return $query;
      } else if (!empty($client) && !empty($startDate) && !empty($endDate) && !empty($status)) {

         $query['order'] = 'De ' . date_br($startDate) . ' até ' . date_br($endDate);
         $query['data'] = Sale::where([['company_id', $company], ['client_id', $client], ['status', $status]])
            ->whereBetween('created_at', [$startDate, $endDate])
            ->orderBy('created_at', $order)
            ->get();

         $query['total'] = Sale::where([['company_id', $company], ['client_id', $client], ['status', $status]])
            ->whereBetween('created_at', [$startDate, $endDate])
            ->orderBy('created_at', $order)
            ->sum('total_price');

         return $query;
      } else if (!empty($client) && !empty($startDate) && !empty($endDate) && empty($status)) {

         $query['order'] = 'De ' . date_br($startDate) . ' até ' . date_br($endDate);
         $query['data'] = Sale::where([['company_id', $company], ['client_id', $client]])
            ->whereBetween('created_at', [$startDate, $endDate])
            ->orderBy('created_at', $order)
            ->get();

         $query['total'] = Sale::where([['company_id', $company], ['client_id', $client]])
            ->whereBetween('created_at', [$startDate, $endDate])
            ->orderBy('created_at', $order)
            ->sum('total_price');

         return $query;
      } else if (empty($client) && !empty($startDate) && !empty($endDate) && empty($status)) {

         $query['order'] = 'De ' . date_br($startDate) . ' até ' . date_br($endDate);
         $query['data'] = Sale::where('company_id', $company)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->orderBy('created_at', $order)
            ->get();

         $query['total'] = Sale::where('company_id', $company)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->orderBy('created_at', $order)
            ->sum('total_price');

         return $query;
      } else if (empty($client) && !empty($startDate) && !empty($endDate) && !empty($status)) {

         $query['order'] = 'De ' . date_br($startDate) . ' até ' . date_br($endDate);
         $query['data'] = Sale::where([['company_id', $company], ['status', $status]])
            ->whereBetween('created_at', [$startDate, $endDate])
            ->orderBy('created_at', $order)
            ->get();

         $query['total'] = Sale::where([['company_id', $company], ['status', $status]])
            ->whereBetween('created_at', [$startDate, $endDate])
            ->orderBy('created_at', $order)
            ->sum('total_price');

         return $query;
      } else if (empty($client) && empty($startDate) && empty($endDate) && !empty($status)) {

         $query['order'] = '';
         $query['data'] = Sale::where([['company_id', $company], ['status', $status]])
            ->orderBy('created_at', $order)
            ->get();

         $query['total'] = Sale::where([['company_id', $company], ['status', $status]])
            ->orderBy('created_at', $order)
            ->sum('total_price');

         return $query;
      }
   }
}
