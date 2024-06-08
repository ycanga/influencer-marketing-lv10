<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class SettingsRequest extends FormRequest
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
            'site_title' => 'required',
            'site_description' => 'required',
            'site_keywords' => 'required',
            'site_min_balance' => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'site_title.required' => 'Site başlığı zorunludur.',
            'site_description.required' => 'Site açıklaması zorunludur.',
            'site_keywords.required' => 'Site anahtar kelimeleri zorunludur.',
            'site_min_balance.required' => 'Site minimum bakiyesi zorunludur.',
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     */
    protected function failedValidation(Validator $validator)
    { 
        return redirect()->back()->withInput()->with(['status' => 'error', 'message' => 'Validation failed', 'validation' => json_encode($validator->errors())]);
    }
}
