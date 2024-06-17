<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class ProfileRequest extends FormRequest
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
            'email' => 'required|string|email|max:255|unique:users,email,' . auth()->user()->id,
            'phone' => 'required|numeric',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Ad alanı zorunludur.',
            'name.string' => 'Ad alanı metin tipinde olmalıdır.',
            'name.max' => 'Ad alanı en fazla 255 karakter olabilir.',
            'email.required' => 'E-posta alanı zorunludur.',
            'email.string' => 'E-posta alanı metin tipinde olmalıdır.',
            'email.email' => 'E-posta alanı geçerli bir e-posta adresi olmalıdır.',
            'email.max' => 'E-posta alanı en fazla 255 karakter olabilir.',
            'email.unique' => 'Bu e-posta adresi başka bir kullanıcı tarafından kullanılıyor.',
            'phone.required' => 'Telefon alanı zorunludur.',
            'phone.numeric' => 'Telefon alanı sayısal bir değer olmalıdır.',
            'photo.required' => 'Fotoğraf alanı zorunludur.',
            'photo.image' => 'Fotoğraf alanı bir resim dosyası olmalıdır.',
            'photo.mimes' => 'Fotoğraf alanı jpeg, png, jpg formatında olmalıdır.',
            'photo.max' => 'Fotoğraf alanı en fazla 2048 KB boyutunda olabilir.',
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
