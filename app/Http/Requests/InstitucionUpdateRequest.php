<?php

namespace Sophia\Http\Requests;

use Sophia\Http\Requests\Request;

class InstitucionUpdateRequest extends Request
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
            'nombre_institucion'  => 'required',
            'id_tipo_institucion'  => 'required'
        ];
    }
}
