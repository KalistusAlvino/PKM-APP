<?php

namespace App\Http\Controllers\Biro;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use App\Repositories\SAC\KegiatanRepository;
use Exception;
use Illuminate\Http\Request;

class ManajemenSACController extends Controller
{
    protected $kegiatanRepository;
    public function __construct(KegiatanRepository $kegiatanRepository) {
        $this->kegiatanRepository = $kegiatanRepository;
    }
    public function kegiatanMahasiswa(){
        $key = 'kegiatan-mahasiswa';
        $kegiatan = $this->kegiatanRepository->getUnconfirmKegiatan();
        return view('dashboard.biro.sac.kegiatan-mahasiswa',compact('key','kegiatan'));
    }
    public function updateStatusKegiatan($id) {
        try {
            $this->kegiatanRepository->updateStatusKegiatan($id);
            return redirect()->route('biro.kegiatan-mahasiswa-page')->with('success','Berhasil melakukan update status kegiatan');
        }
        catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
