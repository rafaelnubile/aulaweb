<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class TemQueSerAdmin
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
        $usuario = Auth::user();
        
        //Se ele nao for adm, redireciona pra home
        if($usuario->tipo_usuario_id != 1)
        {
            return redirect('/home');
        }

        return $next($request);
    }
}
