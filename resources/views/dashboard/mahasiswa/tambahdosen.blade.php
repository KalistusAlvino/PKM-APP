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
                <img src="{{ config('app.base_url') . 'dashboard/biro/' . 'user-group.png' ?? 'https://place-hold.it/700x600'}}"
                    alt="user-group" width="100" height="100">
            </div>
        </div>
    </div>
    <div class="card mx-2 my-2 bg-third-color">
        <div class="table-responsive mx-3 my-3">
            <table class="table table-borderless bg-table-third-color">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">NIP</th>
                        <th scope="col">Nama</th>
                        <th scope="col">No. Whatsapp</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($dospem as $idx => $dos)
                        <tr>
                            <th scope="row" class="align-middle">{{ $dospem->firstItem() + $idx }}</th>
                            <td class="align-middle">{{ $dos->nip }}</td>
                            <td class="align-middle">{{ $dos->name }}</td>
                            <td class="align-middle">{{ $dos->no_wa }}</td>
                            <td class="align-middle"> <button
                                    onclick="confirmAdd('{{ $dos->name }}','{{ route('storeInvite', [$id_kelompok, $dos->id]) }}')"
                                    class="btn bg-primary-color" data-confirm-delete="true">
                                    <i class="fa-solid fa-user-plus secondary-color"></i>
                                </button></td>
                        </tr>

                    @empty
                        <tr>
                            <td> <em>Belum ada Dosen Pembimbing yang tersedia</em></td>
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
                        form.submit(); // Kirim form dengan method DELETE
                    }
                }
            });
        }
    </script>
@endsection
