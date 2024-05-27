@extends('layouts.app')

@section('title', 'Bakiye Bilgileri')

@section('content')
    @include('layouts.alert')
    <div class="container mt-3">
        <div class="card">
            <h5 class="card-header">Bakiye Geçmişi</h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Yükleme Tipi</th>
                            <th>Yüklenen Tutar</th>
                            <th>Durum</th>
                            <th>Yükleme Tarihi</th>
                            <th>İşlem</th>
                        </tr>
                    </thead>
                    {{-- @dd($balanceTransfers) --}}
                    <tbody class="table-border-bottom-0 mb-5">
                        @php
                            $counter = 1;
                        @endphp
                        @foreach ($balanceTransfers as $key => $item)
                            <tr>
                                <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                    <strong>{{ $counter++ }}</strong>
                                </td>
                                <td>{{ $item->type }}</td>
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
                                    <button class="btn btn-danger btn-sm"
                                        onclick="closeBalanceTransfer({{ $item->id }})">İptal Et</button>
                                    <button class="btn btn-success btn-sm"
                                        onclick="approveBalanceTransfer({{ $item->id }})">Onayla</button>
                                </td>
                            </tr>
                        @endforeach
                        @if ($balanceTransfers->count() == 0)
                            <tr>
                                <td colspan="5" class="text-center">
                                    <b>Onay bekleyen yükleme işlemi bulunamadı.</b>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{ $balanceTransfers->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
    @include('admin.balance.modals.show')

    <script>
        function closeBalanceTransfer(id) {
            if (confirm('Yükleme işlemini iptal etmek istediğinize emin misiniz?')) {
                var url = '{{ route('admin.balance.reject', ':id') }}';
                url = url.replace(':id', id);
                window.location.href = url;
            }
        }

        function approveBalanceTransfer(id) {
            if (confirm('Yükleme işlemini onaylamak istediğinize emin misiniz?')) {
                var url = '{{ route('admin.balance.approve', ':id') }}';
                url = url.replace(':id', id);
                window.location.href = url;
            }
        }
    </script>
@endsection
