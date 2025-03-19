<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOldAnggotaRequest extends FormRequest
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
            'selectedMahasiswa' => 'required|json',
        ];
    }
    public function messages(): array
    {
        return [
            'selectedMahasiswa.required' => 'Pilih minimal satu mahasiswa.',
            'selectedMahasiswa.json' => 'Format data mahasiswa harus JSON.',
        ];
    }
}
