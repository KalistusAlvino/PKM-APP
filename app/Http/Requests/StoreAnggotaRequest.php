<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAnggotaRequest extends FormRequest
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
            'username' => 'required|string|min:8|max:8|unique:user,username',
            'role' => 'required',
            'no_wa' => 'required|string|min:11|max:13|unique:mahasiswa,no_wa',
            'fakultas' => 'required|string',
            'prodi' => 'required|string',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:mahasiswa,email',
        ];
    }

    public function messages(): array
    {
        return [
            'username.min' => 'Username minimal :min karakter',
            'username.unique' => 'NIM anda sudah terdaftar.',
            'no_wa.unique' => 'No. Whatsapp sudah digunakan.',
            'email.unique' => 'Email sudah digunakan.',
        ];
    }
}
