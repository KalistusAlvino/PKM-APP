@extends('dashboard.assets.main')
@section('title', 'Dashboard Koordinator')
@section('content')
    <span style="display: inline-block; border-bottom: 2px solid #3b564d; width: 100%;"
        class="mx-2 fw-bold fs-2 primary-color">Dashboard Koordinator</span>
    <div class="row d-flex align-items-stretch my-2">
        <div class="col-12 col-md-8">
            <div class="card bg-secondary-color shadow-lg py-2 px-2 flex-fill">
                {!! $barChart->container() !!}
            </div>
        </div>
        <div class="col-12 col-md-4">
            <!-- Kelompok Card -->
            <a href="{{ route('koordinator.daftar-kelompok') }}"
                class="link-offset-2 link-underline link-underline-opacity-0">
                <div class="card-dashboard bg-secondary-color shadow-sm border-0 flex-fill shadow-lg">
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
            <div class="card bg-secondary-color shadow-lg my-2 py-2 px-2 flex-fill">
                {!! $pieChart->container() !!}
            </div>
        </div>
    </div>
    <script src="{{ $barChart->cdn() }}"></script>
    <script src="{{ $pieChart->cdn() }}"></script>

    {{ $barChart->script() }}
    {{ $pieChart->script() }}
@endsection
