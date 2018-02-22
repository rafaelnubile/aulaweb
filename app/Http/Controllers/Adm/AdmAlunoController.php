<?php

namespace App\Http\Controllers\Adm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Curso;
use App\AlunoAula;

class AdmAlunoController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('admin');
    // }

    public function aluno(User $user)
    {    	
    	$user->load('cursos.unidades.exercicios');

    	foreach($user->cursos as $curso) {
    		$curso->dadosAulasAssistidas = $user->dadosAulasAssistidas($curso);
    		//return $curso->calcularNota($user);
    	}
    	//return $user;
    	return view('adm.aluno.aluno', compact('user'));
    }

}
