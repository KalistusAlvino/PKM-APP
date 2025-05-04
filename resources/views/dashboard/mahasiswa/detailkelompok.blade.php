@extends('dashboard.assets.main')
@section('title', 'Detail Kelompok')
@section('content')
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
                            <div class="d-flex justify-content-between">
                                <span class="mx-4 mt-3  fw-bold primary-color fs-5 d-flex align-items-center"><i
                                        class="fa-solid fa-file me-3"></i>Proposal Final</span>
                                @if ($judul->isNotEmpty())
                                    @if ($isKetua)
                                        <button type="button" class="btn bg-primary-color mx-4 mt-3 d-flex align-items-center"
                                            data-bs-toggle="modal" data-bs-target="#fileModal">
                                            <i class="fa-solid fa-upload secondary-color"></i>
                                        </button>
                                    @endif
                                @endif
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
                                <span class="mx-4 my-1 fw-normal primary-color fs-5 fst-italic text-justify">Belum ada proposal
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
                                @if ($isKetua && $lessThan)
                                    <a href="{{ route('mahasiswa.tambah-anggota-page', $informasiKelompok['id_kelompok']) }}"
                                        class="btn bg-primary-color mx-4 my-2">
                                        <i class="fa-solid fa-user-plus secondary-color"></i>
                                    </a>
                                @endif
                            </div>
                            @forelse ($informasiKelompok['anggota'] as $anggota)
                                @if ($isKetua)
                                    <div class="d-flex">
                                        <div class="card ms-5 my-2 bg-secondary-color flex-grow-1">
                                            <span class="mx-2 my-2 primary-color fw-normal"><i
                                                    class="ms-2 fa-regular fa-user me-3"></i>{{$anggota['nama'] }}
                                                ({{$anggota['username']}})</span>
                                        </div>
                                        <button class="btn btn-danger tes me-4 ms-3 my-2"
                                            onclick="confirmDeleteAnggota('{{ $anggota['nama'] }}','{{ route('deleteAnggota', [$anggota['id_kelompok'], $anggota['id_mk']]) }}')">
                                            <i class="fa-regular fa-trash-can"></i>
                                        </button>

                                    </div>
                                @else
                                    <div class="card mx-5 my-2 bg-secondary-color flex-grow-1">
                                        <span class="mx-2 my-2 primary-color fw-normal"><i
                                                class="ms-2 fa-regular fa-user me-3"></i>{{$anggota['nama'] }}
                                            ({{$anggota['username']}})</span>
                                    </div>
                                @endif
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
                                @if ($isKetua && !$hasDospem && !$hasPendingInvite)
                                    <a href="{{ route('mahasiswa.tambah-dosen-page', $informasiKelompok['id_kelompok']) }}"
                                        class="btn bg-primary-color mx-4 my-2">
                                        <i class="fa-solid fa-user-plus secondary-color"></i>
                                    </a>
                                @endif
                            </div>
                            @if ($hasDospem)
                                @if ($isKetua)
                                    <div class="d-flex">
                                        <div class="card ms-5 my-2 bg-secondary-color flex-grow-1">
                                            <span class="mx-2 my-2 primary-color fw-normal ">
                                                <i class="ms-2 fa-regular fa-user me-3"></i>{{$informasiKelompok['dosen']}}</span>
                                        </div>
                                        <button class="btn btn-danger tes me-4 ms-3 my-2"
                                            onclick="confirmDeleteDosen('{{ $informasiKelompok['dosen'] }}','{{ route('deleteDospem', $informasiKelompok['id_kelompok']) }}')">
                                            <i class="fa-regular fa-trash-can"></i>
                                        </button>
                                    </div>
                                @else
                                    <div class="card mx-5 my-2 bg-secondary-color flex-grow-1">
                                        <span class="mx-2 my-2 primary-color fw-normal ">
                                            <i class="ms-2 fa-regular fa-user me-3"></i>{{$informasiKelompok['dosen']}}</span>
                                    </div>
                                @endif
                            @else
                                <div class="card mx-5 my-2 bg-secondary-color">
                                    @if ($hasPendingInvite)
                                        <em class="mx-2 my-2 primary-color">Menunggu Konfirmasi Dosen</em>
                                    @else
                                        <em class="mx-2 my-2 primary-color">Belum ada dosen pembimbing</em>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </div>
    </section>
    <section id="judul">
        <h3 class="fw-bold primary-color mx-2 my-2 pt-3">Pengajuan Ide</h3>
        <div class="mx-2 fw-bold primary-color d-flex justify-content-end">
            @if ($verifyKelompok)
                <button type="button" class="btn bg-primary-color mx-4" data-bs-toggle="modal" data-bs-target="#judulModal">
                    <i class="fa-regular fa-square-plus secondary-color me-2"></i> <span class="secondary-color">Tambah
                        Judul</span>
                </button>
            @endif
        </div>
        @forelse ($judul as $jd)
            <div class="card bg-third-color h-100 my-3 rounded-4">
                <div class="d-flex justify-content-between align-items-center mx-4 mt-3">
                    <span class="fw-bold primary-color fs-5"><i class="fa-regular fa-lightbulb me-3"></i>
                        Ide</span>
                    @if ($jd->id_user == Auth::user()->id)
                        <button type="button" class="btn popover-button" data-id="{{ $jd->id }}">
                            <i class="fa-solid fa-ellipsis-vertical fs-5"></i>
                        </button>
                        <div id="popover-content-{{$jd->id}}" class="d-none">
                            <div class="d-flex flex-column align-items-start">
                                <button class="btn btn-sm editJudul" data-id="{{ $jd->id }}" data-bs-toggle="modal"
                                    data-bs-target="#editJudulModal">Edit</button>
                                <button class="btn btn-sm"
                                    onclick="confirmDeleteJudul('{{ route('deleteJudul', [$informasiKelompok['id_kelompok'], $jd->id]) }}')">Delete</button>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-12 col-md-10">
                        <span
                            class="mx-4 my-2 fw-normal primary-color fs-5 fst-italic text-wrap d-block">{{ $jd->detail_judul }}
                            - Ditambahkan: {{ $jd->user->getNamaUserAttribute() }}.</span>
                    </div>
                    <div class="col-12 d-flex col-md-2 d-flex justify-content-md-end">
                        <span
                            class="mx-4 my-2 fw-normal primary-color fs-5 fst-italic d-block">{{ $jd->skema->nama_skema }}</span>
                    </div>
                </div>
                <span class="mx-4 mt-1  fw-bold primary-color fs-5 d-flex align-items-center"><i
                        class="fa-regular fa-message me-3"></i>Komentar</span>
                @forelse ($jd->komentar as $komentar)
                    <div class="card mx-3 my-2 bg-secondary-color rounded-4 mb-3">
                        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-center my-1">
                            <span class="mx-4 mt-2  fw-bold primary-color fs-5 d-flex align-items-center"><i
                                    class="fa-solid fa-graduation-cap me-3"></i>{{ $komentar->user->nama_komentator }}</span>
                            <span class="mx-4 my-1 fw-normal primary-color fs-5"><i class="fa-regular fa-calendar me-1 "></i>
                                {{ $komentar->created_at->diffForHumans() }}</span>

                        </div>
                        <span class="mx-4 my-1 fw-normal primary-color fs-5 fst-italic text-justify">
                            <span
                                class="fw-normal fs-5 fst-italic {{ $komentar->status == 'diterima' ? 'text-success' : ($komentar->status == 'perlu perbaikan' ? 'text-warning' : 'text-danger') }}">{{ ucwords($komentar->status) }}</span>
                            - {{ $komentar->komentar }}</span>
                    </div>
                @empty
                    <div class="card bg-secondary-color h-100 my-3 rounded-4 mx-5">
                        <em class="mx-4 my-4 primary-color fw-bold">Belum komentar</em>
                    </div>
                @endforelse
            </div>
        @empty
            <div class="card bg-third-color h-100 my-3 rounded-4">
                <em class="mx-4 my-4 primary-color fw-bold">Belum ada ide atau judul</em>
            </div>
        @endforelse
    </section>
    </div>
    @include('dashboard.mahasiswa.modalkelompok.judulmodal')
    @include('dashboard.mahasiswa.modalkelompok.editjudul')
    @include('dashboard.mahasiswa.modalkelompok.filemodal')
    <!-- Form Untuk Delete -->
    <form id="delete-form" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
    <form id="delete-dospem-form" method="POST" style="display: none;">
        @csrf
        @method('PATCH')
    </form>

    <!-- Popover script -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll(".popover-button").forEach(function (btn) {
                const id = btn.getAttribute("data-id");
                const popoverContent = document.querySelector("#popover-content-" + id);

                const popover = new bootstrap.Popover(btn, {
                    html: true,
                    sanitize: false,
                    content: function () {
                        return popoverContent.innerHTML;
                    },
                    placement: "left"
                });

                // Tutup popover jika klik di luar
                document.addEventListener("click", function (event) {
                    if (!btn.contains(event.target) && !popoverContent.contains(event.target)) {
                        popover.hide();
                    }
                });
            });
        });
    </script>
    <script>
        function confirmDeleteJudul(url) {
            Swal.fire({
                title: 'Anda Yakin ingin menghapus judul?',
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
    <script>
        function confirmDeleteAnggota(nama, url) {
            Swal.fire({
                title: `Anda Yakin ingin menghapus mahasiswa ${nama} dari kelompok?`,
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
    <script>
        function confirmDeleteDosen(nama, url) {
            Swal.fire({
                title: `Anda Yakin ingin menghapus dosen ${nama} dari Dosen Pembimbing?`,
                text: "Anda tidak akan dapat mengembalikan ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Buat form dinamis
                    let form = document.getElementById("delete-dospem-form");
                    form.action = url;
                    form.submit();
                }
            });
        }
    </script>
@endsection
