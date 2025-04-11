<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProposalRequest;
use App\Models\Mahasiswa;
use App\Repositories\Kelompok\KetuaRepository;
use Dotenv\Exception\ValidationException;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;

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
            if($request->hasFile('nama_file')){
                $file = $request->file('nama_file');

                $this->ketuaRepository->postProposalFinal($file, $validate['judulId'], $id_kelompok);
            }
            return redirect()->route('mahasiswa.detail-kelompok', $id_kelompok)->with('success', 'Berhasil Melakukan Upload File');
        }
        catch (Exception $e) {
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

}
