<?php
namespace App\Repositories\Biro;

use App\Models\RegisterDosen;
use App\Models\RegisterKoordinator;
use Illuminate\Support\Collection;

interface AkunRepositoryInterface
{
    public function getDosen(): Collection;
    public function getKoordinator(): Collection;
    public function getMahasiswa(): Collection;

    public function postDosen(array $data): RegisterDosen;
    public function postKoordinator(array $data): RegisterKoordinator;
}
