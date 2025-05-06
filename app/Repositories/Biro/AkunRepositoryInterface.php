<?php
namespace App\Repositories\Biro;

use App\Models\Dosen;
use App\Models\Koordinator;
use App\Models\RegisterDosen;
use App\Models\RegisterKoordinator;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface AkunRepositoryInterface
{
    public function getDosen(): Collection;
    public function getKoordinator(): Collection;
    public function getMahasiswa(): LengthAwarePaginator;
    public function detailKoordinator($id_koordinator): Koordinator;
    public function updateKoordinator($id_koordinator, array $data);
    public function updateDosen($id_dosen, array $data);
    public function detailDosen($id_dosen): Dosen;
    public function gantiPassword(array $data) : ?User;
    public function deleteAccount($userId) : bool;
    public function postDosen(array $data): RegisterDosen;
    public function postKoordinator(array $data): RegisterKoordinator;
    public function changePassword(array $data): ?User;
}
