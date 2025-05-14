@extends('assets.main')
@section('title', 'PKM UKDW | Pengumuman PKM')
@section('content')
    <div class="container-fluid py-4">
        <div class="container">
            <!-- Breadcrumb Navigation -->
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('halamanHome') }}"
                            class="text-decoration-none text-secondary">Beranda</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $pengumuman->title }}</li>
                </ol>
            </nav>

            <!-- Article Header -->
            <div class="row mb-4">
                <div class="col-12">
                    <h1 class="fw-bold primary-color">{{ $pengumuman->title }}</h1>
                    <p class="text-secondary mb-0">
                        <i class="fa-regular fa-calendar me-1"></i> {{ $pengumuman->created_at->diffForHumans() }}
                    </p>
                </div>
            </div>

            <!-- Featured Image -->
            <div class="row mb-4">
                <div class="col-12">
                    <img src="{{ $pengumuman->gambar ? asset('storage/' . $pengumuman->gambar) : 'https://place-hold.it/700x600' }}"
                        class="img-fluid rounded shadow-sm w-100" style="max-height: 500px; object-fit: cover;"
                        alt="Pendaftaran PKM">
                </div>
            </div>

            <!-- Article Content -->
            <div class="row mb-5">
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <article class="text-justify">
                                {!! $pengumuman->isi !!}
                                <div class="alert alert-primary mt-4">
                                    <i class="fa-solid fa-circle-info me-2"></i>
                                    Untuk informasi lebih lanjut, silakan hubungi bagian
                                    kemahasiswaan di kampus Anda.
                                </div>
                            </article>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Back Button -->
            <div class="row mb-5">
                <div class="col-12">
                    <a href="{{ route('halamanHome') }}" class="btn btn-outline-primary">
                        <i class="fa-solid fa-arrow-left me-2"></i> Kembali ke halaman beranda
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
