<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoUsuario extends Model
{
    protected $table = 'tipo_usuarios';
    public function usuarios()
    {
    	return $this->hasMany(User::class);
    }
}
