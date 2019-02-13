<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
        //Reglas para campos obligatorios/opcionales (nullable)
        $rules = [
            'username'  => 'required|string|max:69|unique:users,username,' . $this->id,
            'email'     => 'required|string|email|max:100|unique:users,email,' . $this->id,
            'password'  => 'nullable|string|min:6|confirmed',
            'perfil_id' => 'required',
            'name' => 'nullable|regex:/^[áàäâÁÀÄÂéèëêÉÈËÊíìïîÍÌÏÎóòöôÓÒÖÔúùüûÚÙÜÛñÑA-Za-z\s_-]+$/|max:50',
            'lastname' => 'nullable|regex:/^[áàäâÁÀÄÂéèëêÉÈËÊíìïîÍÌÏÎóòöôÓÒÖÔúùüûÚÙÜÛñÑA-Za-z\s_-]+$/|max:74',
        ];

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
            'name.string' => 'El NOMBRE debe ser de tipo string',
            'name.regex' => 'El NOMBRE debe ser de formato string',
            'name.max'  => 'El NOMBRE con un Máx. de :max caracteres',
            'lastname.string' => 'El APELLIDO debe ser de tipo string',
            'lastname.regex' => 'El APELLIDO debe ser de formato string',
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
