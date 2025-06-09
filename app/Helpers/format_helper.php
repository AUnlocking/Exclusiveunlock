<?php
function mesDiaAnio($fecha){
	$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
	$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
	return $meses[date("n", strtotime($fecha))-1]." ".date("d", strtotime($fecha)). ", ".date(date("Y", strtotime($fecha))) ;
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

function get_words($sentence, $count = 10) {
	preg_match("/(?:[^\s,\.;\?\!]+(?:[\s,\.;\?\!]+|$)){0,$count}/", $sentence, $matches);
	return $matches[0];
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