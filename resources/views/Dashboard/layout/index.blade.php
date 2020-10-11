<!DOCTYPE html>
<html dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ config('app.name', 'laravel') }}</title>
  
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset('css/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('css/bower_components/font-awesome/css/font-awesome.min.css')}}">
  
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('css/bower_components/Ionicons/css/ionicons.min.css')}}">

  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ asset ('css/dist/skins/_all-skins.min.css')}}">
 
  <!-- Morris chart -->
  <link rel="stylesheet" href="{{ asset('css/bower_components/morris.js/morris.css')}}">
 
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{ asset('css/bower_components/jvectormap/jquery-jvectormap.css')}}">
 
  <!-- Date Picker -->
  <link rel="stylesheet" href="{{ asset('css/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
 
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('css/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
 
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{ asset('css/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">

  <link rel="stylesheet" href="{{ asset('css/backend.css')}}">

<!-- CSRF Token -->
<meta name="csrf-token" content="{!! csrf_token() !!}">

    {{--noty--}}
    <link rel="stylesheet" href="{{ asset('css/plugins/noty/noty.css') }}">
    <script src="{{ asset('js/plugins/noty/noty.min.js') }}"></script>


 <!--Sweet alert -->
 <link rel="stylesheet" href="{{ asset('js/sweetalert/sweetalert2.min.css') }}">    


  @if (app()->getLocale() == 'ar')
  <link rel="stylesheet" href="{{ asset('css/dist/font-awesome-rtl.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/dist/AdminLTE-rtl.min.css') }}">
  <link href="https://fonts.googleapis.com/css?family=Cairo:400,700" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/dist/bootstrap-rtl.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/dist/rtl.css') }}">

  <style>
      body,
      h1,
      h2,
      h3,
      h4,
      h5,
      h6 {
          font-family: 'Cairo', sans-serif !important;
      }
  </style>
  @else
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link rel="stylesheet" href="{{ asset('css/dist/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/dist/AdminLTE.min.css') }}">
  @endif



  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">

<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b>LTE</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
        
          <!-- Languages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-language"></i>
              <span class="label label-warning">2</span>
            </a>
            
            <ul class="dropdown-menu">
            
              @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
              <li>
                  <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                      {{ $properties['native'] }}
                  </a>
              </li>
              @endforeach
              
              
            </ul>
          </li>
        
          <!-- Notifications: style can be found in dropdown.less -->
                    
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              
              @php $courses = getCourse(); @endphp
              
              @if($courses->count() > 0)  
                <span class="label label-danger">{{ $courses->count() }}</span>
              @endif
            
            </a>
            
            <ul class="dropdown-menu">
              <li class="header">You have {{ $courses->count() }} notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                @forelse($courses as $course)
                  <li>
                    <a href="{{ route('courses.show', $course->id) }}">
                      <li class="text-aqua row">
                      <h5 class="col-xs-6"> New {{ strtoupper(str_limit($course->name, 10)) }} </h5> 
                      <div class="col-xs-5">
                      <img src="{{ $course->image_path }}" class="img-circle img-thumbnail"> 
                        
                      </div>
                      </li> 
                    </a>
                  </li>
                
                @empty
                <li> @lang('site.no_notification')</li>
                @endforelse  
                </ul>
              
              </li>
              
              <li class="footer"><a href="#">View all</a></li>
            </ul>

          </li>

          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{ asset(auth()->user()->image_path)}}" class="user-image" alt="User Image">
              <span class="hidden-xs">{{strtoupper(auth()->user()->name) }}</span>
            </a>
            
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{ asset(auth()->user()->image_path)}}" class="img-circle" alt="User Image">

                <p>
                  {{strtoupper(auth()->user()->name) }} <br>
                  <span> Full Stack Developer </span>
                  <small>@lang('site.member') @lang('site.since') sep. 2019</small>
                </p>
              </li>
           
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{ route('users.show',[auth()->user()->id]) }}" class="btn btn-default btn-flat">@lang('site.profile')</a>
                </div>
                <div class="pull-right">
                  <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                   <button type="submit" class="btn btn-default btn-flat"> @lang('auth.logout')</button>
                </form> >
                </div>
              </li>
            </ul>
          </li>
          
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
 
  
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        @lang('site.dashboard')
        <small>Control panel</small>
      </h1>
     
     @include('dashboard.partials.breadcrumb')
     
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-xs-12">
        
          <div class="box box-info table-responsive no-padding">
            
                  @yield('content')
 
                  @include('dashboard.partials.session')
 
          </div>
          <!-- /.col -->
        </div>
      
      </div>
      <!-- /.row -->
      <!-- Main row -->
      
    </section>
    <!-- /.content -->
  </div>
  

  @include('Dashboard.layout.footer')
  @include('Dashboard.layout.sidebar')
  
  