@extends('dashboard.assets.main')
@section('title', 'Daftar Kelompok Bimbingan')
@section('content')
    <nav aria-label="breadcrumb" class="mx-2 my-2">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dosen.dashboard') }}"><span
                        class="primary-color">Dashboard</span></a></li>
            <li class="breadcrumb-item"><a href="{{ route('dosen.daftar-kelompok') }}"><span class="primary-color">Daftar
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
                        <img src="{{ config('app.base_url') . 'landing/' . 'ukdw.png' ?? 'https://place-hold.it/700x600' }}"
                            alt="Bootstrap" width="200" height="250">
                        <span class="primary-color fw-bold fs-3 mt-3">PROGRAM KREATIVITAS</span>
                        <span class="primary-color fw-bold fs-3">MAHASISWA</span>
                    </div>
                    <div class="proposal h-100 pt-3 pt-lg-5" style="width: 100%;">
                        <div class="card bg-third-color h-100 rounded-4">
                            <div class="d-flex justify-content-between">
                                <span class="mx-4 mt-3  fw-bold primary-color fs-5 d-flex align-items-center"><i
                                        class="fa-solid fa-file me-3"></i>Proposal Final</span>
                            </div>
                            <span class="mx-4 my-2 fw-semibold primary-color fs-5">Judul</span>
                            @if (!empty($proposal->proposal))
                                <span
                                    class="mx-4 my-1 fw-normal primary-color fs-5 fst-italic text-justify">{{ $proposal->detail_judul }}</span>
                                <div class="d-flex h-100 align-items-center justify-content-between">
                                    <span class="mx-4 my-2 fw-normal primary-color"><i
                                            class="fa-regular fa-calendar me-2"></i>{{ $proposal->proposal->created_at->diffForHumans() }}</span>
                                    <a href="{{ route('downloadProposal', [$informasiKelompok['id_kelompok'], $proposal->proposal->nama_file]) }}"
                                        class="mx-4 my-2"><i class="fa-solid fa-download me-2"></i><span
                                            class="d-none d-md-inline">Download Proposal</span></a>
                                </div>
                            @else
                                <span class="mx-4 my-1 fw-normal primary-color fs-5 fst-italic text-justify">Belum ada
                                    proposal
                                    yang di upload</span>
                            @endif
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
                                            class="ms-2 fa-regular fa-user me-3"></i>{{ $anggota['nama'] }}
                                        ({{ $anggota['username'] }})
                                    </span>
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
                                    <i class="ms-2 fa-regular fa-user me-3"></i>{{ $informasiKelompok['dosen'] }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="judul">
            <h3 class="fw-bold primary-color mx-2 my-2 pt-3">Pengajuan Ide</h3>
            @forelse ($judul as $jd)
                <div class="card bg-third-color h-100 my-3 rounded-4">
                    <span class="mx-4 mt-3  fw-bold primary-color fs-5 d-flex align-items-center"><i
                            class="fa-regular fa-lightbulb me-3"></i>Ide</span>
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
                                <div class="d-flex flex-inline mx-2 my-2 align-items-center gap-2">
                                    <span class="fw-normal text-secondary"><i class="fa-regular fa-calendar me-1 "></i>
                                        {{ $komentar->created_at->diffForHumans() }}</span>
                                    @if ($komentar->id_user == Auth::user()->id)
                                        <button type="button" class="btn popover-button" data-id="{{ $komentar->id }}">
                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                        </button>
                                        <div id="popover-content-{{ $komentar->id }}" class="d-none">
                                            <div class="d-flex flex-column align-items-start">
                                                <button class="btn btn-sm editKomentarBtn" data-id="{{ $komentar->id }}"
                                                    data-bs-toggle="modal">Edit</button>
                                                <button class="btn btn-sm"
                                                    onclick="confirmDeleteKomentar('{{ route('dosen.delete-komentar', [$informasiKelompok['id_kelompok'], $komentar->id]) }}')">Delete</button>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <span id="text-{{ $komentar->id }}"
                                class="mx-4 my-1 fw-normal primary-color fs-5 fst-italic text-justify">
                                <span
                                    class="fw-normal fs-5 fst-italic {{ $komentar->status == 'diterima' ? 'text-success' : ($komentar->status == 'perlu perbaikan' ? 'text-warning' : 'text-danger') }}">
                                    {{ ucwords($komentar->status) }}
                                </span> - {{ $komentar->komentar }}
                            </span>

                            <!-- Form Edit (disembunyikan awalnya) -->
                            <div id="form-{{ $komentar->id }}" class="edit-form d-none mx-3">
                                <form action="{{ route('dosen.update-komentar', [$komentar->id, $jd->id_kelompok]) }}"
                                    method="post">
                                    @method('PUT')
                                    @csrf
                                    <div class="komentar d-flex flex-column flex-md-row my-2 gap-2 align-items-center">
                                        <input type="text" class="form-control" name="komentar"
                                            id="input-{{ $komentar->id }}" value="{{ $komentar->komentar }}" required>

                                        <!-- Radio button -->
                                        <div class="radio d-flex gap-2 align-items-center">
                                            <input type="radio" class="btn-check" name="status"
                                                id="options-checked-{{ $komentar->id }}" autocomplete="off"
                                                value="diterima" {{ $komentar->status == 'diterima' ? 'checked' : '' }}
                                                required>
                                            <label class="btn border border-success"
                                                for="options-checked-{{ $komentar->id }}"><span class="text-success"><i
                                                        class="fa-regular fa-thumbs-up"></i></span></label>

                                            <input type="radio" class="btn-check" name="status"
                                                id="options-radio-{{ $komentar->id }}" value="perlu perbaikan"
                                                {{ $komentar->status == 'perlu perbaikan' ? 'checked' : '' }}
                                                autocomplete="off">
                                            <label class="btn border border-danger"
                                                for="options-radio-{{ $komentar->id }}"><span class="text-danger"><i
                                                        class="fa-regular fa-thumbs-down"></i></span></label>
                                        </div>

                                        <button type="submit" class="btn border-primary d-flex align-items-center"><i
                                                class="fa-regular fa-paper-plane text-primary me-1"></i><span
                                                class="text-primary">Send</span></button>
                                        <button type="button" class="btn btn-danger cancelEdit"
                                            data-id="{{ $komentar->id }}">
                                            Batal
                                        </button>
                                    </div>
                                </form>
                            </div>
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
                            <form action="{{ route('dosen.post-komentar', [$jd->id, $jd->id_kelompok]) }}"
                                method="post">
                                @csrf
                                <div class="komentar d-flex flex-column flex-md-row my-2 gap-2 align-items-center">
                                    <input type="text" class="form-control" id="exampleFormControlInput1"
                                        placeholder="Tulis komentar..." name="komentar" required>
                                    <div class="radio d-flex gap-2 align-items-center">
                                        <input type="radio" class="btn-check" name="status"
                                            id="options-checked-{{ $jd->id }}" autocomplete="off" value="diterima"
                                            required>
                                        <label class="btn border border-success"
                                            for="options-checked-{{ $jd->id }}"><span class="text-success"><i
                                                    class="fa-regular fa-thumbs-up"></i></span></label>
                                        <input type="radio" class="btn-check" name="status"
                                            id="options-radio-{{ $jd->id }}" value="perlu perbaikan"
                                            autocomplete="off">
                                        <label class="btn border border-danger"
                                            for="options-radio-{{ $jd->id }}"><span class="text-danger"><i
                                                    class="fa-regular fa-thumbs-down"></i></span></label required>
                                        <button type="submit" class="btn border-primary d-flex align-items-center"><i
                                                class="fa-regular fa-paper-plane text-primary me-1"></i><span
                                                class="text-primary">Send</span></button>
                                    </div>
                                </div>
                            </form>
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
    <!-- Form Untuk Delete -->
    <form id="delete-form" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
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
            document.querySelectorAll(".btn-check").forEach(function(radio) {
                radio.addEventListener("change", function() {
                    updateButtonColors(this);
                });
            });
        });
    </script>
    <!-- Popover script -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Ambil semua tombol popover
            var popoverButtons = document.querySelectorAll(".popover-button");

            popoverButtons.forEach(function(button) {
                // Ambil ID komentar dari atribut data
                var komentarId = button.getAttribute("data-id");
                var popoverContent = document.querySelector("#popover-content-" + komentarId);

                // Buat popover untuk tiap tombol
                new bootstrap.Popover(button, {
                    html: true,
                    sanitize: false,
                    content: function() {
                        return popoverContent.innerHTML;
                    },
                    placement: "left"
                });
            });

            // Delegasi event untuk tombol edit
            document.body.addEventListener("click", function(event) {
                if (event.target.classList.contains("editKomentarBtn")) {
                    let id = event.target.getAttribute("data-id");
                    document.getElementById(`text-${id}`).classList.add("d-none");
                    document.getElementById(`form-${id}`).classList.remove("d-none");
                }

                if (event.target.classList.contains("cancelEdit")) {
                    let id = event.target.getAttribute("data-id");
                    document.getElementById(`text-${id}`).classList.remove("d-none");
                    document.getElementById(`form-${id}`).classList.add("d-none");
                }
            });

            // Menutup popover jika klik di luar
            document.addEventListener("click", function(event) {
                popoverButtons.forEach(function(button) {
                    const popoverInstance = bootstrap.Popover.getInstance(button);
                    if (popoverInstance && !button.contains(event.target)) {
                        popoverInstance.hide();
                    }
                });
            });
        });
    </script>
    <script>
        function confirmDeleteKomentar(url) {
            Swal.fire({
                title: 'Anda Yakin ingin menghapus komentar?',
                text: "Anda tidak akan dapat mengembalikan ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Buat form dinamis
                    let form = document.getElementById("delete-form");
                    form.action = url;
                    form.submit(); // Kirim form dengan method DELETE
                }
            });
        }
    </script>

@endsection
