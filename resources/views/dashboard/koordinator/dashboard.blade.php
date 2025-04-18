@extends('dashboard.assets.main')
@section('title', 'Dashboard Koordinator')
@section('content')
    <span style="display: inline-block; border-bottom: 2px solid #3b564d; width: 100%;"
        class="mx-2 fw-bold fs-2 primary-color">Dashboard Koordinator</span>
    <div class="row my-2 ">
        <div class="col-12 col-lg-4 mb-2">
            <div class="card bg-secondary-color">
                <div class="d-flex flex-inline justify-content-between align-items-center">
                    <span class="mx-4 my-2 primary-color fw-bold fs-4">
                        Total Mahasiswa
                    </span>
                    <div class="card mx-4 my-2 border border-0 bg-primary-color">
                        <span class="mx-2 my-1 secondary-color fw-bold fs-2">
                            <i class="fa-solid fa-graduation-cap"></i>
                        </span>
                    </div>
                </div>
                <div class="d-flex flex-column">
                    <span class="mx-4 mt-4 primary-color fw-bold fs-3">
                        {{ $mahasiswa }}
                    </span>
                    <span class="mx-4 mb-2 primary-color">
                        Mahasiswa terdaftar didalam sistem
                    </span>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4 mb-2">
            <div class="card bg-secondary-color">
                <div class="d-flex flex-inline justify-content-between align-items-center">
                    <span class="mx-4 my-2 primary-color fw-bold fs-4">
                        Total Dosen
                    </span>
                    <div class="card mx-4 my-2 border border-0 bg-primary-color">
                        <span class="mx-2 my-1 secondary-color fw-bold fs-2">
                            <i class="fa-solid fa-person-chalkboard"></i>
                        </span>
                    </div>
                </div>
                <div class="d-flex flex-column">
                    <span class="mx-4 mt-4 primary-color fw-bold fs-3">
                        {{ $dosen }}
                    </span>
                    <span class="mx-4 mb-2 primary-color">
                        Dosen terdaftar didalam sistem
                    </span>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4 mb-2">
            <div class="card bg-secondary-color">
                <div class="d-flex flex-inline justify-content-between align-items-center">
                    <span class="mx-4 my-2 primary-color fw-bold fs-4">
                        Total Kelompok
                    </span>
                    <div class="card mx-4 my-2 border border-0 bg-primary-color">
                        <span class="mx-2 my-1 secondary-color fw-bold fs-2">
                            <i class="fa-solid fa-users-rectangle"></i>
                        </span>
                    </div>
                </div>
                <div class="d-flex flex-column">
                    <span class="mx-4 mt-4 primary-color fw-bold fs-3">
                        {{ $kelom }}
                    </span>
                    <span class="mx-4 mb-2 primary-color">
                        Kelompok terdaftar didalam sistem
                    </span>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 mb-2">
            <div class="card bg-secondary-color">
                <div class="d-flex flex-inline justify-content-between align-items-center">
                    <span class="mx-4 my-2 primary-color fw-bold fs-4">
                        Total Skema PKM
                    </span>
                    <div class="card mx-4 my-2 border border-0 bg-primary-color">
                        <span class="mx-2 my-1 secondary-color fw-bold fs-2">
                            <i class="fa-solid fa-book-open"></i>
                        </span>
                    </div>
                </div>
                <div class="d-flex flex-column">
                    <span class="mx-4 mt-4 primary-color fw-bold fs-3">
                        {{ $skema }}
                    </span>
                    <span class="mx-4 mb-2 primary-color">
                        Skema PKM terdaftar didalam sistem
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="card bg-secondary-color shadow-lg py-2 px-2">
        {!! $barChart->container() !!}
    </div>
    <script src="{{ $barChart->cdn() }}"></script>

    {{ $barChart->script() }}
@endsection
