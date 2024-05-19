@extends('layouts.app')

@section('title', 'Bakiye Bilgileri')

@section('content')
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
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0 mb-5">
                        @foreach ($userBalance as $key => $item)
                            <tr>
                                <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                    <strong>{{ $key + 1 }}</strong>
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
                        <tr class="text-center">
                            <td colspan="4" class="text-start">
                                Yüklenen Toplam Tutar:
                            </td>
                            <td class="text-end my-4">
                                <b>
                                  {{$totalBalance}} ₺
                                </b>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
