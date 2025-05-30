@extends('assets.main')
@section('title', 'PKM UKDW | Daftar Pengumuman')
@section('content')
    <div class="min-vh-100" style="background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);">
        <div class="container py-5">
            <div class="mb-5">
                <div class="d-flex justify-content-between align-items-center border-bottom border-3 pb-3">
                    <h3 class="primary-color fw-bold d-flex align-items-center">
                        <i class="fa-solid fa-bullhorn me-3 fs-2"></i>
                        Daftar Pengumuman
                    </h3>
                    <span class="badge bg-secondary fs-6">{{ $pengumuman->count() }} pengumuman</span>
                </div>
            </div>
            <!-- Announcements Grid -->
            <div class="row g-4 mb-5">
                @forelse ($pengumuman as $item)
                    <div class="pt-3 flex-grow-1 d-flex align-items-center">
                        <div class="row">
                            <div class="col-6 col-lg-4 mb-3 mb-lg-0">
                                <div class="card bg-gray shadow-lg">
                                    <img src="{{ $item->gambar ? asset('storage/' . $item->gambar) : 'https://place-hold.it/700x600' }}"
                                        class="card-img-top img-fixed-height" alt="...">
                                    <div class="card-body" style="height: 200px;">
                                        <p class="text-secondary">
                                            <i class="fa-regular fa-calendar me-1"></i>
                                            {{ $item->created_at->diffForHumans() }}
                                        </p>
                                        <h5 class="card-title fw-semibold primary-color fs-4 card-title-custom">
                                            {{ $item->title }}</h5>
                                        <div class="card-text card-text-custom text-justify mb-2">
                                            {!! $item->isi !!}</div>
                                        <a href="{{ route('detail-pengumuman', $item->id) }}"
                                            class="d-flex justify-content-end text-secondary align-items-center"><i
                                                class="fa-solid fa-arrow-up-right-from-square me-1"></i>Lihat
                                            selengkapnya</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="pt-3">
                        <div class="alert alert-info text-center" role="alert">
                            <h5 class="alert-heading">Tidak Ada Berita</h5>
                            <p>Belum ada berita yang tersedia saat ini. Silakan cek kembali nanti.</p>
                            <hr>
                            <p class="mb-0">Anda juga dapat menghubungi kami untuk informasi lebih lanjut.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
