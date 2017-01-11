<?php

namespace Sophia\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContentFile extends FormRequest
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
            'user'                  =>  'required|integer',
            'security'              =>  'required|integer',
            'type'                  =>  'required|integer',
            'teacher'               =>  'required|integer',
            'ramo'                  =>  'required|integer',
            'usuarioRamoDocente'    =>  'required|integer',
            'ramoDocente'           =>  'required|integer',
            'document'              =>  'required|file'
        ];
    }
}
