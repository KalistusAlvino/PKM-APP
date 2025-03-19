<?php

namespace App\Repositories\Kelompok;

use App\Repositories\Kelompok\ValidationRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class ValidationRepository implements ValidationRepositoryInterface
{
    public function isKetua(array $data): bool
    {
        return Auth::user()->mahasiswa->mahasiswaKelompok->where('kelompokId', $data['id_kelompok'])->first()?->status_mahasiswa === 'ketua';
    }

    public function lessThan(array $data): bool {
        return is_countable($data['anggota'] ?? []) && count($data['anggota']) < 4;
    }

    public function hasPendingInvite(array $data): bool {
        return Auth::user()->mahasiswa->invite->where('kelompokId', $data['id_kelompok'])->isNotEmpty();
    }

    public function hasDospem(array $data): bool {
        return !empty($informasiKelompok['dosen']);
    }

    public function verifyKelompok(array $data): bool {
        return Auth::user()->mahasiswa->mahasiswaKelompok->where('kelompokId', $data['id_kelompok'])->isNotEmpty();
    }
}
