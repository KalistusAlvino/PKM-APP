@extends('dashboard.assets.main')
@section('title', 'Biro - Manajemen Akademik')
@section('content')
    <nav aria-label="breadcrumb" class="mx-2 my-2">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('biro.dashboard') }}"><span
                        class="primary-color">Dashboard</span></a></li>
            <li class="breadcrumb-item active" aria-current="page">Manajemen Akademik</li>
        </ol>
    </nav>
    <div class="row my-4">
        <div class="col-12 col-lg-6 d-flex flex-column justify-content-center align-items-center order-2 order-lg-1">
            <div class="ukdw flex-column justify-content-center align-items-center d-none d-lg-flex">
                <img src="{{ config('app.base_url') . 'dashboard/biro/' . 'akademik.png' ?? 'https://place-hold.it/700x600' }}"
                    alt="Bootstrap" width="300" height="300">
                <span class="primary-color fw-bold fs-3 mt-3">KELOLA KONTEN</span>
                <span class="primary-color fw-bold fs-3">AKADEMIK</span>
            </div>

        </div>
        <div class="col-12 col-lg-6 d-flex flex-column justify-content-center align-items-center order-2 order-lg-1">
            <div class="card bg-primary-color h-100 w-100 rounded-4">
                <div class="d-flex flex-inline justify-content-between">
                    <span class="mx-4 my-2 fw-bold secondary-color fs-3">SKEMA PKM</span>
                    <button type="button" class="btn bg-secondary-color mx-4 my-2" data-bs-toggle="modal"
                        data-bs-target="#tambahSkemaModal"><i class="fa-solid fa-circle-plus me-0 me-lg-2"></i><span
                            class="d-none d-lg-inline">Tambah</span></button>
                </div>
                <div class="table-responsive mx-4 my-2">
                    <table class="table bg-table-transparent table-borderless">
                        <thead>
                            <tr>
                                <th scope="col" class="secondary-color" style="width: 10%">#</th>
                                <th scope="col" class="secondary-color" style="width: 80%">Nama Skema</th>
                                <th scope="col" class="secondary-color" style="width: 10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($skema as $idx => $s)
                                <tr>
                                    <th scope="row" class="secondary-color">{{ $idx + 1 }}</th>
                                    <td class="secondary-color">{{ $s->nama_skema }}</td>
                                    <td class="secondary-color d-flex flex-inline gap-2">
                                        <button type="button" class="btn btn-primary" id="editSkema" data-bs-toggle="modal"
                                            data-bs-target="#editSkemaModal" data-id="{{ $s->id }}"><i
                                                class="fa-solid fa-pen-to-square"></i></button>
                                        <button type="button" class="btn btn-danger" onclick="confirmDelete(this)"
                                            data-url="{{ route('biro.manajemen-akademik-delete-skema', $s->id) }}"
                                            data-nama="{{ $s->nama_skema }}" data-tabel="SKEMA PKM"><i
                                                class="fa-solid fa-trash-can"></i></button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">Belum ada data skema</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row my-4">
        <div class="col-12 col-lg-5 d-flex flex-column justify-content-center align-items-center">
            <div class="card bg-primary-color h-100 w-100 rounded-4">
                <div class="d-flex flex-inline justify-content-between">
                    <span class="mx-4 my-2 fw-bold secondary-color fs-3">FAKULTAS</span>
                    <button type="button" class="btn bg-secondary-color mx-4 my-2" data-bs-toggle="modal"
                        data-bs-target="#tambahFakultasModal"><i class="fa-solid fa-circle-plus me-0 me-lg-2"></i><span
                            class="d-none d-lg-inline">Tambah</span></button>
                </div>
                <div class="table-responsive mx-4 my-2">
                    <table class="table bg-table-transparent table-borderless">
                        <thead>
                            <tr>
                                <th scope="col" class="secondary-color" style="width: 10%">#</th>
                                <th scope="col" class="secondary-color" style="width: 80%">Nama Fakultas</th>
                                <th scope="col" class="secondary-color" style="width: 10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($fakultas as $idx => $f)
                                <tr>
                                    <th scope="row" class="secondary-color">{{ $idx + 1 }}</th>
                                    <td class="secondary-color">{{ $f->nama_fakultas }}</td>
                                    <td class="secondary-color d-flex flex-inline gap-2">
                                        <button type="button" class="btn btn-primary" id="editFakultas" data-bs-toggle="modal"
                                            data-bs-target="#editFakultasModal" data-id="{{ $f->id }}"><i
                                                class="fa-solid fa-pen-to-square"></i></button>
                                        <button type="button" class="btn btn-danger" onclick="confirmDelete(this)"
                                            data-url="{{ route('biro.manajemen-akademik-delete-fakultas', $f->id) }}"
                                            data-nama="{{ $f->nama_fakultas }}" data-tabel="FAKULTAS"><i
                                                class="fa-solid fa-trash-can"></i></button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">Belum ada data Fakultas</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-7 d-flex justify-content-center align-items-center pt-3 pt-lg-0">
            <div class="card bg-primary-color h-100 w-100 rounded-4">
                <div class="d-flex flex-inline justify-content-between">
                    <span class="mx-4 my-2 fw-bold secondary-color fs-3">PROGRAM STUDI</span>
                    <button type="button" class="btn bg-secondary-color mx-4 my-2" data-bs-toggle="modal"
                        data-bs-target="#tambahProdiModal"><i class="fa-solid fa-circle-plus me-0 me-lg-2"></i><span
                            class="d-none d-lg-inline">Tambah</span></button>
                </div>
                <div class="table-responsive mx-4 my-2">
                    <table class="table bg-table-transparent table-borderless">
                        <thead>
                            <tr>
                                <th scope="col" class="secondary-color" style="width: 10%">#</th>
                                <th scope="col" class="secondary-color" style="width: 40%">Nama Fakultas</th>
                                <th scope="col" class="secondary-color" style="width: 40%">Nama Prodi</th>
                                <th scope="col" class="secondary-color" style="width: 10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($prodi as $idx => $p)
                                <tr>
                                    <th scope="row" class="secondary-color">{{ $idx + 1 }}</th>
                                    <td class="secondary-color">{{ $p->fakultas->nama_fakultas }}</td>
                                    <td class="secondary-color">{{ $p->nama_prodi }}</td>
                                    <td class="secondary-color d-flex flex-inline gap-2">
                                        <button type="button" class="btn btn-primary" id="editProdi" data-bs-toggle="modal"
                                            data-bs-target="#editProdiModal" data-id="{{ $p->id }}"><i
                                                class="fa-solid fa-pen-to-square"></i></button>
                                        <button type="button" class="btn btn-danger" onclick="confirmDelete(this)"
                                            data-url="{{ route('biro.manajemen-akademik-delete-prodi', $p->id) }}"
                                            data-nama="{{ $p->nama_prodi }}" data-tabel="PROGRAM STUDI"><i
                                                class="fa-solid fa-trash-can"></i></button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">Belum ada data prodi</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('dashboard.biro.akademik-pengembangan.modal.tambah-skema')
    @include('dashboard.biro.akademik-pengembangan.modal.tambah-fakultas')
    @include('dashboard.biro.akademik-pengembangan.modal.tambah-prodi')
    @include('dashboard.biro.akademik-pengembangan.modal.edit-skema')
    @include('dashboard.biro.akademik-pengembangan.modal.edit-fakultas')
    @include('dashboard.biro.akademik-pengembangan.modal.edit-prodi')

    <form id="delete-akademik-form" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
    <script>
        function confirmDelete(button) {
            const url = button.getAttribute('data-url');
            const namaData = button.getAttribute('data-nama');
            const namaTable = button.getAttribute('data-tabel');
            Swal.fire({
                title: `Anda yakin ingin melakukan hapus ${namaData} dari ${namaTable}?`,
                text: "Anda tidak akan dapat mengembalikan ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete!'
            }).then((result) => {
                if (result.isConfirmed) {
                    if (result.isConfirmed) {
                        // Buat form dinamis
                        let form = document.getElementById("delete-akademik-form");
                        form.action = url;
                        form.submit(); // Kirim form dengan method POST
                    }
                }
            });
        }
    </script>
@endsection
