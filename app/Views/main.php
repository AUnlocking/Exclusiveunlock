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
					<li class="breadcrumb-item active" aria-current="page">Registros</li>
				</ol>
			</nav>
		</div>
	</div>

	<!-- https://ilmucoding.com/codeigniter-4-authentication/ -->
	<div class="row g-2">
		<div class="col-lg-1 col-md-2 col-sm-3 col-2">
			<div class="dropdown-limit input-group d-grid gap-2">
				<button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
					<span class="d-none d-md-inline-block fa fa-list-ol"></span> <span id="spn-show-list">10</span>
				</button>
				<div id="select-list" class="dropdown-menu">
					<a class="dropdown-item" href="#" data-total="10">10</a>
					<a class="dropdown-item" href="#" data-total="20">20</a>
					<a class="dropdown-item" href="#" data-total="30">30</a>
					<a class="dropdown-item" href="#" data-total="40">40</a>
					<a class="dropdown-item" href="#" data-total="50">50</a>
				</div>
			</div>
		</div>

		<div class="col-lg-9 col-md-8 col-sm-7 col-8">
			<form method="post" enctype="multipart/form-data" accept-charset="utf-8" id="form-search" name="form-search">
				<div class="dropdown-edo input-group mb-3">
					<button id="btn-search-on" type="button" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
						<i id="i-icon-act" class="fas fa-check"></i> <span id="spn-desc-act" class="d-none d-md-inline-block">Activos</span> <span class="visually-hidden">Toggle Dropdown</span>
					</button>
					<ul class="dropdown-menu">
						<li>
							<a class="dropdown-item" href="#" data-desc="Todos" data-icon="fas fa-list-ol" data-edo="2">
								<i class="fas fa-list-ol"></i> Todos
							</a>
						</li>
						<li>
							<a class="dropdown-item" href="#" data-desc="Activos" data-icon="fas fa-check" data-edo="1">
								<i class="fas fa-check"></i> Activos
							</a>
						</li>
						<li><hr class="dropdown-divider"></li>
						<li>
							<a class="dropdown-item" href="#" data-desc="Inactivos" data-icon="fas fa-times" data-edo="0">
								<i class="fas fa-times"></i> Inactivos
							</a>
						</li>
					</ul>
					<input type="text" class="form-control txt-search-nv" name="txt-search" id="txt-search" placeholder="Buscar..." autocomplete="off">
					<div class="input-group-append">
						<button type="submit" class="btn btn-search-nav" name="btn-search" id="btn-search">
							<i class="fal fa-search"></i>
						</button>
					</div>
				</div>
			</form>
		</div>
		<div class="col-lg-2 col-md-2 col-sm-2 col-2 d-grid my-auto mt-2">
			<button type="button" class="btn btn-success mdl-add-reg" title="Agregar Sección" data-bs-toggle="modal" data-bs-target="#mdl-add-reg">
				<i class="fa fa-plus-circle"></i> <span class="d-none d-md-inline-block">Agregar</span>
			</button>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<p id="h5-cnt-total" class="float-end"></p>
		</div>
	</div>
	<div class="row">
		<div id="div-cnt-load" class="col-md-12"></div>
	</div>
</div>

<?php
include 'common/foot.php';
mostrarMensaje();
?>

<script src="<?=base_url('assets/app/ajax/ajxtablepage.js');?>"></script>
<script type="text/javascript">
	$(document).ready(function() {
		load(1);
	});
</script>
<script>
	let editor;
	ClassicEditor
		.create( document.querySelector( '.txt-desc' ), {
			ckfinder: {
				uploadUrl: base_url+'/upload',
			},
			height: '300px',
			toolbar: {
				items: [
					'heading',
					'|',
					'bold',
					'italic',
					'link',
					'bulletedList',
					'numberedList',
					'|',
					'outdent',
					'indent',
					'|',
					'imageUpload',
					'blockQuote',
					'insertTable',
					'undo',
					'redo',
					'alignment',
					'fontSize'
				]
			},
			language: 'es',
			image: {
				styles: [
					'alignLeft', 'alignCenter', 'alignRight'
				],

				// Configure the available image resize options.
				resizeOptions: [
					{
						name: 'resizeImage:original',
						label: 'Original',
						value: null
					},
					{
						name: 'resizeImage:50',
						label: '50%',
						value: '50'
					},
					{
						name: 'resizeImage:75',
						label: '75%',
						value: '75'
					}
				],

				// You need to configure the image toolbar, too, so it shows the new style
				// buttons as well as the resize buttons.
				toolbar: [
					'imageStyle:alignLeft', 'imageStyle:alignCenter', 'imageStyle:alignRight',
					'|',
					'resizeImage',
					'|',
					'imageTextAlternative'
				],
			},
			table: {
				contentToolbar: [
					'tableColumn',
					'tableRow',
					'mergeTableCells'
				]
			},
		})
		.then( newEditor => {
			window.editor = newEditor;
			editor = newEditor;
		})
		.catch( error => {
			console.error( 'Oops, something went wrong!' );
			console.error( 'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:' );
			console.warn( 'Build id: q6l505nuvif2-xw3ce1wx5aqw' );
			console.error( error );
		});
</script>