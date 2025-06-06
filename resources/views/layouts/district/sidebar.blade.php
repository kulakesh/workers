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
                    <a class="nav-link menu-link" href="{{ route('district.dashboard') }}" role="button"
                        aria-expanded="false">
                        <i class="ri-apps-2-line"></i> <span>Dashboard</span>
                    </a>
                </li> 

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarOperator" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarOperator">
                        <i class="bx bx-bell"></i> <span>Operator</span>
                    </a>
                    <div class="collapse {{ request()->is('dt/operator*') ? 'show' : null }} menu-dropdown" id="sidebarOperator">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('district.createOperator') }}" class="nav-link">Add / Edit</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarReports" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarReports">
                        <i class="bx bx-bell"></i> <span>Report</span>
                    </a>
                    <div class="collapse {{ request()->is('dt/reports*') ? 'show' : null }} menu-dropdown" id="sidebarReport">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('district.workersReport') }}" class="nav-link">All Beneficiary</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('district.workersReportApproval') }}" class="nav-link">Pending Beneficiary</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('district.districtWorkersApproved') }}" class="nav-link">Approved Beneficiary</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('district.districtWorkersRejected') }}" class="nav-link">Rejected Beneficiary</a>
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
