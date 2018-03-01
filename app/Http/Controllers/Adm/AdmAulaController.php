<?php

namespace App\Http\Controllers\Adm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SalvarAula;
use App\Http\Requests\SalvarArquivo;
use App\Aula;
use App\Arquivo;
use App\Unidade;
use User;

//Tentando arrumar o problema da nova aula
use App\UsuarioCurso;
use App\AlunoAula;

class AdmAulaController extends AdmController
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    
    public function indexAula(Aula $aula)
    {  
    	$aula->load('unidade.curso', 'arquivos');
    	return view('adm.aula.indexAula', compact('aula'));
    }


    public function salvarAula(SalvarAula $request, Unidade $unidade)
    {
    	$aula = new Aula();
    	$aula->nome = $request->nomeAula;
    	$aula->texto = $request->texto;
    	$aula->vimeoID = $request->vimeoID;
    	$aula->publicada = false;
    	$aula->unidade_id = $unidade->id;
    	$aula->save();
        $aulaId = $aula->id;

        //Tentando salvar uma nova linha AlunoAula para cada aluno

        //Quero saber a qual curso pertence a aula        
        $curso_id = $aula->unidade->curso->id;

        //Com o ID do curso, quero todos os alunos que estão matriculados nele
        $alunosNoCurso = UsuarioCurso::where('curso_id', $curso_id)->get();

        //Para cada aluno eu quero criar uma entrada em AlunoAula com o ID do aluno e o ID da aula criada
        foreach($alunosNoCurso as $alunoNoCurso){
            $aluno_aula = new AlunoAula();
            $aluno_aula->user_id = $alunoNoCurso->user_id;
            $aluno_aula->aula_id = $aulaId;
            $aluno_aula->assistida = false;
            $aluno_aula->save();
        }

    	return back();
    }



    public function atualizarAula(SalvarAula $request, Aula $aula)
    {
    	$aula->nome = $request->nomeAula;
    	$aula->texto = $request->texto;
    	$aula->vimeoID = $request->vimeoID;
    	$aula->publicada = boolval($request->publicada);

    	//salva no BD
    	$salvou = $aula->save();
    	if($salvou)
    	{
    		flash()->sucesso('Sucesso!', 'Aula editada com sucesso!');
    		return redirect('adm/aula/' . $aula->id);
    	}
    	else 
    	{
    		flash()->erro('Ops!', 'Ocorreu um erro ao editar a aula.');
    		return back();
    	}
    }

    public function uploadArquivo(SalvarArquivo $request, Aula $aula) 
    {
        $nomeDoArquivo = $request->nomeDoArquivo .'.'. $request->arquivo->getClientOriginalExtension();
        $caminho = "aulas/" . $aula->id . "/";

        $arquivoBD = Arquivo::where([
            ['aula_id', $aula->id],
            ['nome', $nomeDoArquivo]
        ])->first();

        $transacoes = [];
        //Salvar a foto no caminho
        $transacoes[] = $request->file('arquivo')->move($caminho, $nomeDoArquivo);

        if(empty($arquivoBD)) {
            $arquivo = new Arquivo;
            $arquivo->aula_id = $aula->id;
            $arquivo->nome = $nomeDoArquivo;
            $arquivo->caminho = $caminho;
            $transacoes[] = $arquivo->save();
        } else {
            // Atualiza apenas o updated_at
            $transacoes[] = $arquivoBD->touch();
        }

        foreach ($transacoes as $transacao) {
            if(!$transacao) {
                flash()->erro('Ops!', 'Ocorreu um erro ao realizar o upload do arquivo, tente novamente');
                return back();
                break;
            } 
        }
        flash()->sucesso('OK', 'Arquivo adicionado com sucesso');
        return back();
    }
}
