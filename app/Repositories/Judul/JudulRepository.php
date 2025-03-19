<?php

namespace App\Repositories\Judul;

use App\Models\Judul;
use App\Models\Komentar;
use Illuminate\Support\Collection;

class JudulRepository implements JudulRepositoryInterface
{
    public function getJudulByKelompokId($id_kelompok): Collection
    {
        return Judul::where('id_kelompok', $id_kelompok)
            ->with(['skema', 'komentar.user', 'user','proposal'])
            ->orderBy('created_at', 'desc')->get();
    }

    public function postKomentar(array $data, $id_judul, $id_user): Komentar
    {
        return Komentar::create([
            'id_judul' => $id_judul,
            'id_user' => $id_user,
            'komentar' => $data['komentar'],
            'status' => $data['status'],
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
        return Judul::find($id_judul)->delete();
    }

    public function updateJudul($id_judul, array $data): Judul {
        $judul  = Judul::findOrFail($id_judul);
        if($judul){
            $judul->update([
                'detail_judul' => $data['detail_judul'],
                'id_skema' => $data['id_skema'],
            ]);
        }
        return $judul;
    }
}
