<?php

namespace App\Repositories\Dosen;

use App\Models\Komentar;
use Illuminate\Support\Collection;

interface KelompokDosenRepositoryInterface {
    public function getKelompok(): array;
    public function detailKelompok($id): array;
}
