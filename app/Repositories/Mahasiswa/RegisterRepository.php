<?php

namespace App\Repositories\Mahasiswa;

use App\Models\Kelompok;
use App\Models\MahasiswaKelompok;
use App\Models\RegisterMahasiswa;
use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Carbon;

class RegisterRepository implements RegisterRepositoryInterface
{
    public function create(array $data): RegisterMahasiswa
    {
        $mahasiswa = Mahasiswa::where('email_verification_token',$data['token'])->firstOrFail();
        if(!$mahasiswa) {
            throw new ModelNotFoundException('Mahasiswa dengan token ini tidak ditemukan.');
        }
        $user = User::create([
            'username' => $data['username'],
            'role' => $data['role'],
            'password' => bcrypt($data['password']),
        ]);
        $mahasiswa->update([
            'userId' => $user->id,
            'name' => $data['name'],
            'fakultas' => $data['fakultas'],
            'prodi' => $data['prodi'],
            'no_wa' => $data['no_wa'],
            'email_verification_token' => null,
            'email_verification_at' => now()
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
