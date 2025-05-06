@extends('dashboard.assets.main')
@section('title', 'Detail Kelompok')
@section('content')
    <nav aria-label="breadcrumb" class="mx-2 my-2">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('koordinator.dashboard') }}"><span
                        class="primary-color">Dashboard</span></a></li>
            <li class="breadcrumb-item"><a href="{{ route('biro.daftar-kelompok-page') }}"><span class="primary-color">Daftar
                        Kelompok</span></a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail Kelompok</li>
        </ol>
    </nav>
    <div class="d-flex flex-column">
        <section id="kelompok">
            <div class="row">
                <div class="col-12 d-flex justify-content-between">
                    <h3 class="fw-bold primary-color mx-2 my-2">Detail Kelompok</h3>
                    <button type="button" class="btn bg-danger my-2"
                        onclick="confirmDeleteKelompok('{{ route('biro.delete-kelompok', $informasiKelompok['id_kelompok']) }}')">
                        <i class="fa-solid fa-trash-can secondary-color me-2"></i> <span class="secondary-color"> Delete
                            Kelompok
                        </span>
                    </button>
                </div>
            </div>
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
                                <div class="d-flex">
                                    <div class="card ms-5 my-2 bg-secondary-color flex-grow-1">
                                        <span class="mx-2 my-2 primary-color fw-normal"><i
                                                class="ms-2 fa-regular fa-user me-3"></i>{{ $anggota['nama'] }}
                                            ({{ $anggota['username'] }})
                                        </span>
                                    </div>
                                    <button class="btn bg-primary-color tes me-4 ms-3 my-2"
                                        onclick="confirmUpdateKetua('{{ $anggota['nama'] }}','{{ route('biro.ganti-ketua-kelompok', [$anggota['id_kelompok'], $anggota['id_mk']]) }}')">
                                        <i class="fa-solid fa-web-awesome secondary-color"></i>
                                    </button>

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
                            @if ($hasDospem)
                                <div class="card mx-5 my-2 bg-secondary-color flex-grow-1">
                                    <span class="mx-2 my-2 primary-color fw-normal ">
                                        <i
                                            class="ms-2 fa-regular fa-user me-3"></i>{{ $informasiKelompok['dosen'] }}</span>
                                </div>
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
        </section>
        <section id="judul">
            <h3 class="fw-bold primary-color mx-2 my-2 pt-3">Pengajuan Ide</h3>
            @forelse ($judul as $item)
                <div class="card bg-primary-color h-100 my-3 rounded-4">
                    <div class="card-body p-1">
                        <div class="row">
                            <div class="col-12 order-2 order-md-1">
                                <span class="my-2 mx-3 fw-normal secondary-color fs-5 text-justify d-block">
                                    {{ $item->detail_judul }}
                                    @if ($item->updated_at != $item->created_at && $item->updated_at->diffInHours(now()) <= 24)
                                        <span class="badge bg-primary ms-2">Diperbarui</span>
                                    @else
                                        <span class="badge bg-primary ms-2">Usulan Baru</span>
                                    @endif
                                    @foreach ($item->komentar as $km)
                                        @if ($km->user && $km->user->isMahasiswa && $km->created_at->diffInHours(now()) <= 24)
                                            <span class="badge bg-success ms-2">Komentar Baru</span>
                                            @break
                                        @endif
                                    @endforeach
                                </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex justify-content-start mx-3 mb-2 secondary-color gap-4">
                                    <div class="skema d-flex gap-2 align-items-center">
                                        <i class="fa-solid fa-book fst-italic"></i><span
                                            class="fw-normal fst-italic d-block">{{ $item->skema->nama_skema }}</span>
                                    </div>
                                    <div class="user d-flex gap-2 align-items-center">
                                        <i class="fa-regular fa-user fst-italic"></i>
                                        {{ $item->user->getNamaUserAttribute() }}</span>
                                    </div>
                                    <div class="tanggal align-items-center">
                                        <span class="fst-italic">{{ $item->created_at->format('d M Y') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer mx-1 d-flex justify-content-between">
                        @if ($item->Komentar->count() > 0)
                            <span class="secondary-color">{{ $item->komentar->count() }} Komentar</span>
                            <a data-bs-toggle="collapse" href="#collapseExample{{ $item->id }}" role="button"
                                aria-expanded="false" aria-controls="collapseExample{{ $item->id }}">
                                <i class="fa-solid fa-square-caret-down secondary-color"></i>
                            </a>
                        @else
                            <span class="secondary-color">{{ $item->komentar->count() }} Komentar</span>
                            <a data-bs-toggle="collapse" href="#collapseExample{{ $item->id }}" role="button"
                                aria-expanded="false" aria-controls="collapseExample{{ $item->id }}">
                                <i class="fa-solid fa-square-caret-down secondary-color"></i>
                            </a>
                        @endif
                    </div>
                    <div class="collapse mx-3 mb-2" id="collapseExample{{ $item->id }}">
                        @forelse ($item->komentar->sortBy('created_at') as $km)
                            <div
                                class="card card-body p-2 mb-3 {{ $km->user->isDosenOrKoordinator ? 'bg-white' : 'bg-secondary' }}">
                                <div class="d-flex flex-column flex-md-row justify-content-between">
                                    <span
                                        class="{{ $km->user->isDosenOrKoordinator ? 'primary-color' : 'text-white' }} fw-bold">{{ $km->user->getNamaUserAttribute() }}</span>
                                    <div class="commentar flex-inline gap-2 align-items-center">
                                        <span
                                            class="{{ $km->user->isDosenOrKoordinator ? 'primary-color' : 'text-white' }}">{{ $km->created_at->format('d M Y') }}</span>
                                    </div>
                                </div>
                                <span
                                    class="{{ $km->user->isDosenOrKoordinator ? 'primary-color' : 'text-white' }} pt-1 text-justify">
                                    {{ $km->komentar }}
                                </span>
                            </div>
                        @empty
                            <div class="card card-body p-2">
                                <span
                                    class="primary-color d-flex align-items-center justify-content-center fst-italic">Belum
                                    ada komentar
                                    untuk usulan ide ini</span>
                            </div>
                        @endforelse
                    </div>
                </div>
            @empty
                <div class="card bg-primary-color h-100 my-3 rounded-4">
                    <div class="card-body p-1">
                        <div class="row">
                            <div class="col-12 col-md-11">
                                <span
                                    class="my-2 mx-3 fw-normal secondary-color fs-5 text-justify d-block fst-italic">Belum
                                    ada usulan
                                    ide
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforelse
        </section>
    </div>
    <!-- Form Untuk Delete -->
    <form id="delete-form" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
    <form id="update-form" method="POST" style="display: none;">
        @csrf
        @method('PATCH')
    </form>
    <script>
        function confirmDeleteKelompok(url) {
            Swal.fire({
                title: 'Anda Yakin ingin menghapus kelompok?',
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
        function confirmUpdateKetua(nama, url) {
            Swal.fire({
                title: `Anda Yakin ingin menjadikan mahasiswa ${nama} sebagai ketua?`,
                text: "Anda tidak akan dapat mengembalikan ini!",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3b564d',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, ganti!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Buat form dinamis
                    let form = document.getElementById("update-form");
                    form.action = url;
                    form.submit(); // Kirim form dengan method PATCH
                }
            });
        }
    </script>
@endsection
