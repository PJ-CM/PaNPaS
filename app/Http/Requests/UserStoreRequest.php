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
        /*//Reglas para campos obligatorios
        $rules = [
            'username'  => 'required|string|max:69|unique:users',
            'email'     => 'required|string|email|max:100|unique:users',
            //Regla en formato de ARRAY
            ////'password'  => 'required', 'string', 'min:6', 'confirmed',
            //Regla en formato con PIPE
            'password'  => 'required|string|min:6|confirmed',
            'perfil_id' => 'required',
        ];

        //Reglas para campos opcionales que se aplicarán si son suministrados
        // ===================================================================================
        //:: FORMA 1d2 ::
        // --------------------------------------
        if($this->get('name')) {
            $rules = array_merge($rules, [
                ////'name' => 'string|max:50',
                //Con la regla STRING llegan a pasar las cadenas con núms también
                //Por ello, se pasa la regla REGEX que, por medio de la expresión
                //especificada, SOLAMENTE, admite letras (A-Za-z), espacios(\s) y guiones (-_)
                //Para admitir también letras con tilde, se debe añadir esto a la expresión:
                //  áàäâÁÀÄÂéèëêÉÈËÊíìïîÍÌÏÎóòöôÓÒÖÔúùüûÚÙÜÛñÑ
                'name' => 'regex:/^[áàäâÁÀÄÂéèëêÉÈËÊíìïîÍÌÏÎóòöôÓÒÖÔúùüûÚÙÜÛñÑA-Za-z\s-_]+$/|max:50',
            ]);
        }
        if($this->get('lastname')) {
            $rules = array_merge($rules, [
                ////'lastname' => 'string|max:74',
                'lastname' => 'regex:/^[áàäâÁÀÄÂéèëêÉÈËÊíìïîÍÌÏÎóòöôÓÒÖÔúùüûÚÙÜÛñÑA-Za-z\s-_]+$/|max:74',
            ]);
        }*/
        //¡¡ATENCIÓN!!
        //El guión - dentro de una REGEX tiene el cometido de separar rangos de caracteres
        //Si lo que se desea es inlcuirlo como carácter válido, dicho carácter - deberá ser
        //escapado precediéndolo de un \ así >> \-
        //Otra sería indicarlo al principio o al final de toda la cadena de caracteres aceptados
        //Optando por dejarlo como último carácter, a regla a establecer:
        //  >> pasa de esto
        //      regex:/^[áàäâÁÀÄÂéèëêÉÈËÊíìïîÍÌÏÎóòöôÓÒÖÔúùüûÚÙÜÛñÑA-Za-z\s_-]+$/
        //  >> a esto otro
        //      regex:/^[áàäâÁÀÄÂéèëêÉÈËÊíìïîÍÌÏÎóòöôÓÒÖÔúùüûÚÙÜÛñÑA-Za-z\s_-]+$/
        //  De no tenerse esto en cuenta, puede producirse este ERROR:
        //      preg_match(): Compilation failed: invalid range in character class at offset 94
        //      >> Error qeu se produjo en Heroku pero no en LOCAL
        //          => Heroku PHP 7.3.2     | Local PHP 7.2.10
        //          => Nginx 1.8.1
        //          => Apache 2.4.38        | Local Apache 2.4.34
        //---------------------------------------------------------------------------
        //:: FORMA 2d2 ::
        // --------------------------------------
        //Ver las reglas con NULLABLE que considera el nulo como valor válido.
        //Y, si se especifica algo, se considerarán las demás reglas a aplicar.

        //Reglas para campos obligatorios/opcionales (nullable)
        $rules = [
            'username'  => 'required|string|max:69|unique:users',
            'email'     => 'required|string|email|max:100|unique:users',
            'password'  => 'required|string|min:6|confirmed',
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
