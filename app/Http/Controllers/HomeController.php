<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Curso;
use App\UsuarioCurso;
use App\Aviso;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');      
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $user = Auth::user();
        if ($user->tipo_usuario_id == 1)
        {
            return redirect('/adm') ;
        }


        $cursos = Curso::all();
        $numeroDeCursos = count($cursos);
        $avisos = Aviso::all();
        $avisosEmOrdem = $avisos->sortByDesc('created_at');
        
        $user->load('cursos');       
        return view('home', compact('cursos', 'numeroDeCursos', 'user', 'avisosEmOrdem'));       
    }
   

}
