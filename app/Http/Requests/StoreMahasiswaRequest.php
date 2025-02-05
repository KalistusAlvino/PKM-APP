<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMahasiswaRequest extends FormRequest
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
            'username' => 'required|string|max:8|unique:user,username',
            'role' => 'required',
            'no_wa' => 'required|string|max:13',
            'fakultas' => 'required|string',
            'prodi' => 'required|string',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:mahasiswa,email',
            'password' => 'required|min:6',
        ];
    }
    public function messages(): array
    {
        return [
            'username.unique' => 'Username sudah digunakan.',
            'email.unique' => 'Email sudah digunakan.',
            'password.min' => 'Password minimal :min karakter.',
        ];
    }
}
