<!--
=========================================================
* Material Dashboard 2 - v3.0.0
=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->

<!DOCTYPE html>
<html lang="en" dir>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href=" {{ asset('assets/img/apple-icon.png') }} ">
    <link rel="icon" type="image/png" href=" {{ asset('assets/img/favicon.png') }} ">

    <title>
            Registro/Sign up
    </title>

    <meta itemprop="image" content="https://s3.amazonaws.com/creativetim_bucket/products/600/original/material-dashboard-laravel-livewire.jpg" />

    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />

    <link href=" {{ asset('assets/css/nucleo-icons.css') }} " rel="stylesheet" />
    <link href=" {{ asset('assets/css/nucleo-svg.css') }} " rel="stylesheet" />

    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">

    <link id="pagestyle" href=" {{ asset('assets/css/material-dashboard.css?v=3.0.0') }} " rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

    <style>
        [wire\:loading], [wire\:loading\.delay], [wire\:loading\.inline-block], [wire\:loading\.inline], [wire\:loading\.block], [wire\:loading\.flex], [wire\:loading\.table], [wire\:loading\.grid], [wire\:loading\.inline-flex] {
            display: none;
        }

        [wire\:loading\.delay\.shortest], [wire\:loading\.delay\.shorter], [wire\:loading\.delay\.short], [wire\:loading\.delay\.long], [wire\:loading\.delay\.longer], [wire\:loading\.delay\.longest] {
            display:none;
        }

        [wire\:offline] {
            display: none;
        }

        [wire\:dirty]:not(textarea):not(input):not(select) {
            display: none;
        }

        input:-webkit-autofill, select:-webkit-autofill, textarea:-webkit-autofill {
            animation-duration: 50000s;
            animation-name: livewireautofill;
        }

        @keyframes livewireautofill { from {} }
    </style>
</head>

<body class="g-sidenav-show  ">
    <main wire:id="Ummd3856PJKz3TabAy2x" wire:initial-data="{&quot;fingerprint&quot;:{&quot;id&quot;:&quot;Ummd3856PJKz3TabAy2x&quot;,&quot;name&quot;:&quot;auth.register&quot;,&quot;locale&quot;:&quot;en&quot;,&quot;path&quot;:&quot;sign-up&quot;,&quot;method&quot;:&quot;GET&quot;,&quot;v&quot;:&quot;acj&quot;},&quot;effects&quot;:{&quot;listeners&quot;:[]},&quot;serverMemo&quot;:{&quot;children&quot;:[],&quot;errors&quot;:[],&quot;htmlHash&quot;:&quot;0ced54ac&quot;,&quot;data&quot;:{&quot;name&quot;:&quot;&quot;,&quot;email&quot;:&quot;&quot;,&quot;password&quot;:&quot;&quot;},&quot;dataMeta&quot;:[],&quot;checksum&quot;:&quot;35c7217ddfcc01ccdfda2c3c3594e78e027a10ab48e4a1b0f9023ce2d59d80d0&quot;}}" class="main-content  mt-0">
    <section>
        <div class="page-header min-vh-100">
            <div class="container">
                <div class="row">
                    <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 start-0 text-center justify-content-center flex-column">
                        <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center" style="background-image: url('../assets/img/illustrations/illustration-signup.jpg'); background-size: cover;">
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column ms-auto me-auto ms-lg-auto me-lg-5">
                        <div class="card card-plain">
                            <div class="card-header">
                                <h4 class="font-weight-bolder">Registrarse/Sign Up</h4>
                                <p class="mb-0">Introduce tu nombre, correo y contraseña para registrarse</p>
                            </div>

                            <div class="card-body">

                                {{-- @include('partials.form-errors') --}}

                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="input-group input-group-outline @error('name') is-invalid focused is-focused @endif">
                                        <label class="form-label">Name</label>
                                        <input    
                                            type="text" 
                                            class="form-control"
                                            wire:model="name" 
                                            id="name"
                                            name="name"
                                            value=" {{ old('name') }} "
                                        >
                                    </div>

                                    @error('name')
                                        <span class="text-danger inputerror">
                                            {{ $message }}
                                        </span>
                                    @enderror 

                                    <div class="input-group input-group-outline mt-3 @error('email') is-invalid focused is-focused @endif">
                                        <label class="form-label">Email</label>
                                        <input     
                                            type="email" 
                                            class="form-control"
                                            wire:model="email" 
                                            id="email"
                                            name="email"
                                            value=" {{ old('email') }} "
                                        >
                                    </div>

                                    @error('email')
                                        <span class="text-danger inputerror">
                                            {{ $message }}
                                        </span>
                                    @enderror 

                                    <div class="input-group input-group-outline mt-3 @error('password') is-invalid focused is-focused @endif">
                                        <label class="form-label">Password</label>
                                        <input 
                                            type="password" 
                                            class="form-control"
                                            wire:model="password" 
                                            id="password"
                                            name="password"
                                        >
                                    </div>

                                    @error('password')
                                        <span class="text-danger inputerror">
                                            {{ $message }}
                                        </span>
                                    @enderror 

                                    <div class="input-group input-group-outline mt-3 @error('password') is-invalid focused is-focused @endif">
                                        <label class="form-label">Confirm Password</label>
                                        <input 
                                            type="password" 
                                            class="form-control"
                                            wire:model="password" 
                                            id="password_confirmation"
                                            name="password_confirmation"
                                        >
                                    </div>

                                    @error('password_confirmation')
                                        <span class="text-danger inputerror">
                                            {{ $message }}
                                        </span>
                                    @enderror 

                                    {{-- <div class="form-check form-check-info text-start ps-0 mt-3">
                                        <input class="form-check-input" type="checkbox" value id="flexCheckDefault" checked>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            I agree the <a href="javascript:;" class="text-dark font-weight-bolder">Terms and Conditions</a>
                                        </label>
                                    </div> --}}
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0">
                                            Registrarse/Sign Up
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer text-center pt-0 px-lg-2 px-1">
                            <p class="mb-2 text-sm mx-auto">
                            Tienes ya una cuenta?
                            <a href=" {{ route('login') }} " class="text-primary text-gradient font-weight-bold">Iniciar sesion</a>
                            </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </section>
    </main>

    <script src=" {{ asset('assets/js/core/popper.min.js') }} "></script>
    <script src=" {{ asset('assets/js/core/bootstrap.min.js') }} "></script>
    <script src=" {{ asset('assets/js/plugins/perfect-scrollbar.min.js') }} "></script>
    <script src=" {{ asset('assets/js/plugins/smooth-scrollbar.min.js') }} "></script>
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

    <script src="/livewire/livewire.js?id=90730a3b0e7144480175" data-turbo-eval="false" data-turbolinks-eval="false"></script>
    {{-- <script data-turbo-eval="false" data-turbolinks-eval="false">
        if (window.livewire) {
            console.warn('Livewire: It looks like Livewire\'s @livewireScripts JavaScript assets have already been loaded. Make sure you aren\'t loading them twice.')
        }

        window.livewire = new Livewire();
        window.livewire.devTools(true);
        window.Livewire = window.livewire;
        window.livewire_app_url = '';
        window.livewire_token = 'KuFhsBXRNZBwqSF4fakYCVyDs7fs03VQsCW7HNy8';

        /* Make sure Livewire loads first. */
        if (window.Alpine) {
            /* Defer showing the warning so it doesn't get buried under downstream errors. */
            document.addEventListener("DOMContentLoaded", function () {
                setTimeout(function() {
                    console.warn("Livewire: It looks like AlpineJS has already been loaded. Make sure Livewire\'s scripts are loaded before Alpine.\\n\\n Reference docs for more info: http://laravel-livewire.com/docs/alpine-js")
                })
            });
        }

        /* Make Alpine wait until Livewire is finished rendering to do its thing. */
        window.deferLoadingAlpine = function (callback) {
            window.addEventListener('livewire:load', function () {
                callback();
            });
        };

        let started = false;

        window.addEventListener('alpine:initializing', function () {
            if (! started) {
                window.livewire.start();

                started = true;
            }
        });

        document.addEventListener("DOMContentLoaded", function () {
            if (! started) {
                window.livewire.start();

                started = true;
            }
        });
    </script> --}}
    {{-- <script defer src="https://static.cloudflareinsights.com/beacon.min.js/v2b4487d741ca48dcbadcaf954e159fc61680799950996" integrity="sha512-D/jdE0CypeVxFadTejKGTzmwyV10c1pxZk/AqjJuZbaJwGMyNHY3q/mTPWqMUnFACfCTunhZUVcd4cV78dK1pQ==" data-cf-beacon='{"rayId":"7b707972baf2e983","version":"2023.3.0","r":1,"token":"1b7cbb72744b40c580f8633c6b62637e","si":100}' crossorigin="anonymous"></script> --}}
    </body>
</html>
