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
switch($cotizacion['servicio']){
	
	case 'sa' : $servicio = 'aéreo';
				break;
	case 'sm' : $servicio = 'marítimo';
				break;
	case 'st' : $servicio = 'terrestre';
				break;
	case 'da' : $servicio = 'despacho aduanal';
				break;
	case 'sc' : $servicio = 'seguro';
				break;
	case 'al' : $servicio = 'almacenage';
				break;

}

$to = array('ricardomangore@gmail.com');
$headers = 'Reply-to: Ricardo Rincón de la Torre'; 
$subject = 'Cotización';
$body = 'Se solicita atender la cotización de ' . $cotizacion['nombre'] . ' ' . $cotizacion['apellidos'] . '<br/>';
$body .= 'teléfono: ' . $cotizacion['telefono'] . '<br/>';
$body .= 'mail: ' . $cotizacion['mail'] . '<br/>';
$body .= 'servicio: ' . $servicio . '<br/>';
$body .= 'origen: ' . $cotizacion['origen'] . '<br/>';
$body .= 'destino: ' . $cotizacion['destino'] . '<br/>';
$body .= 'descripción: ' . $cotizacion['descripcion'] . '<br/>';



$to_client = array($cotizacion['nombre'] . ' ' . $cotizacion['apellidos'] );
$headers_client = 'Reply-to: Intermodal Express'; 
$subject_client = 'Confirmación de Recepción de Cotización';
$body_client = 'Estimado (a)' . $cotizacion['nombre'] . ' ' . $cotizacion['apellidos'] . ': Agradecemos su interés en nuestros servicios de logística.Como especialistas en transportación multimodal, será un placer atender su carga. Un ejecutivo se pondrá en contacto con usted a la brevedad, Saludos cordiales. XXX';
$body_client .= 'teléfono: ' . $cotizacion['telefono'] . '<br/>';
$body_client .= 'teléfono: ' . $cotizacion['mail'] . '<br/>';
$body_client .= 'teléfono: ' . $cotizacion['servicio'] . '<br/>';
$body_client .= 'teléfono: ' . $cotizacion['origen'] . '<br/>';
$body_client .= 'teléfono: ' . $cotizacion['destino'] . '<br/>';
$body_client .= 'teléfono: ' . $cotizacion['descripcion'] . '<br/>';

//Filtro para indicar que email debe ser enviado en modo HTML
add_filter('wp_mail_content_type',create_function('', 'return "text/html";'));
 
//Cambiamos el remitente del email que en Wordpress por defecto es tu email de admin
add_filter('wp_mail_from','mqw_email_from');


//$headers = array('Content-Type: text/html; charset=UTF-8');

$result = wp_mail( $to, $subject, $body, $headers );



$result_client = wp_mail( $to_client, $subject_client, $body_client, $headers_client );

    header("Constent-type: application/json");
	//echo json_encode($cotizacion);
	$cotizacion['servicio'] = $servicio;
	echo json_encode($cotizacion);
	exit;
	
}

function mqw_email_from($content_type) {
	  return 'ricardomangore@gmail.com';
	}
