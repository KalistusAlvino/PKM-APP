@extends('dashboard.assets.main')
@section('title', 'Change Password')
@section('content')
    <section class="change-password-mhs">
        <div class="container py-5">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col col-xl-5">
                    <div class="card shadow-lg" style="border-radius: 1rem;">
                        <span class="d-flex justify-content-center fw-bold primary-color my-4 fs-5">Ganti Password</span>
                        <span class="d-flex justify-content-center primary-color">Logged in as :
                            {{ Auth::user()->getNamaUserAttribute() }}</span>
                        <span class="d-flex justify-content-center primary-color mb-4">Role:
                            {{ ucwords(Auth::user()->role) }}</span>
                        <form action="{{route('post-change-password')}}" method="POST">
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
@endsection
