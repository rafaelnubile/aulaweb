@extends('master')

@section('conteudo')
<h2 class="titulo"><a href="/adm/curso/{{$aula->unidade->curso_id}}">{{$aula->unidade->curso->nome}}</a> /<a href="/adm/unidade/{{$aula->unidade_id}}"> {{$aula->unidade->nome}}</a> /  {{$aula->nome}}</h2>

<div class="mural">
    <div class="row">
        <div class="col-md-8">
            <div class="Box meusCursos">
                <h4>Alterar Aula</h4>

                <div class="cursoStatus">
                    <form method="POST" action="/adm/aula/{{$aula->id}}">

                        {{csrf_field()}}

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="nomeAula">Nome:</label>  
                                    <input type="text" class="form-control" id="nomeAula" name="nomeAula" value="{{old('nomeAula') ? old('nomeAula') : $aula->nome}}">
                                    @if ($errors->has('nomeAula'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('nomeAula') }}</strong>
                                        </span>
                                    @endif
                                  </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="publicada">Publicada:</label>
                                    <select class="form-control" id="publicada" name="publicada">
                                        @if (old('publicada') == "0")
                                          <option selected="selected" value="0">Não</option>
                                        @elseif (!old('publicada') && $aula->publicada == "0")
                                          <option selected="selected" value="0">Não</option>
                                        @else
                                          <option value="0">Não</option>
                                        @endif

                                        @if (old('publicada') == "1")
                                          <option selected="selected" value="1">Sim</option>
                                        @elseif (!old('publicada') && $aula->publicada == "1")
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
                            </div> <!-- fecha col-sm-6 -->                            
                        </div> <!-- fecha row --> 

                        <div class="form-group">
                            <label for="texto">Descrição:</label>
                            <textarea class="form-control" id="texto" name="texto">{{old('texto') ? old('texto') : $aula->texto}}</textarea>
                            @if ($errors->has('texto'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('texto') }}</strong>
                                </span>
                            @endif
                      </div>


                        <div class="form-group">
                            <label for="vimeoID">Vídeo da aula:</label>
                            <input type="text" class="form-control" id="vimeoID" name="vimeoID" value="{{old('vimeoID') ? old('vimeoID') : $aula->vimeoID}}">
                            @if ($errors->has('vimeoID'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('vimeoID') }}</strong>
                                </span>
                            @endif
                      </div>

                        <button type="submit" class="btn btn-warning btn-block">Salvar Alterações</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="Box meusCursos">
                <h4>Carregar arquivo de aula</h4>

                <div class="cursoStatus">
                    <form class="form-group" action='{{url("/adm/aula/upload/$aula->id")}}' method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        Selecione o arquivo:
                        <input type="file" name="arquivo" id="arquivo" ><br>
                        @if ($errors->has('arquivo'))
                            <span class="help-block">
                                <strong>{{ $errors->first('arquivo') }}</strong>
                            </span>
                        @endif
                        <label for="nomeDoArquivo">Nome do arquivo</label>
                        <input class="form-control" type="text" name="nomeDoArquivo" value="{{old('nomeDoArquivo')}}"><br>
                        @if ($errors->has('nomeDoArquivo'))
                            <span class="help-block">
                                <strong>{{ $errors->first('nomeDoArquivo') }}</strong>
                            </span>
                        @endif
                        <input type="submit" value="Carregar" name="submit" class="btn btn-success">
                    </form>
                    <hr>
                    @if(count($aula->arquivos) > 0)
                        @foreach($aula->arquivos as $arquivo)
                            <p>
                            <a href='{{url("/$arquivo->caminho$arquivo->nome")}}' target="_blank">{{$arquivo->nome}}</a>
                            </p>
                        @endforeach
                    @else
                        <h4>Não existem arquivos para esta aula</h4>
                    @endif
                </div>
            </div>
        </div>


    </div>    
</div>
@endsection
