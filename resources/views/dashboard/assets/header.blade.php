  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="{{route('mahasiswa.dashboard')}}" class="logo d-flex align-items-center link-underline-opacity-0 link-underline">
            <img src="{{ config('app.base_url') . 'landing/' . 'ukdw.png' ?? 'https://place-hold.it/700x600'}}" alt="logo_dashboard">
            <span class="d-none d-lg-block fw-bold primary-color">PKM UKDW</span>
        </a>
        <i class="fa-solid fa-indent toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <img src="{{ config('app.base_url') . 'landing/' . 'ukdw.png' ?? 'https://place-hold.it/700x600'}}" alt="Profile" class="rounded-circle">
                    <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->getNamaUserAttribute() }}</span>
                </a><!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6>{{ Auth::user()->getNamaUserAttribute() }}</h6>
                        <span>{{ ucwords(Auth::user()->role) }}</span>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Sign Out</span>
                        </a>
                    </li>

                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->

        </ul>
    </nav><!-- End Icons Navigation -->

</header><!-- End Header -->
