<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function tipoUsuario()
    {
        return $this->belongsTo(tipoUsuario::class);
    }

    public function cursos()
    {
        return $this->belongsToMany(Curso::class, 'usuario_cursos', 'user_id',  'curso_id');
    }

    public function avaliacaoCurso()
    {
        return $this->hasMany(AvaliacaoCurso::class);
    }

    public function notas()
    {
        return $this->hasMany(Nota::class);
    }

    public function aulas()
    {
        return $this->belongsToMany(Aula::class, 'aluno_aula', 'user_id', 'aula_id');
    }



    public function dadosAulasAssistidas(Curso $curso) {
        $dadosAulasAssistidas = [
            "numeroAulasAssistidas" => 0,
            "numeroAulasDoCurso" => 0,
            "unidades" => [],
            "percentualAulasAssistidas" => 0
        ];

        $numeroAulasAssistidas = 0;
        $numeroAulasDoCurso = 0;
        $curso->load('unidades.aulas');
        foreach($curso->unidades as $unidade) {
            $dadosAulasAssistidas["unidades"][$unidade->nome] = [];
            foreach($unidade->aulas as $aula) {
                $numeroAulasDoCurso++;
                $alunoAula = AlunoAula::where([
                    ['user_id', $this->id],
                    ['aula_id', $aula->id]
                ])->first();
                if($alunoAula->assistida) {
                    $numeroAulasAssistidas++;
                    $dadosAulasAssistidas["unidades"][$unidade->nome][$aula->nome] = true;
                } else {
                    $dadosAulasAssistidas["unidades"][$unidade->nome][$aula->nome] = false;
                }
            }
        }
        $dadosAulasAssistidas[ "numeroAulasAssistidas"] = $numeroAulasAssistidas;
        $dadosAulasAssistidas[ "numeroAulasDoCurso"] = $numeroAulasDoCurso;
        $dadosAulasAssistidas["percentualAulasAssistidas"] = 
            ($numeroAulasAssistidas / $numeroAulasDoCurso) * 100.0;

        return $dadosAulasAssistidas;
    }

    public function numeroDeAulasAssistidas(Curso $curso) {
        $aulasAssistidas = 0;
        $usuario = Auth::user();
        $curso->load('aulas');
        foreach($curso->aulas as $aula) {
            $alunoAula = AlunoAula::where([
                    ['aula_id', $aula->id],
                    ['user_id', $usuario->id],
                    ['assistida', true]
            ])->first();
            if(!empty($alunoAula)) {
                    $aulasAssistidas++;
            } 
        }
        return $aulasAssistidas;
    }

    // Retorna uma bool se o aluno tiver assistido 100% dos videos e tirado >= 70 nos exercicios
    public function aprovado(Curso $curso) 
    {
        $aprovado = false;
        if (($curso->numeroDeAulas() == $this->numeroDeAulasAssistidas($curso)) && 
            ($curso->calcularNota($this) >= 70)) {
                $aprovado = true;
        }        
        return $aprovado;
    }

    // Se o aluno tiver aprovado, mudar o BD o aprovado.
    public function aprovar(Curso $curso) {
            $usuario = Auth::user();
            $usuarioCurso = UsuarioCurso::where([
                ['user_id', $usuario->id],
                ['curso_id', $curso->id]
            ])->first();

            if(!empty($usuarioCurso)) {
                $usuarioCurso->aprovado = true;
                return $usuarioCurso->save();
            }
            return false;    
    }


}
