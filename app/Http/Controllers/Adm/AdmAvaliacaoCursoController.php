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
    		if($info->avaliacao != null){
    			array_push($notas, $info->avaliacao);
    		}
    	}

    	$somaDasNotas = 0;
    	foreach ($notas as $nota) {
    		$somaDasNotas += $nota;
    	}    	

    	if($somaDasNotas > 0){
    		$mediaDasNotas = $somaDasNotas / count($notas);
    	} else {
    		$mediaDasNotas = "O curso ainda não foi avaliado.";
    	}


        $curso->mediaDasAvaliacoes = $mediaDasNotas;              
    	return view('adm.curso.avaliacaoCurso', compact('curso'));
    }
   
}
