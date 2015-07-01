<?php

/**
 * iex_add_direct_flight_menu()
 * 
 * Agrega la entrada de menu para OAG Direct Flights
 */
 add_action('admin_menu','iex_add_direct_flight_menu');
 function iex_add_direct_flight_menu(){
 	//Agrega una entrada de submenu para OAG Direct Flights
 	add_submenu_page('iexsystem/adminpages/iex_system_settings.php','Direct Flights Settings','Direct Flights','manage_options',__FILE__,'iex_oag_direct_flight_page');	
	
 }
 
 
 /**
  * iex_oag_direct_flight_page()
  * 
  * Crea la página para ajustar los parametros de busqueda de vuelos directos
  */
 function iex_oag_direct_flight_page(){
	?>
		<div class="wrap">
			<?php screen_icon(); ?>
			<h2>OAG Direct Flights HHH</h2>	
			<form action="options.php" method="post">
				
				<?php
					//Carga los valores del arreglo iex_oag_account instanciado en el script install.php
				    settings_fields('iex_direct_flight');
					
					//Carga la secciones registradas a nombre de 'iex_settings_page' 
					do_settings_sections('iex_oag_direct_flight_page');
				?>
			
				
				<input type="submit" type="submit" value="Save Changes" />
			</form>	
		</div>
	<?php
}
 
 
 
 /**
  * iex_oag_direct_flight_init()
  */
  add_action('admin_init', 'iex_oag_direct_flight_init');
 function iex_oag_direct_flight_init(){
  	//Registra una configuración
  	register_setting('iex_direct_flight','iex_direct_flight','iex_direct_flight_clean');
	
	//Agergamos una sección
	add_settings_section('iex_oag_direct_flight_section','OAG Direct Flights','iex_oag_direct_flight_section_text','iex_oag_direct_flight_page');
	
	//Agrega campos del formulario
	add_settings_field('iex_origen_criteria_location_type','Origen Criteria Type','iex_origen_criteria_location_type_input','iex_oag_direct_flight_page','iex_oag_direct_flight_section');
	add_settings_field('iex_destination_criteria_location_type','Destination Criteria Type','iex_destination_criteria_location_type_input','iex_oag_direct_flight_page','iex_oag_direct_flight_section');
	add_settings_field('iex_request_time','Request Time','iex_request_time_input','iex_oag_direct_flight_page','iex_oag_direct_flight_section');
	add_settings_field('iex_carrier1_criteria','Carrier 1 Criteria','iex_carrier1_criteria_input','iex_oag_direct_flight_page','iex_oag_direct_flight_section');
 }
  
  
/**
 * iex_oag_direct_flight_section_text()
 *  
 * Agerga un texto a la sección de vuelos directos
 */
 function iex_oag_direct_flight_section_text(){
 	echo '<p>OAG Direct Flights Settings</p>';
 }
 
 /**
  * iex_origen_criteria_location_type_input()
  * 
  * Crea un campo de texto para el parametro Origen Criteria Location Type
  */
 function iex_origen_criteria_location_type_input(){
  	$option = get_option('iex_direct_flight');
  	
	if($option['origen_criteria_location_type'] == 'M'){
		$option01 = 'Met Area';
		$option02 = 'Airport';
		$value01  = 'M';
		$value02  = 'A';
	}else{
		$option01 = 'Airport';
		$option02 = 'Met Area';
		$value01  = 'A';
		$value02  = 'M';		
	}
		
	echo "<select id='iex_origen_criteria_location_type_input' name='iex_direct_flight[origen_criteria_location_type]'>
		<option value='$value01'>$option01</option>
		<option value='$value02'>$option02</option>
	    </select>";
  }
  
   /**
  * iex_destination_criteria_location_type_input()
  * 
  * Crea un campo de texto para el parametro Origen Criteria Location Type
  */
 function iex_destination_criteria_location_type_input(){
  	$option = get_option('iex_direct_flight');
  	
	if($option['destination_criteria_location_type'] == 'M'){
		$option01 = 'Met Area';
		$option02 = 'Airport';
		$value01  = 'M';
		$value02  = 'A';
	}else{
		$option01 = 'Airport';
		$option02 = 'Met Area';
		$value01  = 'A';
		$value02  = 'M';		
	}
		
	echo "<select id='destination_criteria_location_type_input' name='iex_direct_flight[destination_criteria_location_type]'>
		<option value='$value01'>$option01</option>
		<option value='$value02'>$option02</option>
	    </select>";
  }

/**
 * iex_request_time_input()
 * 
 * Crea un campo de texto para el parametro Request Time
 */
 function iex_request_time_input(){
 	$option = get_option('iex_direct_flight');
 	echo "<input type='text' id='iex_request_time' name='iex_direct_flight[request_time]' value='{$option['request_time']}' />";
 }
 
/**
 * iex_carrier1_criteria()
 *    
 * Crea un campo de texto para el parametro Carrier 1 Criteria
 */
 function iex_carrier1_criteria_input(){
 	$option = get_option('iex_direct_flight');
 	echo "<input type='text' id='iex_carrier1_criteria' name='iex_direct_flight[carrier1_criteria]' value='{$option['carrier1_criteria']}' />";
 }

/**
 * iex_direct_flight_clean()
 * 
 * Preprocesa los valores recuperados del formulario
 */
 function iex_direct_flight_clean( $option ){
 	trim($option, " \t\n\r\0\x0B");
	return $option;
 }
 
 
