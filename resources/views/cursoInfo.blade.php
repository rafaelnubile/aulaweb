@extends('master')

@section('header')
	<script src="{{asset('js/vimeo-video.js')}}"></script>
@endsection

@section('conteudo')
<h2 class="titulo"> {{ $curso->nome }} </h2>
<div class="base">
	<div class="row">
		<div class="col-sm-7">

			<div class="video-container">
				<iframe src="https://player.vimeo.com/video/{{$curso->vimeoID}}" width="640" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
				<!-- <iframe width="560" height="315" src=" {{ URL::to( $curso->linkVideoIntro ) }} " frameborder="0" allowfullscreen></iframe> -->
			</div> 

		</div>

		<div class="col-sm-5">
			<p>
				{{ $curso->descricao }}
			</p>
			
			<hr>
			<h5><strong>Professor(a):</strong> {{ $curso->professor }}</h5>
			<h5><strong>Palavras-chave:</strong> {{ $curso->palavrasChave }}</h5>
			<h5><strong>Categoria:</strong> {{ $nomeCategoria }}</h5>

			<form action="/curso/{{$curso->id}}" method="post">
				{{csrf_field()}}
				<button class="btn btn-block btn-success" type="submit">Me inscrever</button>			
			</form>
			
		</div>
	</div>
</div>


@endsection