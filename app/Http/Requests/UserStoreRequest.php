<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //valor devuelto por defecto, al crear esta clase
        //return false;
        //valor devuelto para que no haya restricción de uso
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //Reglas para campos obligatorios
        $rules = [
            'username'  => 'required|string|max:69|unique:users',
            'email'     => 'required|string|email|max:100|unique:users',
            'password'  => ['required', 'string', 'min:6', 'confirmed'],
            'perfil_id' => 'required',
        ];

        //Reglas para campos opcionales que se aplicarán si son suministrados
        if($this->get('name')) {
            $rules = array_merge($rules, [
                'name' => 'string|max:50',
            ]);
        }
        if($this->get('lastname')) {
            $rules = array_merge($rules, [
                'lastname' => 'string|max:74',
            ]);
        }

        return $rules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'username.required' => 'El NOMBRE de USUARIO es obligatorio',
            'username.string' => 'El NOMBRE de USUARIO de ser de tipo string',
            'username.max'  => 'El NOMBRE de USUARIO con un Máx. de :max caracteres',
            'username.unique'  => 'El NOMBRE de USUARIO ya está registrado',
            'name.string' => 'El NOMBRE de ser de tipo string',
            'name.max'  => 'El NOMBRE con un Máx. de :max caracteres',
            'lastname.string' => 'El APELLIDO de ser de tipo string',
            'lastname.max'  => 'El APELLIDO con un Máx. de :max caracteres',
            'email.required' => 'El EMAIL es obligatorio',
            'email.string' => 'El EMAIL de ser de tipo string',
            'email.email' => 'El EMAIL no es un correo válido',
            'email.max'  => 'El EMAIL con un Máx. de :max caracteres',
            'email.unique'  => 'El EMAIL ya está registrado',
            'password.required' => 'La CONTRASEÑA es obligatoria',
            'password.string' => 'La CONTRASEÑA de ser de tipo string',
            'password.min'  => 'La CONTRASEÑA con un Mín. de :min caracteres',
            'password.confirmed' => 'La confirmación de CONTRASEÑA no coincide',
            'perfil_id.required'  => 'El PERFIL es obligatorio',
        ];
    }
}
