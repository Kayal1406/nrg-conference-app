<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>NRG</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">  
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datepicker.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/styles.css') }}"/>

    <!-- Scripts -->
    <script type="text/javascript">
      var APP_URL = {!! json_encode(url('/')) !!}
    </script>
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js"></script>
    <script type="text/javascript" src="{{ asset('assets/js/datatables.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker.js') }}"></script>   
    <script src="{{ asset('assets/js/typehead-bootstrap.js') }}"></script>   
    <script src="{{ asset('assets/js/custom.js') }}"></script>
</head>
<body>
<header class="bs-docs-nav navbar navbar-static-top" id="top">
   
  <div class="container">
    <div class="row">
      <div class="col-md-2">
        <a class="navbar-brand" href="{{url('/')}}"><img src="{{ asset('assets/images/nrg_logo.png')}}" class="img-responsive"></a>
      </div>
    </div>
  </div>

</header>
@yield('content')       
</body>
</html>

