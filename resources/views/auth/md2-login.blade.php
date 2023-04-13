

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="creative tim, updivision, html dashboard, laravel, material, html css dashboard laravel, material dashboard laravel, laravel material dashboard, material admin, laravel dashboard, laravel admin, web dashboard, bootstrap 5 dashboard laravel, bootstrap 5, css3 dashboard, bootstrap 5 admin laravel, material dashboard bootstrap 5 laravel, frontend, responsive bootstrap 5 dashboard, material dashboard, material laravel bootstrap 5 dashboard" />
    <meta name="description" content="A free Laravel Dashboard featuring dozens of UI components & basic Laravel CRUDs." />
    <meta itemprop="name" content="Material Dashboard 2 Laravel by Creative Tim & UPDIVISION" />
    <meta itemprop="description" content="A free Laravel Dashboard featuring dozens of UI components & basic Laravel CRUDs." />
    <meta itemprop="image" content="https://s3.amazonaws.com/creativetim_bucket/products/154/original/material-dashboard-laravel.jpg" />
    <meta name="twitter:card" content="product" />
    <meta name="twitter:site" content="@creativetim" />
    <meta name="twitter:title" content="Material Dashboard 2 Laravel by Creative Tim & UPDIVISION" />
    <meta name="twitter:description" content="A free Laravel Dashboard featuring dozens of UI components & basic Laravel CRUDs." />
    <meta name="twitter:creator" content="@creativetim" />
    <meta name="twitter:image" content="https://s3.amazonaws.com/creativetim_bucket/products/154/original/material-dashboard-laravel.jpg" />
    <meta property="fb:app_id" content="655968634437471" />
    <meta property="og:title" content="Material Dashboard 2 Laravel by Creative Tim & UPDIVISION" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="https://www.creative-tim.com/live/material-dashboard-laravel" />
    <meta property="og:image" content="https://s3.amazonaws.com/creativetim_bucket/products/154/original/material-dashboard-laravel.jpg" />
    <meta property="og:description" content="A free Laravel Dashboard featuring dozens of UI components & basic Laravel CRUDs." />
    <meta property="og:site_name" content="Creative Tim" />
    <link rel="apple-touch-icon" sizes="76x76" href=" {{ asset('assets/img/apple-icon.png') }} ">
    <link rel="icon" type="image/png" href=" {{ asset('assets/img/favicon.png') }} ">

    <title>
        Iniciar sesion/Login
    </title>

    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <link href=" {{ asset('assets/css/nucleo-icons.css') }} " rel="stylesheet" />
    <link href=" {{ asset('assets/css/nucleo-svg.css') }} " rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <link id="pagestyle" href=" {{ asset('assets/css/material-dashboard.css?v=3.0.0') }} " rel="stylesheet" />
</head>

<body class="bg-gray-200">
    {{-- <div class="container position-sticky z-index-sticky top-0">
        <div class="row">
            <div class="col-12">
                <nav class="navbar navbar-expand-lg blur border-radius-lg top-0 z-index-3 shadow position-absolute mt-4 py-2 start-0 end-0 mx-4">
                    <div class="container-fluid ps-2 pe-0">
                        <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 d-flex flex-column" href=" {{ route('login') }} ">
                            Material Dashboard 2
                            <span>Laravel</span>
                        </a>
                        <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon mt-2">
                            <span class="navbar-toggler-bar bar1"></span>
                            <span class="navbar-toggler-bar bar2"></span>
                            <span class="navbar-toggler-bar bar3"></span>
                            </span>
                        </button>
                        <div class="collapse navbar-collapse" id="navigation">
                            <ul class="navbar-nav mx-auto">
                                <li class="nav-item">
                                    <a class="nav-link me-2" href=" {{ route('login') }} ">
                                    <i class="fas fa-user-circle opacity-6 text-dark me-1"></i>
                                    Sign Up
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link me-2" href=" {{ route('login') }} ">
                                    <i class="fas fa-key opacity-6 text-dark me-1"></i>
                                    Sign In
                                    </a>
                                </li>
                            </ul>
                            <ul class="navbar-nav d-lg-block d-none">
                                <li class="nav-item">
                                <a href=" {{ route('login') }} " class="btn btn-sm mb-0 me-1 bg-gradient-dark" target="_blank">Free download</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div> --}}

    <main class="main-content  mt-0">
        <div class="page-header align-items-start min-vh-100" style="background-image: url('https://images.unsplash.com/photo-1497294815431-9365093b7331?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1950&q=80');">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container mt-4">
                <div class="row signin-margin">
                    <div class="col-lg-4 col-md-8 col-12 mx-auto">
                        <div class="card z-index-0 fadeIn3 fadeInBottom">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                                    <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Iniciar sesiòn</h4>
                                    <div class="row mt-3">
                                        <h6 class='text-white text-center'>
                                            <span class="font-weight-normal">Proyecto SSPIS</span>
                                        </h6>
                                        {{-- <div class="col-2 text-center ms-auto">
                                            <a class="btn btn-link px-3" href="javascript:;">
                                            <i class="fa fa-facebook text-white text-lg"></i>
                                            </a>
                                        </div>
                                        <div class="col-2 text-center px-1">
                                            <a class="btn btn-link px-3" href="javascript:;">
                                            <i class="fa fa-github text-white text-lg"></i>
                                            </a>
                                        </div>
                                        <div class="col-2 text-center me-auto">
                                            <a class="btn btn-link px-3" href="javascript:;">
                                            <i class="fa fa-google text-white text-lg"></i>
                                            </a>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>

                            {{-- @include('partials.form-errors') --}}

                            <div class="card-body">
                                <form method="POST" action=" {{ route('login') }} " class="text-start">
                                    @csrf

                                    <div class="input-group input-group-outline mt-3 @error('email') is-invalid focused is-focused @endif">
                                        <label class="form-label">{{ __('Email') }}</label>
                                        <input 
                                            type="email" 
                                            class="form-control" 
                                            name="email"
                                            id="email"
                                            value="{{ old('email') }}"
                                        />
                                    </div>

                                    @error('email')
                                        <span class="text-danger inputerror">
                                            {{ $message }}
                                        </span>
                                    @enderror 

                                    <div class="input-group input-group-outline mt-3 @error('password') is-invalid focused is-focused @endif">
                                        <label class="form-label">{{ __('Password') }}</label>
                                        <input 
                                            type="password" 
                                            class="form-control" 
                                            name="password"
                                            id="password"
                                        />
                                    </div>

                                    @error('password')
                                        <span class="text-danger inputerror">
                                            {{ $message }}
                                        </span>
                                    @enderror 

                                    {{-- <div class="form-check form-switch d-flex align-items-center my-3">
                                    <input class="form-check-input" type="checkbox" id="rememberMe">
                                    <label class="form-check-label mb-0 ms-2" for="rememberMe">Remember
                                    me</label>
                                    </div> --}}

                                    <div class="text-center">
                                        <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">
                                            {{ __('Iniciar sesión') }}
                                        </button>
                                    </div>

                                    <p class="mt-4 text-sm text-center">
                                        No tienes una cuenta?
                                    <a href=" {{ route('register') }} " class="text-primary text-gradient font-weight-bold">Registro/Sign up</a>
                                    </p>
                                    
                                    {{-- <p class="text-sm text-center">
                                        Forgot your password? Reset your password
                                    <a href=" {{ route('login') }} " class="text-primary text-gradient font-weight-bold">here</a>
                                    </p> --}}
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src=" {{ asset('assets/js/core/popper.min.js') }} "></script>
    <script src=" {{ asset('assets/js/core/bootstrap.min.js') }} "></script>
    <script src=" {{ asset('assets/js/plugins/perfect-scrollbar.min.js') }} "></script>
    <script src=" {{ asset('assets/js/plugins/smooth-scrollbar.min.js') }} "></script>
    <script src=" {{ asset('assets/js/jquery.min.js') }} "></script>
    <script>
        $(function() {

        var text_val = $(".input-group input").val();
        if (text_val === "") {
        $(".input-group").removeClass('is-filled');
        } else {
        $(".input-group").addClass('is-filled');
        }
    });
    </script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }

    </script>

    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <script src=" {{ asset('assets/js/material-dashboard.min.js?v=3.0.0') }} "></script>
    {{-- <script defer src="https://static.cloudflareinsights.com/beacon.min.js/v2b4487d741ca48dcbadcaf954e159fc61680799950996" integrity="sha512-D/jdE0CypeVxFadTejKGTzmwyV10c1pxZk/AqjJuZbaJwGMyNHY3q/mTPWqMUnFACfCTunhZUVcd4cV78dK1pQ==" data-cf-beacon='{"rayId":"7b5e4ec1385e2c8d","version":"2023.3.0","r":1,"token":"1b7cbb72744b40c580f8633c6b62637e","si":100}' crossorigin="anonymous"></script> --}}
    </body>
</html>
