<?php

namespace App\Http\Controllers\DashboardController;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterDosenRequest;
use App\Http\Requests\RegisterKoordinatorRequest;
use App\Repositories\Biro\AkunRepository;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class BiroController extends Controller
{
    protected $akunRepository;
    public function __construct(AkunRepository $akunRepository)
    {
        $this->akunRepository = $akunRepository;
    }
    public function getDashboardBiro()
    {
        return view('dashboard.biro.dashboard');
    }

    public function getDosenAccountPage()
    {
        $dosen = $this->akunRepository->getDosen();
        return view('dashboard.biro.account.dosen', compact('dosen'));
    }
    public function getMahasiswaAccountPage(){
        $mahasiswa = $this->akunRepository->getMahasiswa();
        return view('dashboard.biro.account.mahasiswa',compact('mahasiswa'));
    }

    public function postDosenAccount(RegisterDosenRequest $request)
    {
        try {
            $validate = $request->validated();
            $this->akunRepository->postDosen($validate);

            return redirect()->route('biro.dosen-account-page')->with('success','Berhasil Menambahkan Data Dosen');
        } catch (ValidationException $e) {
            return redirect()->back()->with('error', collect($e->errors())->flatten()->first());
        }
    }

    public function getKoordinatorAccountPage()
    {
        $koordinator = $this->akunRepository->getKoordinator();
        return view('dashboard.biro.account.koordinator', compact('koordinator'));
    }

    public function postKoordinatorAccount(RegisterKoordinatorRequest $request)
    {
        try {
            $validate = $request->validated();

            $this->akunRepository->postKoordinator($validate);

            return redirect()->route('biro.koordinator-account-page')->with('success','Berhasil menambahkan data Koordinator');
        } catch (ValidationException $e) {
            dd($e);
            return redirect()->back()->with('errors', $e->getMessage());
        }
    }
}
