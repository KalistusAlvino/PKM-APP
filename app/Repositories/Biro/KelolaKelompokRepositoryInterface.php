<?php
namespace App\Repositories\Biro;

use App\Models\Kelompok;

interface KelolaKelompokRepositoryInterface
{
    public function deleteKelompok($id_kelompok): ?Kelompok;
}
