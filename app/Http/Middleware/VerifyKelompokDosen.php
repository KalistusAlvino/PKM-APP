<?php

namespace App\Http\Middleware;

use App\Models\Dosen;
use App\Models\Kelompok;
use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyKelompokDosen
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        $dosen =  Dosen::where('userId',$user->id)->firstOrFail();
        $kelompokId = $request->route('id_kelompok');

        $verifyKelompokDosen =  Kelompok::where('dospemId',$dosen->id)->where('id',$kelompokId)->exists();
        if (!$verifyKelompokDosen) {
            return redirect()->route('dosen.daftar-kelompok')
                ->withErrors(['error' => 'Anda bukan bagian dari kelompok ini!']);
        }
        return $next($request);
    }
}
