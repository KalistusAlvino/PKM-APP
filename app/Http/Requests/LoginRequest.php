<?php

namespace App\Http\Requests;

use App\Models\User;
use Hash;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) {
                    if (!User::where('username', $value)->exists()) {
                        $fail('Username belum terdaftar. Silahkah lakukan registrasi');
                    }
                }
            ],
            'password' => 'required|min:8',
        ];

    }

    public function messages(): array
    {
        return [
            'email.required' => 'Email wajib diisi.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal :min karakter.',
        ];
    }
    public function withValidator($validator)
    {
        // Setelah username terdaftar, cek apakah password benar
        $validator->after(function ($validator) {
            $username = $this->input('username');
            $password = $this->input('password');

            // Dapatkan user berdasarkan username
            $user = User::where('username', $username)->first();

            // Jika user ditemukan dan password tidak cocok
            if ($user && !Hash::check($password, $user->password)) {
                $validator->errors()->add('password', 'Password yang dimasukkan salah.');
            }
        });
    }
}
