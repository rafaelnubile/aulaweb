@extends('master')

@section('conteudo')
<h2 class="titulo"><a href="/adm/exercicio/{{$questao->exercicio->id}}">{{$questao->exercicio->titulo}}</a> / Questão {{$questao->id}}</h2>

<div class="base">
    <div class="row">
        <div class="col-md-8 meusCursos">
            <div class="Box">
                <h4>Enunciado</h4>
                <div class="cursoStatus">
                    <form method="POST" action="/adm/questao/{{$questao->id}}">

                        {{csrf_field()}}

                        <div class="form-group">
                            <textarea class="form-control" id="textoQuestao" name="textoQuestao">{{old('textoQuestao') ? old('textoQuestao') : $questao->texto }}</textarea>
                            @if ($errors->has('textoQuestao'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('textoQuestao') }}</strong>
                                </span>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-warning btn-block">Salvar Alterações</button>
                    </form>
                     <br>
                    
                    <a href='{{url("/adm/questao/$questao->id/delete")}}'>                    
                        <button class="btn btn-danger btn-block">Apagar Questão</button>
                    </a>
                </div>
            </div>

            <div class="Box">
                <h4>Afirmativas</h4>
                <div class="cursoStatus">
                    @if(count($questao->respostas) <= 0)
                        <h3>Ainda não existem afirmativas cadastradas para esta questão!</h3>
                    @else
                        @foreach($questao->respostas as $key=>$resposta)
                            @if($resposta->correta)
                            <p>
                                <a style="color:green" href='{{url("/adm/resposta/$resposta->id")}}'>{{$key+1}} - {{$resposta->txt_afirmativa}} (CORRETA)</a>
                            </p> 
                            @else
                            <p >
                                <a style="color:red" href='{{url("/adm/resposta/$resposta->id")}}'>{{$key+1}} - {{$resposta->txt_afirmativa}} (INCORRETA)</a>
                            </p> 
                            @endif
                            <hr>                       
                        @endforeach                            
                    @endif 
                </div>
                <div class="novoItem">                  

                    <form method="POST" action="/adm/{{$questao->id}}/salvarResposta">
                        {{csrf_field()}}                    
                        
                        <div class="form-group">
                            <label for="txt_afirmativa">Afirmativa:</label>
                            <textarea class="form-control" id="txt_afirmativa" name="txt_afirmativa">{{old('txt_afirmativa') ? old('txt_afirmativa') : "" }}</textarea>
                            <input type="radio" name="correta" value=1> Correta
                            <input type="radio" name="correta" value=0 checked="checked"> Incorreta
                            @if ($errors->has('txt_afirmativa'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('txt_afirmativa') }}</strong>
                                </span>
                            @endif
                        </div>
                       

                        <div class="unidadeStatus">
                           <button type="submit" class="btn btn-success btn-block">Adicionar Afirmativa</button><br>            
                        </div>
                    </form> 

                </div> <!-- fecha .novoItem -->

            </div>
        </div>
    </div>
</div>
@endsection