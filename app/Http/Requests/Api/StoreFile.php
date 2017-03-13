<?php

namespace Sophia\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreFile extends FormRequest
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
            /*'user'                  =>  'required|integer',
            'name'                  =>  'required|string',
            'type'                  =>  'required|integer',
            'security'              =>  'required|integer',
            'description'           =>  'required|string',
            'teacher'               =>  'required|integer',
            'ramo'                  =>  'required|integer',
            'usuarioRamoDocente'    =>  'required|string',*/
            //'ramoDocente'           =>  'required|integer',
            //'document'              =>  'required|file'
        ];
    }
}
