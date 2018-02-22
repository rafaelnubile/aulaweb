<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AvaliacaoCurso extends Model
{
    protected $table = 'avaliacao_cursos';

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function curso()
    {
    	return $this->belongsTo(Curso::class);
    }
}
