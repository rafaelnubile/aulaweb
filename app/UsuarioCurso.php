<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsuarioCurso extends Model
{
    protected $table = 'usuario_cursos';
    
    protected $fillable = [
        'user_id', 'curso_id', 'avaliacao', 'comentario'
    ];
}
