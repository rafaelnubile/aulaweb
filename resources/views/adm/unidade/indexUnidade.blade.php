@extends('master')

@section('conteudo')
<h2 class="titulo"><a href="/adm/curso/{{$unidade->curso->id}}">{{$unidade->curso->nome}}</a> / {{$unidade->nome}}</h2>

<div class="mural">
    <div class="row">

        <div class="col-md-8">

            <div class="Box meusCursos">
                <h4>Aulas</h4>
                 
                <div class="cursoStatus">

                    @if($numeroDeAulas == 0)
                        <h3>Ainda não existem aulas criadas!</h3>
                    @else
                        @foreach($unidade->aulas as $key=>$aula)
                            @if($aula->publicada == 1)
                                <h3>
                            @else
                                <h3 class="foraDoAr">
                            @endif
                            <a href="/adm/aula/{{$aula->id}}">{{$key+1}} - {{$aula->nome}}</a></h3>                            
                        @endforeach                            
                    @endif                    
                </div> <!-- fecha .cursoStatus --> 

                <div class="novoItem">
                   <h5>Criar Aula</h5>

                    <form method="POST" action="/adm/{{$unidade->id}}/salvarAula">
                        {{csrf_field()}}
                    
                        <div class="form-group">
                            <label for="nomeAula">Título da aula:</label>
                            <input type="text" class="form-control" id="nomeAula" name="nomeAula" value="{{old('nomeAula') ? old('nomeAula') : ''}}">
                            @if ($errors->has('nomeAula'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('nomeAula') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="texto">Texto:</label>
                            <textarea class="form-control" id="texto" name="texto">{{old('texto') ? old('texto') : "" }}</textarea>
                            @if ($errors->has('texto'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('texto') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="vimeoID">Vídeo da Aula (colar apenas o número Vimeo):</label>
                            <input type="text" class="form-control" id="vimeoID" name="vimeoID" value="{{old('vimeoID') ? old('vimeoID') : ''}}">
                            @if ($errors->has('vimeoID'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('vimeoID') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="unidadeStatus">
                           <button type="submit" class="btn btn-success btn-block">Criar Aula</button><br>            
                        </div>
                    </form> 

                </div> <!-- fecha .novaAula -->                 
            </div> <!-- fecha .Box MeusCursos --> 



            <!-- QUADRO DOS EXERCÍCIOS -->
            <div class="Box MeusCursos">
                <h4>Exercícios</h4>
                 
                <div class="cursoStatus">
                    @if(empty($unidade->exercicios))
                        <h3>Ainda não existem exercícios criados!</h3>
                    @else
                        @foreach($unidade->exercicios as $key=>$exercicio)
                            @if($exercicio->publicado == 1)
                                <h3>
                            @else
                                <h3 class="foraDoAr">
                            @endif
                            <a href='{{url("/adm/exercicio/$exercicio->id")}}'>{{$key+1}} - {{$exercicio->titulo}}</a></h3>                            
                        @endforeach                            
                    @endif       

                    <div class="novoItem">                        
                    
                        <form method="POST" action="/adm/{{$unidade->id}}/salvarExercicio">
                            {{csrf_field()}}
                        
                            <div class="form-group">
                                <label for="tituloExercicio">Título do exercício:</label>
                                <input type="text" class="form-control" id="tituloExercicio" name="tituloExercicio" value="{{old('tituloExercicio') ? old('tituloExercicio') : ''}}">
                                @if ($errors->has('tituloExercicio'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tituloExercicio') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="unidadeStatus">
                               <button type="submit" class="btn btn-success btn-block">Criar Exercício</button><br>
                            </div>

                        </form>
                    </div>
                </div>
            </div>


        </div> <!-- fecha .col-md-8 --> 


        <div class="col-md-4 avisoBox">

            <div class="Box meusCursos">

                <h4>Alterar Unidade</h4>                
                 
                <div class="cursoStatus">
                    <form method="POST" action="/adm/unidade/{{$unidade->id}}">

                        {{csrf_field()}}

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="nomeUnidade">Nome:</label>  
                                    <input type="text" class="form-control" id="nomeUnidade" name="nomeUnidade" value="{{old('nomeUnidade') ? old('nomeUnidade') : $unidade->nome}}">
                                    @if ($errors->has('nomeUnidade'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('nomeUnidade') }}</strong>
                                        </span>
                                    @endif
                                  </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="publicado">Publicada:</label>
                                    <select class="form-control" id="publicada" name="publicada">
                                        @if (old('publicada') == "0")
                                          <option selected="selected" value="0">Não</option>
                                        @elseif (!old('publicada') && $unidade->publicada == "0")
                                          <option selected="selected" value="0">Não</option>
                                        @else
                                          <option value="0">Não</option>
                                        @endif

                                        @if (old('publicada') == "1")
                                          <option selected="selected" value="1">Sim</option>
                                        @elseif (!old('publicada') && $unidade->publicada == "1")
                                          <option selected="selected" value="1">Sim</option>
                                        @else
                                          <option value="1">Sim</option>
                                        @endif
                                    </select>
                                    @if ($errors->has('publicada'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('publicada') }}</strong>
                                        </span>
                                    @endif
                                  </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-warning btn-block">Salvar Alterações</button>
                    </form>
                </div>
            </div>

                
        </div>
    </div>    
</div>
@endsection
