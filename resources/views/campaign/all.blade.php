@extends('layouts.app')

@section('title', 'Kampanyalar')
@section('content')
    @include('layouts.alert')

    <div class="container mt-3">
        <div class="card">
            <h5 class="card-header">Tüm Kampanyalar</h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Marka Adı</th>
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
                                    {{ $item->merchant->name }}
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
                                    @influencer
                                        <button class="btn-sm btn btn-success" onclick="subscribeCampaign({{ $item->id }})">
                                            <i class="bx bx-check"></i>
                                        </button>
                                    @endinfluencer
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

    @include('campaign.modals.show')
    @influencer
        <script>
            function subscribeCampaign(id) {
                if (confirm('Bu kampanyaya katılmak istediğinize emin misiniz?')) {
                    var url = '{{ route('user.campaign.subscribe', ':id') }}';
                    url = url.replace(':id', id);
                    window.location.href = url;
                }
            }
        </script>
    @endinfluencer
@endsection
