<?php

namespace App\Http\Requests;

use App\Models\Koordinator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterKoordinatorRequest extends FormRequest
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
        $userId = optional(Koordinator::find($this->id_koordinator))->userId;

        return [
           'username' => [
            'required',
            'string',
            Rule::unique('user', 'username')->ignore($userId),
        ],
            'name' => 'required|string|max:255',
        ];
    }
    public function messages(): array
    {
        return [
            'username.unique' => 'Username sudah digunakan.',
        ];
    }
}
