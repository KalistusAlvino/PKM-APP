@extends('dashboard.assets.main')
@section('title', 'Kelompok Mahasiswa')
@section('content')
<h3 class="fw-bold primary-color mx-2 my-2">Daftar Kelompok</h3>

<div class="mx-2 my-4">
@foreach ($daftarKelompok as $index => $kelompok)
    <div class="card bg-third-color">
        <div class="card-body">
            <div class="row">
                <div class="col-12 d-flex justify-content-between align-items-center mx-2 my-3">
                    <h5 class="fw-medium primary-color">Kelompok {{ $index + 1 }}</h5> {{-- Index dimulai dari 1 --}}
                    <a href="" class="m-0 p-0 border rounded-circle bg-secondary-color mx-3">
                        <i class="fa-solid fa-arrow-right primary-color fs-5 mx-2 my-2 "></i>
                    </a>
                </div>
            </div>

            {{-- Menampilkan Ketua --}}
            <div class="row">
                <div class="col-12 d-flex justify-content-start align-items-center mx-2 my-2">
                    <i class="fa-solid fa-user me-4 primary-color"></i>
                    <span class="fw-medium text-center primary-color">
                        Ketua:
                        @php
                            $ketua = $anggotaKelompok[$kelompok->kelompokId]->where('status_mahasiswa', 'ketua')->first();
                        @endphp
                        {{ $ketua ? $ketua->mahasiswa->name : 'Belum Ada' }}
                    </span>
                </div>
            </div>

            {{-- Menampilkan Jumlah Anggota --}}
            <div class="row">
                <div class="col-12 d-flex justify-content-start align-items-center mx-2 my-2">
                    <i class="fa-solid fa-users me-3 primary-color"></i>
                    <span class="fw-medium text-center primary-color">
                        {{ $anggotaKelompok[$kelompok->kelompokId]->count() - ($ketua ? 1 : 0) }} Anggota
                    </span>
                </div>
            </div>
        </div>
    </div>
@endforeach


</div>

@endsection
