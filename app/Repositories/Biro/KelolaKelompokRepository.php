<?php

namespace App\Repositories\Biro;

use App\Models\Judul;
use App\Models\Kelompok;
use App\Models\MahasiswaKelompok;
use App\Models\ProposalFinal;
use Illuminate\Support\Facades\Storage;

class KelolaKelompokRepository implements KelolaKelompokRepositoryInterface
{
    public function deleteKelompok($id_kelompok): ?Kelompok
    {
        $kelompok = Kelompok::findOrFail($id_kelompok);
        $proposal = Judul::with('proposal')->where('id_kelompok', $id_kelompok)->where('is_proposal', true)->first();
        if ($proposal) {
            $nama_proposal = $proposal->proposal->nama_file;
            $path = 'proposal/';
            Storage::disk('public')->delete($path . $nama_proposal);
        }
        $kelompok->delete();
        return $kelompok;
    }
    public function gantiKetuaKelompok($id_kelompok, $id_mk) {
        $mahasiswa = MahasiswaKelompok::where('id',$id_mk)->with('mahasiswa')->firstOrFail();
        $id_mahasiswa = $mahasiswa->mahasiswa->id;
        $alredyKetua = MahasiswaKelompok::where('mahasiswaId',$id_mahasiswa)->where('status_mahasiswa','ketua')->exists();
        if($alredyKetua) {
            throw new \Exception("Mahasiswa ". $mahasiswa->mahasiswa->name. " sudah menjadi ketua dikelompok lain!");
        }
        MahasiswaKelompok::where('kelompokId', $id_kelompok)->where('status_mahasiswa','ketua')->update([
            'status_mahasiswa' => 'anggota'
        ]);
        MahasiswaKelompok::where('id',$id_mk)->update([
            'status_mahasiswa' => 'ketua'
        ]);
    }
}
