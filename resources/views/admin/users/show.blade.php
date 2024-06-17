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
                                            Sadece <b>.png, .jpeg ya da .jpg</b> formatlarında Maksimum <b>2 MB</b> boyutunda resim yükleyebilirsiniz.
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
                                    <button type="submit" class="btn btn-danger me-2" onclick="deleteUser({{$user->id}})"><i class='bx bxs-error'></i> Kullanıcıyı Sil</button>
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
@endsection
