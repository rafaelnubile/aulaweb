<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class SalvarAula extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $usuario = Auth::user();
        if($usuario->tipo_usuario_id == 1)
        {
             return true;
        }
       return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nomeAula' => 'required',
            'vimeoID' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'nomeAula.required' => 'O campo é obrigatório',
            'vimeoID.required' => 'O campo é obrigatório',
            'vimeoID.numeric' => 'Apenas números são permitidos',
        ];
    }
}
