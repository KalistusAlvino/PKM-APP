<?php

namespace App\Repositories\Kelompok;

use App\Models\Kelompok;
use App\Models\Mahasiswa;
use App\Models\MahasiswaKelompok;
use App\Models\RegisterMahasiswa;
use App\Models\User;
use App\Repositories\Kelompok\AnggotaRepositoryInterface;

class AnggotaRepository implements AnggotaRepositoryInterface {
    public function storeKetua($id_mahasiswa) {
        $kelompok = Kelompok::create([
            'dospemId' => null
        ]);
        MahasiswaKelompok::create([
            'kelompokId' => $kelompok->id,
            'mahasiswaId' => $id_mahasiswa,
            'status_mahasiswa' => 'ketua',
        ]);
    }
}
