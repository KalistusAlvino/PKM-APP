<?php

namespace App\Http\Controllers;

use App\Http\Requests\CariKetuaRequest;
use App\Models\Kelompok;
use App\Repositories\Biro\KelolaKelompokRepository;
use App\Repositories\Judul\JudulRepository;
use App\Repositories\Kelompok\KelompokDataRepository;
use App\Repositories\Kelompok\ValidationRepository;
use Exception;
use Illuminate\Http\Request;

class BiroKelompokController extends Controller
{
    protected $kelompokDataRepository;
    protected $judulRepository;
    protected $validationRepository;
    protected $kelolaKelompokRepository;
    public function __construct(KelompokDataRepository $kelompokDataRepository,JudulRepository $judulRepository, ValidationRepository $validationRepository, KelolaKelompokRepository $kelolaKelompokRepository) {
        $this->kelompokDataRepository = $kelompokDataRepository;
        $this->judulRepository = $judulRepository;
        $this->validationRepository = $validationRepository;
        $this->kelolaKelompokRepository = $kelolaKelompokRepository;
    }
    public function getKelompokPage(CariKetuaRequest $request){
        $validated = $request->validated();
        $key = 'daftar-kelompok';
        $daftarKelompok = $this->kelompokDataRepository->getAllKelompok($validated);
        return view('dashboard.biro.kelompok.daftar-kelompok',compact('key','daftarKelompok','validated'));
    }

    public function detailKelompok($id_kelompok) {
        try {
            $key = 'daftar-kelompok';
            $informasiKelompok = $this->kelompokDataRepository->getDetailKelompokByIdKelompok($id_kelompok);
            $judul = $this->judulRepository->getJudulByKelompokId($id_kelompok);
            $proposal = $this->judulRepository->getProposal($id_kelompok);
            $hasDospem = $this->validationRepository->hasDospem($informasiKelompok);
            $hasPendingInvite = $this->validationRepository->hasPendingInvite($id_kelompok);
            return view('dashboard.biro.kelompok.detail-kelompok',compact('informasiKelompok','judul','key','proposal','hasDospem','hasPendingInvite'));
        }
        catch (Exception $e) {
            return redirect()->route('biro.daftar-kelompok-page')->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function deleteKelompok($id_kelompok) {
        try {
            $this->kelolaKelompokRepository->deleteKelompok($id_kelompok);
            return redirect()->route('biro.daftar-kelompok-page')->with('success','Berhasil menghapus data kelompok');
        }
        catch(Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
