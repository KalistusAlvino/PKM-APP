<?php

namespace App\Repositories\Dosen;

use App\Models\Kelompok;

class KelompokDosenRepository implements KelompokDosenInterface {
    public function keluarKelompok($id_kelompok): bool {
        return Kelompok::findOrFail($id_kelompok)->update([
            'dospemId' => null
        ]);
    }
}
