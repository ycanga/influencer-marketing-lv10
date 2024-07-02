@extends('layouts.app')
@section('title', 'Home')

@section('content')
    @include('layouts.alert')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                @user
                    <!-- Pills -->
                    <h5 class="py-3">Yeni Kampanyalar 🎉 <a href="{{ route('merchant.campaign.all') }}">( Tümünü Gör )</a></h5>

                    <div class="row mb-3">
                        <div class="col-xl-12">
                            <div class="nav-align-top mb-4">
                                <ul class="nav nav-pills mb-3" role="tablist">
                                    <li class="nav-item">
                                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                                            data-bs-target="#navs-pills-top-home" aria-controls="navs-pills-top-home"
                                            aria-selected="true">
                                            Satış kampanyaları
                                        </button>
                                    </li>
                                    <li class="nav-item">
                                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                            data-bs-target="#navs-pills-top-profile" aria-controls="navs-pills-top-profile"
                                            aria-selected="false">
                                            Tıklama kampanyaları
                                        </button>
                                    </li>
                                    <li class="nav-item">
                                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                            data-bs-target="#navs-pills-top-messages" aria-controls="navs-pills-top-messages"
                                            aria-selected="false">
                                            Çoklu kampanyalar
                                        </button>
                                    </li>
                                    @merchant('true')
                                        <li class="nav-item">
                                            <button class="btn btn-success me-3"
                                                @if ($balance < $settings->site_min_balance && auth()->user()->role != 'admin') data-bs-toggle="tooltip"
                                                data-bs-offset="0,4"
                                                data-bs-placement="bottom"
                                                data-bs-html="true"
                                                title="<span class='text-sm'>Bakiyeniz minimum tutarın (Min. {{ $settings->site_min_balance }}₺) altında lütfen yükleme yapın. !</span>" 
                                                @else
                                                    data-bs-toggle="modal" data-bs-target="#createModal" @endif>

                                                Yeni Kampanya Oluştur
                                            </button>
                                        </li>
                                    @endmerchant
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="navs-pills-top-home" role="tabpanel">
                                        @php
                                            $hasSales = false;
                                        @endphp
                                        @foreach ($campaigns as $key => $item)
                                            @if ($item->type == 'sales')
                                                @php
                                                    $hasSales = true;
                                                @endphp
                                                <div class="row card shadow p-3 mb-3">
                                                    <div class="col-12 d-flex justify-content-between align-items-center">
                                                        <img src="{{ asset($item->image) ?? asset($settings->site_favicon) }}"
                                                            alt="{{ $item->name }}" width="35" height="35">
                                                        <label>{{ ucfirst($item->merchant->name) }}</label>
                                                        <label>{{ ucfirst($item->name) }}</label>
                                                        <div class="row">
                                                            @if ($item->sbm && $item->sbm > 0)
                                                                <div class="col-12 mb-2">
                                                                    <span class="badge bg-label-primary p-2 w-100">Satış başına
                                                                        <b>%{{ $item->sbm }}</b>
                                                                    </span>
                                                                </div>
                                                            @endif
                                                            @if ($item->tbm && $item->tbm > 0)
                                                                <div class="col-12 mb-2">
                                                                    <span class="badge bg-label-primary p-2 w-100">Tıklama
                                                                        başına
                                                                        <b>{{ $item->tbm }} ₺</b>
                                                                    </span>
                                                                </div>
                                                            @endif
                                                            @if ($item->ibm && $item->ibm > 0)
                                                                <div class="col-12 mb-2">
                                                                    <span class="badge bg-label-primary p-2 w-100">İşlem başına
                                                                        <b>{{ $item->ibm }} ₺</b>
                                                                    </span>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <label>
                                                            Şu tarihe kadar kullanılabilir:
                                                            <b>
                                                                {{ $item->time ? $item->time : 'Süresiz' }}
                                                            </b>
                                                        </label>
                                                        <div>
                                                            <button class="btn-sm btn btn-primary dataShow"
                                                                data-bs-toggle="modal" data-bs-target="#showModal"
                                                                data-item="{{ $item }}">
                                                                <i class="bx bx-show"></i>
                                                            </button>
                                                            @influencer
                                                                <button class="btn-sm btn btn-success"
                                                                    onclick="subscribeCampaign({{ $item->id }})">
                                                                    <i class="bx bx-check"></i>
                                                                </button>
                                                            @endinfluencer
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                        @if (!$hasSales)
                                            <div class="text-center">
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Uyarı!</strong> Henüz yeni kampanya oluşturulmamış.
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="tab-pane fade" id="navs-pills-top-profile" role="tabpanel">
                                        @php
                                            $hasClick = false;
                                        @endphp
                                        @foreach ($campaigns as $key => $item)
                                            @if ($item->type == 'click')
                                                @php
                                                    $hasClick = true;
                                                @endphp
                                                <div class="row card shadow p-3 mb-3">
                                                    <div class="col-12 d-flex justify-content-between align-items-center">
                                                        <img src="{{ asset($item->image) ?? asset($settings->site_favicon) }}"
                                                            alt="{{ $item->name }}" width="35" height="35">
                                                        <label>{{ ucfirst($item->merchant->name) }}</label>
                                                        <label>{{ ucfirst($item->name) }}</label>
                                                        <div class="row">
                                                            @if ($item->sbm && $item->sbm > 0)
                                                                <div class="col-12 mb-2">
                                                                    <span class="badge bg-label-primary p-2 w-100">Satış başına
                                                                        <b>%{{ $item->sbm }}</b>
                                                                    </span>
                                                                </div>
                                                            @endif
                                                            @if ($item->tbm && $item->tbm > 0)
                                                                <div class="col-12 mb-2">
                                                                    <span class="badge bg-label-primary p-2 w-100">Tıklama
                                                                        başına
                                                                        <b>{{ $item->tbm }} ₺</b>
                                                                    </span>
                                                                </div>
                                                            @endif
                                                            @if ($item->ibm && $item->ibm > 0)
                                                                <div class="col-12 mb-2">
                                                                    <span class="badge bg-label-primary p-2 w-100">İşlem başına
                                                                        <b>{{ $item->ibm }} ₺</b>
                                                                    </span>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <label>
                                                            Şu tarihe kadar kullanılabilir:
                                                            <b>
                                                                {{ $item->time ? $item->time : 'Süresiz' }}
                                                            </b>
                                                        </label>
                                                        <div>
                                                            <button class="btn-sm btn btn-primary dataShow"
                                                                data-bs-toggle="modal" data-bs-target="#showModal"
                                                                data-item="{{ $item }}">
                                                                <i class="bx bx-show"></i>
                                                            </button>
                                                            @influencer
                                                                <button class="btn-sm btn btn-success"
                                                                    onclick="subscribeCampaign({{ $item->id }})">
                                                                    <i class="bx bx-check"></i>
                                                                </button>
                                                            @endinfluencer
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                        @if (!$hasClick)
                                            <div class="text-center">
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Uyarı!</strong> Henüz yeni kampanya oluşturulmamış.
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="tab-pane fade" id="navs-pills-top-messages" role="tabpanel">
                                        @php
                                            $hasMultiple = false;
                                        @endphp
                                        @foreach ($campaigns as $key => $item)
                                            @if ($item->type == 'multiple')
                                                @php
                                                    $hasMultiple = true;
                                                @endphp
                                                <div class="row card shadow p-3 mb-3">
                                                    <div class="col-12 d-flex justify-content-between align-items-center">
                                                        <img src="{{ asset($item->image) ?? asset($settings->site_favicon) }}"
                                                            alt="{{ $item->name }}" width="35" height="35">
                                                        <label>{{ ucfirst($item->merchant->name) }}</label>
                                                        <label>{{ ucfirst($item->name) }}</label>
                                                        <div class="row">
                                                            @if ($item->sbm && $item->sbm > 0)
                                                                <div class="col-12 mb-2">
                                                                    <span class="badge bg-label-primary p-2 w-100">Satış başına
                                                                        <b>%{{ $item->sbm }}</b>
                                                                    </span>
                                                                </div>
                                                            @endif
                                                            @if ($item->tbm && $item->tbm > 0)
                                                                <div class="col-12 mb-2">
                                                                    <span class="badge bg-label-primary p-2 w-100">Tıklama
                                                                        başına
                                                                        <b>{{ $item->tbm }} ₺</b>
                                                                    </span>
                                                                </div>
                                                            @endif
                                                            @if ($item->ibm && $item->ibm > 0)
                                                                <div class="col-12 mb-2">
                                                                    <span class="badge bg-label-primary p-2 w-100">İşlem başına
                                                                        <b>{{ $item->ibm }} ₺</b>
                                                                    </span>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <label>
                                                            Şu tarihe kadar kullanılabilir:
                                                            <b>
                                                                {{ $item->time ? $item->time : 'Süresiz' }}
                                                            </b>
                                                        </label>
                                                        <div>
                                                            <button class="btn-sm btn btn-primary dataShow"
                                                                data-bs-toggle="modal" data-bs-target="#showModal"
                                                                data-item="{{ $item }}">
                                                                <i class="bx bx-show"></i>
                                                            </button>
                                                            @influencer
                                                                <button class="btn-sm btn btn-success"
                                                                    onclick="subscribeCampaign({{ $item->id }})">
                                                                    <i class="bx bx-check"></i>
                                                                </button>
                                                            @endinfluencer
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                        @if (!$hasMultiple)
                                            <div class="text-center">
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Uyarı!</strong> Henüz yeni kampanya oluşturulmamış.
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Pills -->
                @enduser

                @admin
                    @include('components.home-components.admin.statistics')
                @endadmin

                @merchant
                    @include('components.home-components.merchant.order-statistics')
                @endmerchant
                @influencer
                    {{-- @dd($campaignTypes) --}}
                    @include('components.home-components.influencer.order-statistics')
                @endinfluencer
            </div>
        </div>
    </div>
    <!-- / Content -->
    @include('components.modals.campaign-show')
    @include('campaign.modals.create')
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

    @merchant
    @endmerchant
@endsection
