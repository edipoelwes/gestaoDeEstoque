<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
   public function home()
   {
      return view('admin.dashboard');
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
