<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu">Menu</li>

                <li>
                    <a href="{{ route('dashboard') }}">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/') }}" target="_blank">
                        <i data-feather="globe"></i>
                        <span data-key="t-landing-page">Landing Page</span>
                    </a>
                </li>

                @if(Auth::check() && (Auth::user()->isAdmin() || Auth::user()->isOwner()))
                <li class="menu-title" data-key="t-master">Master Data</li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="grid"></i>
                        <span data-key="t-master-data">Master</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ route('master.event-types.index') }}">
                                <span data-key="t-event-types">Event Types</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('master.templates.index') }}">
                                <span data-key="t-templates">Templates</span>
                            </a>
                        </li>
                        
                        @if(Auth::user()->isOwner())
                        <li>
                            <a href="{{ route('master.packages.index') }}">
                                <span data-key="t-packages">Packages</span>
                            </a>
                        </li>
                        @endif

                        <li>
                            <a href="{{ route('master.users.index') }}">
                                <span data-key="t-users">Users / Customers</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

                <li class="menu-title" data-key="t-aplikasi">Aplikasi</li>

                <li>
                    <a href="{{ route('invitations.index') }}">
                        <i data-feather="mail"></i>
                        <span data-key="t-invitations">
                            @if(Auth::check() && (Auth::user()->isAdmin() || Auth::user()->isOwner()))
                                Kelola Undangan
                            @else
                                Undangan Saya
                            @endif
                        </span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
