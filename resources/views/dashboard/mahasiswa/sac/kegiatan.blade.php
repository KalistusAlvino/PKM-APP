@extends('dashboard.assets.main')
@section('title', 'Mahasiswa - Kegiatan')
@section('content')
    <nav aria-label="breadcrumb" class="mx-2 my-2">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('mahasiswa.dashboard') }}"><span
                        class="primary-color">Dashboard</span></a></li>
            <li class="breadcrumb-item active" aria-current="page">SAC - Kegiatan</li>
        </ol>
    </nav>
    <div class="col-12 d-flex flex-column justify-content-center align-items-center">
        <div class="card bg-primary-color h-100 w-100 rounded-4">
            <span class="mx-4 my-3 fw-bold secondary-color fs-3">Student Activity Credit</span>
            <div class="row">
                <div class="col-4">
                    <div class="input-group d-flex px-4 py-3">
                        <span class="input-group-text" id="addon-wrapping"><i
                                class="fa-solid fa-magnifying-glass"></i></span>
                        <input type="text" class="form-control" placeholder="Cari berdasarkan nama kegiatan"
                            aria-describedby="addon-wrapping" name="nama_ketua" required>
                    </div>
                </div>
            </div>
            <div class="table-responsive mx-4 my-3">
                <table class="table bg-table-transparent table-borderless">
                    <thead>
                        <tr>
                            <th scope="col" class="secondary-color">NO.</th>
                            <th scope="col" class="secondary-color">KEGIATAN</th>
                            <th scope="col" class="secondary-color">KEGIATAN INGGRIS</th>
                            <th scope="col" class="secondary-color">TANGGAL</th>
                            <th scope="col" class="secondary-color">KATEGORI</th>
                            <th scope="col" class="secondary-color">TINGKAT</th>
                            <th scope="col" class="secondary-color">JENIS</th>
                            <th scope="col" class="secondary-color">POIN</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($kegiatan as $idx => $kg)
                            <tr>
                                <td class="secondary-color">{{ $idx + 1 }}</td>
                                <td class="secondary-color">{{ $kg->nama_kegiatan }}</td>
                                <td class="secondary-color">{{ $kg->kegiatan_inggris }}</td>
                                <td class="secondary-color">{{ $kg->tanggal }}</td>
                                <td class="secondary-color">{{ $kg->jenis->tingkat->kategori->nama_kategori }}</td>
                                <td class="secondary-color">{{ $kg->jenis->tingkat->nama_tingkat }}</td>
                                <td class="secondary-color">{{ $kg->jenis->nama_jenis }}</td>
                                <td class="secondary-color">{{ $kg->jenis->poin }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td class="secondary-color">Belum ada kegiatan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
