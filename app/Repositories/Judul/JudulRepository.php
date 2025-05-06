<?php

namespace App\Repositories\Judul;

use App\Models\Judul;
use App\Models\Komentar;
use App\Models\ProposalFinal;
use App\Models\SkemaPkm;
use Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class JudulRepository implements JudulRepositoryInterface
{
    public function getJudulByKelompokId($id_kelompok): Collection
    {
        return Judul::where('id_kelompok', $id_kelompok)
            ->with(['skema', 'komentar.user', 'user', 'proposal'])
            ->orderBy('created_at', 'desc')->get();
    }
    public function getJudulByDosenId($id_dosen): Collection
    {
        return Judul::whereHas('kelompok', function ($query) use ($id_dosen) {
            $query->where('dospemId', $id_dosen);
        })
            ->with('komentar', 'user', 'skema')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
    }

    public function getProposalByMahasiswaId($id_mahasiswa): Collection
    {
        return ProposalFinal::with([
            'judul.kelompok.mahasiswaKelompok.mahasiswa',
            'judul.kelompok.dosen'
        ])->whereHas('judul', function ($query) use ($id_mahasiswa) {
            $query->whereHas('kelompok', function ($que) use ($id_mahasiswa) {
                $que->whereHas('mahasiswaKelompok', function ($q) use ($id_mahasiswa) {
                    $q->where('mahasiswaId', $id_mahasiswa);
                });
            });
        })
            ->orderBy('created_at', 'desc')
            ->limit(2)
            ->get();
    }

    public function getKomentarByMahasiswaId($id_mahasiswa): Collection
    {
        return Komentar::with('user')->whereHas('judul', function ($query) use ($id_mahasiswa) {
            $query->whereHas('kelompok', function ($que) use ($id_mahasiswa) {
                $que->whereHas('mahasiswaKelompok', function ($q) use ($id_mahasiswa) {
                    $q->where('mahasiswaId', $id_mahasiswa);
                });
            });
        })
            ->limit(5)
            ->get();
    }

    public function getProposal($id_kelompok): ?Judul
    {
        $judul = Judul::where('id_kelompok', $id_kelompok)
            ->where('is_proposal', true)
            ->with('proposal')
            ->first();

        return $judul ?? new Judul();
    }

    public function postKomentar(array $data, $id_judul, $id_user): Komentar
    {
        return Komentar::create([
            'id_judul' => $id_judul,
            'id_user' => $id_user,
            'komentar' => $data['komentar'],
        ]);
    }

    public function postJudul(array $data, $idKelompok, $id_user): Judul
    {
        return Judul::create([
            'id_kelompok' => $idKelompok,
            'id_user' => $id_user,
            'id_skema' => $data['id_skema'],
            'detail_judul' => $data['detail_judul'],
        ]);
    }

    public function deleteJudul($id_judul)
    {
        return Judul::findOrFail($id_judul)->delete();
    }

    public function updateJudul($id_judul, array $data): Judul
    {
        $judul = Judul::findOrFail($id_judul);
        if ($judul) {
            $judul->update([
                'detail_judul' => $data['detail_judul'],
                'id_skema' => $data['id_skema'],
            ]);
        }
        return $judul;
    }

    public function updateKomentar(array $data, $id_komentar): Komentar
    {
        $komentar = Komentar::findOrFail($id_komentar);
        if ($komentar) {
            $komentar->update([
                'komentar' => $data['komentar'],
            ]);
        }
        return $komentar;
    }
    public function insertKomentarMahasiswa($id_judul, array $data): Komentar {
        $userId = Auth::user()->id;
        return Komentar::create([
            'id_judul' => $id_judul,
            'id_user' => $userId,
            'komentar' => $data['komentar']
        ]);
    }

    public function deleteKomentar($id_komentar): bool
    {
        $komentar = Komentar::find($id_komentar);
        if (!$komentar) {
            return false;
        }

        return $komentar->delete();
    }

    public function getSkema(): Collection
    {
        return SkemaPkm::with('judul.proposal')->get();
    }


}
