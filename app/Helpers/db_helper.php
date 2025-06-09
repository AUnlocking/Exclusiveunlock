<?php
/*
 *	Obteniendo # de comentarios por tema
 */
function replyCount($topic_id){
	$db = new Database;
	$db->query('SELECT * FROM comentarios WHERE id_tema = :topic_id AND comentarios.eliminado=0');
	$db->bind(':topic_id', $topic_id);
	// Asignando filas
	$rows = $db->resultset();
	// Regresando el total del conteo
	return $db->rowCount();
}

/*
* Obteniendo todos los temas
*/
function getAllTopics(){
	$db = new Database;
	$db->query('SELECT temas.*, usuarios.username, usuarios.avatar, categorias.nom_cat FROM temas
				INNER JOIN usuarios
				ON temas.id_user = usuarios.id_user
				INNER JOIN categorias
				ON temas.id_cat = categorias.id_cat
				WHERE temas.eliminado=0 and categorias.eliminado=0
				ORDER BY fecha_creado DESC
	');

	// Asignando variables
	$rows = $db->resultset();
	// Retorna el conteo total
	return $db->rowCount();
}

/*
 *	Obteniendo categorías
 */
function getCategories(){
	$db = new Database;
	$db->query('SELECT * FROM categorias where eliminado=0');

	// Asignando el resultset
	$results = $db->resultSet();
	return $results;
}

function obtCampoProcedure($nom_procedure, $campo){
	$db = new Database;
	$db->query($nom_procedure);
	$rows = $db->resultset();
	$total = 0;
	foreach ($rows as $val){
		$total = $val->$campo;
	}
	return $total;
}

function obtTotalProcedurePanel($nom_procedure, $campo, $id_usuario){
	$db = new Database;
	$db->query($nom_procedure);
	//$db->bind(':id_usuario', $id_usuario);
	$rows = $db->resultset();
	$total = 0;
	foreach ($rows as $val){
		$total = $val->$campo;
	}
	return $total;
}

function getTypeQuestions(){
	$db = new Database;
	$db->query('SELECT * FROM fr_tipo_preguntas');
	// Asignando el resultset
	$results = $db->resultSet();
	return $results;
}


/**
 * 	Temas de los usuarios
 */
function userPostCount($user_id){
	$db = new Database;
	$db->query('SELECT * FROM temas WHERE id_user = :user_id AND temas.eliminado=0');
	$db->bind(':user_id', $user_id);
	// Asignando filas
	$rows = $db->resultset();
	// Obteniendo total de conteo
	$topic_count = $db->rowCount();

	$db->query('SELECT * FROM comentarios WHERE id_user = :user_id AND comentarios.eliminado=0');
	$db->bind(':user_id', $user_id);
	// Asignando filas
	$rows = $db->resultset();
	// Obteniendo toal de conteo
	$reply_count = $db->rowCount();
	return $topic_count + $reply_count;
}

/**
 * 	Temas de los usuarios
 */
function totalPostPorCat($id_cat){
	$db = new Database;
	$db->query('SELECT * FROM temas WHERE id_cat = :id_cat AND temas.eliminado=0');
	$db->bind(':id_cat', $id_cat);
	// Asignando filas
	$filas = $db->resultset();
	// Obteniendo total de conteo
	$total_temas = $db->rowCount();

	return $total_temas;
}

function count_visit_topic($consulta){
	$db = new Database;
	$db->query($consulta);
	// Asignando filas
	$filas = $db->resultset();
	// Obteniendo total de conteo
	$total_temas = $db->rowCount();
	return $total_temas;
}


/*function obt_info_count_visit($limit){
	$db = new Database;
	$db->query("SELECT * FROM count_topic_visit ORDER BY id_visit DESC LIMIT $limit");
	// Asignando los resultados al arreglo
	$results = $db->resultset();
	return $results;
}*/

function obt_info_count_visit($consulta){
	$db = new Database;
	$db->query($consulta);
	// Asignando los resultados al arreglo
	$results = $db->resultset();
	return $results;
}

function eje_proc_sigle($nombre_procedimiento){
	$db = new Database;
	$db->query($nombre_procedimiento);
	$results = $db->resultset();
	$db = null;
	return $results;
}
function eje_proc_resulset($nombre_procedimiento){
	$db = new Database;
	$db->query($nombre_procedimiento);
	$results = $db->resultset();
	$db = null;
	return $results;
}

function fecha_es_mexico($fecha){
	$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
	$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
	echo $dias[date("w", strtotime($fecha))]." ".date("d", strtotime($fecha))." de ".$meses[date("n", strtotime($fecha))-1]. " de ".date(date("Y", strtotime($fecha))) ;
}

function mostrar_fecha_nac($fecha){
	$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
	$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
	echo date("d", strtotime($fecha))."/".$meses[date("n", strtotime($fecha))-1]. "/".date(date("Y", strtotime($fecha))) ;
}

function bd_addlog($data){
	$db = new Database;
	$db->query("CALL bd_addlog(:table_log, :action_log, :ip_log, :from_log, :id_usuario);");
	$db->bind(':table_log', 	$data['table_log']);
	$db->bind(':action_log', 	$data['action_log']);
	$db->bind(':from_log', 		$data['from_log']);
	$db->bind(':ip_log', 		$data['ip_log']);
	$db->bind(':id_usuario', 	$data['id_usuario']);
	if($db->execute()){
		$db = null;
		return true;
	}else{
		$db = null;
		return false;
	}
}