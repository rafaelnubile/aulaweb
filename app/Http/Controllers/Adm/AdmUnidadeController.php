<?php

namespace App\Http\Controllers\Adm;

use Illuminate\Http\Request;
use App\Http\Requests\SalvarUnidade;
use App\Unidade;
use App\Curso;
use App\Exercicio;

class AdmUnidadeController extends AdmController
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    
    public function indexUnidade(Unidade $unidade)
    {
    	$unidade->load('curso', 'aulas', 'exercicios');
        $numeroDeAulas = count($unidade->aulas);        
    	return view('adm.unidade.indexUnidade', compact('unidade', 'numeroDeAulas'));
    }

    public function salvarUnidade(SalvarUnidade $request, Curso $curso)
    {
    	$unidade = new Unidade();
    	$unidade->nome = $request->nomeUnidade;
    	$unidade->publicada = false;
    	$unidade->curso_id = $curso->id;
    	$unidade->save();
    	return back();
    }

    public function atualizarUnidade(SalvarUnidade $request, Unidade $unidade)
    {
    	$unidade->nome = $request->nomeUnidade;
    	$unidade->publicada = boolval($request->publicada);

    	//salva no BD
    	$salvou = $unidade->save();
    	if($salvou)
    	{
    		flash()->sucesso('Sucesso!', 'Unidade editada com sucesso!');
    		return redirect('adm/unidade/' . $unidade->id);
    	}
    	else 
    	{
    		flash()->erro('Ops!', 'Ocorreu um erro ao editar a unidade.');
    		return back();
    	}
    	
    }
}
