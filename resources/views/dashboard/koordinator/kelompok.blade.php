@extends('dashboard.assets.main')
@section('title', 'Daftar Kelompok')
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
            <form method="POST" action="{{ route('koordinator.daftar-kelompok') }}">
                @csrf
                <div class="input-group d-flex">
                    <span class="input-group-text" id="addon-wrapping"><i class="fa-solid fa-magnifying-glass"></i></span>
                    <input type="text" class="form-control" placeholder="Cari berdasarkan nama ketua"
                        aria-describedby="addon-wrapping" name="nama_ketua">
                </div>
            </form>
        </div>
        <div class="col-12 col-md-6 col-lg-4">
            <form id="filterForm" method="GET" action="{{ route('koordinator.daftar-kelompok') }}">
                <div class="input-group mb-3">
                    <span class="input-group-text">Filter Kelompok</span>
                    <select class="form-select" name="filter_judul" aria-label="Default select example" id="filterSelect">
                        <option value=""
                            {{ request('filter_judul') === null || request('filter_judul') === '' ? 'selected' : '' }}>
                            Filter berdasarkan</option>
                        <option value="true" {{ request('filter_judul') === 'true' ? 'selected' : '' }}>Judul valid
                        </option>
                        <option value="false" {{ request('filter_judul') === 'false' ? 'selected' : '' }}>Belum ada judul
                        </option>
                    </select>
                </div>
            </form>
        </div>
    </div>
    <div class="mx-2 my-2">
        <div class="table-responsive">
            <table class="table table-striped bg-third-color my-3 text-center">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Ketua</th>
                        <th>Total Anggota</th>
                        <th>Skema</th>
                        <th>Judul</th>
                        <th>Dosen Pembimbing</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($daftarKelompok as $index => $kelompok)
                        <tr>
                            <td>{{ $daftarKelompok->firstItem() + $index }}</td>
                            <td>{{ $kelompok['nim'] }}</td>
                            <td>{{ $kelompok['ketua'] }}</td>
                            <td>{{ $kelompok['total_anggota'] }}</td>
                            <td>{{ $kelompok['skema'] }}</td>
                            <td> {{ Str::limit($kelompok['judul'], 50, '...') }}</td>
                            <td>{{ $kelompok['dosen'] }}</td>
                            <td>
                                <a href="{{ route('koordinator.detail-kelompok', $kelompok['id_kelompok']) }}"
                                    class="btn btn-secondary">
                                    <i class="fa-solid fa-angle-right"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center primary-color fw-bold fst-italic">Belum ada atau tidak ada
                                kelompok</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-4">
            {{ $daftarKelompok->links() }}
        </div>
    </div>
    <script>
        document.getElementById('filterSelect').addEventListener('change', function() {
            document.getElementById('filterForm').submit();
        });
    </script>
@endsection
