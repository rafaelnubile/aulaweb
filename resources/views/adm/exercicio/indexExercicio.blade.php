@extends('master')

@section('conteudo')
<h2 class="titulo"><a href="/adm/unidade/{{$exercicio->unidade->id}}">{{$exercicio->unidade->nome}}</a> / {{$exercicio->titulo}}</h2>

<div class="base">
    <div class="row">
        <div class="col-md-8 meusCursos">
            <div class="Box">
                
                <h4>Questões</h4>
                <div class="cursoStatus">
                    @if(count($exercicio->questaos) <= 0)
                        <h3>Ainda não existem questões criadas!</h3>
                    @else
                        @foreach($exercicio->questaos as $key=>$questao)
                            <p>
                                <a href='{{url("/adm/questao/$questao->id")}}'>{{$key+1}} - {{$questao->texto}}</a>
                            </p>
                            <hr>                      
                        @endforeach                            
                    @endif
                </div>


                <div class="novoItem">                  

                    <form method="POST" action="/adm/{{$exercicio->id}}/salvarQuestao">
                        {{csrf_field()}}               

                        <div class="form-group">
                            <label for="textoQuestao">Nova questão (Enunciado):</label>
                            <textarea class="form-control" id="textoQuestao" name="textoQuestao">{{old('textoQuestao') ? old('textoQuestao') : "" }}</textarea>
                            @if ($errors->has('textoQuestao'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('textoQuestao') }}</strong>
                                </span>
                            @endif
                        </div>
                       

                        <div class="unidadeStatus">
                           <button type="submit" class="btn btn-success btn-block">Criar questão</button><br>            
                        </div>
                    </form> 

                </div> <!-- fecha .novoItem -->

            </div>
        </div> <!-- fecha col md 8 -->

        <div class="col-md-4 avisoBox">

            <div class="Box meusCursos">

                <h4>Alterar Exercício</h4>                
                 
                <div class="cursoStatus">
                    <form method="POST" action="/adm/exercicio/{{$exercicio->id}}">

                        {{csrf_field()}}

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="tituloExercicio">Nome:</label>  
                                    <input type="text" class="form-control" id="tituloExercicio" name="tituloExercicio" value="{{old('tituloExercicio') ? old('tituloExercicio') : $exercicio->titulo}}">
                                    @if ($errors->has('tituloExercicio'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('tituloExercicio') }}</strong>
                                        </span>
                                    @endif
                                  </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="publicado">Publicado:</label>
                                    <select class="form-control" id="publicado" name="publicado">
                                        @if (old('publicado') == "0")
                                          <option selected="selected" value="0">Não</option>
                                        @elseif (!old('publicado') && $exercicio->publicado == "0")
                                          <option selected="selected" value="0">Não</option>
                                        @else
                                          <option value="0">Não</option>
                                        @endif

                                        @if (old('publicado') == "1")
                                          <option selected="selected" value="1">Sim</option>
                                        @elseif (!old('publicado') && $exercicio->publicado == "1")
                                          <option selected="selected" value="1">Sim</option>
                                        @else
                                          <option value="1">Sim</option>
                                        @endif
                                    </select>
                                    @if ($errors->has('publicado'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('publicado') }}</strong>
                                        </span>
                                    @endif
                                  </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-warning btn-block">Salvar Alterações</button>
                    </form>
                </div>
            </div>    
        </div> <!-- fim md 4 -->
        
    </div>
</div>
@endsection