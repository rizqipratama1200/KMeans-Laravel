<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Search -->
    {{-- <form
        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
        <div class="input-group">
            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                aria-label="Search" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
        </div>
    </form> --}}

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">


        <!-- Nav Item - Messages -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600">{{Auth::user()->name}}</span>
                <img class="img-profile rounded-circle"
                    src="{{asset('img')}}/user.png" width="10px">
            </a>
            <!-- Dropdown - User Information -->
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow mx-1">
            <form action="{{route('logout')}}" method="post">
                @csrf
                <button class="btn btn-warning btn-icon-split btn-sm mt-3">
                    <span class="icon text-white-50">
                        <i class="fas fa-sign-out-alt"></i>
                    </span>
                    <span class="text">Logout</span>
                </button>
            </form>
            <!-- Dropdown - Messages -->
        </li>

    </ul>

</nav>
<!-- End of Topbar -->
