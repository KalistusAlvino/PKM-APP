<?php

namespace App\Http\Controllers\AuthController;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Repositories\Users\AuthRepository;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    protected $authRepository;
    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }
    public function getLoginPage()
    {
        return view('auth.login');
    }

    public function postLogin(LoginRequest $request)
    {
        try {
            $validate = $request->validated();

            $user = $this->authRepository->login($validate);

            $route = match (true) {
                $user->isMahasiswa() => 'mahasiswa.dashboard',
                
            };

            return redirect()->intended(route($route));
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}
