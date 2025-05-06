<?php

namespace App\Repositories\Kelompok;

use App\Models\Dosen;
use App\Models\Judul;
use App\Models\Kelompok;
use App\Models\Mahasiswa;
use App\Models\MahasiswaKelompok;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class KelompokDataRepository implements KelompokDataRepositoryInterface
{
    public function getKelompokByAuthMahasiswa(array $data): array
    {
        $mahasiswa = Mahasiswa::where('userId', Auth::id())->first();
        $kelompokList = [];
        foreach ($mahasiswa->mahasiswaKelompok as $mahasiswaKelompok) {
            $ketua = $mahasiswaKelompok->where('status_mahasiswa', 'ketua')
                ->where('kelompokId', $mahasiswaKelompok->kelompokId)
                ->first();

            if (isset($data['nama_ketua']) && !str_contains(strtolower($ketua->mahasiswa->name), strtolower($data['nama_ketua']))) {
                continue;
            }

            $kelompokList[] = [
                'id_kelompok' => $mahasiswaKelompok->kelompokId,
                'ketua' => $ketua->mahasiswa->name,
                'total_anggota' => MahasiswaKelompok::where('kelompokId', $mahasiswaKelompok->kelompokId)->count(),
                'skema' => Judul::with('skema')->where('id_kelompok', $mahasiswaKelompok->kelompokId)->first()?->skema->nama_skema ?? 'Proses Bimbingan',
                'dosen' => Kelompok::with('dosen')->where('id', $mahasiswaKelompok->kelompokId)->first()?->dosen->name ?? 'Belum ada dosen pembimbing',
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

    public function getDetailKelompokByIdKelompok($idKelompok)
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
                'ketua' => [
                    'nama' => $ketua && $ketua->mahasiswa ? $ketua->mahasiswa->name : 'Belum ada ketua',
                    'username' => $ketua && $ketua->mahasiswa && $ketua->mahasiswa->user ? $ketua->mahasiswa->user->username : 'Belum ada ketua',
                ],
                'anggota' => $anggota,
                'dosen' => $dosen->name ?? null
            ];
        }
        return $informasiKelompok;
    }
    public function getKelompokByAuthDosen(array $data): array
    {
        $dosen = Dosen::where('userId', Auth::id())->first();

        $kelompokList = Kelompok::where('dospemId', $dosen->id)
            ->with(['mahasiswaKelompok.mahasiswa', 'judul.skema'])
            ->when(isset($data['nama_ketua']) && !empty($data['nama_ketua']), function ($query) use ($data) {
                return $query->whereHas('mahasiswaKelompok', function ($subQuery) use ($data) {
                    $subQuery->where('status_mahasiswa', 'ketua')
                        ->whereHas('mahasiswa', function ($innerQuery) use ($data) {
                            $innerQuery->where('name', 'like', '%' . $data['nama_ketua'] . '%');
                        });
                });
            })
            ->get()
            ->map(function ($kelompok) {
                $ketua = $kelompok->mahasiswaKelompok
                    ->where('status_mahasiswa', 'ketua')
                    ->first();

                return [
                    'id_kelompok' => $kelompok->id,
                    'ketua' => $ketua?->mahasiswa->name ?? 'Tidak ada ketua',
                    'skema' => $kelompok->judul->where('is_proposal', true)->first()?->skema->nama_skema ?? 'Proses Bimbingan',
                    'total_anggota' => $kelompok->mahasiswaKelompok->count(),
                    'anggota' => $kelompok->mahasiswaKelompok
                        ->where('status_mahasiswa', 'anggota')
                        ->map(function ($item) {
                            return [
                                'nama' => $item->mahasiswa->name,
                                'status' => $item->status_mahasiswa,
                            ];
                        })->values(),
                ];
            });

        return $kelompokList->toArray();
    }

    public function getAllKelompok(array $data, array $filter): LengthAwarePaginator
    {
        $query = Kelompok::with(['mahasiswaKelompok.mahasiswa', 'judul.skema', 'dosen'])
            ->when(isset($data['nama_ketua']) && !empty($data['nama_ketua']), function ($query) use ($data) {
                return $query->whereHas('mahasiswaKelompok', function ($subQuery) use ($data) {
                    $subQuery->where('status_mahasiswa', 'ketua')
                        ->whereHas('mahasiswa', function ($innerQuery) use ($data) {
                            $innerQuery->where('name', 'like', '%' . $data['nama_ketua'] . '%');
                        });
                });
            })
            ->when(isset($filter['filter_judul']), function ($query) use ($filter) {
                if ($filter['filter_judul'] === 'true') {
                    // Filter for groups with a valid title
                    return $query->whereHas('judul', function ($subQuery) {
                        $subQuery->where('is_proposal', true);
                    });
                } elseif ($filter['filter_judul'] === 'false') {
                    // Filter kelompok yang tidak punya judul dengan is_proposal true
                    return $query->whereDoesntHave('judul', function ($subQuery) {
                        $subQuery->where('is_proposal', true);
                    });
                }
            });

        // Paginate the results
        $daftarKelompok = $query->paginate(10); // Adjust the number 10 to your desired items per page

        // Map the paginated results
        return $daftarKelompok->setCollection($daftarKelompok->getCollection()->map(function ($kelompok) {
            return [
                'id_kelompok' => $kelompok->id,
                'ketua' => $kelompok->mahasiswaKelompok
                    ->where('status_mahasiswa', 'ketua')
                    ->first()?->mahasiswa->name ?? 'Tidak ada ketua',
                'nim' => $kelompok->mahasiswaKelompok
                    ->where('status_mahasiswa', 'ketua')
                    ->first()?->mahasiswa->user->username ?? 'Tidak ada ketua',
                'skema' => $kelompok->judul->where('is_proposal', true)->first()?->skema->nama_skema ?? 'Proses Bimbingan',
                'judul' => $kelompok->judul->where('is_proposal', true)->first()?->nama_skema ?? 'Proses Bimbingan',
                'dosen' => $kelompok->dosen->name ?? 'Belum ada dosen pembimbing',
                'total_anggota' => $kelompok->mahasiswaKelompok->count(),
            ];
        }));
    }
}
