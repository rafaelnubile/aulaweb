<?php

namespace App\Http\Controllers\Adm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdmSalvarResposta;
use Illuminate\Support\Facades\DB;
use App\Questao;
use App\Resposta;
use App\AlunoResposta;


class AdmRespostaController extends Controller
{
	public function __construct()
    {
        $this->middleware('admin');
    }

    public function salvarResposta(AdmSalvarResposta $request, Questao $questao)
	{
		$resposta = new Resposta;
    	$resposta->txt_afirmativa = $request->txt_afirmativa;
    	$resposta->questao_id = $questao->id;
    	$resposta->correta = boolval($request->correta);
    	$resposta->save();
    	return back();
	}

	public function indexResposta(Resposta $resposta)
	{
		$resposta->load('questao.exercicio');
		return view('adm.resposta.indexResposta', compact('resposta'));
	}

	public function atualizarResposta(AdmSalvarResposta $request, Resposta $resposta)
    {
    	$resposta->txt_afirmativa = $request->txt_afirmativa;
    	$resposta->correta = $request->correta;

    	//salva no BD
    	$salvou = $resposta->save();
    	if($salvou)
    	{
    		flash()->sucesso('Sucesso!', 'Afirmativa editada com sucesso!');
    		return redirect('adm/questao/' . $resposta->questao->id);
    	}
    	else 
    	{
    		flash()->erro('Ops!', 'Ocorreu um erro ao editar a afirmativa.');
    		return back();
    	}
    	
    }

    public function deletarResposta(Resposta $resposta)    
	{
		DB::beginTransaction();
		$transacoes = [];
		$questaoID = $resposta->questao->id;
		$alunoRespostas = AlunoResposta::where('resposta_id', $resposta->id)->get();
		//Deletar resposta da tabela AlunoResposta
		if(count($alunoRespostas) > 0) {
			foreach($alunoRespostas as $alunoResposta) {
				$transacoes[]= $alunoResposta->delete();
			}
		}	
		//Deletar resposta da tabela respostas
		$transacoes[] = $resposta->delete();
		foreach ($transacoes as $transacao) {
            if(!$transacao) {
                flash()->erro('Ops!', 'Ocorreu um erro ao deletar a afirmativa no Banco de Dados, tente novamente');
                DB::rollBack();
                return redirect('adm/questao/' . $questaoID);
                break;
            } 
        }
        DB::commit();
        flash()->sucesso('OK', 'Afirmativa deletada do Banco de Dados com sucesso');
		return redirect('adm/questao/' . $questaoID);		
	}
}
