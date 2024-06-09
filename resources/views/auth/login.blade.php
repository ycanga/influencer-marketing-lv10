<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default"
    data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Giriş Yap - {{$settings->site_title}}</title>

    <meta name="description" content="{{$settings->site_description}}" />
    <meta name="keyword" content="{{$settings->site_keywords}}" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css') }}" />
    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('assets/js/config.js') }}"></script>
</head>

<body>
    <!-- Content -->

    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Register -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                            <a href="{{route('home')}}" class="app-brand-link gap-2">
                                <img src="{{$settings->site_logo}}" alt="{{$settings->site_title}}">
                            </a>
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-2">{{$settings->site_name}} Hoş geldiniz... 👋</h4>

                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if (session('validation'))
                            @foreach (array_reverse(json_decode(session('validation'), true)) as $error)
                                <div class=" position-fixed bottom-0 end-0 p-3" style="z-index: 11">
                                    <div id="liveToast" class="toast show" role="alert" aria-live="assertive"
                                        aria-atomic="true">
                                        <div class="toast-header">
                                            @foreach ($error as $item)
                                                <label class="me-auto">{{ $item }}</label>
                                            @endforeach
                                            <button type="button" class="btn-close" data-bs-dismiss="toast"
                                                aria-label="Close"></button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        @endif

                        <style>
                            .toast {
                                background-color: #d03838 !important;
                                color: #ffff !important;
                            }

                            .toast-header {
                                color: #ffff !important;
                            }
                        </style>
                        <script>
                            var toastLiveExample = document.getElementById('liveToastBtn')
                            var toastLiveContainer = document.getElementById('liveToast')
                            if (toastLiveExample) {
                                toastLiveExample.addEventListener('click', function() {
                                    var bsToast = new bootstrap.Toast(toastLiveContainer)

                                    // Show the Toast
                                    bsToast.show()
                                })
                            }
                        </script>

                        <form class="mb-3" action="{{ route('auth.login') }}" method="POST" id="login-form">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email"
                                    placeholder="Lütfen email adresinizi girin..." autofocus required />
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="password">Şifre</label>
                                    <a href="auth-forgot-password-basic.html">
                                        <small>Şifremi unuttum?</small>
                                    </a>
                                </div>
                                <div class="input-group input-group-merge">
                                    <input type="password" class="form-control" name="password"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="password" required id="password" />
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember-me" />
                                    <label class="form-check-label" for="remember-me"> Beni Hatırla </label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" type="submit" id="login-button" disabled>Giriş Yap</button>
                            </div>
                        </form>

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const form = document.getElementById('login-form');
                                const submitButton = document.getElementById('login-button');
                                const emailInput = document.getElementById('email');
                                const passwordInput = document.getElementById('password');

                                function checkFormValidity() {
                                    if (emailInput.value.trim() && passwordInput.value.trim()) {
                                        submitButton.disabled = false;
                                    } else {
                                        submitButton.disabled = true;
                                    }
                                }

                                emailInput.addEventListener('input', checkFormValidity);
                                passwordInput.addEventListener('input', checkFormValidity);

                                // İlk yüklemede formun geçerliliğini kontrol et
                                checkFormValidity();
                            });
                        </script>


                        <p class="text-center">
                            <span>Bir hesabınız yok mu?</span>
                            <a href="{{ route('register') }}">
                                <span>Kayıt Olun</span>
                            </a>
                        </p>
                    </div>
                </div>
                <!-- /Register -->
            </div>
        </div>
    </div>

    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>
