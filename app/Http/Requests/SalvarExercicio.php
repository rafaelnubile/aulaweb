<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SalvarExercicio extends FormRequest
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
            'tituloExercicio' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'tituloExercicio.required' => 'O campo é obrigatório',
        ];
    }
}
