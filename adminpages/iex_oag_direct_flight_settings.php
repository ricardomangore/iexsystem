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
			<h2>OAG Direct Flights</h2>	
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
  * 
  * Registra la configuración de las opciones e inicializa los campos para ajustar los parametros
  */
  add_action('admin_init', 'iex_oag_direct_flight_init');
 function iex_oag_direct_flight_init(){
  	//Registra una configuración
  	register_setting('iex_direct_flight','iex_direct_flight','iex_direct_flight_clean');
	
	
	$options = get_option('iex_direct_flight');
	//Agergamos una sección
	add_settings_section('iex_oag_direct_flight_section','OAG Direct Flights','iex_oag_direct_flight_section_text','iex_oag_direct_flight_page');
	
	//Agrega campos del formulario
	add_settings_field('iex_origin_criteria_location_type','Origen Criteria Type','iex_create_option_select','iex_oag_direct_flight_page','iex_oag_direct_flight_section',array(
		'id'           => 'iex_origin_criteria_location_type',
		'name'         => 'iex_direct_flight[origin_criteria_location_type]',
		'select_opt'   => array(
			'met_area' => 'M',
			'airport'  => 'A'
		), 
		'param' => $options['origin_criteria_location_type']
	));
	add_settings_field('iex_destination_criteria_location_type','Destination Criteria Type','iex_create_option_select','iex_oag_direct_flight_page','iex_oag_direct_flight_section',array(
		'id'           => 'iex_destination_criteria_location_type',
		'name'         => 'iex_direct_flight[destination_criteria_location_type]',
		'select_opt'   => array(
			'met_area' => 'M',
			'airport'  => 'A'
		), 
		'param' => $options['destination_criteria_location_type']
	));
	add_settings_field('iex_request_time','Request Time','iex_create_input_text','iex_oag_direct_flight_page','iex_oag_direct_flight_section',array(
		'id'     => 'iex_request_time',
		'name'   => 'iex_direct_flight[request_time]',
		'param'  => $options['request_time']
 	));
	add_settings_field('iex_carrier1_criteria','Carrier 1 Criteria','iex_create_input_text','iex_oag_direct_flight_page','iex_oag_direct_flight_section',array(
		'id'     => 'iex_carrier1_criteria',
		'name'   => 'iex_direct_flight[carrier1_criteria]',
		'param'  => $options['carrier1_criteria']
	));
	add_settings_field('iex_sort_order','Sort Order','iex_create_option_select','iex_oag_direct_flight_page','iex_oag_direct_flight_section',array(
		'id'         => 'iex_sort_order',
		'name'       => 'iex_direct_flight[sort_order]',
		'select_opt' => array(
			'departure' => 'D',
			'arrive'    => 'A',
			'elapset'   => 'E' 
			
		),
		'param'     => $options['sort_order']
	));
	add_settings_field('iex_include_freighter','Include Freighter','iex_create_option_select','iex_oag_direct_flight_page','iex_oag_direct_flight_section',array(
		'id'         => 'iex_include_freighter',
		'name'       => 'iex_direct_flight[include_freighter]',
		'select_opt' => array(
			'airliners' => ' ',
			'freighter' => 'F',
			'both'      => 'B' 
			
		),
		'param'     => $options['include_freighter']		
	));
	add_settings_field('iex_include_road_feeder_service','Include Road Feeder Service','iex_create_option_select','iex_oag_direct_flight_page','iex_oag_direct_flight_section',array(
		'id'         => 'iex_include_road_feeder_service',
		'name'       => 'iex_direct_flight[include_road_feeder_service]',
		'select_opt' => array(
			'airliners' => ' ',
			'trucks'    => 'R',
			'both'   => 'B' 
			
		),
		'param'     => $options['include_road_feeder_service']		
	));
	add_settings_field('iex_wide_to_narrow_indicator','Wide to Narrow','iex_create_option_select','iex_oag_direct_flight_page','iex_oag_direct_flight_section',array(
		'id'         => 'iex_wide_to_narrow_indicator',
		'name'       => 'iex_direct_flight[wide_to_narrow_indicator]',
		'select_opt' => array(
			'wide'   => 'W',
			'narrow' => 'N',
			'both'   => '' 
			
		),
		'param'     => $options['wide_to_narrow_indicator']		
	));
	add_settings_field('iex_cargo_carrier_dupe_priorit','Cargo Carrier Dupe Priorit','iex_create_checkbox','iex_oag_direct_flight_page','iex_oag_direct_flight_section',array(
		'id'        => 'iex_cargo_carrier_dupe_priorit',
		'name'      => 'iex_direct_flight[cargo_carrier_dupe_priorit]',
		'param'     => $options['cargo_carrier_dupe_priorit']	
	));
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
 * iex_direct_flight_clean()
 * 
 * Preprocesa los valores recuperados del formulario
 */
 function iex_direct_flight_clean( $option ){
 	if($option['cargo_carrier_dupe_priorit'] == 'on')
		$option['cargo_carrier_dupe_priorit'] = 'true';
	else
		$option['cargo_carrier_dupe_priorit'] = 'false';
	return $option;
 }
 
 
