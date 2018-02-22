<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\UsuarioCurso;

class SalvarAvaliacao extends FormRequest
{
    private $cursoID;
    private $usuario;
    private $usuarioCurso;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    function __construct() {
        $this->cursoID = intval(substr(strrchr(request()->url(), "/"), 1));
        $this->usuario = Auth::user();
        $this->usuarioCurso = UsuarioCurso::where([
            ['curso_id', $this->cursoID],
            ['user_id', $this->usuario->id]
        ])->first();
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(!empty($this->usuarioCurso)) {
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
           'avaliacao' => 'required',
           'comentario' => 'nullable|max:255'
        ];
    }

    public function messages()
    {
        return [
           'avaliacao.required' => 'A nota é obrigatória',
           'comentario.max' => 'Máximo de 255 caracteres'
        ];
    }
}
