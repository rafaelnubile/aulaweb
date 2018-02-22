<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categorias';

    public function cursos()
    {
        return $this->hasMany(Curso::class);
    }
}
