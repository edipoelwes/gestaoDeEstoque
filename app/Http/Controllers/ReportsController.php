<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportsController extends Controller
{
   public function index ()
   {
      return view('admin.reports.reports');
   }

   public function salesReport()
   {
      return view('admin.reports.salesReports', [
         'clients' => Client::where('company_id', Auth::user()->company_id)->get(),
      ]);
   }

   public function sales_pdf(Request $request)
   {
      $data = $request->all();
      $this->loadView('sales_pdf', [
         'data' => $data,
      ]);
   }
}
