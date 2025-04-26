@extends('dashboard.assets.main')
@section('title', 'Mahasiswa - SAC')
@section('content')
    <nav aria-label="breadcrumb" class="mx-2 my-2">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('mahasiswa.dashboard') }}"><span
                        class="primary-color">Dashboard</span></a></li>
            <li class="breadcrumb-item active" aria-current="page">SAC - Home</li>
        </ol>
    </nav>
    <div class="col-12 d-flex flex-column justify-content-center align-items-center order-2 order-lg-1">
        <div class="card bg-primary-color h-100 w-100 rounded-4">
            <span class="mx-4 my-3 fw-bold secondary-color fs-3">Student Activity Credit</span>
            <div class="row mx-4 my-3">
                <div class="col-lg-6">
                    <div class="d-flex flex-column">
                        <div class="row">
                            <div class="col-5 col-lg-2">
                                <span class="secondary-color">
                                    NIM
                                </span>
                            </div>
                            <div class="col-7 col-lg-10">
                                <span class="secondary-color fw-semibold">
                                    : {{ $mahasiswa->user->username }}
                                </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-5 col-lg-2">
                                <span class="secondary-color">
                                    NAMA
                                </span>
                            </div>
                            <div class="col-7 col-lg-10">
                                <span class="secondary-color fw-semibold">
                                    : {{ $mahasiswa->name }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="d-flex flex-column">
                        <div class="row">
                            <div class="col-5 col-lg-2">
                                <span class="secondary-color">
                                    FAKULTAS
                                </span>
                            </div>
                            <div class="col-7 col-lg-10">
                                <span class="secondary-color fw-semibold">
                                    : {{ $mahasiswa->fakultas }}
                                </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-5 col-lg-2">
                                <span class="secondary-color">
                                    PRODI
                                </span>
                            </div>
                            <div class="col-7 col-lg-10">
                                <span class="secondary-color fw-semibold">
                                    : {{ $mahasiswa->prodi }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive mx-4 my-2">
                <table class="table bg-table-transparent table-borderless">
                    <thead>
                        <tr>
                            <th scope="col" class="secondary-color">NO.</th>
                            <th scope="col" class="secondary-color">KEGIATAN</th>
                            <th scope="col" class="secondary-color">WAKTU</th>
                            <th scope="col" class="secondary-color">POIN</th>
                            <th scope="col" class="secondary-color">JABATAN</th>
                            <th scope="col" class="secondary-color">LINGKUP</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($kegiatan as $idx => $kg)
                            <tr>
                                <td class="secondary-color">{{ $idx + 1 }}</td>
                                <td class="secondary-color">{{ $kg->nama_kegiatan }}</td>
                                <td class="secondary-color">{{ $kg->tanggal }}</td>
                                <td class="secondary-color">{{ $kg->jenis->poin }}</td>
                                <td class="secondary-color">{{ $kg->jenis->nama_jenis }}</td>
                                <td class="secondary-color">{{ $kg->jenis->tingkat->nama_tingkat }}</td>
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
