<?php

namespace App\Repositories\Judul;

use App\Models\Judul;
use App\Models\Komentar;
use Illuminate\Support\Collection;

interface JudulRepositoryInterface {
    public function getJudulByKelompokId($id_kelompok) : Collection;
    public function postJudul (array $data, $idKelompok, $id_user) : Judul;
    public function deleteJudul($id_judul);
    public function updateJudul($id_judul, array $data): ?Judul;
    public function postKomentar(array $data, $id_judul, $id_user): Komentar;

}
