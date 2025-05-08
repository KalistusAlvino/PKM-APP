@extends('dashboard.assets.main')
@section('title', 'Tambah Dosen')
@section('content')
    <nav aria-label="breadcrumb" class="mx-2 my-2">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('mahasiswa.daftar-kelompok') }}"><span
                        class="primary-color">Kelompok</span></a></li>
            <li class="breadcrumb-item"><a href="{{ route('mahasiswa.detail-kelompok', $id_kelompok) }}"><span
                        class="primary-color">Detail Kelompok</span></a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Dosen Pembimbing</li>
        </ol>
    </nav>
    <div class="card h-25 bg-third-color mb-4 mx-2 my-2">
        <div class="row">
            <div class="col-12 col-md-9 d-flex flex-column">
                <span class="fw-bolder fs-1 mx-4 my-3 primary-color text-center">Tambah Dosen Pembimbing</span>
                <span class=" fs-5 mx-4 mb-4 primary-color text-center">Invite atau Undang Dosen Pembimbing Kedalam
                    Kelompok</span>
            </div>
            <div class="col-12 col-md-3 d-none d-md-flex align-items-center justify-content-center">
                <img src="{{ config('app.base_url') . 'dashboard/biro/' . 'user-group.png' ?? 'https://place-hold.it/700x600' }}"
                    alt="user-group" width="100" height="100">
            </div>
        </div>
    </div>
    <div class="row mb-2 mx-1">
        <div class="col-12 col-md-6 col-lg-4">
            <form method="POST" action="{{ route('mahasiswa.tambah-dosen-page', $id_kelompok) }}">
                @csrf
                <div class="input-group d-flex">
                    <span class="input-group-text" id="addon-wrapping"><i class="fa-solid fa-magnifying-glass"></i></span>
                    <input type="text" class="form-control" placeholder="Cari berdasarkan nama"
                        aria-describedby="addon-wrapping" name="cari" required>
                </div>
            </form>
        </div>
    </div>
    <div class="row mx-1">
        <div class="table-responsive">
            <table class="table">
                <thead class="bg-primary-color text-white">
                    <tr>
                        <th class="text-center">Nama Dosen</th>
                        <th class="text-center">Program Studi</th>
                        <th class="text-center">Bidang Minat PKM</th>
                        <th class="text-center">Whatsapp Number</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($dospem as $dos)
                        <tr>
                            <td class="text-center">{{ $dos->name }}</td>
                            <td class="text-center">{{ $dos->program_studi }}</td>
                            <td class="text-center">
                                @foreach (explode(',', $dos->ketertarikan) as $ketertarikan)
                                    <div class="badge bg-primary text-white">{{ $ketertarikan }}</div>
                                @endforeach
                            </td>
                            <td class="text-center">{{ $dos->no_wa }}</td>
                            <td class="text-center">
                                <button
                                    onclick="confirmAdd('{{ $dos->name }}','{{ route('storeInvite', [$id_kelompok, $dos->id]) }}')"
                                    class="btn bg-secondary-color" data-confirm-delete="true">
                                    Undang Dosen <i class="fa-solid fa-user-plus primary-color"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center bg-third-color">
                                <span class="primary-color fw-bold fst-italic">Belum ada atau tidak ada dosen</span>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>




    <form id="post-undangan-form" method="POST" style="display: none;">
        @csrf
        @method('POST')
    </form>
    <script>
        function confirmAdd(namaDosen, url) {
            Swal.fire({
                title: `Anda yakin ingin melakukan invite untuk dosen ${namaDosen}?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3b564d',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Undang'
            }).then((result) => {
                if (result.isConfirmed) {
                    if (result.isConfirmed) {
                        // Buat form dinamis
                        let form = document.getElementById("post-undangan-form");
                        form.action = url;
                        form.submit(); // Kirim form dengan method POST
                    }
                }
            });
        }
    </script>
@endsection
