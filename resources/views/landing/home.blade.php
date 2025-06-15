@extends('assets.main')
@section('title', 'PKM UKDW')
@section('content')
    <section id="home">
        <div class="container-fluid content-height" style="background-color: white;">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-5 d-flex content-height align-items-center justify-content-center">
                        <div class="text slide-in-left">
                            <h1 class="fw-bold primary-color">PROGRAM KREATIVITAS MAHASISWA</h1>
                            <p class="text-justify">Punya ide brilian? Waktunya wujudkan idemu melalui PKM! PKM
                                bukan sekedar program, tapi juga peluang untuk berkarya dan berprestasi. Yuk, gabung
                                sekarang!</p>
                        </div>
                    </div>
                    <div class="col-12 col-lg-7 d-none d-lg-flex content-height align-items-center justify-content-center">
                        <img src="{{ config('app.base_url') . 'landing/' . 'skimpkm.png' ?? 'https://place-hold.it/700x600' }}"
                            alt="landing.home" class="slide-in-right" style="width: 100%;">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="pengumuman">
        <div class="container-fluid content-height bg-third-color">
            <div class="container content-height d-flex flex-column">
                <div class="d-flex border-bottom border-3 align-items-center justify-content-between">
                    <h3 class="pt-5 primary-color fw-bold pb-2">
                        <i class="fa-solid fa-bullhorn pe-2"></i> Pengumuman
                    </h3>
                    <a href="{{ route('daftar-pengumuman') }}" class="pt-5 text-white fw-bold pb-2">
                        Lihat selengkapnya
                    </a>
                </div>
                <div class="pt-3 flex-grow-1 d-flex align-items-center">
                    <div class="row">
                        @forelse ($pengumuman as $item)
                            <div class="col-12 col-lg-6 mb-3 mb-lg-0">
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
        </div>
    </section>
    <section id="berita">
        <div class="container-fluid content-height">
            <div class="container content-height d-flex flex-column">
                <div class="d-flex border-bottom border-3 align-items-center justify-content-between">
                    <h3 class="pt-5 primary-color fw-bold pb-2">
                        <i class="fa-regular fa-newspaper pe-2"></i> Berita
                    </h3>
                    <a href="{{ route('daftar-berita') }}" class="pt-5 third-color fw-bold pb-2">
                        Lihat selengkapnya
                    </a>
                </div>
                <div class="pt-3 flex-grow-1 d-flex align-items-center">
                    <div class="row">
                        @forelse ($berita as $item)
                            <div class="col-12 col-lg-6 mb-3">
                                <div class="card bg-gray shadow-lg">
                                    <img src="{{ $item->gambar ? asset('storage/' . $item->gambar) : 'https://place-hold.it/700x600' }}"
                                        class="card-img-top img-fixed-height" alt="...">
                                    <div class="card-body" style="height: 200px;">
                                        <p class="text-secondary">
                                            <i class="fa-regular fa-calendar me-1"></i>
                                            {{ $item->created_at->diffForHumans() }}
                                        </p>
                                        <h5 class="card-title fw-semibold primary-color fs-4 card-title-custom">
                                            {{ $item->title }}
                                        </h5>
                                        <div class="card-text card-text-custom text-justify mb-2">
                                            {!! $item->isi !!}
                                        </div>
                                        <a href="{{ route('detail-berita', $item->id) }}"
                                            class="d-flex justify-content-end text-secondary align-items-center">
                                            <i class="fa-solid fa-arrow-up-right-from-square me-1"></i>
                                            Lihat selengkapnya
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
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
        </div>
    </section>
    <section id="faq">
        <div class="container-fluid content-height bg-third-color">
            <div class="container content-height">
                <div class="d-flex border-bottom border-3 align-items-center justify-content-between">
                    <h3 class="pt-5 primary-color fw-bold pb-2">
                        <i class="fa-regular fa-circle-question pe-2"></i> FAQ
                    </h3>
                    <a href="{{ route('daftar-faq') }}" class="pt-5 text-white fw-bold pb-2">
                        Lihat selengkapnya
                    </a>
                </div>
                <div class="pt-3 d-flex flex-column align-items-center">
                    @forelse ($faq as $item)
                        <div class="accordion accordion-flush shadow-lg mb-3" id="accordionFlushExample{{ $item->id }}"
                            style="width: 100%;">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapse{{ $item->id }}" aria-expanded="false"
                                        aria-controls="flush-collapse{{ $item->id }}">
                                        {{ $item->pertanyaan }}
                                    </button>
                                </h2>
                                <div id="flush-collapse{{ $item->id }}" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionFlushExample{{ $item->id }}">
                                    <div class="accordion-body text-secondary">{{ $item->jawaban }}</div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-info text-center" role="alert">
                            <h5 class="alert-heading">Tidak Ada FAQ</h5>
                            <p>Belum ada pertanyaan yang tersedia saat ini. Silakan cek kembali nanti.</p>
                            <hr>
                            <p class="mb-0">Anda juga dapat menghubungi kami untuk informasi lebih lanjut.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
    <script src="{{ asset('js/carousel.js') }}"></script>
@endsection
