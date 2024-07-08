@extends('layouts.app')

@section('title', 'Profil Ayarları')

@section('content')
    @include('layouts.alert')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4">Kullanıcı Detayı</h4>
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <h5 class="card-header">Profil Detayları</h5>
                        <!-- Account -->
                        <form action="{{ route('admin.user.update', ['id' => $user->id]) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="d-flex align-items-start align-items-sm-center gap-4">
                                    <img src="{{ asset($user->photo) ?? 'images/site_favicon/1717860313.png' }}"
                                        alt="{{ $user->name }} kullanıcısı" class="d-block rounded" height="100"
                                        width="100" id="uploadedAvatar" />
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
                                            value="{{ ucfirst($user->name) }}" placeholder="Adınızı giriniz..." autofocus
                                            required />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="email" class="form-label">E-mail</label>
                                        <input class="form-control" type="text" id="email" name="email"
                                            value="{{ $user->email }}" placeholder="E-mail adresinizi giriniz..."
                                            required />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="phoneNumber">Telefon</label>
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text">TR (+90)</span>
                                            <input type="text" id="phoneNumber" name="phone" class="form-control"
                                                value="{{ $user->phone }}" required
                                                placeholder="Telefon numaranızı giriniz..." />
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="role" class="form-label">Kullanıcı Rolü</label>
                                        <select name="role" class="form-select">
                                            <option value="user" @if ($user->role == 'user') selected @endif>
                                                Kullanıcı</option>
                                            <option value="admin" @if ($user->role == 'admin') selected @endif>Admin
                                            </option>
                                            <option value="merchant" @if ($user->role == 'merchant') selected @endif>Marka
                                            </option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="role" class="form-label">Kullanıcı Durumu</label>
                                        {{-- <input type="text" class="form-control" name="status"
                                            value="{{ $user->status }}" /> --}}
                                        <select name="status" class="form-select">
                                            <option value="active" @if ($user->status == 'active') selected @endif>Aktif
                                            </option>
                                            <option value="inactive" @if ($user->status == 'inactive') selected @endif>Pasif
                                            </option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="role" class="form-label">Kullanıcı Mevcut Bakiyesi (₺)</label>
                                        <input type="text" class="form-control" name="balance"
                                            value="{{ $user->balance }}" />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="password" class="form-label">Yeni Şifreniz</label>
                                        <div id="defaultFormControlHelp" class="form-text">
                                            <b class="text-danger">**</b>
                                            Kullanıcı şifresini değiştirmek istemiyorsanız bu alanı boş bırakabilirsiniz.
                                        </div>
                                        <input type="text" class="form-control" name="password" id="password"
                                            placeholder="********" />
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label for="password_confirmation" class="form-label">Yeni Şifreniz
                                            (Tekrar)</label>
                                        <div id="defaultFormControlHelp" class="form-text">
                                            <b class="text-danger">**</b>
                                            Kullanıcı şifresini değiştirmek istemiyorsanız bu alanı boş bırakabilirsiniz.
                                        </div>
                                        <input type="text" class="form-control" name="password_confirmation"
                                            id="password_confirmation" placeholder="********" />
                                    </div>

                                </div>
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary me-2">Kaydet</button>
                                    <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">Geri Dön</a>
                                </div>
                            </div>
                        </form>
                        <!-- /Account -->
                    </div>
                </div>
            </div>
        </div>
        <!-- / Content -->
    </div>
    <!-- Content wrapper -->

    @admin
        <div class="container">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Kullanıcının Banka Bilgileri</h5>
                    <div>
                        <div class="card-body row align-items-center">
                            <div class="col-12 col-xl-6 mb-3 mb-xl-0">
                                <label for="bankName" class="form-label">BANKA ISMı <b class="text-danger">*</b> </label>
                                <input type="text" class="form-control" id="bankName" name="bank_name"
                                    value="{{ $user->getPaymentData[0]->bank_name ?? '' }}"
                                    placeholder="Banka ismini giriniz..." aria-describedby="formControlHelp1" disabled />
                                <div id="formControlHelp1" class="form-text">
                                    Bankanıza ait isim bilgisini giriniz.
                                </div>
                            </div>
                            <div class="col-12 col-xl-6">
                                <label for="accountNumber" class="form-label">Hesap Numarası ya da IBAN <b
                                        class="text-danger">*</b> </label>
                                <input type="text" class="form-control" id="accountNumber" name="account_number"
                                    value="{{ $user->getPaymentData[0]->iban ?? '' }}"
                                    placeholder="Hesap numarasını giriniz..." aria-describedby="formControlHelp2" disabled />
                                <div id="formControlHelp2" class="form-text">
                                    Banka hesap numaranızı ya da IBAN numaranızı giriniz.
                                </div>
                            </div>
                            <div class="col-12 col-xl-6 mb-3 mb-xl-0 mt-3">
                                <label for="accountUsername" class="form-label">Banka Hesap Sahibi Ismı <b
                                        class="text-danger">*</b> </label>
                                <input type="text" class="form-control" id="accountUsername" name="account_username"
                                    value="{{ $user->getPaymentData[0]->account_username ?? '' }}"
                                    placeholder="Banka Hesap Sahibinim ismini giriniz..." aria-describedby="formControlHelp1"
                                    disabled />
                                <div id="formControlHelp1" class="form-text">
                                    Banka hesap sahibinin ismini giriniz.
                                </div>
                            </div>
                            <div class="col-12 col-xl-6 mt-3">
                                <label for="desc" class="form-label">Açıklama</label>
                                <input type="text" class="form-control" id="desc" name="desc"
                                    placeholder="Açıklama giriniz..." value="{{ $user->getPaymentData[0]->desc ?? '' }}"
                                    aria-describedby="formControlHelp2" disabled />
                                <div id="formControlHelp2" class="form-text">
                                    Ödeme ile ilgili açıklama giriniz.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endadmin

    {{-- <div class="container">
        <div class="alert alert-warning card border">
            <h4 class="alert-heading">Dikkat!</h4>
            <p class="mb-0">
                Kullanıcıyı silmek istediğinizde, kullanıcıya ait tüm bilgiler ve veriler silinecektir. Bu işlem geri
                alınamaz. Kullanıcıyı silmek istediğinizden emin misiniz?
            </p>

            <div class="form-check mt-3">
                <button type="submit" class="btn btn-danger me-2" onclick="deleteUser({{ $user->id }})"><i
                        class='bx bxs-error'></i> Kullanıcıyı
                    Sil</button>
            </div>
        </div>
    </div> --}}

    <div class="container">

        <div class="card">
            <h5 class="card-header">Kullanıcıyı Sil</h5>
            <div class="card-body">
                <div class="mb-3 col-12 mb-0">
                    <div class="alert alert-warning">
                        <h6 class="alert-heading fw-bold mb-1">Kullanıcıyı silmek istediğinize emin misiniz ?
                        </h6>
                        <p class="mb-0">Kullanıcıyı silmek istediğinizde, kullanıcıya ait tüm bilgiler ve veriler
                            silinecektir. Bu işlem geri
                            alınamaz. Kullanıcıyı silmek istediğinizden emin misiniz?</p>
                    </div>
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="accountDelete" id="accountDelete" />
                    <label class="form-check-label" for="accountDelete">
                        Kullanıcıyı silmek istiyorum.
                    </label>
                </div>
                <button type="submit" class="btn btn-danger me-2" id="accountDeleteButton" onclick="deleteUser({{ $user->id }})" disabled><i
                        class='bx bxs-error' ></i> Kullanıcıyı
                    Sil</button>
            </div>
        </div>
    </div>
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

    <script>
        function deleteUser(id) {
            if (confirm('Kullanıcıyı silmek istediğinize emin misiniz ?')) {
                var url = '{{ route('admin.user.delete', ':id') }}';
                url = url.replace(':id', id);
                window.location.href = url;
            }
        }
    </script>

    <script>
        var accountDelete = document.getElementById('accountDelete');
        var button = document.getElementById('accountDeleteButton');

        accountDelete.addEventListener('change', function() {
            if (accountDelete.checked) {
                button.disabled = false;
            } else {
                button.disabled = true;
            }
        });
    </script>
@endsection
