<?php

namespace App\Http\Controllers\DashboardController;

use App\Http\Controllers\Controller;
use App\Http\Requests\KomentarRequest;
use App\Models\Invite;
use App\Models\Komentar;
use App\Repositories\Dosen\InviteRepository;
use App\Repositories\Dosen\KelompokDosenRepository;
use App\Repositories\Judul\JudulRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class DosenController extends Controller
{
    protected $inviteRepository;
    protected $kelompokDosenRepository;

    protected $judulRepository;

    public function __construct(InviteRepository $inviteRepository, KelompokDosenRepository $kelompokDosenRepository, JudulRepository $judulRepository)
    {
        $this->inviteRepository = $inviteRepository;
        $this->kelompokDosenRepository = $kelompokDosenRepository;
        $this->judulRepository = $judulRepository;
    }

    public function getDashboardDosen()
    {
        return view('dashboard.dosen.dashboard');
    }

    public function getUndanganDosen()
    {
        $dosen_id = Auth::user()->dosen->id;
        $invite = $this->inviteRepository->getInvite($dosen_id);
        return view('dashboard.dosen.undangan', compact('invite'));
    }

    public function getDaftarKelompok()
    {
        $daftarKelompok = $this->kelompokDosenRepository->getKelompok();
        return view('dashboard.dosen.kelompok', compact('daftarKelompok'));
    }

    public function getDetailKelompok($id)
    {
        $informasiKelompok = $this->kelompokDosenRepository->detailKelompok($id);
        $judul = $this->judulRepository->getJudulByKelompokId($id);
        return view('dashboard.dosen.detailkelompok', compact('informasiKelompok', 'judul'));
    }
    public function terimaUndangan($id_kelompok, $id_dosen)
    {
        try {
            $this->inviteRepository->insertDospem($id_kelompok, $id_dosen);

            return redirect()->route('dosen.daftar-undangan')->with('success', 'Berhasil Menerima Undangan Mahasiswa');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors(['error' => 'Ada kesalahan saat menerima undangan']);
        }
    }

    public function postKomentar(KomentarRequest $request, $id_judul, $id_kelompok)
    {
        try {
            $validate = $request->validated();
            $id_user = Auth::user()->id;
            $this->judulRepository->postKomentar($validate,$id_judul,$id_user);

            return redirect()->route('dosen.detail-kelompok', $id_kelompok)->with('success', 'Berhasil menambahkan komentar');
        } catch (ValidationException) {
            return redirect()->back()->withErrors(['error' => 'Ada kesalahan saat menambahkan komentar']);
        }
    }
}
