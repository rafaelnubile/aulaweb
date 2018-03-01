<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aula extends Model
{
	protected $table = 'aulas';

    public function unidade()
    {
    	return $this->belongsTo(Unidade::Class);
    }

    public function arquivos()
    {
    	return $this->hasMany(Arquivo::Class);
    }

    public function usuarios()
    {
    	return $this->belongsToMany(User::class, 'aluno_aula', 'user_id', 'aula_id');
    }



}
