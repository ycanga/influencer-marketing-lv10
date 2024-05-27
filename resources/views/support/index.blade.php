@extends('layouts.app')

@section('title', 'Support and Help')


@section('content')
    @include('layouts.alert')
    <div class="container mt-3">
        <div class="card">
            @user
                <h5 class="card-header">Destek Taleplerim</h5>
                <div class="d-flex justify-content-end mb-3">
                    <button class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#basicModal">Destek Talebi
                        Oluştur</button>
                </div>
            @enduser
            @admin
                <h5 class="card-header">Tüm Destek Talepleri</h5>
            @endadmin
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Ticket ID</th>
                            <th>Konu</th>
                            <th>Durum</th>
                            <th>Oluşturma Tarihi</th>
                            <th>İşlem</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0 mb-5">
                        @foreach ($supports as $key => $item)
                            <tr>
                                <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                    <strong>#{{ $item->id }}</strong>
                                </td>
                                <td>{{ $item->subject }}</td>
                                <td>
                                    @if ($item->status == 'replied')
                                        <span class="badge bg-success">Başarılı</span>
                                    @elseif($item->status == 'closed')
                                        <span class="badge bg-secondary">Kapandı</span>
                                    @else
                                        <span class="badge bg-warning">Beklemede</span>
                                    @endif
                                </td>
                                <td>
                                    {{ $item->created_at->format('d.m.Y H:i') }}
                                </td>
                                <td>
                                    <a href="{{ route('support.show', $item->id) }}"
                                        class="btn btn-primary btn-sm">Detay</a>
                                    @if ($item->status != 'closed')
                                        <button class="btn btn-danger btn-sm"
                                            onclick="closeTicket({{ $item->id }})">Kapat</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        @if ($supports->count() < 1)
                            <tr>
                                <td colspan="5" class="text-center">
                                    <b>Henüz destek talebi oluşturmadınız.</b>
                                </td>
                            </tr>
                        @endif
                        <tr>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{ $supports->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
    @include('support.modals.create')
    <script>
        function closeTicket(id) {
            if (confirm('Destek talebini kapatmak istediğinize emin misiniz?')) {
                var url = '{{ route('support.close', ':id') }}';
                url = url.replace(':id', id);
                window.location.href = url;
            }
        }
    </script>
@endsection
