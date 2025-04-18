<?php
namespace App\Repositories\Kelompok;

use App\Models\Dosen;
use App\Models\Invite;
use App\Models\Judul;
use App\Models\Kelompok;
use App\Models\Mahasiswa;
use App\Models\MahasiswaKelompok;
use App\Models\ProposalFinal;
use App\Models\RegisterAnggota;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
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

    public function getDospem(array $data): Collection
    {
        return Dosen::withCount('kelompok')
            ->when(isset($data['cari']) && $data['cari'], function ($query) use ($data) {
                return $query->where('name', 'like', '%' . $data['cari'] . '%');
            })
            ->having('kelompok_count', '<', 10)
            ->get();
    }
    public function postAnggota(array $data, $idKelompok): RegisterAnggota
    {
        $anggota = MahasiswaKelompok::where('kelompokId', $idKelompok)->where('status_mahasiswa', 'anggota')->count();
        if ($anggota >= 4) {
            throw new \Exception('Kelompok sudah memiliki anggota maksimal.');
        }
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
        $mahasiswaKelompok = MahasiswaKelompok::create([
            'kelompokId' => $idKelompok,
            'mahasiswaId' => $mahasiswa->id,
            'status_mahasiswa' => 'anggota',
        ]);
        return new RegisterAnggota($user, $mahasiswa, $mahasiswaKelompok);
    }
    public function postOldAnggota(array $data, $idKelompok): MahasiswaKelompok
    {

        $users = User::where('username', $data['username'])->with('mahasiswa')->firstOrFail();
        $anggota = MahasiswaKelompok::where('kelompokId', $idKelompok)->where('status_mahasiswa', 'anggota')->count();
        if ($anggota >= 4) {
            throw new \Exception('Kelompok sudah memiliki anggota maksimal.');
        }
        return MahasiswaKelompok::create([
            'kelompokId' => $idKelompok,
            'mahasiswaId' => $users->mahasiswa->id,
            'status_mahasiswa' => 'anggota'
        ]);
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

    public function postProposalFinal($file, $judulId, $id_kelompok)
    {
        $extension = $file->getClientOriginalExtension();
        $file_name = $id_kelompok . '.' . $extension;
        $path = 'proposal/';
        Judul::where('id_kelompok', $id_kelompok)->update(['is_proposal' => false]);
        // Debug sementara: pastikan judulId benar
        $judul = Judul::find($judulId);
        if (!$judul) {
            throw new \Exception("Judul tidak ditemukan untuk ID: " . $judulId);
        }
        $judul->update(['is_proposal' => true]);

        // Hapus file lama jika ada
        if (Storage::disk('public')->exists($path . $file_name)) {
            Storage::disk('public')->delete($path . $file_name);
            ProposalFinal::where('nama_file', $file_name)->delete();
        }

        // Simpan file baru
        $file->storeAs($path, $file_name, 'public');

        // Simpan ke database
        return ProposalFinal::create([
            'judulId' => $judulId,
            'nama_file' => $file_name,
        ]);
    }

    public function getMahasiswaOutKelompok($idKelompok, array $data): Collection
    {
        $mahasiswaBukanAnggota = Mahasiswa::whereDoesntHave('mahasiswaKelompok', function ($query) use ($idKelompok) {
            $query->where('kelompokId', $idKelompok);
        })->whereHas('user', function ($query) use ($data) {
            $query->when(isset($data['nim']) && !empty($data['nim']), function ($q) use ($data) {
                $q->where('username', 'like', '%' . $data['nim'] . '%');
            });
        })
            ->with('user')
            ->get()
            ->map(function ($item) {
                return [
                    'nama' => $item->name,
                    'username' => $item->user->username ?? null,
                    'prodi' => $item->prodi,
                    'no_wa' => $item->no_wa
                ];
            });

        return $mahasiswaBukanAnggota;
    }
}
