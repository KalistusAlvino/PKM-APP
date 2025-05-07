<?php

namespace App\Http\Controllers\DashboardController;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileMhsRequest;
use App\Models\Fakultas;
use App\Models\Mahasiswa;
use App\Models\MahasiswaKelompok;
use App\Repositories\Kelompok\AnggotaRepository;
use Exception;
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
        $alreadyKetua = MahasiswaKelompok::where('mahasiswaId', Auth::user()->mahasiswa->id)->where('status_mahasiswa','ketua')->where('tahun_daftar',date('Y'))->exists();
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

    public function getUpdateProfile(){
        $key = 'update-profile-mhs';
        $id_user = Auth::user()->id;
        $fakultas = Fakultas::all();
        $mhs = Mahasiswa::where('userId',$id_user)->firstOrFail();
        return view('dashboard.mahasiswa.update-profile',compact('key','mhs','fakultas'));
    }

    public function postUpdate(UpdateProfileMhsRequest $request) {
        try {
            $validate = $request->validated();
            $this->anggotaRepository->updateProfile($validate);

            return redirect()->route('mahasiswa.update-profile')->with('success','Berhasil melakukan update profile');
        }
        catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
