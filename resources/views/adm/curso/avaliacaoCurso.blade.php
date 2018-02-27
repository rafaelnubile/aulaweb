@extends('master')

@section('conteudo')
<h2 class="titulo"><a href='{{url("/adm/curso/$curso->id")}}'>{{$curso->nome}}</a> - Média: {{$curso->mediaDasAvaliacoes}}</h2>

<div class="mural">
    <div class="row">
        <div class="col-md-8">

            <div class="Box meusCursos">
                <h4>Avaliações do curso</h4>
                <div class="cursoStatus">               
                
              
                    <table class="table table-striped">
                        <tr>
                            <th>Nota</th>
                            <th>Comentário</th>
                        </tr>
                        @foreach($curso->usuarioCurso as $usuariocurso)
                        <tr>
                            <td>{{$usuariocurso->avaliacao}}</td>
                            <td>{{$usuariocurso->comentario}}</td>                       
                        </tr>
                        @endforeach
                    </table>               

                    
                </div>
            </div>

            
        </div> <!-- Fecha col-md-8 -->


    </div>
    
</div>
@endsection
