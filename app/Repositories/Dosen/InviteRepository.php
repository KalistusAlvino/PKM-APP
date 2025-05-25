<?php

namespace App\Repositories\Dosen;

use App\Models\Invite;
use App\Models\Kelompok;
use Illuminate\Support\Collection;

class InviteRepository implements InviteRepositoryInterface
{
    public function getInvite($id_dosen): Collection
    {
        return Invite::with('inviter.user')->where('dospemId', $id_dosen)->orderBy('updated_at', 'desc')->get();
    }

    public function insertDospem($id_kelompok, $id_dosen): ?Kelompok
    {
        $alreadyMax = Kelompok::where('dospemId', $id_dosen)
            ->whereHas('mahasiswaKelompok', function ($query)  {
                $query->where('tahun_daftar', date('Y'));
            })
            ->count();
        if ($alreadyMax >= 10) {
            throw new \Exception('Anda sudah memiliki batas maksimal bimbingan');
        }
        $kelompok = Kelompok::findOrFail($id_kelompok);
        $kelompok->update([
            'dospemId' => $id_dosen
        ]);
        Invite::where('kelompokId', $id_kelompok)->delete();
        return $kelompok;
    }
    public function tolakUndangan($id_invite): ?Invite
    {
        $invite = Invite::findOrFail($id_invite);
        $invite->update([
            'status' => 'ditolak',
        ]);

        return $invite;
    }
    public function detailUndangan($id_invite): Invite
    {
        return Invite::with([
            'inviter.user',
            'kelompok.mahasiswaKelompok' => function ($query) {
                $query->whereHas('mahasiswa', function ($q) {
                    $q->where('status_mahasiswa', 'anggota');
                });
            },
            'kelompok.mahasiswaKelompok.mahasiswa.user'
        ])
            ->where('id', $id_invite)
            ->firstOrFail();
    }
}
