<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ URL::asset('build/images/logo-sm.png') }}" alt="" height="40">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('build/images/logo-lg.png') }}" alt="" height="40">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ URL::asset('build/images/logo-sm.png') }}" alt="" height="40">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('build/images/logo-lg.png') }}" alt="" height="40">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span>Menu</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('admin.dashboard') }}" role="button"
                        aria-expanded="false">
                        <i class="ri-apps-2-line"></i> <span>Dashboard</span>
                    </a>
                </li> 

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarWorkers" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarWorkers">
                        <i class="bx bx-bell"></i> <span>Workers</span>
                    </a>
                    <div class="collapse {{ request()->is('admin/workers*') ? 'show' : null }} menu-dropdown" id="sidebarWorkers">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="" class="nav-link">Add / Edit</a>
                            </li>
                        </ul>
                    </div>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>