<?php

namespace App\Repositories\Dosen;

use App\Models\Invite;
use App\Models\Kelompok;
use Illuminate\Support\Collection;

class InviteRepository implements InviteRepositoryInterface
{
    public function getInvite($id_dosen): Collection
    {
        return Invite::with('inviter.user')->where('dospemId', $id_dosen)->get();
    }

    public function insertDospem($id_kelompok, $id_dosen): ?Kelompok
    {
        $kelompok = Kelompok::findOrFail($id_kelompok);
        $kelompok->update([
            'dospemId' => $id_dosen
        ]);
        Invite::where('kelompokId', $id_kelompok)->delete();
        return $kelompok;
    }
}
