@extends('master')

@section('conteudo')
<h2 class="titulo"> <a href="/adm/exercicio/{{$resposta->questao->exercicio->id}}">{{$resposta->questao->exercicio->titulo}}</a> / <a href="/adm/questao/{{$resposta->questao->id}}">Questão {{$resposta->questao->id}}</a> / Resposta {{$resposta->id}}</h2>

<div class="base">
    <div class="row">
        <div class="col-md-8 meusCursos">
            <div class="Box">
                <h4>Afirmativa</h4>
                <div class="cursoStatus">
                    <form method="POST" action="/adm/resposta/{{$resposta->id}}">

                        {{csrf_field()}}

                        <div class="form-group">
                            <textarea class="form-control" id="txt_afirmativa" name="txt_afirmativa">{{old('txt_afirmativa') ? old('txt_afirmativa') : $resposta->txt_afirmativa }}</textarea>
                            @if ($errors->has('txt_afirmativa'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('txt_afirmativa') }}</strong>
                                </span>
                            @endif
                            @if(!$resposta->correta)
                                <input type="radio" name="correta" value=1> Correta
                                <input type="radio" name="correta" value=0 checked="checked"> Incorreta
                            @else
                                <input type="radio" name="correta" value=1 checked="checked"> Correta
                                <input type="radio" name="correta" value=0 > Incorreta
                            @endif
                        </div>



                        <button type="submit" class="btn btn-warning btn-block">Salvar Alterações</button>
                    </form>

                    <br>
                    
                    <a href='{{url("/adm/resposta/$resposta->id/delete")}}'>                    
                        <button class="btn btn-danger btn-block">Apagar Afirmativa</button>
                    </a>
                     
                </div>
            </div>
        </div>
    </div>
</div>
@endsection