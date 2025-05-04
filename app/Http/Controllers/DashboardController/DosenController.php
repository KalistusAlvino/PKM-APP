<?php

namespace App\Http\Controllers\DashboardController;

use App\Charts\uploadedProposalJudulByKelompokDosen;
use App\Http\Controllers\Controller;
use App\Http\Requests\CariKetuaRequest;
use App\Http\Requests\KomentarRequest;
use App\Http\Requests\UpdateKomentarRequest;
use App\Models\Invite;
use App\Models\Judul;
use App\Models\Kelompok;
use App\Repositories\Dosen\InviteRepository;
use App\Repositories\Judul\JudulRepository;
use App\Repositories\Kelompok\KelompokDataRepository;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class DosenController extends Controller
{
    protected $inviteRepository;
    protected $kelompokDataRepository;

    protected $judulRepository;

    public function __construct(InviteRepository $inviteRepository, KelompokDataRepository $kelompokDataRepository, JudulRepository $judulRepository)
    {
        $this->inviteRepository = $inviteRepository;
        $this->kelompokDataRepository = $kelompokDataRepository;
        $this->judulRepository = $judulRepository;
    }

    public function getDashboardDosen(uploadedProposalJudulByKelompokDosen $chart)
    {
        $barChart = $chart->build();
        $dosenId = Auth::user()->dosen->id;
        $kelompokBimbingan = Kelompok::where('dospemId', $dosenId)->count();
        $invite = Invite::where('dospemId', $dosenId)->count();
        $judul = $this->judulRepository->getJudulByDosenId($dosenId);
        $key = 'dashboard';
        return view('dashboard.dosen.dashboard', compact('key', 'kelompokBimbingan', 'invite', 'barChart', 'judul'));
    }

    public function getUndanganDosen()
    {
        $dosen_id = Auth::user()->dosen->id;
        $invite = $this->inviteRepository->getInvite($dosen_id);
        $key = 'daftar_undangan';
        return view('dashboard.dosen.undangan', compact('invite', 'key'));
    }

    public function getDaftarKelompok(CariKetuaRequest $request)
    {
        $validate = $request->validated();
        $daftarKelompok = $this->kelompokDataRepository->getKelompokByAuthDosen($validate);
        $key = 'daftar_kelompok';
        return view('dashboard.dosen.kelompok', compact('daftarKelompok', 'key'));
    }

    public function getDetailKelompok($id)
    {
        $informasiKelompok = $this->kelompokDataRepository->getDetailKelompokByIdKelompok($id);
        $judul = $this->judulRepository->getJudulByKelompokId($id);
        $proposal = $this->judulRepository->getProposal($id);
        $key = 'daftar_kelompok';
        return view('dashboard.dosen.detailkelompok', compact('informasiKelompok', 'judul', 'proposal', 'key'));
    }
    public function terimaUndangan($id_kelompok, $id_dosen)
    {
        try {
            $this->inviteRepository->insertDospem($id_kelompok, $id_dosen);

            return redirect()->route('dosen.daftar-undangan')->with('success', 'Berhasil Menerima Undangan Mahasiswa');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Ada kesalahan saat menerima undangan']);
        }
    }
    public function detailUndangan($id_undangan) {
        try {
            $invite =  $this->inviteRepository->detailUndangan($id_undangan);
            return response()->json($invite);
        } catch (Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function tolakUndangan($id_undangan)
    {
        try {
            $this->inviteRepository->tolakUndangan($id_undangan);
            return redirect()->route('dosen.daftar-undangan')->with('success', 'Berhasil melakukan tolak undangan Mahasiswa');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function postKomentar(KomentarRequest $request, $id_judul, $id_kelompok)
    {
        try {
            $validate = $request->validated();
            $id_user = Auth::user()->id;
            $this->judulRepository->postKomentar($validate, $id_judul, $id_user);

            return redirect()->route('dosen.detail-kelompok', $id_kelompok)->with('success', 'Berhasil menambahkan komentar');
        } catch (ValidationException) {
            return redirect()->back()->withErrors(['error' => 'Ada kesalahan saat menambahkan komentar']);
        }
    }

    public function deleteKomentar($id_kelompok, $id_komentar)
    {
        try {
            $this->judulRepository->deleteKomentar($id_komentar);
            return redirect()->route('dosen.detail-kelompok', $id_kelompok)->with('success', 'Berhasil menghapus komentar');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors(['error' => 'Ada kesalahan saat menghapus komentar']);
        }
    }

    public function updateKomentar(UpdateKomentarRequest $request, $id_komentar, $id_kelompok)
    {
        try {
            $validated = $request->validated();
            $this->judulRepository->updateKomentar($validated, $id_komentar);
            return redirect()->route('dosen.detail-kelompok', $id_kelompok)->with('success', 'Berhasil melakukan update komentar');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
