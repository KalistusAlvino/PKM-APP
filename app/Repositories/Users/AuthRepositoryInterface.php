<?php

namespace App\Repositories\Users;

use App\Models\User;
use Illuminate\Support\Collection;

interface AuthRepositoryInterface {
    public function login(array $data): ?User;

    public function logout();
}
