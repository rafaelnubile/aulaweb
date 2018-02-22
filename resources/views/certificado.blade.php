<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
	
	<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
	<title>AulaWEB</title>

	<link rel="stylesheet" href="{{asset('css/bootstrap/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('css/certificado.css')}}">
	<link rel="stylesheet" href="{{asset('css/font-awesome-4.7.0/css/font-awesome.min.css')}}">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/3.2.1/css/font-awesome.min.css" media="all" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Cinzel:700" rel="stylesheet">

	<link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">
	<script src="{{asset('js/jquery-1.11.2.min.js')}}"></script>
	<script src="{{asset('css/bootstrap/js/bootstrap.min.js')}}"></script>
</head>

<body>
	<div class="moldura">
		<h3><i class="fa fa-graduation-cap"></i><strong>Aula</strong>WEB</h3>
		<H1 class="titulo">Certificado</H1>

		<p>Certificamos que</p>
		<h4>{{strtoupper($usuario->name)}}</h4>
		<p>participou do curso {{strtoupper($curso->nome)}}, por meio da plataforma AulaWeb.</p>
		<h3><i class="fa fa-certificate"></i></h3>		
	</div>
</body>
</html>