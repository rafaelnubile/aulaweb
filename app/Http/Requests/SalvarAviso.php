<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SalvarAviso extends FormRequest
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
            'titulo' => 'required|',
            'aviso' => 'required|',
            'validade' => 'required|date'            
        ];
    }

    public function messages()
    {
        return [
            'titulo.required' => 'O campo é obrigatório',
            'aviso.required' => 'O campo é obrigatório',
            'validade.required' => 'O campo é obrigatório'            
        ];
    }
}
