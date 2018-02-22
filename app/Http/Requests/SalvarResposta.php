<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Exercicio;
use App\Questao;
use App\UsuarioCurso;

class SalvarResposta extends FormRequest
{
    private $exercicioID;
    private $exercicio;
    private $questoes;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    function __construct() {
        $this->exercicioID = intval(substr(strrchr(request()->url(), "/"), 1));
        $this->exercicio = Exercicio::where('id', $this->exercicioID)->firstOrFail();
        $this->questoes = Questao::where('exercicio_id', $this->exercicioID)->get();
    }

    public function authorize(Exercicio $exercicio)
    {
        $usuario = Auth::user();
        $usuarioID = $usuario->id;
        $this->exercicio->load('unidade.curso');
        $cursoID = $this->exercicio->unidade->curso->id;
        $usuarioCurso = UsuarioCurso::where([
                    ['user_id', $usuarioID],
                    ['curso_id', $cursoID],
        ])->first();
           if(!empty($usuarioCurso)) {
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
        $regras = [];
        foreach($this->questoes as $questao) {
            $regras["questao$questao->id"] = 'required';
        }
        return $regras;
    }

    public function messages()
    {
        $texto = "Este campo é obrigatório";
        $mensagem = [];
        foreach($this->questoes as $questao) {
            $mensagem["questao$questao->id.required"] = $texto;
        }
        return $mensagem;
    }
}
