<ul class="menu-inner py-1">

    @user
        <li class="menu-item border mb-3 p-3">
            <div class="menu-link text-sm">
                @php
                    $statusColor = '';
                    if ($balance >= $settings->site_min_balance) {
                        $statusColor = 'success';
                    } else {
                        $statusColor = 'danger';
                    }
                @endphp
                <p href="#balance" class="text-balance"
                    @merchant
                    @if ($balance < $settings->site_min_balance) data-bs-toggle="tooltip"
                    data-bs-offset="0,1"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="<span class='text-sm'>Bakiyeniz minimum tutarın (Min. {{ $settings->site_min_balance }}₺) altında lütfen yükleme yapın. !</span>" @endif @endmerchant>
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
            <div data-i18n="Analytics">Anasayfa</div>
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
    <li class="menu-item {{ request()->routeIs('faq.index') ? 'active' : '' }}">
        <a href="{{ route('faq.index') }}" class="menu-link">
            <i class='menu-icon tf-icons bx bx-conversation'></i>
            <div data-i18n="Destek ve Yardım">Sıkça Sorulan Sorular</div>
        </a>
    </li>

    @admin
        <!-- Settings -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Settings</span></li>
        <li class="menu-item {{ request()->routeIs('admin.settings.index') ? 'active' : '' }}">
            <a href="{{ route('admin.settings.index') }}" class="menu-link">
                <i class='menu-icon tf-icons bx bx-cog'></i>
                <div data-i18n="Genel Ayarlar">Genel Ayarlar</div>
            </a>
        </li>
        <li class="menu-item {{ request()->routeIs('admin.categories.settings') ? 'active' : '' }}">
            <a href="{{ route('admin.categories.settings') }}" class="menu-link">
                <i class='menu-icon tf-icons bx bxs-category'></i>
                <div data-i18n="Genel Ayarlar">Kampanya Kategorileri</div>
            </a>
        </li>
        <!-- Users -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Users</span></li>
        <li class="menu-item {{ request()->routeIs('admin.user.index') ? 'active' : '' }}">
            <a href="{{ route('admin.user.index') }}" class="menu-link">
                <i class='menu-icon tf-icons bx bxs-user-account'></i>
                <div data-i18n="Kullanıcılar">Kullanıcılar</div>
            </a>
        </li>
    @endadmin
</ul>
