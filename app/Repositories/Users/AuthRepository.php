<?php

namespace App\Repositories\Users;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthRepository implements AuthRepositoryInterface
{
    public function login(array $data): ?User
    {
        if (!Auth::attempt(['username' => $data['username'], 'password' => $data['password']])) {
            throw ValidationException::withMessages([
                'username' => ['Username atau Password Salah']
            ]);
        }
        $user = User::where('username', $data['username'])->firstOrFail();
        if ($user->role === 'mahasiswa') {
            $mahasiswa = Mahasiswa::where('userId', $user->id)->firstOrFail();

            if ($mahasiswa->email_verification_at === null) {
                throw ValidationException::withMessages([
                    'email_verification' => ['Mahasiswa belum melakukan verifikasi email.']
                ]);
            }
        }

        return Auth::user();
    }

    public function logout()
    {
        Auth::logout();
    }
}
