<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-heading">Utama</li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('dosen.dashboard')}}">
                <i class="fa-solid fa-chart-pie"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-heading">Kelola User</li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('biro.dosen-account-page')}}">
                <i class="fa-solid fa-user-tie"></i>
                <span>Dosen</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('biro.koordinator-account-page')}}">
                <i class="fa-solid fa-user-tie"></i>
                <span>Koordinator</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('biro.mahasiswa-account-page')}}">
            <i class="fa-solid fa-user-graduate"></i>
                <span>Mahasiswa</span>
            </a>
        </li>
        <!-- End Kelompok Nav -->

    </ul>

</aside><!-- End Sidebar-->
