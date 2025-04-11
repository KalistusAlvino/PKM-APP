<?php

namespace App\Http\Controllers\DashboardController;

use App\Http\Controllers\Controller;
use App\Http\Requests\CariKetuaRequest;
use App\Http\Requests\KomentarRequest;
use App\Http\Requests\UpdateKomentarRequest;
use App\Models\Judul;
use App\Repositories\Judul\JudulRepository;
use App\Repositories\Kelompok\KelompokDataRepository;
use App\Repositories\Kelompok\ValidationRepository;
use Dotenv\Exception\ValidationException;
use Exception;
use Illuminate\Support\Facades\Auth;

class KoordinatorController extends Controller
{
    protected $judulRepository;
    protected $kelompokDataRepository;
    protected $validationRepository;
    public function __construct(JudulRepository $judulRepository, KelompokDataRepository $kelompokDataRepository, ValidationRepository $validationRepository)
    {
        $this->judulRepository = $judulRepository;
        $this->kelompokDataRepository = $kelompokDataRepository;
        $this->validationRepository = $validationRepository;
    }
    public function getDashboardKoordinator()
    {
        $key = 'dashboard';
        return view('dashboard.koordinator.dashboard',compact('key'));
    }
    public function getDaftarKelompok(CariKetuaRequest $request)
    {
        $validate = $request->validated();
        $daftarKelompok = $this->kelompokDataRepository->getAllKelompok($validate);
        $key = 'daftar_kelompok';
        return view('dashboard.koordinator.kelompok', compact('daftarKelompok','key'));
    }

    public function getDetailKelompok($id)
    {
        try {
            $key = 'daftar-kelompok';
            $informasiKelompok = $this->kelompokDataRepository->getDetailKelompokByIdKelompok($id);
            $judul = $this->judulRepository->getJudulByKelompokId($id);
            $proposal = $this->judulRepository->getProposal($id);
            $hasDospem = $this->validationRepository->hasDospem($informasiKelompok);
            $hasPendingInvite = $this->validationRepository->hasPendingInvite($id);
            return view('dashboard.koordinator.detailkelompok',compact('informasiKelompok','judul','key','proposal','hasDospem','hasPendingInvite'));
        }
        catch (Exception $e) {
            return redirect()->route('koordinator.daftar-kelompok')->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function postKomentar(KomentarRequest $request, $id_judul, $id_kelompok)
    {
        try {
            $validate = $request->validated();
            $id_user = Auth::user()->id;
            $this->judulRepository->postKomentar($validate, $id_judul, $id_user);
            return redirect()->route('koordinator.detail-kelompok', $id_kelompok)->with('success', 'Berhasil menambahkan komentar');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors(['error' => 'Ada kesalahan saat menambahkan komentar']);
        }
    }

    public function deleteKomentar($id_kelompok, $id_komentar)
    {
        try {
            $this->judulRepository->deleteKomentar($id_komentar);
            return redirect()->route('koordinator.detail-kelompok', $id_kelompok)->with('success', 'Berhasil menghapus komentar');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors(['error' => 'Ada kesalahan saat menghapus komentar']);
        }
    }

    public function updateKomentar(UpdateKomentarRequest $request,$id_komentar, $id_kelompok) {
        try {
            $validated = $request->validated();
            $this->judulRepository->updateKomentar($validated, $id_komentar);
            return redirect()->route('koordinator.detail-kelompok', $id_kelompok)->with('success', 'Berhasil melakukan update komentar');
        }
        catch (Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
