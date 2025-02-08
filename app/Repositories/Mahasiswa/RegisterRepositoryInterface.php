<?php

namespace App\Repositories\Mahasiswa;

use App\Models\RegisterMahasiswa;
use Illuminate\Support\Collection;

interface RegisterRepositoryInterface {
    public function create(array $data): RegisterMahasiswa;
}

