<?php

namespace App\Repositories\Biro;

use App\Models\Judul;
use App\Models\Kelompok;
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
}
