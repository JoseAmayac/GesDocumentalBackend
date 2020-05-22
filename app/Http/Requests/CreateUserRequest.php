<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'name' => 'required|string|min:1|max:255',
            'email' => 'required|email|unique:users|regex:/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/',
            'password' => 'required|confirmed',
            'role_id' => 'required|numeric',
            'position' => 'required|string',
            'dependency_id' => 'required_unless:role_id,2|integer'
        ];
    }


    public function messages()
    {
        return [
            'name.required' => 'El nombre del usuario es requerido',
            'name.string' => 'El formato del nombre no es aceptado',
            'email.required' => 'El correo electrónico es requerido',
            'email.string' => 'El correo electrónico no es correcto',
            'email.email' => 'El correo electrónico no es valido',
            'email.regex' => 'El correo electrónico no es valido',
            'password.required' => 'La contraseña es requerida',
            'password.confirmed' => 'La confirmación de contraseña no coincide',
            'position.required' => 'El cargo del usuario es requerido',
            'role_id.required' => 'El rol del usuario es requerido',
            'dependency_id.required_if' => 'La dependencia del usuario es requerida',
            'email.unique' => 'Esta dirección de correo ya está en uso'
        ];
    }
}
