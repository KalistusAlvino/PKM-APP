@extends('dashboard.assets.main')
@section('title', 'Daftar Kelompok Bimbingan')
@section('content')
    <nav aria-label="breadcrumb" class="mx-2 my-2">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dosen.dashboard') }}"><span
                        class="primary-color">Dashboard</span></a></li>
            <li class="breadcrumb-item active" aria-current="page">Daftar Kelompok</li>
        </ol>
    </nav>
    <div class="row mb-2 mx-1">
        <div class="col-12 col-md-6 col-lg-4">
            <form method="POST" action="{{ route('dosen.daftar-kelompok') }}">
                @csrf
                <div class="input-group d-flex">
                    <span class="input-group-text" id="addon-wrapping"><i class="fa-solid fa-magnifying-glass"></i></span>
                    <input type="text" class="form-control" placeholder="Cari berdasarkan nama ketua"
                        aria-describedby="addon-wrapping" name="nama_ketua">
                </div>
            </form>
        </div>
        <div class="col-12 col-md-6 col-lg-4">
            <form id="filterForm" method="GET" action="{{ route('dosen.daftar-kelompok') }}">
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
            <form id="filterTahunForm" method="GET" action="{{ route('dosen.daftar-kelompok') }}">
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
        <div class="table-responsive">
            <table class="table table-striped my-3 align-middle">
                <thead class="bg-secondary-color">
                    <tr>
                        <th>No</th>
                        <th>Ketua</th>
                        <th>Total Anggota</th>
                        <th>Skema</th>
                        <th>Anggota</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($daftarKelompok as $index => $kelompok)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $kelompok['ketua'] }}</td>
                            <td>{{ $kelompok['total_anggota'] }}</td>
                            <td>{{ $kelompok['skema'] }}</td>
                            <td>
                                @if ($kelompok['anggota']->isEmpty())
                                    <span class="text-muted">Belum ada anggota</span>
                                @else
                                    <div class="d-flex flex-wrap">
                                        @foreach ($kelompok['anggota'] as $anggota)
                                            <div class="badge bg-primary-color text-white me-1 mb-1">
                                                {{ $anggota['nama'] }}
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('dosen.detail-kelompok', $kelompok['id_kelompok']) }}"
                                    class="btn btn-secondary">
                                    <i class="fa-solid fa-angle-right"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted fw-bold">Belum ada atau tidak ada kelompok</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="d-flex justify-content-center mt-4">
        {{ $daftarKelompok->links() }}
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
