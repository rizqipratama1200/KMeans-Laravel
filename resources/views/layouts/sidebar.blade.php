<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-cubes"></i>
        </div>
        <div class="sidebar-brand-text mx-3">K-Means Clustering </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
        <a class="nav-link" href="/">
            <i class="fas fa-fw fa-home"></i>
            <span>Beranda</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    {{-- <div class="sidebar-heading">
        Interface
    </div> --}}

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ request()->is('dataset') ? 'active' : '' }}">
        <a class="nav-link" href="/dataset">
            <i class="fas fa-database fa-fw"></i>
            <span>Dataset</span>
        </a>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item {{ request()->is('inisialisasi','proses') ? 'active' : '' }}">
        <a class="nav-link " href="/inisialisasi" >
            <i class="fas fa-fw fa-square-root-alt"></i>
            <span>Algoritma & Pengujian</span>
        </a>
    </li>

    {{-- <li class="nav-item">
        <a class="nav-link " href="/hasil" >
            <i class="fas fa-fw fa-square-root-alt"></i>
            <span>Hasil</span>
        </a>
    </li> --}}

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
