@extends('layouts.app')

@section('title', 'Profil Ayarları')

@section('content')
    @include('layouts.alert')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4">Profil Ayarları</h4>

            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <h5 class="card-header">Profil Detayları</h5>
                        <!-- Account -->
                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="d-flex align-items-start align-items-sm-center gap-4">
                                    <img src="{{ auth()->user()->photo ?? 'images/site_favicon/1717860313.png' }}"
                                        alt="user-avatar" class="d-block rounded" height="100" width="100"
                                        id="uploadedAvatar" />
                                    <div class="button-wrapper">
                                        <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                            <span class="d-none d-sm-block">Yeni Resim Yükle</span>
                                            <i class="bx bx-upload d-block d-sm-none"></i>
                                            <input type="file" id="upload" name="photo" class="account-file-input"
                                                hidden accept="image/png, image/jpeg" />
                                        </label>
                                        <i id="tick" class="bx bx-check-circle mb-4"
                                            style="color: green; font-size: 24px; visibility: hidden;"></i>
                                        <p class="text-muted mb-0">
                                            Sadece <b>.png, .jpeg ya da .jpg</b> formatlarında Maksimum <b>2 MB</b>
                                            boyutunda resim yükleyebilirsiniz.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-0" />
                            <div class="card-body">
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="firstName" class="form-label">İsim</label>
                                        <input class="form-control" type="text" id="firstName" name="name"
                                            value="{{ ucfirst(auth()->user()->name) }}" placeholder="Adınızı giriniz..."
                                            autofocus required />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="email" class="form-label">E-mail</label>
                                        <input class="form-control" type="text" id="email" name="email"
                                            value="{{ auth()->user()->email }}" placeholder="E-mail adresinizi giriniz..."
                                            required />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="phoneNumber">Telefon</label>
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text">TR (+90)</span>
                                            <input type="text" id="phoneNumber" name="phone" class="form-control"
                                                value="{{ auth()->user()->phone }}" required
                                                placeholder="Telefon numaranızı giriniz..." />
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="role" class="form-label">Kullanıcı Rolü</label>
                                        <input type="text" class="form-control"
                                            value="{{ ucfirst(auth()->user()->role) }}" disabled />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="password" class="form-label">Yeni Şifreniz</label>
                                        <div id="defaultFormControlHelp" class="form-text">
                                            <b class="text-danger">**</b>
                                            Şifrenizi değiştirmek istemiyorsanız bu alanı boş bırakabilirsiniz.
                                        </div>
                                        <input type="text" class="form-control" name="password" id="password"
                                            placeholder="********" />
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label for="password_confirmation" class="form-label">Yeni Şifreniz (Tekrar)</label>
                                        <div id="defaultFormControlHelp" class="form-text">
                                            <b class="text-danger">**</b>
                                            Şifrenizi değiştirmek istemiyorsanız bu alanı boş bırakabilirsiniz.
                                        </div>
                                        <input type="text" class="form-control" name="password_confirmation"
                                            id="password_confirmation" placeholder="********" />
                                    </div>

                                </div>
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary me-2">Kaydet</button>
                                </div>
                            </div>
                        </form>
                        <!-- /Account -->
                    </div>
                    @merchant('true')
                        <div class="card mb-3" id="apiKey">
                            <h5 class="card-header">API Key ( <b class="text-danger">!</b> )</h5>
                            <div class="card-body">
                                <div class="mb-3 col-12 mb-0">
                                    <div class="alert alert-info">
                                        <h6 class="alert-heading fw-bold mb-1 text-danger">Dikkat!</h6>
                                        </h6>
                                        <p class="mb-0">
                                            API Key, uygulamalarınızın ve servislerinizin güvenli bir şekilde iletişim
                                            kurabilmesi için kullanılan bir anahtardır. API Key'iniz size özeldir ve kimseyle
                                            paylaşmamanız gerekmektedir.
                                        </p>
                                    </div>
                                    <div class="row">
                                        <div class="input-group col-8">
                                            <input type="password" class="form-control" id="api-key-input"
                                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                aria-describedby="api-key" value="{{ auth()->user()->bearer_token }}" />
                                            <span id="api-key-toggle" class="input-group-text cursor-pointer">
                                                <i class="bx bx-hide"></i>
                                            </span>
                                            <a href="{{route('profile.refreshApiKey')}}" class="btn btn-primary">Yenile</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endmerchant
                    <div class="card">
                        <h5 class="card-header">Hesabı Sil</h5>
                        <div class="card-body">
                            <div class="mb-3 col-12 mb-0">
                                <div class="alert alert-warning">
                                    <h6 class="alert-heading fw-bold mb-1">Hesabınızı silmek istediğinize emin misiniz ?
                                    </h6>
                                    <p class="mb-0">Hesabınızı sildikten sonra geri dönüşü yoktur. Lütfen emin olun.</p>
                                </div>
                            </div>
                            <form method="POST" action="{{ route('profile.disable') }}">
                                @csrf
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" name="accountActivation"
                                        id="accountActivation" />
                                    <label class="form-check-label" for="accountActivation">Hesabımın devre dışı
                                        bırakılmasını onaylıyorum</label>
                                </div>
                                <button type="submit" class="btn btn-danger deactivate-account" disabled>Hesabı Devre
                                    Dışı
                                    Bırak</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- / Content -->
    </div>
    <!-- Content wrapper -->

    <script>
        var checkbox = document.getElementById('accountActivation');
        var button = document.querySelector('.deactivate-account');

        checkbox.addEventListener('change', function() {
            if (checkbox.checked) {
                button.disabled = false;
            } else {
                button.disabled = true;
            }
        });
    </script>

    <script>
        document.getElementById('upload').addEventListener('change', function() {
            var tick = document.getElementById('tick');
            if (this.files && this.files[0]) {
                tick.style.visibility = 'visible';
            } else {
                tick.style.visibility = 'hidden';
            }
        });
    </script>

    @merchant('true')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const apiKeyInput = document.getElementById('api-key-input');
                const apiKeyToggle = document.getElementById('api-key-toggle');
                const icon = apiKeyToggle.querySelector('i');

                apiKeyToggle.addEventListener('click', function() {
                    if (apiKeyInput.type === 'password') {
                        apiKeyInput.type = 'text';
                        icon.classList.remove('bx-hide');
                        icon.classList.add('bx-show');
                    } else {
                        apiKeyInput.type = 'password';
                        icon.classList.remove('bx-show');
                        icon.classList.add('bx-hide');
                    }
                });
            });
        </script>
    @endmerchant
@endsection
