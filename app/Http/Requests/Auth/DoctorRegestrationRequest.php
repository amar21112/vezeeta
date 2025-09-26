<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DoctorRegestrationRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:doctors',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'required|numeric|digits:11|unique:doctors',
            'graduate_from' => 'required|string|max:255',
            'graduate_in' => 'required|digits:4|integer|min:1900|max:'.date('Y'),
            'about' => 'required|string|max:255',
            'governorate' => ['required', Rule::in(array_keys(config('governorates')))],
            'city'        => ['required', 'string', 'max:255'],
            'street'      => ['required', 'string', 'max:255'],
        ];
    }
}
