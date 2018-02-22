@extends('master')

@section('conteudo')
<h2 class="titulo">Titulo</a></h2>
<div class="base">
	<div class="exercicio">
		<form method="POST" action="">			

			

			<div class="questao">
				<h4>Texto do exercício</h4>
				
				<div class="radio">
					
						<p><label><input type="radio" name="resposta" value="resposta">Afirmativa.</label></p>
					
				</div>
			</div>

				

			<button type="submit" class="btn btn-block btn-success">Enviar respostas</button>

		</form>
	</div>
</div>
@endsection