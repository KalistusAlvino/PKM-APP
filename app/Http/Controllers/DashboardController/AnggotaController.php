<?php

namespace App\Http\Controllers\DashboardController;

use App\Http\Controllers\Controller;
use App\Models\MahasiswaKelompok;
use App\Repositories\Kelompok\AnggotaRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AnggotaController extends Controller
{
    protected $anggotaRepository;

    public function __construct(AnggotaRepository $anggotaRepository) {
        $this->anggotaRepository = $anggotaRepository;
    }
    public function getDaftarKetuaPage()
    {
        $userId = Auth::user()->mahasiswa->id;
        $alreadyKetua = MahasiswaKelompok::where('mahasiswaId', $userId)->where('status_mahasiswa','ketua')->exists();
        $key = 'mendaftar';
        return view('dashboard.mahasiswa.daftar-ketua',compact('alreadyKetua','key'));
    }

    public function postDaftarKetua(){
        try {
            $idMahasiswa = Auth::user()->mahasiswa->id;
            $this->anggotaRepository->storeKetua($idMahasiswa);
            return redirect()->route('mahasiswa.daftar-ketua')->with('success','Berhasil mendaftar sebagai ketua');
        }
        catch(ValidationException $e) {
            return redirect()->back()->withErrors(['error' => 'Ada kesalahan saat mendaftar']);
        }
    }
}
