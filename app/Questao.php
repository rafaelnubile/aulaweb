<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questao extends Model
{
    protected $table = 'questaos';

    public function exercicio()
    {
    	return $this->belongsTo(Exercicio::class);
    }

    public function respostas()
    {
    	return $this->hasMany(Resposta::class);
    }
}
