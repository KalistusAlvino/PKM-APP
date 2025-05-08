@extends('auth.authAsset')
@section('title', 'Register')
@section('content')
    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card shadow-lg" style="border-radius: 1rem; ">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-6">
                                <form action="{{ route('register.email') }}" method="POST">
                                    @csrf
                                    <div class="card-body p-4  p-lg-5 text-black">
                                        <a class="small text-muted d-flex justify-content-start pb-5 align-items-center fs-5"
                                            style="text-decoration: none" href="{{ route('halamanHome') }}"><i
                                                class="fa-solid fa-arrow-left me-2"></i>Home</a>
                                        <div class="text-center mt-5">
                                            <h4 class="primary-color fw-semibold mb-3">Welcome to PKM UKDW</h4>
                                            <span class="text-secondary">Kreativitas tidak mengenal batas. Biarkan
                                                imajinasimu
                                                terbang tinggi dan wujudkan ide-ide brilianmu dalam PKM!</span>
                                        </div>
                                        <div data-mdb-input-init class="form-outline mb-4 mt-5">
                                            <label class="form-label" for="form2Example17">Email address</label>
                                            <input type="email" id="form2Example17" name="email"
                                                class="form-control custom-input"
                                                placeholder="example: abcd@students.ukdw.ac.id" required
                                                pattern="^[a-zA-Z0-9._%+-]+@students\.ukdw\.ac\.id$"
                                                title="Email harus berformat: username@students.ukdw.ac.id" />
                                            <div class="invalid-feedback">Email harus berformat: username@students.ukdw.ac.id</div>
                                        </div>
                                        <div class="mt-1 mb-4 d-flex justify-content-center">
                                            <button data-mdb-button-init data-mdb-ripple-init
                                                class="btn bg-third-color w-100" type="submit">
                                                <p class="m-0 primary-color">Continue</p>
                                            </button>
                                        </div>
                                        <p class="third-color text-center" style="color: #393f81;">Already have an account?
                                        </p>
                                        <a class="third-color d-flex justify-content-center"
                                            href="{{ route('halamanLogin') }}">Login here</a>
                                    </div>
                                </form>
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
