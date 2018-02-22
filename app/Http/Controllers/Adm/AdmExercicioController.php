<?php

namespace App\Http\Controllers\Adm;

use Illuminate\Http\Request;
use App\Http\Requests\SalvarUnidade;
use App\Unidade;
use App\Exercicio;
use App\Http\Requests\SalvarExercicio;
use App\Curso;

class AdmExercicioController extends AdmController
{
	public function __construct()
    {
        $this->middleware('admin');
    }

    public function indexExercicio(Exercicio $exercicio)
	{
		$exercicio->load('questaos', 'unidade');
		return view('adm.exercicio.indexExercicio', compact('exercicio'));
	}

	public function salvarExercicio(SalvarExercicio $request, Unidade $unidade)
	{
		$exercicio = new Exercicio;
    	$exercicio->titulo = $request->tituloExercicio;
    	$exercicio->publicado = false;
    	$exercicio->unidade_id = $unidade->id;
    	$exercicio->save();
    	return back();
	}

	public function atualizarExercicio(SalvarExercicio $request, Exercicio $exercicio)
    {
    	$exercicio->titulo = $request->tituloExercicio;
    	$exercicio->publicado = boolval($request->publicado);

    	//salva no BD
    	$salvou = $exercicio->save();
    	if($salvou)
    	{
    		flash()->sucesso('Sucesso!', 'Exercício editado com sucesso!');
    		return redirect('adm/exercicio/' . $exercicio->id);
    	}
    	else 
    	{
    		flash()->erro('Ops!', 'Ocorreu um erro ao editar o exercício.');
    		return back();
    	}
    	
    }
}