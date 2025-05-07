<?php

namespace App\Repositories\Kelompok;

use App\Models\Kelompok;
use App\Models\Mahasiswa;
use App\Models\MahasiswaKelompok;
use App\Models\SkemaPkm;
use App\Repositories\Kelompok\AnggotaRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class AnggotaRepository implements AnggotaRepositoryInterface
{
    public function storeKetua($id_mahasiswa)
    {
        $mahasiswa = MahasiswaKelompok::where('mahasiswaId', $id_mahasiswa)
            ->where('status', 'ketua')
            ->where('tahun_daftar', date('Y'))
            ->exists();
        if ($mahasiswa) {
            throw new \Exception('Anda sudah terdaftar sebagai ketua pada tahun ini!');
        }
        $kelompok = Kelompok::create([
            'dospemId' => null
        ]);
        MahasiswaKelompok::create([
            'kelompokId' => $kelompok->id,
            'mahasiswaId' => $id_mahasiswa,
            'status_mahasiswa' => 'ketua',
            'tahun_daftar' => date('Y')
        ]);
    }

    public function getSkema(): Collection
    {
        return SkemaPkm::get();
    }

    public function updateProfile(array $data): Mahasiswa
    {
        $id_user = Auth::user()->id;
        $mahasiswa = Mahasiswa::where('userId', $id_user)->firstOrFail();
        $mahasiswa->update([
            'name' => $data['name'],
            'fakultas' => $data['fakultas'],
            'prodi' => $data['prodi'],
            'email' => $data['email'],
            'no_wa' => $data['no_wa'],
        ]);

        return $mahasiswa;
    }
}
