<?php


/**
 * iex_get_direct_flights()
 * 
 * Obtiene los vuelos directos 
 */
function iex_get_direct_flights(){
	$oag_account_opt   = get_option('iex_oag_account');
	$direct_flight_opt = get_option('iex_direct_flight');

	$oagAccount   = new OagAccount($oag_account_opt);
	$directFlight = new DirectFlight($direct_flight_opt);
	$directFlight->setOriginCriteria('CHI');
	$directFlight->setDestinationCriteria('LON');
	$directFlight->setRequestDate('2015-07-09');
	$oagSoapClient = new OAGSoapClient($oagAccount);

	/*try{
		$oagSoapClient->searchDirectFlights($directFlight);
		header('Content-Type: application/json');
		exit;
	}catch(Exception $e){
		header('Content-Type: application/json');
		echo json_encode(array('Error' => $e->getMessage()));
		exit;
	}*/
 
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
