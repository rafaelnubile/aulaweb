$('document').ready(function(){

	//Desmatricular
	$( "#desmatricular" ).click(function() {
	  swal({
		  title: "Desmatricular",
		  text: "Você deseja sair do curso?",
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonColor: "#DD6B55",
		  confirmButtonText: "Ok",
		  closeOnConfirm: true
		},
		function(){
			//Buscar Id do curso na URL
			var urlCursoID= window.location.pathname;
        	var idUltimaBarra = urlCursoID.lastIndexOf('/');
        	var cursoID = urlCursoID.substring(idUltimaBarra + 1);

		    // Buscar URL do sistema e redirecionar para a url de desmatricular.
		    var url = window.location.protocol + "//" + window.location.host + '/';
		    location.href = url + "desmatricular/" + cursoID;
		});
	});
});