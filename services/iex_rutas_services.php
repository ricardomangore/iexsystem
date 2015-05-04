<?php

add_action('wp_ajax_add_ruta', 'iex_add_ruta_service');
function iex_add_ruta_service(){
	global $wpdb;
	
	$buque = array();
	
	$id_naviera = $_GET['select_naviera'];
	$id_buque = $_GET['select_buque'];
	$id_puerto = $_GET['select_puerto'];
	$eta = date('Y-m-d',strtotime($_GET['eta']));
	$viaje = $_GET['viaje'];
	$tipo_ruta = $_GET['select_tipo_ruta'];
	$chk_ruta_iex = isset($_GET['chk_ruta_intemrodal'])?$_GET['chk_ruta_intemrodal']:0;
	$nombre_ruta_iex = $_GET['nombre_ruta_intermodal'];
	
	if(isset($_GET['chk_ruta_intermodal'])){
		if($_GET['chk_ruta_intermodal']=='on')
			$chk_ruta_iex = TRUE;
	}else{
		$chk_ruta_iex = FALSE;
	}
	
	$iex_route = array(
	    'id_port'     => $id_puerto,
		'id_vessel'    => $id_buque,
		'voyage_code' => $viaje,
		'eta'         => $eta,
		'type'        => $tipo_ruta,
		'route_negotiated' => $chk_ruta_iex,
		'iex_route_name' => $chk_ruta_iex? $nombre_ruta_iex: ""
	);
	
	//$iex_route['route_negotiated'] = true;
    //$iex_route['iex_route_name']  = $nombre_ruta_iex;
	
	$sql_route = "SELECT * FROM iex_sea_route WHERE id_port = %d AND id_vessel = %d AND eta = %s";
	$sql_route_prepare = $wpdb->prepare($sql_route, $iex_route['id_port'], $iex_route['id_vessel'], $iex_route['eta']);
	$result_route_query = $wpdb->get_results($sql_route_prepare);
	if($result_route_query == null || empty($result_route_query)){//No existe ruta
		$wpdb->insert('iex_sea_route', $iex_route, array('%d', '%d', '%s', '%s', '%s', '%d', '%s'));
		$id_route = $wpdb->insert_id;
		$query_str = "SELECT r.id_sea_route as id, v.name as buque, r.voyage_code as viaje, p.name as puerto, r.eta as eta, s.name as naviera, r.type as tipo, r.iex_route_name as ruta_intermodal 
					  FROM iex_sea_route as r, iex_port as p, iex_vessel as v, iex_shipping as s WHERE r.id_port = p.id_port AND r.id_vessel = v.id_vessel AND v.id_shipping = s.id_shipping AND r.id_sea_route = $id_route";
		$response= $wpdb->get_results($query_str,ARRAY_A);
		header('Content-type: application/json');
		echo json_encode($response);
		exit;
	}else{//La ruta ya existe
		header('Content-type: application/json');
		echo json_encode(array('error' => 'Error: La Ruta ya existe'));
		exit;
	}
}

add_action('wp_ajax_get_all_rutas', 'iex_get_all_rutas');
function iex_get_all_rutas(){
	global $wpdb;

	$query_str = "SELECT r.id_sea_route as id, v.name as buque, r.voyage_code as viaje, p.name as puerto, r.eta as eta, s.name as naviera, r.type as tipo, r.iex_route_name as ruta_intermodal 
				  FROM iex_sea_route as r, iex_port as p, iex_vessel as v, iex_shipping as s WHERE r.id_port = p.id_port AND r.id_vessel = v.id_vessel AND v.id_shipping = s.id_shipping";
	$response= $wpdb->get_results($query_str,ARRAY_N);
	header('Content-type: application/json');
	echo json_encode($response);
	exit;
	
}

add_action('wp_ajax_get_vessel_by_port','iex_get_vessel_by_port');
function iex_get_vessel_by_port(){
	
	global $wpdb;
	
	$puerto = $_GET['iex_select_port'];
	
	$sql_str = "";
	
	$response = array('message' => 'respondiendo: iex_get_vessel_by_port');
    header('Content-type: application/json');
	echo json_encode($response);
	exit;
}
