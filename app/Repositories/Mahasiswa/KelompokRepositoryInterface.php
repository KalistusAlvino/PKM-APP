<?php

namespace App\Repositories\Mahasiswa;

use Illuminate\Pagination\LengthAwarePaginator;

interface KelompokRepositoryInterface
{
    public function getKelompok(): array;
    public function detailKelompok( $idKelompok): array;
    public function getMahasiswaOutKelompok($idKelompok) : LengthAwarePaginator;

}

