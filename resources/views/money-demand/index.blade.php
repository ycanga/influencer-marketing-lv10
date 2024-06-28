@extends('layouts.app')

@section('title', 'Para Çekme Talepleri')

@section('content')
    @include('layouts.alert')

    <div class="container mt-3">
        <h5>Para Çekme Talepleri</h5>
        @user
            <div class="d-flex justify-content-end mb-3">
                <button class="btn btn-success me-3" data-bs-toggle="modal" data-bs-target="#createModal">Talep
                    Oluştur +</button>
            </div>
        @enduser
        <div class="col-xl-12">
            <div class="nav-align-top mb-4">
                <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
                    <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-pills-justified-home" aria-controls="navs-pills-justified-home"
                            aria-selected="true">
                            <i class='tf-icons bx bxs-analyse'></i> Bekleyen Talepler
                            @if ($moneyDemands->where('status', 'pending')->count() > 0)
                                <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-danger">
                                    {{ $moneyDemands->where('status', 'pending')->count() }}
                                </span>
                            @endif
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-pills-justified-profile" aria-controls="navs-pills-justified-profile"
                            aria-selected="false">
                            <i class='tf-icons bx bx-check'></i>
                            Onaylanan Talepler
                            @if ($moneyDemands->where('status', 'success')->count() > 0)
                                <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-danger">
                                    {{ $moneyDemands->where('status', 'success')->count() }}
                                </span>
                            @endif
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-pills-justified-messages" aria-controls="navs-pills-justified-messages"
                            aria-selected="false">
                            <i class='tf-icons bx bx-x' ></i> Reddedilen Talepler
                            @if ($moneyDemands->where('status', 'failed')->count() > 0)
                                <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-danger">
                                    {{ $moneyDemands->where('status', 'failed')->count() }}
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
                                        <th>#ID</th>
                                        @admin
                                            <th>Kullanıcı</th>
                                        @endadmin
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
                                    @foreach ($moneyDemands->where('status', 'pending') as $key => $item)
                                        @php
                                            if ($item->status == 'success') {
                                                $total = $total + $item->amount;
                                            }
                                        @endphp
                                        <tr>
                                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                                <strong>#{{ $item->id }}</strong>
                                            </td>
                                            @admin
                                                <td>
                                                    <a href="{{route('admin.user.show',['id' => $item->user->id])}}">{{ ucfirst($item->user->name) }}</a>
                                                </td>
                                            @endadmin
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
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center">
                                {{ $moneyDemands->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="navs-pills-justified-profile" role="tabpanel">
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#ID</th>
                                        @admin
                                            <th>Kullanıcı</th>
                                        @endadmin
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
                                    @foreach ($moneyDemands->where('status', 'success') as $key => $item)
                                        @php
                                            if ($item->status == 'success') {
                                                $total = $total + $item->amount;
                                            }
                                        @endphp
                                        <tr>
                                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                                <strong>#{{ $item->id }}</strong>
                                            </td>
                                            @admin
                                                <td>
                                                    <a href="{{route('admin.user.show',['id' => $item->user->id])}}">{{ ucfirst($item->user->name) }}</a>
                                                </td>
                                            @endadmin
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
                    <div class="tab-pane fade" id="navs-pills-justified-messages" role="tabpanel">
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#ID</th>
                                        @admin
                                            <th>Kullanıcı</th>
                                        @endadmin
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
                                    @foreach ($moneyDemands->where('status', 'failed') as $key => $item)
                                        @php
                                            if ($item->status == 'success') {
                                                $total = $total + $item->amount;
                                            }
                                        @endphp
                                        <tr>
                                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                                <strong>#{{ $item->id }}</strong>
                                            </td>
                                            @admin
                                                <td>
                                                    <a href="{{route('admin.user.show',['id' => $item->user->id])}}">{{ ucfirst($item->user->name) }}</a>
                                                </td>
                                            @endadmin
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
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center">
                                {{ $moneyDemands->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
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
