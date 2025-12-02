<ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('kaban.dashboard') }}">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('img/logo-BKD.png') }}" alt="Logo BKD" class="rounded-circle" style="width: 55px; height: 55px; object-fit: cover;">
        </div>
        <div class="sidebar-brand-text mx-3">Dashboard Kaban</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('kaban.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Menu Kaban
    </div>

    <!-- Nav Item - Surat Masuk -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('kaban.suratmasuk') }}">
            <i class="fas fa-envelope"></i>
            <span>Surat Masuk</span>
        </a>
    </li>

    <!-- Nav Item - Laporan -->
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-file-alt"></i>
            <span>Laporan</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>