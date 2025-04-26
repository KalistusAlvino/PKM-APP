<?php

namespace App\Http\Requests;

use App\Models\Dosen;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        $userId = optional(Dosen::find($this->id_dosen))->userId;
        return [
            'nip' => 'required|string|unique:dosen,nip,' . $this->id_dosen,
            'username' => [
                'required',
                'string',
                Rule::unique('user', 'username')->ignore($userId),
            ],
            'no_wa' => 'required|string|max:13|unique:dosen,no_wa,' . $this->id_dosen,
            'name' => 'required|string|max:255',
            'fakultas' => 'required|string|max:255',
            'program_studi' => 'required|string|max:255',
            'ketertarikan' => 'required|array',
            'ketertarikan.*' => 'required|string|max:255',
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
