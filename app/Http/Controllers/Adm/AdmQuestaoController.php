<?php

namespace App\Http\Controllers\Adm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SalvarQuestao;
use Illuminate\Support\Facades\DB;
use App\Exercicio;
use App\Questao;
use App\Resposta;
use App\AlunoResposta;

class AdmQuestaoController extends Controller
{
	public function __construct()
    {
        $this->middleware('admin');
    }

    public function indexQuestao(Questao $questao)
	{
		$questao->load('respostas', 'exercicio');
		return view('adm.questao.indexQuestao', compact('questao'));
	}

	public function salvarQuestao(SalvarQuestao $request, Exercicio $exercicio)
	{
		$questao = new Questao;
    	$questao->texto = $request->textoQuestao;
    	$questao->exercicio_id = $exercicio->id;
    	$questao->save();
    	return back();
	}

	public function atualizarQuestao(SalvarQuestao $request, Questao $questao)
    {
    	$questao->texto = $request->textoQuestao;

    	//salva no BD
    	$salvou = $questao->save();
    	if($salvou)
    	{
    		flash()->sucesso('Sucesso!', 'Questão editada com sucesso!');
    		return redirect('adm/questao/' . $questao->id);
    	}
    	else 
    	{
    		flash()->erro('Ops!', 'Ocorreu um erro ao editar a questão.');
    		return back();
    	}
    	
    }

    public function deletarQuestao(Questao $questao)    
	{
		DB::beginTransaction();
		$transacoes = [];
		$exercicioID = $questao->exercicio_id;
		$alunoRespostas = AlunoResposta::where('questao_id', $questao->id)->get();

		//Deletar questao da tabela AlunoResposta
		if(count($alunoRespostas) > 0) {
			foreach($alunoRespostas as $alunoResposta) {
				$transacoes[]= $alunoResposta->delete();
			}
		}
		//Deletar questao da tabela respostas
		$respostas = Resposta::where('questao_id', $questao->id)->get();
		if(count($respostas) > 0) {
			foreach($respostas as $resposta) {
				$transacoes[]= $resposta->delete();
			}
		}

		//Deletar questao da tabela questao
		$transacoes[] = $questao->delete();
		foreach ($transacoes as $transacao) {
            if(!$transacao) {
                flash()->erro('Ops!', 'Ocorreu um erro ao deletar a questão do Banco de Dados, tente novamente');
                DB::rollBack();
                return redirect('adm/exercicio/' . $exercicioID);
                break;
            } 
        }
        DB::commit();
        flash()->sucesso('OK', 'Questão deletada do Banco de Dados com sucesso');
		return redirect('adm/exercicio/' . $exercicioID);		
	}
}
