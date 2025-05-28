<?php
namespace App\Repositories\Kelompok;
interface ValidationRepositoryInterface
{
    public function isKetua(array $data): bool;
    public function lessThan(array $data): bool;
    public function hasPendingInvite($id_kelompok): bool;
    public function hasRejectedInvite($id_kelompok): bool;
    public function hasDospem(array $data): bool;
    public function verifyKelompok(array $data): bool;
}
