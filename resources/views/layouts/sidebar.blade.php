<ul class="menu-inner py-1">

    @user
        <li class="menu-item border mb-3 p-3">
            <div class="menu-link text-sm">
                @php
                    $statusColor = '';
                    if ($balance >= 500) {
                        $statusColor = 'success';
                    } else {
                        $statusColor = 'danger';
                    }
                @endphp
                <p href="#balance" class="text-balance"
                    @if ($balance < 500) data-bs-toggle="tooltip"
                    data-bs-offset="0,1"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="<span class='text-sm'>Bakiyeniz minimum tutarın (Min. 500₺) altında lütfen yükleme yapın. !</span>" @endif>
                    Mevcut Bakiyeniz: &nbsp; <b class="text-{{ $statusColor }} text-sm">{{ $balance }} TL</b>
                </p>
            </div>
            <a href="{{ route('balance.index') }}" class="menu-link btn btn-success balance-href">
                Bakiye Yükle +
            </a>
            <style>
                .text-balance {
                    cursor: pointer;
                    font-size: 14px;
                }
            </style>
        </li>
    @enduser

    <!-- Dashboard -->
    <li class="menu-item {{ request()->routeIs('home') ? 'active' : '' }}">
        <a href="{{ route('home') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Analytics">Dashboard</div>
        </a>
    </li>

    <!-- Campaigns -->
    <li class="menu-header small text-uppercase"><span class="menu-header-text">Campaigns</span></li>
    <li class="menu-item {{ request()->routeIs('merchant.campaign.index') ? 'active' : '' }}">
        <a href="{{ route('merchant.campaign.index') }}" class="menu-link">
            <i class='menu-icon tf-icons bx bxs-chalkboard'></i>
            @user
                <div data-i18n="Kampanyalarım">Kampanyalarım</div>
            @enduser
            @admin
                <div data-i18n="Tüm Kampanyalar"> Tüm Kampanyalar</div>
            @endadmin
        </a>
    </li>
    @user
        <li class="menu-item {{ request()->routeIs('merchant.campaign.all') ? 'active' : '' }}">
            <a href="{{ route('merchant.campaign.all') }}" class="menu-link">
                <i class='menu-icon tf-icons bx bx-chalkboard'></i>
                <div data-i18n="Tüm Kampanyalar"> Tüm Kampanyalar</div>
            </a>
        </li>
    @enduser

    <!-- Payments -->
    <li class="menu-header small text-uppercase"><span class="menu-header-text">Payments</span></li>
    @influencer
        <li class="menu-item {{ request()->routeIs('payment.index') ? 'active' : '' }}">
            <a href="{{ route('payment.store') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-credit-card"></i>
                <div data-i18n="Banka Bilgileri">Banka Bilgileri</div>
            </a>
        </li>
    @endinfluencer
    @influencer('true')
        <li class="menu-item {{ request()->routeIs('demand.index') ? 'active' : '' }}">
            <a href="{{ route('demand.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-lira"></i>
                <div data-i18n="Para Çekme Talepleri">Para Çekme Talepleri</div>
            </a>
        </li>
    @endinfluencer


    @merchant
        <li class="menu-item {{ request()->routeIs('balance.index') ? 'active' : '' }}">
            <a href="{{ route('balance.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-coin"></i>
                <div data-i18n="Bakiye Yükle">Bakiye Yükle</div>
            </a>
        </li>
    @endmerchant

    @admin
        <li class="menu-item {{ request()->routeIs('admin.balance.index') ? 'active' : '' }}">
            <a href="{{ route('admin.balance.index') }}" class="menu-link">
                <i class='menu-icon tf-icons bx bxs-badge-dollar'></i>
                <div data-i18n="Bakiye Talepleri">Bakiye Talepleri</div>
            </a>
        </li>
    @endadmin

    @merchant('true')
    <!-- Integration -->
    <li class="menu-header small text-uppercase"><span class="menu-header-text">Integration</span></li>
    <li class="menu-item {{ request()->routeIs('merchant.integration.index') ? 'active' : '' }}">
        <a href="{{ route('merchant.integration.index') }}" class="menu-link">
            <i class='menu-icon tf-icons bx bx-intersect'></i>
            <div data-i18n="Destek ve Yardım">Entegrasyon</div>
        </a>
    </li>
    @endmerchant

    <!-- Support -->
    <li class="menu-header small text-uppercase"><span class="menu-header-text">Support</span></li>
    <li class="menu-item {{ request()->routeIs('support.index') ? 'active' : '' }}">
        <a href="{{ route('support.index') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-support"></i>
            <div data-i18n="Destek ve Yardım">Destek ve Yardım</div>
        </a>
    </li>
</ul>
