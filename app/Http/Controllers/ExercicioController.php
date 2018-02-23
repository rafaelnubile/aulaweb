<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Exercicio;
use App\Http\Requests\SalvarResposta;
use App\UsuarioCurso;
use App\Questao;
use App\AlunoResposta;
use App\Nota;
use App\User;
use App\Resposta;

class ExercicioController extends Controller
{

	public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('inscrito');
    }

    public function index(Exercicio $exercicio)
    {
    	$exercicio->load('questaos.respostas', 'unidade.curso');
        $cursoID = $exercicio->unidade->curso->id;
    	$usuario = Auth::user();
        $alunoRespostas = [];
        for($i = 0; $i < count($exercicio->questaos); $i++) {
            $alunoResposta = AlunoResposta::where([
                ['questao_id', $exercicio->questaos[$i]->id],
                ['user_id', $usuario->id]
            ])->first();
            if(!empty($alunoResposta)) {
                $exercicio->questaos[$i]->respostaAluno = $alunoResposta->resposta_id;
            } else {
                $exercicio->questaos[$i]->respostaAluno = null;
            }
        } 
        //return $exercicio;

        return view('exercicio', compact('exercicio', 'cursoID'));       
        
    }

    public function salvarExercicio(SalvarResposta $request, Exercicio $exercicio)
    {
        //return $request->all();
        $usuario = Auth::user();
        DB::beginTransaction();
        $transacoes = [];
        $numeroDeRespostasCorretas = 0;
        $numeroDeQuestoes = 0;
        foreach($request->all() as $questao => $respostaEscolhida) {
            if(substr($questao, 0, 7) == "questao") {
                $numeroDeQuestoes++;
                $questaoID = intval(substr($questao, 7));
                $respostaID = intval($respostaEscolhida);

                $respostaBD = Resposta::where('id', $respostaID)->first();
                if($respostaBD->correta) {
                    $numeroDeRespostasCorretas++;
                }

                $alunoResposta = AlunoResposta::where([
                    ['questao_id', $questaoID],
                    ['user_id', $usuario->id]
                ])->first();
                //Não existe resposta salva no BD ainda.
                if(empty($alunoResposta)) {
                    $resposta = new AlunoResposta;
                    $resposta->user_id = Auth::user()->id;
                    $resposta->questao_id = $questaoID;
                    $resposta->resposta_id = $respostaID;
                    $transacoes[] = $resposta->save();
                } else { // Atualiza o banco de dados
                    $alunoResposta->resposta_id = $respostaID;
                    $transacoes[] = $alunoResposta->save();
                }            
            }
        }

        //Salvar Nota do Exercicio
        $transacoes = 
        array_merge($transacoes, $this->salvarNota($usuario, $exercicio, $numeroDeQuestoes, $numeroDeRespostasCorretas));

        foreach ($transacoes as $transacao) {
            if(!$transacao) {
                flash()->erro('Ops!', 'Ocorreu um erro ao salvar no Banco de Dados, tente novamente');
                DB::rollBack();
                return back();
                break;
            } 
        }
        DB::commit();

        return $this->index($exercicio);
    }


    private function salvarNota(User $usuario, Exercicio $exercicio, $numeroDeQuestoes, $numeroDeRespostasCorretas) 
    {
        $salvou = [];
        $nota = Nota::where([
            ['user_id', $usuario->id],
            ['exercicio_id', $exercicio->id]
        ])->first();

        //Não existe nota salva no BD ainda.
        if(empty($nota)) {
            $nota = new Nota;
            $nota->user_id = $usuario->id;
            $nota->exercicio_id = $exercicio->id;
            $nota->nota = $this->calcularNota($numeroDeRespostasCorretas, $numeroDeQuestoes);
            $salvou[] = $nota->save();
        } else { // Atualiza o banco de dados
            $nota->nota = $this->calcularNota($numeroDeRespostasCorretas, $numeroDeQuestoes);
            $salvou[] = $nota->save();
        }

        // Verificar se com a inserção da Nota o Aluno foi aprovado no curso
        $exercicio->load('unidade.curso');
        $curso = $exercicio->unidade->curso;
        if($usuario->aprovado($curso)) {
            $salvou[] = $usuario->aprovar($curso);
        }         
        return $salvou;
    }

    private function calcularNota($corretas, $questoes)
    {
        return ($corretas * 100) / $questoes;
    }
}
