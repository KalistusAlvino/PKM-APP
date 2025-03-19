<nav class="navbar navbar-expand-lg py-3 bg-third-color">
    <div class="container d-flex justify-content-between">
        <a class="navbar-brand d-flex" href="#">
            <img src="{{ config('app.base_url') . 'landing/' . 'ukdw.png' ?? 'https://place-hold.it/700x600'}}"
                alt="logo_ukdw" width="25" height="34">
            <p class="primary-color fs-4 fw-semibold mb-0 ms-3">PKM UKDW</p>
        </a>
        <div class="d-flex justify-content-end d-md-block d-lg-none gap-4">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse ms-auto pt-3 pt-lg-0" id="navbarNavDropdown">
            <ul class="navbar-nav fs-6 ms-auto sm-ms-2 gap-4">
                <li class="nav-item ">
                    <a class="nav-link primary-color" aria-current="page" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link primary-color" aria-current="page" href="/berita">Pengumuman</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link primary-color" aria-current="page" href="/dokter">Berita</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link primary-color" aria-current="page" href="/dokter">Tentang PKM</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link border rounded-3 border-white btn-hover" aria-current="page" href={{route('halamanLogin')}}>
                        <div class="ms-lg-0 ms-2 primary-color">
                            Login
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
