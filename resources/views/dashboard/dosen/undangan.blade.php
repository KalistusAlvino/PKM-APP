@extends('dashboard.assets.main')
@section('title', 'Undangan Mahasiswa')
@section('content')
    <nav aria-label="breadcrumb" class="mx-2 my-2">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dosen.dashboard') }}"><span
                        class="primary-color">Dashboard</span></a></li>
            <li class="breadcrumb-item active" aria-current="page">Undangan Berkelompok</li>
        </ol>
    </nav>
    <div class="card h-25 bg-third-color mb-4 mx-2 my-2">
        <div class="row">
            <div class="col-12 col-md-9 d-flex flex-column">
                <span class="fw-bolder fs-1 mx-4 my-3 primary-color text-center">Undangan Mahasiswa</span>
                <span class=" fs-5 mx-4 mb-4 primary-color text-center">Tolak atau terima ajakan mahasiswa menjadi Dosen
                    Pembimbing</span>
            </div>
            <div class="col-12 col-md-3 d-none d-md-flex align-items-center justify-content-center">
                <img src="{{ config('app.base_url') . 'dashboard/biro/' . 'user-group.png' ?? 'https://place-hold.it/700x600'}}"
                    alt="user-group" width="100" height="100">
            </div>
        </div>
    </div>
    @forelse ($invite as $inv)
        <div class="card mx-2 my-4 bg-third-color">
            <div class="card mx-4 my-4 bg-secondary-color">
                <card class="header d-flex justify-content-center align-items-center bg-secondary-color shadow-lg rounded-3">
                    <i class="fa-regular fa-envelope me-2 fs-4"></i><span
                        class="fw-bold fs-5 primary-color d-none d-md-inline">Undangan Program Kreativitas
                        Mahasiswa</span>
                </card>
                <span class="mx-4 my-3 primary-color fw-bold fs-5">Ketua Tim :</span>
                <div class="row">
                    <div class="col d-flex flex-column mx-4 mb-3">
                        <span class="">Nama</span>
                        <span class="fs-5 primary-color fw-bold">{{ $inv->inviter->name }}</span>
                    </div>
                    <div class="col d-flex flex-column mx-4 mb-3">
                        <span class="">NIM</span>
                        <span class="fs-5 primary-color fw-bold">{{ $inv->inviter->user->username }}</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col d-flex flex-column mx-4 mb-3">
                        <span class="">Fakultas</span>
                        <span class="fs-5 primary-color fw-bold">{{ $inv->inviter->fakultas }}</span>
                    </div>
                    <div class="col d-flex flex-column mx-4 mb-3">
                        <span class="">Program Studi</span>
                        <span class="fs-5 primary-color fw-bold">{{ $inv->inviter->prodi }}</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col d-flex justify-content-center mb-4 gap-2">
                    <button
                        onclick="confirmInvite('{{ $inv->inviter->name }}','{{ route('dosen.terima-undangan', [$inv->kelompokId, $inv->dospemId]) }}')"
                        class="btn bg-primary-color" data-confirm-delete="true">
                        <i class="fa-regular fa-paper-plane secondary-color me-2"></i><span
                            class="secondary-color d-none d-md-inline">Terima Undangan</span>
                    </button>
                    <button onclick="confirmAdd('')" class="btn bg-white border border-danger" data-confirm-delete="true">
                        <i class="fa-regular fa-circle-xmark text-danger me-md-2"></i><span
                            class="text-danger d-none d-md-inline">Tolak Undangan</span>
                    </button>
                </div>
            </div>
        </div>
    @empty
        <div class="card mx-2 my-2 bg-third-color">
            <span class="mx-4 my-4 primary-color fst-italic fw-bold">Belum ada undangan</span>
        </div>
    @endforelse
    <!-- Form Untuk Undang Dosen -->
    <form id="terima-undangan-form" method="POST" style="display: none;">
        @csrf
        @method('PUT')
    </form>
    <script>
        function confirmInvite(namaDosen, url) {
            Swal.fire({
                title: `Anda yakin ingin menerima undangan ${namaDosen}?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3b564d',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Terima'
            }).then((result) => {
                if (result.isConfirmed) {
                    if (result.isConfirmed) {
                        // Buat form dinamis
                        let form = document.getElementById("terima-undangan-form");
                        form.action = url;
                        form.submit(); // Kirim form dengan method DELETE
                    }
                }
            });
        }
    </script>
@endsection
