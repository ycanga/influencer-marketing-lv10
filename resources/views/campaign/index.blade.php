@extends('layouts.app')

@section('title', 'Kampanyalar')
@section('content')
    @include('layouts.alert')

    <div class="container mt-3">
        <div class="card">
            @admin
                <h5 class="card-header">Kampanyalar</h5>
            @endadmin
            @user
                <h5 class="card-header">Kampanyalarım</h5>
            @enduser
            @merchant('true')
                <div class="d-flex justify-content-end mb-3">
                    <button class="btn btn-primary me-3"
                        @if ($balance < $settings->site_min_balance && auth()->user()->role != 'admin') data-bs-toggle="tooltip"
                        data-bs-offset="0,4"
                        data-bs-placement="bottom"
                        data-bs-html="true"
                        title="<span class='text-sm'>Bakiyeniz minimum tutarın (Min. {{ $settings->site_min_balance }}₺) altında lütfen yükleme yapın. !</span>" 
                        @else
                            data-bs-toggle="modal" data-bs-target="#createModal" @endif>

                        Kampanya Oluştur
                    </button>
                </div>
            @endmerchant
            <div class="d-flex justify-content-start">
                <form action="#" method="GET">
                    <div class="input-group mb-3">
                        <select class="form-select" name="filterCategory" id="filterCategory">
                            <option value="">Kategori Seçiniz</option>
                            @foreach ($campaignCategories as $category)
                                <option value="{{ $category->id }}">{{ ucfirst($category->name) }}</option>
                            @endforeach
                        </select>
                        <button class="btn btn-outline-secondary" type="submit">Ara</button>
                    </div>
                </form>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            @influencer('true')
                                <th>Marka Adı</th>
                            @endinfluencer
                            <th>Kampanya Adı</th>
                            <th>Kampanya Kategorisi</th>
                            <th>Kampanya Tipi</th>
                            <th>Görüntülenme</th>
                            @influencer
                                <th>Kazanç (₺)</th>
                            @endinfluencer
                            @merchant('true')
                                <th>Katılımcı Sayısı</th>
                            @endmerchant
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
                                @influencer('true')
                                    <td>
                                        {{ $item->merchant->name }}
                                    </td>
                                @endinfluencer
                                <td>
                                    {{ $item->name }}
                                </td>
                                <td>
                                    {{ ucfirst($item->category->name) }}
                                </td>
                                <td>
                                    @if($item->type == 'sales')
                                        <span class="badge bg-primary">Satış</span>
                                    @elseif($item->type == 'click')
                                        <span class="badge bg-primary">Tıklama</span>
                                    @else
                                        <span class="badge bg-primary">Çoklu İşlem</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->visibility == 'public')
                                        <span class="badge bg-success">Herkes</span>
                                    @else
                                        <span class="badge bg-warning">Sadece Seçili Kişiler</span>
                                    @endif
                                </td>
                                @influencer
                                    <td class="text-success">
                                        {{ $item->revenue }} ₺
                                    </td>
                                @endinfluencer
                                @merchant('true')
                                    <td class="text-success text-center">
                                        {{ $item->users }}
                                    </td>
                                @endmerchant
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
                                        <button class="btn btn-warning btn-sm" onclick="copyLink('{{ $item->short_url }}')">
                                            <i class='bx bx-link'></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm"
                                            onclick="unsubscribeCampaign('{{ $item->id }}')">
                                            Ayrıl
                                        </button>
                                    @endinfluencer
                                    @merchant('true')
                                        <button class="btn btn-danger btn-sm" onclick="deleteCampaign({{ $item->id }})">Sil
                                            <i class="bx bx-trash"></i> </button>
                                    @endmerchant
                                    @admin
                                        @if ($item->status == 'pending')
                                            <button class="btn btn-secondary btn-sm"
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

    @include('campaign.modals.show')
    @if ($balance >= $settings->site_min_balance || auth()->user()->role == 'admin')
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

        function copyLink(short_url) {
            var dummy = document.createElement("textarea");
            document.body.appendChild(dummy);
            dummy.value = short_url;
            dummy.select();
            document.execCommand("copy");
            document.body.removeChild(dummy);
            alert('Kopyalandı: ' + short_url);
        }
    </script>
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
        <script>
            function unsubscribeCampaign(id) {
                if (confirm('Bu kampanyadan ayrılmak istediğinize emin misiniz?')) {
                    var campaign = '{{ route('user.campaign.unsubscribe', ':id') }}';
                    campaign = campaign.replace(':id', id);
                    window.location.href = campaign;
                }
            }
        </script>
    @endinfluencer
@endsection
