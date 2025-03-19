<?php

namespace App\Http\Controllers\DashboardController;

use App\Http\Controllers\Controller;
use App\Http\Requests\KomentarRequest;
use App\Models\Judul;
use App\Models\Kelompok;
use App\Models\User;
use App\Repositories\Judul\JudulRepository;
use Auth;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;

class KoordinatorController extends Controller
{
    protected $judulRepository;
    public function __construct(JudulRepository $judulRepository) {
        $this->judulRepository = $judulRepository;
    }
    public function getDashboardKoordinator()
    {
        return view('dashboard.koordinator.dashboard');
    }
    public function getDaftarKelompok()
    {
        $daftarKelompok = Kelompok::with(['mahasiswaKelompok.mahasiswa'])
            ->get()
            ->map(function ($kelompok) {
                return [
                    'id_kelompok' => $kelompok->id,
                    'ketua' => $kelompok->mahasiswaKelompok
                        ->where('status_mahasiswa', 'ketua')
                        ->first()?->mahasiswa->name ?? 'Tidak ada ketua',
                    'total_anggota' => $kelompok->mahasiswaKelompok->count(),
                    'anggota' => $kelompok->mahasiswaKelompok
                        ->where('status_mahasiswa', 'anggota')
                        ->map(function ($item) {
                            return [
                                'nama' => $item->mahasiswa->name,
                                'status' => $item->status_mahasiswa,
                            ];
                        }),
                ];
            });

        return view('dashboard.koordinator.kelompok', compact('daftarKelompok'));
    }

    public function getDetailKelompok($id)
    {
        $kelompok = Kelompok::where('id', $id)->with('mahasiswaKelompok.mahasiswa.user', 'dosen')->first();
        $informasiKelompok = [];
        if ($kelompok) {
            $ketua = $kelompok->mahasiswaKelompok
                ->where('status_mahasiswa', 'ketua')
                ->first();

            $anggota = $kelompok->mahasiswaKelompok
                ->where('status_mahasiswa', 'anggota')
                ->map(function ($item) {
                    return [
                        'nama' => $item->mahasiswa->name,
                        'username' => $item->mahasiswa->user->username ?? null,
                    ];
                });

            $dosen = $kelompok->dosen;
            $informasiKelompok = [
                'id_kelompok' => $kelompok->id,
                'ketua' => ['nama' => $ketua ? $ketua->mahasiswa->name : null, 'username' => $ketua->mahasiswa->user->username],
                'anggota' => $anggota,
                'dosen' => $dosen->name ?? null
            ];
        }
        $judul = $this->judulRepository->getJudulByKelompokId($id);

        return view('dashboard.koordinator.detailkelompok', compact('informasiKelompok','judul'));
    }

    public function postKomentar(KomentarRequest $request,$id_judul, $id_kelompok){
        try {
            $validate = $request->validated();
            $id_user = Auth::user()->id;
            $this->judulRepository->postKomentar($validate,$id_judul, $id_user);
            return redirect()->route('koordinator.detail-kelompok', $id_kelompok)->with('success', 'Berhasil menambahkan komentar');
        }
        catch(ValidationException $e) {
            return redirect()->back()->withErrors(['error' => 'Ada kesalahan saat menambahkan komentar']);
        }
    }

}
