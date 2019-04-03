<?php

namespace adm\Http\Requests;

use adm\Http\Requests\Request;

class IncidenteFormRequest extends Request
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
            'tipo'=>'required|max:50',
            'descripcion'=>'max:256',
            'impacto'=>'required|max:50',
            'area'=>'max:56',
            'tecnico'=>'required|max:50',
            
        ];
    }
}
