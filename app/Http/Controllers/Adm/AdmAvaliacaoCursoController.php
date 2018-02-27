<?php

namespace App\Http\Controllers\Adm;
use Illuminate\Http\Request;
use App\Curso;


class AdmAvaliacaoCursoController extends AdmController
{       
    public function indexAvaliacao(Curso $curso)
    {
    	$curso->load('usuarioCurso');
    	$notas = [];
    	foreach($curso->usuarioCurso as $info){
    		array_push($notas, $info->avaliacao);
    	}
    	$somaDasNotas = 0;
    	foreach ($notas as $nota) {
    		$somaDasNotas += $nota;
    	}
    	$somaDasNotas;
    	$mediaDasNotas = $somaDasNotas / count($notas);


        $curso->mediaDasAvaliacoes = $mediaDasNotas;              
    	return view('adm.curso.avaliacaoCurso', compact('curso'));
    }
   
}
