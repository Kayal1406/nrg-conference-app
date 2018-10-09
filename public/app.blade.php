<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>NRG</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="/css/datatables.css"/>
    <link rel="stylesheet" type="text/css" href="/css/datepicker.css"/>
    <link rel="stylesheet" type="text/css" href="/css/styles.css"/>

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
    <script src="/js/app.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js"></script>
    <script type="text/javascript" src="/js/datatables.js"></script>
    <script src="/js/datepicker.js"></script>   
    <script src="/js/custom.js"></script>
</head>
<body>
<header class="bs-docs-nav navbar navbar-static-top" id="top">
  <div class="container">
    <div class="row">
      <div class="col-md-2">
        <a class="navbar-brand" href="#"><img src="{{ asset('images/nrg_logo.png')}}" class="img-responsive"></a>
      </div>
      <div class="col-md-10 col-sm-12 nrg-mt">
        <div class="navbar-header">
          <button aria-controls="bs-navbar" aria-expanded="false" class="navbar-toggle collapsed" data-target="#bs-navbar" data-toggle="collapse" type="button">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          </button>
        </div>
        <nav class="navbar-collapse collapse navbar-right" id="bs-navbar" aria-expanded="false" style="height: 1px;">
          <ul class="nav navbar-nav">
            <li class="{{ active('/') }}"><a href="{{ url('/') }}">Home</a></li>
            <li class="{{ active('addnew') }}"><a href="{{ url('addnew') }}">New Conference Request</a></li>
            <li class="{{ active('listview') }}"><a href="{{ url('listview') }}">View Master Conference List</a></li>
            <li class="{{ active('pastconference') }}"><a href="#">ROI and Metrics</a></li>
            @if (Auth::guest())
                <li><a href="{{ route('login') }}"><b>Supreme Manager Login</b></a></li>
                <!-- <li><a href="{{ route('register') }}">Register</a></li> -->
                @else
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                      <li>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          {{ csrf_field() }}
                        </form>
                      </li>
                    </ul>
                </li>
            @endif
          </ul>
        </nav>
      </div>
    </div>
  </div>
</header>
@yield('content')       
</body>
</html>

