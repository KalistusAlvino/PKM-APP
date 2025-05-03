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

        <div class="row mx-1">
            @forelse ($mahasiswa as $mhs)
                <div class="col-12 col-lg-6">
                    <form id="form-{{ $mhs['username'] }}" action="{{ route('storeOldAnggota', $id_kelompok) }}"
                        method="POST">
                        @csrf
                        <div class="card my-2">
                            <div class="card-header bg-primary-color">
                                <div class="d-flex flex-column mx-4 my-2 gap-3">
                                    <span class="fw-bold secondary-color fs-5">{{ $mhs['nama'] }} -
                                        {{ $mhs['username'] }}</span>
                                    <span class="secondary-color fs-5">{{ $mhs['prodi'] }}</span>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="mx-4 my-2">
                                    <span class="fw-bold primary-color fs-5">Whatsapp Number <i
                                            class="fa-brands fa-whatsapp"></i> :
                                    </span>
                                    <div class="d-flex flex-row gap-2">
                                        <div class="card my-2 rounded-4 bg-primary-color">
                                            <span class="my-2 mx-2 secondary-color">{{ $mhs['no_wa'] }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="text" value="{{ $mhs['username'] }}" name="username" hidden>
                            <div class="card-footer bg-primary-color d-flex justify-content-center">
                                <button type="button"
                                    onclick="confirmAdd('{{ $mhs['username'] }}', '{{ $mhs['nama'] }}')"
                                    class="btn bg-secondary-color mx-4 my-2">
                                    <i class="fa-solid fa-user-plus primary-color"></i> Tambah
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            @empty
                <div class="card bg-third-color my-3 mx-1">
                    <span class="primary-color fw-bold mx-2 my-2 fst-italic">Belum ada atau tidak ada
                        Mahasiswa</span>
                </div>
            @endforelse
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
