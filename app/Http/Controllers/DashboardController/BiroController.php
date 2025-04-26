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
        return view('dashboard.biro.dashboard', compact('key', 'barChart', 'mahasiswa', 'dosen', 'kelompok', 'skema'));
    }

    public function getDosenAccountPage()
    {
        $skema = SkemaPkm::all();
        $fakultas = Fakultas::all();
        $key = 'dosen-account';
        $dosen = $this->akunRepository->getDosen();
        return view('dashboard.biro.account.dosen', compact('dosen', 'fakultas', 'skema', 'key'));
    }
    public function getMahasiswaAccountPage()
    {
        $key = 'mahasiswa-account';
        $mahasiswa = $this->akunRepository->getMahasiswa();
        $fakultas = Fakultas::all();
        return view('dashboard.biro.account.mahasiswa', compact('mahasiswa', 'fakultas', 'key'));
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
        return view('dashboard.biro.account.koordinator', compact('koordinator', 'key'));
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

    public function gantiPassword(ChangePasswordByBiroRequest $request)
    {
        try {
            $validate = $request->validated();

            $this->akunRepository->gantiPassword($validate);
            return redirect()->back()->with('success', 'Berhasil mengganti password user');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function deleteAccount($userId)
    {
        try {
            $this->akunRepository->deleteAccount($userId);
            return redirect()->back()->with('success', 'Berhasil melakukan delete user');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function detailKoordinator($id_koordinator)
    {
        $koordinator = $this->akunRepository->detailKoordinator($id_koordinator);
        return response()->json($koordinator);
    }
    public function editDosen($id_dosen)
    {
        $dosen = $this->akunRepository->detailDosen($id_dosen);
        $fakultas = Fakultas::all();
        $skema = SkemaPkm::all();
        $key = 'dosen-account';
        return view('dashboard.biro.account.modaldosen.edit-dosen', compact('dosen', 'fakultas', 'skema', 'key'));
    }

    public function updateDosen(RegisterDosenRequest $request, $id_dosen)
    {
        try {
            $validate = $request->validated();
            $this->akunRepository->updateDosen($id_dosen,$validate);
            return redirect()->route('biro.dosen-account-page')->with('success','Berhasil melakukan update dosen');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function updateKoordinator(RegisterKoordinatorRequest $request, $id_koordinator)
    {
        try {
            $validate = $request->validated();
            $this->akunRepository->updateKoordinator($id_koordinator, $validate);
            return redirect()->route('biro.koordinator-account-page')->with('success', 'Berhasil melakukan update user');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
