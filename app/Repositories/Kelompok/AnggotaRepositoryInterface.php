<?php

namespace App\Repositories\Kelompok;

use App\Models\Mahasiswa;
use Illuminate\Database\Eloquent\Collection;

interface AnggotaRepositoryInterface {
    public function storeKetua($id_mahasiswa);

    public function getSkema(): Collection;

    public function updateProfile(array $data) : Mahasiswa;
}
