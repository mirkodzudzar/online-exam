<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
      jQuery(document).ready(function($){
          $("#menu-toggle").click(function(e) {
          e.preventDefault();
          $("#wrapper").toggleClass("toggled");
          });
      })
    </script>
    <style>
      body {
        overflow-x: hidden;
      }
      #sidebar-wrapper {
        min-height: 100vh;
        margin-left: -15rem;
        -webkit-transition: margin .25s ease-out;
        -moz-transition: margin .25s ease-out;
        -o-transition: margin .25s ease-out;
        transition: margin .25s ease-out;
      }
      #sidebar-wrapper .sidebar-heading {
        padding: 0.875rem 1.25rem;
        font-size: 1.2rem;
      }
      #sidebar-wrapper .list-group {
        width: 15rem;
      }
      #page-content-wrapper {
        min-width: 100vw;
      }
      #wrapper.toggled #sidebar-wrapper {
        margin-left: 0;
      }
      @media (min-width: 768px) {
        #sidebar-wrapper {
            margin-left: 0;
        }
        #page-content-wrapper {
            min-width: 0;
            width: 100%;
        }
        #wrapper.toggled #sidebar-wrapper {
            margin-left: -15rem;
        }
      }
    </style>   
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="{{ mix('js/app.js') }}" defer></script>
    <title>Online Exam - @yield('title')</title>
  </head>
  <body>
    <div class="d-flex" id="wrapper">
      <!-- Sidebar -->
      <div class="bg-light border-right" id="sidebar-wrapper">
        <div class="sidebar-heading">Admin panel</div>
        <div class="list-group list-group-flush">
            <a href="{{ route('users.professions.index') }}" class="list-group-item list-group-item-action bg-light">Home</a>
            <div class="dropdown">
              <a href="#" class="dropdown-toggle list-group-item list-group-item-action bg-light" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">Professions</a>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item" href="{{ route('admins.professions.index') }}">All</a></li>
                <li><a class="dropdown-item" href="{{ route('admins.professions.expired') }}">Expired</a></li>
                <li><a class="dropdown-item" href="{{ route('admins.professions.destroyed') }}">Destroyed</a></li>
                <li><a class="dropdown-item" href="{{ route('admins.professions.create') }}">Add new</a></li>
              </ul>
            </div>
        </div>
      </div>
      <!-- /#sidebar-wrapper -->
      <!-- Page Content -->
      <div id="page-content-wrapper">
        <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
          <button class="btn btn-light" id="menu-toggle"><span class="navbar-toggler-icon"></span></button>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
              {{--  <li class="nav-item active">
                <a class="nav-link" href="#">TEST<span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">TEST</a>
              </li>  --}}
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Profile
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="#">TEST</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout ADMIN
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none">
                    @csrf
                  </form>
                </div>
              </li>
            </ul>
          </div>
        </nav>
        <div class="container-fluid">
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
      </div>
      <!-- /#page-content-wrapper -->
    </div>
    <!-- /#wrapper -->
  </body>
</html>