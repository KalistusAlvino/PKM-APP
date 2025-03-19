<?php

namespace App\Http\Controllers\DashboardController;

use App\Http\Controllers\Controller;
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
use App\Repositories\Kelompok\KetuaRepository;
use App\Repositories\Kelompok\ValidationRepository;
use App\Repositories\Mahasiswa\KelompokRepository;
use Auth;
use Dotenv\Exception\ValidationException;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class MahasiswaController extends Controller
{
    protected $kelompokRepository;
    protected $judulRepository;
    protected $anggotaRepository;
    protected $ketuaRepository;
    protected $validationRepository;
    public function __construct(KelompokRepository $kelompokRepository, JudulRepository $judulRepository, AnggotaRepository $anggotaRepository, KetuaRepository $ketuaRepository, ValidationRepository $validationRepository)
    {
        $this->kelompokRepository = $kelompokRepository;
        $this->judulRepository = $judulRepository;
        $this->anggotaRepository = $anggotaRepository;
        $this->ketuaRepository = $ketuaRepository;
        $this->validationRepository = $validationRepository;
    }
    public function getDashboardMahasiswa()
    {
        return view('dashboard.mahasiswa.dashboard');
    }
    public function getKelompokPage()
    {
        $kelompokList = $this->kelompokRepository->getKelompok();
        return view('dashboard.mahasiswa.kelompok', compact('kelompokList'));
    }

    public function getDetailKelompokPage($id)
    {
        $informasiKelompok = $this->kelompokRepository->detailKelompok($id);
        $mahasiswa = $this->kelompokRepository->getMahasiswaOutKelompok($id);
        $judul = $this->judulRepository->getJudulByKelompokId($id);
        $isKetua = $this->validationRepository->isKetua($informasiKelompok);
        $lessThan = $this->validationRepository->lessThan($informasiKelompok);
        $hasPendingInvite = $this->validationRepository->hasPendingInvite($informasiKelompok);
        $hasDospem = $this->validationRepository->hasDospem($informasiKelompok);
        $verifyKelompok = $this->validationRepository->verifyKelompok($informasiKelompok);
        $skema = SkemaPKM::get();
        $proposal = Judul::where('id_kelompok', $id)->with('proposal')->first();
        return view('dashboard.mahasiswa.detailkelompok', compact('informasiKelompok', 'mahasiswa', 'skema', 'judul', 'isKetua', 'lessThan', 'hasPendingInvite', 'hasDospem', 'verifyKelompok', 'proposal'));
    }

    public function getTambahAnggotaPage($id)
    {
        $id_kelompok = $id;
        $fakultas = Fakultas::all();
        $informasiKelompok = $this->kelompokRepository->detailKelompok($id);
        $mahasiswa = $this->kelompokRepository->getMahasiswaOutKelompok($id);
        return view('dashboard.mahasiswa.tambahanggota', compact('id_kelompok', 'fakultas', 'mahasiswa', 'informasiKelompok'));
    }
    public function getTambahDosenPage($id)
    {
        $id_kelompok = $id;
        $dospem = Dosen::paginate(10);
        return view('dashboard.mahasiswa.tambahdosen', compact('id_kelompok', 'dospem'));
    }

    public function storeAnggota(StoreAnggotaRequest $request, $id)
    {
        try {
            $validate = $request->validated();
            $this->ketuaRepository->postAnggota($validate, $id);

            return redirect()->route('mahasiswa.detail-kelompok', $id)->with('success', 'Berhasil Menambahkan Anggota');
        } catch (ValidationException $e) {
            return redirect()->back()->with('errors', 'Ada kesalahan saat melakukan tambah anggota');
        }
    }

    public function storeOldAnggota(StoreOldAnggotaRequest $request, $id)
    {
        try {
            $mahasiswaArray = json_decode($request->selectedMahasiswa, true);

            $this->ketuaRepository->postOldAnggota($mahasiswaArray, $id);

            return redirect()->route('mahasiswa.detail-kelompok', $id)->with('success', 'Berhasil Menambahkan Anggota');
        } catch (ValidationException $e) {
            return redirect()->back()->with('errors', $e->getMessage());
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

    public function downloadProposal($id_kelompok, $nama_file)
    {
        try {
            $path = 'proposal/' . $nama_file;
            $extension = pathinfo($path, PATHINFO_EXTENSION);
            $proposal = Judul::where('id_kelompok', $id_kelompok)->with('proposal')->first();
            $file_name = $proposal->detail_judul . "." . $extension;
            return Storage::disk('public')->download($path, $file_name);
        } catch (FileNotFoundException $e) {
            return redirect()->back()->with('error', 'File tidak ditemukan.');
        }
    }
}
