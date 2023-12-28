<!-- Menu -->
<aside id="layout-menu" class="layout-menu-horizontal menu-horizontal menu bg-menu-theme flex-grow-0">
    <div class="container-xxl d-flex h-100">
    <ul class="menu-inner">
        <!-- Dashboards -->
        <li class="menu-item @if(request()->routeIs('dashboard.FollowUp')) active @endif">
        <a href="dashboard" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons ti ti-smart-home"></i>
            <div data-i18n="Dashboards">Dashboards</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item @if(request()->routeIs('dashboard.FollowUp')) active @endif">
            <a href="{{ route('dashboard.FollowUp') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-home"></i>
                <div data-i18n="Home">Home</div>
            </a>
            </li>
        </ul>
        </li>

        @if(Auth()->user()->role === "Follow Up")
        <!-- Form SPK -->
        <li class="menu-item @if(request()->routeIs('formSpk.FollowUp')) active @endif">
        <a href="{{ route('formSpk.FollowUp', ['state' => 'create']) }}" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons ti ti-file"></i>
            <div data-i18n="Form SPK">Form SPK</div>
        </a>

        <ul class="menu-sub">
            <li class="menu-item @if(request()->routeIs('formSpk.FollowUp')) active @endif">
            <a href="{{ route('formSpk.FollowUp', ['state' => 'create']) }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-file-invoice"></i>
                <div data-i18n="New SPK">New SPK</div>
            </a>
        </ul>
        </li>

        @endif
    </ul>
    </div>
</aside>
<!-- / Menu -->
