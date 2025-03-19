<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProposalRequest;
use App\Models\ProposalFinal;
use App\Repositories\Kelompok\KetuaRepository;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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

                $this->ketuaRepository->postProposalFinal($file, $request->judulId, $id_kelompok);
            }
            return redirect()->route('mahasiswa.detail-kelompok', $id_kelompok)->with('success', 'Berhasil Melakukan Upload File');
        }
        catch (ValidationException $e) {
            return redirect()->back()->withErrors([$e->getMessage()]);
        }
    }





}
