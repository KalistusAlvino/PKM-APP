<?php

namespace App\Http\Controllers\AuthController;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMahasiswaRequest;
use App\Models\Fakultas;
use App\Models\ProgramStudi;
use App\Repositories\Mahasiswa\MahasiswaRepository;
use Exception;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    protected $mahasiswaRepository;
    public function __construct(MahasiswaRepository $mahasiswaRepository)
    {
        $this->mahasiswaRepository = $mahasiswaRepository;
    }

    public function getRegisterPage()
    {
        $fakultas = Fakultas::all();
        return view('auth.register',compact('fakultas'));
    }

    public function getProgramStudi($fakultas_id)
    {
        $programStudi = ProgramStudi::where('fakultas_id', $fakultas_id)->get();
        return response()->json($programStudi);
    }

    public function storeMahasiswa(StoreMahasiswaRequest $request){
        try {
            $validate = $request->validated();
            $this->mahasiswaRepository->create($validate);

            return redirect()->route('halamanLogin')->with('success', 'Data berhasil disimpan!');
        }
        catch (Exception $e)
        {
            dd($e);
            return redirect()->back()->with('failed', 'Data gagal disimpan!');
        }
    }
}
