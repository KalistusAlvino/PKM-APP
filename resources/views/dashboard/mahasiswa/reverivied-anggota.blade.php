@extends('dashboard.assets.main')
@section('title', 'Detail Kelompok')
@section('content')
    <nav aria-label="breadcrumb" class="mx-2 my-2">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('mahasiswa.daftar-kelompok') }}"><span
                        class="primary-color">Kelompok</span></a></li>
            <li class="breadcrumb-item"><a href="{{ route('mahasiswa.detail-kelompok', $id_kelompok) }}"><span
                        class="primary-color">Detail Kelompok</span></a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Email Anggota Settings</li>
        </ol>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="alert alert-warning d-flex align-items-center mb-3">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <span>Email {{$mhs->name}} belum terverifikasi. Silakan cek kotak masuk atau spam
                        folder.</span>
                </div>
                <div class="mb-3">
                    <!-- Form Ubah Email -->
                    <form action="{{route('updateEmailAnggota',[$mhs->email_verification_token, $id_kelompok])}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card">
                            <div class="card-header bg-primary-color">
                                <p class="card-subtitle text-white my-2"> <i
                                        class="fas fa-envelope text-white me-2"></i></i>Ubah email anggota</p>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Email address</label>
                                    <input type="email" class="form-control" name="email" id="exampleFormControlInput1"
                                        value="{{ old('email', $mhs->email) }}">
                                </div>
                                <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                                    <button type="submit" class="btn bg-primary-color text-white">
                                        <i class="fas fa-paper-plane me-2"></i>Ubah Email
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="mb-3">
                    <!-- Form Kirim Ulang Verifikasi -->
                    <div class="card">
                        <div class="card-header bg-primary-color">
                            <p class="card-subtitle text-white my-2"> <i
                                    class="fa-solid fa-rotate-right text-white me-2"></i></i>Kirim ulang verifikasi
                                email</p>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <div class="bg-primary-color p-3 rounded">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-envelope text-white me-3 fs-5"></i>
                                        <div>
                                            <small class="text-white">Email verifikasi akan dikirim ke:</small>
                                            <div class="fw-bold text-white">{{ $mhs->email }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <form action="{{route('resendEmailAnggota',[$mhs->email_verification_token, $id_kelompok])}}" method="POST">
                                @csrf
                                <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                                    <button type="submit" class="btn bg-primary-color text-white">
                                        <i class="fas fa-paper-plane me-2"></i>Kirim Ulang Verifikasi
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
