<?php

namespace App\Repositories\Dosen;

use App\Models\Kelompok;
use Illuminate\Support\Collection;

interface InviteRepositoryInterface
{
    public function getInvite($id_dosen): Collection;

    public function insertDospem($id_kelompok,$id_dosen): ?Kelompok;

}
