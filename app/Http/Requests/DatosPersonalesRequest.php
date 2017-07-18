<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class DatosPersonalesRequest extends FormRequest
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
    public function rules(Request $request)
    {
        $swco = $request->input('idcolegio');
        $swun = $request->input('iduniversidad');
        $idmodalidad = $request->input('idmodalidad');
        $idmodalidad2 = $request->input('idmodalidad2');
        $especialidad2 = $request->input('idespecialidad2');
        $codigo = $request->input('codigo_verificacion');
        return [
            'paterno'=>'required',
            'materno'=>'required',
            'nombres'=>'required',
            'idmodalidad'=>'required|required_ie:'.$swco.','.$swun.
                           '|required_mod_cepre:'.$idmodalidad2.
                           '|required_cod_cepre:'.$codigo.
                           '|required_esp_cepre:'.$especialidad2,
            'idespecialidad'=>'required|required_vacante:'.$idmodalidad,
            'codigo_verificacion'=>'max:10|valida_cod_cepre:'.$idmodalidad,
        ];
    }
}
