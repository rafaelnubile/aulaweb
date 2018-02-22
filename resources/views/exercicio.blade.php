@extends('master')

@section('conteudo')
<h2 class="titulo">{{$exercicio->titulo}}</a></h2>
<div class="base">
	<div class="exercicio">
		<form method="POST" action='{{url("/exercicio/$exercicio->id")}}'>			
			{{ csrf_field() }}
			@foreach($exercicio->questaos as $questao)

			<div class="questao">
				<h4>{{$questao->texto}}</h4>
				
				@if(is_null($questao->respostaAluno))
					@foreach($questao->respostas as $resposta)
						<div class="radio">
					      <label><input type="radio" name="questao{{$questao->id}}" value="{{$resposta->id}}">{{$resposta->txt_afirmativa}}</label>
					    </div>
					@endforeach
				@else
					@foreach($questao->respostas as $resposta)
						@if($resposta->id == $questao->respostaAluno)
							@if($resposta->correta)
								<div class="radio" style="color:green">
							      <label><input type="radio" name="questao{{$questao->id}}" value="{{$resposta->id}}" checked >{{$resposta->txt_afirmativa}} (CORRETA)</label>
							    </div>
							@else
								<div class="radio" style="color:red">
							      <label><input type="radio" name="questao{{$questao->id}}" value="{{$resposta->id}}" checked >{{$resposta->txt_afirmativa}} (ERRADA)</label>
							    </div>
							@endif
						@else
							<div class="radio">
						      <label><input type="radio" name="questao{{$questao->id}}" value="{{$resposta->id}}">{{$resposta->txt_afirmativa}}</label>
						    </div>
						@endif
					@endforeach
				@endif
				
				@if ($errors->has("questao$questao->id"))
                    <span class="help-block">
                        <strong>{{ $errors->first("questao$questao->id") }}</strong>
                    </span>
	            @endif

			</div>
			@endforeach			

			<button type="submit" class="btn btn-block btn-success">Enviar respostas</button><br>
			
		</form>
		<a href='{{url("/curso/$cursoID")}}'>
			<button class="btn btn-block btn-primary">Voltar</button>
		</a>
	</div>
</div>
@endsection

