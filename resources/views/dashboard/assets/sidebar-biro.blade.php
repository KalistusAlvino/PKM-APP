<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-heading">Utama</li>
        <li class="nav-item">
            <a class="nav-link {{ $key == 'dashboard' ? 'collapsed' : '' }}" href="{{ route('biro.dashboard') }}">
                <i class="fa-solid fa-chart-pie"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-heading">Akademik & Pengembangan</li>
        <li class="nav-item">
            <a class="nav-link {{ $key == 'manajemen-akademik' ? 'collapsed' : '' }}"
                href="{{ route('biro.getPage-manajemen-akademik') }}">
                <i class="fa-solid fa-school"></i>
                <span>Manajemen Akademik</span>
            </a>
        </li>
        <li class="nav-heading">Kelola Kelompok</li>
        <li class="nav-item">
            <a class="nav-link {{ $key == 'daftar-kelompok' ? 'collapsed' : '' }}"
                href="{{ route('biro.daftar-kelompok-page') }}">
                <i class="fa-solid fa-users"></i>
                <span>Daftar Kelompok</span>
            </a>
        </li>
        <!-- End Kelompok Nav -->
        <li class="nav-heading">SAC</li>
        <li class="nav-item">
            <a class="nav-link {{ $key == 'kegiatan-mahasiswa' ? 'collapsed' : '' }}"
                href="{{ route('biro.kegiatan-mahasiswa-page') }}">
                <i class="fa-solid fa-users"></i>
                <span>Kegiatan Mahasiswa</span>
            </a>
        </li>
        <!-- End SAC Nav -->
        <li class="nav-heading">Kelola User</li>
        <li class="nav-item">
            <a class="nav-link {{ $key == 'dosen-account' ? 'collapsed' : '' }}"
                href="{{ route('biro.dosen-account-page') }}">
                <i class="fa-solid fa-user-tie"></i>
                <span>Dosen</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $key == 'koordinator-account' ? 'collapsed' : '' }}"
                href="{{ route('biro.koordinator-account-page') }}">
                <i class="fa-solid fa-user-tie"></i>
                <span>Koordinator</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $key == 'mahasiswa-account' ? 'collapsed' : '' }}"
                href="{{ route('biro.mahasiswa-account-page') }}">
                <i class="fa-solid fa-user-graduate"></i>
                <span>Mahasiswa</span>
            </a>
        </li>
        <!-- End Acount Nav -->
        <li class="nav-heading">Managemen Konten</li>
        <li class="nav-item">
            <a class="nav-link {{ $key == 'manajemen-berita' ? 'collapsed' : '' }}"
                href="{{ route('biro.manajemen-berita') }}">
                <i class="fa-solid fa-newspaper"></i>
                <span>Berita</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $key == 'manajemen-pengumuman' ? 'collapsed' : '' }}"
                href="{{ route('biro.manajemen-pengumuman') }}">
                <i class="fa-solid fa-newspaper"></i>
                <span>Pengumuman</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $key == 'manajemen-faq' ? 'collapsed' : '' }}"
                href="{{ route('biro.manajemen-faq') }}">
                <i class="fa-solid fa-person-circle-question"></i>
                <span>FAQ</span>
            </a>
        </li>
        <!-- End Konten Nav -->
        <li class="nav-heading">Managemen Akun</li>
        <li class="nav-item">
            <a class="nav-link {{ $key == 'change_password' ? 'collapsed' : '' }}"
                href="{{ route('change-password') }}">
                <i class="fa-solid fa-lock"></i>
                <span>Ganti Password</span>
            </a>
        </li>
        <!-- End Akun Nav -->


    </ul>

</aside><!-- End Sidebar-->
