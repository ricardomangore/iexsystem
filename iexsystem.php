<?php
/**
 * Plugin Name: Intermodal Express System Plugin
 * Description: Plugin con funcionalidades específicas de Intermodal Express 
 * Version: 1.0
 * License: GPLv2
 * Author: Ricardo Rincón de la Torre <ricardomangore@gmail.com>
 */

 
 
//Path base de la instalación de wordress 
if(!defined('ABSPATH')){
	header('HTTP/1.0 403 Forbidden');
	exit;
}

//Código para ver la versión de Wordpress 
//echo get_bloginfo('version');



//Define contastantes

/*Define el nombre base del archivo del Plugin*/             define('IEX_FILE_NAME', basename(__FILE__));
/*Define el path del sistema para el archivo del Plugin*/    define('IEX_FILE_PATH', __FILE__);
/*Define el directorio del Plugin*/                          define('IEX_DIR_PATH', dirname(__FILE__));
/*Define la URL hacia el directorio del Plugin*/             define('IEX_URL', plugins_url('',__FILE__));
/*Define un SLug para el Plugin*/                            define('IEX_SLUG', basename(dirname(__FILE__)));
/*Define el path relativo del Plugin*/                       define('IEX_RELATIVE_PATH', plugin_basename(__FILE__)); 

//Incluye los archivos del Plugin
require IEX_DIR_PATH . '/install/install.php';
//require IEX_DIR_PATH . '/adminpages/admin-page.php';iex_oag_webservice_settings.php
require IEX_DIR_PATH . '/classes/OagAccount.php';
require IEX_DIR_PATH . '/classes/DirectFlight.php';
require IEX_DIR_PATH . '/classes/ConnectionFlight.php';
require IEX_DIR_PATH . '/classes/OAGSoapClient.php';
require IEX_DIR_PATH . '/adminpages/iex_system_settings_fields.php';
require IEX_DIR_PATH . '/adminpages/iex_system_settings.php';
require IEX_DIR_PATH . '/adminpages/iex_oag_direct_flight_settings.php';
require IEX_DIR_PATH . '/adminpages/iex_oag_connection_flight_settings.php';
require IEX_DIR_PATH . '/services/iex_navieras_services.php';
require IEX_DIR_PATH . '/services/iex_buques_services.php';
require IEX_DIR_PATH . '/services/iex_puertos_services.php';
require IEX_DIR_PATH . '/services/iex_rutas_services.php';
require IEX_DIR_PATH . '/services/iex_cotizador_services.php';
require IEX_DIR_PATH . '/services/iex_route_finder_services.php';
require IEX_DIR_PATH . '/services/iex_search_flight_services.php';
require IEX_DIR_PATH . '/pages/iex_pages.php';



