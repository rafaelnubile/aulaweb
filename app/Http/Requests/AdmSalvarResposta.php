<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AdmSalvarResposta extends FormRequest
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
            'txt_afirmativa' => 'required',
            'correta' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'txt_afirmativa.required' => 'O campo é obrigatório',
            'correta.required' => 'O campo é obrigatório',
        ];
    }
}
