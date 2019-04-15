
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Limestay - Stay as Fresh as Lime!</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/colors/3.0.0/css/colors.css" />
    <!-- Bootstrap core CSS -->
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    @stack("styles")
  </head>

  <body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{asset('lime.png')}}" width="30" height="30" class="d-inline-block align-top" alt="">
            LimeStay
          </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">
            @if(Auth::user())
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  {{ucfirst(Auth::user()->name)}}
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="{{ url('history') }}">My Bookings</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                </div>
            </li>
            @else
            <li class="nav-item @if(Request::path() == 'login') active @endif">
                <a class="nav-link" href="{{ url('login') }}">Login</a>
            </li>
            <li class="nav-item @if(Request::path() == 'register') active @endif">
                <a class="nav-link" href="{{ url("register") }}">Register</a>
            </li>
            @endif
            <li class="nav-item @if(Request::path() == '/') active @endif">
              <a class="nav-link" href="{{ url('') }}">Find Properties Now</a>
            </li>
          </ul>
        </div>
      </nav>


    <main role="main" class="my-3">
        @yield('content')
    </main>

    <footer class="footer">
        <div class="container">
        <span class="text-muted">Limestay © {{date('Y')}}</span>
        </div>
      </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="{{asset('js/app.js')}}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
    @yield('footerScripts')
  </body>
</html>
