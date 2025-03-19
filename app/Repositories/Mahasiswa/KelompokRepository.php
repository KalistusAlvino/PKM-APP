<?php

namespace App\Repositories\Mahasiswa;

use App\Models\Invite;
use App\Models\Kelompok;
use App\Models\Mahasiswa;
use App\Models\MahasiswaKelompok;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class KelompokRepository implements KelompokRepositoryInterface
{
    public function getKelompok(): array
    {
        $mahasiswa = Mahasiswa::where('userId', Auth::id())->first();
        $kelompokList = [];
        foreach ($mahasiswa->mahasiswaKelompok as $mahasiswaKelompok) {
            $kelompokList[] = [
                'id_kelompok' => $mahasiswaKelompok->kelompokId,
                'ketua' => $mahasiswaKelompok->where('status_mahasiswa', 'ketua')->where('kelompokId', $mahasiswaKelompok->kelompokId)->first()->mahasiswa->name,
                'total_anggota' => MahasiswaKelompok::where('kelompokId', $mahasiswaKelompok->kelompokId)->count(),
                'anggota' => MahasiswaKelompok::with('mahasiswa')
                    ->where('status_mahasiswa', 'anggota')
                    ->where('kelompokId', $mahasiswaKelompok->kelompokId)
                    ->get()
                    ->map(function ($item) {
                        return [
                            'nama' => $item->mahasiswa->name,
                            'status' => $item->status_mahasiswa,
                        ];
                    }),
            ];
        }

        return $kelompokList;
    }
    public function detailKelompok($idKelompok): array
    {
        $kelompok = Kelompok::where('id', $idKelompok)->with('mahasiswaKelompok.mahasiswa.user', 'dosen')->first();
        $informasiKelompok = [];
        if ($kelompok) {
            $ketua = $kelompok->mahasiswaKelompok
                ->where('status_mahasiswa', 'ketua')
                ->first();

            $anggota = $kelompok->mahasiswaKelompok
                ->where('status_mahasiswa', 'anggota')
                ->map(function ($item) {
                    return [
                        'id_mk' => $item->id,
                        'id_kelompok' => $item->kelompokId,
                        'nama' => $item->mahasiswa->name,
                        'username' => $item->mahasiswa->user->username ?? null,
                    ];
                });

            $dosen = $kelompok->dosen;
            $informasiKelompok = [
                'id_kelompok' => $kelompok->id,
                'ketua' => ['nama' => $ketua ? $ketua->mahasiswa->name : null, 'username' => $ketua->mahasiswa->user->username],
                'anggota' => $anggota,
                'dosen' => $dosen->name ?? null
            ];
        }
        return $informasiKelompok;
    }

    public function getMahasiswaOutKelompok($idKelompok): LengthAwarePaginator
    {
        $mahasiswaBukanAnggota = Mahasiswa::whereDoesntHave('mahasiswaKelompok', function ($query) use ($idKelompok) {
            $query->where('kelompokId', $idKelompok);
        })
            ->with('user')
            ->paginate(10)
            ->through(function ($item) {
                return [
                    'nama' => $item->name,
                    'username' => $item->user->username ?? null,
                    'prodi' => $item->prodi,
                ];
            });

        return $mahasiswaBukanAnggota;
    }



}
