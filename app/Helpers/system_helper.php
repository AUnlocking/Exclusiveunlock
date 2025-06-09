<?php

/**
 * [Función que redirige una página a otra, con mensajes, requiere recabar e la url message, tipo, icono, titulo, url]
 * @param  boolean $page         [description]
 * @param  [type]  $message      [description]
 * @param  [type]  $message_type [description]
 * @return [type]                [description]
 */
function redirect_us($page = FALSE, $message = NULL, $message_type = NULL){
	if(is_string ($page)){
		$location = $page;
	}else{
		$location = $_SERVER ['SCRIPT_NAME'];
	}

	// Check for the message
	if($message != NULL){
		// Set Message
		$_SESSION['message'] = $message;
	}
	// Check for type
	if($message_type != NULL){
		// Set message type
		$_SESSION['message_type'] = $message_type;
	}

	// Redireccionamiento
	header ('Location: ' .$location);
	exit;
}

/**
 * [Función que redirige una página a otra, con mensajes, requiere recabar e la url message, tipo, icono, titulo, url]
 * @param  boolean $page         [description]
 * @param  [type]  $message      [description]
 * @param  [type]  $message_type [description]
 * @return [type]                [description]
 */
function redireccionar($page = FALSE, $text_msg = NULL, $tipo_msg = NULL, $icono_msg = NULL, $titulo_msg  = NULL, $url_msg = NULL){
	if(is_string ($page)){
		$location = $page;
	}else{
		$location = $_SERVER ['SCRIPT_NAME'];
	}

	// Check for the message
	if($text_msg != NULL){
		// Set Message
		$_SESSION['text_msg'] = $text_msg;
	}
	// Check for type
	if($tipo_msg != NULL){
		// Set message type
		$_SESSION['tipo_msg'] = $tipo_msg;
	}

	if($icono_msg != NULL){
		// Set message type
		$_SESSION['icono_msg'] = $icono_msg;
	}

	if($titulo_msg != NULL){
		// Set message type
		$_SESSION['titulo_msg'] = $titulo_msg;
	}

	if($url_msg != NULL){
		// Set message type
		$_SESSION['url_msg'] = $url_msg;
	}

	// Redireccionamiento
	header ('Location: ' .$location);
	exit;
}

/**
 * [Función que envia un mensaje de notificación en pantalla, requiere de los siguientes datos
 * message, tipo, icono, titulo, url]
 * @return [type] [description]
 */
function mostrarMensaje(){
	if(!empty($_SESSION['text_msg'])){
		$message = $_SESSION['text_msg'];
		if(!empty($_SESSION['tipo_msg'])){
			$message_type 	= $_SESSION['tipo_msg'];
			$icono_msg 		= $_SESSION['icono_msg'];
			$titulo_msg 	= $_SESSION['titulo_msg'];
			$url_msg 		= $_SESSION['url_msg'];
			echo '<script language="javascript">notify_msg("'.$icono_msg.'", "'.$titulo_msg.'", "'.$message.'", "'.$url_msg.'", "'.$message_type.'");</script>';
			// Eliminar mensaje
			unset($_SESSION['text_msg']);
			unset($_SESSION['tipo_msg']);
		}else{
			echo '';
		}
	}
}

/**
 * [Función que envia un mensaje de notificación en pantalla, requiere de los siguientes datos
 * message, tipo, icono, titulo, url]
 * @return [type] [description]
 */
function displayMessage(){
	if(!empty($_SESSION['message'])){
		// Assign message to a variable
		$message = $_SESSION['message'];

		if(!empty($_SESSION['message_type'])){
			// Assign type to a variable
			$message_type = $_SESSION['message_type'];
			// Create output glyphicon 
			if ($message_type == 'error'){
				echo '<script language="javascript">mensaje("Error en el nombre de usuario o contraseña", "danger", "glyphicon glyphicon-warning-sign", "", "#");</script>';
				//echo '<div class="alert alert-danger"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> '.$message.'</div>';
			}else{
				echo '<script language="javascript">mensaje("Has iniciado sesión.", "success", "glyphicon glyphicon-ok-sign", "", "#");</script>';
				//echo '<div class="alert alert-success"> <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> ' . $message . '</div>';
			}
			// Eliminar mensaje
			unset($_SESSION['message']);
			unset($_SESSION['message_type']);
		}else{
			echo '';
		}
	}
}

/*
 * Verifica si existe una sesión iniciada.
 */
function isLoggedIn(){
	if(isset($_SESSION['sesion_iniciada'])){
		return true;
	}else{
		return false;
	}
}


/*
 * Retorna datos del usuario, el id_user, usarname, name
 */
function getUser(){
	$userArray = array();
	$userArray['id_usuario'] = $_SESSION['id_usuario'];
	$userArray['username'] = $_SESSION['username'];
	$userArray['nom_user'] = $_SESSION['nom_user'];
	$userArray['contrasenia'] = $_SESSION['contrasenia'];
	$userArray['email'] = $_SESSION['email'];
	return $userArray;
}

function obtIdUsuarioLogueado(){
	$db = new Database;
	$db->query("select id_usuario from hj_usuarios where id_usuario=:id_usuario;");
	$db->bind(":id_usuario", obtIdUser());
	$rows = $db->resultset();
	$id_usuario = 0;
	foreach ($rows as $val){
		$id_usuario = $val->id_usuario;
	}
	return $id_usuario;
}

/*
 * Verifica si el usuario logeado es administrador
 */
function isAdmin(){
	if(isset($_SESSION['es_admin'])){
		if($_SESSION['es_admin']==1){
			return true;
		}else{
			return false;
		}
	}else{
		return false;
	}
}

/**
 * [retorna el id del usuario que haya iniciado sesión]
 * @return [type] [retorna un entero]
 */
function obtIdUser(){
	if(isset($_SESSION['id_usuario'])){
		return $_SESSION['id_usuario'];
	}else{
		return 0;
	}
}


function getRealIpAddr(){
	if (getenv('HTTP_CLIENT_IP')) {
		$ip = getenv('HTTP_CLIENT_IP');
	}elseif (getenv('HTTP_X_FORWARDED_FOR')) {
		$ip = getenv('HTTP_X_FORWARDED_FOR');
	}elseif (getenv('HTTP_X_FORWARDED')) {
		$ip = getenv('HTTP_X_FORWARDED');
	}elseif (getenv('HTTP_FORWARDED_FOR')) {
		$ip = getenv('HTTP_FORWARDED_FOR');
	}elseif (getenv('HTTP_FORWARDED')) {
		$ip = getenv('HTTP_FORWARDED');
	}else {
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	return $ip;
}

function getIpPublic(){
	$ip = file_get_contents('https://api.ipify.org');
	return $ip;
}

function getFechaMexico(){
	date_default_timezone_set('America/Mexico_City');
	$timezone = date_default_timezone_get();
	return date("Y-m-d H:i:s");
}

function getDateBulletinCreated($date_created){
	$date = date_create($date_created);
	date_time_set($date,13,24);
	return date_format($date,"Y-m-d");
}

function getFechaMexicoYmd(){
	date_default_timezone_set('America/Mexico_City');
	$timezone = date_default_timezone_get();
	return date("Y-m-d");
}

function getNameMachine(){
	return gethostname();
}

function esCerradoTema($fecha_cierre){
	$cerrado = true;
	date_default_timezone_set('America/Mexico_City');
	$timezone = date_default_timezone_get();

	$hoy = date('Y-m-d', time());
	$creado = strtotime($hoy);
	$cierre = strtotime($fecha_cierre);

	if($creado<$cierre){
		$cerrado = false;
	}

	return $cerrado;
}

function esFechaIgualHoy($fecha){
	date_default_timezone_set('America/Mexico_City');
	$timezone = date_default_timezone_get();
	$hoy = date('Y-m-d', time());

	$time = strtotime($fecha);
	$newformat = date('Y-m-d',$time);

	//$fecha = date('Y-m-d', $fecha);
	if ($hoy===$newformat) {
		return true;
	}else{
		return false;
	}
}

function fechaVenceMayorAhoy($fecha){
	date_default_timezone_set('America/Mexico_City');
	$timezone = date_default_timezone_get();
	$hoy = date('Y-m-d', time());

	$time = strtotime($fecha.' +1 day');
	$vence = date('Y-m-d',$time);

	//$fecha = date('Y-m-d', $fecha);
	if ($vence<=$hoy) {
		return true;
	}else{
		return false;
	}
}

function fechaBDmayorHoy($fecha){
	date_default_timezone_set('America/Mexico_City');
	$timezone = date_default_timezone_get();
	$hoy = date('Y-m-d', time());

	$time = strtotime($fecha.' +1 day');
	$vence = date('Y-m-d',$time);

	//$fecha = date('Y-m-d', $fecha);
	if ($vence<=$hoy) {
		return true;
	}else{
		return false;
	}
}

function getFechaCreado($creado){
	$arr = explode(' ', trim($creado));
	$arr1 = explode('-', trim($arr[0]));
	$anio = $arr1[0];
	$mes = $arr1[1];
	$dia = $arr1[2];
	return $fecha=($dia.'/'.$mes.'/'.$anio);
}

function getFechaCierre($fecha){
	$arr = explode('-', trim($fecha));
	$anio = $arr[0];
	$mes = $arr[1];
	$dia = $arr[2];
	echo $dia.'/'.$mes.'/'.$anio;
}

function getFechaCreadoBD($creado){
	$arr = explode(' ', trim($creado));
	$arr1 = explode('-', trim($arr[0]));
	$anio = $arr1[0];
	$mes = $arr1[1];
	$dia = $arr1[2];
	return $fecha=($anio.'-'.$mes.'-'.$dia);
}

function clean_string($string) {
	$bad = array("content-type","bcc:","to:","cc:","href");
	return str_replace($bad,"",$string);
}

function enviarMail($solicitante, $email, $asunto, $email_area, $mensaje){
	//A partir de aqui se contruye el cuerpo del mensaje tal y como llegará al correo
	//$email_message = "Contenido del Mensaje.\n\n";
	//$email_message .= "Nombre: ".clean_string($solicitante)."\n";
	//$email_message .= "Email: ".clean_string($email)."\n";
	//$email_message .= "Asunto: ".clean_string($asunto)."\n";
	//$email_message .= "Mensaje: ".clean_string($mensaje)."\n";
	//Se crean los encabezados del correo
	$headers = 'From: '.$email."\r\n".'Reply-To: '.$email."\r\n" .'X-Mailer: PHP/' . phpversion();
	@mail($email_area, $asunto, $mensaje, $headers);
}

function fraseAleatoria($length=8){
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	return $randomString;
}

function count_file_path($path){
	//$path = "../images/sliders";
	$d = dir($path);
	$totalfiles=0;
	while (false !== ($entry = $d->read())){
		$filepath = "{$path}/{$entry}";
		$latest_filename = $entry;
		if($latest_filename != "." && $latest_filename != "..") {
			$totalfiles=$totalfiles+1;
		}
	}
	return $totalfiles;
}

function name_file_path($path){
	//$path = "../../images/sliders";
	//$pathdefault = "images/sliders/";
	$d = dir($path);

	$namefiles = array();
	$i=0;
	while (false !== ($entry = $d->read())){
		$filepath = "{$path}/{$entry}";
		$latest_filename = $entry;
		if($latest_filename != "." && $latest_filename != "..") {
			$namefiles[$i] = $entry;
			//$latest_filename = $entry;
			//echo "$latest_filename<br/>";
			//$totalfiles=$totalfiles+1;
			$i=$i+1;
		}
	}
	return $namefiles;
}

function obt_nom_archivos_ruta($path){
	//$path = "../images/sliders";
	//$pathdefault = "images/sliders/";
	$d = dir($path);

	$namefiles = array();
	$i=0;
	while (false !== ($entry = $d->read())){
		$filepath = "{$path}/{$entry}";
		$latest_filename = $entry;
		if($latest_filename != "." && $latest_filename != "..") {
			$namefiles[$i] = $entry;
			//$latest_filename = $entry;
			//echo "$latest_filename<br/>";
			//$totalfiles=$totalfiles+1;
			$i=$i+1;
		}
	}
	return $namefiles;
}

function crearDirectorio($ruta){
	if (!file_exists($ruta)) {
		mkdir($ruta, 777, true);
		return true;
	}else{
		return false;
	}
}

function eliminar_archivo($dir, $archivo){
	if(file_exists($dir.$archivo)){
		unlink("$dir".$archivo);
		return true;
	}else{
		return false;
	}
}

function uniqid_base36($more_entropy=true){
	$s = uniqid('', $more_entropy);
	if (!$more_entropy)
		return base_convert($s, 16, 36);
		
	$hex = substr($s, 0, 13);
	$dec = $s[13] . substr($s, 15); // skip the dot
	return base_convert($hex, 16, 36) . base_convert($dec, 10, 36);
}

function uniqidReal($lenght = 13) {
	// uniqid gives 13 chars, but you could adjust it to your needs.
	if (function_exists("random_bytes")) {
		$bytes = random_bytes(ceil($lenght / 2));
	} elseif (function_exists("openssl_random_pseudo_bytes")) {
		$bytes = openssl_random_pseudo_bytes(ceil($lenght / 2));
	} else {
		throw new Exception("no cryptographically secure random function available");
	}
	return substr(bin2hex($bytes), 0, $lenght);
}

function obtIconArchivo($ext) {
	$icon = "fa fa-file";
	switch ($ext) {
		case 'pdf':
			$icon = " fal fa-file-pdf ";
			break;
		case 'doc':
			$icon = " fal fa-file-word ";
			break;
		case 'mp3':
			$icon = " fal fa-file-audio ";
			break;
		case 'docx':
			$icon = " fal fa-file-word ";
			break;
		case 'xls':
			$icon = " fal fa-file-excel ";
			break;
		case 'xlsx':
			$icon = " fal fa-file-excel ";
			break;
		case 'txt':
			$icon = " fal fa-file-text ";
			break;
		case 'ppt':
		case 'pptx':
			$icon = " fal fa-file-powerpoint ";
			break;
		case 'jpg':
		case 'jpeg':
		case 'png':
			$icon = " fal fa-file-image ";
			break;
		default:
			$icon = " fal fa-file-text ";
			break;
	}
	return $icon;
}


function obtTipoArchivo($ext) {
	$tipo = "";
	switch ($ext) {
		case 'application/wps-office.doc':
		case 'application/msword':
			$tipo = "doc";
			break;
		case 'application/pdf':
			$tipo = "pdf";
			break;
		case 'application/wps-office.docx':
		case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document':
			$tipo = "docx";
			break;
		case 'application/wps-office.xls':
		case 'application/vnd.ms-excel':
			$tipo = "xls";
			break;
		case 'application/wps-office.xlsx':
		case 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet':
			$tipo = "xlsx";
			break;
		case 'application/wps-office.ppt':
		case 'application/vnd.ms-powerpoint':
			$tipo = "ppt";
			break;
		case 'application/wps-office.pptx':
		case 'application/vnd.openxmlformats-officedocument.presentationml.presentation':
			$tipo = "pptx";
			break;
		case 'image/png':
			$tipo = "png";
			break;
		case 'image/jpeg':
			$tipo = "jpeg";
			break;
		case 'image/gif':
			$tipo = "gif";
			break;
		case 'image/jpg':
			$tipo = "jpg";
			break;
	}
	return $tipo;
}

function formatBytes($bytes, $precision) { 
	$units = array('B', 'KB', 'MB', 'GB', 'TB'); 

	$bytes = max($bytes, 0); 
	$pow = floor(($bytes ? log($bytes) : 0) / log(1024)); 
	$pow = min($pow, count($units) - 1); 

	// Uncomment one of the following alternatives
	// $bytes /= pow(1024, $pow);
	// $bytes /= (1 << (10 * $pow)); 

	return round($bytes, $precision) . ' ' . $units[$pow]; 
}


function catch_that_image($post) {
	//global $post, $posts;
	$first_img = '';
	ob_start();
	ob_end_clean();

	$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
	if (!empty($output)) {
		$first_img = $matches [1] [0];
	}

	if(empty($first_img)){ //Defines a default image
		$first_img = base_url()."assets/images/blog/default_post.png";
	}
	return $first_img;
}

function stripHTMLtags($str){
	$t = preg_replace('/<[^<|>]+?>/', '', htmlspecialchars_decode($str));
	$t = htmlentities($t, ENT_QUOTES, "UTF-8");
	return $t;
}

function splitArraySearch($array){
	$words = array();
	$i = 0;
	foreach ($array as $ele) {
		if ($ele!="el" && $ele!="lo" && $ele!="los" && $ele!="las" && $ele!="con" && $ele!="más" && $ele!="mas" && $ele!="el" && $ele!="de" && $ele!="del" && $ele!="otro" && $ele!="y" && $ele!="o" && $ele!="a" && $ele!="otros" && $ele!="mejor" && $ele!="solo" && $ele!="unico") {
			$words[$i] = $ele;
		}
		$i++;
	}
	return $words;
}

function splitWordSearch($str){
	$str 			= trim($str);
	$wds 			= array();
	$words_split 	= explode(' ', strtolower($str));
	$words 			= explode(" ", strtolower($str));
	$temp 			= strtolower($str);
	while(sizeof($words)>0){
		$words = explode(" ", $temp);
		array_splice($words, -1);
		$temp = implode(" ", $words);
		if ($temp!="") {
			$wds[] = $temp;
		}
	}
	foreach ($words_split as $word) {
		if ($word!="el" && $word!="lo" && $word!="los" && $word!="las" && $word!="con" && $word!="más" && $word!="mas" && $word!="el" && $word!="de" && $word!="del" && $word!="otro" && $word!="y" && $word!="o" && $word!="un" && $word!="una" && $word!="a" && $word!="otros" && $word!="mejor" && $word!="solo" && $word!="unico") {
			$wds[] = $word;
		}
	}
	return $wds;
}

function get_words($sentence, $count = 10) {
	preg_match("/(?:[^\s,\.;\?\!]+(?:[\s,\.;\?\!]+|$)){0,$count}/", $sentence, $matches);
	return $matches[0];
}

function image_thumb($folder_name, $image_name, $width, $height){
	// Get the CodeIgniter super object
	$CI =& get_instance();

	// Path to image thumbnail
	$image_thumb = dirname('../../../files/' . $folder_name . '/' . $image_name) . '/' . base64_encode($image_name) . '_' . $width . '_' . $height . strrchr($image_name, '.');
	if( ! file_exists($image_thumb)){
		// LOAD LIBRARY
		$CI->load->library('image_lib');
		// CONFIGURE IMAGE LIBRARY
		$config['image_library']    = 'gd2';
		$config['source_image']     = '../../../files/' . $folder_name. '/thumb-' . $image_name;
		$config['new_image']        = $image_thumb;
		$config['maintain_ratio']   = TRUE;
		$config['height']           = $height;
		$config['width']            = $width;
		$CI->image_lib->initialize($config);
		$CI->image_lib->resize();
		$CI->image_lib->clear();
	}
	// return '<img src="' . dirname($_SERVER['SCRIPT_NAME']) . '/' . $image_thumb . '" />';
}

function uuidv4($trim = false) {	
	$format = ($trim == false) ? '%04x%04x-%04x-%04x-%04x-%04x%04x%04x' : '%04x%04x%04x%04x%04x%04x%04x%04x';
	
	return sprintf($format,
		// 32 bits for "time_low"
		mt_rand(0, 0xffff), mt_rand(0, 0xffff),
		// 16 bits for "time_mid"
		mt_rand(0, 0xffff),
		// 16 bits for "time_hi_and_version",
		// four most significant bits holds version number 4
		mt_rand(0, 0x0fff) | 0x4000,
		// 16 bits, 8 bits for "clk_seq_hi_res",
		// 8 bits for "clk_seq_low",
		// two most significant bits holds zero and one for variant DCE1.1
		mt_rand(0, 0x3fff) | 0x8000,
		// 48 bits for "node"
		mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
	);
}

function slugify($text){
	// replace non letter or digits by -
	$text = preg_replace('~[^\\pL\d]+~u', '-', $text);
	// trim
	$text = trim($text, '-');
	// transliterate
	if (function_exists('iconv')){
		$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
	}
	// lowercase
	$text = strtolower($text);
	// remove unwanted characters
	$text = preg_replace('~[^-\w]+~', '', $text);

	if(strlen($text)>=80){
		$text = substr($text, 0, 80);
	}

	if (empty($text)){
		return 'n-a';
	}
	return $text;
}

function delArtsStr($frase){
	$palabras = array();
	foreach ($frase as $palabra) {
		if(strlen($palabra)>2 && $palabra!="con" && $palabra!="del" && $palabra!="así" && $palabra!="asi" && $palabra!="las" && $palabra!="los" && $palabra!="que" && $palabra!="mas" && $palabra!="pero" && $palabra!="qué" && $palabra!="más"){
			$palabras[] = $palabra;
		}
	}
	return $palabras;
}

function genQueryWhere($lista_campos, $list_words){
	$b=0;
	$condicion = "";
	if (sizeof($list_words)==0) {
		$list_words[0] = "";
	}
	for ($i=0; $i < sizeof($lista_campos); $i++) { 
		$wh = " (";
		for ($j=0; $j < sizeof($list_words); $j++) { 
			$wh .= " ".$lista_campos[$i]." LIKE :b".$b;
			if (sizeof($list_words)>1 && $j < sizeof($list_words)-1) {
				$wh .= " or ";
			}
			$b++;
		}
		$wh .= ") ";
		if (sizeof($lista_campos)>1 && $i<sizeof($lista_campos)-1) {
			$wh .= " or ";
		}
		$condicion .=$wh;
	}
	return $condicion;
}

function genDataBind($lista_campos, $list_words){
	$data_bind = array();
	$b=0;
	if (sizeof($list_words)==0) {
		$list_words[0] = "";
	}
	for ($i=0; $i < sizeof($lista_campos); $i++) { 
		for ($j=0; $j < sizeof($list_words); $j++) { 
			$data_bind['b'.$b] = $list_words[$j];
			$b++;
		}
	}
	return $data_bind;
}

function cleanStr($s){
	return str_replace(array('¡','.',',','!','&','<','>','/','\\','"',"'",'?','+'), '', $s);
}

function new_uuid(){
	// use uuid extension from PECL if available
	if (function_exists("uuid_create")) {
		return uuid_create();
	}
	// fallback
	$uuid = md5(microtime() . getmypid());
	// this should be random enough for now
	// set variant and version fields for 'true' random uuid
	$uuid[12] = "4";
	$n = 8 + (ord($uuid[16]) & 3);
	$hex = "0123456789abcdef";
	$uuid[16] = $hex[$n];
	// return formated uuid
	return substr($uuid, 0, 8) . "-" . substr($uuid, 8, 4) . "-" . substr($uuid, 12, 4) . "-" . substr($uuid, 16, 4) . "-" . substr($uuid, 20);
 }


 function paginate($reload, $page, $tpages, $adjacents, $fuc_load) {
	$prevlabel 	= '<i class="fas fa-chevron-left"></i>';
	$nextlabel 	= '<i class="fas fa-chevron-right"></i>';
	$out 		= '<nav aria-label="..."><ul class="pagination pagination-large justify-content-end">';
	
	// previous label
	if($page==1) {
		$out .= '<li class="page-item disabled"><a class="page-link">'.$prevlabel.'</a></li>';
	} else if($page==2) {
		$out .= '<li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="'.$fuc_load.'(1);">'.$prevlabel.'</a></li>';
	}else {
		$out .= '<li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="'.$fuc_load.'('.($page-1).');">'.$prevlabel.'</a></li>';
	}
	
	// first label
	if($page>($adjacents+1)) {
		$out .= '<li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="'.$fuc_load.'(1);">1</a></li>';
	}

	// interval
	if($page>($adjacents+2)) {
		$out .= '<li class="page-item disabled"><a class="page-link">...</a></li>';
	}

	// pages
	$pmin = ($page>$adjacents) ? ($page-$adjacents) : 1;
	$pmax = ($page<($tpages-$adjacents)) ? ($page+$adjacents) : $tpages;
	for($i=$pmin; $i<=$pmax; $i++) {
		if($i==$page) {
			$out .= '<li class="page-item active"><a class="page-link">'.$i.'</a></li>';
		}else if($i==1) {
			$out .= '<li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="'.$fuc_load.'(1);">'.$i.'</a></li>';
		}else {
			$out .= '<li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="'.$fuc_load.'('.$i.');">'.$i.'</a></li>';
		}
	}

	// interval
	if($page<($tpages-$adjacents-1)) {
		$out .= '<li class="page-item disabled"><a class="page-link">...</a></li>';
	}

	// last
	if($page<($tpages-$adjacents)) {
		$out .= '<li class="page-item"><a class="page-link" href="javascript:void(0);" onclick="'.$fuc_load.'('.$tpages.');">'.$tpages.'</a></li>';
	}

	// next
	if($page<$tpages) {
		$out .= '<li class="page-item"><a class="page-link" href="javascript:void(0);"" onclick="'.$fuc_load.'('.($page+1).');">'.$nextlabel.'</a></li>';
	}else {
		$out .= '<li class="page-item disabled"><a class="page-link">'.$nextlabel.'</a></li>';
	}
	
	$out .= '</ul></nav>';
	return $out;
}

function timeago($date){
	if(empty($date)) {
		return "Fecha no proporcionada.";
	}
	
	$periods 	= array("seg", "min", "hora", "día", "semana", "mes", "año", "decada");
	$lengths 	= array("60","60","24","7","4.35","12","10");
	$now 		= time();
	$unix_date 	= strtotime($date);
	
	   // check validity of date
	if(empty($unix_date)) {    
		return "Error en la fecha";
	}

	// is it future date or past date
	if($now > $unix_date) {    
		$difference     = $now - $unix_date;
		$tense         = "hace";
		
	} else {
		$difference     = $unix_date - $now;
		$tense         = "justo ahora";
	}
	
	for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
		$difference /= $lengths[$j];
	}
	
	$difference = round($difference);
	
	if($difference != 1) {
		if ($periods[$j]=="mes") {
			$periods[$j].= "es";
		}else{
			$periods[$j].= "s";
		}
	}
	
	return "{$tense} $difference $periods[$j]";
}


function mesDiaAnio($fecha){
	$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
	$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
	return $meses[date("n", strtotime($fecha))-1]." ".date("d", strtotime($fecha)). ", ".date(date("Y", strtotime($fecha))) ;
}