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

        return [
            'paterno'=>'required',
            'materno'=>'required',
            'nombres'=>'required',
            'idmodalidad'=>'required|required_ie:'.$swco.','.$swun,
            'idespecialidad'=>'required',
        ];
    }
}
