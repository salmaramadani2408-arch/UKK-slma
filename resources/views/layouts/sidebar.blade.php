<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('img/logo-BKD.png') }}" alt="Logo BKD" class="rounded-circle" style="width: 55px; height: 55px; object-fit: cover;">
        </div>
        <div class="sidebar-brand-text mx-3">Disposisi Digital</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-home"></i>
            <span>Dashboard</span>
        </a>
    </li>

    
    <!-- Nav Item - Surat Masuk -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.disposisi.index') }}">
            <i class="fas fa-envelope"></i>
            <span>Surat Masuk</span>
        </a>
    </li>

    <!-- Nav Item - History -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.history.index') }}">
            <i class="fas fa-history"></i>
            <span>History</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
          
</ul>