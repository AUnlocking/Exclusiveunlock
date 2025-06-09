function readURL(input, div) {
	var total_files = $(input)[0].files.length;
	$("#"+div).html('');
	for (i = 0; i<total_files; i++) {
		if ($(input)[0].files[i]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$("#"+div).append('<div class="col-md-2"><img id="img-'+i+'" src="'+e.target.result+'" class="img-fluid fit-image"/></div>')
			};
			reader.readAsDataURL(input.files[i]);
		}
	}
}

$('#form-up-img-ajx').on('submit', function(e){  
	$('#btn-up-img-ajx').html('<span class="spinner-border spin-x" role="status" aria-hidden="true"></span> Enviando...');
	$('#btn-up-img-ajx').attr("disabled", true);
	e.preventDefault();
	if($('#file-ajx').val() == ''){
		notify_msg("fa fa-times", " ", "Selecciona al menos un archivo.", "#", "danger");
		$('#btn-up-img-ajx').html('<i class="fa fa-upload"></i> Subir');
		$('#btn-up-img-ajx').attr("disabled", false);
		$("#div-cnt-img-ajx").html("");
		document.getElementById("form-up-img-ajx").reset();
	}else{
		$.ajax({
			url: 			base_url+"/uploads/store_img_ajx",
			method: 		"POST",
			data: 			new FormData(this),
			contentType: 	false,
			cache: 			false,
			processData: 	false,
			dataType: 		"json",
			success:function(res){
				console.log(res.success);
				if(res.tipo == "success"){
					$('#msg').html(res.msg);
					$('#divMsg').show();
				}else if(res.tipo == "danger"){
					$('#msg').html(res.msg);
					$('#divMsg').show();
				}
				setTimeout(function(){
					$('#msg').html('');
					$('#divMsg').hide();
					$("#div-cnt-img-ajx").html("");
				}, 3000);
				$('#btn-up-img-ajx').html('<i class="fa fa-upload"></i> Subir');
				$('#btn-up-img-ajx').prop('enabled');
				document.getElementById("form-up-img-ajx").reset();
				$('#btn-up-img-ajx').attr("disabled", false);
			},
			error: function(data) {
				$('#btn-up-img-ajx').attr("disabled", false);
				$('#btn-up-img-ajx').html('<i class="fa fa-upload"></i> Subir');
				notify_msg("fa fa-times", " ", "Error en la configuración de ajax.", "#", "danger");
			}
		});
	}
});

/**
 * [función que agrega la lista de imágenes una por una, pero de lado del cliente, se mandan una por una al servidor]
 */
$("#form-up-imgs-ajx").submit(function( event ) {
	var myfile 		= $('#files-ajx').val();
	var formData 	= new FormData();
	var fl 			= document.getElementById('files-ajx');
	var ln 			= fl.files.length;

	if (ln <= 0) {
		notify_msg("fa fa-exclamation-circle", " ", "Por favor seleccione al menos un archivo.", "#", "danger");
		return;
	}
	for (var i = 0; i<ln; i++) {
		formData.append('file', $('#files-ajx')[0].files[i]);
		$("#prg-bar-up-img").removeAttr("class").attr("class", "bg-success text-center");
		$('#prg-bar-up-img').css('width', '0');
		
		$('#btn-up-imgs-ajx').attr("disabled", true);
		$.ajax({
			url: 			base_url+"/uploads/store_img_ajx",
			data: 			formData,
			contentType: 	false,
			cache: 			false,
			processData: 	false,
			type: 			'POST',
			xhr: function () {
				var xhr = new window.XMLHttpRequest();
				xhr.upload.addEventListener("progress", function (evt) {
					if (evt.lengthComputable) {
						var percentComplete = evt.loaded / evt.total;
						percentComplete = parseInt(percentComplete * 100);
						$('#prg-bar-up-img').text(percentComplete + '%');
						$('#prg-bar-up-img').css('width', percentComplete + '%');
					}
				}, false);
				return xhr;
			},
			success: function (data) {
				notify_msg(data.icon, " ", data.msg, "#", data.tipo);
				if (data.tipo == 'success') {
					setTimeout(function(){
						$("#prg-bar-up-img").removeAttr("class").attr("class", "bg-defult text-center");
						$('#prg-bar-up-img').css('width', 100 + '%');
						$('#prg-bar-up-img').text('0%');
					}, 3000);
				}
				if (data.tipo=='danger') {
					setTimeout(function(){
						$("#prg-bar-up-img").removeAttr("class").attr("class", "bg-danger text-center");
						$('#prg-bar-up-img').css('width', 100 + '%');
						$('#prg-bar-up-img').text('0%');
					}, 3000);
				}
				$('#btn-up-imgs-ajx').attr("disabled", false);
				$("#form-up-imgs-ajx")[0].reset();
				$("#div-cnt-imgs-ajx").html("");
			},
			error: function(data) {
				$("#div-cnt-imgs-ajx").html("");
				$('#btn-up-imgs-ajx').attr("disabled", false);
				$('#prg-bar-up-img').css('width', 100 + '%');
				$('#prg-bar-up-img').text('0%');
				$("#prg-bar-up-img").removeAttr("class").attr("class", "bg-danger text-center");
				notify_msg("fa fa-times", " ", "Error en la configuración de ajax.", "#", "danger");
			}
		});
	}
	event.preventDefault();
});

/**
 * [función que agrega todas las imágenes y se agregan un por una de lado del servidor]
 */
$("#form-up-imgs-all").submit(function( event ) {
	var myfile 		= $('#files-all').val();
	var formData 	= new FormData();
	var fl 			= document.getElementById('files-all');
	var ln 			= fl.files.length;

	if (ln <= 0) {
		notify_msg("fa fa-exclamation-circle", " ", "Por favor seleccione al menos un archivo.", "#", "danger");
		return;
	}else{
		$("#prg-bar-up-all").removeAttr("class").attr("class", "bg-success text-center");
		$('#prg-bar-up-all').css('width', '0');
		
		$('#btn-up-imgs-all').attr("disabled", true);
		$.ajax({
			url: 			base_url+"/uploads/store_images_ajx",
			data: 			new FormData(this),
			contentType: 	false,
			cache: 			false,
			processData: 	false,
			type: 			'POST',
			xhr: function () {
				var xhr = new window.XMLHttpRequest();
				xhr.upload.addEventListener("progress", function (evt) {
					if (evt.lengthComputable) {
						var percentComplete = evt.loaded / evt.total;
						percentComplete = parseInt(percentComplete * 100);
						$('#prg-bar-up-all').text(percentComplete + '%');
						$('#prg-bar-up-all').css('width', percentComplete + '%');
					}
				}, false);
				return xhr;
			},
			success: function (data) {
				notify_msg(data.icon, " ", data.msg, "#", data.tipo);
				$('#prg-bar-up-all').css('width', 100 + '%');
				$('#prg-bar-up-all').text('0%');
				$("#div-cnt-imgs-all").html("");
				if (data.tipo == 'success') {
					setTimeout(function(){
						$("#prg-bar-up-all").removeAttr("class").attr("class", "bg-defult text-center");
					}, 3000);
				}else{
					$("#prg-bar-up-all").removeAttr("class").attr("class", "bg-danger text-center");
					setTimeout(function(){
						$("#prg-bar-up-all").removeAttr("class").attr("class", "bg-defult text-center");
					}, 3000);
				}
				$('#btn-up-imgs-all').attr("disabled", false);
				$("#form-up-imgs-all")[0].reset();
			},
			error: function(data) {
				$("#div-cnt-imgs-all").html("");
				$('#btn-up-imgs-all').attr("disabled", false);
				$('#prg-bar-up-all').css('width', 100 + '%');
				$('#prg-bar-up-all').text('0%');
				$("#prg-bar-up-all").removeAttr("class").attr("class", "bg-danger text-center");
				notify_msg("fa fa-times", " ", "Error en la configuración de ajax.", "#", "danger");
			}
		});
	}
	event.preventDefault();
});

$(document).on("change", ".upload-files-onchange", function (event) {
	var myfile 		= $('#files-change').val();
	var formData 	= new FormData();
	var fl 			= document.getElementById('files-change');
	var ln 			= fl.files.length;

	if (ln <= 0) {
		notify_msg("fa fa-exclamation-circle", " ", "Por favor seleccione al menos un archivo.", "#", "danger");
		return;
	}else{
		for (var i = 0; i<ln; i++) {
			formData.append('file', $('#files-change')[0].files[i]);
			$("#prg-bar-up-change").removeAttr("class").attr("class", "bg-success text-center");
			$('#prg-bar-up-change').css('width', '0');
			$.ajax({
				url: 			base_url+"/uploads/store_img_ajx",
				data: 			formData,
				contentType: 	false,
				cache: 			false,
				processData: 	false,
				type: 			'POST',
				xhr: function () {
					var xhr = new window.XMLHttpRequest();
					xhr.upload.addEventListener("progress", function (evt) {
						if (evt.lengthComputable) {
							var percentComplete = evt.loaded / evt.total;
							percentComplete = parseInt(percentComplete * 100);
							$('#prg-bar-up-change').text(percentComplete + '%');
							$('#prg-bar-up-change').css('width', percentComplete + '%');
						}
					}, false);
					return xhr;
				},
				success: function (data) {
					notify_msg(data.icon, " ", data.msg, "#", data.tipo);
					if (data.tipo == 'success') {
						setTimeout(function(){
							$("#prg-bar-up-change").removeAttr("class").attr("class", "bg-defult text-center");
							$('#prg-bar-up-change').css('width', 100 + '%');
							$('#prg-bar-up-change').text('0%');
							$("#div-cnt-imgs-change").html("");
						}, 3000);
					}
					if (data.tipo=='danger') {
						setTimeout(function(){
							$("#prg-bar-up-change").removeAttr("class").attr("class", "bg-danger text-center");
							$('#prg-bar-up-change').css('width', 100 + '%');
							$('#prg-bar-up-change').text('0%');
							$("#div-cnt-imgs-change").html("");
						}, 3000);
					}
					$("#form-up-imgs-change")[0].reset();
				},
				error: function(data) {
					$("#div-cnt-imgs-change").html("");
					$('#prg-bar-up-change').css('width', 100 + '%');
					$('#prg-bar-up-change').text('0%');
					$("#prg-bar-up-change").removeAttr("class").attr("class", "bg-danger text-center");
					notify_msg("fa fa-times", " ", "Error en la configuración de ajax.", "#", "danger");
				}
			});
		}
	}
	event.preventDefault();
});