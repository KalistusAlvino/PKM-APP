<?php

namespace App\Http\Controllers\MahasiswaController;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use App\Models\Mahasiswa;
use App\Repositories\SAC\KegiatanRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SacController extends Controller
{
    protected $kegiatanRepository;
    public function __construct(KegiatanRepository $kegiatanRepository) {
        $this->kegiatanRepository = $kegiatanRepository;
    }
    public function getHome(){

        $userId = Auth::user()->id;
        $mahasiswa = Mahasiswa::with('user')->where('userId',$userId)->firstOrFail();
        $id_mahasiswa = $mahasiswa->id;
        $kegiatan = $this->kegiatanRepository->getConfirmKegiatanByIdMahasiswa($id_mahasiswa);
        $key = 'sac-home';
        return view('dashboard.mahasiswa.sac.home',compact('key','mahasiswa','kegiatan'));
    }
    public function getKegiatan(){
        $userId = Auth::user()->id;
        $mahasiswa = Mahasiswa::where('userId',$userId)->firstOrFail()->id;
        $kegiatan = $this->kegiatanRepository->getUnconfirmKegiatanByIdMahasiswa($mahasiswa);
        $key = 'sac-kegiatan';
        return view('dashboard.mahasiswa.sac.kegiatan',compact('key','kegiatan'));
    }
}
