<?php

namespace App\Repositories\Mahasiswa;

use App\Models\MahasiswaData;
use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Support\Collection;

class MahasiswaRepository implements MahasiswaRepositoryInterface
{
    public function create(array $data): MahasiswaData
    {
        $user = User::create([
            'username' => $data['username'],
            'name' => $data['name'],
            'role' => $data['role'],
            'password' => bcrypt($data['password']),
        ]);
        $mahasiswa = Mahasiswa::create([
            'userId' => $user->id,
            'fakultas' => $data['fakultas'],
            'prodi' => $data['prodi'],
            'email' => $data['email'],
            'no_wa' => $data['no_wa'],
        ]);

        return new MahasiswaData($user, $mahasiswa);
    }
}
