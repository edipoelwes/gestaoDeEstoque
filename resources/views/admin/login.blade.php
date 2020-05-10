<!DOCTYPE html>
<html lang="pt-br">

<head>
   <meta charset="utf-8">
   <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/login.css') }}">
   <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">

   <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}" />
   <script src="https://kit.fontawesome.com/a81368914c.js"></script>
   <meta name="viewport" content="width=device-width, initial-scale=1">

   <meta name="csrf-token" content="{{ csrf_token() }}">

   <title>Login</title>
</head>

<body>
   <div class="ajax_response"></div>
   <img class="wave" src="{{ asset('assets/images/sonhos.png') }}">
   <div class="container">
      <div class="img">
         <img src="{{ asset('assets/images/login.png') }}">
      </div>
      <div class="login-content">
         <form name="login" action="{{ route('login.do') }}" method="post" autocomplete="off">
            <img src="{{ asset('assets/images/avatar.jpg') }}">
            <h2 class="title">Login</h2>
            <div class="input-div one">
               <div class="i">
                  <i class="fas fa-user"></i>
               </div>
               <div class="div">
                  <h5>E-mail</h5>
                  <input type="email" name="email" class="input" value="edipoelwes2@gmail.com">
               </div>
            </div>
            <div class="input-div pass">
               <div class="i">
                  <i class="fas fa-lock"></i>
               </div>
               <div class="div">
                  <h5>Senha</h5>
                  <input type="password" name="password_check" class="input">
               </div>
            </div>
            <a href="#">Esqueceu sua Senha?</a>
            <input type="submit" class="btn" value="Login">
         </form>
      </div>
   </div>
   <script type="text/javascript" src="{{ asset('assets/js/jquery.js') }}"></script>
   <script type="text/javascript" src="{{ asset('assets/js/login.js') }}"></script>
   <script type="text/javascript" src="{{ asset('assets/js/main.js') }}"></script>
</body>

</html>
