@extends('dashboard.assets.main')
@section('title', 'Daftar Kelompok Bimbingan')
@section('content')
    <nav aria-label="breadcrumb" class="mx-2 my-2">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('koordinator.dashboard') }}"><span
                        class="primary-color">Dashboard</span></a></li>
            <li class="breadcrumb-item"><a href="{{ route('koordinator.daftar-kelompok') }}"><span class="primary-color">Daftar
                        Kelompok</span></a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail Kelompok</li>
        </ol>
    </nav>
    <div class="d-flex flex-column">
        <section id="kelompok">
            <h3 class="fw-bold primary-color mx-2 my-2">Detail Kelompok</h3>
            <div class="row">
                <div
                    class="col-12 col-lg-6 d-flex flex-column justify-content-center align-items-center order-2 order-lg-1">
                    <div class="ukdw flex-column justify-content-center align-items-center d-none d-lg-flex">
                        <img src="{{ config('app.base_url') . 'landing/' . 'ukdw.png' ?? 'https://place-hold.it/700x600'}}"
                            alt="Bootstrap" width="200" height="250">
                        <span class="primary-color fw-bold fs-3 mt-3">PROGRAM KREATIVITAS</span>
                        <span class="primary-color fw-bold fs-3">MAHASISWA</span>
                    </div>
                    <div class="proposal h-100 pt-3 pt-lg-5" style="width: 100%;">
                        <div class="card bg-third-color h-100 rounded-4">
                            <span class="mx-4 mt-3  fw-bold primary-color fs-5 d-flex align-items-center"><i
                                    class="fa-solid fa-file me-3"></i>Proposal Final</span>
                            <span class="mx-4 my-2 fw-semibold primary-color fs-5">Judul</span>
                            <span class="mx-4 my-1 fw-normal primary-color fs-5 fst-italic">Implementasi Machine Learning
                                untuk
                                Prediksi
                                Cuaca</span>
                            <div class="d-flex h-100 align-items-center justify-content-between">
                                <span class="mx-4 my-1 fw-normal secondary-color"><i
                                        class="fa-regular fa-calendar me-2"></i>Diajukan: 24-02-08</span>
                                <a href="" class="mx-4"><i class="fa-solid fa-download me-2"></i>Download Proposal</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="col-12 col-lg-6 d-flex justify-content-center align-items-center pt-3 pt-lg-0 order-1 order-lg-2">
                    <div class="card bg-third-color h-100 w-100 rounded-4">
                        <span class="mx-4 my-3 fw-semibold primary-color fs-5 d-flex align-items-center"><i
                                class="fa-solid fa-circle-info me-3"></i>Informasi
                            Kelompok</span>
                        <div class="ketua">
                            <span class="mx-4 my-3 fw-normal primary-color fs-5 d-flex align-items-center"><i
                                    class="fa-solid fa-user-shield me-3"></i></i>Ketua Kelompok</span>
                            <div class="card mx-5 my-2 bg-secondary-color">
                                <span class="mx-2 my-2 primary-color fw-normal"><i class="ms-2 fa-regular fa-user me-3"></i>
                                    @if (!empty($informasiKelompok['ketua']))
                                        {{ $informasiKelompok['ketua']['nama'] }}
                                        ({{ $informasiKelompok['ketua']['username'] }})
                                    @else
                                        <em>Belum ada ketua</em>
                                    @endif
                                </span>
                            </div>
                        </div>
                        <div class="anggota">
                            <div class="listAnggota d-flex justify-content-between">
                                <span class="mx-4 my-2 fw-normal primary-color fs-5 d-flex align-items-center"><i
                                        class="fa-solid fa-users me-3"></i>Anggota Kelompok</span>
                            </div>
                            @forelse ($informasiKelompok['anggota'] as $anggota)
                                <div class="card mx-5 my-2 bg-secondary-color">
                                    <span class="mx-2 my-2 primary-color fw-normal"><i
                                            class="ms-2 fa-regular fa-user me-3"></i>{{$anggota['nama'] }}
                                        ({{$anggota['username']}})</span>
                                </div>
                            @empty
                                <div class="card mx-5 my-2 bg-secondary-color">
                                    <span class="mx-2 my-2 primary-color fw-normal"><em>Belum Ada Anggota</em></span>
                                </div>
                            @endforelse
                        </div>
                        <div class="dosen">
                            <div class="listDosen d-flex justify-content-between">
                                <span class="mx-4 my-2 fw-normal primary-color fs-5 d-flex align-items-center"><i
                                        class="fa-solid fa-graduation-cap me-3"></i>Dosen Pembimbing</span>
                            </div>
                            <div class="card mx-5 my-2 bg-secondary-color">
                                <span class="mx-2 my-2 primary-color fw-normal ">
                                    <i class="ms-2 fa-regular fa-user me-3"></i>{{$informasiKelompok['dosen']}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="judul">
            <h3 class="fw-bold primary-color mx-2 my-2 pt-3">Pengajuan Judul atau Ide</h3>
            @forelse ($judul as $jd)
                        <div class="card bg-third-color h-100 my-3 rounded-4">
                            <span class="mx-4 mt-3  fw-bold primary-color fs-5 d-flex align-items-center"><i
                                    class="fa-regular fa-lightbulb me-3"></i>Judul atau Ide</span>
                            <div class="row">
                                <div class="col-12">
                                    <span
                                        class="mx-4 my-2 fw-normal primary-color fs-5 fst-italic text-wrap d-block text-justify border-bottom border-white border-2 pb-2">{{ $jd->detail_judul }}</span>
                                    <span class="mx-4 my-2 fw-normal primary-color fs-5 fst-italic d-block">Skema :
                                        {{ $jd->skema->nama_skema }}</span>
                                </div>
                            </div>
                            <span class="mx-4 mt-1  fw-bold primary-color fs-5 d-flex align-items-center"><i
                                    class="fa-regular fa-message me-3"></i>Komentar</span>
                            @forelse ($jd->komentar as $komentar)
                                <div class="card h-100 mx-3 my-2 bg-secondary-color rounded-4 mb-3">
                                    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-center ">
                                        <span class="mx-4 mt-2  fw-bold primary-color fs-5 d-flex align-items-center"><i
                                                class="fa-solid fa-graduation-cap me-3"></i>{{ $komentar->user->nama_komentator }}</span>
                                        <span class="mx-4 my-1 fw-normal text-secondary"><i class="fa-regular fa-calendar me-1 "></i>
                                            {{ $komentar->created_at->diffForHumans() }}</span>
                                    </div>
                                    <span class="mx-4 my-1 fw-normal primary-color fs-5 fst-italic text-justify">
                                    <span class="fw-normal fs-5 fst-italic {{ $komentar->status == 'diterima' ? 'text-success' : ($komentar->status == 'perlu perbaikan' ? 'text-warning' : 'text-danger') }}">{{ ucwords($komentar->status) }}</span> - {{ $komentar->komentar }}</span>
                                </div>
                            @empty
                                <div class="card bg-secondary-color h-100 my-3 rounded-4 mx-4">
                                    <em class="mx-4 my-4 primary-color fw-bold">Belum komentar</em>
                                </div>
                            @endforelse
                            <div class="card-footer">
                                <div class="mb-3 mx-3">
                                    <label for="exampleFormControlInput1" class="form-label fw-bold primary-color fs-5">Tambah
                                        Komentar</label>
                                    <form action="{{ route('koordinator.post-komentar', [$jd->id,$jd->id_kelompok]) }}" method="post">
                                        @csrf
                                        <div class="komentar d-flex flex-column flex-md-row my-2 gap-2 align-items-center">
                                            <input type="text" class="form-control" id="exampleFormControlInput1"
                                                placeholder="Tulis komentar..." name="komentar" required>
                                            <div class="radio d-flex gap-2 align-items-center">
                                                <input type="radio" class="btn-check" name="status"
                                                    id="options-checked-{{ $jd->id }}" autocomplete="off" value="diterima" required>
                                                <label class="btn border border-success" for="options-checked-{{ $jd->id }}"><span
                                                        class="text-success"><i class="fa-regular fa-thumbs-up"></i></span></label>
                                                <input type="radio" class="btn-check" name="status"
                                                    id="options-radio-{{ $jd->id }}" value="perlu perbaikan" autocomplete="off">
                                                <label class="btn border border-danger" for="options-radio-{{ $jd->id }}"><span
                                                        class="text-danger"><i class="fa-regular fa-thumbs-down"></i></span></label required>

                                                <button type="submit" class="btn border-primary d-flex align-items-center"><i class="fa-regular fa-paper-plane text-primary me-1"></i><span class="text-primary">Send</span></button>
                                            </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                </div>
            @empty
                <div class="card bg-third-color h-100 my-3 rounded-4">
                    <em class="mx-4 my-4 primary-color fw-bold">Belum ada ide atau judul</em>
                </div>
            @endforelse
    </section>
    </div>

    <script>
       document.addEventListener("DOMContentLoaded", function () {
    function updateButtonColors(radio) {
        let group = radio.closest(".radio"); // Ambil parent div radio group
        let labels = group.querySelectorAll("input.btn-check + label"); // Cari label di dalam grup ini

        // Reset semua tombol dalam grup
        labels.forEach(label => {
            label.classList.remove("bg-success", "bg-danger", "text-white");
            label.querySelector("span").classList.remove("text-white");
        });

        // Tambahkan warna ke tombol yang dipilih
        let selectedLabel = group.querySelector(`label[for="${radio.id}"]`);
        if (radio.value === "diterima") {
            selectedLabel.classList.add("bg-success", "text-white");
            selectedLabel.querySelector("span").classList.add("text-white");
        } else {
            selectedLabel.classList.add("bg-danger", "text-white");
            selectedLabel.querySelector("span").classList.add("text-white");
        }
    }

    // Terapkan warna saat halaman dimuat
    document.querySelectorAll(".btn-check:checked").forEach(updateButtonColors);

    // Tambahkan event listener ke setiap radio button
    document.querySelectorAll(".btn-check").forEach(function (radio) {
        radio.addEventListener("change", function () {
            updateButtonColors(this);
        });
    });
});


    </script>
@endsection
