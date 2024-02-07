<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="Stack admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
  <meta name="keywords" content="admin template, stack admin template, dashboard template, flat admin template, responsive admin template, web app">
  <meta name="author" content="PIXINVENT">
  <title>Chat Application - Stack Responsive Bootstrap 4 Admin Template</title>
    @include('includes.style')
    @stack('style')
    <style>
        .mega-dropdown-menu{
            width: 50%;
        }
    </style>
</head>
<body class="vertical-layout vertical-menu content-left-sidebar chat-application  menu-expanded fixed-navbar"
data-open="click" data-menu="vertical-menu" data-col="content-left-sidebar">
  <!-- fixed-top-->
 {{-- navbar --}}
 @include('includes.navbar')
  <!-- ////////////////////////////////////////////////////////////////////////////-->
 {{-- sidebar --}}
 @include('includes.sidebar')
  <div class="app-content content">
    {{-- content --}}
    @yield('content')
  </div>
  <!-- ////////////////////////////////////////////////////////////////////////////-->
  <footer class="footer fixed-bottom footer-light navbar-border">
    <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2">
      <span class="float-md-left d-block d-md-inline-block">Copyright &copy; 2018 <a class="text-bold-800 grey darken-2" href="https://themeforest.net/user/pixinvent/portfolio?ref=pixinvent"
        target="_blank">PIXINVENT </a>, All rights reserved. </span>
      <span class="float-md-right d-block d-md-inline-block d-none d-lg-block">Hand-crafted & Made with <i class="ft-heart pink"></i></span>
    </p>
  </footer>
 {{-- script  --}}
 @stack('script')
 @include('includes.script')
  <!-- END PAGE LEVEL JS-->
</body>
</html>
