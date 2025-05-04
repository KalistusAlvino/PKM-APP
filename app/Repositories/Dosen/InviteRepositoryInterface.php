<?php

namespace App\Repositories\Dosen;

use App\Models\Invite;
use App\Models\Kelompok;
use Illuminate\Support\Collection;

interface InviteRepositoryInterface
{
    public function getInvite($id_dosen): Collection;

    public function insertDospem($id_kelompok,$id_dosen): ?Kelompok;

    public function tolakUndangan($id_invite):?Invite;

    public function detailUndangan($id_invite): Invite;

}
