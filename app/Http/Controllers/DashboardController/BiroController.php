<?php

namespace App\Http\Controllers\DashboardController;

use App\Charts\UploadedProposalBySkemaChart;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordByBiroRequest;
use App\Http\Requests\RegisterDosenRequest;
use App\Http\Requests\RegisterKoordinatorRequest;
use App\Models\Dosen;
use App\Models\Fakultas;
use App\Models\Kelompok;
use App\Models\Mahasiswa;
use App\Models\SkemaPkm;
use App\Repositories\Biro\AkunRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class BiroController extends Controller
{
    protected $akunRepository;
    public function __construct(AkunRepository $akunRepository)
    {
        $this->akunRepository = $akunRepository;
    }
    public function getDashboardBiro(UploadedProposalBySkemaChart $chart)
    {
        $barChart = $chart->build();
        $mahasiswa = Mahasiswa::count();
        $dosen = Dosen::count();
        $kelompok = Kelompok::count();
        $skema = SkemaPkm::count();
        $key = 'dashboard';
        return view('dashboard.biro.dashboard',compact('key','barChart','mahasiswa','dosen','kelompok','skema'));
    }

    public function getDosenAccountPage()
    {
        $skema = SkemaPkm::all();
        $fakultas = Fakultas::all();
        $key = 'dosen-account';
        $dosen = $this->akunRepository->getDosen();
        return view('dashboard.biro.account.dosen', compact('dosen', 'fakultas', 'skema','key'));
    }
    public function getMahasiswaAccountPage()
    {
        $key = 'mahasiswa-account';
        $mahasiswa = $this->akunRepository->getMahasiswa();
        $fakultas = Fakultas::all();
        return view('dashboard.biro.account.mahasiswa', compact('mahasiswa', 'fakultas','key'));
    }

    public function postDosenAccount(RegisterDosenRequest $request)
    {
        try {
            $validate = $request->validated();
            $this->akunRepository->postDosen($validate);

            return redirect()->route('biro.dosen-account-page')->with('success', 'Berhasil Menambahkan Data Dosen');
        } catch (ValidationException $e) {
            return redirect()->back()->with('error', collect($e->errors())->flatten()->first());
        }
    }

    public function getKoordinatorAccountPage()
    {
        $key = 'koordinator-account';
        $koordinator = $this->akunRepository->getKoordinator();
        return view('dashboard.biro.account.koordinator', compact('koordinator','key'));
    }

    public function postKoordinatorAccount(RegisterKoordinatorRequest $request)
    {
        try {
            $validate = $request->validated();

            $this->akunRepository->postKoordinator($validate);

            return redirect()->route('biro.koordinator-account-page')->with('success', 'Berhasil menambahkan data Koordinator');
        } catch (ValidationException $e) {
            dd($e);
            return redirect()->back()->with('errors', $e->getMessage());
        }
    }

    public function gantiPasswordMhs(ChangePasswordByBiroRequest $request)
    {
        try {
            $validate = $request->validated();

            $this->akunRepository->gantiPasswordMhs($validate);
            return redirect()->back()->with('success', 'Berhasil mengganti password mahasiswa');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
