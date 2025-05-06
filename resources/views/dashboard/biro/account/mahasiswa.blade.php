@extends('dashboard.assets.main')
@section('title', 'Account Dosen Management')
@section('content')
    <div class="card h-25 bg-third-color mb-4">
        <div class="row">
            <div class="col-12 col-md-9 d-flex flex-column">
                <span class="fw-bolder fs-1 mx-4 my-3 primary-color text-center">Managemen Akun Mahasiswa</span>
                <span class=" fs-5 mx-4 mb-4 primary-color text-center">Kontrol akun mahasiswa</span>
            </div>
            <div class="col-12 col-md-3 d-none d-md-flex align-items-center justify-content-center">
                <img src="{{ config('app.base_url') . 'dashboard/biro/' . 'user-group.png' ?? 'https://place-hold.it/700x600' }}"
                    alt="user-group" width="100" height="100">
            </div>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-12 col-md-6 my-2">
            <form method="POST" action="">
                @csrf
                <div class="input-group d-flex">
                    <span class="input-group-text" id="addon-wrapping"><i class="fa-solid fa-magnifying-glass"></i></span>
                    <input type="text" class="form-control" placeholder="Cari berdasarkan nim"
                        aria-describedby="addon-wrapping" name="nim" required>
                </div>
            </form>
        </div>
    </div>
    <div class="mx-2 my-2">
        <div class="table-responsive">
            <table class="table table-striped bg-third-color my-3 align-middle text-center">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Prodi</th>
                        <th>Whatsapp Number</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($mahasiswa as $index => $mhs)
                        <tr>
                            <td>{{ $mahasiswa->firstItem() + $index }}</td>
                            <td>{{ $mhs->name }}</td>
                            <td>{{ $mhs->user->username }}</td>
                            <td>{{ $mhs->prodi }}</td>
                            <td>{{ $mhs->no_wa }}</td>
                            <td>
                                <button type="button" class="btn bg-secondary-color mx-1" data-bs-toggle="modal"
                                    data-bs-target="#ganti-password-mhs" data-id="{{ $mhs->user->username }}"
                                    data-name="{{ $mhs->name }}">
                                    <i class="fa-solid fa-user-lock primary-color"></i> Ganti password
                                </button>
                                <button type="button" onclick="confirmDelete('{{ $mhs->name }}','{{ route('biro.delete-account', $mhs->userId) }}')"
                                    class="btn bg-secondary-color mx-1">
                                    <i class="fa-solid fa-trash-can primary-color"></i> Delete akun
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center primary-color fw-bold fst-italic">Belum ada atau tidak ada Mahasiswa</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-4">
            {{ $mahasiswa->links() }}
        </div>
    </div>

    @include('dashboard.biro.account.modalmahasiswa.ganti-password-modal')

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
