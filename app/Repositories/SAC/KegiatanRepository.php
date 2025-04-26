<?php
namespace App\Repositories\SAC;

use App\Models\Kegiatan;
use Illuminate\Support\Collection;

class KegiatanRepository implements KegiatanRepositoryInterface {
    public function getUnconfirmKegiatan(): Collection {
        return  Kegiatan::with('jenis.tingkat.kategori','mahasiswa')->where('status','menunggu')->get();
    }
    public function getUnconfirmKegiatanByIdMahasiswa($id): Collection {
        return Kegiatan::with('jenis.tingkat.kategori')->where('id_mahasiswa',$id)->where('status','menunggu')->get();
    }
    public function getConfirmKegiatanByIdMahasiswa($id): Collection {
        return Kegiatan::with('jenis.tingkat.kategori')->where('id_mahasiswa',$id)->where('status','acc')->get();
    }
    public function findById($id): Kegiatan {
        return Kegiatan::findOrFail($id);
    }
    public function updateStatusKegiatan($id): ?Kegiatan {
        $kegiatan = $this->findById($id);
        if($kegiatan){
            $kegiatan->update([
                'status' => 'acc'
            ]);
        }
        return $kegiatan;
    }
}
