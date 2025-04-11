<?php

namespace App\Repositories\Kelompok;

use Illuminate\Database\Eloquent\Collection;

interface AnggotaRepositoryInterface {
    public function storeKetua($id_mahasiswa);

    public function getSkema(): Collection;
}
