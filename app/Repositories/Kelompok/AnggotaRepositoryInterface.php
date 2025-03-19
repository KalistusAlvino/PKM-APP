<?php

namespace App\Repositories\Kelompok;

use App\Models\RegisterMahasiswa;

interface AnggotaRepositoryInterface {
    public function storeKetua($id_mahasiswa);
}
