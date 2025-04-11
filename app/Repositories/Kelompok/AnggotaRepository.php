<?php

namespace App\Repositories\Kelompok;

use App\Models\Kelompok;
use App\Models\MahasiswaKelompok;
use App\Models\SkemaPkm;
use App\Repositories\Kelompok\AnggotaRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

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

    public function getSkema(): Collection {
        return SkemaPkm::get();
    }
}
