<?php

namespace Sophia\Http\Requests;

use Sophia\Http\Requests\Request;

class UsuarioUpdateRequest extends Request
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
            'nombre'    => 'required',
            'apellido'  => 'required',
            'password'  => 'required',
            'email'     => 'required',
            'estado'    => 'required',
        ];
    }
}
