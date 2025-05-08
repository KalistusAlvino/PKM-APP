@extends('dashboard.assets.main')
@section('title', 'Dashboard Dosen')
@section('content')
    <div class="row my-2 ">
        <div class="col-6">
            <a href="{{ route('dosen.daftar-kelompok') }}"
                class="link-offset-2 link-underline link-underline-opacity-0">
                <div class="card-dashboard bg-secondary-color h-100 shadow-sm border-0">
                    <div class="card-body p-3 text-center">
                        <div class="d-flex align-items-center justify-content-center mb-2">
                            <span class="primary-color fw-bold fs-5 me-2">Kelompok</span>
                            <span class="bg-primary-color p-2 rounded-circle">
                                <i class="fa-solid fa-people-group text-white fs-4"></i>
                            </span>
                        </div>
                        <h4 class="primary-color mb-0 fs-3">{{ $kelompokBimbingan }}</h4>
                        <small class="text-muted">Terdaftar dalam sistem</small>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-6">
            <a href="{{ route('dosen.daftar-undangan') }}"
                class="link-offset-2 link-underline link-underline-opacity-0">
                <div class="card-dashboard bg-secondary-color h-100 shadow-sm border-0">
                    <div class="card-body p-3 text-center">
                        <div class="d-flex align-items-center justify-content-center mb-2">
                            <span class="primary-color fw-bold fs-5 me-2">Undangan</span>
                            <span class="bg-primary-color p-2 rounded-circle">
                                <i class="fa-solid fa-scroll text-white fs-4"></i>
                            </span>
                        </div>
                        <h4 class="primary-color mb-0 fs-3">{{ $invite }}</h4>
                        <small class="text-muted">Terdaftar dalam sistem</small>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card bg-secondary-color shadow-lg py-2 px-2 mt-2">
                {!! $barChart->container() !!}
            </div>
        </div>
    </div>

    <script src="{{ $barChart->cdn() }}"></script>

    {{ $barChart->script() }}
@endsection
