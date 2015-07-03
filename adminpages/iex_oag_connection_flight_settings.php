<?php

add_action('admin_menu','iex_oag_connection_flight_menu');
function iex_oag_connection_flight_menu(){
	add_submenu_page('iexsystem/adminpages/iex_system_settings.php','Connection Flights','Connection Flights','manage_options',__FILE__,'iex_oag_connections_flight_page');
}



/**
 * iex_oag_connection_flight_page()
 * 
 * Crea la página para ajustar los aprametros de búsqueda de vuelos con conexión
 */
function iex_oag_connections_flight_page(){
	?>
		<div class="wrap">
			<?php screen_icon(); ?>
			<h2>OAG Connection Flights</h2>	
			<form action="options.php" method="post">
				
				<?php
					//Carga los valores del arreglo iex_oag_account instanciado en el script install.php
				    settings_fields('iex_connections_flight');
					
					//Carga la secciones registradas a nombre de 'iex_settings_page' 
					do_settings_sections('iex_oag_connections_flight_page');
				?>	
				<input type="submit" type="submit" value="Save Changes" />
			</form>	
		</div>
	<?php
}

/**
 * iex_oag_connection_flight_init()
 * 
 * Configura la página de Vuelos con conexión
 * Registra las opciones de configuración de la página de OVuelos con conexión
 * Agrega las secciones de la página de vuelos con conexión
 * Agrega los campos de la página de vuelos con conexión
 */
 add_action('admin_init','iex_connections_flight_inint');
 function iex_connections_flight_inint(){
 	//registra las opciones para vuelos con conexión
 	register_setting('iex_connections_flight','iex_connections_flight','iex_connections_flight_clean');
	
	//Agrega una sección a la página de vuelos con conexión
	add_settings_section('iex_oag_connections_flight_section','OAG Connection Flights', 'iex_oag_connections_flights_section_text','iex_oag_connections_flight_page');
	
	//Agrega los campo sde la página de vuelos con conexión
	
	$options = get_option('iex_connections_flight');
	//Agrega campos del formulario
	add_settings_field('iex_origen_criteria_location_type','Origen Criteria Type','iex_create_option_select','iex_oag_connections_flight_page','iex_oag_connections_flight_section',array(
		'id'           => 'iex_origen_criteria_location_type',
		'name'         => 'iex_connections_flight[origen_criteria_location_type]',
		'select_opt'   => array(
			'met_area' => 'M',
			'airport'  => 'A'
		), 
		'param' => $options['origen_criteria_location_type']
	));
	add_settings_field('iex_destination_criteria_location_type','Destination Criteria Type','iex_create_option_select','iex_oag_connections_flight_page','iex_oag_connections_flight_section',array(
		'id'           => 'iex_destination_criteria_location_type',
		'name'         => 'iex_connections_flight[destination_criteria_location_type]',
		'select_opt'   => array(
			'met_area' => 'M',
			'airport'  => 'A'
		), 
		'param' => $options['destination_criteria_location_type']
	));
	add_settings_field('iex_request_time','Request Time','iex_create_input_text','iex_oag_connections_flight_page','iex_oag_connections_flight_section',array(
		'id'     => 'iex_request_time',
		'name'   => 'iex_connections_flight[request_time]',
		'param'  => $options['request_time']
 	));
	add_settings_field('iex_via1_criteria_location_type','Via 1 Criteria Location Type','iex_create_option_select','iex_oag_connections_flight_page','iex_oag_connections_flight_section',array(
		'id'			=> 'iex_via1_criteria_location_type',
		'name'  		=> 'iex_connections_flight[via1_criteria_location_type]',
		'select_opt'	=> array(
			'airport'	=> 'A',
			'city'		=> 'M'
		),
		'param' 		=> $options['via1_criteria_location_type']
	));
	add_settings_field('iex_via1_criteria','Via 1 Citeria','iex_create_input_text','iex_oag_connections_flight_page','iex_oag_connections_flight_section',array(
		'id'	=> 'iex_via1_criteria',
		'name'  => 'iex_connections_flight[via1_criteria]',
		'param' => $options['via1_criteria']
	));
	add_settings_field('iex_carrier1_criteria','Carrier 1 Criteria','iex_create_input_text','iex_oag_connections_flight_page','iex_oag_connections_flight_section',array(
		'id'     => 'iex_carrier1_criteria',
		'name'   => 'iex_connections_flight[carrier1_criteria]',
		'param'  => $options['carrier1_criteria']
	));
	add_settings_field('iex_carrier2_criteria','Carrier 2 Criteria','iex_create_input_text','iex_oag_connections_flight_page','iex_oag_connections_flight_section',array(
		'id'     => 'iex_carrier2_criteria',
		'name'   => 'iex_connections_flight[carrier2_criteria]',
		'param'  => $options['carrier2_criteria']
	));
	add_settings_field('iex_sort_order','Sort Order','iex_create_option_select','iex_oag_connections_flight_page','iex_oag_connections_flight_section',array(
		'id'         => 'iex_sort_order',
		'name'       => 'iex_connections_flight[sort_order]',
		'select_opt' => array(
			'departure' => 'D',
			'arrive'    => 'A',
			'elapset'   => 'E' 
			
		),
		'param'     => $options['sort_order']
	));
	add_settings_field('iex_include_freighter','Include Freighter','iex_create_option_select','iex_oag_connections_flight_page','iex_oag_connections_flight_section',array(
		'id'         => 'iex_include_freighter',
		'name'       => 'iex_connections_flight[include_freighter]',
		'select_opt' => array(
			'airliners' => ' ',
			'freighter'    => 'F',
			'both'   => 'B' 
			
		),
		'param'     => $options['include_freighter']		
	));
	add_settings_field('iex_include_road_feeder_service','Include Road Feeder Service','iex_create_option_select','iex_oag_connections_flight_page','iex_oag_connections_flight_section',array(
		'id'         => 'iex_include_road_feeder_service',
		'name'       => 'iex_connections_flight[include_road_feeder_service]',
		'select_opt' => array(
			'airliners' => ' ',
			'trucks'    => 'R',
			'both'   => 'B' 
			
		),
		'param'     => $options['include_road_feeder_service']		
	));
	add_settings_field('iex_wide_to_narrow_indicator','Wide to Narrow','iex_create_option_select','iex_oag_connections_flight_page','iex_oag_connections_flight_section',array(
		'id'         => 'iex_wide_to_narrow_indicator',
		'name'       => 'iex_connections_flight[wide_to_narrow_indicator]',
		'select_opt' => array(
			'wide'   => 'W',
			'narrow' => 'N',
			'both'   => '' 
			
		),
		'param'     => $options['wide_to_narrow_indicator']		
	));
	add_settings_field('iex_low_cost_connections_indicator','Low Cost Connections Indicator','iex_create_option_select','iex_oag_connections_flight_page','iex_oag_connections_flight_section',array(
		'id'         => 'iex_low_cost_connections_indicator',
		'name'       => 'iex_connections_flight[low_cost_connections_indicator]',
		'select_opt' => array(
			'standar'   => '',
			'low_cost'  => 'L',
			'both'      => 'B' 
			
		),
		'param'     => $options['wide_to_narrow_indicator']		
	));
	add_settings_field('iex_max_ct1','Max Ct1','iex_create_input_text','iex_oag_connections_flight_page','iex_oag_connections_flight_section',array(
		'id'     => 'iex_carrier2_criteria',
		'name'   => 'iex_connections_flight[max_ct1]',
		'param'  => $options['max_ct1']
	));
	add_settings_field('iex_max_elapsed_time','Max Elapsed Time','iex_create_input_text','iex_oag_connections_flight_page','iex_oag_connections_flight_section',array(
		'id'     => 'iex_max_elapsed_time',
		'name'   => 'iex_connections_flight[max_elapsed_time]',
		'param'  => $options['max_elapsed_time']
	));
	add_settings_field('iex_max_circuity','Max Circuity','iex_create_input_text','iex_oag_connections_flight_page','iex_oag_connections_flight_section',array(
		'id'     => 'iex_max_circuity',
		'name'   => 'iex_connections_flight[max_circuity]',
		'param'  => $options['max_circuity']
	));
	add_settings_field('iex_override_min_ct1','Override Min Ct1','iex_create_input_text','iex_oag_connections_flight_page','iex_oag_connections_flight_section',array(
		'id'     => 'iex_override_min_ct1',
		'name'   => 'iex_connections_flight[override_min_ct1]',
		'param'  => $options['override_min_ct1']
	));
	add_settings_field('iex_max_singles_route','Max Singles Route','iex_create_input_text','iex_oag_connections_flight_page','iex_oag_connections_flight_section',array(
		'id'     => 'iex_max_singles_route',
		'name'   => 'iex_connections_flight[max_singles_route]',
		'param'  => $options['max_singles_route']
	));
	add_settings_field('iex_cargo_carrier_dupe_priorit','Cargo Carrier Dupe Priorit','iex_create_checkbox','iex_oag_connections_flight_page','iex_oag_connections_flight_section',array(
		'id'        => 'iex_cargo_carrier_dupe_priorit',
		'name'      => 'iex_connections_flight[cargo_carrier_dupe_priorit]',
		'param'     => $options['cargo_carrier_dupe_priorit']	
	));
	add_settings_field('iex_enable_online','Enable Online','iex_create_checkbox','iex_oag_connections_flight_page','iex_oag_connections_flight_section',array(
		'id'        => 'iex_enable_online',
		'name'      => 'iex_connections_flight[enable_online]',
		'param'     => $options['enable_online']	
	));	
	add_settings_field('inter_airport_connections','Inter Airport Connections','iex_create_checkbox','iex_oag_connections_flight_page','iex_oag_connections_flight_section',array(
		'id'        => 'inter_airport_connections',
		'name'      => 'iex_connections_flight[inter_airport_connections]',
		'param'     => $options['inter_airport_connections']	
	));
 }
 
 /**
  * iex_oag_connection_flights_section_text()
  * 
  * Agrega una sección a la página de Vuelos con Conexión
  */
 function iex_oag_connections_flights_section_text(){
 	echo '<p>OAG Direct Flights Settings</p>';
 }
 

/**
 * iex_connection_flight_clean()
 * 
 * Valida los campos del formulario
 */
 function iex_connections_flight_clean( $option ){
 	if($option['cargo_carrier_dupe_priorit'] == 'on')
		$option['cargo_carrier_dupe_priorit'] = 'true';
	else
		$option['cargo_carrier_dupe_priorit'] = 'false';
	return $option;
 }
 
