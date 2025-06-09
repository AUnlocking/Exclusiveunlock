<?php
$uri 	= service('uri');
$avatar = base_url('assets/images/icons/fav.png');
?>

<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark" aria-label="Eighth navbar example">
	<div class="container">
		<a class="navbar-brand" href="<?=base_url();?>">
			<img class="img-fluid" src="<?=base_url('assets/app/images/logo_navbar.svg');?>" id="logo_custom"  alt="logo">
		</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" onclick="sitepoint.SidebarNav_toggle(event);" onkeyup="sitepoint.SidebarNav_toggle(event);">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarsExample07">
			<ul class="navbar-nav flex-row flex-wrap ms-md-auto">
				<li class="nav-item col-6 col-md-auto">
					<a class="nav-link" href="https://linuxitos.com/blog/about">About</a>
				</li>
				<li class="nav-item col-6 col-md-auto">
					<a class="nav-link" href="https://linuxitos.com/blog/servicios">Services</a>
				</li>
				<li class="nav-item col-6 col-md-auto">
					<a class="nav-link" href="https://linuxitos.com/blog/contacto">Contact</a>
				</li>
				<li class="nav-item col-6 col-md-auto dropdown desplegable">
					<a class="nav-link dropdown-toggle" href="#" id="dropdown07" data-bs-toggle="dropdown" aria-expanded="false">Tutoriales</a>
					<div class="dropdown-menu dropdown-menu-end desplegable-menu" aria-labelledby="dropdown07">
						<a class="dropdown-item <?=($tab=='pageajax'?'active': '');?>" href="<?=base_url('pageajax');?>">
							Paginación con ajax
						</a>
						<a class="dropdown-item <?=($tab=='pagenotajax'?'active': '');?>" href="<?=base_url('pagenotajax');?>">
							Paginación sin ajax
						</a>
						<a class="dropdown-item <?=($tab=='scroll'?'active': '');?>" href="<?=base_url('scroll');?>">
							Scroll
						</a>
						<a class="dropdown-item <?=($tab=='docs'?'active': '');?>" href="<?=base_url('docs');?>">
							Docs
						</a>
					</div>
				</li>

				<?php if (session()->get('isLoggedIn')):?>
					<li class="nav-item col-6 col-md-auto dropdown desplegable">
						<a class="nav-link dropdown-toggle" href="#" id="menu-options" data-bs-toggle="dropdown" role="button" aria-expanded="false">
							<i class="fa fa-user"></i> User
						</a>
						<div class="dropdown-menu dropdown-menu-end desplegable-menu div-menu" aria-labelledby="menu-options">
							<a class="dropdown-item <?=($tab=='ptable'?'active': '');?>" href="<?=base_url('ptables');?>">
								Tablas con Ajax <i class="fal fa-table mt-2 float-end"></i>
							</a>
							<a class="dropdown-item <?=($tab=='ptablenotajax'?'active': '');?>" href="<?=base_url('ptablesnjx');?>">
								Tablas sin Ajax <i class="fal fa-table mt-2 float-end"></i>
							</a>
							<a class="dropdown-item <?=($tab=='images'?'active': '');?>" href="<?=base_url('upimages');?>">
								Subir imágenes <i class="fal fa-images mt-2 float-end"></i>
							</a>
							<a class="dropdown-item <?=($tab=='dragdrop'?'active': '');?>" href="<?=base_url('dragdrop');?>">
								Drag & Drop <i class="fal fa-copy mt-2 float-end"></i>
							</a>
							<a class="dropdown-item <?=($uri->getSegment(1) == 'profile' ? 'active' : '')?>" href="<?=base_url('profile');?>">
								Perfil <i class="far fa-address-card float-end mt-1"></i>
							</a>
							<a class="dropdown-item <?=($uri->getSegment(1) == 'logout' ? 'active' : '')?>" href="<?=base_url('logout');?>">
								Salir <i class="fas fa-sign-out-alt mt-1 float-end"></i>
							</a>
						</div>
					</li>
				<?php endif; ?>
			</ul>
			<?php
				if (!session()->get('isLoggedIn')){
					echo '<a class="my-2 my-md-0 ms-md-3 me-2 btn btn-outline-warning '.($uri->getSegment(1) =='register'?'d-none' : 'd-lg-block').'" href="'.base_url('register').'">Registro</a> ';
					echo ' <a class="btn btn-outline-primary '.($uri->getSegment(1) =='login'?'d-none' : 'd-lg-block').'" href="'.base_url('login').'">Iniciar Sesión</a>';
				}
			?>
		</div>
	</div>
</nav>


<header class="main-header">
	<div id="SidebarNav" class="SidebarNav" onkeyup="sitepoint.SidebarNav_toggle(event);">
		<div class="row sticky-top bg-dark">
			<div class="col-md-12 p-3">
				<a href="<?=base_url('/');?>" class="navbar-brand text-white" title="Inicio">
					<i class="fal fa-tachometer-alt-slowest"></i> Tools
				</a>
				<button type="button" class="btn btn-link text-white float-end mr-5" onclick="sitepoint.SidebarNav_toggle(event);">
					<svg width="25" height="25" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
					</svg>
				</button>
			</div>
		</div>
		<section>
			<ul class="sections">
				<?php
				if (!session()->get('isLoggedIn')){
					echo '<a class="btn btn-outline-primary '.($uri->getSegment(1) =='login'?'d-none' : '').'" href="'.base_url('login').'">Iniciar Sesión</a> ';
					echo '<a class="btn btn-outline-success ml-3'.($uri->getSegment(1) =='register'?'d-none' : '').'" href="'.base_url('register').'">Registro</a>';
				}
				?>
			</ul>
		</section>
		<section>
			<h6 class="nom-sec">Principal</h6>
			<ul class="nav flex-column">
				<li class="nav-item">
					<a class="nav-link" aria-current="page" href="<?=base_url('pageajax');?>">
						<svg width="18" height="18" viewBox="0 0 16 16" class="bi bi-card-checklist" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" d="M14.5 3h-13a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
							<path fill-rule="evenodd" d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z"/>
						</svg> Paginación con Ajax
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?=base_url('pagenotajax');?>">
						<svg width="18" height="18" viewBox="0 0 16 16" class="bi bi-card-list" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" d="M14.5 3h-13a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
							<path fill-rule="evenodd" d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5z"/>
							<circle cx="3.5" cy="5.5" r=".5"/>
							<circle cx="3.5" cy="8" r=".5"/>
							<circle cx="3.5" cy="10.5" r=".5"/>
						</svg> Paginación sin Ajax
					</a>
				</li>
			</ul>
		</section>

		<?php if (session()->get('isLoggedIn')): ?>
			<section>
				<h6 class="nom-sec">Acciones</h6>
				<ul class="nav flex-column">
					<li class="nav-item">
						<a class="nav-link" href="<?=base_url('ptables');?>">
							<i class="fal fa-table mt-2"></i> Tablas con Ajax
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?=base_url('ptablesnjx');?>">
							<i class="fal fa-table mt-2"></i> Tabla sin Ajax
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?=base_url('upimages');?>">
							<i class="fal fa-images mt-2"></i> Subir imágenes
						</a>
					</li>

					<li class="nav-item">
						<a class="nav-link" href="<?=base_url('dragdrop');?>">
							<i class="fal fa-copy mt-2"></i> Drag & Drop
						</a>
					</li>
				
				</ul>

				<h6 class="nom-sec">Cuenta</h6>
				<ul class="nav flex-column">
					<li class="nav-item">
						<a class="nav-link" href="<?=base_url('profile');?>">
							<i class="fa fa-cog" aria-hidden="true"></i> Perfil
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?=base_url('logout');?>">
							<i class="fa fa-power-off" aria-hidden="true"></i> Cerrar Sesión
						</a>
					</li>
				</ul>
			</section>
		<?php endif; ?>
	</div>
	<div class="SidebarNav_lightbox" onclick="sitepoint.SidebarNav_toggle(event)"></div>
	<div class="NavBar_offsetSpacer"></div>
</header>