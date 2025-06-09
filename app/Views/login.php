<?php
include 'common/head.php';
include 'common/navbar.php';
echo '<script type="text/javascript">var base_url = "'.base_url().'";</script>'
?>

<div class="container mt-5">
	<div class="row justify-content-center">
		<div class="col-lg-5 col-md-6 col-sm-8 col-12">
			<div id="form-login" class="mt-3 mb-5">
				<form method="post" enctype="multipart/form-data" id="form-login-user" name="form-login-user" accept-charset="utf-8">
					<div class="row">
						<div class="col-md-12">
							<img class="img-fluid" src="" width="50">
						</div>
					</div>
					
					<div class="card">
						<div class="card-body">
							<h5 class="text-center card-title mb-4">
								Inicio de Sesión
							</h5>
							<div id="div-cnt-login" class="row">
								<div class="col-12" id="div-cnt-msg-login"></div>
								<div class="col-md-12 mb-3">
									<div class="form-group input-group">
										<span class="has-float-label">
											<input type="email" class="form-control float-form" placeholder=" " required="required" autocomplete="off" id="email" name="email"/>
											<label for="email">Usuario</label>
											<i class="fa fa-user form-control-feedback"></i>
										</span>
									</div>
								</div>
								
								<div class="col-md-12 mb-3">
									<div class="form-group input-group">
										<span class="has-float-label">
											<input type="password" placeholder=" " class="form-control float-form" id="password" name="password" size="30" autocomplete="off">
											<label for="password">Contraseña</label>
											<i id="icon-eye" class="fa fa-eye-slash form-control-feedback btn-show-passwd" data-passwd="password"></i>
										</span>
									</div>
								</div>
								<div class="col-md-12">
									<a class="align-middle text-muted" href="#" id="a-to-recover-passwd">
										Recupear contraseña? <i class="fa fa-chevron-right"></i>
									</a>
									<button type="submit" class="btn btn-primary btn-block float-end" name="btn-login" id="btn-login">
										<i class="fa fa-sign-in"></i> Iniciar sesión
									</button>
								</div>
								<div class="col-md-12 mt-3 mb-2 text-center">
									<a class="" href="<?=base_url('register');?>"><i class="fa fa-plus"></i> Registráte</a>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
			
			<div style="display: none;" id="form-olvidado" class="mt-5 mb-5">
				<form method="post" enctype="multipart/form-data" id="form-recover-passwd" name="form-recover-passwd" accept-charset="utf-8">
					<div class="card">
						<div class="card-body">
							<h5 class="card-title text-center mb-4">¿Olvidaste la contraseña?</h5>
							
							<div class="row">
								<div class="col-md-12">
									<p class="help-block text-justify">
										Ingresa tu correo electrónico y se te enviará una contraseña temporal para reestablecer tu acceso.
									</p>
								</div>
								<div class="col-md-12" id="div-msg-recover-passwd"></div>
								<div class="col-md-12">
									<div class="input-group mb-3">
										<span class="input-group-text">
											<i class="fa fa-user"></i>
										</span>
										<input type="email" class="form-control" placeholder="e-mail" aria-label="email" aria-describedby="basic-addon1" name="txt-email-recover" id="txt-email-recover" required="">
									</div>
								</div>

								<div class="col-md-12">
									<a class="text-muted" href="#" id="a-cnt-forget-login">
										<i class="fa fa-chevron-left"></i> Iniciar sesión
									</a>

									<button type="submit" class="btn btn-primary float-end btn-block" id="btn-recover-passwd" name="btn-recover-passwd">
										<i class="fa fa-check"></i> Continuar
									</button>
								</div>
							</div>

						</div>
					</div>
				</form>
			</div>

			<div style="display: none;" id="div-cnt-register" class="mt-5 mb-5">
				<form method="post" enctype="multipart/form-data" id="singup" name="singup" accept-charset="utf-8">
					<div class="card">
						<div class="card-body">
							<h5 class="card-title text-center mb-4">Registro</h5>
							<div class="row p-3">
								<div class="col-12" id="div-cnt-msg-singup"></div>
								<div class="col-md-12">
									<div class="form-group input-group">
										<span class="has-float-label">
											<input type="text" class="form-control" id="txt-nom-user" name="txt-nom-user" placeholder=" " required="" autocomplete="off" placeholder=" ">
											<label for="txt-nom-user">Nombre completo</label>
											<i class="fa fa-user form-control-feedback"></i>
										</span>
									</div>
								</div>

								<div class="col-md-12">
									<div class="form-group input-group">
										<span class="has-float-label">
											<input type="email" class="form-control" id="txt-email" name="txt-email" placeholder=" " required="" autocomplete="off">
											<label for="txt-email">Email</label>
											<i class="fa fa-at form-control-feedback"></i>
										</span>
									</div>
								</div>

								<div class="col-md-12">
									<div class="form-group input-group">
										<span class="has-float-label">
											<input type="password" class="form-control" id="txt-password" name="txt-password" placeholder=" " required="required" maxlength="26" autocomplete="off">
											<label for="txt-password">Contraseña</label>
											<i class="fa fa-eye-slash form-control-feedback btn-show-passwd" data-passwd="txt-password"></i>
										</span>
									</div>
								</div>
								<div class="col-md-12">
									<button type="submit" class="btn btn-primary btn-block " id="btn-singup" name="btn-singup">
										<i class="fa fa-check"></i> Registrarse
									</button>
								</div>

								<div class="col-md-12 mb-2 mt-3">
									<a class="text-muted" href="#" id="a-cnt-login">
										<i class="fa fa-chevron-left"></i> Iniciar sesión
									</a>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>


<?php
include 'common/foot.php';
mostrarMensaje();
?>
<script src="<?=base_url('assets/app/ajax/ajxlogin.js');?>"></script>