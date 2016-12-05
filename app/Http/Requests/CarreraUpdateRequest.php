<?php

namespace Sophia\Http\Requests;

use Sophia\Http\Requests\Request;

class CarreraUpdateRequest extends Request
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
            'nombre_carrera'  => 'required',
        ];
    }
}
