<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSecundariosRequest extends FormRequest
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
            'email'=> 'required',
            'talla'=> 'required',
            'peso'=> 'required',
            'idsexo'=> 'required',
            'telefono_celular'=> 'required',
            'telefono_fijo'=> 'required',
            'telefono_varios'=> 'required',
            'idpais'=> 'required',
            'idpaisnacimiento'=> 'required',
        ];
    }
}
