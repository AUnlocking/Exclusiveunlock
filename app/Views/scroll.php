<?php
include 'common/head.php';
include 'common/navbar.php';
include("mdls/mdl_posts.php");
?>

<script type='text/javascript'>
var base_url = '<?=base_url();?>';
var start 	= 0;
var limit 	= 9;
var action 	= 'inactive';
</script>

<div id="container" class="container-lg mt-5">
	<div class="row">
		<div class="col-12 mt-4">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?=base_url('/');?>"><i class="fa fa-home"></i></a></li>
					<li class="breadcrumb-item active" aria-current="page">Registros</li>
				</ol>
			</nav>
		</div>
	</div>

	<div class="row mt-3">
		<div class="col-md-2">
			<nav class="bd-links" id="bd-docs-nav" aria-label="Docs navigation">
				<ul class="list-unstyled mb-0 py-3 pt-md-1">
					<li class="mb-1 active">
						<button class="btn d-inline-flex align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#getting-started-collapse" aria-expanded="false" aria-current="true">
							Getting started
						</button>
						<div class="collapse" id="getting-started-collapse">
							<ul class="list-unstyled fw-normal pb-1 small mx-5">
								<li>Hola</li>
								<li>Hola</li>
								<li>Hola</li>
								<li>Hola</li>
								<li>Hola</li>
								<li>Hola</li>
							</ul>
						</div>
					</li>

					<li class="mb-1">
						<button class="btn d-inline-flex align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#customize-collapse" aria-expanded="false">
							Customize
						</button>
						<div class="collapse" id="customize-collapse">
							<ul class="list-unstyled fw-normal pb-1 small mx-5">
								<li>Hola</li>
								<li>Hola</li>
								<li>Hola</li>
								<li>Hola</li>
								<li>Hola</li>
								<li>Hola</li>
							</ul>
						</div>
					</li>
				</ul>
			</nav>
		</div>
		<div class="col-md-10 mb-4">
			<!-- content ajax load pagination -->
			<div id="div-cnt-ajax" class="row"></div>
			<div id="pag-temas"></div>

			<div class="row" id="div-cnt-content-load"></div>
			<div class="row">
				<div class="col-md-12" id="div-cnt-message-load"></div>
			</div>
		</div>
	</div>
	<!-- /content ajax load pagination -->
</div>

<?php
include 'common/foot.php';
mostrarMensaje();
?>
<script src="<?=base_url('assets/app/ajax/ajxfuctloadexmp.js');?>"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#div-cnt-message-load').html('');
		function loadScrollArts(limit, start){
			$.ajax({
				url: 		base_url+"/loadscroll",
				method: 	"POST",
				dataType: 	"JSON",
				type: 		"POST",
				data:{
					start: start,
					limit: limit,
					users: 'comunica2019',
					arts: '',
					search: '',
					slug: '',
					id_usuario:0,
					order_by: 'nom_post',
					order: 'desc',
				},
				cache:false,
				success:function(data){
					$('#div-cnt-content-load').append(data.data);
					if(data.data == ''){
			 			$('#div-cnt-message-load').html('<div class="text-center mt-2"><div class="alert alert-info" role="alert">'+
			 				'<i class="fas fa-exclamation-circle"></i> No hay más elementos para cargar.</div></div>');
						action = 'active';
					}else{
						$('#div-cnt-message-load').html('<div class="text-center mt-2 mb-2"><div class="alert alert-info" role="alert"><span class="spinner-border spin-2x align-middle" role="status" aria-hidden="true"></span>'+
							' Cargando más contenido...</div></div>');
						action = "inactive";
					}
				}
			});
		}

		if(action == 'inactive'){
			action = 'active';
			loadScrollArts(limit, start);
		}

		$(window).scroll(function(){
			if($(window).scrollTop() + $(window).height() > $("#div-cnt-content-load").height() && action == 'inactive'){
				action = 'active';
				start = start + limit;
				setTimeout(function(){
					loadScrollArts(limit, start);
				}, 1000);
			}
		});
	});
</script>