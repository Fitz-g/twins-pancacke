<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <title>Twins Pancake - Login Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Application de gestion de l'entreprise Twins Pancake" name="description"/>
    <meta content="Wilfried KORANDJI" name="author"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}"/>

    <!-- App css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css"/>
    @toastr_css

</head>

<body class="authentication-bg authentication-bg-pattern d-flex align-items-center">

<div class="home-btn d-none d-sm-block">
    <a href="{{ route('login') }}"><i class="fas fa-home h2 text-white"></i></a>
</div>

<div class="account-pages w-100 mt-5 mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card">

                    <div class="card-body p-4">

                        <div class="text-center mb-4">
                            <a href="{{ route('login') }}">
                                <span><img src="{{ asset('assets/images/logo-dark.png') }}" alt="" height="28"></span>
                            </a>
                        </div>

                        <form action="{{ route('auth') }}" method="post" class="pt-2">
                            @csrf

                            <div class="form-group mb-3">
                                <label for="emailaddress">Email</label>
                                <input class="form-control" type="email" name="email" id="emailaddress" required=""
                                       placeholder="Enter your email">
                                @error('email')
                                    <div class="small text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <a href="#" class="text-muted float-right"><small>Mot de passe oublié ?</small></a>
                                <label for="password">Mot de passe</label>
                                <input class="form-control" type="password" name="password" required="" id="password"
                                       placeholder="Enter your password">
                            </div>

                            <div class="custom-control custom-checkbox mb-3">
                                <input type="checkbox" name="remember_me" value="1" class="custom-control-input" id="checkbox-signin">
                                <label class="custom-control-label" for="checkbox-signin">Se rappeler de moi</label>
                            </div>

                            <div class="form-group mb-0 text-center">
                                <button class="btn btn-success btn-block" type="submit"> Connexion</button>
                            </div>

                        </form>

                    {{--                        <div class="row mt-3">--}}
                    {{--                            <div class="col-12 text-center">--}}
                    {{--                                <p class="text-muted mb-0">Don't have an account? <a href="auth-register.html" class="text-dark ml-1"><b>Sign Up</b></a></p>--}}
                    {{--                            </div> <!-- end col -->--}}
                    {{--                        </div>--}}
                    <!-- end row -->

                    </div> <!-- end card-body -->
                </div>
                <!-- end card -->

            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
<!-- end page -->

<!-- Vendor js -->
<script src="{{ asset('assets/js/vendor.min.js') }}"></script>

<!-- App js -->
<script src="{{ asset('assets/js/app.min.js') }}"></script>
@toastr_js
@toastr_render

</body>
</html>
