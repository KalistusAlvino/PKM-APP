<?php

namespace App\Repositories\Kelompok;

use App\Models\Dosen;
use App\Models\Invite;
use App\Models\Kelompok;
use App\Models\MahasiswaKelompok;
use App\Models\RegisterAnggota;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface KetuaRepositoryInterface {
    public function postAnggota(array $data, $idKelompok): RegisterAnggota;
    public function postOldAnggota(array $data, $idKelompok): MahasiswaKelompok;
    public function postProposalFinal($file,$judulId, $id_kelompok);
    public function postInvite ($id_kelompok, $id_dosen) : Invite;
    public function getDospem (array $data, $id_kelompok): LengthAwarePaginator;
    public function deleteAnggota ($id_mk) : ?MahasiswaKelompok;
    public function deleteDospem ($id_kelompok) : ?Kelompok;
    public function getMahasiswaOutKelompok($idKelompok, array $data) : LengthAwarePaginator;
}
