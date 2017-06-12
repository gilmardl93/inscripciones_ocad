<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
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
        $data = Request::all();
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
            'idtipoidentificacion'=> 'required',
            'numero_identificacion'=> 'required|unique:postulante,numero_identificacion,'.$data['id'].
                                      '|num_ide_max:'.$data['idtipoidentificacion'].'|num_ide_usu',
            'file'=> 'image',
            'talla'=>'numeric',
            'peso'=>'numeric',

        ];
    }
    public function messages()
    {
        return[
            'file.image'=>'Ha colocado un archivo que no es imagen en la fotografía'
        ];
    }
}
