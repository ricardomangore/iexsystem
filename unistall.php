<?php

//Si Unistall no fue llamad adesde la opción de Wordpress
if( !defined( 'WP_UNISTALL_PLUGIN' ))
	exit ();
global $wpdb;
$wpdb->query( "DROP TABLE IF EXISTS iex_iata_code, iex_route_negotiated, iex_route, iex_vessel, iex_port, iex_shipping, iex_country" );
//Elimina las opciones la tabla de opciones (preestablecida en wordpress)
delete_option( IEX_SLUG );

//Elimina otras opciones personalizadas del plugin