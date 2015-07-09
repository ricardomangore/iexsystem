<?php

/**
 * iex_oag_webservice_menu()
 * 
 * Crea las entradas de menú para configurar el Web Service de OAG
 */
add_action('admin_menu','iex_oag_account_menu');
function iex_oag_account_menu(){
	add_menu_page('IEX System', 'IEX System', 'manage_options', __FILE__, 'iex_system_settings_page');
}

/**
 * iex_oag_ws_settings_page()
 * 
 * Crea la página de configuración de parametros de la cuenta de OAG 
 */
function iex_system_settings_page(){
	?>
		<div class="wrap">
			<?php screen_icon(); ?>
			<h2>IEX System</h2>	
			<form action="options.php" method="post">
				
				<?php
					//Carga los valores del arreglo iex_oag_account instanciado en el script install.php
				    settings_fields('iex_oag_account');
					//settings_fields('iex_fleetmon_options');
					
					//Carga la secciones registradas a nombre de 'iex_settings_page' 
					do_settings_sections('iex_system_settings_page');
				?>
				
				<input type="submit" type="submit" value="Save Changes" />
			</form>	
		</div>
	<?php
}

/**
 * iex_oag_account_init()
 * 
 * Configura la página de OAG Settings
 * Registra las opciones de configuración de la página de OAG account
 * Agrega las secciones de la página
 * Agrega los campos de la página 
 */
add_action('admin_init', 'iex_system_init');
function iex_system_init(){
	//registramos una configuración                       
	register_setting('iex_oag_account','iex_oag_account','iex_oag_account_clean');
	/*register_setting('iex_fleetmon_options','iex_fleetmon_options','iex_fleetmon_clean');*/
	
	//Agrega una sección OAG Account a la página
	add_settings_section('iex_oag_account_section','OAG Account','iex_oag_account_section_text','iex_system_settings_page');
	//Agrega la sección de Fleetmon a la página
	/*add_settings_section('iex_fleetmon_account_section','FleetMon Account','iex_fleetmon_account_section_text', 'iex_system_settings_page');*/
	
	$options = get_option('iex_oag_account');
	$options_fleetmon = get_option('iex_fleetmon_options');
	//Se agregan los campos de la página
	add_settings_field('iex_oag_wsdl', 'WSDL', 'iex_create_input_text','iex_system_settings_page','iex_oag_account_section',array(
		'id'	=> 'iex_oag_wsdl',
		'name'  => 'iex_oag_account[wsdl]',
		'param' => $options['wsdl']
	));
	add_settings_field('iex_oag_username', 'User Name', 'iex_create_input_text', 'iex_system_settings_page', 'iex_oag_account_section',array(
		'id'    => 'iex_oag_username',
		'name'  => 'iex_oag_account[username]',
		'param' => $options['username']
	));
	add_settings_field('iex_oag_password', 'Password', 'iex_create_input_password', 'iex_system_settings_page', 'iex_oag_account_section',array(
		'id'    => 'iex_oag_password',
		'name'  => 'iex_oag_account[password]',
		'param' => $options['password']
	));
	/*add_settings_field('iex_fleetmon_vessel_url', 'URL Vessel', 'iex_create_input_text', 'iex_system_settings_page','iex_fleetmon_account_section',array(
		'id'	=> 'iex_fleetmon_vessel_url',
		'name'  => 'iex_fleetmon_options[json_vessel_url]',
		'param' => $options_fleetmon['json_vessel_url']
	));
	add_settings_field('iex_fleetmon_port_url', 'URL Port', 'iex_create_input_text', 'iex_system_settings_page','iex_fleetmon_account_section',array(
		'id'	=> 'iex_fleetmon_port_url',
		'name'  => 'iex_fleetmon_options[json_port_url]',
		'param' => $options_fleetmon['json_port_url']	
	));*/
}


 /**
 * iex_oag_account_text()
 * 
 * Crea el texto que esta debajo del encabezado de la página OAG Settings Account
 */
function iex_oag_account_section_text(){
	echo '<p>OAG Account parameters</p>';
}

/**
 * iex_oag_account_text()
 * 
 * Crea el texto que esta debajo del encabezado de la página OAG Settings Account
 */
function iex_fleetmon_account_section_text(){
	echo '<p>FleetMon Account parameters</p>';
}

 
 /**
  * iex_oag_username_input( $args )
  *
  * Crea el campo input para el parametro username
  */
 function iex_oag_username_input( $args ){
 	$option = get_option('iex_oag_account');
	echo "<input type='text' id='iex_oag_username' name='iex_oag_account[username]' value='{$option['username']}' />";
 }
 
 /**
  * iex_oag_password_input( $args ) 
  *
  * Crea el campo input para el parametro password
  */
 function iex_oag_password_input( $args ){
 	$option = get_option('iex_oag_account');
	echo "<input type='password' id='iex_oag_password' name='iex_oag_account[password]' value='{$option['password']}' />";
 }
 
 /**
  * iex_oag_wsdl_input()
  * Crea el campo input para el parametro WSDL 
  */
  function iex_oag_wsdl_input( $args ){
  	$option = get_option('iex_oag_account');
	echo "<input type='text' id='iex_oag_wsdl' name='iex_oag_account[wsdl]' value='{$option['wsdl']}' />";
  }
  
  /**
  * iex_fleetmon_vessel_url_input( $args ) 
  *
  * Crea el campo input para el parametro password
  */
 function iex_fleetmon_vessel_url_input( $args ){
 	$option = get_option('iex_fleetmon_options');
	echo "<input type='text' id='iex_fleetmon_vessel_url' name='iex_fleetmon_options[json_vessel_url]' value='{$option['json_vessel_url']}' />";
 }
 
 /**
  * iex_fleetmon_port_url_input()
  * 
  * Crea el campo input para el parametro WSDL 
  */
  function iex_fleetmon_port_url_input( $args ){
  	$option = get_option('iex_fleetmon_options');
	echo "<input type='text' id='iex_fleetmon_port_url' name='iex_fleetmon_options[json_port_url]' value='{$option['json_port_url']}' />";
  } 

  
/**
 * Función de validación de opciones personalziadas
 */
function iex_oag_account_clean( $option ){
	return $option;
}

function iex_fleetmon_clean( $option ){
	return $option;
}










