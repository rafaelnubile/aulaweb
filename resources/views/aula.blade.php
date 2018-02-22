@extends('master')

@section('header')
		<script src="{{asset('js/vimeo-video.js')}}"></script>
@endsection

@section('conteudo')
<h2 class="titulo">{{$aula->nome}}</h2>
<div class="base">
	<div class="row">
		<div class="col-sm-1">						
		</div>

		<div class="col-sm-10 col-xs-12">
			<div class="video-container">
				<iframe src="https://player.vimeo.com/video/{{$aula->vimeoID}}" width="640" height="400" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>		
			</div>

			<div class="btn-group btn-group-justified">
				@if($aula->id > 1)
					<a href="/aula/{{$aulaAnterior}}" class="btn btn-default">Aula anterior</a>
				@endif

			    <a href="/curso/{{$curso->id}}" class="btn btn-default">Menu</a>

				@if($aula->id < $numeroAulasUnidade)
				 <a href="/aula/{{$proximaAula}}" class="btn btn-default">Próxima aula</a>
				@endif			  
			</div>

		</div>

		<div class="col-sm-1">			
		</div>
	</div>
	
	<hr>

	<div class="aulaMaterial">
		<div class="row">
			<div class="col-sm-4">
				<h4>Material de apoio</h4>
				@if(count($aula->arquivos) > 0)
				<ul>
                    @foreach($aula->arquivos as $arquivo)
                        <li>
                        <a href='{{url("/$arquivo->caminho$arquivo->nome")}}' download>{{$arquivo->nome}}</a>
                        </li>
                    @endforeach
				<ul>
                @else
                    <h4>Não existem arquivos para esta aula</h4>
                @endif
			</div>
			<div class="col-sm-7">
				<p>
					{!! nl2br(e($aula->texto)) !!}					
				</p>				
			</div>
		</div>
	</div>
</div>


@endsection