@extends('dashboard.assets.main')
@section('title', 'Tambah Anggota')
@section('content')
    <nav aria-label="breadcrumb" class="mx-2 my-2">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('mahasiswa.daftar-kelompok') }}"><span
                        class="primary-color">Kelompok</span></a></li>
            <li class="breadcrumb-item"><a href="{{ route('mahasiswa.detail-kelompok', $id_kelompok) }}"><span
                        class="primary-color">Detail Kelompok</span></a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Anggota</li>
        </ol>
    </nav>
    <div class="card h-25 bg-third-color mb-4 mx-2 my-2">
        <div class="row">
            <div class="col-12 col-md-9 d-flex flex-column">
                <span class="fw-bolder fs-1 mx-4 my-3 primary-color text-center">Tambah Anggota Kelompok</span>
                <span class=" fs-5 mx-4 mb-4 primary-color text-center">Buat akun untuk anggota atau cari anggota yang sudah
                    terdaftar didalam sistem</span>
            </div>
            <div class="col-12 col-md-3 d-none d-md-flex align-items-center justify-content-center">
                <img src="{{ config('app.base_url') . 'dashboard/biro/' . 'user-group.png' ?? 'https://place-hold.it/700x600' }}"
                    alt="user-group" width="100" height="100">
            </div>
        </div>
    </div>
    @if (!$lessThan)
        <div class="card mx-2 my-2 bg-third-color">
            <span class="mx-2 my-2 fst-italic primary-color fw-bold">Total anggota sudah memenuhi kapasitas</span>
        </div>
    @else
        <div class="row mb-2 mx-1">
            <div class="col-12 col-md-6 my-2">
                <form method="POST" action="{{ route('mahasiswa.tambah-anggota-page', $id_kelompok) }}">
                    @csrf
                    <div class="input-group d-flex">
                        <span class="input-group-text" id="addon-wrapping"><i
                                class="fa-solid fa-magnifying-glass"></i></span>
                        <input type="text" class="form-control" placeholder="Cari berdasarkan nim"
                            aria-describedby="addon-wrapping" name="nim" inputmode="numeric"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                    </div>
                </form>
            </div>
            <div class="col-12 col-md-6 d-flex justify-content-end my-2">
                <button type="button" class="btn bg-primary-color" data-bs-toggle="modal" data-bs-target="#tambah-anggota">
                    <i class="fa-solid fa-user-plus secondary-color me-2"></i> <span class="secondary-color">Buat Akun
                        Anggota</span>
                </button>
            </div>
        </div>
        <div class="table-responsive mx-2">
            <table class="table align-middle text-center">
                <thead>
                    <tr>
                        <th class="bg-primary-color secondary-color">Nama</th>
                        <th class="bg-primary-color secondary-color">Username</th>
                        <th class="bg-primary-color secondary-color">Prodi</th>
                        <th class="bg-primary-color secondary-color">Whatsapp Number</th>
                        <th class="bg-primary-color secondary-color">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($mahasiswa as $mhs)
                        <tr>
                            <td>{{ $mhs->name }}</td>
                            <td>{{ $mhs->user->username ?? null }}</td>
                            <td>{{ $mhs->prodi }}</td>
                            <td>
                                <span class="badge bg-primary-color secondary-color rounded-pill">
                                    {{ $mhs->no_wa }}
                                </span>
                            </td>
                            <td>
                                <form id="form-{{ $mhs->user->username }}" action="{{ route('storeOldAnggota', $id_kelompok) }}"
                                    method="POST">
                                    @csrf
                                    <input type="text" value="{{ $mhs->user->username }}" name="username" hidden>
                                    <button type="button"
                                        onclick="confirmAdd('{{ $mhs->user->username }}', '{{ $mhs->name }}')"
                                        class="btn btn-sm bg-secondary-color">
                                        <i class="fa-solid fa-user-plus primary-color"></i> Tambah
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center bg-third-color">
                                <span class="primary-color fw-bold fst-italic">Belum ada atau tidak ada Mahasiswa</span>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-4">
            {{ $mahasiswa->links() }}
        </div>
    @endif
    @include('dashboard.mahasiswa.modalkelompok.tambah-anggota-modal')
    <script>
        $(document).ready(function() {
            $('#fakultas').change(function() {
                var fakultasId = $(this).find(':selected').data('id');
                if (fakultasId) {
                    $.ajax({
                        url: '/get-program-studi/' + fakultasId,
                        type: 'GET',
                        success: function(data) {
                            $('#program_studi').empty();
                            $('#program_studi').prop('disabled', false);
                            $('#program_studi').append('<option value="">Pilih Prodi</option>');
                            $.each(data, function(key, value) {
                                $('#program_studi').append('<option value="' + value
                                    .nama_prodi + '">' + value.nama_prodi +
                                    '</option>');
                            });
                        }
                    });
                } else {
                    $('#program_studi').empty();
                    $('#program_studi').prop('disabled', true);
                    $('#program_studi').append('<option value="">Pilih Prodi</option>');
                }
            });
        });
    </script>
    <script>
        function confirmAdd(username, nama) {
            Swal.fire({
                title: `Tambah anggota ${nama}?`,
                text: "Pastikan data sudah benar sebelum menambahkan.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#aaa',
                confirmButtonText: 'Ya, Tambahkan',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`form-${username}`).submit();
                }
            });
        }
    </script>
@endsection
