<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Exercicio;
use App\UsuarioCurso;

class AlunoInscritoNoCurso
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $exercicioID = intval(substr(strrchr(request()->url(), "/"), 1));
        $exercicio = Exercicio::where('id', $exercicioID)->firstOrFail();
        $exercicio->load('unidade.curso');
        $usuario = Auth::user();

        $usuarioCurso = UsuarioCurso::where([
                    ['user_id', $usuario->id],
                    ['curso_id', $exercicio->unidade->curso->id]
        ])->first();
        
        //Se ele nao for adm, redireciona pra home
        if(empty($usuarioCurso) || !$exercicio->publicado)
        {
            return redirect('/home');
        }

        return $next($request);
    }
}
