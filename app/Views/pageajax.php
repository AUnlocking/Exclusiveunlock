<?php
include 'common/head.php';
include 'common/navbar.php';
include("mdls/mdl_posts.php");
?>

<script type='text/javascript'>
var base_url = '<?=base_url();?>';
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

	<div class="row">
		<div class="col-md-12">
			<div class="bg-dark text-secondary px-2 py-1 mb-2 rounded">
				<div class="py-2">
					<h2 class="display-5 text-white text-center">Proyecto con Codeigniter <?=CodeIgniter\CodeIgniter::CI_VERSION ?> & Bootstrap 5.1.3</h2>
					<div class="col-lg-8 mx-auto">
						<p class="fs-5 mb-4 text-center">
							Un proyecto "casi-simple" que incluye las siguientes funciones:
						</p>
						<div class="row">
							<div class="col-4">
								<p>Paquetes usados:</p>
								<ol>
									<li>jquery 3.6.0</li>
									<li>bootstrap 5.1.3</li>
									<li>Codeigniter 4.1.7</li>
									<li>bootstrap-notify</li>
								</ol>
							</div>
							<div class="col-8">
								<p>Funciones:</p>
								<div class="row">
									<div class="col-md-6">
										<ul>
											<li>Uso de ajax</li>
											<li>Buscador simple</li>
											<li>Subida de imágenes</li>
											<li>Paginación personalizada con ajax</li>
											<li>Cargar contenido scroll</li>
										</ul>
									</div>
									<div class="col-md-6">
										<ul>
											<li>Inicio de sesión</li>
											<li>Perfil</li>
											<li>Registro de usuarios</li>
											<li>Registro de posts</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
							<button type="button" class="btn btn-outline-info btn-lg px-4 me-sm-3 fw-bold">Descargar proyecto</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!--div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-4">
					<div class="card">
						<div class="card-header desglose">
							<h5 class="mb-0" data-bs-target="#collapse-example" data-bs-toggle="collapse" aria-expanded="true" aria-controls="collapse-example" aria-current="true">
								Example open and close <i class="fa fa-chevron-down float-end"></i>
							</h5>
						</div>
						<div id="collapse-example" class="collapse show">
							Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda itaque asperiores sapiente aut debitis nulla accusantium odit voluptate minima eos quia animi numquam quo atque, saepe autem tempora, reprehenderit facere?
						</div>
					</div>
				</div>
			</div>
		</div>
	</div-->

	<div class="row mt-3">
		<div class="col-md-2">
			<!-- https://codepen.io/disjfa/pen/EZdMpe -->
			<div class="card mb-3">
				<div class="card-header desglose">
					<h6 class="mb-0 collapsed" data-bs-target="#collapse-example" data-bs-toggle="collapse" aria-expanded="true">
						Descripción <i class="fa fa-chevron-down float-end mt-1"></i>
					</h6>
				</div>
				<div id="collapse-example" class="collapse card-body">
					Un proyecto desarrollado en las tecnologías mencionados, es un ejemplo que permite probar inicio de sesión, registro de usuarios, cambio de contraseña. También permite la captura de post, actualización, eliminación,

					Un búsqueda simple, subir archivo imágenes, el uso de ajax, scroll infinito para cargar elementos.
				</div>
			</div>
			<div class="card mb-3">
				<div class="card-header desglose">
					<h6 class="collapsed" data-bs-toggle="collapse" data-bs-target="#or-desglose-1" aria-expanded="true">
						Requerimientos <i class="bi bi-chevron-down float-end"></i>
					</h6>
				</div>
				<div class="card-body collapse" id="or-desglose-1">
					<ul class="mx-n3">
						<li><a href="https://fedoraproject.org" target="_blank">Fedora 35 x86_64</a></li>
						<li><a href="https://www.apachefriends.org" target="_blank">XAMPP 8.1.1</a></li>
						<li><a href="https://www.codeigniter.com" target="_blank">Codeigniter 4.1.7</a></li>
						<li><a href="https://getbootstrap.com" target="_blank">Bootstrap 5.1.3</a></li>
					</ul>
				</div>
			</div>

			<ul class="list-desglose">
				<li>
					<p data-bs-toggle="collapse" data-bs-target="#a-list-1" aria-expanded="true" class="collapsed">
						Funciones <i class="bi bi-chevron-down float-end"></i>
					</p>
					<ul id="a-list-1" class="collapse">
						<li class="mx-0">Uso de ajax</li>
						<li>Buscador simple</li>
						<li>Subida de imágenes</li>
						<li>Paginación personalizada con ajax</li>
						<li>Cargar contenido scroll</li>
					</ul>
				</li>
				<li>
					<p data-bs-toggle="collapse" data-bs-target="#a-list-2" aria-expanded="true" class="collapsed">
						Tecnologías <i class="bi bi-chevron-down float-end"></i>
					</p>
					<ul id="a-list-2" class="collapse">
						<li>jquery 3.6.0</li>
						<li>bootstrap 5.1.3</li>
						<li>Codeigniter 4.1.7</li>
						<li>bootstrap-notify</li>
					</ul>
				</li>
			</ul>
		</div>
		<div class="col-md-10 mb-4">
			<!-- content ajax load pagination -->
			<div id="div-cnt-ajax" class="row"></div>
			<div id="pag-temas"></div>
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
		load(1);
	});
</script>