<?php

namespace App\Repositories\Kelompok;

use App\Models\Invite;
use App\Models\Kelompok;
use App\Models\MahasiswaKelompok;
use App\Repositories\Kelompok\ValidationRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class ValidationRepository implements ValidationRepositoryInterface
{
    public function isKetua(array $data): bool
    {
        return MahasiswaKelompok::where('mahasiswaId', Auth::user()->mahasiswa->id)
            ->where('kelompokId', $data['id_kelompok'])
            ->value('status_mahasiswa') === 'ketua';
    }

    public function lessThan(array $data): bool
    {
        return is_countable($data['anggota'] ?? []) && count($data['anggota']) < 5;
    }

    public function hasPendingInvite($id_kelompok): bool
    {
        $kelompok = Kelompok::where('id', $id_kelompok)->exists();
        if (!$kelompok) {
            throw new \Exception("Kelompok tidak ditemukan");
        }
        return Invite::where('kelompokId', $id_kelompok)->where('status', 'menunggu')->exists();
    }
    public function hasRejectedInvite($id_kelompok): bool
    {
        $kelompok = Kelompok::where('id', $id_kelompok)->exists();
        if (!$kelompok) {
            throw new \Exception("Kelompok tidak ditemukan");
        }
        return Invite::where('kelompokId', $id_kelompok)->where('status', 'ditolak')->exists();
    }

    public function hasDospem(array $data): bool
    {
        return !empty($data['dosen']);
    }

    public function verifyKelompok(array $data): bool
    {
        return Auth::user()->mahasiswa->mahasiswaKelompok->where('kelompokId', $data['id_kelompok'])->isNotEmpty();
    }
}
