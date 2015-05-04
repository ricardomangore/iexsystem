<?php


	
add_action('wp_ajax_procesa_cotizacion','iex_procesa_cotizacion');
add_action('wp_ajax_nopriv_procesa_cotizacion','iex_procesa_cotizacion');
function iex_procesa_cotizacion(){
	
	$cotizacion = array(
		'nombre' => '',
		'apellidos' => '',
		'telefono' => '',
		'mail' => '',
		'servicio' => '',
		'origen' => '',
		'destino' => '',
		'descripcion' => ''
	);
			
	 
	$cotizacion['nombre'] = $_GET['iex_nombre_cotiza'];
	$cotizacion['apellidos'] = $_GET['iex_apellidos_cotiza'];
	$cotizacion['telefono'] = $_GET['iex_tel_cotiza'];
	$cotizacion['mail']  = $_GET['iex_mail_cotiza'];
	$cotizacion['servicio'] = $_GET['iex_service_cotiza'];
	$cotizacion['origen'] = $_GET['iex_origen_cotiza'];
	$cotizacion['destino'] = $_GET['iex_destino_cotiza'];
	$cotizacion['descripcion'] = $_GET['iex_descripcion_cotiza'];


include_once(ABSPATH . 'wp-load.php');

$to = array('ricardomangore@gmail.com');
$headers = 'Reply-to: Ricardo Rincón de la Torre'; 
$subject = 'Asunto de prueba';
$body = 'Mensaje de prueba';

//Filtro para indicar que email debe ser enviado en modo HTML
add_filter('wp_mail_content_type',create_function('', 'return "text/html";'));
 
//Cambiamos el remitente del email que en Wordpress por defecto es tu email de admin
add_filter('wp_mail_from','mqw_email_from');


//$headers = array('Content-Type: text/html; charset=UTF-8');

$result = wp_mail( $to, $subject, $body, $headers );


    header("Constent-type: application/json");
	//echo json_encode($cotizacion);
	echo json_encode(array('result' => ABSPATH));
	exit;
	
}

function mqw_email_from($content_type) {
	  return 'ricardomangore@gmail.com';
	}
