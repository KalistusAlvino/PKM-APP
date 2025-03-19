<?php

namespace App\Repositories\Dosen;

use App\Models\Dosen;
use App\Models\Judul;
use App\Models\Kelompok;
use App\Models\Komentar;
use App\Models\MahasiswaKelompok;
use App\Repositories\Dosen\KelompokDosenRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class KelompokDosenRepository implements KelompokDosenRepositoryInterface
{
    public function getKelompok(): array
    {
        $dosen = Dosen::where('userId', Auth::id())->first();

        $kelompokList = Kelompok::where('dospemId', $dosen->id)
            ->with(['mahasiswaKelompok.mahasiswa'])
            ->get()
            ->map(function ($kelompok) {
                return [
                    'id_kelompok' => $kelompok->id,
                    'ketua' => $kelompok->mahasiswaKelompok
                        ->where('status_mahasiswa', 'ketua')
                        ->first()?->mahasiswa->name ?? 'Tidak ada ketua',
                    'total_anggota' => $kelompok->mahasiswaKelompok->count(),
                    'anggota' => $kelompok->mahasiswaKelompok
                        ->where('status_mahasiswa', 'anggota')
                        ->map(function ($item) {
                            return [
                                'nama' => $item->mahasiswa->name,
                                'status' => $item->status_mahasiswa,
                            ];
                        }),
                ];
            });


        return $kelompokList->toArray();
    }

    public function detailKelompok($id): array
    {
        $kelompok = Kelompok::where('id', $id)->with('mahasiswaKelompok.mahasiswa.user', 'dosen')->first();
        $informasiKelompok = [];
        if ($kelompok) {
            $ketua = $kelompok->mahasiswaKelompok
                ->where('status_mahasiswa', 'ketua')
                ->first();

            $anggota = $kelompok->mahasiswaKelompok
                ->where('status_mahasiswa', 'anggota')
                ->map(function ($item) {
                    return [
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
}
