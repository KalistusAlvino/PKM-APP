<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProposalRequest;
use App\Mail\AnggotaVerificationMail;
use App\Models\Mahasiswa;
use App\Repositories\Kelompok\KetuaRepository;
use Dotenv\Exception\ValidationException;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Str;

class KetuaController extends Controller
{
    protected $ketuaRepository;
    public function __construct(KetuaRepository $ketuaRepository)
    {
        $this->ketuaRepository = $ketuaRepository;
    }

    public function deleteAnggota($id_kelompok, $id_mk)
    {
        try {
            $this->ketuaRepository->deleteAnggota($id_mk);

            return redirect()->route('mahasiswa.detail-kelompok', $id_kelompok)->with('success', 'Berhasil Menghapus Anggota');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors([$e->getMessage()]);
        }
    }
    public function deleteDospem($id_kelompok)
    {
        try {
            $this->ketuaRepository->deleteDospem($id_kelompok);

            return redirect()->route('mahasiswa.detail-kelompok', $id_kelompok)->with('success', 'Berhasil Menghapus Dosen Pembimbing');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors([$e->getMessage()]);
        }
    }

    public function storeFile($id_kelompok, ProposalRequest $request)
    {
        try {
            $validate = $request->validated();
            if ($request->hasFile('nama_file')) {
                $file = $request->file('nama_file');

                $this->ketuaRepository->postProposalFinal($file, $validate['judulId'], $id_kelompok);
            }
            return redirect()->route('mahasiswa.detail-kelompok', $id_kelompok)->with('success', 'Berhasil Melakukan Upload File');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function getMahasiswaOutKelompok($idKelompok): LengthAwarePaginator
    {
        $mahasiswaBukanAnggota = Mahasiswa::whereDoesntHave('mahasiswaKelompok', function ($query) use ($idKelompok) {
            $query->where('kelompokId', $idKelompok);
        })
            ->with('user')
            ->paginate(10)
            ->through(function ($item) {
                return [
                    'nama' => $item->name,
                    'username' => $item->user->username ?? null,
                    'prodi' => $item->prodi,
                ];
            });

        return $mahasiswaBukanAnggota;
    }
    public function emailAnggota($token, $id_kelompok)
    {
        $mhs = Mahasiswa::where('email_verification_token', $token)->firstOrFail();
        $key = 'daftar_kelompok';
        return view('dashboard.mahasiswa.reverivied-anggota', compact('mhs', 'id_kelompok', 'key'));
    }

    public function updateEmailAnggota(Request $request, $token, $id_kelompok)
    {
        try {
            $validated = $request->validate([
                'email' => 'required',
                'email',
                Rule::unique('mahasiswa', 'email')->ignore($token, 'email_verification_token'),
            ]);

            $newToken = Str::uuid();
            $mahasiswa = Mahasiswa::where('email_verification_token', $token)->firstOrFail();
            $mahasiswa->update([
                'email_verification_token' => $newToken,
                'email' => $validated['email']
            ]);
            Mail::to($validated['email'])->send(new AnggotaVerificationMail($mahasiswa));
            return redirect()->route('mahasiswa.detail-kelompok', $id_kelompok)->with('success', 'Berhasil mengganti email anggota');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function resendEmailAnggota($token, $id_kelompok)
    {
        try {
            $newToken = Str::uuid();
            $mahasiswa = Mahasiswa::where('email_verification_token', $token)->firstOrFail();
            $mahasiswa->update([
                'email_verification_token' => $newToken,
            ]);
            Mail::to($mahasiswa->email)->send(new AnggotaVerificationMail($mahasiswa));
             return redirect()->route('mahasiswa.detail-kelompok', $id_kelompok)->with('success', 'Berhasil mengirim ulang email verifikasi anggota');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

}
