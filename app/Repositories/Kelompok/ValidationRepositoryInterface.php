<?php
namespace App\Repositories\Kelompok;

interface ValidationRepositoryInterface {
    public function isKetua(array $data): bool;
    public function lessThan(array $data): bool;
    public function hasPendingInvite(array $data): bool;
    public function hasDospem(array $data): bool;
    public function verifyKelompok (array $data): bool;
}
