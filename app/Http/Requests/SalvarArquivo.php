<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SalvarArquivo extends FormRequest
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
            'arquivo' => 'required|mimes:jpeg,bmp,png,pdf,doc,docx,ppt,pps,pot,xls,xlm',
            'nomeDoArquivo' => 'required|max:50',
        ];
    }

    public function messages()
    {
        return [
            'arquivo.required' => 'O arquivo é obrigatório',
            'arquivo.mimes' => 'Este formato não é permitido',
            'nomeDoArquivo.required' => 'O nome do arquivo é obrigatório',
            'nomeDoArquivo.max' => 'Limite de 50 caracteres',
        ];
    }
}
