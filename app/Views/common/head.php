<!doctype html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" href="<?=base_url('assets/app/images/fav.png');?>" type="image/png">
		<title><?=$title;?></title>

		<!-- Bootstrap core CSS-->
		<link href="<?=base_url('assets/vendor/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet">
		<link href="<?=base_url('assets/vendor/bootstrap/css/animate.css');?>" rel="stylesheet">
		<link href="<?=base_url('assets/vendor/bootstrap/css/animation.css');?>" rel="stylesheet">
		<link href="<?=base_url('assets/vendor/bootstrap/css/fileinput.css');?>" media="all" rel="stylesheet" type="text/css"/>
		<!-- Custom fonts for this template-->
		<link href="<?=base_url('assets/vendor/font-awesome/css/all.css');?>" rel="stylesheet" type="text/css">
		<link href="<?=base_url('assets/app/css/custom.css');?>" rel="stylesheet" type="text/css">
		
		<link href="<?=base_url('assets/app/css/files.css');?>" rel="stylesheet" type="text/css">
		<link href="<?=base_url('assets/app/css/navleftmenu.css');?>" rel="stylesheet" type="text/css">
		
		
		<?=($tab=='docs'?'<link href="'.base_url('assets/app/docs/docs.css').'" rel="stylesheet" type="text/css">':'');?>

		<!--script src="https://www.google.com/recaptcha/api.js?render=< ? =$this->config->item('site_key_v3'); ? >"></script-->
		<!--script src='https://www.google.com/recaptcha/api.js'></script-->
		<meta name="description" content="Website development using codeigniter v4 & bootstrap 4.4.1">
		<meta name="author" content="Fernando Merino">
		<meta name="keywords" content="linuxitos,fedora,linuxitos">
	</head>
	<body>