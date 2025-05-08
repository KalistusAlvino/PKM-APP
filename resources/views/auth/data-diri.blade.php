@extends('auth.authAsset')
@section('title', 'Register')
@section('content')
    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card shadow-lg" style="border-radius: 1rem; ">
                        <div class="row g-0">
                            <div class="col-12">
                                <div class="card-body p-4  p-lg-5 text-black">
                                    <a class="small text-muted d-flex justify-content-start pb-5 align-items-center fs-5"
                                        style="text-decoration: none" href="{{ route('resend.verification') }}"><i
                                            class="fa-solid fa-arrow-left me-2"></i>Back</a>
                                    <form action="{{ route('storeMahasiswa') }}" method="post">
                                        @csrf
                                        <div class="w-100 text-center fw-semibold fs-3">
                                            <span class="text-secondary">
                                                Terimakasih sudah melakukan verifikasi email!
                                            </span>
                                        </div>
                                        <input type="hidden" name="token" value="{{ $mahasiswa->email_verification_token }}">
                                        <div class="row mt-5">
                                            <div class="col-6">
                                                <div data-mdb-input-init class="form-outline mb-4">
                                                    <label class="form-label" for="nimForm">NIM</label>
                                                    <input type="text" id="nimForm" name="username"
                                                        class="form-control custom-input" placeholder="example: 722104**"
                                                        inputmode="numeric"
                                                        oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                        minlength="8" required />
                                                    <input type="text" id="role" name="role" value="mahasiswa"
                                                        hidden />
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div data-mdb-input-init class="form-outline mb-4">
                                                    <label class="form-label" for="waForm">Whatsapp</label>
                                                    <input type="text" id="waForm" name="no_wa"
                                                        class="form-control custom-input"
                                                        placeholder="example: 0822********" inputmode="numeric"
                                                        oninput="this.value = this.value.replace(/[^0-9]/g, '')" required />

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div data-mdb-input-init class="form-outline mb-4">
                                                    <label class="form-label" for="fakultas">Fakultas</label>
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="fakultas" name="fakultas" required>
                                                        <option selected value="">Pilih Fakultas</option>
                                                        @foreach ($fakultas as $f)
                                                            <option value="{{ $f->nama_fakultas }}"
                                                                data-id="{{ $f->id }}">
                                                                {{ $f->nama_fakultas }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div data-mdb-input-init class="form-outline mb-4">
                                                    <label class="form-label" for="program_studi">Program Studi</label>
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="program_studi" name="prodi" disabled required>
                                                        <option selected class="text-secondary">Pilih Prodi</option>
                                                    </select>

                                                </div>
                                            </div>
                                        </div>
                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <label class="form-label" for="nameForm">Name</label>
                                            <input type="text" id="nameForm" name="name"
                                                class="form-control custom-input" placeholder="example: Chris Jhon"
                                                required />
                                        </div>


                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <label class="form-label" for="form2Example27">Password</label>
                                            <input type="password" id="form2Example27" class="form-control" name="password"
                                                required />

                                        </div>

                                        <div class="pt-1 mb-4">
                                            <button data-mdb-button-init data-mdb-ripple-init
                                                class="btn bg-third-color w-100" type="submit">
                                                <p class="m-0 primary-color">Register</p>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
@endsection
