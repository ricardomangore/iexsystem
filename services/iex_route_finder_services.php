<?php

add_action('wp_ajax_get_routes_by_port','iex_get_route_by_port');
add_action('wp_ajax_nopriv_get_routes_by_port','iex_get_route_by_port');
function iex_get_route_by_port(){
		
	global $wpdb;
	$wpdb->show_errors();
	
	$rutas = array();
	
	$port = $_GET['iex_select_port'];
	
	$sql_str = "SELECT DISTINCT sr.voyage_code as viaje, ve.name as buque
				FROM iex_sea_route as sr 
	            LEFT JOIN iex_vessel as ve ON ve.id_vessel = sr.id_vessel
	            LEFT JOIN iex_port as po ON po.id_port = sr.id_port
	            WHERE sr.id_port = %d AND sr.eta > '2015-04-01'";
				/*"SELECT sr.id_sea_route id, sr.voyage_code as viaje, ve.name as buque, po.name as puerto,  sr.eta 
				FROM iex_sea_route as sr 
	            LEFT JOIN iex_vessel as ve ON ve.id_vessel = sr.id_vessel
	            LEFT JOIN iex_port as po ON po.id_port = sr.id_port
	            WHERE sr.id_port = %d";*/
						
	$sql_prepare = $wpdb->prepare($sql_str,$port);
	$sql_response = $wpdb->get_results($sql_prepare);
	if($sql_response == null || empty($sql_response)){//Consulta regreso Sin exito
		header('Content-type: application/json');
		echo json_encode(array('error' => 'No se encontraron resultados'));		
	}else{//Consulta regreso con Exito
		foreach($sql_response as $value){
			$ruta = array(
				'viaje' => $value->viaje,
				'buque' => $value->buque,
				'puertos' => array()
			);
			$sql_str_ports = "SELECT po.name as puerto,  sr.eta 
				FROM iex_sea_route as sr 
	            LEFT JOIN iex_vessel as ve ON ve.id_vessel = sr.id_vessel
	            LEFT JOIN iex_port as po ON po.id_port = sr.id_port
	            WHERE sr.voyage_code = %s AND sr.eta > '2015-03-01' ORDER BY sr.eta ASC";
	        $sql_prepare_ports = $wpdb->prepare($sql_str_ports,$value->viaje);
			$sql_response_ports = $wpdb->get_results($sql_prepare_ports,ARRAY_A);
			foreach($sql_response_ports as $value_port){
				array_push($ruta['puertos'],$value_port);
			}
				
			array_push($rutas, $ruta);
		}
	
	    
		header('Content-type: application/json');
		echo json_encode($rutas);	
	}
	exit;
}