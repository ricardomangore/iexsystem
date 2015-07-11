<?php


/**
 * iex_get_direct_flights()
 * 
 * Obtiene los vuelos directos 
 */
function iex_get_direct_flights(){
	$oag_account_opt       = get_option('iex_oag_account');
	$direct_flight_opt     = get_option('iex_direct_flight');
	$connection_flight_opt = get_option('iex_connections_flight'); 
    
	$oagAccount   = new OagAccount($oag_account_opt);
	
	$directFlight = new DirectFlight($direct_flight_opt);
	$directFlight->setOriginCriteria('CHI');
	$directFlight->setDestinationCriteria('LON');
	$directFlight->setRequestDate('2015-07-10');
	
	$connectionFlight = new ConnectionFlight($connection_flight_opt);
	$connectionFlight->setOriginCriteria('CHI');
	$connectionFlight->setDestinationCriteria('LON');
	$connectionFlight->setRequestDate('2015-07-10');	
	
	
	$oagSoapClient = new OAGSoapClient($oagAccount);
	
	header('Content-Type: application/json');
	echo json_encode($oagSoapClient->searchConnectionFlights( $connectionFlight ));
	exit;
 
}

add_action( 'wp_ajax_iex_get_direct_flights', 'iex_get_direct_flights' );
add_action( 'wp_ajax_nopriv_iex_get_direct_flights', 'iex_get_direct_flights' );



/**
 * iex_get_connections_flights()
 * 
 * Obtiene los vuelos con conexion  
 */
 function iex_get_connection_flights(){
 	header('Content-Type: application/json');
	echo json_encode(array('nombre' => 'ricardo'));
	exit;
 }
 add_action('wp_ajax_iex_get_connections_flights', 'iex_get_connection_flights');
 add_action('wp_ajax_nopriv_iex_get_connections_flights', 'iex_get_connection_flights');
