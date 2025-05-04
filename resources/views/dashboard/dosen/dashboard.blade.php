@extends('dashboard.assets.main')
@section('title', 'Dashboard Dosen')
@section('content')
    <span style="display: inline-block; border-bottom: 2px solid #3b564d; width: 100%;"
        class="mx-2 fw-bold fs-2 primary-color">Dashboard Dosen</span>
    <div class="row my-2 ">
        <div class="col-12 col-lg-6 mb-2">
            <a href="{{ route('dosen.daftar-kelompok') }}" class="link-offset-2 link-underline link-underline-opacity-0">
                <div class="card bg-secondary-color">
                    <div class="d-flex flex-inline justify-content-between align-items-center">
                        <span class="mx-4 my-2 primary-color fw-bold fs-4">
                            Total Kelompok Bimbingan
                        </span>
                        <div class="card mx-4 my-2 border border-0 bg-primary-color">
                            <span class="mx-2 my-1 secondary-color fw-bold fs-2">
                                <i class="fa-solid fa-people-group"></i>
                            </span>
                        </div>
                    </div>
                    <div class="d-flex flex-column">
                        <span class="mx-4 mt-4 primary-color fw-bold fs-3">
                            {{ $kelompokBimbingan }}
                        </span>
                        <span class="mx-4 mb-2 primary-color">
                            Kelompok bimbingan terdaftar dalam sistem
                        </span>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-12 col-lg-6 mb-2">
            <a href="{{ route('dosen.daftar-undangan') }}" class="link-offset-2 link-underline link-underline-opacity-0">
                <div class="card bg-secondary-color">
                    <div class="d-flex flex-inline justify-content-between align-items-center">
                        <span class="mx-4 my-2 primary-color fw-bold fs-4">
                            Undangan
                        </span>
                        <div class="card mx-4 my-2 border border-0 bg-primary-color">
                            <span class="mx-2 my-1 secondary-color fw-bold fs-2">
                                <i class="fa-solid fa-scroll"></i>
                            </span>
                        </div>
                    </div>
                    <div class="d-flex flex-column">
                        <span class="mx-4 mt-4 primary-color fw-bold fs-3">
                            {{ $invite }}
                        </span>
                        <span class="mx-4 mb-2 primary-color">
                            Undangan menunggu untuk di respon
                        </span>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card bg-secondary-color shadow-lg py-2 px-2">
                {!! $barChart->container() !!}
            </div>
        </div>
    </div>

    <script src="{{ $barChart->cdn() }}"></script>

    {{ $barChart->script() }}
@endsection
