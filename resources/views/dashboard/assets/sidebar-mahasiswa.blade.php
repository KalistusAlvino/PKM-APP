<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-heading">Utama</li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('mahasiswa.dashboard')}}">
                <i class="fa-solid fa-chart-pie"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-heading">Kelompok</li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('mahasiswa.daftar-ketua')}}">
                <i class="fa-solid fa-users"></i>
                <span>Daftar Ketua</span>
            </a>
        </li><!-- End Kelompok Nav -->
        <li class="nav-item">
            <a class="nav-link" href="{{route('mahasiswa.daftar-kelompok')}}">
                <i class="fa-solid fa-users"></i>
                <span>Daftar Kelompok</span>
            </a>
        </li><!-- End Kelompok Nav -->


    </ul>

</aside><!-- End Sidebar-->
