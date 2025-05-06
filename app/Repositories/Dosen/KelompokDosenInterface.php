<?php

namespace App\Repositories\Dosen;

use App\Models\Kelompok;

interface KelompokDosenInterface {
    public function keluarKelompok($id_kelompok): bool;
}
