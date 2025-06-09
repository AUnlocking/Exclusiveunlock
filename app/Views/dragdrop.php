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
					<li class="breadcrumb-item active" aria-current="page">Drag & Drop</li>
				</ol>
			</nav>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-sm-12 col-12 mb-3">
			<form enctype="multipart/form-data" method="post" accept-charset="utf-8">
				<div class="form-group">
					<div class="file-loading">
						<input id="file-1" type="file" name="file[]" multiple="" class="form-control file" data-overwrite-initial="false" data-min-file-count="1" accept=".png, .jpg, .jpeg, .pdf, .doc, .docx, .xls, .xlsx">
					</div>
				</div>
			</form>            
		</div>
	</div>
</div>

<?php
include 'common/foot.php';
mostrarMensaje();
?>
<script type="text/javascript">
	$(document).ready(function() {
		$("#file-1").fileinput({
			theme: 'fa',
			uploadUrl: base_url+'/upfiles',
			allowedFileExtensions: ['jpg', 'png', 'gif', 'pdf', 'jpeg', 'doc', 'docx', 'xls', 'xlsx', 'ods'],
			overwriteInitial: false,
			maxFileSize:120000,
			maxFilesNum: 10,
			slugCallback: function (filename) {
				return filename.replace('(', '_').replace(']', '_');
			}
		});
	});
</script>