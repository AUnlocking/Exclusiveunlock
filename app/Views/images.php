<?php
include 'common/head.php';
include 'common/navbar.php';
include("mdls/mdl_posts.php");
?>

<script type='text/javascript'>
var base_url = '<?=base_url();?>';
</script>

<div class="container mt-5">
	<div class="row">
		<div class="col-md-12 mt-4">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?=base_url('/');?>"><i class="fa fa-home"></i></a></li>
					<li class="breadcrumb-item active" aria-current="page">Imágenes</li>
				</ol>
			</nav>
		</div>
	</div>


	<div class="row">
		<div class="col-md-12">
			<div class="card p-3">
				<div class="row">
					<div class="col-md-12">
						<h4>Subir una sóla imagen Codeigniter 4 con preview</h4>
						<p>
							Sube una imagen utilizando action, sin ajax
						</p>
					</div>
					<!-- https://www.tutsmake.com/codeigniter-4-image-upload-with-preview-example/ -->
					<div class="col-md-12">
						<?php if (session('msg')) : ?>
							<div class="alert alert-info alert-dismissible">
								<?= session('msg') ?>
								<button type="button" class="close" data-dismiss="alert"><span>×</span></button>
							</div>
						<?php endif ?>
					</div>
					<div class="col-md-12">
						<form action="<?=base_url('uploads/store');?>" name="ajax_form" id="ajax_form" method="post" accept-charset="utf-8" enctype="multipart/form-data">
							<div class="row">
								<div class="col-md-6">
									<div class="input-group mb-2">
										<input type="file" class="custom-file-input form-control" id="file" name="file"  required="required" onchange="readURL(this, 'div-cnt-imgaes');" accept=".png, .jpg, .jpeg">
									</div>
								</div>
								<div class="col-md-2">
									<button type="submit" id="btn-up-img" class="btn btn-success btn-block">
										<i class="fa fa-upload"></i> Subir
									</button>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="card p-0">
										<div id="div-cnt-imgaes" class="row">
											
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="card p-3 mt-2">
				<div class="row">
					<div class="col-md-12">
						<h4>Subir múltiples imágenes con Codeigniter 4 con preview</h4>
						<p>
							Sube múltimes imagenes utilizando action, sin ajax
						</p>
					</div>
					<!-- https://www.tutsmake.com/codeigniter-4-multiple-images-files-upload-example/ -->
					<div class="col-md-12">
						<?php if (session('msg')) : ?>
							<div class="alert alert-info alert-dismissible">
								<?= session('msg') ?>
								<button type="button" class="close" data-dismiss="alert"><span>×</span></button>
							</div>
						<?php endif ?>
					</div>
					<div class="col-md-12">
						<form action="<?=base_url('uploads/multipleImages');?>" name="form-up-mul-imgs" id="form-up-mul-imgs" method="post" accept-charset="utf-8" enctype="multipart/form-data">
							<div class="row">
								<div class="col-md-6">
									<div class="input-group mb-2">
										<input type="file" class="custom-file-input form-control" id="files-mul" name="file[]"  required="required" onchange="readURL(this, 'div-cnt-imgs-mul');" accept=".png, .jpg, .jpeg" multiple="">
									</div>
								</div>
								<div class="col-md-2">
									<button type="submit" id="btn-up-mul-imgs" class="btn btn-success btn-block">
										<i class="fa fa-upload"></i> Subir
									</button>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="card p-0">
										<div id="div-cnt-imgs-mul" class="row"></div>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="card p-3 mt-2">
				<div class="row">
					<div class="col-md-12">
						<h4>
							Subir una sóla imagen con preview Codeigniter 4 y Ajax
						</h4>
						<p>
							Éste ejemplo no cuenta con barra de progreso, sólo mensajes de ajax si el proceso de subida fue correcto o no.
						</p>
					</div>
					<!-- https://www.tutsmake.com/codeigniter-4-ajax-image-upload-with-preview-example/ -->
					<div class="col-md-12">
						<?php if (session('msg')) : ?>
							<div class="alert alert-info alert-dismissible">
								<?= session('msg') ?>
								<button type="button" class="close" data-dismiss="alert"><span>×</span></button>
							</div>
						<?php endif ?>
					</div>
					<div class="col-md-12">
						<form action="<?=base_url('uploads/multipleImages');?>" name="form-up-img-ajx" id="form-up-img-ajx" method="post" accept-charset="utf-8" enctype="multipart/form-data">
							<div class="row">
								<div class="col-md-6">
									<div class="input-group mb-2">
										<input type="file" class="custom-file-input form-control" id="file-ajx" name="file"  required="required" onchange="readURL(this, 'div-cnt-img-ajx');" accept=".png, .jpg, .jpeg">
									</div>
									<div id="divMsg" class="alert alert-success" style="display: none">
										<span id="msg"></span>
									</div>
								</div>
								<div class="col-md-2">
									<button type="submit" id="btn-up-img-ajx" class="btn btn-success btn-block">
										<i class="fa fa-upload"></i> Subir
									</button>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="card p-0">
										<div id="div-cnt-img-ajx" class="row"></div>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="card p-3 mt-2 mb-2">
				<div class="row">
					<div class="col-md-12">
						<h4>
							Subir múltiples imágenes con preview Codeigniter 4 y Ajax
						</h4>
						<p>
							Éste ejemplo sube las imágenes una por una y recibe un mensaje ajax del resultado de la subida de imágenes. Indicando por cada imagen si se subió correctamente, o si falló alguna validación.
						</p>
					</div>
					<div class="col-md-12">
						<form name="form-up-imgs-ajx" id="form-up-imgs-ajx" method="post" accept-charset="utf-8" enctype="multipart/form-data">
							<div class="row">
								<div class="col-md-6">
									<input type="file" class="form-control" id="files-ajx" name="file[]" required="required" accept=".png, .jpg, .jpeg" multiple="" onchange="readURL(this, 'div-cnt-imgs-ajx');">
								</div>
								<div class="col-md-2">
									<button type="submit" id="btn-up-imgs-ajx" class="btn btn-success btn-block">
										<i class="fa fa-upload"></i> Subir
									</button>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 mt-2 mb-2">
									<div class="progress">
										<div id="prg-bar-up-img" class="progress-bar bg-defult myprogress" role="progressbar" style="width:100%;">0%</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="card p-0">
										<div id="div-cnt-imgs-ajx" class="row"></div>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="card p-3 mt-2 mb-2">
				<div class="row">
					<div class="col-md-12">
						<h4>
							Subir múltiples imágenes con preview Codeigniter 4 y Ajax
						</h4>
						<p>
							Éste ejemplo sube todas las imágenes y recibe un sólo mensaje por ajax del proceso de subida, si alguna imágen no era correcta el tipo, o tamaño, simplemente no la sube, pero no indica si las demás se subieron o no.
						</p>
					</div>
					<div class="col-md-12">
						<form name="form-up-imgs-all" id="form-up-imgs-all" method="post" accept-charset="utf-8" enctype="multipart/form-data">
							<div class="row">
								<div class="col-md-6">
									<input type="file" class="form-control" id="files-all" name="file[]" required="required" accept=".png, .jpg, .jpeg" multiple="" onchange="readURL(this, 'div-cnt-imgs-all');">
								</div>
								<div class="col-md-2">
									<button type="submit" id="btn-up-imgs-all" class="btn btn-success btn-block">
										<i class="fa fa-upload"></i> Subir
									</button>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 mt-2 mb-2">
									<div class="progress">
										<div id="prg-bar-up-all" class="progress-bar bg-defult myprogress" role="progressbar" style="width:100%;">0%</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="card p-0">
										<div id="div-cnt-imgs-all" class="row"></div>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="card p-3 mt-2 mb-2">
				<div class="row">
					<div class="col-md-12">
						<h4>
							Subir múltiples imágenes con preview Codeigniter 4, Ajax, subirlo inmediatemente después de seleccionar
						</h4>
						<p>
							Éste ejemplo sube todas las imágenes y recibe un sólo mensaje por ajax del proceso de subida, si alguna imágen no era correcta el tipo, o tamaño, simplemente no la sube, pero no indica si las demás se subieron o no. Y se suben de manera inmediata después de seleccionar los archivos.
						</p>
					</div>
					<div class="col-md-12">
						<form name="form-up-imgs-change" id="form-up-imgs-change" method="post" accept-charset="utf-8" enctype="multipart/form-data">
							<div class="row">
								<div class="col-md-6">
									<input type="file" class="form-control upload-files-onchange" id="files-change" name="file[]" required="required" accept=".png, .jpg, .jpeg" multiple="" onchange="readURL(this, 'div-cnt-imgs-change');">
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 mt-2 mb-2">
									<div class="progress">
										<div id="prg-bar-up-change" class="progress-bar bg-defult" role="progressbar" style="width:100%;">0%</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="card p-0">
										<div id="div-cnt-imgs-change" class="row"></div>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<?php
include 'common/foot.php';
mostrarMensaje();
?>
<script src="<?=base_url('assets/app/ajax/ajxuploadimages.js');?>"></script>