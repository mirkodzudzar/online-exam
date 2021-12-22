<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Online Exam - @yield('title')</title>
</head>
<body>
  <div >
    <h5>Online Exam</h5>
    <nav>
      @guest
        <a href="{{ route('register') }}">Register</a>
        <a href="{{ route('login') }}">Login</a>
      @else
        <a href="{{ route('logout') }}"
          onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none">
          @csrf
        </form>
      @endguest
    </nav>
  </div>
  <div>
    <div>
      @if (session('status'))
        <div>
          {{ session('status') }}
        </div>
      @endif
    </div>
    @yield('content')
  </div>
</body>
</html>