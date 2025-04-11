<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Repositories\Biro\AkunRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    protected $akunRepository;
    public function __construct(AkunRepository $akunRepository)
    {
        $this->akunRepository = $akunRepository;
    }
    public function getPage()
    {
        $key = 'change_password';
        return view('dashboard.for-all.change-password',compact('key'));
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        try {
            $user = Auth::user();
            if (!Hash::check($request->old_password, $user->password)) {
                return redirect()->back()->withErrors(['errors' => 'Password lama salah.']);
            }
            $this->akunRepository->changePassword($request->only('old_password', 'new_password'));

            return redirect()->back()->with('success', 'Berhasil Mengubah password');
        } catch (Exception $e) {
            return redirect()->back()->withErrors('errors', $e->getMessage());
        }
    }
}
