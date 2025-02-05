@extends('assets.main')
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
                    <img src="{{ config('app.base_url') . 'landing/' . 'skimpkm.png' ?? 'https://place-hold.it/700x600'}}"
                        alt="landing.home" class="slide-in-right" style="width: 100%;">
                </div>
            </div>
        </div>
    </div>
</section>
<section id="pengumuman">
    <div class="container-fluid content-height bg-third-color">
        <div class="container content-height d-flex flex-column">
            <h3 class="pt-5 primary-color fw-bold border-bottom pb-2 border-3">
                <i class="fa-solid fa-bullhorn pe-2"></i> Pengumuman
            </h3>
            <div class="pt-3 flex-grow-1 d-flex align-items-center">
                <div class="row">
                    <div class="col-12 col-lg-6 mb-3 mb-lg-0">
                        <div class="card bg-gray shadow-lg">
                            <img src="https://d1xfmswpy8tuze.cloudfront.net/uploads/RC6YQbEMLEvjF5KWjGn4dvVLEhhrPwTOL6pmhRFl.webp"
                                class="card-img-top img-fixed-height" alt="...">
                            <div class="card-body" style="height: 200px;">
                                <p class="text-secondary">
                                    <i class="fa-regular fa-calendar me-1"></i> 3 Days ago
                                </p>
                                <h5 class="card-title fw-semibold primary-color fs-4 card-title-custom">Pendaftaran PKM telah dibuka!</h5>
                                <p class="card-text card-text-custom text-justify">Punya ide brilian? Waktunya wujudkan idemu melalui
                                    PKM! PKM bukan
                                    sekedar program, tapi juga peluang untuk berkarya dan berprestasi. Yuk, gabung
                                    sekarang!</p>
                                <a href="" class="d-flex justify-content-end text-secondary align-items-center"><i
                                        class="fa-solid fa-arrow-up-right-from-square me-1"></i>Lihat selengkapnya</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 mb-3 mb-lg-0">
                        <div class="card bg-gray shadow-lg">
                            <img src="https://d1xfmswpy8tuze.cloudfront.net/uploads/RC6YQbEMLEvjF5KWjGn4dvVLEhhrPwTOL6pmhRFl.webp"
                                class="card-img-top img-fixed-height" alt="...">
                            <div class="card-body" style="height: 200px;">
                                <p class="text-secondary">
                                    <i class="fa-regular fa-calendar me-1"></i> 3 Days ago
                                </p>
                                <h5 class="card-title fw-semibold primary-color fs-4 card-title-custom">Pendaftaran PKM telah dibuka!</h5>
                                <p class="card-text card-text-custom text-justify">Punya ide brilian? Waktunya wujudkan idemu melalui
                                    PKM! PKM bukan
                                    sekedar program, tapi juga peluang untuk berkarya dan berprestasi. Yuk, gabung
                                    sekarang!</p>
                                <a href="" class="d-flex justify-content-end text-secondary align-items-center"><i
                                        class="fa-solid fa-arrow-up-right-from-square me-1"></i>Lihat selengkapnya</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="berita">
    <div class="container-fluid content-height">
        <div class="container content-height d-flex flex-column">
            <h3 class="pt-5 primary-color fw-bold border-bottom pb-2 border-3">
                <i class="fa-regular fa-newspaper pe-2"></i> Berita
            </h3>
            <div class="pt-3 flex-grow-1 d-flex align-items-center">
                <div class="row">
                    <div class="col-12 col-lg-6 mb-3 mb-lg-0">
                        <div class="card bg-gray shadow-lg">
                            <img src="https://d1xfmswpy8tuze.cloudfront.net/uploads/RC6YQbEMLEvjF5KWjGn4dvVLEhhrPwTOL6pmhRFl.webp"
                                class="card-img-top img-fixed-height" alt="...">
                            <div class="card-body" style="height: 200px;">
                                <p class="text-secondary">
                                    <i class="fa-regular fa-calendar me-1"></i> 3 Days ago
                                </p>
                                <h5 class="card-title fw-semibold primary-color fs-4 card-title-custom">Pendaftaran PKM telah dibuka!</h5>
                                <p class="card-text card-text-custom text-justify">Punya ide brilian? Waktunya wujudkan idemu melalui
                                    PKM! PKM bukan
                                    sekedar program, tapi juga peluang untuk berkarya dan berprestasi. Yuk, gabung
                                    sekarang!</p>
                                <a href="" class="d-flex justify-content-end text-secondary align-items-center"><i
                                        class="fa-solid fa-arrow-up-right-from-square me-1"></i>Lihat selengkapnya</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 mb-3 mb-lg-0">
                        <div class="card bg-gray shadow-lg">
                            <img src="https://d1xfmswpy8tuze.cloudfront.net/uploads/RC6YQbEMLEvjF5KWjGn4dvVLEhhrPwTOL6pmhRFl.webp"
                                class="card-img-top img-fixed-height" alt="...">
                            <div class="card-body" style="height: 200px;">
                                <p class="text-secondary">
                                    <i class="fa-regular fa-calendar me-1"></i> 3 Days ago
                                </p>
                                <h5 class="card-title fw-semibold primary-color fs-4 card-title-custom">Pendaftaran PKM telah dibuka!</h5>
                                <p class="card-text card-text-custom text-justify">Punya ide brilian? Waktunya wujudkan idemu melalui
                                    PKM! PKM bukan
                                    sekedar program, tapi juga peluang untuk berkarya dan berprestasi. Yuk, gabung
                                    sekarang!</p>
                                <a href="" class="d-flex justify-content-end text-secondary align-items-center"><i
                                        class="fa-solid fa-arrow-up-right-from-square me-1"></i>Lihat selengkapnya</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="faq">
    <div class="container-fluid content-height bg-third-color">
        <div class="container content-height">
            <h3 class="pt-5 primary-color fw-bold border-bottom pb-2 border-3">
                <i class="fa-regular fa-circle-question pe-2"></i> Frequently Asked Questions
            </h3>
            <div class="pt-3 d-flex flex-column align-items-center">
                <div class="accordion accordion-flush shadow-lg mb-3" id="accordionFlushExample" style="width: 100%;">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseOne" aria-expanded="false"
                                aria-controls="flush-collapseOne">
                                Apakah Harus Memiliki Dosen Pembimbing ?
                            </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse"
                            data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body text-secondary">Ya. Tentu Saja !</div>
                        </div>
                    </div>
                </div>
                <div class="accordion accordion-flush shadow-lg" id="accordionFlushExample" style="width: 100%;">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#2" aria-expanded="false"
                                aria-controls="2">
                                Apakah Harus Memiliki Dosen Pembimbing ?
                            </button>
                        </h2>
                        <div id="2" class="accordion-collapse collapse"
                            data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body text-secondary">Ya. Tentu Saja !</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="{{asset('js/carousel.js')}}"></script>
@endsection
