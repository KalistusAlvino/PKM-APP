<?php

namespace App\Http\Controllers\AuthController;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Mail\EmailVerificationMail;
use App\Models\Fakultas;
use App\Models\Mahasiswa;
use App\Models\ProgramStudi;
use App\Repositories\Mahasiswa\RegisterRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
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
        return view('auth.register');
    }
    public function verifyEmail(Request $request)
    {
        $email = $request->query('email');
        return view('auth.verify-email', compact('email'));
    }
    public function dataDiri($token)
    {
        $mahasiswa = Mahasiswa::where('email_verification_token', $token)->firstOrFail();
        $fakultas = Fakultas::all();
        return view('auth.data-diri', compact('fakultas', 'mahasiswa'));
    }
    public function simpanDataDiri(RegisterRequest $request)
    {
        try {
            $validate = $request->validated();
            $this->registerRepository->create($validate);

            return redirect()->route('halamanLogin')->with('success', 'Registrasi berhasil silahkan login');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Ada kesalahan saat melengkapi data diri');
        }
    }
    public function sendEmail(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email'
        ]);

        // Cari mahasiswa berdasarkan email
        $mahasiswa = Mahasiswa::where('email', $validated['email'])->first();

        // Jika mahasiswa sudah ada
        if ($mahasiswa) {
            // Jika mahasiswa sudah terdaftar tetapi belum melakukan verifikasi, kirim ulang email
            if ($mahasiswa->email_verification_at === null) {
                // Generate token baru untuk verifikasi ulang
                $token = Str::uuid();
                $mahasiswa->update([
                    'email_verification_token' => $token,
                ]);

                // Kirim email verifikasi ulang
                Mail::to($validated['email'])->send(new EmailVerificationMail($mahasiswa));

                return redirect()->route('verify.email', ['email' => $validated['email']])->with([
                    'success' => 'Email verifikasi telah dikirim ulang.',
                ]);
            } else {
                // Jika mahasiswa sudah terverifikasi
                return redirect()->route('login')->with([
                    'error' => 'Email sudah terverifikasi, silakan login.'
                ]);
            }
        }

        // Jika mahasiswa belum ada di database, buat record baru
        $token = Str::uuid();
        $mahasiswa = Mahasiswa::create([
            'email' => $validated['email'],
            'email_verification_token' => $token,
        ]);

        // Kirim email verifikasi
        Mail::to($validated['email'])->send(new EmailVerificationMail($mahasiswa));

        return redirect()->route('verify.email', ['email' => $validated['email']])->with([
            'success' => 'Email berhasil terkirim.',
            'email' => $validated['email'],
        ]);
    }

    public function resendVerification(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $mahasiswa = Mahasiswa::where('email', $request->email)->first();

        if (!$mahasiswa) {
            return back()->with('error', 'Email tidak ditemukan');
        }

        if ($mahasiswa->email_verification_at) {
            return back()->with('info', 'Email sudah terverifikasi');
        }

        $mahasiswa->email_verification_token = Str::uuid();
        $mahasiswa->save();

        Mail::to($mahasiswa->email)->send(new EmailVerificationMail($mahasiswa));

        return back()->with('success', 'Email verifikasi berhasil dikirim ulang');
    }


    public function getProgramStudi($fakultas_id)
    {
        $programStudi = ProgramStudi::where('fakultas_id', $fakultas_id)->get();
        return response()->json($programStudi);
    }

    public function storeMahasiswa(RegisterRequest $request)
    {
        try {
            $validate = $request->validated();
            $this->registerRepository->create($validate);

            return redirect()->route('halamanLogin')->with('success', 'Pendaftaran Berhasil, Ayo Login!');
        } catch (ValidationException $e) {
            return redirect()->back()->with('errors', 'Ada kesalahan dalam melakukan registrasi');
        }
    }
}
