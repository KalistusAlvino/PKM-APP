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
                <img src="{{ config('app.base_url') . 'dashboard/biro/' . 'user-group.png' ?? 'https://place-hold.it/700x600'}}"
                    alt="user-group" width="100" height="100">
            </div>
        </div>
    </div>
    @php
        $lessThan = is_countable($informasiKelompok['anggota'] ?? []) && count($informasiKelompok['anggota']) < 4;
        $totalAnggota = count($informasiKelompok['anggota']);
    @endphp
    @if (!$lessThan)
        <div class="card mx-2 my-2 bg-third-color">
            <span class="mx-2 my-2 fst-italic primary-color fw-bold">Total anggota sudah memenuhi kapasitas</span>
        </div>
    @else
        <div class="card mx-2 my-2 bg-third-color">
            <ul class="nav nav-tabs mx-2 my-2 d-flex justify-content-center" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane"
                        type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true"><span
                            class="primary-color fw-bold">Cari Anggota</span></button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane"
                        type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false"><span
                            class="primary-color fw-bold">Buat Akun Anggota</span></button>
                </li>
            </ul>
            <div class="tab-content mx-4 my-4" id="myTabContent">
                <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab"
                    tabindex="0">
                    <form action="{{route('storeOldAnggota', $id_kelompok)}}" method="POST">
                        @csrf
                        <div id="selectedMahasiswaList" class="mb-3">
                            <!-- Mahasiswa yang dipilih akan ditampilkan di sini -->
                        </div>
                        <input type="hidden" id="selectedMahasiswaInput" name="selectedMahasiswa">
                        <div class="table-responsive mx-3 my-3">
                            <table class="table table-borderless bg-table-third-color">
                                <thead>
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">NIM</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Prodi</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($mahasiswa as $idx => $mhs)
                                        <tr id="mhs-{{ $mhs['username'] }}" class="align-items-center">
                                            <th scope="row" class="align-middle">{{ $mahasiswa->firstItem() + $idx }}</th>
                                            <td class="align-middle">{{ $mhs['username'] }}</td>
                                            <td class="align-middle">{{ $mhs['nama'] }}</td>
                                            <td class="align-middle">{{ $mhs['prodi'] }}</td>
                                            <td class="align-middle"><button type="button"
                                                    class="btn bg-primary-color mx-2 my-2 flex-fill"
                                                    onclick="tambahMahasiswa('{{ $mhs['nama'] }}', '{{ $mhs['username'] }}')">
                                                    <i class="fa-solid fa-user-plus secondary-color"></i>
                                                </button></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td> <em>Tidak ada mahasiswa yang tersedia</em></td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="links d-flex justify-content-end mx-4 my-4">
                                {{ $mahasiswa->links() }}
                            </div>

                        </div>
                        <div class="row mx-1 my-1">
                            <button id="tambahButton" type="submit" class="btn bg-primary-color" disabled><span
                                    class="secondary-color"><i class="fa-solid fa-user-plus me-2"></i>Tambah
                                    Anggota</span></button>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                    <form action="{{route('storeAnggota', $id_kelompok)}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div data-mdb-input-init class="form-outline mb-4">
                                    <label class="form-label primary-color" for="nimForm">NIM</label>
                                    <input type="text" id="nimForm" name="username" class="form-control custom-input"
                                        placeholder="example: 722104**" inputmode="numeric"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '')" required />
                                    <input type="text" id="role" name="role" value="mahasiswa" hidden />
                                </div>
                            </div>
                            <div class="col-6">
                                <div data-mdb-input-init class="form-outline mb-4">
                                    <label class="form-label primary-color" for="waForm">Whatsapp</label>
                                    <input type="text" id="waForm" name="no_wa" class="form-control custom-input"
                                        placeholder="example: 0822********" inputmode="numeric"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '')" required />

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div data-mdb-input-init class="form-outline mb-4">
                                    <label class="form-label primary-color" for="fakultas">Fakultas</label>
                                    <select class="form-select" aria-label="Default select example" id="fakultas"
                                        name="fakultas" required>
                                        <option selected value="">Pilih Fakultas</option>
                                        @foreach ($fakultas as $f)
                                            <option value="{{ $f->nama_fakultas }}" data-id="{{ $f->id }}">
                                                {{ $f->nama_fakultas }}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                            <div class="col-6">
                                <div data-mdb-input-init class="form-outline mb-4">
                                    <label class="form-label primary-color" for="program_studi">Program Studi</label>
                                    <select class="form-select" aria-label="Default select example" id="program_studi"
                                        name="prodi" disabled required>
                                        <option selected class="text-secondary">Pilih Prodi</option>
                                    </select>

                                </div>
                            </div>
                        </div>

                        <div data-mdb-input-init class="form-outline mb-4">
                            <label class="form-label primary-color" for="form2Example17">Email address</label>
                            <input type="email" id="form2Example17" name="email" class="form-control custom-input"
                                placeholder="example: abcd@students.ukdw.ac.id" required />

                        </div>
                        <div data-mdb-input-init class="form-outline mb-4">
                            <label class="form-label primary-color" for="nameForm">Name</label>
                            <input type="text" id="nameForm" name="name" class="form-control custom-input"
                                placeholder="example: Chris Jhon" required />
                        </div>
                        <div class="row mx-1 my-1">
                            <button type="submit" class="btn bg-primary-color"><span class="secondary-color"><i
                                        class="fa-solid fa-user-plus me-2"></i>Tambah Anggota</span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif


    <script>
        $(document).ready(function () {
            $('#fakultas').change(function () {
                var fakultasId = $(this).find(':selected').data('id');
                if (fakultasId) {
                    $.ajax({
                        url: '/get-program-studi/' + fakultasId,
                        type: 'GET',
                        success: function (data) {
                            $('#program_studi').empty();
                            $('#program_studi').prop('disabled', false);
                            $('#program_studi').append('<option value="">Pilih Prodi</option>');
                            $.each(data, function (key, value) {
                                $('#program_studi').append('<option value="' + value.nama_prodi + '">' + value.nama_prodi + '</option>');
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
        let selectedMahasiswa = [];
        let totalAnggota = {{ $totalAnggota }};

        function tambahMahasiswa(nama, username) {
            let exists = selectedMahasiswa.some(mhs => mhs.username === username);
            if (exists) {
                alert("Mahasiswa sudah ditambahkan!");
                return;
            }
            let maxAllowed = 4 - totalAnggota;
            if (selectedMahasiswa.length >= maxAllowed) {
                alert(`Maksimal ${maxAllowed} mahasiswa dapat ditambahkan!`);
                return;
            }

            selectedMahasiswa.push({ nama, username });
            document.getElementById(`mhs-${username}`).style.display = "none";

            renderSelectedMahasiswa();
        }

        function hapusMahasiswa(username) {
            selectedMahasiswa = selectedMahasiswa.filter(mhs => mhs.username !== username);

            document.getElementById(`mhs-${username}`).style.display = "table-row";

            renderSelectedMahasiswa();
        }

        function renderSelectedMahasiswa() {
            let listContainer = document.getElementById("selectedMahasiswaList");
            let hiddenInput = document.getElementById("selectedMahasiswaInput");
            let tambahButton = document.getElementById("tambahButton");

            // Kosongkan list
            listContainer.innerHTML = "";

            selectedMahasiswa.forEach((mhs, index) => {
                listContainer.innerHTML += `
                    <div class="card my-2 d-flex flex-row align-items-center p-2 bg-primary-color">
                        <span class="mx-2 my-2 text-white fw-normal flex-grow-1">
                            <i class="ms-2 fa-regular fa-user me-3"></i>
                                ${mhs.username} - ${mhs.nama}
                        </span>
                        <button type="button" class="btn btn-danger mx-2"
                            onclick="hapusMahasiswa('${mhs.username}')">
                                <i class="fa-regular fa-trash-can"></i>
                        </button>
                        </div>
                                                                                    `;
            });
            // Update hidden input untuk dikirim ke backend
            hiddenInput.value = JSON.stringify(selectedMahasiswa);
            console.log('Hidden Input Value', hiddenInput.value);
            tambahButton.disabled = selectedMahasiswa.length === 0;
        }
    </script>

@endsection
