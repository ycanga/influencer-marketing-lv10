@extends('layouts.app')

@section('title', 'Bakiye Bilgileri')

@section('content')
    @include('layouts.alert')
    {!! $paymentInput ?? '' !!}
    <div class="container mt-3">
        <div class="card">
            <h5 class="card-header">Bakiye Geçmişi</h5>
            <div class="d-flex justify-content-end mb-3">
                <button class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#basicModal">Bakiye
                    Yükle</button>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Yükleme Tipi</th>
                            <th>Yüklenen Tutar</th>
                            <th>Durum</th>
                            <th>Yükleme Tarihi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0 mb-5">
                        @php
                            $counter = 1;
                        @endphp
                        @foreach ($userBalance as $key => $item)
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
                            </tr>
                        @endforeach
                        @if ($userBalance->count() == 0)
                            <tr>
                                <td colspan="5" class="text-center">
                                    <b>Henüz bakiye yükleme işlemi gerçekleştirmediniz.</b>
                                </td>
                            </tr>
                        @endif
                        <tr class="text-center">
                            <td colspan="4" class="text-start">
                                Yüklenen Toplam Tutar:
                            </td>
                            <td class="text-end">
                                <b class="me-5">
                                    {{ $totalBalance }} ₺
                                </b>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{ $userBalance->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
    {{-- Balance Transfer Modal --}}
    @include('balance.modals.transfer-modal')
@endsection
