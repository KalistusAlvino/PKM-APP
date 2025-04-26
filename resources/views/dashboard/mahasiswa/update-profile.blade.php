@extends('dashboard.assets.main')
@section('title', 'Update Profile - Mahasiswa')
@section('content')
    <section class="update-profile-mhs">
        <div class="container mt-4">
            <div class="row d-flex justify-content-center">
                <div class="col-12 col-lg-6 my-2">
                    <div class="card shadow-lg" style="border-radius: 1rem;">
                        <span class="d-flex justify-content-center fw-bold primary-color my-4 fs-5">Update Profile</span>
                        <form action="{{ route('mahasiswa.post-update-profile') }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div data-mdb-input-init class="form-outline mb-3 mx-4">
                                <label class="form-label primary-color fw-semibold">Nama Mahasiswa</label>
                                <input class="form-control" type="text" name="name"
                                    value="{{ old('name', $mhs->name) }}" required>
                            </div>
                            <div data-mdb-input-init class="form-outline mb-3 mx-4">
                                <div class="row">
                                    <div class="col-6">
                                        <div data-mdb-input-init class="form-outline">
                                            <label class="form-label" for="fakultas">Fakultas</label>
                                            <select class="form-select" aria-label="Default select example" id="fakultas"
                                                name="fakultas" required>
                                                <option selected value="">Pilih Fakultas</option>
                                                @foreach ($fakultas as $f)
                                                    <option value="{{ $f->nama_fakultas }}" data-id="{{ $f->id }}"
                                                        {{ old('fakultas', $mhs->fakultas) == $f->nama_fakultas ? 'selected' : '' }}>
                                                        {{ $f->nama_fakultas }}
                                                    </option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div data-mdb-input-init class="form-outline">
                                            <label class="form-label" for="program_studi">Program Studi</label>
                                            <select class="form-select" aria-label="Default select example"
                                                id="program_studi" name="prodi" disabled required>
                                                <option selected class="text-secondary">Pilih Prodi</option>
                                            </select>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div data-mdb-input-init class="form-outline mb-3 mx-4">
                                <label class="form-label primary-color fw-semibold">Email</label>
                                <input class="form-control" type="email" name="email" aria-describedby="emailHelp"
                                    value="{{ old('email', $mhs->email) }}" required>
                            </div>
                            <div data-mdb-input-init class="form-outline mb-4 mx-4">
                                <label class="form-label primary-color fw-semibold">Whatsapp Number</label>
                                <input class="form-control" type="text" name="no_wa"
                                    value="{{ old('no_wa', $mhs->no_wa) }}" required>
                            </div>
                            <div data-mdb-input-init class="form-outline mb-4 mx-4">
                                <button type="submit" class="btn bg-primary-color form-control"><span
                                        class="secondary-color">Update Profile</span></button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-12 col-lg-6 my-2">
                    <div class="card shadow-lg" style="border-radius: 1rem;">
                        <span class="d-flex justify-content-center fw-bold primary-color my-4 fs-5">Update Password</span>
                        <span class="d-flex justify-content-center primary-color">Logged in as :
                            {{ Auth::user()->getNamaUserAttribute() }}</span>
                        <span class="d-flex justify-content-center primary-color mb-4">Role:
                            {{ ucwords(Auth::user()->role) }}</span>
                        <form action="{{ route('post-change-password') }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div data-mdb-input-init class="form-outline mb-3 mx-4">
                                <label class="form-label primary-color fw-semibold">Password Saat Ini</label>
                                <input class="form-control" type="password" name="old_password"
                                    placeholder="Masukkan password saat ini" required>
                            </div>
                            <div data-mdb-input-init class="form-outline mb-3 mx-4">
                                <label class="form-label primary-color fw-semibold">Password Baru</label>
                                <input class="form-control" type="password" name="new_password"
                                    placeholder="Masukkan password baru" minlength="8" required>
                            </div>
                            <div data-mdb-input-init class="form-outline mb-4 mx-4">
                                <label class="form-label primary-color fw-semibold">Konfirmasi Password
                                    Baru</label>
                                <input class="form-control" type="password" name="confirm_password"
                                    placeholder="Konfirmasi password baru" minlength="8" required>
                            </div>
                            <div data-mdb-input-init class="form-outline mb-4 mx-4">
                                <button type="submit" class="btn bg-primary-color form-control"><span
                                        class="secondary-color">Ganti Password</span></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function() {
            function loadProdi(fakultasId, selectedProdi = '') {
                $('#program_studi').html('<option disabled selected>⏳ Memuat...</option>');

                $.get('/get-program-studi/' + fakultasId, function(data) {
                    let options = '<option value="">Pilih Prodi</option>';
                    $.each(data, function(_, prodi) {
                        let selected = prodi.nama_prodi === selectedProdi ? 'selected' : '';
                        options +=
                            `<option value="${prodi.nama_prodi}" ${selected}>${prodi.nama_prodi}</option>`;
                    });
                    $('#program_studi').html(options).prop('disabled', false);
                });
            }

            // Saat load awal
            const selectedFakultas = "{{ old('fakultas', $mhs->fakultas ?? '') }}";
            const selectedProdi = "{{ old('prodi', $mhs->prodi ?? '') }}";
            const fakultasIdAwal = $('#fakultas option[value="' + selectedFakultas + '"]').data('id');
            if (fakultasIdAwal) loadProdi(fakultasIdAwal, selectedProdi);

            // Saat user ganti fakultas
            $('#fakultas').change(function() {
                const id = $(this).find(':selected').data('id');
                if (id) loadProdi(id);
            });
        });
    </script>

@endsection
