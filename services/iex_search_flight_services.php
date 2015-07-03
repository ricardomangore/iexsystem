<?php


/**
 * iex_get_direct_flights()
 * 
 * Obtiene los vuelos directos 
 */
function iex_get_direct_flights(){
    $obj_soap = new OAGSoapClient(array(
		'wsdl' => 'sdfsd',
		'username' => 'asdf',
		'password' => 'asdfffff'
	));	
	$account = get_option('iex_oag_account');
	header('Content-Type: application/json');
	echo json_encode(array('nombre' => $obj_soap->getUserName(), 'wsdl' => $obj_soap->getPassword(), 'password' => $obj_soap->getWSDL()));
	exit;
}

add_action( 'wp_ajax_iex_get_direct_flights', 'iex_get_direct_flights' );
add_action( 'wp_ajax_nopriv_iex_get_direct_flights', 'iex_get_direct_flights' );



/**
 * iex_get_connections_flights()
 * 
 * Obtiene los vuelos con conexion  
 */
 function iex_get_connections_flights(){
 	header('Content-Type: application/json');
	echo json_encode(array('nombre' => 'ricardo'));
	exit;
 }
 add_action('wp_ajax_iex_get_connections_flights', 'iex_get_connections_flights');
 add_action('wp_ajax_nopriv_iex_get_connections_flights', 'iex_get_connections_flights');
