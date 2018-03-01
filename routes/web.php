<?php


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

// Rotas dos cursos
Route::get('/curso/{curso}', 'CursosController@visualizarCurso');
Route::post('/curso/{curso}', 'CursosController@matricular');
Route::post('/avaliar/curso/{curso}/', 'CursosController@avaliar');

// Rotas das aulas
Route::get('/aula/{aula}', 'AulaController@index');
Route::get('/aulaAssistida/{aula}', 'AulaController@assistida');

// Rotas dos exercícios
Route::get('/exercicio/{exercicio}', 'ExercicioController@index');
Route::post('/exercicio/{exercicio}', 'ExercicioController@salvarExercicio');

//************* Rotas de Administração **********************//
Route::get('/adm', 'Adm\AdmController@index');

	// ******** Rotas ADM AVISOS ********************///
	Route::get('/adm/aviso', 'Adm\AdmController@novoAviso');
	Route::post('/adm/aviso', 'Adm\AdmController@salvarAviso');
	Route::get('/adm/aviso/{id}', 'Adm\AdmController@deletarAviso');
	

	// ******** Rotas ADM CURSO ********************///
	Route::get('/adm/curso/{curso}', 'Adm\AdmCursoController@indexCurso');
	Route::get('/adm/curso/{curso}/editar', 'Adm\AdmCursoController@editarCurso'); 
	Route::post('/adm/curso/{curso}/editar', 'Adm\AdmCursoController@atualizarCurso');
	Route::get('/adm/curso', 'Adm\AdmCursoController@criarCurso');
	Route::post('/adm/curso', 'Adm\AdmCursoController@salvarCurso');
	Route::get('/adm/curso/{curso}/avaliacao', 'Adm\AdmAvaliacaoCursoController@indexAvaliacao');



	// ******** Rotas ADM UNIDADE ********************//
	Route::get('/adm/unidade/{unidade}', 'Adm\AdmUnidadeController@indexUnidade');
	Route::post('/adm/{curso}/salvarUnidade', 'Adm\AdmUnidadeController@salvarUnidade');
	Route::post('/adm/unidade/{unidade}', 'Adm\AdmUnidadeController@atualizarUnidade');


	// ******** Rotas ADM AULA ********************//
	Route::get('/adm/aula/{aula}', 'Adm\AdmAulaController@indexAula');
	Route::post('/adm/{unidade}/salvarAula', 'Adm\AdmAulaController@salvarAula');
	Route::post('/adm/aula/{aula}', 'Adm\AdmAulaController@atualizarAula');
	Route::post('/adm/aula/upload/{aula}', 'Adm\AdmAulaController@uploadArquivo');


	// ******** Rotas ADM EXERCICIO ********************//
	//Route::get('/adm/{unidade}/exercicio', 'Adm\AdmExercicioController@indexExercicio');
	Route::post('/adm/{unidade}/salvarExercicio', 'Adm\AdmExercicioController@salvarExercicio');
	Route::get('/adm/exercicio/{exercicio}', 'Adm\AdmExercicioController@indexExercicio');
	Route::post('/adm/exercicio/{exercicio}', 'Adm\AdmExercicioController@atualizarExercicio');


	// ******** Rotas ADM QUESTÃO ********************//
	Route::post('/adm/{exercicio}/salvarQuestao', 'Adm\AdmQuestaoController@salvarQuestao');
	Route::get('/adm/questao/{questao}', 'Adm\AdmQuestaoController@indexQuestao');
	Route::post('/adm/questao/{questao}', 'Adm\AdmQuestaoController@atualizarQuestao');
	Route::get('/adm/questao/{questao}/delete', 'Adm\AdmQuestaoController@deletarQuestao');
	// Route::post('/adm/{unidade}/salvarExercicio', 'Adm\AdmExercicioController@salvarExercicio');
	// Route::get('/adm/exercicio/{exercicio}', 'Adm\AdmExercicioController@editarExercicio');

	// ******** Rotas ADM RESPOSTAS ********************//
	Route::post('/adm/{questao}/salvarResposta', 'Adm\AdmRespostaController@salvarResposta');
	Route::get('/adm/resposta/{resposta}', 'Adm\AdmRespostaController@indexResposta');
	Route::post('/adm/resposta/{resposta}', 'Adm\AdmRespostaController@atualizarResposta');
	Route::get('/adm/resposta/{resposta}/delete', 'Adm\AdmRespostaController@deletarResposta');

	// ******** Rotas ADM ALUNO ********************//
	Route::get('/adm/aluno/{user}', 'Adm\AdmAlunoController@aluno');




//***************Rota SISTEMA**********************************
//marcar no BD a aula como assistida
Route::post('/aulaAssistida/{aula}', 'AulaController@assistida');
//Desmatricular o aluno do curso
Route::get('/desmatricular/{curso}', 'CursosController@desmatricular');
//Abrir página com lista de alunos
Route::get('/adm/membros', 'Adm\AdmController@membros');
//Abrir página do certificado
Route::get('/certificado/{usuario}/{curso}', 'CursosController@certificado');
