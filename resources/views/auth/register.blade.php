<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description"
        content="Stack admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, stack admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Register Page - Stack Responsive Bootstrap 4 Admin Template</title>
    <link rel="apple-touch-icon" href="{{ asset('app-assets/images/ico/apple-icon-120.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('app-assets/images/ico/favicon.ico') }}">
    <link
        href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i"
        rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/vendors.css') }}">
    <!-- END VENDOR CSS-->
    <!-- BEGIN STACK CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/app.css') }}">
    <!-- END STACK CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/login-register.css') }}">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <!-- END Custom CSS-->
</head>

<body class="vertical-layout vertical-menu 1-column   menu-expanded blank-page blank-page" data-open="click"
    data-menu="vertical-menu" data-col="1-column">
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section class="flexbox-container">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="col-md-4 col-10 box-shadow-2 p-0">
                            <div class="card border-grey border-lighten-3 px-2 py-2 m-0">
                                <div class="card-header border-0">
                                    <div class="card-title text-center">
                                        <img src="{{ asset('app-assets/images/logo/stack-logo-dark.png') }}"
                                            alt="branding logo">
                                    </div>
                                    <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
                                        <span>Create Account</span>
                                    </h6>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form-horizontal form-simple" method="POST"
                                            action="{{ route('register') }}" novalidate>
                                            @csrf
                                            <fieldset class="form-group position-relative has-icon-left mb-1">
                                                <input type="text"
                                                    class="form-control @error('name') is-invalid @enderror form-control-lg"
                                                    name="name" value="{{ old('name') }}" id="name"
                                                    placeholder="User Name">
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                <div class="form-control-position">
                                                    <i class="ft-user"></i>
                                                </div>
                                            </fieldset>
                                            <fieldset class="form-group position-relative has-icon-left mb-1">
                                                <input id="email" type="email"
                                                    class="form-control @error('email') is-invalid @enderror form-control-lg"
                                                    name="email"  value="{{ old('email') }}"
                                                    placeholder="Your Email Address" required>
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                <div class="form-control-position">
                                                    <i class="ft-mail"></i>
                                                </div>
                                            </fieldset>
                                            <fieldset class="form-group position-relative has-icon-left mb-1">
                                                <input type="text"  class="form-control @error('password') is-invalid @enderror form-control-lg"
                                                    id="password" type="password"  name="password" required placeholder="New Password" autocomplete="new-password">
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                <div class="form-control-position">
                                                    <i class="fa fa-key"></i>
                                                </div>
                                            </fieldset>
                                            <fieldset class="form-group position-relative has-icon-left mb-1">
                                                <input id="password-confirm" type="password"
                                                    class="form-control @error('email') is-invalid @enderror form-control-lg"
                                                    name="password_confirmation" placeholder="Password Confirmation" required autocomplete="new-password">

                                                <div class="form-control-position">
                                                    <i class="fa fa-key"></i>
                                                </div>
                                            </fieldset>









                                    <button type="submit" class="btn btn-primary btn-lg btn-block"><i
                                            class="ft-unlock"></i> Register</button>
                                    </form>
                                </div>
                                <p class="text-center">Already have an account ? <a href="login-simple.html"
                                        class="card-link">Login</a></p>
                            </div>
                        </div>
                    </div>
            </div>
            </section>
        </div>
    </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <!-- BEGIN VENDOR JS-->
    <script src="{{ asset('app-assets/vendors/js/vendors.min.js') }}" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="{{ asset('app-assets/vendors/js/forms/validation/jqBootstrapValidation.js') }}" type="text/javascript">
    </script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN STACK JS-->
    <script src="{{ asset('app-assets/js/core/app-menu.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/js/core/app.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/js/scripts/customizer.js') }}" type="text/javascript"></script>
    <!-- END STACK JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{{ asset('app-assets/js/scripts/forms/form-login-register.js') }}" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->
</body>

</html>
