@extends('layouts.app')

@section('title', 'Bakiye Bilgileri')

@section('content')
    @include('layouts.alert')
    <div class="container mt-3">
        <h5>Bakiye Geçmişi</h5>
        <div class="col-xl-12">
            <div class="nav-align-top mb-4">
                <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
                    <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-pills-justified-home" aria-controls="navs-pills-justified-home"
                            aria-selected="true">
                            <i class="tf-icons bx bxs-analyse"></i> Bekleyen Talepler
                            @if ($balanceTransfers->where('status', 'pending')->count() > 0)
                                <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-danger">
                                    {{ $balanceTransfers->where('status', 'pending')->count() }}
                                </span>
                            @endif
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-pills-justified-profile" aria-controls="navs-pills-justified-profile"
                            aria-selected="false">
                            <i class="tf-icons bx bx-check"></i> Onaylanan Talepler
                            @if ($balanceTransfers->where('status', 'success')->count() > 0)
                                <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-danger">
                                    {{ $balanceTransfers->where('status', 'success')->count() }}
                                </span>
                            @endif
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-pills-justified-messages" aria-controls="navs-pills-justified-messages"
                            aria-selected="false">
                            <i class="tf-icons bx bx-x"></i> Reddedilen Talepler
                            @if ($balanceTransfers->where('status', 'failed')->count() > 0)
                                <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-danger">
                                    {{ $balanceTransfers->where('status', 'failed')->count() }}
                                </span>
                            @endif
                        </button>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="navs-pills-justified-home" role="tabpanel">
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
                                <tbody class="table-border-bottom-0 mb-5">
                                    @php
                                        $counter = 1;
                                    @endphp
                                    @foreach ($balanceTransfers->where('status','pending') as $key => $item)
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
                                                    data-bs-target="#basicModal"
                                                    data-item="{{ $item }}">Detay</button>
                                                <button class="btn btn-danger btn-sm"
                                                    onclick="closeBalanceTransfer({{ $item->id }})">İptal Et</button>
                                                <button class="btn btn-success btn-sm"
                                                    onclick="approveBalanceTransfer({{ $item->id }})">Onayla</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @if ($balanceTransfers->where('status','pending')->count() == 0)
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
                    <div class="tab-pane fade" id="navs-pills-justified-profile" role="tabpanel">
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
                                <tbody class="table-border-bottom-0 mb-5">
                                    @php
                                        $counter = 1;
                                    @endphp
                                    @foreach ($balanceTransfers->where('status','success') as $key => $item)
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
                                                    data-bs-target="#basicModal"
                                                    data-item="{{ $item }}">Detay</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @if ($balanceTransfers->where('status','success')->count() == 0)
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
                    <div class="tab-pane fade" id="navs-pills-justified-messages" role="tabpanel">
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
                                <tbody class="table-border-bottom-0 mb-5">
                                    @php
                                        $counter = 1;
                                    @endphp
                                    @foreach ($balanceTransfers->where('status','failed') as $key => $item)
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
                                                    data-bs-target="#basicModal"
                                                    data-item="{{ $item }}">Detay</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @if ($balanceTransfers->where('status','failed')->count() == 0)
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
