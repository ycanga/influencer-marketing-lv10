@extends('layouts.app')

@section('title', 'Para Çekme Talepleri')

@section('content')
    @include('layouts.alert')

    <div class="container mt-3">
        <div class="card">
            <h5 class="card-header">Para Çekme Talepleri</h5>
            @user
                <div class="d-flex justify-content-end mb-3">
                    <button class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#createModal">Talep
                        Oluştur</button>
                </div>
            @enduser
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Talep Tutarı</th>
                            <th>Durum</th>
                            <th>Talep Oluşturma Tarihi</th>
                            <th>İşlem</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0 mb-5">
                        @php
                            $total = 0;
                        @endphp
                        @foreach ($moneyDemands as $key => $item)
                            @php
                                if ($item->status == 'success') {
                                    $total = $total + $item->amount;
                                }
                            @endphp
                            <tr>
                                <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                    <strong>#{{ $item->id }}</strong>
                                </td>
                                <td>
                                    {{ $item->amount }} ₺
                                </td>
                                <td>
                                    @if ($item->status == 'success')
                                        <span class="badge bg-success">Başarılı</span>
                                    @elseif($item->status == 'failed')
                                        <span class="badge bg-danger">Başarısız</span>
                                    @else
                                        <span class="badge bg-warning">Beklemede</span>
                                    @endif
                                </td>
                                <td>
                                    {{ $item->created_at->format('d.m.Y H:i') }}
                                </td>
                                <td>
                                    <button class="btn btn-primary btn-sm showDetails" data-bs-toggle="modal"
                                        data-bs-target="#basicModal" data-item="{{ $item }}">Detay</button>
                                    @admin
                                        @if ($item->status == 'pending')
                                            <button class="btn btn-danger btn-sm"
                                                onclick="closeDemand({{ $item->id }})">İptal
                                                Et</button>
                                            <button class="btn btn-success btn-sm"
                                                onclick="approveDemand({{ $item->id }})">Onayla</button>
                                        @endif
                                    @endadmin
                                </td>
                            </tr>
                        @endforeach
                        @if ($moneyDemands->count() == 0)
                            <tr>
                                <td colspan="5" class="text-center">
                                    <b>Henüz hiç para çekme talebi oluşturulmadı.</b>
                                </td>
                            </tr>
                        @endif
                        @user
                            <tr class="text-center">
                                <td colspan="3" class="text-start">
                                    Onaylanan Toplam Tutar:
                                </td>
                                <td class="text-end">
                                    <b class="me-5">
                                        {{ $total }} ₺
                                    </b>
                                </td>
                            </tr>
                        @enduser
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{ $moneyDemands->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>

    @include('money-demand.modals.show')
    @include('money-demand.modals.create')

    @admin
        <script>
            function closeDemand(id) {
                if (confirm('Talebi iptal etmek istediğinize emin misiniz?')) {
                    var url = '{{ route('admin.demand.reject', ':id') }}';
                    url = url.replace(':id', id);
                    window.location.href = url;
                }
            }

            function approveDemand(id) {
                if (confirm('Talebi onaylamak istediğinize emin misiniz?')) {
                    var url = '{{ route('admin.demand.approve', ':id') }}';
                    url = url.replace(':id', id);
                    window.location.href = url;
                }
            }
        </script>
    @endadmin
@endsection
