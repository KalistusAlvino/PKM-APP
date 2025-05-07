@extends('dashboard.assets.main')
@section('title', 'Dashboard Biro')
@section('content')
    <span style="display: inline-block; border-bottom: 2px solid #3b564d; width: 100%;"
        class="mx-2 fw-bold fs-2 primary-color">Dashboard Biro</span>
    <div class="row g-2 my-2">
        <!-- Mahasiswa Card -->
        <div class="col-6 col-md-3">
            <a href="{{ route('biro.mahasiswa-account-page') }}"
                class="link-offset-2 link-underline link-underline-opacity-0">
                <div class="card-dashboard bg-secondary-color h-100 shadow-sm border-0">
                    <div class="card-body p-3 text-center">
                        <div class="d-flex align-items-center justify-content-center mb-2">
                            <span class="primary-color fw-bold fs-5 me-2">Mahasiswa</span>
                            <span class="bg-primary-color p-2 rounded-circle">
                                <i class="fa-solid fa-graduation-cap text-white fs-4"></i>
                            </span>
                        </div>
                        <h4 class="primary-color mb-0 fs-3">{{ $mahasiswa }}</h4>
                        <small class="text-muted">Terdaftar dalam sistem</small>
                    </div>
                </div>
            </a>
        </div>

        <!-- Dosen Card -->
        <div class="col-6 col-md-3">
            <a href="{{ route('biro.dosen-account-page') }}" class="link-offset-2 link-underline link-underline-opacity-0">
                <div class="card-dashboard bg-secondary-color h-100 shadow-sm border-0">
                    <div class="card-body p-3 text-center">
                        <div class="d-flex align-items-center justify-content-center mb-2">
                            <span class="primary-color fw-bold fs-5 me-2">Dosen</span>
                            <span class="bg-primary-color p-2 rounded-circle">
                                <i class="fa-solid fa-person-chalkboard text-white fs-4"></i>
                            </span>
                        </div>
                        <h4 class="primary-color mb-0 fs-3">{{ $dosen }}</h4>
                        <small class="text-muted">Terdaftar dalam sistem</small>
                    </div>
                </div>
            </a>
        </div>

        <!-- Kelompok Card -->
        <div class="col-6 col-md-3">
            <a href="{{ route('biro.daftar-kelompok-page') }}"
                class="link-offset-2 link-underline link-underline-opacity-0">
                <div class="card-dashboard bg-secondary-color h-100 shadow-sm border-0">
                    <div class="card-body p-3 text-center">
                        <div class="d-flex align-items-center justify-content-center mb-2">
                            <span class="primary-color fw-bold fs-5 me-2">Kelompok</span>
                            <span class="bg-primary-color p-2 rounded-circle">
                                <i class="fa-solid fa-users-rectangle text-white fs-4"></i>
                            </span>
                        </div>
                        <h4 class="primary-color mb-0 fs-3">{{ $kelompok }}</h4>
                        <small class="text-muted">Terdaftar dalam sistem</small>
                    </div>
                </div>
            </a>
        </div>

        <!-- Skema PKM Card -->
        <div class="col-6 col-md-3">
            <a href="{{ route('biro.getPage-manajemen-akademik') }}"
                class="link-offset-2 link-underline link-underline-opacity-0">
                <div class="card-dashboard bg-secondary-color h-100 shadow-sm border-0">
                    <div class="card-body p-3 text-center">
                        <div class="d-flex align-items-center justify-content-center mb-2">
                            <span class="primary-color fw-bold fs-5 me-2">Skema PKM</span>
                            <span class="bg-primary-color p-2 rounded-circle">
                                <i class="fa-solid fa-book-open text-white fs-4"></i>
                            </span>
                        </div>
                        <h4 class="primary-color mb-0 fs-3">{{ $skema }}</h4>
                        <small class="text-muted">Terdaftar dalam sistem</small>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-8">
            <div class="card bg-secondary-color shadow-lg my-2 py-2 px-2">
                {!! $barChart->container() !!}
            </div>
        </div>
        <div class="col-12 col-md-4">
            
            <div class="card bg-secondary-color shadow-lg my-2 py-2 px-2">
                {!! $pieChart->container() !!}
            </div>
        </div>
    </div>

    <script src="{{ $barChart->cdn() }}"></script>
    <script src="{{ $pieChart->cdn() }}"></script>

    {{ $barChart->script() }}
    {{ $pieChart->script() }}
@endsection
