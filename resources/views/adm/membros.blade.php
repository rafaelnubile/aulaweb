@extends('master')

@section('conteudo')

<h2 class="titulo"><a href="/adm">Voltar</a></h2>

<div class="base">
    <div class="row">

        <div class="col-md-8 meusCursos">

            <div class="Box">

              <h4>Alunos</h4>
              <div class="cursoStatus">                    
                    @foreach($alunos as $aluno)
                      <p><a href='{{url("/adm/aluno/$aluno->id")}}'>{{$aluno->name}}</a></p>
                    @endforeach
              </div> <!-- fecha cursoStatus -->
            </div> <!-- fecha Box -->


            <div class="Box">
              <h4>Administradores</h4>
              <div class="cursoStatus">
                @foreach($administradores as $administrador)
                  <p>{{ucwords(strtolower($administrador->name))}}</p>
                @endforeach                    
              </div> <!-- fecha cursoStatus -->
            </div> <!-- fecha Box -->

        </div> <!-- fecha col-md-8 meusCursos -->     

    </div> <!-- fecha row -->    
</div> <!-- fecha base --> 


@endsection
