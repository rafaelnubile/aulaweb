<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SalvarCurso extends FormRequest
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
            'nome' => 'required|',
            'professor' => 'required|',
            'descricao' => 'required|',
            'categoria_id' => 'required|numeric',
            'palavrasChave' => 'required|',
            'linkVideoIntro' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'O campo é obrigatório',
            'professor.required' => 'O campo é obrigatório',
            'descricao.required' => 'O campo é obrigatório',
            'categoria_id.required' => 'O campo é obrigatório',
            'categoria_id.numeric' => 'Apenas números são permitidos',
            'palavrasChave.required' => 'O campo é obrigatório',
            'linkVideoIntro.required' => 'O campo é obrigatório',
            'linkVideoIntro.numeric' => 'Apenas números são permitidos',
        ];
    }
}
