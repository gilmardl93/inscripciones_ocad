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
            'email'=> 'required|email',
            'idsexo'=> 'required',
            'telefono_celular'=> 'required',
            'telefono_fijo'=> 'required',
            'telefono_varios'=> 'required',
            'idpais'=> 'required',
            'idpaisnacimiento'=> 'required',
            'idtipoidentificacion'=> 'required',
            'numero_identificacion'=> 'required|unique:postulante,numero_identificacion,'.$data['id'].
                                      '|num_ide_max:'.$data['idtipoidentificacion'].'|num_ide_usu',
            'file'=> 'image|mimes:jpg,jpeg,png,',
            'talla'=>'required|numeric',
            'peso'=>'required|numeric',
            'direccion'=>'required',
            'fecha_nacimiento'=>'required|date_format:Y-m-d',
            'inicio_estudios'=>'required',
            'fin_estudios'=>'required',

        ];
    }
    public function messages()
    {
        return[
            'file.image'=>'Ha colocado un archivo que no es imagen en la fotografía',
            'fecha_nacimiento.date_format'=>'La fecha de nacimiento que ha ingresado no esta en el formato (año, mes, dia)'
        ];
    }
}
