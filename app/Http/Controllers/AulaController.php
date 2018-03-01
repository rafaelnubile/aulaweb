<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Aula;

use App\Unidade;

use App\UsuarioCurso;
use App\AlunoAula;

class AulaController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Aula $aula)
    {   
        $usuario = Auth::user();
        $aula->load('unidade.curso', 'arquivos');
        $curso = $aula->unidade->curso; 
        $unidades = $curso->unidades;
        $numeroAulasUnidade = count($unidades);
        $proximaAula = $aula->id + 1;
        $aulaAnterior = $aula->id - 1;

        if(! $this->estaInscrito($usuario, $curso))
    	{
    		return redirect('/curso/' .$curso->id);
    	}
        else if ($usuario->tipo_usuario_id == 1)
        {
            return redirect('/adm') ;
        }

        return view('aula', compact('aula', 'curso', 'numeroAulasUnidade', 'proximaAula', 'aulaAnterior'));       
    }



    private function estaInscrito($usuario, $curso)
    {
    	//Verificar se já está inscrito
    	$cursoAluno = UsuarioCurso::where([
		    ['user_id', $usuario->id],
		    ['curso_id', $curso->id],
		])->first();

		if($cursoAluno)
		{
			return true;
		}

		return false;
    }



    public function assistida(Aula $aula)
    {
        $aulaAssistida = false;
    	$usuario = Auth::user();
        $aula->load('unidade.curso');
        $curso = $aula->unidade->curso;

    	$alunoAula = AlunoAula::where([
	    	['user_id', $usuario->id],
	    	['aula_id', $aula->id],
		])->firstOrFail();

    	$alunoAula->assistida = true;
    	$aulaAssistida = $alunoAula->save();

        if($usuario->aprovado($curso)) {
            $usuario->aprovar($curso);
        }

        return $aulaAssistida;
    }
}



