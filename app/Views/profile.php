<?php
include 'common/head.php';
include 'common/navbar.php';
include("mdls/mdl_posts.php");
?>

<script type='text/javascript'>
var base_url = '<?=base_url();?>';
</script>
<div class="container mt-5">
	<div class="row justify-content-center">
		<div class="col-12 mt-4">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?=base_url('/');?>"><i class="fa fa-home"></i></a></li>
					<li class="breadcrumb-item active" aria-current="page">Perfil</li>
				</ol>
			</nav>
		</div>
		<div class="col-12 pt-3 pb-3">
			<h3><?= $user['firstname'].' '.$user['lastname'] ?></h3>
			<hr>
			<form method="post" enctype="multipart/form-data" id="form-up-user" name="form-up-user" accept-charset="utf-8">
				<div class="card border p-2">
					<div class="row">
						<div class="col-12" id="div-cnt-msg-up-user"></div>
						<div class="col-md-4 mb-2">
							<div class="form-group input-group">
								<span class="has-float-label">
									<input type="email" class="form-control float-form" placeholder=" " name="email" id="email" value="<?=$user['email'];?>" disabled="" readonly=""/>
									<label for="email">Email</label>
									<i class="fa fa-at form-control-feedback"></i>
								</span>
							</div>
						</div>
						<div class="col-md-4 mb-2">
							<div class="form-group input-group">
								<span class="has-float-label">
									<input type="text" class="form-control float-form" placeholder=" " name="firstname" id="firstname" value="<?=set_value('firstname', $user['firstname']);?>" required=""/>
									<label for="firstname">Nombre</label>
									<i class="fa fa-user form-control-feedback"></i>
								</span>
							</div>
						</div>
						<div class="col-md-4 mb-2">
							<div class="form-group input-group">
								<span class="has-float-label">
									<input type="text" class="form-control float-form" placeholder=" " name="lastname" id="lastname" value="<?=set_value('lastname', $user['lastname']);?>"/>
									<label for="lastname">Apellido</label>
									<i class="fa fa-user form-control-feedback"></i>
								</span>
							</div>
						</div>
						<div class="col-12">
							<hr>
						</div>
						<div class="col-md-3 col-sm-6 mb-2">
							<div class="form-group input-group">
								<span class="has-float-label">
									<input type="password" placeholder=" " class="form-control float-form" id="password" name="password" size="30" autocomplete="off">
									<label for="password">Contraseña</label>
									<i id="icon-eye" class="fa fa-eye-slash form-control-feedback btn-show-passwd" data-passwd="password"></i>
								</span>
							</div>
						 </div>
						 <div class="col-12 col-sm-3 mb-2">
						 	<div class="form-group input-group">
								<span class="has-float-label">
									<input type="password" placeholder=" " class="form-control float-form" id="password_confirm" name="password_confirm" size="30" autocomplete="off">
									<label for="password_confirm">Contraseña</label>
									<i class="fa fa-eye-slash form-control-feedback btn-show-passwd" data-passwd="password_confirm"></i>
								</span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12 mb-3">
							<button type="submit" class="btn btn-primary float-end" id="btn-up-user">
								<i class="fa fa-check"></i> Actualizar
							</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<script src="<?=base_url('assets/app/ajax/ajxlogin.js');?>"></script>
<?php
include 'common/foot.php';
mostrarMensaje();
?>