<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Arquivo extends Model
{
    protected $table = 'arquivos';

    protected $fillable = [
        'aula_id', 'nome', 'caminho'
    ];

    public function aula()
    {
    	return $this->belongsTo(Aula::Class);
    }
}
