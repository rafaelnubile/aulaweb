<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exercicio extends Model
{
    protected $table = 'exercicios';
    protected $fillable = [
        'unidade_id', 'titulo', 'publicado'
    ];

    public function unidade()
    {
    	return $this->belongsTo(Unidade::class);
    }

    public function questaos()
    {
    	return $this->hasMany(Questao::class);
    }

    public function notas()
    {
        return $this->hasMany(Nota::class);
    }

}
