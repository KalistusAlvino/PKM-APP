<?php

namespace App\Http\Controllers\DashboardController;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\MahasiswaKelompok;
use Auth;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function getDashboardMahasiswa()
    {
        return view('dashboard.mahasiswa.dashboard');
    }
    public function getKelompokPage()
    {
        $mahasiswa = Mahasiswa::where('userId', Auth::id())->first();

        // Ambil daftar kelompok tempat mahasiswa ini tergabung
        $daftarKelompok = MahasiswaKelompok::where('mahasiswaId', $mahasiswa->id)
            ->with('mahasiswa')
            ->get();

        // Ambil ID kelompok dari daftar kelompok yang mahasiswa login ikuti
        $kelompokIds = $daftarKelompok->pluck('kelompokId');

        // Ambil semua anggota dalam kelompok-kelompok tersebut
        $anggotaKelompok = MahasiswaKelompok::whereIn('kelompokId', $kelompokIds)
            ->with('mahasiswa')
            ->get()
            ->groupBy('kelompokId');

        // Sorting agar kelompok di mana mahasiswa login adalah ketua muncul di urutan pertama
        $daftarKelompok = $daftarKelompok->sortByDesc(function ($kelompok) use ($mahasiswa) {
            return $kelompok->status_mahasiswa === 'ketua' ? 1 : 0;
        });

        return view('dashboard.mahasiswa.kelompok', compact('daftarKelompok', 'anggotaKelompok'));
    }
}
