@extends('master')

@section('conteudo')
<h2 class="titulo"><a href='{{ URL::previous() }}'>Voltar</a> - {{$user->name}} </h2> 

<div class="mural">
    <div class="row">
        <div class="col-md-8">

            @foreach($user->cursos as $curso)
                <div class="Box meusCursos">
                    <h4><a href='{{url("/adm/curso/$curso->id")}}'>{{$curso->nome}}</a></h4>
                    <div class="cursoStatus">                  
                        
                        <h5>Percentual de aulas assistidas: {{$curso->dadosAulasAssistidas["percentualAulasAssistidas"]}}% | Nota do aluno: {{$curso->calcularNota($user)}} 
                            @if($user->aprovado($curso))
                                <small>(APROVADO)</small>
                            @else
                                <small>(INCOMPLETO)</small>
                            @endif
                        </h5>
                        
                        

                        <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo">Ver relatório</button>
                        <div id="demo" class="collapse">

                            @foreach($curso->dadosAulasAssistidas["unidades"] as $nomeUnidade => $aulas)
                            <h3>{{$nomeUnidade}}</h3>

                                @foreach($aulas as $nomeDaAula => $assistida)
                                    @if(!$assistida)
                                        <p class="vermelho">{{$nomeDaAula}}</p>
                                    @else
                                        <p class="verde">{{$nomeDaAula}}</p>
                                    @endif
                                @endforeach

                                <!-- rodar foreach das notas dos exercicios -->

                            @endforeach
                        </div>
                       
                    </div>
                </div>
            @endforeach

            
        </div> <!-- Fecha col-md-8 -->


    </div>
    
</div>
@endsection
