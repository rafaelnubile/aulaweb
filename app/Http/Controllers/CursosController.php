<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SalvarCurso;
use App\Http\Requests\SalvarAvaliacao;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Curso;
use App\User;
use App\UsuarioCurso;
use App\Categoria;
use App\AlunoAula;


class CursosController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function visualizarCurso(Curso $curso)
    {         
    	$usuario = Auth::user();
        $curso->load('categoria', 'unidades.aulas', 'unidades.exercicios');
        $nomeCategoria =  $curso->categoria->tipo;

        //SE USUÁRIO NÃO ESTIVER INSCRITO, VERÁ PÁGINA DE INFO DO CURSO
        if(! $this->estaInscrito($usuario, $curso))
    	{            
    		return view('cursoInfo', compact('curso', 'nomeCategoria'));
    	}

        //CASO CONTRÁRIO, VERÁ A PÁGINA COM O ÍNDICE DAS AULAS
        foreach($curso->unidades as $unidade)
        {
            for($i = 0; $i < count($unidade->aulas); $i++)
            {
                $aula = $unidade->aulas[$i];
                $aulaAssistida = AlunoAula::where([
                    ['user_id', $usuario->id],
                    ['aula_id', $aula->id],
                ])->first();
                $unidade->aulas[$i]->assistida = $aulaAssistida->assistida;
            }
        }
        $usuarioCurso = UsuarioCurso::where([
            ['user_id', $usuario->id],
            ['curso_id', $curso->id],
        ])->first();

        //return $usuarioCurso;
    	return view('curso', compact('curso', 'usuarioCurso'));        
    }

    // TODO: REVER CODIGO
    public function matricular(Curso $curso)
    {  
    	$usuario = Auth::user();
    	if(! $this->estaInscrito($usuario, $curso))
    	{
            DB::beginTransaction();
            $transacoes = [];
            $curso->load('unidades.aulas');
    		$usuarioCurso = new UsuarioCurso();
    		$usuarioCurso->user_id = $usuario->id;
            $usuarioCurso->curso_id = $curso->id;
            $usuarioCurso->avaliacao = null;
    		$usuarioCurso->comentario = null;
    		$transacoes[] = $usuarioCurso->save();
    		
            foreach($curso->unidades as $unidade)
            {
                foreach($unidade->aulas as $aula)
                {
                    $alunoAula = new AlunoAula();
                    $alunoAula->user_id = $usuario->id;
                    $alunoAula->aula_id = $aula->id;
                    $alunoAula->assistida = false;
                    $transacoes[] = $alunoAula->save();
                }
            }

            foreach ($transacoes as $transacao) {
                if(!$transacao) {
                    flash()->erro('Ops!', 'Ocorreu um erro ao se matricular no curso, tente novamente');
                    DB::rollBack();
                    return redirect('/curso/' . $curso->id);
                    break;
                } 
            }
            DB::commit();
            flash()->sucesso('OK', 'Inscrição realizada com sucesso');
    	}
    	else
    	{
    		flash()->erro('Ops!', 'Você já está inscrito neste curso');
    	}    	

        return redirect('/curso/' . $curso->id);
    }
    
    // PRECISA DELETAR AS ENTRADAS NA TABELA ALUNO_AULA 
    public function desmatricular(Curso $curso)
    {
    	$usuario = Auth::user();
    	if($this->estaInscrito($usuario, $curso))
    	{
            DB::beginTransaction();
            $transacoes = [];
            $curso->load('unidades.aulas');

    		$transacoes[] = UsuarioCurso::where([
		    	['user_id', $usuario->id],
		    	['curso_id', $curso->id],
			])->delete();


            // REMOVER AS ENTRADAS DA TABELA ALUNO_AULA
            foreach($curso->unidades as $unidade)
            {
                foreach($unidade->aulas as $aula)
                {
                    $transacoes[] = AlunoAula::where([
                        ['user_id', $usuario->id],
                        ['aula_id', $aula->id],
                    ])->delete();
                }
            }

            foreach ($transacoes as $transacao) {
                if(!$transacao) {
                    flash()->erro('Ops!', 'Ocorreu um erro ao se desmatricular no curso, tente novamente');
                    DB::rollBack();
                    return redirect('/curso/' . $curso->id);
                    break;
                } 
            }
            DB::commit();
            flash()->sucesso('OK', 'Desmatricula realizada com sucesso');
    	}
    	return redirect('/home');
    }




    public function avaliar(SalvarAvaliacao $request, Curso $curso)
    {
        $usuario = Auth::user();
        $usuarioCurso = UsuarioCurso::where([
            ['user_id', $usuario->id],
            ['curso_id', $curso->id],
        ])->first();

        if(!empty($usuarioCurso)) {
            $usuarioCurso->avaliacao = $request->avaliacao;
            if(!empty($request->comentario)) {
                $usuarioCurso->comentario = trim($request->comentario);
            }

            if($usuarioCurso->save()) {
                flash()->sucesso('OK', 'Avaliação salva com sucesso');
            } else {
                flash()->erro('Ops!', 'Ocorreu um erro ao salvar sua avaliação, tente novamente');
            }
        }
        
        return back();
    }

    public function certificado(User $usuario, Curso $curso) 
    {
        return view('certificado', compact('usuario', 'curso'));
    }

    //Retorna TRUE se o aluno estiver inscrito, false se não.
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

    private function mensagemFlash($boolean, $mensagemSucesso, $mensagemErro = "Ocorreu um erro ao salvar no Banco de Dados.")
    {
    	if($boolean)
    	{
    		flash()->sucesso('Sucesso!', $mensagemSucesso);
    	}
    	else
    	{
    		flash()->erro('Ops!', $mensagemErro);
    	}
    }
}
