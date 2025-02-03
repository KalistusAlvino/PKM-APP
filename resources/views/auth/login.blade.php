@extends('auth.authAsset')
@section('title', 'Login')
@section('content')
<section class="vh-100">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-10">
                <div class="card shadow-lg" style="border-radius: 1rem;">
                    <div class="row g-0">
                        <div class="col-md-6 col-lg-7 d-none d-md-block">
                            <img src="{{ config('app.base_url') . 'login/' . 'pkm.jpg' ?? 'https://place-hold.it/700x600'}}"
                                alt="login form" class="img-fluid w-100 h-100" style="border-radius: 1rem 0 0 1rem;" />
                        </div>
                        <div class="col-md-6 col-lg-5 d-flex align-items-center">
                            <div class="card-body p-4 p-lg-5 text-black">
                                <form>
                                    <div class="d-flex align-items-center mb-3 pb-1">
                                        <img src="{{ config('app.base_url') . 'landing/' . 'ukdw.png' ?? 'https://place-hold.it/700x600'}}"
                                            alt="loginImage" width="25" height="34" class="me-3">
                                        <span class="h1 fw-bold mb-0 text-success">PKM UKDW</span>
                                    </div>

                                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your
                                        account</h5>

                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <label class="form-label" for="form2Example17">Email address</label>
                                        <input type="email" id="form2Example17" class="form-control custom-input"
                                            placeholder="example: abcd@students.ukdw.ac.id" />

                                    </div>

                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <label class="form-label" for="form2Example27">Password</label>
                                        <input type="password" id="form2Example27" class="form-control" />

                                    </div>

                                    <div class="pt-1 mb-4">
                                        <button data-mdb-button-init data-mdb-ripple-init class="btn btn-dark btn-block"
                                            type="button">Login</button>
                                    </div>

                                    <a class="small text-muted" href="#!">Forgot password?</a>
                                    <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a
                                            href="{{route('halamanRegister')}}" style="color: #393f81;">Register here</a>
                                    </p>
                                    <a class="small text-muted d-flex justify-content-end"
                                        href="{{route('halamanHome')}}">Back to home</a>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
