<?php

namespace App\Repositories\Judul;

use App\Models\Judul;
use App\Models\Kelompok;
use App\Models\Komentar;
;
use Illuminate\Database\Eloquent\Collection;

interface JudulRepositoryInterface
{
    public function getJudulByKelompokId($id_kelompok): Collection;
    public function getProposal($id_kelompok): ?Judul;
    public function postJudul(array $data, $idKelompok, $id_user): Judul;
    public function deleteJudul($id_judul);
    public function updateJudul($id_judul, array $data): ?Judul;
    public function postKomentar(array $data, $id_judul, $id_user): Komentar;
    public function updateKomentar(array $data, $id_komentar): Komentar;
    public function deleteKomentar($id_komentar): bool;

}
