@extends('dashboard.assets.main')
@section('title', 'Daftar Kelompok')
@section('content')
    <nav aria-label="breadcrumb" class="mx-2 my-2">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('biro.dashboard') }}"><span
                        class="primary-color">Dashboard</span></a></li>
            <li class="breadcrumb-item active" aria-current="page">Daftar Kelompok</li>
        </ol>
    </nav>
    <div class="card h-25 bg-third-color mb-4 mx-2 my-2">
        <div class="row">
            <div class="col-12 col-md-9 d-flex flex-column">
                <span class="fw-bolder fs-1 mx-4 my-3 primary-color text-center">Daftar Kelompok Bimbingan</span>
                <span class=" fs-5 mx-4 mb-4 primary-color text-center">Berikut adalah daftar kelompok yang sedang dalam
                    bimbingan</span>
            </div>
            <div class="col-12 col-md-3 d-none d-md-flex align-items-center justify-content-center">
                <img src="{{ config('app.base_url') . 'dashboard/biro/' . 'user-group.png' ?? 'https://place-hold.it/700x600' }}"
                    alt="user-group" width="100" height="100">
            </div>
        </div>
    </div>
    <div class="row mb-2 mx-1">
        <div class="col-12 col-md-6 col-lg-4">
            <form method="POST" action="{{ route('biro.daftar-kelompok-page') }}">
                @csrf
                <div class="input-group d-flex">
                    <span class="input-group-text" id="addon-wrapping"><i class="fa-solid fa-magnifying-glass"></i></span>
                    <input type="text" class="form-control" placeholder="Cari berdasarkan nama ketua"
                        aria-describedby="addon-wrapping" name="nama_ketua">
                </div>
            </form>
        </div>
    </div>
    <div class="mx-2 my-4">
        @forelse ($daftarKelompok as $index => $kelompok)
            <div class="card bg-third-color my-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 mx-2 my-2">
                            <div class="d-flex flex-row justify-content-between align-items-center">
                                <h4 class="fw-medium primary-color text-center">Kelompok {{ $index + 1 }}</h4>
                                <a href="{{ route('biro.detail-kelompok', $kelompok['id_kelompok']) }}"
                                    class="m-0 p-0 border rounded-circle bg-secondary-color mx-3 d-flex align-items-center justify-content-center link-underline link-underline-opacity-0"
                                    style="width: 50px; height: 50px;">
                                    <i class="fa-solid fa-angle-right primary-color fs-5"></i>
                                </a>
                            </div>
                            <div class="d-flex flex-row justify-content-start align-items-center primary-color mb-2">
                                <i class="fa-solid fa-user-plus me-2"></i>
                                <span>{{ $kelompok['total_anggota'] }} Total Anggota - Skema : {{$kelompok['skema']}}</span>
                            </div>
                            <div class="d-flex flex-row justify-content-start align-items-center primary-color mb-3">
                                <i class="fa-solid fa-chalkboard-user me-2"></i>
                                <span>Dosen Pembimbing : {{$kelompok['dosen']}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="card mx-3">
                        <div class="row">
                            <div
                                class="col-12 d-flex flex-row justify-content-start align-items-center third-color mx-3 mt-3 mb-2 fw-semibold">
                                <i class="fa-solid fa-shield me-2 mb-1 primary-color"></i>
                                <span class="primary-color">Ketua : {{ $kelompok['ketua'] }}</span>
                            </div>
                            <div
                                class="col-12 d-flex flex-row justify-content-start align-items-center third-color mx-3 mt-1 mb-3 fw-semibold">
                                <div class="d-flex flex-column flex-md-row">
                                    @if ($kelompok['anggota']->isEmpty())
                                        <span class="primary-color ms-1 fst-italic">Belum ada anggota</span>
                                    @else
                                        @foreach ($kelompok['anggota'] as $anggota)
                                            <div class="card primary-color bg-third-color mx-1 my-1 my-md-0">
                                                <span class="mx-2 my-1 fw-normal">
                                                    {{ $anggota['nama'] }}
                                                </span>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="card bg-third-color my-3">
                <span class="primary-color fw-bold mx-2 my-2 fst-italic">Belum ada atau tidak ada kelompok</span>
            </div>
        @endforelse
    </div>
@endsection
