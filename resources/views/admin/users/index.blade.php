@extends('layouts.app')

@section('title', 'Kullanıcılar')
@section('content')
    @include('layouts.alert')
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-4">
                <h4 class="card-title">Kullanıcılar</h4>
                <div class="card">
                    <div class="card-body">
                        <!-- Users Table -->
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Adı</th>
                                        <th>Email</th>
                                        <th>Telefon</th>
                                        <th>Role</th>
                                        <th>Mevcut Bakiye (₺)</th>
                                        <th>Durum</th>
                                        <th>İşlemler</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>
                                                <img src="{{ asset($user->photo ?? 'images/site_favicon/1717860313.png') }}"
                                                    alt="{{ $user->name }}" width="35" height="40"> &nbsp;
                                                {{ ucfirst($user->name) }}
                                            </td>
                                            <td><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                                            <td><a href="tel://{{ $user->phone }}">{{ $user->phone }}</a></td>
                                            <td>
                                                @if ($user->role == 'user')
                                                    <span class="badge bg-label-primary me-1">Kullanıcı</span>
                                                @elseif($user->role == 'admin')
                                                    <span class="badge bg-label-success me-1">Admin</span>
                                                @else
                                                    <span class="badge bg-label-warning me-1">Marka</span>
                                                @endif
                                            </td>
                                            <td class="text-success">{{ $user->balance }} ₺</td>
                                            <td>
                                                @if ($user->status == 'active')
                                                    <span class="badge bg-label-primary me-1">Aktif</span>
                                                @else
                                                    <span class="badge bg-label-danger me-1">Pasif</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        @if ($user->status == 'active')
                                                            <a class="dropdown-item"
                                                                href="{{ route('admin.user.block', ['id' => $user->id]) }}"><i
                                                                    class='bx bxs-user-x'></i> Pasif Yap</a>
                                                        @else
                                                            <a class="dropdown-item"
                                                                href="{{ route('admin.user.unblock', ['id' => $user->id]) }}"><i
                                                                    class='bx bxs-user-check'></i> Aktif Yap</a>
                                                        @endif

                                                        @if ($user->role == 'user')
                                                            <button class="dropdown-item" type="button"
                                                                onclick="upgradeAdmin({{ $user->id }})"
                                                                href="{{ route('admin.user.role', ['id' => $user->id]) }}"><i
                                                                    class='bx bx-chevrons-up'></i></i> Admin Yap</button>
                                                        @elseif($user->role == 'admin')
                                                            <button class="dropdown-item" type="button"
                                                                onclick="downgradeAdmin({{ $user->id }})"
                                                                href="{{ route('admin.user.role', ['id' => $user->id]) }}"><i
                                                                    class='bx bx-chevrons-down'></i></i> Adminliği
                                                                Kaldır</button>
                                                        @endif
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.user.delete', ['id' => $user->id]) }}"><i
                                                                class="bx bx-trash me-1"></i> Sil</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center">
                                {{ $users->links('pagination::bootstrap-4') }}
                            </div>
                            <!--/ Users Table -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function upgradeAdmin(id) {
                if (confirm('Kullanıcıyı admin yapmak istediğinize emin misiniz ?')) {
                    var url = '{{ route('admin.user.role', ':id') }}';
                    url = url.replace(':id', id);
                    window.location.href = url;
                }
            }

            function downgradeAdmin(id) {
                if (confirm('Kullanıcıyı user yapmak istediğinize emin misiniz ?')) {
                    var url = '{{ route('admin.user.role', ':id') }}';
                    url = url.replace(':id', id);
                    window.location.href = url;
                }
            }
        </script>
    @endsection
