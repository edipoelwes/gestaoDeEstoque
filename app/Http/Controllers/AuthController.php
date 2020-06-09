<?php

namespace App\Http\Controllers;

use App\{Expense, Purchase, User, Sale};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, DB};
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
   public function home()
   {

      $month = date('m', strtotime(now()));

      $sales = Sale::where([['company_id', Auth::user()->company_id], ['status', '!=', 3]])
         ->orderBy('created_at', 'desc')
         ->limit(5)
         ->get();

      $total = Sale::where([
         ['company_id', Auth::user()->company_id],
         ['status', 1],
      ])->whereMonth('created_at', $month)->sum('total_price');

      $discount = Sale::where([
         ['company_id', Auth::user()->company_id],
         ['status', 1],
      ])->whereMonth('created_at', $month)->sum('discount');

      $pending = Sale::where([
         ['company_id', Auth::user()->company_id],
         ['status', 2],
      ])->sum('total_price');

      $discount_pending = Sale::where([
         ['company_id', Auth::user()->company_id],
         ['status', 2],
      ])->sum('discount');

      $expense = Purchase::where([
         ['company_id', Auth::user()->company_id],
         ['status', 2],
      ])->whereMonth('due_date', $month)->sum('total');

      $expense_pending = Expense::where([
         ['company_id', Auth::user()->company_id],
         ['status', 2]
      ])->whereMonth('due_date', $month)->sum('value');

      return view('admin.dashboard', [
         'sales' => $sales,
         'total' => $total,
         'discount' => $discount,
         'discount_pending' => $discount_pending,
         'pending' => $pending,
         'expense' => $expense,
         'expense_pending' => $expense_pending,
      ]);
   }

   public function loginForm()
   {
      if (Auth::check() === true) {
         return redirect()->route('home');
      }
      return view('admin.login');
   }

   public function login(Request $request)
   {
      if (in_array('', $request->only('email', 'password'))) {
         $json['message'] = $this->message->success('Ooops, informe todos os dados para efetuar o login')->render();
         return response()->json($json);
      }

      if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
         $json['message'] = $this->message->success('Ooops, informe um e-mail válido!')->render();
         return response()->json($json);
      }

      $credentials = [
         'email' => $request->email,
         'password' => $request->password
      ];

      if (!Auth::attempt($credentials)) {
         $json['message'] = $this->message->success('Ooops, usário e senha não conferem')->render();
         return response()->json($json);
      }

      $this->authenticate($request->getClientIp());

      $json['redirect'] = route('home');
      return response()->json($json);
   }

   public function logout()
   {
      Auth::logout();
      return redirect()->route('login');
   }

   private function authenticate(string $ip)
   {
      $user = User::where('id', Auth::user()->id);
      $user->update([
         'last_login_at' => date('Y-m-d H:i:s'),
         'last_login_ip' => $ip
      ]);
   }


   public function icon()
   {
      return view('root.icons');
   }
}
