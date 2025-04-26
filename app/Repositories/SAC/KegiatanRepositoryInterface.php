<?php
namespace App\Repositories\SAC;

use App\Models\Kegiatan;
use Illuminate\Support\Collection;

interface KegiatanRepositoryInterface {
    public function getUnconfirmKegiatan(): Collection;
    public function getUnconfirmKegiatanByIdMahasiswa($id): Collection;
    public function getConfirmKegiatanByIdMahasiswa($id): Collection;
    public function findById($id): Kegiatan;
    public function updateStatusKegiatan($id): ?Kegiatan;
}
