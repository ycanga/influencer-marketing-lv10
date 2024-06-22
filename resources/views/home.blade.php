@extends('layouts.app')
@section('title', 'Home')

@section('content')
    @include('layouts.alert')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                {{-- <div class="col-lg-8 mb-4 order-0">
                    <div class="card">
                        <div class="d-flex align-items-end row">
                            <div class="col-sm-7">
                                <div class="card-body">
                                    <h5 class="card-title text-primary">Congratulations John! 🎉</h5>
                                    <p class="mb-4">
                                        You have done <span class="fw-bold">72%</span> more sales today. Check your new
                                        badge in
                                        your profile.
                                    </p>

                                    <a href="javascript:;" class="btn btn-sm btn-outline-primary">View Badges</a>
                                </div>
                            </div>
                            <div class="col-sm-5 text-center text-sm-left">
                                <div class="card-body pb-0 px-0 px-md-4">
                                    <img src="../assets/img/illustrations/man-with-laptop-light.png" height="140"
                                        alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                        data-app-light-img="illustrations/man-with-laptop-light.png" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 order-1">
                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0">
                                            <img src="../assets/img/icons/unicons/chart-success.png" alt="chart success"
                                                class="rounded" />
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                                <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="fw-semibold d-block mb-1">Profit</span>
                                    <h3 class="card-title mb-2">$12,628</h3>
                                    <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i>
                                        +72.80%</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0">
                                            <img src="../assets/img/icons/unicons/wallet-info.png" alt="Credit Card"
                                                class="rounded" />
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                                <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                    <span>Sales</span>
                                    <h3 class="card-title text-nowrap mb-1">$4,679</h3>
                                    <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i>
                                        +28.42%</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                @user
                    <!-- Pills -->
                    <h5 class="py-3">Yeni Kampanyalar <a href="{{ route('merchant.campaign.all') }}">( Tümünü Gör )</a></h5>

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
                                                @if ($balance < 500 && auth()->user()->role != 'admin') data-bs-toggle="tooltip"
                                                data-bs-offset="0,4"
                                                data-bs-placement="bottom"
                                                data-bs-html="true"
                                                title="<span class='text-sm'>Bakiyeniz minimum tutarın (Min. 500₺) altında lütfen yükleme yapın. !</span>" 
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
                                                        <img src="{{ asset($item->image) ?? asset('assets/img/logo.png') }}"
                                                            alt="{{ $item->name }}" width="35" height="35">
                                                        <label>{{ $item->name }}</label>
                                                        <div class="row">
                                                            @if ($item->sbm && $item->sbm > 0)
                                                                <div class="col-12 mb-2">
                                                                    <span class="badge bg-label-primary p-2 w-100">Satış başına
                                                                        <b>{{ $item->sbm }} ₺</b>
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
                                                        <img src="{{ $item->image ?? asset('assets/img/logo.png') }}"
                                                            alt="{{ $item->name }}" width="35" height="35">
                                                        <label>{{ $item->name }}</label>
                                                        <div class="row">
                                                            @if ($item->sbm && $item->sbm > 0)
                                                                <div class="col-12 mb-2">
                                                                    <span class="badge bg-label-primary p-2 w-100">Satış başına
                                                                        <b>{{ $item->sbm }} ₺</b>
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
                                                        <img src="{{ $item->image ?? asset('assets/img/logo.png') }}"
                                                            alt="{{ $item->name }}" width="35" height="35">
                                                        <label>{{ $item->name }}</label>
                                                        <div class="row">
                                                            @if ($item->sbm && $item->sbm > 0)
                                                                <div class="col-12 mb-2">
                                                                    <span class="badge bg-label-primary p-2 w-100">Satış başına
                                                                        <b>{{ $item->sbm }} ₺</b>
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

                @merchant
                    <!-- Order Statistics -->
                    <div class="col-md-8 col-lg-8 col-xl-8 order-0 mb-4">
                        <div class="card h-100">
                            <div class="card-header d-flex align-items-center justify-content-between pb-0">
                                <div class="card-title mb-0">
                                    <h5 class="m-0 me-2">Yapılan Influencer Ödemeleri</h5>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="d-flex flex-column align-items-center gap-1">
                                        <h2 class="mb-2 mt-3"> {{ $lastWeekRevenue }} ₺</h2>
                                        <span>Toplam Influencer Masrafı</span>
                                    </div>
                                    <div id="statisticCart"></div>
                                </div>
                                <ul class="p-0 m-0">
                                    @foreach ($activeUserCampaigns as $campaign)
                                        <li class="d-flex mb-4 pb-1">
                                            <div class="avatar flex-shrink-0 me-3">
                                                <img src="{{ asset($campaign->users->photo) }}"
                                                    alt="{{ $campaign->users->name }}">
                                            </div>
                                            <div
                                                class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                <div class="me-2">
                                                    <h6 class="mb-0">{{ ucfirst($campaign->users->name) }}</h6>
                                                    <small class="text-muted">{{ $campaign->campaigns->name }}
                                                        Kampanyası</small>
                                                </div>
                                                <div class="user-progress">
                                                    <small class="fw-semibold">
                                                        @if ($campaign->campaigns->type == 'sales')
                                                            <b>Satış Kampanyası</b>
                                                            <div class="user-progress">
                                                                <small class="fw-semibold">
                                                                    <b class="text-primary">{{ $campaign->view_count }}</b>
                                                                    <b>Adet Satın Alma</b>
                                                                </small>
                                                            </div>
                                                        @elseif($campaign->campaigns->type == 'click')
                                                            <b>Tıklama Kampanyası</b>
                                                            <div class="user-progress">
                                                                <small class="fw-semibold">
                                                                    <b class="text-primary">{{ $campaign->click_count }}</b>
                                                                    <b>Adet Tıklama</b>
                                                                </small>
                                                            </div>
                                                        @elseif($campaign->campaigns->type == 'multiple')
                                                            <b>Çoklu Kampanya</b>
                                                            <div class="user-progress">
                                                                <small class="fw-semibold">
                                                                    <b class="text-primary">{{ $campaign->view_count }}</b>
                                                                    <b>Adet Satın Alma</b>
                                                                </small>
                                                                <br>
                                                                <small class="fw-semibold">
                                                                    <b class="text-primary">{{ $campaign->click_count }}</b>
                                                                    <b>Adet Tıklama</b>
                                                                </small>
                                                            </div>
                                                        @endif
                                                    </small>
                                                </div>
                                                <div class="user-progress">
                                                    <small class="fw-semibold">{{ $campaign->revenue }} <b>₺</b></small>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!--/ Order Statistics -->

                    <!--/ Total Revenue -->
                    <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
                        <div class="row">
                            <div class="col-6 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-title d-flex align-items-start justify-content-between">
                                            <i class='bx bx-wallet'></i>
                                        </div>
                                        <span class="fw-semibold d-block mb-1">Tahmini Satış Kazancınız</span>
                                        <h3 class="card-title text-nowrap mb-2 text-success">{{ $campaignsRevenue }} ₺</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-title d-flex align-items-start justify-content-between">
                                            <i class='bx bx-money'></i>
                                        </div>
                                        <span class="fw-semibold d-block mb-1">İşlem Giderleri</span>
                                        <h3 class="card-title mb-2 text-danger">{{ $campaignsInfluencerRevenue }} ₺</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endmerchant

                <!-- Total Revenue -->
                <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2 mb-4">
                    <div class="card">
                        <div class="row row-bordered g-0">
                            <div class="col-md-8">
                                <h5 class="card-header m-0 me-2 pb-3">Haftalık Satış Değerleri</h5>
                                <div id="revenueWeekChart" class="px-2"></div>
                            </div>
                            <div class="col-md-4">
                                <div class="card-body">
                                    <div class="text-center">
                                        <div class="dropdown">
                                            <input type="week" name="" id="weekInput" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div id="growthChartValue"></div>
                                <div class="text-center fw-semibold pt-3 mb-2">Haftalık Değerler</div>

                                <div class="d-flex px-xxl-4 px-lg-2 p-4 gap-xxl-3 gap-lg-1 gap-3 justify-content-between">
                                    <div class="d-flex">
                                        <div class="me-2">
                                            <span class="badge bg-label-secondary p-2"><i
                                                    class="bx bx-dollar text-success"></i></span>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <small id="upDate">2022</small>
                                            <h6 class="mb-0" id="upDateRevenue">$32.5k</h6>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <div class="me-2">
                                            <span class="badge bg-label-secondary p-2"><i
                                                    class="bx bx-dollar text-danger"></i></span>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <small id="downDate">2021</small>
                                            <h6 class="mb-0" id="downDateRevenue">$41.2k</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Total Revenue -->
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
        @php
            $sales = 0;
            $click = 0;
            $multiple = 0;
        @endphp

        @foreach ($campaignTypes as $campaignType)
            @php
                if ($campaignType->type == 'sales') {
                    $sales = $campaignType->total;
                } elseif ($campaignType->type == 'click') {
                    $click = $campaignType->total;
                } elseif ($campaignType->type == 'multiple') {
                    $multiple = $campaignType->total;
                }
            @endphp
        @endforeach


        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script>
            let cardColor, headingColor, axisColor, shadeColor, borderColor;

            cardColor = config.colors.white;
            headingColor = config.colors.headingColor;
            axisColor = config.colors.axisColor;
            borderColor = config.colors.borderColor;

            // Order Statistics Chart
            // --------------------------------------------------------------------
            const chartOrderStatistics = document.querySelector('#statisticCart'),
                orderChartConfig = {
                    chart: {
                        height: 165,
                        width: 180,
                        type: 'donut'
                    },
                    labels: ['Satış Kampanyası', 'Tıklama Kampanyası', 'Çoklu Kampanya'],
                    series: [
                        {{ $sales }}, {{ $click }}, {{ $multiple }}
                    ],
                    colors: [config.colors.success, config.colors.info, config.colors.primary],
                    stroke: {
                        width: 5,
                        colors: cardColor
                    },
                    dataLabels: {
                        enabled: false,
                        formatter: function(val, opt) {
                            return parseInt(val) + 'Adet';
                        }
                    },
                    legend: {
                        show: false
                    },
                    grid: {
                        padding: {
                            top: 0,
                            bottom: 0,
                            right: 15
                        }
                    },
                    plotOptions: {
                        pie: {
                            donut: {
                                size: '75%',
                                labels: {
                                    show: true,
                                    value: {
                                        fontSize: '1.5rem',
                                        fontFamily: 'Public Sans',
                                        color: headingColor,
                                        offsetY: -15,
                                        formatter: function(val) {
                                            return parseInt(val) + ' Adet';
                                        }
                                    },
                                    name: {
                                        offsetY: 20,
                                        fontFamily: 'Public Sans'
                                    },
                                    total: {
                                        show: true,
                                        fontSize: '0.8125rem',
                                        color: axisColor,
                                        label: 'Haftalık Artış',
                                        formatter: function(w) {
                                            return '{{ $percentageChange }} %';
                                        }
                                    }
                                }
                            }
                        }
                    }
                };
            if (typeof chartOrderStatistics !== undefined && chartOrderStatistics !== null) {
                const statisticsChart = new ApexCharts(chartOrderStatistics, orderChartConfig);
                statisticsChart.render();
            }

            $(document).ready(function() {
                // Grafik referansı
                let totalRevenueChart;
                let growthChart;

                // İlk yüklemede veri çekme
                getChartData().then(function(data) {
                    renderChart(data);
                    const growthRates = calculateGrowthRates(data);
                    renderGrowthChart(growthRates);
                });

                // weekInput değiştiğinde veri çekme ve grafiği güncelleme
                var weekInput = document.getElementById('weekInput');
                weekInput.addEventListener('change', function() {
                    var week = this.value;
                    getChartData(week).then(function(data) {
                        renderChart(data);
                        const growthRates = calculateGrowthRates(data);
                        renderGrowthChart(growthRates);
                    });
                });

                // Total Revenue Report Chart - Bar Chart
                function renderChart(data) {
                    const totalRevenueChartEl = document.querySelector('#revenueWeekChart');

                    // Mevcut grafiği yok et
                    if (totalRevenueChart) {
                        totalRevenueChart.destroy();
                    }

                    const totalRevenueChartOptions = {
                        series: [{
                            name: 'Satış Tutarı',
                            data: data.map(item => item.revenue) // response verisini buraya yerleştirin.
                        }],
                        chart: {
                            height: 300,
                            stacked: true,
                            type: 'bar',
                            toolbar: {
                                show: false
                            }
                        },
                        plotOptions: {
                            bar: {
                                horizontal: false,
                                columnWidth: '33%',
                                borderRadius: 12,
                                startingShape: 'rounded',
                                endingShape: 'rounded'
                            }
                        },
                        colors: [config.colors.primary, config.colors.info],
                        dataLabels: {
                            enabled: false
                        },
                        stroke: {
                            curve: 'smooth',
                            width: 6,
                            lineCap: 'round',
                            colors: [cardColor]
                        },
                        legend: {
                            show: true,
                            horizontalAlign: 'left',
                            position: 'top',
                            markers: {
                                height: 8,
                                width: 8,
                                radius: 12,
                                offsetX: -3
                            },
                            labels: {
                                colors: axisColor
                            },
                            itemMargin: {
                                horizontal: 10
                            }
                        },
                        grid: {
                            borderColor: borderColor,
                            padding: {
                                top: 0,
                                bottom: -8,
                                left: 20,
                                right: 20
                            }
                        },
                        xaxis: {
                            categories: ['Pazartesi', 'Salı', 'Çarşamba', 'Perşembe', 'Cuma', 'Cumartesi', 'Pazar'],
                            labels: {
                                style: {
                                    fontSize: '13px',
                                    colors: axisColor
                                }
                            },
                            axisTicks: {
                                show: false
                            },
                            axisBorder: {
                                show: false
                            }
                        },
                        yaxis: {
                            labels: {
                                style: {
                                    fontSize: '13px',
                                    colors: axisColor
                                }
                            }
                        },
                        responsive: [{
                                breakpoint: 1700,
                                options: {
                                    plotOptions: {
                                        bar: {
                                            borderRadius: 10,
                                            columnWidth: '32%'
                                        }
                                    }
                                }
                            },
                            {
                                breakpoint: 1580,
                                options: {
                                    plotOptions: {
                                        bar: {
                                            borderRadius: 10,
                                            columnWidth: '35%'
                                        }
                                    }
                                }
                            },
                            {
                                breakpoint: 1440,
                                options: {
                                    plotOptions: {
                                        bar: {
                                            borderRadius: 10,
                                            columnWidth: '42%'
                                        }
                                    }
                                }
                            },
                            {
                                breakpoint: 1300,
                                options: {
                                    plotOptions: {
                                        bar: {
                                            borderRadius: 10,
                                            columnWidth: '48%'
                                        }
                                    }
                                }
                            },
                            {
                                breakpoint: 1200,
                                options: {
                                    plotOptions: {
                                        bar: {
                                            borderRadius: 10,
                                            columnWidth: '40%'
                                        }
                                    }
                                }
                            },
                            {
                                breakpoint: 1040,
                                options: {
                                    plotOptions: {
                                        bar: {
                                            borderRadius: 11,
                                            columnWidth: '48%'
                                        }
                                    }
                                }
                            },
                            {
                                breakpoint: 991,
                                options: {
                                    plotOptions: {
                                        bar: {
                                            borderRadius: 10,
                                            columnWidth: '30%'
                                        }
                                    }
                                }
                            },
                            {
                                breakpoint: 840,
                                options: {
                                    plotOptions: {
                                        bar: {
                                            borderRadius: 10,
                                            columnWidth: '35%'
                                        }
                                    }
                                }
                            },
                            {
                                breakpoint: 768,
                                options: {
                                    plotOptions: {
                                        bar: {
                                            borderRadius: 10,
                                            columnWidth: '28%'
                                        }
                                    }
                                }
                            },
                            {
                                breakpoint: 640,
                                options: {
                                    plotOptions: {
                                        bar: {
                                            borderRadius: 10,
                                            columnWidth: '32%'
                                        }
                                    }
                                }
                            },
                            {
                                breakpoint: 576,
                                options: {
                                    plotOptions: {
                                        bar: {
                                            borderRadius: 10,
                                            columnWidth: '37%'
                                        }
                                    }
                                }
                            },
                            {
                                breakpoint: 480,
                                options: {
                                    plotOptions: {
                                        bar: {
                                            borderRadius: 10,
                                            columnWidth: '45%'
                                        }
                                    }
                                }
                            },
                            {
                                breakpoint: 420,
                                options: {
                                    plotOptions: {
                                        bar: {
                                            borderRadius: 10,
                                            columnWidth: '52%'
                                        }
                                    }
                                }
                            },
                            {
                                breakpoint: 380,
                                options: {
                                    plotOptions: {
                                        bar: {
                                            borderRadius: 10,
                                            columnWidth: '60%'
                                        }
                                    }
                                }
                            }
                        ],
                        states: {
                            hover: {
                                filter: {
                                    type: 'none'
                                }
                            },
                            active: {
                                filter: {
                                    type: 'none'
                                }
                            }
                        }
                    };
                    if (typeof totalRevenueChartEl !== undefined && totalRevenueChartEl !== null) {
                        totalRevenueChart = new ApexCharts(totalRevenueChartEl, totalRevenueChartOptions);
                        totalRevenueChart.render();
                    }
                }

                // Growth Chart - Radial Bar Chart
                function renderGrowthChart(data) {
                    const growthChartEl = document.querySelector('#growthChartValue');

                    // Mevcut grafiği yok et
                    if (growthChart) {
                        growthChart.destroy();
                    }

                    const growthChartOptions = {
                        series: [data[data.length - 1].growthRate], // Son günün büyüme oranı
                        labels: ['Kazanç Oranı'],
                        chart: {
                            height: 240,
                            type: 'radialBar'
                        },
                        plotOptions: {
                            radialBar: {
                                size: 150,
                                offsetY: 10,
                                startAngle: -150,
                                endAngle: 150,
                                hollow: {
                                    size: '55%'
                                },
                                track: {
                                    background: cardColor,
                                    strokeWidth: '100%'
                                },
                                dataLabels: {
                                    name: {
                                        offsetY: 15,
                                        color: headingColor,
                                        fontSize: '15px',
                                        fontWeight: '600',
                                        fontFamily: 'Public Sans'
                                    },
                                    value: {
                                        offsetY: -25,
                                        color: headingColor,
                                        fontSize: '22px',
                                        fontWeight: '500',
                                        fontFamily: 'Public Sans'
                                    }
                                }
                            }
                        },
                        colors: [config.colors.primary],
                        fill: {
                            type: 'gradient',
                            gradient: {
                                shade: 'dark',
                                shadeIntensity: 0.5,
                                gradientToColors: [config.colors.primary],
                                inverseColors: true,
                                opacityFrom: 1,
                                opacityTo: 0.6,
                                stops: [30, 70, 100]
                            }
                        },
                        stroke: {
                            dashArray: 5
                        },
                        grid: {
                            padding: {
                                top: -35,
                                bottom: -10
                            }
                        },
                        states: {
                            hover: {
                                filter: {
                                    type: 'none'
                                }
                            },
                            active: {
                                filter: {
                                    type: 'none'
                                }
                            }
                        }
                    };
                    if (typeof growthChartEl !== undefined && growthChartEl !== null) {
                        growthChart = new ApexCharts(growthChartEl, growthChartOptions);
                        growthChart.render();
                    }
                }
            });

            // Günden güne artış oranlarını hesaplama
            function calculateGrowthRates(data) {
                let growthRates = [];

                for (let i = 1; i < data.length; i++) {
                    let previousDayRevenue = data[i - 1].revenue;
                    let currentDayRevenue = data[i].revenue;

                    let growthRate = 0;
                    if (previousDayRevenue !== 0) {
                        growthRate = ((currentDayRevenue - previousDayRevenue) / previousDayRevenue) * 100;
                    }

                    growthRates.push({
                        day: data[i].day,
                        growthRate: growthRate
                    });
                }

                return growthRates;
            }

            function getChartData(week = '') {
                return new Promise(function(resolve, reject) {
                    var userId = '{{ auth()->user()->id }}';
                    $.ajax({
                        url: `{{ route('weekly.get', ['userId' => ':userId', 'date' => ':week']) }}`.replace(
                            ':userId', userId).replace(':week', week),
                        type: 'GET',
                        success: function(response) {
                            resolve(response);
                            updateRevenue(response)
                        },
                        error: function(xhr, status, error) {
                            reject(error);
                        }
                    });
                });
            }

            function updateRevenue(data) {
                if (data.length === 0) {
                    return {
                        highestRevenueDay: null,
                        lowestRevenueDay: null
                    };
                }

                let highestRevenueDay = data[0];
                let lowestRevenueDay = data[0];

                for (let i = 1; i < data.length; i++) {
                    if (data[i].revenue != '0') {
                        if (data[i].revenue > highestRevenueDay.revenue) {
                            highestRevenueDay = data[i];
                        }
                        if (data[i].revenue < lowestRevenueDay.revenue && data[i].revenue != '0') {
                            lowestRevenueDay = data[i];
                        }
                    }
                }

                document.getElementById('upDate').innerText = highestRevenueDay.day;
                document.getElementById('upDateRevenue').innerText = highestRevenueDay.revenue + ' ₺';
                document.getElementById('downDate').innerText = lowestRevenueDay.day;
                document.getElementById('downDateRevenue').innerText = lowestRevenueDay.revenue + ' ₺';
            }
        </script>
    @endmerchant
@endsection
