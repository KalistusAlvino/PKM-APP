<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-heading">Utama</li>
        <li class="nav-item">
            <a class="nav-link {{ $key == 'dashboard' ? 'collapsed' : ''}}" href="{{route('mahasiswa.dashboard')}}">
                <i class="fa-solid fa-chart-pie"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-heading">Kelompok</li>
        <li class="nav-item">
            <a class="nav-link {{ $key == 'mendaftar' ? 'collapsed' : ''}}" href="{{route('mahasiswa.daftar-ketua')}}">
                <i class="fa-solid fa-users"></i>
                <span>Mendaftar Ketua</span>
            </a>
        </li><!-- End Kelompok Nav -->
        <li class="nav-item">
            <a class="nav-link {{ $key == 'daftar_kelompok' ? 'collapsed' : ''}}" href="{{route('mahasiswa.daftar-kelompok')}}">
                <i class="fa-solid fa-users"></i>
                <span>Daftar Kelompok</span>
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
