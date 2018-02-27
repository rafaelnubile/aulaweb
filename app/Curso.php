<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
     protected $table = 'cursos';
     protected $fillable = [
        'nome', 'professor', 'descricao', 'categoria_id', 'linkVideoIntro'
    ];


    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'usuario_cursos', 'curso_id', 'user_id');
    }


    public function unidades()
    {
    	return $this->hasMany(Unidade::class);
    }


    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }


    public function avaliacaoCurso()
    {
        return $this->hasMany(AvaliacaoCurso::class);
    }

    public function exercicios()
    {
        return $this->hasManyThrough('App\Exercicio', 'App\Unidade');
    }

    public function aulas()
    {
        return $this->hasManyThrough('App\Aula', 'App\Unidade');
    }

    public function usuarioCurso()
    {
        return $this->hasMany('App\UsuarioCurso');
    }   



    public function numeroDeAulas() {
        $this->load('aulas');
        return count($this->aulas);
    }

    public function calcularNota(User $usuario) {
        //return $this->exercicios;
        $somaDasNotas = 0;
        $numeroDeExerciciosPublicados = 0;
        $this->load(['exercicios' => function ($query) {
            $query->where('publicado', '=', true);
        }]);
       $numeroDeExerciciosPublicados = count($this->exercicios);
       if ($numeroDeExerciciosPublicados == 0) {
            return $numeroDeExerciciosPublicados == 1;
       }

       foreach($this->exercicios as $exercicio) {
            $notaBD = Nota::where([
                ['user_id', $usuario->id],
                ['exercicio_id', $exercicio->id]
            ])->first();

            if(empty($notaBD)) {
                $somaDasNotas += 0;
            } else {
                $somaDasNotas += $notaBD->nota;
            }
       }

       return $somaDasNotas / $numeroDeExerciciosPublicados;
    }


}
