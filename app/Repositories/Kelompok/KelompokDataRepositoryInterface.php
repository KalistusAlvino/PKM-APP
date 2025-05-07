<?php
namespace App\Repositories\Kelompok;

use Illuminate\Pagination\LengthAwarePaginator;

interface KelompokDataRepositoryInterface {
    public function getKelompokByAuthMahasiswa(array $data): array;
    public function getDetailKelompokByIdKelompok($idKelompok);
    public function getKelompokByAuthDosen(array $data): LengthAwarePaginator;
    public function getAllKelompok(array $data, array $filter): LengthAwarePaginator;


}
