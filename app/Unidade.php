<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unidade extends Model
{
	protected $table = 'unidades';
	
    public function curso()
    {
    	return $this->belongsTo(Curso::Class);
    }

    public function aulas()
    {
    	return $this->hasMany(Aula::Class);
    }

    public function exercicios()
    {
    	return $this->hasMany(Exercicio::class);
    }
}
