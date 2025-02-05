<?php

namespace App\Repositories\Mahasiswa;

use App\Models\MahasiswaData;
use Illuminate\Support\Collection;

interface MahasiswaRepositoryInterface {
    public function create(array $data): MahasiswaData;
}

