<?php

namespace App\Http\Controllers\Adm;

use Illuminate\Http\Request;
use App\Http\Requests\SalvarCurso;
use App\Curso;
use App\Categoria;

class AdmCursoController extends AdmController
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    
    public function indexCurso(Curso $curso)
    {
    	$curso->load('usuarios', 'unidades');
    	return view('adm.curso.indexCurso', compact('curso', '$alunos', 'alunosMatriculados'));
    }

    public function criarCurso()
    {
    	$categorias = Categoria::all();        
    	return view('adm.curso.criar', compact('categorias'));
    }

    public function salvarCurso(SalvarCurso $request)
    {
    	$curso = new Curso();
    	$curso->nome = $request->nome;
    	$curso->professor = $request->professor;
    	$curso->descricao = $request->descricao;
    	$curso->categoria_id = $request->categoria_id;
    	$curso->palavrasChave = $request->palavrasChave;
    	$curso->vimeoID = $request->linkVideoIntro;
    	$curso->publicado = false;

    	//salva no BD
    	$salvou = $curso->save();

    	if($salvou)
    	{
    		flash()->sucesso('Sucesso!', 'Curso criado com sucesso!');
    		return redirect('adm/curso/' . $curso->id);
    	}
    	else 
    	{
    		flash()->erro('Ops!', 'Ocorreu um erro ao criar o curso.');
    		return back();
    	}
    }

    public function editarCurso(Curso $curso)
    {
    	$categorias = Categoria::all();
    	return view('adm.curso.editar', compact('curso', 'categorias'));
    }

    public function atualizarCurso(SalvarCurso $request, Curso $curso)
    {
    	$curso->nome = $request->nome;
    	$curso->professor = $request->professor;
    	$curso->descricao = $request->descricao;
    	$curso->categoria_id = $request->categoria_id;
    	$curso->palavrasChave = $request->palavrasChave;
    	$curso->vimeoID = $request->linkVideoIntro;
        $curso->categoria_id = $request->categoria_id;
    	$curso->publicado = boolval($request->publicado);

    	//salva no BD
    	$salvou = $curso->save();
    	if($salvou)
    	{
    		flash()->sucesso('Sucesso!', 'Curso editado com sucesso!');
    		return redirect('adm/curso/' . $curso->id);
    	}
    	else 
    	{
    		flash()->erro('Ops!', 'Ocorreu um erro ao editar o curso.');
    		return back();
    	}
    	return redirect('/adm/curso/' . $curso->id);
    }
}
