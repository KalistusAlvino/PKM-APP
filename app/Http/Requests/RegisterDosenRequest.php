<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterDosenRequest extends FormRequest
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
            'nip' => 'required|string|unique:dosen,nip',
            'username' => 'required|string|unique:user,username',
            'no_wa' => 'required|string|max:13|unique:dosen,no_wa',
            'name' => 'required|string|max:255',
            'program_studi' => 'required|string|max:255',
            'ketertarikan' => 'required|array', // Validasi bahwa ketertarikan harus berupa array
            'ketertarikan.*' => 'required|string|max:255', // Validasi setiap elemen dalam array
        ];
    }
    public function messages(): array
    {
        return [
            'username.unique' => 'Username sudah digunakan.',
            'no_wa.unique' => 'Nomer Whatsapp sudah digunakan.',
            'nip.unique' => 'NIP sudah digunakan.',
        ];
    }
}
