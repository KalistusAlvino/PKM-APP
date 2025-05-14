<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilterKelompokRequest extends FormRequest
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
            'filter_judul' => 'nullable|in:true,false',
            'filter_tahun' => 'nullable|integer|between:' . (date('Y') - 5) . ',' . date('Y'),
        ];
    }
}
