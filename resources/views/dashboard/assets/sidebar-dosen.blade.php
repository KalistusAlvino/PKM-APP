<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-heading">Utama</li>
        <li class="nav-item">
            <a class="nav-link {{ $key == 'dashboard' ? 'collapsed' : ''}}" href="{{route('dosen.dashboard')}}">
                <i class="fa-solid fa-chart-pie"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->


        <li class="nav-heading">Kelompok</li>
        <li class="nav-item">
            <a class="nav-link {{ $key == 'daftar_undangan' ? 'collapsed' : ''}}" href="{{route('dosen.daftar-undangan')}}">
                <i class="fa-regular fa-envelope"></i>
                <span>Daftar Undangan </span>
            </a>
        </li><!-- End Invite Nav -->
        <li class="nav-item">
            <a class="nav-link {{ $key == 'daftar_kelompok' ? 'collapsed' : ''}}" href="{{route('dosen.daftar-kelompok')}}">
                <i class="fa-solid fa-users"></i>
                <span>Kelompok Bimbingan </span>
            </a>
        </li><!-- End Kelompok Nav -->

        <li class="nav-heading">Managemen Akun</li>
        <li class="nav-item">
            <a class="nav-link {{ $key == 'change_password' ? 'collapsed' : ''}}" href="{{route('change-password')}}">
                <i class="fa-solid fa-lock"></i>
                <span>Ganti Password</span>
            </a>
        </li><!-- End Akun Nav -->


    </ul>

</aside><!-- End Sidebar-->
