var limite 		= 10;
var filter 		= 2;
var order 		= "desc";
var order_by	= "id_post";

/*$('.dropdown-limit .dropdown-menu').find('a').click(function(e) {
	$("#spn-show-list").text($(this).data("total"));
	limite = $(this).data("total");
	load(1);
	e.preventDefault();
});

$('.dropdown-edo .dropdown-menu').find('a').click(function(e) {
	filter 		= $(this).data("edo");
	$("#i-icon-act").removeAttr("class").attr("class", $(this).data("icon"));
	$("#spn-desc-act").text($(this).data("desc"));
	load(1);
	e.preventDefault();
});*/

/*$("#form-search").submit(function( event ) {
	var parametros = $(this).serialize();
	load(1);
	event.preventDefault();
});*/

function load(page) {
	var search 		= $('#txt-search').val();
	$.ajax({
		type: 		'POST',
		url: 		base_url+'/load',
		method: 	'POST',
		dataType: 	'JSON',
		data: {
			page: 	page,
			search: search,
			filter: filter,
			limite: limite,
			order: 	order,
			order_by: order_by,
		},
		beforeSend: function(objeto) {
			$('#btn-search').html('<span class="spinner-border spin-x" role="status" aria-hidden="true"></span> Buscando...');
			$("#div-cnt-load").html('<div class="text-center alert alert-danger" role="alert">'+
				'<span class="spinner-border spin-x" role="status" aria-hidden="true"></span> Buscando...</div>');
		},
		success: function(res) {
			$('#div-cnt-load').html(res.data);
			$('#h5-cnt-total').html(res.total);
			$('#btn-search').html('<i class="text-primary fas fa-search"></i>');
		},
		error: function(data) {
			$("#btn-search").html('<i class="text-primary fas fa-search"></i>');
			$("#div-cnt-load").html('<div class="text-center alert alert-danger" role="alert"><i class="fas fa-exclamation-circle"></i> Error interno, intenta más tarde.</div>');
		}
	});
}

/*$(document).on("click", ".table th.th-link", function () {
	if (order=="asc") {
		order 	= "desc";
	}else{
		order 	= "asc";
	}
	order_by = $(this).attr("data-field");
	load(1);
});*/

$(document).on("click", ".mdl-del-reg", function () {
	$("#div-cnt-img-ajx").html("");
	$("#txt-id-reg-del").val($(this).data('idreg'));
	$("#txt-nom-reg").text('"'+$(this).data('nomreg')+'"');
});

$("#form-del-reg").submit(function( event ) {
	$("#btn-del-reg").attr("disabled", true);
	var idreg 		= $("#txt-id-reg-del").val();
	$.ajax({
		type: 		"POST",
		method: 	"POST",
		url: 		base_url+"/delete/"+idreg,
		data: {
			list_ids: idreg,
		},
		dataType: 	"json",
		beforeSend: function(objeto){
			$("#btn-del-reg").html('<span class="spinner-border spin-x" role="status" aria-hidden="true"></span> Eliminando');
		},
		success: function(datos){
			$("#btn-del-reg").html('<i class="fa fa-trash-alt"></i> Eliminar');
			$("#btn-del-reg").attr("disabled", false);
			$("#btn-close-mdl-del-reg").trigger("click");
			notify_msg(datos.icon, " ", datos.msg, "#", datos.tipo);
			if (datos.tipo=="success") {
				location.reload();
			}
		},
		error: function(data) {
			$("#form-del-reg")[0].reset();
			$("#btn-del-reg").html('<i class="fa fa-trash-alt"></i> Eliminar');
			$("#btn-del-reg").attr("disabled", false);
			$("#div-cnt-del-reg").html('<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-circle"></i>'+
				' Error interno, intenta más tarde.</div>');
			setTimeout(function(){
				$("#div-cnt-del-reg").html('');
			}, 3000);
		}
	});
	event.preventDefault();
});

$("#form-add-reg").submit(function( event ) {
	$('#btn-add-reg').attr("disabled", true);
	var parametros = $(this).serialize();
	$.ajax({
		type: 			"POST",
		dataType: 		"JSON",
		method: 		"POST",
		url: 		base_url+"/add",
		//data: 		parametros,
		data: 			new FormData(this),
		contentType: 	false,
		cache: 			false,
		processData: 	false,
		beforeSend: function(objeto){
			$("#btn-add-reg").html('<span class="spinner-border spin-x" role="status" aria-hidden="true"></span> Agregando');
		},
		success: function(datos){
			$("#btn-add-reg").html('<i class="fa fa-check"></i> Agregar');
			$('#btn-add-reg').attr("disabled", false);
			$("#form-add-reg")[0].reset();
			if (datos.tipo=="success") {
				$("#div-cnt-msg-add-reg").html('<div class="alert alert-success" role="alert"><i class="fas fa-check"></i>'+
				' Registro agregado. <br> Recargando la página.</div>');
				setTimeout(function(){
					location.reload();
				}, 3000);
			}
			$("#div-cnt-img-ajx").html("");
		},
		error: function(data) {
			$("#btn-add-reg").html('<i class="fa fa-check"></i> Agregar');
			$("#btn-add-reg").attr("disabled", false);
			$("#div-cnt-msg-add-reg").html('<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-circle"></i>'+
				' Error interno, intenta más tarde.</div>');
			setTimeout(function(){
				$("#div-cnt-msg-add-reg").html('');
			}, 3000);
		}
	});
	event.preventDefault();
});

$("#form-up-reg").submit(function( event ) {
	$('#btn-up-reg').attr("disabled", true);
	var parametros = $(this).serialize();
	$.ajax({
		type: "POST",
		dataType: 	"json",
		url: base_url+"/update",
		data: parametros,
		beforeSend: function(objeto){
			$("#btn-up-reg").html('<span class="spinner-border spin-x" role="status" aria-hidden="true"></span> Actualizando...');
		},
		success: function(datos){
			notify_msg(datos.icon, " ", datos.msg, "#", datos.tipo);
			$("#btn-up-reg").html('<i class="fa fa-check"></i> Actualizar');
			$('#btn-up-reg').attr("disabled", false);
		},
		error: function(data) {
			$("#btn-up-reg").html('<i class="fa fa-check"></i> Actualizar');
			$('#btn-up-reg').attr("disabled", false);
			$("#div-cnt-msg-up-reg").html('<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-circle"></i> Error de comunicación con el servidor. Intenta más tarde.</div>');
			setTimeout(function(){
				$("#div-cnt-msg-up-reg").html('');
			}, 3000);
		}
	});
	event.preventDefault();
});

/**
 * For delete seleceted list
 */

/**
 * [On clic fuction active all check box set for deleted]
 */
$(document).on("click", "#chk-all-regs", function() {
	$(".chks-regs").prop("checked", this.checked);
	var lista_regs = [];
	$(".chks-regs:checked").each(function() {
		lista_regs.push($(this).data('iddel'));
	});

	if (lista_regs.length >= 1) {
		$("#spn-del").html('<span class="label label-danger">'+lista_regs.length+'</span>');
		$("#btn-del-list").prop("disabled", false);
	}else{
		$("#spn-del").html('');
		$("#btn-del-list").prop("disabled", true);
	}
});

$(document).on("click", ".chks-regs", function() {
	if ($(".chks-regs:checked").length == $(".chks-regs").length) {
		$("#chk-all-regs").prop("checked", true);
	} else {
		$("#chk-all-regs").prop("checked", false);
	}
	
	var lista_regs = [];
	$(".chks-regs:checked").each(function() {
		lista_regs.push($(this).data('iddel'));
	});

	if (lista_regs.length >= 1) {
		$("#spn-del").html('<span class="label label-danger">'+lista_regs.length+'</span>');
		$("#btn-del-list").prop("disabled", false);
	}else{
		$("#spn-del").html('');
		$("#btn-del-list").prop("disabled", true);
	}
});

$(document).on("click", ".mdl-del-regs", function () {
	var lista_regs = [];
	$(".chks-regs:checked").each(function() {
		lista_regs.push($(this).data('iddel'));
	});

	if (lista_regs.length >= 1) {
		$("#btn-del-regs").prop("disabled", false);
		if (lista_regs.length==1) {
			$("#div-cnt-del-regs").html('<h5>¿Está seguro de eliminar 1 registro?</h5>');
		}else{
			$("#div-cnt-del-regs").html('<h5>¿Está seguro de eliminar '+lista_regs.length+' registros?</h5>');
		}
	}else{
		$("#div-cnt-del-regs").html('<div class="alert alert-danger" role="alert"><i class="fa fa-exclamation-triangle"></i> Por favor seleccione al menos un registro.</div>');
		$("#btn-del-regs").prop("disabled", true);
	}
});

$("#form-del-regs").submit(function( event ) {
	$("#btn-del-list").attr("disabled", true);
	var list_ids = [];
	$(".chks-regs:checked").each(function() {
		list_ids.push($(this).data('iddel'));
	});
	var ids = list_ids.join(",");
	$.ajax({
		type: 		"POST",
		url: 		base_url+"/dellist",
		data: {
			list_ids: ids,
		},
		dataType: 	"json",
		beforeSend: function(objeto){
			$("#btn-del-regs").html('<span class="spinner-border spin-x" role="status" aria-hidden="true"></span> Eliminando');
		},
		success: function(datos){
			$("#btn-del-regs").html('<i class="fa fa-trash-alt"></i> Eliminar');
			$("#btn-del-regs").attr("disabled", false);
			$("#btn-close-mdl-del-regs").trigger("click");
			notify_msg(datos.icon, " ", datos.msg, "#", datos.tipo);
			$("#form-del-regs")[0].reset();
			setTimeout(function(){
				location.reload();
			}, 3000);
		},
		error: function(data) {
			$("#btn-del-regs").html('<i class="fa fa-trash-alt"></i> Eliminar');
			$("#btn-del-regs").attr("disabled", false);
			$("#div-cnt-del-list-regs").html('<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-circle"></i>'+
				' Error interno, intenta más tarde.</div>');
			setTimeout(function(){
				$("#div-cnt-del-list-regs").html('');
			}, 3000);
		}
	});
	event.preventDefault();
});

function readURL(input, div) {
	var total_files = $(input)[0].files.length;
	$("#"+div).html('');
	for (i = 0; i<total_files; i++) {
		if ($(input)[0].files[i]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$("#"+div).append('<div class="col-md-12"><img id="img-'+i+'" src="'+e.target.result+'" class="img-fluid"/></div>')
			};
			reader.readAsDataURL(input.files[i]);
		}
	}
}