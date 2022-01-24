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
    <h5 class="my-0 mr-md-auto font-weight-normal"><a href="{{ route('users.professions.index') }}" class="nav-link p-2 text-dark">Online Exam</a></h5>
    <nav class="navbar navbar-expand navbar-light">
    <div class="container-fluid">
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <a class="nav-link p-2 text-dark" href="{{ route('users.professions.index') }}">Professions</a>
          <a class="nav-link p-2 text-dark" href="{{ route('users.locations.index') }}">Locations</a>
          @guest
            @include('includes._guest-navbar')
          @else
            @if (Auth::user()->is_admin)
              @include('includes._admin-navbar')
            @else
              @include('includes._user-navbar')
            @endif
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