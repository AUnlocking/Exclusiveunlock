<?php
include 'common/head.php';
include 'common/navbar.php';
include("mdls/mdl_posts.php");
?>

<script type='text/javascript'>
var base_url = '<?=base_url();?>';
</script>

<div id="container" class="container mt-5">
	<div class="row">
		<div class="col-md-12 mt-4">
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
			
		</div>
	</div>

	<div class="row">
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
		<div class="col-md-10">
			<!-- content ajax load pagination -->
			<div id="div-cnt-ajax" class="row">
				<?php
				foreach($posts as $post){
					$img = base_url('assets/app/images/default_post.png');
					if (file_exists('public/'.$post->img_post)) {
						$img = base_url('/public/'.$post->img_post);
					}
					echo '<div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 mb-2 d-flex">
								<div class="card mb-2">
									<a href="'.base_url('post/'.$post->slug_post).'">
										<div class="post-image">
											<img src="'.$img.'" sizes="(max-width: 172px) 100vw, 172px">
										</div>
									</a>
									<div class="card-body font-weight-bold ">
										<a class="text-dark" href="'.base_url('post/'.$post->slug_post).'">
											'.$post->nom_post.'
										</a>
									</div>
									<div class="row">
										<div class="col-md-12 px-4">
											<small class="float float-right text-muted">By '.$post->firstname.'</small> 
											<small class="float-end">'.mesDiaAnio($post->fc_post).'</small>
										</div>
									</div>
								</div>
							</div>';
				}
				?>
			</div>
			<div class="row mt-3">
				<div class="col-md-12 mb-4">
					<div id="pag-temas">
						<?php
						if ($pager) {
							//$pagi_path = 'devs/ci4_tutorials/pagenotajax';
							//$pager->setPath($pagi_path);
							//echo $pager->links();
							echo $pager->links('bootstrap', 'bootstrap_pagination');
						}
						?>
					</div>
				</div>
			</div>
			<!-- /content ajax load pagination -->
		</div>
	</div>
</div>

<?php
include 'common/foot.php';
mostrarMensaje();
?>