@extends('master')

@section('conteudo')

<h2 class="titulo"><a href="/adm">Voltar</a></h2>

<div class="base">
    <div class="row">

        <div class="col-md-8 meusCursos">
            <div class="Box">

                <h4>Novo aviso</h4>

                <div class="cursoStatus">

                    <form method="POST" action="/adm/aviso">

                      {{csrf_field()}}

                      <div class="form-group">
                        <label for="titulo">Título:</label>
                        <input type="text" class="form-control" id="titulo" name="titulo">
                      </div>
                     

                      <div class="form-group">
                        <label for="aviso">Aviso:</label>
                        <textarea class="form-control" id="aviso" name="aviso"></textarea>
                      </div>
                      

                      <div class="form-group">
                        <label for="validade">Validade do aviso:</label>
                        <input type="date" class="form-control" id="validade" name="validade">
                      </div>

                      
                      
                      <button type="submit" class="btn btn-success btn-block">Criar aviso</button>
                    </form>
                    
                </div> <!-- fecha cursoStatus -->         

            </div> <!-- fecha Box -->
        </div> <!-- fecha col-md-8 meusCursos -->     

    </div> <!-- fecha row -->    
</div> <!-- fecha base --> 


@endsection
