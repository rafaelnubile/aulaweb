<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resposta extends Model
{
    protected $table = 'respostas';

    public function questao()
    {
    	return $this->belongsTo(Questao::class);
    }
}
