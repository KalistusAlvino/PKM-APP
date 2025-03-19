<?php

namespace App\Repositories\Kelompok;

use App\Models\Invite;
use App\Models\Kelompok;
use App\Models\MahasiswaKelompok;
use App\Models\RegisterMahasiswa;

interface KetuaRepositoryInterface {
    public function postAnggota(array $data, $idKelompok): RegisterMahasiswa;
    public function postOldAnggota(array $data, $idKelompok);

    public function postProposalFinal($file,$judulId, $id_kelompok);
    public function postInvite ($id_kelompok, $id_dosen) : Invite;
    public function deleteAnggota ($id_mk) : ?MahasiswaKelompok;
    public function deleteDospem ($id_kelompok) : ?Kelompok;
}
