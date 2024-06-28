<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default"
    data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Kayıt Ol - {{ $settings->site_title }}</title>

    <meta name="description" content="{{ $settings->site_description }}" />
    <meta name="keyword" content="{{ $settings->site_keywords }}" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset($settings->site_favicon) }}" />

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

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css') }}" />
    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('assets/js/config.js') }}"></script>
</head>

<body>
    <!-- Content -->

    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Register Card -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                            <a href="{{ route('home') }}" class="app-brand-link gap-2">
                                <img src="{{ $settings->site_logo }}" alt="{{ $settings->site_title }}">
                            </a>
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-2">Kayıt olun ve bize katılın 🚀</h4>

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

                        <form class="mb-3 mt-3" action="{{ route('auth.register') }}" method="POST"
                            id="register-form">
                            @csrf
                            <div class="mb-3">
                                <label for="role" class="form-label">Kayıt Tipi</label>
                                <select id="role" name="role" id="role" class="form-control" required>
                                    <option value="user" selected>Influencer</option>
                                    <option value="merchant">Marka</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label" id="username">Adınız ve Soyadınız</label>
                                <input type="text" class="form-control" name="name"
                                    placeholder="Lütfen adınızı giriniz..." autofocus required />
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email"
                                    placeholder="Email adresiniz giriniz..." />
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Telefon</label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                    placeholder="Telefon numaranızı giriniz..." required />
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <label class="form-label" for="password">Şifre</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" class="form-control" name="password"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="password" required />
                                </div>
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <label class="form-label" for="password">Şifre Tekrar</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" class="form-control" name="password_confirmation"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="password" required />
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="terms-conditions"
                                        name="terms" />
                                    <label class="form-check-label" for="terms-conditions">
                                        <a href="javascript:void(0);">Gizlilik ve Kullanıcı Politikasını</a> kabul
                                        ediyorum.
                                    </label>
                                </div>
                            </div>
                            <button class="btn btn-primary d-grid w-100" id="register-button" disabled>Kayıt
                                Ol</button>
                        </form>

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const form = document.getElementById('register-form');
                                const submitButton = document.getElementById('register-button');
                                const inputs = form.querySelectorAll('input[required], select[required]');
                                const checkbox = document.getElementById('terms-conditions');

                                function checkFormValidity() {
                                    let allFilled = true;
                                    inputs.forEach(input => {
                                        if (!input.value.trim()) {
                                            allFilled = false;
                                        }
                                    });

                                    if (checkbox.checked && allFilled) {
                                        submitButton.disabled = false;
                                    } else {
                                        submitButton.disabled = true;
                                    }
                                }

                                inputs.forEach(input => {
                                    input.addEventListener('input', checkFormValidity);
                                });

                                checkbox.addEventListener('change', checkFormValidity);
                            });
                        </script>

                        <p class="text-center">
                            <span>Zaten bir hesabınız var mı?</span>
                            <a href="{{ route('auth.login') }}">
                                <span>Giriş Yapın</span>
                            </a>
                        </p>
                    </div>
                </div>
                <!-- Register Card -->
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
    <script>
        var role = document.getElementById('role');

        role.addEventListener('change', function() {
            if (role.value === 'merchant') {
                document.getElementById('username').innerText = 'Marka Adı';
            } else {
                document.getElementById('username').innerText = 'Adınız ve Soyadınız';
            }
        });
    </script>
</body>

</html>
