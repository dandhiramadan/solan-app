<!-- Menu -->
<aside id="layout-menu" class="layout-menu-horizontal menu-horizontal menu bg-menu-theme flex-grow-0">
    <div class="container-xxl d-flex h-100">
        <ul class="menu-inner">
            @if (Auth()->user()->role === 'Follow Up')
                <!-- Dashboards -->
                <li class="menu-item @if (request()->routeIs('dashboard.FollowUp')) active @endif">
                    <a href="dashboard" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons ti ti-smart-home"></i>
                        <div data-i18n="Dashboards">Dashboards</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item @if (request()->routeIs('dashboard.FollowUp')) active @endif">
                            <a href="{{ route('dashboard.FollowUp') }}" class="menu-link">
                                <i class="menu-icon tf-icons ti ti-home"></i>
                                <div data-i18n="Home">Home</div>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Form SPK -->
                <li class="menu-item @if (request()->routeIs('formSpk.FollowUp')) active @endif">
                    <a href="{{ route('formSpk.FollowUp', ['state' => 'create']) }}" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons ti ti-file"></i>
                        <div data-i18n="Form SPK">Form SPK</div>
                    </a>

                    <ul class="menu-sub">
                        <li class="menu-item @if (request()->routeIs('formSpk.FollowUp')) active @endif">
                            <a href="{{ route('formSpk.FollowUp', ['state' => 'create']) }}" class="menu-link">
                                <i class="menu-icon tf-icons ti ti-file-invoice"></i>
                                <div data-i18n="New SPK">New SPK</div>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
            @if (Auth()->user()->role === 'Stock')
                <!-- Dashboards -->
                <li class="menu-item @if (request()->routeIs('dashboard.Stock')) active @endif">
                    <a href="dashboard" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons ti ti-smart-home"></i>
                        <div data-i18n="Dashboards">Dashboards</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item @if (request()->routeIs('dashboard.Stock')) active @endif">
                            <a href="{{ route('dashboard.Stock') }}" class="menu-link">
                                <i class="menu-icon tf-icons ti ti-home"></i>
                                <div data-i18n="Home">Home</div>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Form SPK -->
                <li class="menu-item @if (request()->routeIs('managementProducts.Stock') or request()->routeIs('managementAccessories.Stock')) active @endif">
                    <a href="{{ route('managementProducts.Stock') }}" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons ti ti-category"></i>
                        <div data-i18n="Products">Products</div>
                    </a>

                    <ul class="menu-sub">
                        <li class="menu-item @if (request()->routeIs('managementProducts.Stock')) active @endif">
                            <a href="{{ route('managementProducts.Stock') }}" class="menu-link">
                                <i class="menu-icon tf-icons ti ti-file-plus"></i>
                                <div data-i18n="Management Products">Management Products</div>
                            </a>
                        </li>
                        <li class="menu-item @if (request()->routeIs('managementAccessories.Stock')) active @endif">
                            <a href="{{ route('managementAccessories.Stock') }}" class="menu-link">
                                <i class="menu-icon tf-icons ti ti-file-plus"></i>
                                <div data-i18n="Management Accessories">Management Accessories</div>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Form SPK -->
                <li class="menu-item @if (request()->routeIs('formSpk.FollowUp')) active @endif">
                    <a href="{{ route('formSpk.FollowUp', ['state' => 'create']) }}" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons ti ti-package"></i>
                        <div data-i18n="Stock">Stock</div>
                    </a>

                    <ul class="menu-sub">
                        <li class="menu-item @if (request()->routeIs('formSpk.FollowUp')) active @endif">
                            <a href="{{ route('formSpk.FollowUp', ['state' => 'create']) }}" class="menu-link">
                                <i class="menu-icon tf-icons ti ti-file-plus"></i>
                                <div data-i18n="Add Stock">Add Stock</div>
                            </a>
                        </li>
                        <li class="menu-item @if (request()->routeIs('formSpk.FollowUp')) active @endif">
                            <a href="{{ route('formSpk.FollowUp', ['state' => 'create']) }}" class="menu-link">
                                <i class="menu-icon tf-icons ti ti-file-spreadsheet"></i>
                                <div data-i18n="List Stock">List Stock</div>
                            </a>
                        </li>
                        <li class="menu-item @if (request()->routeIs('formSpk.FollowUp')) active @endif">
                            <a href="{{ route('formSpk.FollowUp', ['state' => 'create']) }}" class="menu-link">
                                <i class="menu-icon tf-icons ti ti-history"></i>
                                <div data-i18n="History Stock">History Stock</div>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
        </ul>
    </div>
</aside>
<!-- / Menu -->
