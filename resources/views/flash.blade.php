
@if(session()->has('flash_message'))
	<script>
		swal({
		  title: "{{ session('flash_message.titulo')}}",
		  text: "{{ session('flash_message.mensagem') }}",
		  type: "{{ session('flash_message.tipo') }}",
		  timer: 2000,
  		  showConfirmButton: false
		});
	</script>
@endif

@if(session()->has('flash_message_overlay'))
	<script>
		swal({
		  title: "{{ session('flash_message_overlay.titulo')}}",
		  text: "{{ session('flash_message_overlay.mensagem') }}",
		  type: "{{ session('flash_message_overlay.tipo') }}",
		  confirmButtonText: "Ok"
		});
	</script>
@endif

@if(session()->has('desmatricular'))
	<script>
		swal({
		  title: "{{ session('desmatricular.titulo')}}",
		  text: "{{ session('desmatricular.mensagem') }}",
		  type: "{{ session('desmatricular.tipo') }}",
		  showCancelButton: true,
		  confirmButtonColor: "#DD6B55",
		  confirmButtonText: "Ok",
		  closeOnConfirm: false
		},
		function(){
		  // Deletar do curso...
		  swal("Desmatriculado!", "Você está desmatriculado", "success");
		});
	</script>
@endif