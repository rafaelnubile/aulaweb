@extends('master')

@section('conteudo')

<h2 class="titulo"><a href="/adm">Voltar</a></h2>

<div class="base">
    <div class="row">
        <div class="col-md-8 meusCursos">
            <div class="Box">

                <h4>Novo curso</h4>

                <div class="cursoStatus">
                    <form method="POST" action="/adm/curso">

                      {{csrf_field()}}

                      <div class="form-group">
                        <label for="nome">Nome do curso:</label>
                        <input type="text" class="form-control" id="nome" name="nome">
                        @if ($errors->has('nome'))
                            <span class="help-block">
                                <strong>{{ $errors->first('nome') }}</strong>
                            </span>
                        @endif
                      </div>

                      <div class="form-group">
                        <label for="prof">Professor:</label>
                        <input type="text" class="form-control" id="prof" name="professor">
                        @if ($errors->has('professor'))
                            <span class="help-block">
                                <strong>{{ $errors->first('professor') }}</strong>
                            </span>
                        @endif
                      </div>

                      <div class="form-group">
                        <label for="descricao">Descrição:</label>
                        <textarea class="form-control" id="descricao" name="descricao"></textarea>
                        @if ($errors->has('descricao'))
                            <span class="help-block">
                                <strong>{{ $errors->first('descricao') }}</strong>
                            </span>
                        @endif
                      </div>

                      <div class="form-group">
                        <label for="categoria_id">Categoria:</label>
                        <select class="form-control" id="categoria_id" name="categoria_id">
                            <option value="">Escolha uma categoria:</option>
                            @foreach($categorias as $categoria)
                              <option value="{{$categoria->id}}">{{$categoria->tipo}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('categoria_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('categoria_id') }}</strong>
                            </span>
                        @endif
                      </div>

                      <div class="form-group">
                        <label for="palavrasChave">Palavras-chave:</label>
                        <input type="text" class="form-control" id="palavrasChave" name="palavrasChave">
                        @if ($errors->has('palavrasChave'))
                            <span class="help-block">
                                <strong>{{ $errors->first('palavrasChave') }}</strong>
                            </span>
                        @endif
                      </div>

                      <hr>

                      <p>Copie abaixo o número do vídeo do VIMEO. (Ex.: https://vimeo.com/80851591, copie apenas o 80851591)</p>
                      <br>

                      <div class="form-group">
                        <label for="linkVideoIntro">Vídeo de introdução:</label>
                        <input type="text" class="form-control" id="linkVideoIntro" name="linkVideoIntro">
                        @if ($errors->has('linkVideoIntro'))
                            <span class="help-block">
                                <strong>{{ $errors->first('linkVideoIntro') }}</strong>
                            </span>
                        @endif
                      </div>
                      
                      <button type="submit" class="btn btn-success btn-block">Criar curso</button>
                    </form>
                    
                </div> <!-- fecha cursoStatus -->         

            </div> <!-- fecha Box -->
        </div> <!-- fecha col-md-8 meusCursos -->     

    </div> <!-- fecha row -->    
</div> <!-- fecha base --> 


@endsection
