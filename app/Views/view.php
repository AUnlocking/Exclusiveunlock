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
					<li class="breadcrumb-item active" aria-current="page">Leyendo artículo</li>
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
						<div class="row">
							<div class="col-md-2">
								<div class="post-image rounded">
									<img src="<?=$img;?>" class="" alt="" sizes="(max-width: 272px) 100vw, 272px">
								</div>
							</div>
							<div class="col-md-10">
								<h1><?=$info_post->nom_post;?></h1>
								<small><?=ucfirst(timeago($info_post->fc_post));?></small>
								<p><?=$info_post->desc_post;?></p>
								<hr>
								<p>
									Visualizando artículo como prueva de uso de vista y acceso a controller en codeigniter 4.
								</p>
							</div>
						</div>
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