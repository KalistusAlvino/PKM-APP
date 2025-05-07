<?php

namespace App\Repositories\Mahasiswa;

use App\Models\Kelompok;
use App\Models\MahasiswaKelompok;
use App\Models\RegisterMahasiswa;
use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Support\Carbon;

class RegisterRepository implements RegisterRepositoryInterface
{
    public function create(array $data): RegisterMahasiswa
    {
        $user = User::create([
            'username' => $data['username'],
            'role' => $data['role'],
            'password' => bcrypt($data['password']),
        ]);
        $mahasiswa = Mahasiswa::create([
            'userId' => $user->id,
            'name' => $data['name'],
            'fakultas' => $data['fakultas'],
            'prodi' => $data['prodi'],
            'email' => $data['email'],
            'no_wa' => $data['no_wa'],
        ]);
        $kelompok = Kelompok::create([
            'dospemId' => null
        ]);
        $mahasiswaKelompok = MahasiswaKelompok::create([
            'kelompokId' => $kelompok->id,
            'mahasiswaId' => $mahasiswa->id,
            'status_mahasiswa' => 'ketua',
            'tahun_daftar' => date('Y'),
        ]);

        return new RegisterMahasiswa($user, $mahasiswa, $kelompok, $mahasiswaKelompok);
    }
}
