@extends('dashboard.assets.main')
@section('title', 'Account Dosen Management')
@section('content')
    <div class="card h-25 bg-third-color mb-4">
        <div class="row">
            <div class="col-12 col-md-9 d-flex flex-column">
                <span class="fw-bolder fs-1 mx-4 my-3 primary-color text-center">Managemen Akun Dosen</span>
                <span class=" fs-5 mx-4 mb-4 primary-color text-center">Buat, tambah dan edit akun dosen</span>
            </div>
            <div class="col-12 col-md-3 d-none d-md-flex align-items-center justify-content-center">
                <img src="{{ config('app.base_url') . 'dashboard/biro/' . 'user-group.png' ?? 'https://place-hold.it/700x600' }}"
                    alt="user-group" width="100" height="100">
            </div>
        </div>
    </div>

    <div class="card h-25 bg-third-color mb-4">
        <div class="title d-flex justify-content-between align-items-center mx-2 my-4">
            <span class="fw-bold fs-5 mx-4 primary-color text-center">DATA DOSEN</span>
            <button type="button" class="btn bg-primary-color mx-4 my-2" data-bs-toggle="modal"
                data-bs-target="#tambahDosenModal">
                <i class="fa-solid fa-user-plus secondary-color"></i> <span
                    class="secondary-color d-none d-md-inline">Tambah Dosen</span>
            </button>
        </div>
        <div class="table-responsive mx-4 my-1">
            <table class="table bg-table-third-color table-borderless align-middle">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">NIP</th>
                        <th scope="col">Username</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Fakultas</th>
                        <th scope="col">Program Studi</th>
                        <th scope="col">No. Whatsapp</th>
                        <th scope="col" class="d-flex justify-content-end me-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($dosen as $idx => $d)
                        <tr>
                            <th scope="row">{{ $idx + 1 }}</th>
                            <td>{{ $d->nip }}</td>
                            <td>{{ $d->user->username }}</td>
                            <td>{{ $d->name }}</td>
                            <td>{{ $d->fakultas }}</td>
                            <td>{{ $d->program_studi }}</td>
                            <td>{{ $d->no_wa }}</td>
                            <td class="d-flex justify-content-end gap-2 me-3">
                                <a href="{{route('biro.edit-dosen',$d->id)}}" type="button" class="btn bg-primary-color" >
                                    <i class="fa-solid fa-pen-to-square secondary-color"></i>
                                </a>
                                <button type="button" class="btn bg-primary" data-bs-toggle="modal"
                                    data-bs-target="#ganti-password-dosen" data-id="{{ $d->user->username }}"
                                    data-name="{{ $d->name }}">
                                    <i class="fa-solid fa-user-lock secondary-color"></i>
                                </button>
                                </button>
                                <button type="button"
                                    onclick="confirmDelete('{{ $d->name }}','{{ route('biro.delete-account', $d->userId) }}')"
                                    class="btn bg-danger">
                                    <i class="fa-solid fa-trash-can secondary-color"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td> <em>Belum ada data dosen</em></td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @include('dashboard.biro.account.modaldosen.tambah')
    @include('dashboard.biro.account.modaldosen.ganti-password')
    <form id="delete-form" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
    <script>
        function confirmDelete(name, url) {
            Swal.fire({
                title: `Anda Yakin ingin menghapus akun ${name} ?`,
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
