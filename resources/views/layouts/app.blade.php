<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <title>NRG</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowreorder/1.2.0/css/rowReorder.dataTables.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.dataTables.min.css"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datepicker.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/styles.css') }}"/>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

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
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/rowreorder/1.2.0/js/dataTables.rowReorder.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('assets/js/datepicker.js') }}"></script>   
    <script src="{{ asset('assets/js/typehead-bootstrap.js') }}"></script>  
    <script src="{{ asset('assets/js/custom.js') }}"></script>
</head>
<body>
<input type="hidden" value="{{Cookie::get('uemail')}}" id="cookieEmail" name="cookieEmail" />
<header class="bs-docs-nav navbar navbar-static-top" id="top">
  <div class="container">
    <div class="row">
      <div class="col-md-2 col-sm-3">
        <a class="navbar-brand" href="{{url('/')}}"><img src="{{ asset('assets/images/nrg_logo.png')}}" class="img-responsive"></a>
      </div>
      <div class="col-md-10 col-sm-9 nrg-mt">
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

            @if ( Cookie::get('uemail') )
              <li class="{{ active('user') }}"><a href="{{ url('/user') }}">My Dashboard</a></li>
              <li class="dropbtn {{ active('listview') }}"><a href="{{ url('listview') }}">Request a Conference</a>
                <div class="dropdown-content">
                  Select a conference to view details and request to attend. If conference is not listed <a href="{{url('/')}}/addnew">Request to add here</a>
                </div>
              </li>
              <li class="{{ active('conferencelist') }}"><a href="{{ url('conferencelist') }}">Conference List</a></li>
              <!-- <li class="{{ active('addnew') }}"><a href="{{ url('addnew') }}">Create New Conference</a></li> -->
              <li class="{{ active('leadslist') }}"><a href="{{ url('leadslist') }}">Leads</a></li>
              <!-- <li class="{{ active('pastconference') }}"><a href="{{ url('pastconference') }}">Past Conference</a></li> -->
              <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                      {{ Cookie::get('uemail') }} <i class="caret"></i>
                  </a>
                  <ul class="dropdown-menu" role="menu">
                    <li>
                      <a href="{{ url('clearcookie') }}">
                          Logout
                      </a>
                    </li>
                  </ul>
              </li>

            @elseif (Auth::guest() != 1 AND Cookie::get('uemail') == "" )  

            <li class="{{ active('home') }}"><a href="{{ url('/home') }}">My Dashboard</a></li>
            <li class="{{ active('approvereject') }}"><a href="{{ url('/approvereject') }}">Pending Request</a></li>
            <li class="{{ active('conferencelist') }}"><a href="{{ url('/conferencelist') }}">Conference List</a></li>
            <li class="{{ active('leadslist') }}"><a href="{{ url('/leadslist') }}">Leads</a></li>
            <!--<li class="{{ active('postconferencepagelist') }}"><a href="{{ url('/postconferencepagelist') }}">Post Conference Feedback</a></li>-->
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


            @else

              <li class="{{ active('/') }}"><a href="{{ url('/') }}">Dashboard</a></li>
              <li class="dropbtn {{ active('listview') }}"><a href="{{ url('listview') }}">Request a Conference</a>
                <div class="dropdown-content">
                  Select a conference to view details and request to attend. If conference is not listed <a href="{{url('/')}}/addnew">Request to add here</a>.
                </div>
              </li>
              <li class="{{ active('conferencelist') }}"><a href="{{ url('conferencelist') }}">Conference List</a></li>
              <li class="{{ active('leadslist') }}"><a href="{{ url('leadslist') }}">Leads</a></li>
              <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    Login As <span class="caret"></span>
                </a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="{{ url('/') }}">Standard User</a></li>
                  <li><a href="{{ route('login') }}">Conference Admin</a></li>
                </ul>
              </li>
            @endif
          </ul>
        </nav>
      </div>
    </div>
  </div>
</header>
<div class="main-content">
  @yield('content')
 </div>
</body>
</html>
