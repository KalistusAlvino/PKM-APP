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

    <div class="row">
        @forelse ($mahasiswa as $mhs)
            <div class="col-12 col-lg-6">
                <div class="card my-2">
                    <div class="card-header bg-primary-color">
                        <div class="d-flex flex-column mx-4 my-2 gap-3">
                            <span class="fw-bold secondary-color fs-5">{{ $mhs->name }} -
                                {{ $mhs->user->username }}</span>
                            <span class="secondary-color fs-5">{{ $mhs->prodi }}</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mx-4 my-2">
                            <span class="fw-bold primary-color fs-5">Whatsapp Number <i class="fa-brands fa-whatsapp"></i> :
                            </span>
                            <div class="d-flex flex-row gap-2">
                                <div class="card my-2 rounded-4 bg-primary-color">
                                    <span class="my-2 mx-2 secondary-color">{{ $mhs->no_wa }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="text" value="{{ $mhs['username'] }}" name="username" hidden>
                    <div class="card-footer bg-primary-color d-flex justify-content-center">
                        <button type="button" class="btn bg-secondary-color mx-4 my-2" data-bs-toggle="modal"
                            data-bs-target="#ganti-password-mhs" data-id="{{ $mhs->user->username }}"
                            data-name="{{ $mhs->name }}">
                            <i class="fa-solid fa-user-lock primary-color"></i> <span class="primary-color"> Ganti
                                password</span>
                        </button>
                        <button type="button" onclick="confirmDelete('{{ $mhs->name }}','{{ route('biro.delete-account', $mhs->userId) }}')"
                            class="btn bg-secondary-color mx-4 my-2">
                            <i class="fa-solid fa-trash-can primary-color"></i> Delete akun
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="card bg-third-color my-3 mx-1">
                <span class="primary-color fw-bold mx-2 my-2 fst-italic">Belum ada atau tidak ada
                    Mahasiswa</span>
            </div>
        @endforelse
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
