<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlunoAula extends Model
{
    protected $table = 'aluno_aula';
    protected $fillable = [
        'user_id', 'aula_id', 'assistida'
    ];

    public function users()
    {
    	return $this->belongsToMany(User::class);
    }

    public function aulas()
    {
    	return $this->belongsToMany(Aula::class);
    }

}
