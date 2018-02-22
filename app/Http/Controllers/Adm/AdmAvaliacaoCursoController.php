<?php

namespace App\Http\Controllers\Adm;
use Illuminate\Http\Request;
use App\Curso;


class AdmAvaliacaoCursoController extends AdmController
{       
    public function indexAvaliacao(Curso $curso)
    {
    	$curso->load('avaliacaoCurso');
        $curso->mediaDasAvaliacoes = $curso->mediaAvaliacoes($curso->avaliacaoCurso);  
        //return $curso;      
    	return view('adm.curso.avaliacaoCurso', compact('curso'));
    }
   
}
