@extends('auth.authAsset')
@section('title', 'Register')
@section('content')
    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card shadow-lg" style="border-radius: 1rem; ">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-6 d-flex flex-column">
                                <a class="small text-muted d-flex justify-content-start align-items-center m-4 fs-5"
                                   style="text-decoration: none" href="{{ route('halamanRegister') }}">
                                    <i class="fa-solid fa-arrow-left me-2"></i>Back
                                </a>

                                <!-- Centered content container -->
                                <div class="d-flex flex-column align-items-center justify-content-center flex-grow-1 text-center px-4 py-3">
                                    <i class="fa-solid fa-envelope-open-text pb-4 primary-color" style="font-size: 5rem"></i>

                                    <span class="text-secondary mx-4 mb-3">
                                        Verifikasi email sudah terkirim kedalam email {{ $email }} Silahkan lakukan
                                        verifikasi email untuk melanjutkan registrasi
                                    </span>

                                    <p class="third-color pt-4" style="color: #393f81;">
                                        Belum menerima email?
                                    </p>

                                    <form id="resend-form" action="{{ route('resend.verification') }}" method="POST" style="display: none;">
                                        @csrf
                                        <input type="hidden" name="email" value="{{ $email }}">
                                    </form>

                                    <a href="#" id="resend-link"
                                       onclick="document.getElementById('resend-form').submit();"
                                       class="text-secondary"
                                       style="color: grey;">
                                        Kirim ulang
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 d-flex align-items-center d-none d-md-block">
                                <img src="{{ config('app.base_url') . 'login/' . 'pkm.jpg' ?? 'https://place-hold.it/700x600' }}"
                                    alt="login form" class="img-fluid w-auto h-100"
                                    style="border-radius: 0 1rem 1rem 0; object-fit: cover; object-position: center" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
