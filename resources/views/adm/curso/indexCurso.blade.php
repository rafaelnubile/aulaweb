@extends('master')

@section('conteudo')
<h2 class="titulo">{{$curso->nome}}</h2>

<div class="mural">
    <div class="row">

        <div class="col-md-8">
            <div class="Box meusCursos">
                <h4>Informações sobre o curso</h4>
                 
                <div class="cursoStatus">
                   
                    <h5>Descrição do curso:</h5>
                    <p>{{$curso->descricao}}</p>

                    <div class="row">
                        <div class="col-sm-6">
                            <h5>Professor:</h5>
                            <p>{{$curso->professor}}</p>

                            <h5>Palavras-chave:</h5>
                            <p>{{$curso->palavrasChave}}</p>
                        </div>
                        <div class="col-sm-6">
                            <h5>Link do Vimeo:</h5>
                            <p>www.vimeo.com/{{$curso->vimeoID}}</p>

                            <h5>Publicado:</h5>
                            @if($curso->publicado)
                                <p>Sim</p>
                            @else
                                <p>Não</p>
                            @endif   
                        </div>
                    </div>                    
                    <br>
                    <a href="/adm/curso/{{$curso->id}}/editar"><button class="btn btn-warning btn-block">Editar</button></a>
                </div>
            </div>

            <div class="Box meusCursos">
                <h4>Unidades</h4>

                <div class="cursoStatus">
                    @foreach($curso->unidades as $index=>$unidade)
                        @if($unidade->publicada == 1)                     
                            <h3>
                        @else
                            <h3 class="foraDoAr">
                        @endif
                        <a href="/adm/unidade/{{$unidade->id}}">{{$index+1}} - {{$unidade->nome}}</a></h3>               
                    @endforeach
                </div>  

                <div class="novoItem">
                    <h5>Nova Unidade</h5>

                    <form method="POST" action="/adm/{{$curso->id}}/salvarUnidade">
                        {{csrf_field()}}
                        
                        <div class="form-group cursoStatus">
                            <label for="nomeUnidade">Título da unidade:</label>
                            <input type="text" class="form-control" id="nomeUnidade" name="nomeUnidade">
                            @if ($errors->has('nomeUnidade'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('nomeUnidade') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="cursoStatus">
                           <button type="submit" class="btn btn-success btn-block">Criar</button><br>            
                        </div>
                    </form> 
                </div> <!-- Fecha .novoItem -->
                

            </div> <!-- Fecha Box MeusCursos -->
        </div> <!-- Fecha col-md-8 -->

     

        <div class="col-md-4 avisoBox">            

            

            <div class="Box">    
             <h4>Alunos</h4>            
                <div class="avisos">
                    <a href='{{url("/adm/curso/$curso->id/avaliacao")}}' class="btn btn-block btn-warning">
                        Avaliações do curso
                    </a>
                    <hr>

                    <!-- CARREGAR LISTA DE ALUNOS MATRICULADOS -->
                    @foreach($curso->usuarios as $aluno)
                        <p>
                            <a href='{{url("/adm/aluno/$aluno->id")}}'>
                                {{$aluno->name}}
                            </a>                            
                        </p>
                    @endforeach

                </div>
            </div>
        </div>

    </div>
    
</div>
@endsection
