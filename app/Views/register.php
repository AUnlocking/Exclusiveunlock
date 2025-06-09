<?php
include 'common/head.php';
include 'common/navbar.php';
echo '<script type="text/javascript">var base_url = "'.base_url().'";</script>'
?>

<div class="container mt-5 mb-3">
	<div class="row justify-content-center">
		<div class="col-lg-5 col-md-8 col-sm-10 col-12 mt-5 pt-3 pb-3 bg-white">
			<div class="card">
				<div class="card-body">
					<h5 class="card-title text-center mb-4">Registro</h5>
					<form id="form-register" name="form-register" accept-charset="utf-8" enctype="multipart/form-data">
						<div class="row mb-3">
							<?php if (isset($validation)): ?>
								<div class="col-12">
									<div class="alert alert-danger" role="alert">
										<?= $validation->listErrors() ?>
									</div>
								</div>
							<?php endif; ?>
							<div class="col-12" id="div-cnt-msg-singup">
								
							</div>
							<div class="col-12 col-sm-6 mb-3">
								<div class="form-group input-group">
									<span class="has-float-label">
										<input type="text" class="form-control float-form" placeholder=" " name="firstname" id="firstname" value="" required=""/>
										<label for="firstname">Nombre</label>
										<i class="fa fa-user form-control-feedback"></i>
									</span>
								</div>
							</div>
							<div class="col-12 col-sm-6 mb-3">
								<div class="form-group input-group">
									<span class="has-float-label">
										<input type="text" class="form-control float-form" placeholder=" " name="lastname" id="lastname" value=""/>
										<label for="lastname">Apellido</label>
										<i class="fa fa-user form-control-feedback"></i>
									</span>
								</div>
							</div>
							<div class="col-12 mb-3">
								<div class="form-group input-group">
									<span class="has-float-label">
										<input type="email" class="form-control float-form" placeholder=" " name="email" id="email" value="" required=""/>
										<label for="email">Email</label>
										<i class="fa fa-at form-control-feedback"></i>
									</span>
								</div>
							</div>
							<div class="col-12 col-sm-6 mb-3">
								<div class="form-group input-group">
									<span class="has-float-label">
										<input type="password" placeholder=" " class="form-control float-form" id="password" name="password" size="30" autocomplete="off" required="">
										<label for="password">Contraseña</label>
										<i id="icon-eye" class="fa fa-eye-slash form-control-feedback btn-show-passwd" data-passwd="password"></i>
									</span>
								</div>
							 </div>
							 <div class="col-12 col-sm-6 mb-3">
							 	<div class="form-group input-group">
									<span class="has-float-label">
										<input type="password" placeholder=" " class="form-control float-form" id="password_confirm" name="password_confirm" size="30" autocomplete="off" required="">
										<label for="password_confirm">Contraseña</label>
										<i class="fa fa-eye-slash form-control-feedback btn-show-passwd" data-passwd="password_confirm"></i>
									</span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12 col-md-12 col-12">
								<a class="float-start" href="<?=base_url('login');?>">
									<i class="fa fa-chevron-left"></i> Iniciar sesión
								</a>

								<button type="submit" class="btn btn-primary float-end" id="btn-singup">
									<i class="fa fa-check"></i> Continuar
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
include 'common/foot.php';
mostrarMensaje();
?>
<script src="<?=base_url('assets/app/ajax/ajxlogin.js');?>"></script>