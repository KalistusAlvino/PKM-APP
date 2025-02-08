<?php

namespace App\Repositories\Users;

use App\Models\User;
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

        return Auth::user();
    }
}
