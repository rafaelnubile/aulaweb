@extends('master')

@section('conteudo')
<h2 class="titulo">Administração</h2>

<div class="mural">
    <div class="row">

        <div class="col-md-8 meusCursos">
            <div class="Box">
                <h4>Administrar Cursos</h4>

                <div class="cursoStatus">
                    <a href="/adm/curso"><button class="btn btn-success btn-block">Criar novo curso</button></a><br>                 
                </div>                

                @foreach ($cursos as $curso)
                    <div class="cursoStatus">
                        <h3><a href="/adm/curso/{{$curso->id}}">{{ $curso->nome }}</a></h3>
                    </div>
                @endforeach
                
            </div>

        </div>

        <div class="col-md-4 avisoBox">

            <div class="Box">
                <h4>Avisos</h4>

                <div class="avisos">
                    <a href="/adm/aviso"><button class="btn btn-warning btn-block">Novo aviso</button></a><br>
                </div>

                @if(empty($avisosEmOrdem))
                    <H3>Boas aulas!</H3>
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

                                <a href="/adm/aviso/{{$aviso->id}}">
                                  <button type="button" class="btn btn-danger">Deletar</button>
                                </a>                                
                                
                                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                              </div>
                            </div>

                          </div>
                        </div>      
                    @endforeach
                @endif
                
            </div>

            <div class="Box">                
                <div class="avisos">
                    <a href="/adm/membros"><button class="btn btn-primary btn-block">Usuários</button></a><br>
                </div>
            </div>
        </div>

    </div>
    
</div>





<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content centered">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Manutenção programada do site</h4>
      </div>
      <div class="modal-body">
        <p>O site passará por manutenção a partir de meia-noite do dia 08/08/2017, ficando fora do ar. Previsão de disponibilidade às 02:00h do dia seguinte.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Apagar</button>        
        <button type="button" class="btn btn-warning" data-dismiss="modal">Editar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
      </div>
    </div>

  </div>
</div>

@endsection
