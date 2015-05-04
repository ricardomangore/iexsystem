<?php

add_action('wp_ajax_get_routes_by_port','iex_get_route_by_port');
add_action('wp_ajax_nopriv_get_routes_by_port','iex_get_route_by_port');
function iex_get_route_by_port(){
		
	global $wpdb;
	$wpdb->show_errors();
	
	$port = $_GET['iex_select_port'];
	
	$sql_str = "SELECT sr.id_sea_route id, sr.voyage_code as viaje, ve.name as buque, po.name as puerto,  sr.eta 
				FROM iex_sea_route as sr 
	            LEFT JOIN iex_vessel as ve ON ve.id_vessel = sr.id_vessel
	            LEFT JOIN iex_port as po ON po.id_port = sr.id_port
	            WHERE sr.id_port = %d";
						
	$sql_prepare = $wpdb->prepare($sql_str,$port);
	$sql_response = $wpdb->get_results($sql_prepare);
	if($sql_response == null || empty($sql_response)){//Consulta regreso Sin exito
		header('Content-type: application/json');
		echo json_encode(array('error' => 'No se encontraron resultados'));		
	}else{//Consulta regreso con Exito
		header('Content-type: application/json');
		echo json_encode($sql_response);	
	}
	exit;
}