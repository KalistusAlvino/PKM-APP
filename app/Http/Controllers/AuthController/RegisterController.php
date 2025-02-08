<?php

namespace App\Http\Controllers\AuthController;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\Fakultas;
use App\Models\ProgramStudi;
use App\Repositories\Mahasiswa\RegisterRepository;
use Illuminate\Validation\ValidationException;
class RegisterController extends Controller
{
    protected $registerRepository;
    public function __construct(RegisterRepository $registerRepository)
    {
        $this->registerRepository = $registerRepository;
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

    public function storeMahasiswa(RegisterRequest $request){
        try {
            $validate = $request->validated();
            $this->registerRepository->create($validate);

            return redirect()->route('halamanLogin')->with('success', 'Data berhasil disimpan!');
        }
        catch (ValidationException $e)
        {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}
