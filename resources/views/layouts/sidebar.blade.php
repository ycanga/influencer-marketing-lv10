<ul class="menu-inner py-1">
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
            <div data-i18n="Kampanyalar">Kampanyalar</div>
        </a>
    </li>

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

    <!-- Support -->
    <li class="menu-header small text-uppercase"><span class="menu-header-text">Support</span></li>
    <li class="menu-item {{ request()->routeIs('support.index') ? 'active' : '' }}">
        <a href="{{ route('support.index') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-support"></i>
            <div data-i18n="Destek ve Yardım">Destek ve Yardım</div>
        </a>
    </li>
</ul>
