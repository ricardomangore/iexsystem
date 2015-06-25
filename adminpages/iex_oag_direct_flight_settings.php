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
 function iex_oag_direct_flight_init(){
  	//Registra una configuración
  	register_setting('iex_direct_flight','iex_direct_flight','iex_direct_flight_clean');
	
	//Agergamos una sección
	add_settings_section('iex_oag_direct_flight_section','OAG Direct Flights','iex_oag_direct_flight_section_text','iex_oag_direct_flight_page');
	
	//Agrega campos del formulario
	add_settings_field('iex_origen_criteria_location_type','Origen Criteria Type','iex_origen_criteria_location_type_input','iex_oag_direct_flight_section','iex_oag_direct_flight_page');
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
  	$option =get_option('iex_direct_flight');
  	echo "<input type='text' id='iex_origen_criteria_location_type' name='iex_origen_criteria_location_type' value='{$option['origen_criteria_location_type']}'/>";
  }

/**
 * iex_direct_flight_clean()
 * 
 * Preprocesa los valores recuperados del formulario
 */
 function iex_direct_flight_clean( $opiton ){
 	trim($option, " \t\n\r\0\x0B");
	return $option;
 }
 
 
