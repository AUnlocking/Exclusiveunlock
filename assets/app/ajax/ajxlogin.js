$("#form-login-user").submit(function( event ) {
	$('#btn-login').attr("disabled", true);
	$("#div-cnt-msg-login").html("");
	var parametros 	= $(this).serialize();
	$.ajax({
		type: 		"POST",
		url: 		base_url+"/ajxlogin",
		data: 		parametros,
		dataType: 	"JSON",
		beforeSend: function(datos){
			$("#btn-login").html('<span class="spinner-border spin-x" role="status" aria-hidden="true"></span> Validando...');
		},
		success: function(datos){
			if (datos.tipo == "danger") {
				$("#div-cnt-msg-login").html('<div class="alert alert-danger alert-dismissible" role="alert"> <i class="fa fa-exclamation-circle"></i> '+datos.msg+
					'</div>');
				$("#btn-login").attr("disabled", false);
				$("#btn-login").html('<i class="fa fa-sign-in"></i> Iniciar sesión');
				setTimeout(function(){
					$("#div-cnt-msg-login").html('');
				}, 5000);
			}
			if (datos.tipo == "success") {
				$("#div-cnt-msg-login").html('<div class="alert alert-success text-center" role="alert"><i class="fa fa-check"></i> '+datos.msg+'</div>');
				$("#div-cnt-login").html('<div class="col-12 text-center"><h4><div class="spinner-border text-red spin-3x" role="status"><span class="sr-only">Loading...</span></div> <br>Redireccionando...</h4></div>');
				setTimeout(function(){
					$(window).attr('location', base_url+'/ptables');
				}, 1000);
			}
		},
		error: function(error) {
			$("#div-cnt-msg-login").html('<div class="alert alert-danger alert-dismissible" role="alert"><strong><i class="fa fa-exclamation-circle"></i></strong>'+
				' Error interno, intenta más tarde.</div>');
			$("#btn-login").attr("disabled", false);
			$("#btn-login").html('<i class="fa fa-sign-in"></i> Iniciar sesión');
			setTimeout(function(){
				$("#div-cnt-msg-login").html('');
			}, 5000);
		}
	});
	event.preventDefault();
});


$("#form-register").submit(function( event ) {
	$('#btn-singup').attr("disabled", true);
	$("#div-cnt-msg-singup").html("");
	var parametros 	= $(this).serialize();
	$.ajax({
		type: 		"POST",
		url: 		base_url+"/ajxregister",
		data: 		parametros,
		dataType: 	"JSON",
		beforeSend: function(datos){
			$("#btn-singup").html('<span class="spinner-border spin-x" role="status" aria-hidden="true"></span> Validando...');
		},
		success: function(datos){
			if (datos.tipo == "danger") {
				$("#div-cnt-msg-singup").html('<div class="alert alert-danger alert-dismissible" role="alert"> <i class="fa fa-exclamation-circle"></i> '+datos.msg+
					'</div>');
				setTimeout(function(){
					$("#div-cnt-msg-singup").html('');
				}, 5000);
			}
			if (datos.tipo == "success") {
				$("#div-cnt-msg-singup").html('<div class="alert alert-success text-center" role="alert"><i class="fa fa-check"></i> '+datos.msg+'</div>');
				$("#form-register")[0].reset();
				setTimeout(function(){
					$("#div-cnt-msg-singup").html('');
				}, 5000);
			}
			$("#btn-singup").attr("disabled", false);
			$("#btn-singup").html('<i class="fa fa-check"></i> Registrarse');
		},
		error: function(error) {
			$("#div-cnt-msg-singup").html('<div class="alert alert-danger alert-dismissible" role="alert"><i class="fa fa-exclamation-circle"></i>'+
				' Error interno, intenta más tarde.</div>');
			$("#btn-singup").attr("disabled", false);
			$("#btn-singup").html('<i class="fa fa-check"></i> Registrarse');
			setTimeout(function(){
				$("#div-cnt-msg-singup").html('');
			}, 5000);
		}
	});
	event.preventDefault();
});

$("#form-up-user").submit(function( event ) {
	$('#btn-up-user').attr("disabled", true);
	$("#div-cnt-msg-up-user").html("");
	var parametros 	= $(this).serialize();
	$.ajax({
		type: 		"POST",
		url: 		base_url+"/ajxupuser",
		data: 		parametros,
		dataType: 	"JSON",
		beforeSend: function(datos){
			$("#btn-up-user").html('<span class="spinner-border spin-x" role="status" aria-hidden="true"></span> Actualizando...');
		},
		success: function(datos){
			if (datos.tipo == "danger") {
				$("#div-cnt-msg-up-user").html('<div class="alert alert-danger alert-dismissible" role="alert"> <i class="fa fa-exclamation-circle"></i> '+datos.msg+
					'</div>');
				setTimeout(function(){
					$("#div-cnt-msg-up-user").html('');
				}, 5000);
			}
			if (datos.tipo == "success") {
				$("#div-cnt-msg-up-user").html('<div class="alert alert-success text-center" role="alert"><i class="fa fa-check"></i> '+datos.msg+'</div>');
				$("#form-up-user")[0].reset();
				setTimeout(function(){
					$("#div-cnt-msg-up-user").html('');
				}, 5000);
			}
			$("#btn-up-user").attr("disabled", false);
			$("#btn-up-user").html('<i class="fa fa-check"></i> Registrarse');
		},
		error: function(error) {
			$("#div-cnt-msg-up-user").html('<div class="alert alert-danger alert-dismissible" role="alert"><i class="fa fa-exclamation-circle"></i>'+
				' Error interno, intenta más tarde.</div>');
			$("#btn-up-user").attr("disabled", false);
			$("#btn-up-user").html('<i class="fa fa-check"></i> Actualizar');
			setTimeout(function(){
				$("#div-cnt-msg-up-user").html('');
			}, 5000);
		}
	});
	event.preventDefault();
});

$(document).ready(function() {
	$('#a-to-recover-passwd').click(function(e) {
		$('div#form-olvidado').toggle('500');
		$('div#form-login').hide();
		$('div#div-cnt-register').hide();
		e.preventDefault();
	});

	$('#a-cnt-register').click(function(e) {
		$('div#div-cnt-register').toggle('500');
		$('div#form-olvidado').hide();
		$('div#form-login').hide();
		e.preventDefault();
	});

	$('#a-cnt-forget-login').click(function(e) {
		$('div#div-cnt-register').hide();
		$('div#form-olvidado').hide();
		$('div#form-login').toggle('500');
		e.preventDefault();
	});
	
	$('#a-cnt-login').click(function(e) {
		$('div#form-login').toggle('500');
		$('div#div-cnt-register').hide();
		$('div#form-olvidado').hide();
		e.preventDefault();
	});
});


$("#form-recover-passwd").submit(function( event ) {
	$('#btn-recover-passwd').attr("disabled", true);
	var parametros = $(this).serialize();
	$.ajax({
		type: 		"POST",
		dataType: 	"JSON",
		url: 		base_url+"/login/recoverPaswdUser",
		data: 		parametros,
		beforeSend: function(objeto){
			$("#btn-recover-passwd").html('<span class="spinner-border spin-x" role="status" aria-hidden="true"></span> Buscando');
		},
		success: function(datos){
			$("#div-msg-recover-passwd").html('<div class="alert alert-'+datos.tipo+' alert-dismissible" role="alert">'+
				'<i class="'+datos.icon+'"></i> '+datos.msg+'</div>');
			$("#btn-recover-passwd").html('<i class="fa fa-check"></i> Continuar');
			$('#btn-recover-passwd').attr("disabled", false);
			$("#form-recover-passwd")[0].reset();
		},
		error: function(error) {
			$("#div-msg-recover-passwd").html('<div class="alert alert-danger alert-dismissible" role="alert">'+
				'<i class="fa fa-exclamation-circle"></i> Error interno, intenta más tarde.</div>');
			$("#btn-recover-passwd").html('<i class="fa fa-check"></i> Continuar');
			$('#btn-recover-passwd').attr("disabled", false);
			setTimeout(function(){
				$("#div-msg-recover-passwd").html('');
			}, 5000);
		}
	});
	event.preventDefault();
});


function matchPasswd(passwd, confirm){
	var password = document.getElementById(passwd);
	var confirm_password = document.getElementById(confirm);
	function validatePassword(){
		if(password.value != confirm_password.value){
			confirm_password.setCustomValidity("Las contraseñas no coinciden.");
		}else{
			confirm_password.setCustomValidity('');
		}
	}
	password.onchange 			= validatePassword;
	confirm_password.onkeyup 	= validatePassword;
}


$(document).on("click", ".btn-show-passwd", function () {
	var inputPass2 = document.getElementById($(this).data('passwd'));
	if ($(this).hasClass("fa-eye")) {
		inputPass2.setAttribute('type', 'password');
		$(this).removeAttr('class').attr('class', 'fa fa-eye-slash form-control-feedback btn-show-passwd');
		inputPass2.className 	= 'form-control';
	}else{
		inputPass2.setAttribute('type', 'text');
		$(this).removeAttr('class').attr('class', 'fa fa-eye form-control-feedback btn-show-passwd');
		inputPass2.className 	= 'form-control';
	}
});