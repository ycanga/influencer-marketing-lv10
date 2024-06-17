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
                                                <a class="btn btn-primary btn-sm"
                                                    href="{{ route('admin.user.show', ['id' => $user->id]) }}">Detay</a>
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
    @endsection
