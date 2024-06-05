@extends('layouts.app')

@section('title', 'Kampanyalar')
@section('content')
    @include('layouts.alert')

    <div class="container mt-3">
        <div class="card">
            <h5 class="card-header">Kampanyalar</h5>
            @merchant
                <div class="d-flex justify-content-end mb-3">
                    <button class="btn btn-primary me-3"
                        @if ($balance < 500) data-bs-toggle="tooltip"
                        data-bs-offset="0,4"
                        data-bs-placement="bottom"
                        data-bs-html="true"
                        title="<span class='text-sm'>Bakiyeniz minimum tutarın (Min. 500₺) altında lütfen yükleme yapın. !</span>" 
                        @else
                            data-bs-toggle="modal" data-bs-target="#createModal" @endif>

                        Kampanya Oluştur
                    </button>
                </div>
            @endmerchant
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Kampanya Adı</th>
                            <th>Kampanya Tipi</th>
                            <th>Görüntülenme</th>
                            <th>Oluşturma Tarihi</th>
                            <th>Durum</th>
                            <th>İşlem</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0 mb-5">
                        @foreach ($campaigns as $key => $item)
                            <tr>
                                <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                    <strong>#{{ $item->id }}</strong>
                                </td>
                                <td>
                                    {{ $item->name }}
                                </td>
                                <td>
                                    {{ $item->type }}
                                </td>
                                <td>
                                    @if ($item->visibility == 'public')
                                        <span class="badge bg-success">Herkes</span>
                                    @else
                                        <span class="badge bg-warning">Sadece Seçili Kişiler</span>
                                    @endif
                                </td>
                                <td>
                                    {{ $item->created_at->format('d.m.Y H:i') }}
                                </td>
                                <td>
                                    @if ($item->status == 'active')
                                        <span class="badge bg-success">Aktif</span>
                                    @elseif($item->status == 'inactive')
                                        <span class="badge bg-danger">Pasif</span>
                                    @else
                                        <span class="badge bg-warning">Beklemede</span>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-primary btn-sm showCampaignData" data-bs-toggle="modal"
                                        data-bs-target="#showModal" data-item="{{ $item }}">Detay</button>
                                    @merchant('true')
                                        <button class="btn btn-danger btn-sm"
                                            onclick="deleteCampaign({{ $item->id }})">Sil</button>
                                    @endmerchant
                                    @admin
                                        @if ($item->status == 'pending')
                                            <button class="btn btn-danger btn-sm"
                                                onclick="closeCampaign({{ $item->id }})">İptal
                                                Et</button>
                                            <button class="btn btn-success btn-sm"
                                                onclick="approveCampaign({{ $item->id }})">Onayla</button>
                                        @endif
                                    @endadmin
                                </td>
                            </tr>
                        @endforeach
                        @if ($campaigns->count() == 0)
                            <tr>
                                <td colspan="7" class="text-center">
                                    <b>Henüz hiç kampanya oluşturulmadı.</b>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{ $campaigns->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>

    {{-- buradayım --}}

    @if ($balance >= 500 || auth()->user()->role == 'admin')
    @include('campaign.modals.show')
        @include('campaign.modals.create')
    @endif

    <script>
        function closeCampaign(id) {
            if (confirm('Talebi iptal etmek istediğinize emin misiniz?')) {
                var url = '{{ route('admin.campaign.reject', ':id') }}';
                url = url.replace(':id', id);
                window.location.href = url;
            }
        }

        function approveCampaign(id) {
            if (confirm('Talebi onaylamak istediğinize emin misiniz?')) {
                var url = '{{ route('admin.campaign.approve', ':id') }}';
                url = url.replace(':id', id);
                window.location.href = url;
            }
        }

        function deleteCampaign(id) {
            if (confirm('Kampanyayı silmek istediğinize emin misiniz?')) {
                var url = '{{ route('merchant.campaign.delete', ':id') }}';
                url = url.replace(':id', id);
                window.location.href = url;
            }
        }
    </script>
@endsection
