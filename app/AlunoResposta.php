<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlunoResposta extends Model
{
    protected $table = 'aluno_respostas';
    protected $fillable = [
        'user_id', 'questao_id', 'resposta_id'
    ];
}
 