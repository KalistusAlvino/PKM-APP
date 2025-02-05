<!-- Sidebar -->
<aside id="sidebar" class="sidebar-toggle">
    <div class="sidebar-logo d-flex">
        <img src="{{ config('app.base_url') . 'landing/' . 'ukdw.png' ?? 'https://place-hold.it/700x600'}}"
            alt="Bootstrap" width="25" height="34">
        <a href="#" class="fw-semibold ps-3">PKM UKDW</a>
    </div>
    <!-- Sidebar Navigation -->
    <ul class="sidebar-nav p-0">
        <li class="sidebar-header">
            Utama
        </li>
        <li class="sidebar-item">
            <a href="#" class="sidebar-link">
                <i class="fa-solid fa-chart-pie"></i>
                <span class="ps-1 ">Dashboard</span>
            </a>
            <a href="#" class="sidebar-link">
                <i class="fa-regular fa-address-card"></i>
                <span class="ps-1 ">Daftar Ketua </span>
            </a>
            <a href="#" class="sidebar-link">
                <i class="fa-solid fa-list-check"></i>
                <span class="ps-1 ">Invitation</span>
            </a>
        </li>
        <li class="sidebar-header">
            Kelompok
        </li>
        <li class="sidebar-item">
            <a href="#" class="sidebar-link">
                <i class="fa-solid fa-users"></i>
                <span class="ps-1 ">Detail Kelompok</span>
            </a>
        </li>
        <li class="sidebar-header">
            SAC
        </li>
        <!-- <li class="sidebar-item">
            <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse" data-bs-target="#auth"
                aria-expanded="true" aria-controls="auth">
                <i class="lni lni-protection"></i>
                <span>Auth</span>
            </a>
            <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">Login</a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">Register</a>
                </li>
            </ul>
        </li> -->
        <li class="sidebar-item">
            <a href="#" class="sidebar-link">
                <i class="fa-solid fa-chart-line"></i>
                <span>Poin Keaktivan</span>
            </a>
        </li>
        <!-- <li class="sidebar-item">
            <a href="#" class="sidebar-link">
                <i class="lni lni-cog"></i>
                <span>Setting</span>
            </a>
        </li> -->
    </ul>
    <!-- Sidebar Navigation Ends -->
    <div class="sidebar-footer">
        <a href="#" class="sidebar-link">
        <i class="fa-solid fa-arrow-right-from-bracket"></i>
            <span>Logout</span>
        </a>
    </div>
</aside>
<!-- Sidebar Ends -->
