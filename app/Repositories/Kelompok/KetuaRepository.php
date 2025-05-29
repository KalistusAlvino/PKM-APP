<?php
namespace App\Repositories\Kelompok;

use App\Models\Dosen;
use App\Models\Invite;
use App\Models\Jenis;
use App\Models\Judul;
use App\Models\Kegiatan;
use App\Models\Kelompok;
use App\Models\Mahasiswa;
use App\Models\MahasiswaKelompok;
use App\Models\ProposalFinal;
use App\Models\RegisterAnggota;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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

    public function getDospem(array $data, $id_kelompok): LengthAwarePaginator
    {
        return Dosen::withCount('kelompok')
            ->when(isset($data['cari']) && $data['cari'], function ($query) use ($data) {
                return $query->where('name', 'like', '%' . $data['cari'] . '%');
            })
            ->whereDoesntHave('invite', function ($query) use ($id_kelompok) {
                $query->where('kelompokId', $id_kelompok);
            })
            ->having('kelompok_count', '<', 10)
            ->paginate(10);
    }
    public function postAnggota(array $data, $idKelompok): RegisterAnggota
    {
        $anggota = MahasiswaKelompok::where('kelompokId', $idKelompok)->where('status_mahasiswa', 'anggota')->count();
        if ($anggota >= 5) {
            throw new \Exception('Kelompok sudah memiliki anggota maksimal.');
        }
        $user = User::create([
            'username' => $data['username'],
            'role' => $data['role'],
            'password' => bcrypt('12345678'),
        ]);
        $token = Str::uuid();
        $mahasiswa = Mahasiswa::create([
            'userId' => $user->id,
            'name' => $data['name'],
            'fakultas' => $data['fakultas'],
            'prodi' => $data['prodi'],
            'email' => $data['email'],
            'no_wa' => $data['no_wa'],
            'email_verification_token' => $token,
        ]);
        $mahasiswaKelompok = MahasiswaKelompok::create([
            'kelompokId' => $idKelompok,
            'mahasiswaId' => $mahasiswa->id,
            'status_mahasiswa' => 'anggota',
            'tahun_daftar' => date('Y')
        ]);
        $judul = Judul::with('proposal')->where('id_kelompok', $idKelompok)->where('is_proposal', true)->first();
        $jenis = Jenis::where('nama_jenis', 'PESERTA/PROPOSAL')->first();
        if ($judul && $judul->proposal) {
            Kegiatan::create([
                'id_jenis' => $jenis->id,
                'id_file' => $judul->proposal->id,
                'id_kelompok' => $idKelompok,
                'id_mahasiswa' => $mahasiswa->id,
                'nama_kegiatan' => 'Proposal Program Kreativitas Mahasiswa',
                'kegiatan_inggris' => 'Student Creativity Program Proposal',
                'tanggal' => Carbon::now(),
                'status' => 'menunggu'
            ]);
        }
        return new RegisterAnggota($user, $mahasiswa, $mahasiswaKelompok);
    }
    public function postOldAnggota(array $data, $idKelompok): MahasiswaKelompok
    {

        $users = User::where('username', $data['username'])->with('mahasiswa')->firstOrFail();
        $alreadyAnggota = $users->mahasiswa->mahasiswaKelompok->where('tahun_daftar', date('Y'))->count();
        $anggota = MahasiswaKelompok::where('kelompokId', $idKelompok)->where('tahun_daftar', date('Y'))->count();
        if ($anggota >= 5) {
            throw new \Exception('Kelompok sudah memiliki anggota maksimal.');
        }
        if ($alreadyAnggota >= 2) {
            throw new \Exception('Mahasiswa tersebut sudah memiliki batas jumlah berkelompok');
        }
        $judul = Judul::with('proposal')->where('id_kelompok', $idKelompok)->where('is_proposal', true)->first();
        $jenis = Jenis::where('nama_jenis', 'PESERTA/PROPOSAL')->first();
        if ($judul && $judul->proposal) {
            Kegiatan::create([
                'id_jenis' => $jenis->id,
                'id_file' => $judul->proposal->id,
                'id_kelompok' => $idKelompok,
                'id_mahasiswa' => $users->mahasiswa->id,
                'nama_kegiatan' => 'Proposal Program Kreativitas Mahasiswa',
                'kegiatan_inggris' => 'Student Creativity Program Proposal',
                'tanggal' => Carbon::now(),
                'status' => 'menunggu'
            ]);
        }
        return MahasiswaKelompok::create([
            'kelompokId' => $idKelompok,
            'mahasiswaId' => $users->mahasiswa->id,
            'status_mahasiswa' => 'anggota',
            'tahun_daftar' => date('Y'),
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
        $proposal = ProposalFinal::create([
            'judulId' => $judulId,
            'nama_file' => $file_name,
        ]);
        $mahasiswa = MahasiswaKelompok::with('mahasiswa')->where('kelompokId', $id_kelompok)->get();
        $jenis = Jenis::where('nama_jenis', 'PESERTA/PROPOSAL')->firstOrFail();
        foreach ($mahasiswa as $mhs) {
            $alreadyUploaded = Kegiatan::with('proposal.judul')->where('id_mahasiswa', $mhs->mahasiswa->id)
                ->where('id_jenis', $jenis->id)
                ->where('id_kelompok', $id_kelompok)
                ->first();
            if (!$alreadyUploaded) {
                Kegiatan::create([
                    'id_jenis' => $jenis->id,
                    'id_file' => $proposal->id,
                    'id_kelompok' => $id_kelompok,
                    'id_mahasiswa' => $mhs->mahasiswa->id,
                    'nama_kegiatan' => 'Proposal Program Kreativitas Mahasiswa',
                    'kegiatan_inggris' => 'Student Creativity Program Proposal',
                    'tanggal' => Carbon::now(),
                    'status' => 'menunggu'
                ]);
            } else {
                $alreadyUploaded->update([
                    'id_file' => $proposal->id
                ]);
            }
        }
        return $proposal;
    }

    public function getMahasiswaOutKelompok($idKelompok, array $data): LengthAwarePaginator
    {
        return Mahasiswa::whereNotNull('email_verification_at')
            ->whereDoesntHave('mahasiswaKelompok', function ($query) use ($idKelompok) {
                $query->where('kelompokId', $idKelompok);
            })
            ->has('mahasiswaKelompok', '<', 2)
            ->whereHas('user', function ($query) use ($data) {
                $query->when(isset($data['nim']) && !empty($data['nim']), function ($q) use ($data) {
                    $q->where('username', 'like', '%' . $data['nim'] . '%');
                });
            })
            ->with([
                'user' => function ($query) {
                    $query->select('id', 'username'); // Optimasi: hanya ambil field yang diperlukan
                }
            ])
            ->select('mahasiswa.*') // Pastikan semua field mahasiswa yang dibutuhkan
            ->paginate(10);
    }
}
