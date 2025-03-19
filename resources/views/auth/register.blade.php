@extends('auth.authAsset')
@section('title', 'Register')
@section('content')
    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card shadow-lg" style="border-radius: 1rem; ">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5">
                                <div class="card-body p-4  p-lg-5 text-black">
                                    <form action="{{route('storeMahasiswa')}}" method="post">
                                        @csrf
                                        <div class="d-flex align-items-center mb-3 pb-1">
                                            <img src="{{ config('app.base_url') . 'landing/' . 'ukdw.png' ?? 'https://place-hold.it/700x600'}}"
                                                alt="Bootstrap" width="25" height="34" class="me-3">
                                            <span class="h1 fw-bold mb-0 primary-color">PKM UKDW</span>
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                <div data-mdb-input-init class="form-outline mb-4">
                                                    <label class="form-label" for="nimForm">NIM</label>
                                                    <input type="text" id="nimForm" name="username"
                                                        class="form-control custom-input" placeholder="example: 722104**"
                                                        inputmode="numeric"
                                                        oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                        minlength="8" required />

                                                    <input type="text" id="role" name="role" value="mahasiswa" hidden />

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
                                                            <option value="{{ $f->nama_fakultas }}" data-id="{{ $f->id }}">
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
                                            <label class="form-label" for="form2Example17">Email address</label>
                                            <input type="email" id="form2Example17" name="email"
                                                class="form-control custom-input"
                                                placeholder="example: abcd@students.ukdw.ac.id" required />

                                        </div>
                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <label class="form-label" for="nameForm">Name</label>
                                            <input type="text" id="nameForm" name="name" class="form-control custom-input"
                                                placeholder="example: Chris Jhon" required />
                                        </div>


                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <label class="form-label" for="form2Example27">Password</label>
                                            <input type="password" id="form2Example27" class="form-control" name="password"
                                                required />

                                        </div>

                                        <div class="pt-1 mb-4">
                                            <button data-mdb-button-init data-mdb-ripple-init
                                                class="btn bg-third-color btn-block" type="submit">
                                                <p class="m-0 primary-color">Register</p>
                                            </button>
                                        </div>

                                        <p class="third-color" style="color: #393f81;">Already have an account? <a
                                                class="third-color" href="{{route('halamanLogin')}}">Login here</a>
                                        </p>
                                        <a class="small text-muted d-flex justify-content-end"
                                            href="{{route('halamanHome')}}">Back to home</a>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center d-none d-md-block">
                                <img src="{{ config('app.base_url') . 'login/' . 'pkm.jpg' ?? 'https://place-hold.it/700x600'}}"
                                    alt="login form" class="img-fluid w-100 h-100" style="border-radius: 0 1rem 1rem 0;" />

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
@endsection
