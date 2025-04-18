<?php

namespace App\Http\Controllers\DashboardController;

use App\Http\Controllers\Controller;
use App\Http\Requests\CariDospemRequest;
use App\Http\Requests\CariKetuaRequest;
use App\Http\Requests\CariNIMRequest;
use App\Http\Requests\StoreAnggotaRequest;
use App\Http\Requests\StoreJudulRequest;
use App\Http\Requests\StoreOldAnggotaRequest;
use App\Http\Requests\UpdateJudulRequest;
use App\Models\Dosen;
use App\Models\Fakultas;
use App\Models\Judul;
use App\Models\SkemaPKM;
use App\Repositories\Judul\JudulRepository;
use App\Repositories\Kelompok\AnggotaRepository;
use App\Repositories\Kelompok\KelompokDataRepository;
use App\Repositories\Kelompok\KetuaRepository;
use App\Repositories\Kelompok\ValidationRepository;
use Dotenv\Exception\ValidationException;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;


class MahasiswaController extends Controller
{
    protected $kelompokDataRepository;
    protected $judulRepository;
    protected $anggotaRepository;
    protected $ketuaRepository;
    protected $validationRepository;
    public function __construct(KelompokDataRepository $kelompokDataRepository, JudulRepository $judulRepository, AnggotaRepository $anggotaRepository, KetuaRepository $ketuaRepository, ValidationRepository $validationRepository)
    {
        $this->kelompokDataRepository = $kelompokDataRepository;
        $this->judulRepository = $judulRepository;
        $this->anggotaRepository = $anggotaRepository;
        $this->ketuaRepository = $ketuaRepository;
        $this->validationRepository = $validationRepository;
    }
    public function getDashboardMahasiswa()
    {
        $mahasiswaId =  Auth::user()->mahasiswa->id;
        $komentar = $this->judulRepository->getKomentarByMahasiswaId($mahasiswaId);
        $proposal = $this->judulRepository->getProposalByMahasiswaId($mahasiswaId);
        $key = 'dashboard';
        return view('dashboard.mahasiswa.dashboard',compact('key','komentar','proposal'));
    }
    public function getKelompokPage(CariKetuaRequest $request)
    {
        $validate = $request->validated();
        $kelompokList = $this->kelompokDataRepository->getKelompokByAuthMahasiswa($validate);
        $key = 'daftar_kelompok';
        return view('dashboard.mahasiswa.kelompok', compact('kelompokList','key'));
    }

    public function getDetailKelompokPage($id)
    {
        try {
            $informasiKelompok = $this->kelompokDataRepository->getDetailKelompokByIdKelompok($id);
            $judul = $this->judulRepository->getJudulByKelompokId($id);
            $isKetua = $this->validationRepository->isKetua($informasiKelompok);
            $lessThan = $this->validationRepository->lessThan($informasiKelompok);
            $hasPendingInvite = $this->validationRepository->hasPendingInvite($id);
            $hasDospem = $this->validationRepository->hasDospem($informasiKelompok);
            $verifyKelompok = $this->validationRepository->verifyKelompok($informasiKelompok);
            $skema = $this->anggotaRepository->getSkema();
            $proposal = $this->judulRepository->getProposal($id);
            $key = 'daftar_kelompok';
            return view('dashboard.mahasiswa.detailkelompok', compact('informasiKelompok', 'skema', 'judul', 'isKetua', 'lessThan', 'hasPendingInvite', 'hasDospem', 'verifyKelompok', 'proposal','key'));
        }
        catch (Exception $e) {
            return redirect()->route('mahasiswa.daftar-kelompok')->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function getTambahAnggotaPage($id,CariNIMRequest $request)
    {
        $validate = $request->validated();
        $id_kelompok = $id;
        $fakultas = Fakultas::all();
        $informasiKelompok = $this->kelompokDataRepository->getDetailKelompokByIdKelompok($id);
        $lessThan = $this->validationRepository->lessThan($informasiKelompok);
        $totalAnggota = count($informasiKelompok['anggota']);
        $mahasiswa = $this->ketuaRepository->getMahasiswaOutKelompok($id, $validate);
        $key = 'daftar_kelompok';
        return view('dashboard.mahasiswa.tambahanggota', compact('id_kelompok', 'fakultas', 'mahasiswa', 'informasiKelompok','lessThan','totalAnggota','key'));
    }
    public function getTambahDosenPage($id, CariDospemRequest $request)
    {
        $validate = $request->validated();
        $id_kelompok = $id;
        $dospem = $this->ketuaRepository->getDospem($validate);
        $key = 'daftar_kelompok';
        return view('dashboard.mahasiswa.tambahdosen', compact('id_kelompok', 'dospem','key'));
    }

    public function storeAnggota(StoreAnggotaRequest $request, $id)
    {
        try {
            $validate = $request->validated();
            $this->ketuaRepository->postAnggota($validate, $id);

            return redirect()->route('mahasiswa.detail-kelompok', $id)->with('success', 'Berhasil Menambahkan Anggota');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function storeOldAnggota(StoreOldAnggotaRequest $request, $id)
    {
        try {
            $validate = $request->validated();
            $this->ketuaRepository->postOldAnggota($validate, $id);

            return redirect()->route('mahasiswa.tambah-anggota-page', $id)->with('success', 'Berhasil Menambahkan Anggota');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function storeJudul(StoreJudulRequest $request, $idKelompok)
    {
        try {
            $validate = $request->validated();
            $id_user = Auth::user()->id;
            $this->judulRepository->postJudul($validate, $idKelompok, $id_user);
            return redirect()->route('mahasiswa.detail-kelompok', $idKelompok)->with('success', 'Berhasil Menambahkan Judul');
        } catch (ValidationException $e) {
            return redirect()->back()->with('errors', $e->getMessage());
        }
    }
    public function deleteJudul($id_kelompok, $id_judul)
    {
        try {
            $this->judulRepository->deleteJudul($id_judul);
            return redirect()->route('mahasiswa.detail-kelompok', $id_kelompok)->with('success', 'Berhasil Menghapus Judul');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors('errors', $e->getMessage());
        }
    }

    public function storeInvite($id_kelompok, $id_dosen)
    {
        try {
            $this->ketuaRepository->postInvite($id_kelompok, $id_dosen);
            return redirect()->route('mahasiswa.detail-kelompok', $id_kelompok)->with('success', 'Berhasil Melakukan Invite');
        } catch (ValidationException $e) {
            return redirect()->back()->with('errors', 'Ada kesalahan saat melakukan invite dosen');
        }
    }

    public function detailJudul($id_kelompok, $id_judul)
    {
        $judul = Judul::find($id_judul);

        return response()->json($judul);
    }

    public function updateJudul(UpdateJudulRequest $request, $id_kelompok, $id_judul)
    {
        try {
            $validate = $request->validated();
            $this->judulRepository->updateJudul($id_judul, $validate);

            return redirect()->route('mahasiswa.detail-kelompok', $id_kelompok)->with('success', 'Berhasil Melakukan Update Judul');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors('errors', $e->getMessage());
        }
    }


}
