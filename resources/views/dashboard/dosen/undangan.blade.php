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
                <img src="{{ config('app.base_url') . 'dashboard/biro/' . 'user-group.png' ?? 'https://place-hold.it/700x600' }}"
                    alt="user-group" width="100" height="100">
            </div>
        </div>
    </div>
    <div class="card bg-primary-color rounded-4 mx-2">
        <span class="mx-4 my-3 fw-bold secondary-color fs-3">Daftar Undangan</span>
        <div class="row">
            <div class="col-4">
                <div class="input-group d-flex px-4 py-3">
                    <span class="input-group-text" id="addon-wrapping"><i class="fa-solid fa-magnifying-glass"></i></span>
                    <input type="text" class="form-control" placeholder="Cari berdasarkan nama ketua"
                        aria-describedby="addon-wrapping" name="nama_ketua" required>
                </div>
            </div>
        </div>
        <div class="table-responsive mx-4 my-3">
            <table class="table bg-table-transparent table-borderless align-middle">
                <thead>
                    <tr>
                        <th scope="col" class="secondary-color">NO.</th>
                        <th scope="col" class="secondary-color">NIM</th>
                        <th scope="col" class="secondary-color">Nama Ketua</th>
                        <th scope="col" class="secondary-color">Fakultas</th>
                        <th scope="col" class="secondary-color">Prodi</th>
                        <th scope="col" class="secondary-color">Status</th>
                        <th scope="col" class="secondary-color">Waktu</th>
                        <th scope="col" class="secondary-color d-flex justify-content-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($invite as $idx => $inv)
                        <tr>
                            <td class="secondary-color">{{ $idx + 1 }}</td>
                            <td class="secondary-color">{{ $inv->inviter->user->username }}</td>
                            <td class="secondary-color">{{ $inv->inviter->name }}</td>
                            <td class="secondary-color">{{ $inv->inviter->fakultas }}</td>
                            <td class="secondary-color">{{ $inv->inviter->prodi }}</td>
                            <td
                                class="{{ $inv->status === 'menunggu' ? 'text-warning' : ($inv->status === 'ditolak' ? 'text-danger' : 'text-secondary') }}">
                                {{ ucwords($inv->status) }}
                            </td>
                            <td class="secondary-color">{{ $inv->created_at->diffForHumans() }}</td>
                            <td class="d-flex gap-2 justify-content-end">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#detailUndanganModal" id="detail-undangan"
                                    data-id="{{ $inv->id }}">
                                    <i class="fa-solid fa-circle-info"></i>
                                </button>
                                <button type="button" class="btn btn-success"
                                    onclick="confirmInvite('{{ $inv->inviter->name }}','{{ route('dosen.terima-undangan', [$inv->kelompokId, $inv->dospemId]) }}')"><i
                                        class="fa-solid fa-circle-check"></i></button>
                                <button type="button" class="btn btn-danger"
                                    onclick="confirmTolak('{{ $inv->inviter->name }}','{{ route('dosen.tolak-undangan', $inv->id) }}')"><i
                                        class="fa-solid fa-circle-minus"></i>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="secondary-color">Belum ada kegiatan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @include('dashboard.dosen.modal.detail-undangan')
    <!-- Form Untuk Undang Dosen -->
    <form id="undangan-form" method="POST" style="display: none;">
        @csrf
        @method('PUT')
    </form>
    <script>
        function confirmInvite(nama_ketua, url) {
            Swal.fire({
                title: `Anda yakin ingin menerima undangan ${nama_ketua}?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3b564d',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Terima'
            }).then((result) => {
                if (result.isConfirmed) {
                    if (result.isConfirmed) {
                        // Buat form dinamis
                        let form = document.getElementById("undangan-form");
                        form.action = url;
                        form.submit(); // Kirim form dengan method DELETE
                    }
                }
            });
        }
    </script>
    <script>
        function confirmTolak(namaKetua, url) {
            Swal.fire({
                title: `Anda yakin ingin menolak undangan ${namaKetua}?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#FF0000',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Tolak'
            }).then((result) => {
                if (result.isConfirmed) {
                    if (result.isConfirmed) {
                        // Buat form dinamis
                        let form = document.getElementById("undangan-form");
                        form.action = url;
                        form.submit(); // Kirim form dengan method DELETE
                    }
                }
            });
        }
    </script>
@endsection
