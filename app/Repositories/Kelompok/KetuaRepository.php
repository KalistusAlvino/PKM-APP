<?php
namespace App\Repositories\Kelompok;

use App\Models\Invite;
use App\Models\Kelompok;
use App\Models\Mahasiswa;
use App\Models\MahasiswaKelompok;
use App\Models\ProposalFinal;
use App\Models\RegisterMahasiswa;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class KetuaRepository implements KetuaRepositoryInterface
{
    public function postInvite($id_kelompok, $id_dosen): Invite
    {
        $mahasiswa = Mahasiswa::where('userId', Auth::id())->first();
        return Invite::create([
            'inviterId' => $mahasiswa->id,
            'dospemId' => $id_dosen,
            'kelompokId' => $id_kelompok,
        ]);
    }
    public function postAnggota(array $data, $idKelompok): RegisterMahasiswa
    {
        $user = User::create([
            'username' => $data['username'],
            'role' => $data['role'],
            'password' => bcrypt('12345678'),
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
            'kelompokId' => $idKelompok,
            'mahasiswaId' => $mahasiswa->id,
            'status_mahasiswa' => 'anggota',
        ]);
        return new RegisterMahasiswa($user, $mahasiswa, $kelompok, $mahasiswaKelompok);
    }
    public function postOldAnggota(array $data, $idKelompok)
    {
        foreach ($data as $mhs) {
            $users = User::where('username', $mhs['username'])->with('mahasiswa')->get();

            if ($users->isNotEmpty()) {
                foreach ($users as $user) {
                    MahasiswaKelompok::create([
                        'kelompokId' => $idKelompok,
                        'mahasiswaId' => $user->mahasiswa->id,
                        'status_mahasiswa' => 'anggota'
                    ]);
                }
            }
        }
    }

    public function deleteAnggota($id_mk): ?MahasiswaKelompok
    {
        $mk = MahasiswaKelompok::find($id_mk);
        $mk->delete();

        return $mk;
    }

    public function deleteDospem($id_kelompok): ?Kelompok
    {
        $kel = Kelompok::find($id_kelompok);
        $kel->update([
            'dospemId' => null
        ]);

        return $kel;
    }

    public function postProposalFinal($file,$judulId, $id_kelompok)
    {
        $extension = $file->getClientOriginalExtension();
        $file_name = $id_kelompok . '.' . $extension;
        $path = 'proposal/';

        // Hapus file lama jika ada
        if (Storage::disk('public')->exists($path . $file_name)) {
            Storage::disk('public')->delete($path . $file_name);
            ProposalFinal::where('judulId',$judulId)->delete();
        }

        // Simpan file baru
        $file->storeAs($path, $file_name, 'public');

        // Simpan ke database
        return ProposalFinal::create([
            'judulId' => $judulId,
            'nama_file' => $file_name,
        ]);
    }

}
