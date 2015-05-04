<?php

add_action('wp_ajax_get_puerto', 'iex_get_puerto');
add_action('wp_ajax_nopriv__get_puerto', 'iex_get_puerto');
function iex_get_puerto(){
	
	$puerto = $_GET['q'];
	$text = file_get_contents('http://www.fleetmon.com/api/p/personal-v1/porturl/?username=ricardomangore&api_key=3f8e8c95ad19d29d5c4f31a81c0a2b7b807b01dd&format=json&q='.$puerto);
	$data_array = json_decode($text);
	$data_array_filtered = $data_array->objects; 


	header('Content-type: application/json');
	echo json_encode($data_array_filtered);
	exit;
}

/**
 * 
 */
add_action('wp_ajax_get_puertodb', 'iex_get_puertodb');
add_action('wp_ajax_nopriv_get_puertodb', 'iex_get_puertodb');
function iex_get_puertodb(){
	global $wpdb;
	
	
	$puerto = $_GET['q'];
	
	$sql_puerto = "SELECT p.id_port, c.country_isocode, c.country_name, p.locode, p.name FROM iex_port as p, iex_country as c WHERE p.id_country = c.id_country AND p.name LIKE '". $puerto ."%' ";
	$result_puerto_query = $wpdb->get_results($sql_puerto, ARRAY_A);
	header('Content-type: application/json');
	echo json_encode($result_puerto_query);
	exit;
}

add_action('wp_ajax_get_all_puertos', 'iex_get_all_puertos');
add_action('wp_ajax_nopriv__get_all_puertos', 'iex_get_all_puertos');
function iex_get_all_puertos(){
	global $wpdb;
	
	$query = "SELECT p.id_port as id, p.locode as locode, p.name as puerto, c.country_isocode as isocode, c.country_name as pais FROM `iex_port` as p, iex_country as c WHERE c.id_country = p.id_country";
	$select_result = $wpdb->get_results($query, ARRAY_N);
	$data = array(
			'draw' => 1,
			'recordsTotal' => 6,
			'recordsFiltered' => 6,
			'data' => $select_result
	);
	header('Content-type: application/json');
	if($select_result){
		echo json_encode($select_result);
	}else{
		echo json_encode(array('error' => 'Error: no se obtuvieron registros de puertos'));
	}
	exit;	
}


/**
 * 
 */
add_action('wp_ajax_add_puerto', 'iex_add_puerto');
function iex_add_puerto(){
	global $wpdb;
	
	$puerto = array();
	
	$value_puerto = $_GET['valuePuerto'];
	$array_puerto = split("_", $value_puerto);
	
	
	$iex_country = array(
	 	'id_country'      => '',
		'country_isocode' => $array_puerto[1],
		'country_name'    => $array_puerto[2]
	);
		
	$iex_port =array(
		'id_country'      => '',
		'locode'          => $array_puerto[0] == "null"? "" : $array_puerto[0],
		'name'            => $array_puerto[3]
	);	
	
				
	//Inicia Transacción en la Base de Datos
	$wpdb->query("START TRANSACTION");
		//Verifica si existe la ciudad en iex_country
		$sql_country = "SELECT * FROM iex_country WHERE country_isocode = %s AND country_name = %s";
		$sql_country_prepare = $wpdb->prepare($sql_country, $iex_country['country_isocode'],$iex_country['country_name']);
		$result_country_query = $wpdb->get_results($sql_country_prepare);
		if($result_country_query == null || empty($result_country_query)){//No existe ciudad
			$response_country = $wpdb->insert('iex_country', $iex_country,array('%s','%s'));
			$iex_country['id_country'] = $wpdb->insert_id;
			$iex_port['id_country'] =  $wpdb->insert_id;
		}else{//Sí existe ciudad
			$iex_country['id_country'] = $result_country_query[0]->id_country;
			$iex_port['id_country'] =  $result_country_query[0]->id_country;
			$response_country = true;
		}
		//Verifica si existe al puerto en iex_port
		$sql_port = "SELECT * FROM iex_port WHERE locode = %s AND name = %s";
		$sql_port_prepare = $wpdb->prepare($sql_port, $iex_port['locode'], $iex_port['name']);		
		$result_port_query = $wpdb->get_results($sql_port_prepare);
		if($result_port_query == null || empty($result_port_query)){//No existe puerto
			$response_port = $wpdb->insert('iex_port', $iex_port, array('%d','%s','%s'));
			$response_id = $wpdb->insert_id;
		}else{//Sí existe puerto
			$response_port = false;
		}
		
		if($response_country && $response_port){
			$wpdb->query('COMMIT');
			$retorno = array(
				'id' 	  => $response_id,
				'locode'  => $iex_port['locode'],				
				'puerto'  => $iex_port['name'],
				'isocode' => $iex_country['country_isocode'],
				'ciudad'  => $iex_country['country_name']
			);	
		}else{
			$wpdb->query('ROLLBACK');
			$retorno = array(
				'error' => 'El puerto ya existe'
			);			
		}
		
		header("Constent-type: application/json");
		echo json_encode($retorno);
		exit;
}
