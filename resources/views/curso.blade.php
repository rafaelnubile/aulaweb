@extends('master')

@section('conteudo')
<h2 class="titulo">{{$curso->nome}}</a></h2>

<div class="base">

	<div class="row">
		<div class="col-md-8">

			@foreach($curso->unidades as $index=>$unidade)
				
				<h2>{{$index+1}} - {{$unidade->nome}}</h2>
				

				@foreach($unidade->aulas as $index=>$aula)
					@if($aula->publicada)
						<a href="/aula/{{$aula->id}}">
							<div class="indiceAula">	
								<div class="row">
									<div class="col-xs-2 npr">
										@if($aula->assistida)
										<div class="icon visto">
											<h1><i class="fa fa-check" aria-hidden="true"></i></h1>
										</div>
										@else
											<div class="icon">
												<h1><i class="fa fa-play" aria-hidden="true"></i></h1>
											</div>
										@endif
									</div>
									<div class="col-xs-10">
										<h5>Aula {{$index+1}}</h5>
										<H4>{{$aula->nome}}</H4>
									</div>
								</div>	
							</div>
						</a>
					@endif
				@endforeach


				@foreach($unidade->exercicios as $index=>$exercicio)
					@if($exercicio->publicado)
					<a href='{{url("/exercicio/$exercicio->id")}}'>
						<div class="indiceAula">	
							<div class="row">
								<div class="col-xs-2 npr">			
										<div class="icon">
											<h1><i class="fa fa-edit" aria-hidden="true"></i></h1>
										</div>							
								</div>
								<div class="col-xs-8">
									<h5>Exercicio {{$index+1}}</h5>
									<H4>{{$exercicio->titulo}}</H4>
								</div>
							</div>	
						</div>
					</a>
					@endif
				@endforeach

			@endforeach 

			
						
			<hr>

			
		</div> <!-- Fecha col-md-8 -->

		<div class="col-md-4">
			<div class="Box">
				<div class="avisos"> 
					<h4>Avalie este curso</h4>
					<h6>1-Péssimo, 2-Ruim, 3-Regular, 4-Bom, 5-Ótimo</h6>
					<form method="POST" action='{{url("/avaliar/curso/$curso->id")}}'>			
						{{ csrf_field() }}

								<label for="avaliacao">Nota:</label>
								<select class="form-control" name="avaliacao">
									<option value="">Escolha</option>
									@for($i = 1; $i <= 5; $i++)
										@if(is_null($usuarioCurso->avaliacao))
											<option value="{{$i}}">{{$i}}</option>
										@else
											@if(old('avaliacao') == $i)
												<option value="{{$i}}" selected>{{$i}}</option>
											@elseif($usuarioCurso->avaliacao == $i)
												<option value="{{$i}}" selected>{{$i}}</option>
											@else
												<option value="{{$i}}">{{$i}}</option>
											@endif
										@endif
									@endfor
								</select>
								@if ($errors->has("avaliacao"))
				                    <span class="help-block">
				                        <strong>{{ $errors->first("avaliacao") }}</strong>
				                    </span>
					            @endif
						 
								<br>
								<label for="cometario">Comentário:</label>
								<textarea class="form-control" name="comentario">@if(!empty(old('comentario'))){{old('comentario')}}@elseif(!is_null($usuarioCurso->comentario)){{$usuarioCurso->comentario}}@endif</textarea>
								@if ($errors->has("comentario"))
				                    <span class="help-block">
				                        <strong>{{ $errors->first("comentario") }}</strong>
				                    </span>
					            @endif
								<br>
								<button type="submit" class="btn btn-block btn-warning">Avaliar</button>
					</form>					
				</div>
			</div>
			@if($usuarioCurso->aprovado)
			<div class="Box">
				<div class="avisos">
					<h4>Certificado de Conclusão</h4>
					<a href='{{url("/certificado/$usuarioCurso->user_id/$curso->id")}}'><button class="btn btn-block btn-success">Gerar Certificado</button></a>
				</div>
			</div>
			@endif

		</div>
	</div>
	<button class="btn btn-block btn-danger" id="desmatricular">Sair do curso</button>
		
	</div>	
</div>

@endsection