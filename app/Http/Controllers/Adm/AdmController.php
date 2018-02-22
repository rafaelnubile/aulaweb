<?php

namespace App\Http\Controllers\Adm;

use Illuminate\Http\Request;
use App\Http\Requests\SalvarAviso;
use App\Http\Controllers\Controller;
use App\Curso;
use App\Aviso;
use App\User;


class AdmController extends Controller
{
	public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
    	$cursos = Curso::all();
        $avisos = Aviso::all();
        $avisosEmOrdem = $avisos->sortByDesc('created_at');       
    	return view('adm.index', compact('cursos', 'avisosEmOrdem'));
    }

    public function novoAviso()
    {
    	return view('adm.novoaviso');
    }

    public function salvarAviso(SalvarAviso $request)
    {
        $aviso = new Aviso();
        $aviso->titulo = $request->titulo;
        $aviso->aviso = $request->aviso;
        $aviso->aviso_expira = $request->validade;

        //salva no BD
        $salvou = $aviso->save();

        if($salvou)
        {
            flash()->sucesso('Sucesso!', 'Aviso criado com sucesso!');
            return redirect('adm/');
        }
        else 
        {
            flash()->erro('Ops!', 'Ocorreu um erro ao criar o aviso.');
            return back();
        }
    }

    public function deletarAviso(Aviso $aviso, $id)
    {           
        $avisoRemovido = Aviso::where('id', $id)->delete();       
        return back();
    }


    public function membros()
    {
        $alunos = User::where('tipo_usuario_id', 2)->get();
        $administradores = User::where('tipo_usuario_id', 1)->get();
    	return view('adm.membros', compact('alunos', 'administradores'));
    }

}
