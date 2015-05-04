<?php

add_action('wp_ajax_add_naviera','iex_add_naviera_service');


/**
 * iex_add_naviera_service
 * 
 * guarda un registro de naviera en l abase de datos
 */
function iex_add_naviera_service(){

	global $wpdb;
	
	$naviera = $_POST['naviera'];	
	
	header('Content-type: application/json');
	$query = "SELECT * FROM iex_shipping WHERE name = '". $naviera ."'";
	$select_result = $wpdb->query($query);
	if($select_result){
		echo json_encode( array('error' => 'el nombre ya existe'));
	}else{
		$insert_result = $wpdb->insert('iex_shipping', array('name' => $naviera), array('%s'));
		if($insert_result){
			$retorno = array('id'=>$wpdb->insert_id , 'naviera' => $naviera);
			echo json_encode($retorno);
		}else{
			echo json_encode( array('error' => 'Error de Sistema: reportelo al administrador'));
		}
	}	
	 
	exit;
}


/**
 * iex_get_all_navieras_service
 * 
 * Recupera una lista de todas las navieras en la base de datos
 */
add_action('wp_ajax_get_all_navieras', 'iex_get_all_navieras_service');

function iex_get_all_navieras_service(){
	global $wpdb;
	
	$query = "SELECT id_shipping as id, name as naviera FROM iex_shipping";
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
		echo json_encode(array('error' => 'Error: no se obtuvieron registros de navieras'));
	}
	exit;
}


/**
 * iex_get_naviera
 * 
 * Recupera una lista de navieras que coincidan con un patron de busqueda
 */
 
 add_action('wp_ajax_get_naviera', 'iex_get_naviera_service');
 
 function iex_get_naviera_service(){
 	global $wpdb;
	
	$patron_naviera = $_GET['q'];
 	$query = "SELECT id_shipping as id, name as text FROM iex_shipping WHERE name LIKE '%". $patron_naviera ."%'";
	$select_result = $wpdb->get_results($query, ARRAY_A);
	header('Content-type: application/json');
	echo json_encode($select_result);
	exit;
 }








	