<?php

namespace App\Http\Controllers;

use App\{Purchase, User, Sale};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, DB};
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
   public function home()
   {

      $sales = Sale::where('company_id', Auth::user()->company_id)->get();
      $total = Sale::where([
         ['company_id', Auth::user()->company_id],
         ['status', 1],
         ['month_year', date('m/yy', strtotime(now()))],
      ])->sum('total_price');

      $discount = Sale::where([
         ['company_id', Auth::user()->company_id],
         ['status', 1],
         ['month_year', date('m/yy', strtotime(now()))],
      ])->sum('discount');

      $pending = Sale::where([
         ['company_id', Auth::user()->company_id],
         ['status', 3],
      ])->sum('total_price');

      $expense = Purchase::where([
         ['company_id', Auth::user()->company_id],
         ['status', 3],
      ])->sum('total');

      return view('admin.dashboard', [
         'sales' => $sales,
         'total' => $total,
         'discount' => $discount,
         'pending' => $pending,
         'expense' => $expense,
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
      return view('admin.icons');
   }
}
