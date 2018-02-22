<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
     protected $table = 'notas';
     protected $fillable = [
        'user_id', 'unidade_id', 'nota'
    ];

     public function usuario()
    {
        return $this->belongsTo(User::class);
    }

     public function exercicio()
    {
        return $this->belongsTo(Exercicio::class);
    }
}
