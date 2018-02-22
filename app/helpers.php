<?php

function flash($titulo = null, $mensagem = null)
{
	$flash = app('App\Http\Flash');

	if(func_num_args() == 0){
		return $flash;
	}

	return $flash->info($titulo, $mensagem);
}