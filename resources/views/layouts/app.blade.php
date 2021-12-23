<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
  <script src="{{ mix('js/app.js') }}" defer></script>
  <title>Online Exam - @yield('title')</title>
</head>
<body>
  <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 bg-white 
    border-bottom shadow-sm mb-3">
    <h5 class="my-0 mr-md-auto font-weight-normal">Online Exam</h5>
    <nav class="navbar navbar-expand navbar-light">
    <div class="container-fluid">
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          @guest
            <a class="nav-link p-2 text-dark" href="{{ route('home.index') }}">Home</a>
            <a class="nav-link p-2 text-dark" href="{{ route('register') }}">Register</a>
            <a class="nav-link p-2 text-dark" href="{{ route('login') }}">Login</a>
          @endguest
        </div>
      </div>
    </div>
  </nav>
  </div>
  <div class="container">
    @if (session('status'))
      <div class="alert alert-success">
        {{ session('status') }}
      </div>
    @endif
    <h1>
      @yield('page_title')
    </h1>
    @yield('content')
  </div>
</body>
</html>