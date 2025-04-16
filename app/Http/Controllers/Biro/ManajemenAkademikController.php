<?php

namespace App\Http\Controllers\Biro;

use App\Http\Controllers\Controller;
use App\Http\Requests\FakultasRequest;
use App\Http\Requests\ProdiRequest;
use App\Http\Requests\SkemaPKMRequest;
use App\Http\Requests\UpdateProdiRequest;
use App\Repositories\Biro\KelolaAkademikRepository;
use App\Repositories\Judul\JudulRepository;
use Exception;

class ManajemenAkademikController extends Controller
{
    protected $judulRepository;

    protected $kelolaAkademikRepository;

    public function __construct(JudulRepository $judulRepository, KelolaAkademikRepository $kelolaAkademikRepository)
    {
        $this->judulRepository = $judulRepository;
        $this->kelolaAkademikRepository = $kelolaAkademikRepository;
    }
    public function getPage()
    {
        $key = 'manajemen-akademik';
        $skema = $this->judulRepository->getSkema();
        $fakultas = $this->kelolaAkademikRepository->getFakultas();
        $prodi = $this->kelolaAkademikRepository->getProdi();
        return view('dashboard.biro.akademik-pengembangan.manajemen-akademik', compact('key', 'skema', 'fakultas', 'prodi'));
    }

    public function postSkema(SkemaPKMRequest $request)
    {
        try {
            $validate = $request->validated();
            $this->kelolaAkademikRepository->postSkema($validate);
            return redirect()->route('biro.getPage-manajemen-akademik')->with('success', 'Berhasil menambahkan Skema baru');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function postFakultas(FakultasRequest $request)
    {
        try {
            $validate = $request->validated();
            $this->kelolaAkademikRepository->postFakultas($validate);
            return redirect()->route('biro.getPage-manajemen-akademik')->with('success', 'Berhasil menambahkan Fakultas baru');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function postProdi(ProdiRequest $request)
    {
        try {
            $validate = $request->validated();
            $this->kelolaAkademikRepository->postProdi($validate);
            return redirect()->route('biro.getPage-manajemen-akademik')->with('success', 'Berhasil menambahkan Program Studi baru');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function deleteSkema($id_skema)
    {
        try {
            $this->kelolaAkademikRepository->deleteSkema($id_skema);
            return redirect()->route('biro.getPage-manajemen-akademik')->with('success', 'Berhasil melakukan hapus skema');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function deleteFakultas($fakultas)
    {
        try {
            $this->kelolaAkademikRepository->deleteFakultas($fakultas);
            return redirect()->route('biro.getPage-manajemen-akademik')->with('success', 'Berhasil melakukan hapus fakultas');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function deleteProdi($id_prodi)
    {
        try {
            $this->kelolaAkademikRepository->deleteProdi($id_prodi);
            return redirect()->route('biro.getPage-manajemen-akademik')->with('success', 'Berhasil melakukan hapus program studi');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function detailSkema($id_skema)
    {
        $skema = $this->kelolaAkademikRepository->findSkemaById($id_skema);
        return response()->json(["data" => $skema]);
    }
    public function detailFakultas($id_fakultas)
    {
        $fakultas = $this->kelolaAkademikRepository->findFakultasById($id_fakultas);
        return response()->json(["data" => $fakultas]);
    }
    public function detailProdi($id_prodi)
    {
        $prodi = $this->kelolaAkademikRepository->findProdiById($id_prodi);
        return response()->json(["data" => $prodi]);
    }

    public function updateSkema($id_skema, SkemaPKMRequest $request) {
        try {
            $validate = $request->validated();
            $this->kelolaAkademikRepository->updateSkema($validate, $id_skema);
            return redirect()->route('biro.getPage-manajemen-akademik')->with('success', 'Berhasil melakukan update skema');
        }
        catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function updateFakultas($id_fakultas, FakultasRequest $request) {
        try {
            $validate = $request->validated();
            $this->kelolaAkademikRepository->updateFakultas($validate, $id_fakultas);
            return redirect()->route('biro.getPage-manajemen-akademik')->with('success', 'Berhasil melakukan update fakultas');
        }
        catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function updateProdi($id_prodi, UpdateProdiRequest $request) {
        try {
            $validate = $request->validated();
            $this->kelolaAkademikRepository->updateProdi($validate, $id_prodi);
            return redirect()->route('biro.getPage-manajemen-akademik')->with('success', 'Berhasil melakukan update prodi');
        }
        catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
