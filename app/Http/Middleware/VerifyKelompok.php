<?php

namespace App\Http\Middleware;

use App\Models\Mahasiswa;
use App\Models\MahasiswaKelompok;
use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyKelompok
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        $kelompokId = $request->route('id_kelompok');

        if ($user->role === 'dosen') {
            return redirect()->route('dosen.dashboard')->withErrors(['error' => 'Akses hanya untuk mahasiswa']);
        } elseif ($user->role === 'biro') {
            return redirect()->route('biro.dashboard')->withErrors(['error' => 'Akses hanya untuk mahasiswa']);
        } elseif ($user->role === 'koordinator') {
            return redirect()->route('koordinator.dashboard')->withErrors(['error' => 'Akses hanya untuk mahasiswa']);
        }
        $mahasiswa = Mahasiswa::where('userId', $user->id)->first();
        $verifyKelompok = MahasiswaKelompok::where('mahasiswaId', $mahasiswa->id)
            ->where('kelompokId', $kelompokId)
            ->exists();
            if (!$verifyKelompok) {
                return redirect()->route('mahasiswa.daftar-kelompok')
                    ->withErrors(['error' => 'Anda bukan bagian dari kelompok ini!']);
            }

        return $next($request);
    }
}
