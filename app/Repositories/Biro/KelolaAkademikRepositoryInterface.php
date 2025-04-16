<?php

namespace App\Repositories\Biro;

use App\Models\Fakultas;
use App\Models\ProgramStudi;
use App\Models\SkemaPkm;
use Illuminate\Support\Collection;

interface KelolaAkademikRepositoryInterface {
    public function getFakultas() : Collection;
    public function getProdi(): Collection;
    public function postSkema(array $data): SkemaPkm;
    public function postFakultas(array $data): Fakultas;
    public function postProdi(array $data): ProgramStudi;
    public function findSkemaById($id_skema): SkemaPkm;
    public function findFakultasById($id_fakultas): Fakultas;
    public function findProdiById($id_prodi): ProgramStudi;
    public function updateSkema(array $data, $id_skema) : SkemaPkm;
    public function updateFakultas(array $data, $id_fakultas) : Fakultas;
    public function updateProdi(array $data, $id_prodi) : ProgramStudi;
    public function deleteSkema($id_skema): bool;
    public function deleteFakultas($id_fakultas): bool;
    public function deleteProdi($id_prodi): bool;
}
