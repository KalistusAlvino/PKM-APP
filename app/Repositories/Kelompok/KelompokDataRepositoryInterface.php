<?php
namespace App\Repositories\Kelompok;

interface KelompokDataRepositoryInterface {
    public function getKelompokByAuthMahasiswa(array $data): array;
    public function getDetailKelompokByIdKelompok($idKelompok);
    public function getKelompokByAuthDosen(array $data): array;
    public function getAllKelompok(array $data);


}
