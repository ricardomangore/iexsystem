<?php

/**
 * 
 */
 add_action('wp_ajax_get_all_buques', 'iex_get_all_buques_service');
function iex_get_all_buques_service(){
	global $wpdb;
	
	$query = "SELECT v.id_vessel as id, v.name as buque, v.alias as alias, v.type as tipo, s.name as naviera, v.flag as bandera, v.mmsi as mmsi, v.imo as imo FROM `iex_vessel` as v, iex_shipping as s WHERE v.id_shipping = s.id_shipping";
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
		echo json_encode(array('error' => 'Error: no se obtuvieron registros de buques'));
	}
	exit;
}

/**
 * 
 */
add_action('wp_ajax_get_buque', 'iex_get_buque');
function iex_get_buque(){
	
	$buque = $_GET['q'];
	$text = file_get_contents('http://www.fleetmon.com/api/p/personal-v1/vesselurl/?username=ricardomangore&api_key=3f8e8c95ad19d29d5c4f31a81c0a2b7b807b01dd&format=json&q='.$buque);
	$data_array = json_decode($text);
	$data_array_filtered = $data_array->objects; 
	
	//[{"flag":"LR|Liberia","imo":9400083,"mmsi":636014209,"name":"MAIPO","publicurl":"\/\/www.fleetmon.com\/en\/vessels\/Maipo_2071630","type":"Container ship"},{"flag":"HK|Hong Kong SAR of China","imo":9379935,"mmsi":477197600,"name":"MAIPO RIVER","publicurl":"\/\/www.fleetmon.com\/en\/vessels\/Maipo_River_69536","type":"Bulk carrier"}]

	header('Content-type: application/json');
	echo json_encode($data_array_filtered);
	exit;
}

/**
 * 
 */
add_action('wp_ajax_get_buquedb', 'iex_get_buquedb');
function iex_get_buquedb(){
	global $wpdb;
	
	
	$buque = $_GET['q'];
	$id_naviera = $_GET['id_naviera'];
	
	$sql_buque = "SELECT * FROM iex_vessel WHERE id_shipping = $id_naviera AND name LIKE '". $buque ."%' ";
	$result_buque_query = $wpdb->get_results($sql_buque, ARRAY_A);
	header('Content-type: application/json');
	echo json_encode($result_buque_query);
	exit;
}



/**
 * 
 */
 add_action('wp_ajax_add_buque', 'iex_add_buque');
 function iex_add_buque(){
 	global $wpdb;
	
	$buque = array();
	
	$value_buque = $_GET['select_buque'];//'9362542_247229700_IT|Italy_AIDABELLA_Cargo ship';
	$buque_alias = (string) $_GET['alias_buque'];
	$value_naviera  = (string) $_GET['select_naviera'];
	
	$array_buque = split("_", $value_buque);
	$array_naviera = split("_", $value_naviera);
	$iex_vessel = array(
		'id_shipping' =>$array_naviera[0],
		'mmsi'  => $array_buque[1] == "null"? "" : $array_buque[1],
		'imo'  => $array_buque[0] == "null"? "" : $array_buque[0],
		'flag' => $array_buque[2],
		'name' => $array_buque[3],
		'alias'=> $buque_alias,
		'type' => $array_buque[4]
	);
	
	//Verifica si existe buque en iex_vessel
	$sql_vessel = "SELECT * FROM iex_vessel WHERE mmsi = %d AND flag = %s AND name = %s AND type = %s";
	$sql_vessel_prepare = $wpdb->prepare($sql_vessel, $iex_vessel['mmsi'], $iex_vessel['flag'], $iex_vessel['name'],$iex_vessel['type']);
	$result_vessel_query = $wpdb->get_results($sql_vessel_prepare);
	if($result_vessel_query == null || empty($result_vessel_query) ){//No existe buque
		$response_vessel = $wpdb->insert('iex_vessel', $iex_vessel, array('%d','%d','%d','%s','%s', '%s','%s'));
		$response = array(
				'id'       => $wpdb->insert_id,
				'buque'    => $iex_vessel['name'],
				'alias'    => $buque_alias,
				'tipo'     => $iex_vessel['type'],
				'naviera'  => $array_naviera[1],
				'bandera'  => $iex_vessel['flag'],
				'mmsi'     => $iex_vessel['mmsi'],
				'imo'      => $iex_vessel['imo'],
			);	
	}else{//Sí existe buque
			$response = array(
				'error' => 'El buque ya existe'
			);
	}
	header("Constent-type: application/json");
	echo json_encode($response);
	exit;
 }
