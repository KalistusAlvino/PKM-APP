@extends('dashboard.assets.main')
@section('title', 'Kelompok Mahasiswa')
@section('content')
    <h3 class="fw-bold primary-color mx-3 my-2">Daftar Kelompok</h3>
    <div class="row mb-2 mx-1">
        <div class="col-12 col-md-6 col-lg-4">
            <form method="POST" action="{{ route('mahasiswa.daftar-kelompok') }}">
                @csrf
                <div class="input-group d-flex">
                    <span class="input-group-text" id="addon-wrapping"><i class="fa-solid fa-magnifying-glass"></i></span>
                    <input type="text" class="form-control" placeholder="Cari berdasarkan nama ketua"
                        aria-describedby="addon-wrapping" name="nama_ketua">
                </div>
            </form>
        </div>
        <div class="col-12 col-md-6 col-lg-4">
            <form id="filterForm" method="GET" action="{{ route('mahasiswa.daftar-kelompok') }}">
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-filter"></i></span>
                    <select class="form-select" name="filter_judul" aria-label="Default select example" id="filterSelect">
                        <option value=""
                            {{ request('filter_judul') === null || request('filter_judul') === '' ? 'selected' : '' }}>
                            Filter Judul</option>
                        <option value="true" {{ request('filter_judul') === 'true' ? 'selected' : '' }}>Judul valid
                        </option>
                        <option value="false" {{ request('filter_judul') === 'false' ? 'selected' : '' }}>Belum ada judul
                        </option>
                    </select>
                </div>
            </form>
        </div>
        <div class="col-12 col-md-6 col-lg-4">
            <form id="filterTahunForm" method="GET" action="{{ route('mahasiswa.daftar-kelompok') }}">
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-filter"></i></span>
                    <select class="form-select" name="filter_tahun" aria-label="Default select example"
                        id="filterSelectTahun">
                        <option value=""
                            {{ request('filter_tahun') === null || request('filter_tahun') === '' ? 'selected' : '' }}>
                            Filter Tahun
                        </option>
                        @for ($year = date('Y'); $year >= date('Y') - 5; $year--)
                            <option value="{{ $year }}" {{ request('filter_tahun') == $year ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                        @endfor
                    </select>
                </div>
            </form>
        </div>
    </div>
    <div class="mx-2 my-4">
        @forelse ($kelompokList as $index => $kelompok)
            <div class="card bg-third-color my-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 mx-2 my-2">
                            <div class="d-flex flex-row justify-content-between align-items-center">
                                <h4 class="fw-medium primary-color text-center">Kelompok {{ $index + 1 }} - {{$kelompok['tahun_daftar']}}</h4>
                                <a href="{{ route('mahasiswa.detail-kelompok', $kelompok['id_kelompok']) }}"
                                    class="m-0 p-0 border rounded-circle bg-secondary-color mx-3 d-flex align-items-center justify-content-center link-underline link-underline-opacity-0"
                                    style="width: 50px; height: 50px;">
                                    <i class="fa-solid fa-angle-right primary-color fs-5"></i>
                                </a>
                            </div>
                            <div class="d-flex flex-row justify-content-start align-items-center primary-color mb-3">
                                <i class="fa-solid fa-user-plus me-2 mb-1"></i>
                                <span>{{ $kelompok['total_anggota'] }} Total Anggota - Skema :
                                    {{ $kelompok['skema'] }}</span>
                            </div>
                            <div class="d-flex flex-row justify-content-start align-items-center primary-color mb-3">
                                <i class="fa-solid fa-chalkboard-user me-2"></i>
                                <span>Dosen Pembimbing : {{ $kelompok['dosen'] }}</span>
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
    <script>
        document.getElementById('filterSelect').addEventListener('change', function() {
            document.getElementById('filterForm').submit();
        });
        document.getElementById('filterSelectTahun').addEventListener('change', function() {
            document.getElementById('filterTahunForm').submit();
        });
    </script>
@endsection
