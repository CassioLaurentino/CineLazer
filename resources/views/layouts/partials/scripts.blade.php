<!-- REQUIRED JS SCRIPTS -->

<!-- JQuery and bootstrap are required by Laravel 5.3 in resources/assets/js/bootstrap.js-->
<!-- Laravel App -->
<meta name="csrf-token" content="{{ csrf_token() }}">

@push('styles')
	<link href="{{ asset('/sweetalert2/dist/sweetalert2.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
	<script src="{{ asset('/js/app.js') }}" type="text/javascript"></script>
	<script src="{{ asset('/sweetalert2/dist/sweetalert2.min.js') }}"></script> 
@endpush

@stack('styles')
@stack('scripts')

<!-- Optionally, you can add Slimscroll and FastClick plugins.
      Both of these plugins are recommended to enhance the
      user experience. Slimscroll is required when using the
      fixed layout. -->
<script>
    window.Laravel = {!! json_encode([
        'csrfToken' => csrf_token(),
	]) !!};
</script>
<script>
	function ConfirmaExclusao(id) {
		swal({
			title: 'Confirma a exclusão?',
			text: "Esta ação não poderá ser revertida!",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Sim, excluir!',
			closeOnConfirm: false,
			cancelButtonText: 'Cancelar!',
		}).then(function(isConfirm) {
			if (isConfirm) {
				//ajax
	            $.get('/'+ @yield('table-delete') +'/'+id+'/destroy', function(data){
	                //success data
	                console.log(data);
	                if (data.status == "ok") {
						swal(
							'Deletado!',
							'Exclusão confirmada.',
							'success'
						).then(function(isConfirm) {
								window.location.reload();
						});
	                } else if (data.status == "erro_data") {
						swal('Erro!', data.msg, 'error');
	                } else
						swal(
							'Erro!',
							'Ocorreram erros na exclusão. Entre em contato com o suporte.',
							'error'
						);
	            });
			}
		})
	}

	function HandleException(msg) {
		swal(
			'Erro!',
			msg,
			'error'
		);
	}
</script>