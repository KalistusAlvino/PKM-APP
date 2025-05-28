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
    public function getKelompokByAuthMahasiswa(array $data, array $filter): array
    {
        $mahasiswa = Mahasiswa::where('userId', Auth::id())->first();
        $kelompokList = [];

        $mahasiswaKelompok = MahasiswaKelompok::with([
            'kelompok.dosen',
            'kelompok.judul.skema',
            'mahasiswa',
        ])
            ->where('mahasiswaId', $mahasiswa->id)
            ->orderBy('tahun_daftar', 'desc')
            ->get();

        foreach ($mahasiswaKelompok as $item) {
            $kelompok = $item->kelompok;
            $anggotaList = MahasiswaKelompok::with('mahasiswa')
                ->where('status_mahasiswa', 'anggota')
                ->where('kelompokId', $item->kelompokId)
                ->get()
                ->map(function ($anggota) {
                    return [
                        'nama' => $anggota->mahasiswa->name,
                        'status' => $anggota->status_mahasiswa,
                    ];
                });

            $ketua = MahasiswaKelompok::with('mahasiswa')
                ->where('status_mahasiswa', 'ketua')
                ->where('kelompokId', $item->kelompokId)
                ->first();

            // Filter berdasarkan nama ketua
            if (isset($data['nama_ketua']) && !str_contains(strtolower($ketua->mahasiswa->name), strtolower($data['nama_ketua']))) {
                continue;
            }

            $judulProposal = $kelompok->judul->firstWhere('is_proposal', true);
            $skema = $judulProposal ? $judulProposal->skema->nama_skema : 'Proses Bimbingan';

            $kelompokList[] = [
                'id_kelompok' => $item->kelompokId,
                'ketua' => $ketua->mahasiswa->name ?? '-',
                'total_anggota' => MahasiswaKelompok::where('kelompokId', $item->kelompokId)->count(),
                'tahun_daftar' => $item->tahun_daftar,
                'skema' => $skema,
                'dosen' => $kelompok->dosen->name ?? 'Belum ada dosen pembimbing',
                'anggota' => $anggotaList,
            ];
        }

        // Filter berdasarkan judul jika diperlukan
        if (isset($filter['filter_judul'])) {
            $kelompokList = array_filter($kelompokList, function ($kelompok) use ($filter) {
                if ($filter['filter_judul'] === 'true') {
                    return Judul::where('id_kelompok', $kelompok['id_kelompok'])->where('is_proposal', true)->exists();
                } elseif ($filter['filter_judul'] === 'false') {
                    return !Judul::where('id_kelompok', $kelompok['id_kelompok'])->where('is_proposal', true)->exists();
                }
            });
        }

        // Filter berdasarkan tahun
        if (isset($filter['filter_tahun'])) {
            $kelompokList = array_filter($kelompokList, function ($kelompok) use ($filter) {
                return MahasiswaKelompok::where('kelompokId', $kelompok['id_kelompok'])
                    ->where('tahun_daftar', $filter['filter_tahun'])
                    ->exists();
            });
        }

        return array_values($kelompokList); // Reset index array
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
                        'id_mhs' => $item->mahasiswa->id,
                        'id_kelompok' => $item->kelompokId,
                        'nama' => $item->mahasiswa->name,
                        'username' => $item->mahasiswa->user->username ?? null,
                        'is_verified' => $item->mahasiswa->email_verification_at !== null,
                        'token' => $item->mahasiswa->email_verification_token ?? null,
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
    public function getKelompokByAuthDosen(array $data, array $filter): LengthAwarePaginator
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
            ->when(isset($filter['filter_judul']), function ($query) use ($filter) {
                if ($filter['filter_judul'] === 'true') {
                    return $query->whereHas('judul', function ($subQuery) {
                        $subQuery->where('is_proposal', true);
                    });
                } elseif ($filter['filter_judul'] === 'false') {
                    return $query->whereDoesntHave('judul', function ($subQuery) {
                        $subQuery->where('is_proposal', true);
                    });
                }
            })
            ->when(
                isset($filter['filter_tahun']),
                function ($query) use ($filter) {
                    return $query->whereHas('mahasiswaKelompok', function ($subQuery) use ($filter) {
                        $subQuery->where('tahun_daftar', $filter['filter_tahun']);
                    });
                }
            )
            ->paginate(10);
        return $kelompokList->setCollection(
            $kelompokList->getCollection()
                ->sortByDesc(function ($kelompok) {
                    $tahun = $kelompok->mahasiswaKelompok
                        ->sortBy('tahun_daftar')
                        ->first()?->tahun_daftar ?? 0;
                    return $tahun;
                })
                ->values()
                ->map(function ($kelompok) {
                    $ketua = $kelompok->mahasiswaKelompok->firstWhere('status_mahasiswa', 'ketua');
                    return [
                        'id_kelompok' => $kelompok->id,
                        'ketua' => $ketua?->mahasiswa->name ?? 'Tidak ada ketua',
                        'skema' => $kelompok->judul->where('is_proposal', true)->first()?->skema->nama_skema ?? 'Proses Bimbingan',
                        'total_anggota' => $kelompok->mahasiswaKelompok->count(),
                        'tahun_daftar' => $kelompok->mahasiswaKelompok->first()?->tahun_daftar,
                        'anggota' => $kelompok->mahasiswaKelompok
                            ->where('status_mahasiswa', 'anggota')
                            ->map(function ($item) {
                                return [
                                    'nama' => $item->mahasiswa->name,
                                    'status' => $item->status_mahasiswa,
                                ];
                            })->values(),
                    ];
                })
        );
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
            })
            ->when(
                isset($filter['filter_tahun']),
                function ($query) use ($filter) {
                    return $query->whereHas('mahasiswaKelompok', function ($subQuery) use ($filter) {
                        $subQuery->where('tahun_daftar', $filter['filter_tahun']);
                    });
                }
            );

        // Paginate the results
        $daftarKelompok = $query->paginate(10); // Adjust the number 10 to your desired items per page

        // Map the paginated results
        return $daftarKelompok->setCollection($daftarKelompok->getCollection()
            ->sortByDesc(function ($kelompok) {
                $tahun = $kelompok->mahasiswaKelompok
                    ->sortBy('tahun_daftar')
                    ->first()?->tahun_daftar ?? 0;
                return $tahun;
            })
            ->map(function ($kelompok) {
                return [
                    'id_kelompok' => $kelompok->id,
                    'ketua' => $kelompok->mahasiswaKelompok
                        ->where('status_mahasiswa', 'ketua')
                        ->first()?->mahasiswa->name ?? 'Tidak ada ketua',
                    'nim' => $kelompok->mahasiswaKelompok
                        ->where('status_mahasiswa', 'ketua')
                        ->first()?->mahasiswa->user->username ?? 'Tidak ada ketua',
                    'tahun_daftar' => $kelompok->mahasiswaKelompok->first()?->tahun_daftar,
                    'skema' => $kelompok->judul->where('is_proposal', true)->first()?->skema->nama_skema ?? 'Proses Bimbingan',
                    'judul' => $kelompok->judul->where('is_proposal', true)->first()?->nama_skema ?? 'Proses Bimbingan',
                    'dosen' => $kelompok->dosen->name ?? 'Belum ada dosen pembimbing',
                    'total_anggota' => $kelompok->mahasiswaKelompok->count(),
                ];
            }));
    }
}
