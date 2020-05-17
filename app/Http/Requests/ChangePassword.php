<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePassword extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|string|email|regex:/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/',
            'password' => 'required|string|confirmed|min:6',
            'token' => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'El correo electrónico es requerido',
            'email.string' => 'El correo electrónico no es correcto',
            'email.email' => 'El correo electrónico no es valido',
            'email.regex' => 'El correo electrónico no es valido',
            'password.required' => 'La nueva contraseña es requerida',
            'password.confirmed' => 'La confirmacion de contraseña no coincide',
            'password.string' => 'El formato de la contraseña no es valido',
            'token.required' => 'El token de restablecimiento de contraseña es requerido',
            'token.string' => 'El formato del token de restablecimiento no es valido',
            'password.min' => 'La contraseña nueva debe contener al menos 6 caracteres'
        ];
    }
}
