<?php

namespace Sophia\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'nombre'            =>  'required|string|max:100',
            'apellido'          =>  'required|string|max:100',
            'email'             =>  'required|email',
            'password'          =>  'present',
            'fecha_nacimiento'  =>  'required|date',
            'edad'              =>  'present',
            'avatar'            =>  'present|image'
        ];
    }
}
