<?php
include 'common/head.php';
include 'common/navbar.php';
?>

<script type='text/javascript'>
var base_url = '<?=base_url();?>';
</script>

<div class="container mt-5">
	<div class="row">
		<div class="col-md-12 mt-4">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?=base_url();?>"><i class="fa fa-home"></i></a></li>
					<li class="breadcrumb-item"><a href="<?=base_url('ptables');?>"><i class="fa fa-list-ul"></i> Registros</a></li>
					<li class="breadcrumb-item active" aria-current="page">Editando artículo</li>
				</ol>
			</nav>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 mb-2">
			<div class="card bg-white rounded p-3">
				<div class="card-body">
					<?php
					if ($info_post) {
						$img = base_url('assets/app/images/default_post.png');
						if (file_exists('public/'.$info_post->img_post)) {
							$img = base_url('/public/'.$info_post->img_post);
						}
					?>
						<form id="form-up-reg" name="form-up-reg" enctype="multipart/form-data" accept-charset="UTF-8">
							<div class="modal-body">
								<div class="row">
									<div class="col-md-12 text-center" id="div-cnt-msg-up-reg"></div>
								</div>
								<input type="hidden" name="txt-id" readonly="" required="required" value="<?=$info_post->id_post;?>">
								<div class="row">
									<div class="col-md-2">
										<div class="post-image rounded">
											<img src="<?=$img;?>" class="" alt="" sizes="(max-width: 272px) 100vw, 272px">
										</div>
									</div>
									<div class="col-md-10">
										<div class="row">
											<div class="col-md-12 mb-2">
												<div class="form-group input-group">
													<span class="has-float-label">
														<input type="text" class="form-control" name="txt-nom" id="txt-nom-add" placeholder="Nombre" required="required" value="<?=$info_post->nom_post;?>" autocomplete="off">
														<label for="txt-nom-add">Nombre</label>
													</span>
												</div>
											</div>
											<div class="col-md-12 mb-2">
												<div class="form-group input-group">
													<span class="has-float-label">
														<input type="text" class="form-control" name="txt-desc" id="txt-desc-add" placeholder="Descripción" required="required" value="<?=$info_post->desc_post;?>" autocomplete="off">
														<label for="txt-desc-add">Descripción</label>
													</span>
												</div>
											</div>
											<div class="col-md-12">
												<div class="input-group mb-2">
													<div class="custom-file">
														<input type="file" class="custom-file-input form-control" id="file-ajx" name="file"  accept=".png, .jpg, .jpeg">
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="submit" class="btn btn-success" id="btn-up-reg" name="btn-up-reg">
									<i class="fa fa-check"></i> Actualizar
								</button>
							</div>
						</form>
					<?php
					}else{
						echo '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-circle"></i> '.
						' El artículo no se encontró, por favor revise. <a href="'.base_url().'" class="alert-link">Lista completa de artículos</a> </div>';
					}
					?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
include 'common/foot.php';
mostrarMensaje();
?>
<script src="<?=base_url('assets/app/ajax/ajxtablepage.js');?>"></script>