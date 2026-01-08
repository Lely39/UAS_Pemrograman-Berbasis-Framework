<!-- BEGIN #sidebar -->
<div id="sidebar" class="app-sidebar">
    <div class="app-sidebar-content" data-scrollbar="true" data-height="100%">
        <div class="menu">
            <div class="menu-header">Navigation</div>

<div class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
    <a href="{{ route('admin.dashboard') }}" class="menu-link">
        <span class="menu-icon"><i class="fa fa-laptop"></i></span>
        <span class="menu-text">Dashboard</span>
    </a>
</div>


            <div class="menu-item {{ request()->routeIs('pesanan.*') ? 'active' : '' }}">
                <a href="{{ route('pesanan') }}" class="menu-link">
                    <span class="menu-icon"><i class="fa fa-table"></i></span>
                    <span class="menu-text">Pesanan</span>
                </a>
            </div>

            <div class="menu-item {{ request()->routeIs('elektronik.*') ? 'active' : '' }}">
                <a href="{{ route('elektronik') }}" class="menu-link">
                    <span class="menu-icon"><i class="fa fa-table"></i></span>
                    <span class="menu-text">Elektronik</span>
                </a>
            </div>

            <div class="menu-divider"></div>
            <div class="menu-header">Users</div>

            <div class="menu-item">
                <a href="{{ route('login') }}" class="menu-link">
                    <span class="menu-icon">
                        <i class="fa fa-user-circle"></i>
                    </span>
                    <span class="menu-text">Logout</span>
                </a>
            </div>

        </div>
    </div>

    <button class="app-sidebar-mobile-backdrop" data-dismiss="sidebar-mobile"></button>
</div>

@yield('content')
