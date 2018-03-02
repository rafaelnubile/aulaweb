@extends('master')

@section('conteudo')
<h2 class="titulo">Bem vindo</h2>

<div class="mural">
    <div class="row">

        <div class="col-md-8 meusCursos">
            <div class="Box">
                <h4>Meus Cursos</h4>

                @if(count($user->cursos) <= 0)
                    <div class="cursoStatus">
                        <h3>Matricule-se em um curso e bons estudos.</h3>                       
                    </div>                    
                @else
                    @foreach($user->cursos as $cursoAluno)
                        <div class="cursoStatus">
                            <h3><a href="/curso/{{$cursoAluno->id}}">{{$cursoAluno->nome}}</a></h3>
                            <!-- <p>0/14 aulas - <a href="#">Continuar</a> -->
                        </div>
                    @endforeach
                @endif             

            </div>
        </div>

        <div class="col-md-4 avisoBox">
            <div class="Box">
                <h4>Avisos</h4>

                @if(empty($avisosEmOrdem))
                    <div class="avisos">
                        <H3>Boas aulas!</H3>
                    </div>
                    
                @else
                    @foreach($avisosEmOrdem as $aviso)
                        <div class="avisos">
                            <i class="fa fa-sticky-note" aria-hidden="true"></i>
                            <a href="#" data-toggle="modal" data-target="#myModal{{$aviso->id}}">{{$aviso->titulo}}</a>
                        </div>

                        <!-- Modal -->
                        <div id="myModal{{$aviso->id}}" class="modal fade" role="dialog">
                          <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content centered">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h3 class="modal-title">{{$aviso->titulo}}</h3>
                              </div>
                              <div class="modal-body">
                                <p>{{$aviso->aviso}}</p>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                              </div>
                            </div>

                          </div>
                        </div>      
                    @endforeach
                @endif
            </div>
        </div>

    </div>
    
</div>

@foreach ($cursos->chunk(3) as $row)
        <div class="row">
            @foreach ($row as $curso)
                @if($curso->publicado == true)
                    <div class="col-md-4">
                        <a href="/curso/{{$curso->id}}">
                            <div class="quadroIndex">               
                                <h2>{{ $curso->nome }}</h2>
                                <p>{{ $curso->professor }}</p>
                            </div>
                        </a>
                    </div>
                @endif
            @endforeach
        </div>
    @endforeach







@endsection
