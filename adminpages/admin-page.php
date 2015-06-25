<?php


/**
 * iex_create_menu()
 * Agrega las entradas al menú settings del dashboard de wordpress
 * 
 */
add_action('admin_menu', 'iex_create_menu');
function iex_create_menu(){
	/**
	 * Crea la entrada de menú IEX Settings en el Dashboard
	 */
	$iex_settings_page = add_menu_page('IEX Settings', 'IEX Settings', 'manage_options', __FILE__, 'iex_settings_page');
	add_action('admin_print_scripts-'.$iex_settings_page, 'iex_settings_js');
	add_action('admin_print_styles-'.$iex_settings_page, 'iex_settings_css');
		
    /**
	 * Crea la entrada de sub-menú IEX Rutas
	 */
    $page_rutas = add_submenu_page(__FILE__, 'Rutas', 'Rutas', 'manage_options', __FILE__.'rutas', 'iex_rutas_page');
	add_action('admin_print_scripts-'.$page_rutas, 'iex_settings_js');
	add_action('admin_print_styles-'.$page_rutas, 'iex_settings_css');
		
	/**
	 * Crea la entrada de sub-menú IEX Navieras
	 */
    $page_navieras = add_submenu_page(__FILE__, 'Navieras', 'Navieras', 'manage_options', __FILE__.'navieras', 'iex_navieras_page');
	add_action('admin_print_scripts-'.$page_navieras, 'iex_settings_js');
	add_action('admin_print_styles-'.$page_navieras, 'iex_settings_css');
	/**
	 * Crea la entrada de sub-menú IEX Puertos
	 */
    $page_puertos = add_submenu_page(__FILE__, 'Puertos', 'Puertos', 'manage_options', __FILE__.'puertos', 'iex_puertos_page');	
	add_action('admin_print_scripts-'.$page_puertos, 'iex_settings_js');
	add_action('admin_print_styles-'.$page_puertos, 'iex_settings_css');
	/**
	 * Crea la entrada de sub-menú IEX Buques
	 */
    $page_buques = add_submenu_page(__FILE__, 'Buques', 'Buques', 'manage_options', __FILE__.'buques', 'iex_buques_page');
	add_action('admin_print_scripts-'.$page_buques, 'iex_settings_js');
	add_action('admin_print_styles-'.$page_buques, 'iex_settings_css');
	
	/**
	 * Crea una entrada "IEX Settings" en el menú Settings del Dashboard
	 */
	$iex_settings_options = add_options_page('IEX Settings', 'IEX Settings', 'manage_options', __FILE__, 'iex_settings_page');
	add_action('admin_print_scripts-'.$iex_settings_options, 'iex_settings_js');
	add_action('admin_print_styles-'.$iex_settings_options, 'iex_settings_css');
}

 
 /**
 * iex_settings_css()
 * Agrega las plantillas de estilos a los menus
 *
 */
 //add_action('admin_print_styles', 'iex_settings_css');
 function iex_settings_css(){
 	wp_enqueue_style('jquery-ui_css', IEX_URL . '/js/jquery-ui/jquery-ui.min.css');
	wp_enqueue_style('jquery_datatable_css', IEX_URL . '/js/plugins/datatable/css/jquery.dataTables.min.css');  
	wp_enqueue_style('select2_css', IEX_URL . '/js/plugins/select2/select2.min.css'); 	
 }
/**
 * iex_settings_js()
 * Agrega los scripts JS a las diferentes opcione sdel menú
 */
 //add_action('admin_print_scripts', 'iex_settings_js');
 function iex_settings_js(){
	wp_enqueue_script('jquery-1_11_2', IEX_URL . '/js/jquery-1_11_2.js');
	wp_enqueue_script('jquery-ui_js', IEX_URL . '/js/jquery-ui/jquery-ui.min.js');	
	wp_enqueue_script('rutas_maritimas_js', IEX_URL . '/js/libraries/rutas-maritimas.js'); 	
	wp_enqueue_script('datatable_js', IEX_URL . '/js/plugins/datatable/jquery.dataTables.min.js');
	wp_enqueue_script('select2_js', IEX_URL . '/js/plugins/select2/select2.full.min.js');
 }
 

/*******************************************************************************************************************
 * 
 *    IEX SETTINGS
 *     
 *    Sección de funciones para construir el formulario settings del plugin
 * 
 * 
 * 
 *******************************************************************************************************************/

/**
 * iex_settings_page()
 * Despliega la vista para de la página IEX Settings 
 */
function iex_settings_page(){
	?>
		<div class="wrap">
		<?php screen_icon(); ?>
			<h2>IEX Plugin Settings</h2>	
			<form action="options.php" method="post">
				
				<?php
				    settings_fields('iex_options');
					//Carga la secciones registradas a nombre de 'iex_settings_page' 
					do_settings_sections('iex_settings_page');
				?>
				
				<input type="submit" type="submit" value="Save Changes" />
			</form>	
		</div>
	<?php
}

/**
 * iex_admin_init()
 * Registra nuevas opciones de Ajustes para el plugin
 */
add_action('admin_init', 'iex_admin_init');
function iex_admin_init(){
	//Registramos opciones de ajustes personalizadas
	register_setting('iex_options','iex_options','iex_clean_options');
	
	//Sección OAG Web Service Settings
	add_settings_section('iex_oag_settings', 'OAG WebService Configuration', 'iex_oag_section_text', 'iex_settings_page');
	
	//Campos de la Sección OAG Web Service Settings
	add_settings_field('iex_oag_username', 'User Name', 'iex_oag_username_input', 'iex_settings_page', 'iex_oag_settings');
	add_settings_field('iex_oag_password', 'Password', 'iex_oag_password_input', 'iex_settings_page', 'iex_oag_settings');
	add_settings_field('iex_oag_wsdl', 'WSDL', 'iex_oag_wsdl_input', 'iex_settings_page', 'iex_oag_settings');
	add_settings_field('iex_oag_origem_criteria_location_tipe', 'Origen Criteria Location Type', 'iex_oag_origen_criteria_location_type_input', 'iex_settings_page', 'iex_oag_settings');
	add_settings_field('iex_oag_destination_criteria_location_tipe', 'Destination Criteria Location Type', 'iex_oag_destination_criteria_location_type_input', 'iex_settings_page', 'iex_oag_settings');
	add_settings_field('iex_oag_carrier1_criteria', 'Carrier1 Criteria', 'iex_oag_carrier1_criteria_input', 'iex_settings_page', 'iex_oag_settings');
	add_settings_field('iex_oag_include_freighter', 'Include Freighter', 'iex_oag_include_freighter_input', 'iex_settings_page', 'iex_oag_settings');	
	add_settings_field('iex_oag_include_road_feder_service', 'Include Road Feder Service', 'iex_oag_include_road_feder_service_input', 'iex_settings_page', 'iex_oag_settings');
	add_settings_field('iex_oag_wide_to_narrow_indicator', 'Wide To Narrow Indicator', 'iex_oag_wide_to_narrow_indicator_input', 'iex_settings_page', 'iex_oag_settings');
	
	
	//Sección FleetMon Service
	add_settings_section('iex_fleetmon_settings', 'FleetMon Service Configuration', 'iex_fleetmon_section_text', 'iex_settings_page');
	
	//Campos de la Sección FleetMon Service
	add_settings_field('fleetmon_json_vessel_url', 'Json Vessel URL', 'iex_fleetmon_json_vessel_url_input', 'iex_settings_page', 'iex_fleetmon_settings');
	add_settings_field('fleetmon_json_port_url', 'Json Port URL', 'iex_fleetmon_json_port_url_input', 'iex_settings_page', 'iex_fleetmon_settings');
}

/**
 * Sección de configuración de OAG Web service
 */
 function iex_oag_section_text(){
 	echo '<p>Ingrese los par&aacute;metros de configuración de OAG Web Service</p>';
 }
/**
 * Sección de configuración de FleetMon Service
 */
 function iex_fleetmon_section_text(){
	echo '<p>Ingrese los par&aacute;metros de configuración de FleetMon Service</p>';
 }
 
 
 /**
  * Función para desplegar el campo input OAG username
  */
 function iex_oag_username_input( $args ){
 	$option = get_option('iex_options');
	echo "<input type='text' id='iex_option_username_input' name='iex_options[oag_webservice_options][username]' value='{$option['oag_webservice_options']['username']}' />";
 }
 /**
  * Función para desplegar el campo input OAG password
  */
 function iex_oag_password_input( $args ){
 	$option = get_option('iex_options');
	echo "<input type='password' id='iex_option_username_input' name='iex_options[oag_webservice_options][password]' value='{$option['oag_webservice_options']['password']}' />";
 }
 /**
  * Función para desplegar el campo input OAG WSDL
  */
 function iex_oag_wsdl_input( $args ){
 	$option = get_option('iex_options');
	echo "<input type='text' id='iex_option_wsdl_input' name='iex_options[oag_webservice_options][wsdl]' value='{$option['oag_webservice_options']['wsdl']}' />";
 }
 /**
  * Origen Criteria Location Type option
  */
 function iex_oag_origen_criteria_location_type_input( $args ){
 	$option = get_option('iex_options');
	if($option['oag_webservice_options']['origen_criteria_location_type'] == 'M'){
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
		
	echo "<select id='iex_option_origen_criteria_location_type' name='iex_options[oag_webservice_options][origen_criteria_location_type]'>
		<option value='$value01'>$option01</option>
		<option value='$value02'>$option02</option>
	</select>";
 }
 /**
  * Destination Criteria Location Type option
  */
 function iex_oag_destination_criteria_location_type_input( $args ){
 	$option = get_option('iex_options');
	if($option['oag_webservice_options']['destination_criteria_location_type'] == 'M'){
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
		
	echo "<select id='iex_option_destination_criteria_location_type' name='iex_options[oag_webservice_options][destination_criteria_location_type]'>
		<option value='$value01'>$option01</option>
		<option value='$value02'>$option02</option>
	</select>";
 }
  /**
  * Función para desplegar el campo input OAG Carrier1 Criteria
  */
 function iex_oag_carrier1_criteria_input( $args ){
 	$option = get_option('iex_options');                                                                                                                                      
	echo "<input type='text' id='iex_option_carrier1_criteria_input' name='iex_options[oag_webservice_options][carrier1_criteria]' value='{$option['oag_webservice_options']['carrier1_criteria']}' />";
 }
 /**
  * Función para desplegar el campo Include Freighter 
  */
  function iex_oag_include_freighter_input(){
  	$option = get_option('iex_options');
	if($option['oag_webservice_options']['include_freighter'] == ''){
		$option01 = 'Passenger Only';
		$option02 = 'Freighter Only';
		$option03 = 'Both';
		$value01  = '';
		$value02  = 'F';
		$value03  = 'B';
	}else{
		if($option['oag_webservice_options']['include_freighter'] == 'R'){
			$option01 = 'Freighter Only';
			$option02 = 'Passenger Only';
			$option03 = 'Both';
			$value01  = 'F';
			$value02  = '';
			$value03  = 'B';			
		}else{
			$option01 = 'Both';
			$option02 = 'Freighter Only';
			$option03 = 'Passenger Only';
			$value01  = 'B';
			$value02  = 'F';
			$value03  = '';			
		}		
	}	
  	echo "<select id='iex_option_include_freighter' name='iex_options[oag_webservice_options][include_freighter]'>
		<option value='$value01'>$option01</option>
		<option value='$value02'>$option02</option>
		<option value='$value03'>$option03</option>
	</select>";
  }  
 /**
  * Función para desplegar el campo Include Road Feder Service
  */
  function iex_oag_include_road_feder_service_input(){
  	$option = get_option('iex_options');
	if($option['oag_webservice_options']['include_road_feder_service'] == ''){
		$option01 = 'Flights Only';
		$option02 = 'RFS Only';
		$option03 = 'Both';
		$value01  = '';
		$value02  = 'R';
		$value03  = 'B';
	}else{
		if($option['oag_webservice_options']['include_road_feder_service'] == 'R'){
			$option01 = 'RFS Only';
			$option02 = 'Flights Only';
			$option03 = 'Both';
			$value01  = 'R';
			$value02  = '';
			$value03  = 'B';			
		}else{
			$option01 = 'Both';
			$option02 = 'RFS Only';
			$option03 = 'Flights Only';
			$value01  = 'B';
			$value02  = 'R';
			$value03  = '';			
		}		
	}	
  	echo "<select id='iex_option_include_road_feder_service' name='iex_options[oag_webservice_options][include_road_feder_service]'>
		<option value='$value01'>$option01</option>
		<option value='$value02'>$option02</option>
		<option value='$value03'>$option03</option>
	</select>";
  }
  /**
  * Función para desplegar el campo Wide To Narrow Indicator
  */
  function iex_oag_wide_to_narrow_indicator_input(){
  	$option = get_option('iex_options');
	if($option['oag_webservice_options']['wide_to_narrow_indicator'] == ''){
		$option01 = 'Wide and Narrow';//Flights Only
		$option02 = 'Wide Only';//RFS Only
		$option03 = 'Narrow Only';//BOth
		$value01  = '';
		$value02  = 'W';
		$value03  = 'N';
	}else{
		if($option['oag_webservice_options']['wide_to_narrow_indicator'] == 'W'){
			$option01 = 'Wide Only';
			$option02 = 'Wide and Narrow';
			$option03 = 'Narrow Only';
			$value01  = 'W';
			$value02  = '';
			$value03  = 'N';			
		}else{
			$option01 = 'Narrow Only';
			$option02 = 'Wide Only';
			$option03 = 'Wide and Narros';
			$value01  = 'N';
			$value02  = 'W';
			$value03  = '';			
		}		
	}	
  	echo "<select id='iex_option_wide_to_narrow_indicator' name='iex_options[oag_webservice_options][wide_to_narrow_indicator]'>
		<option value='$value01'>$option01</option>
		<option value='$value02'>$option02</option>
		<option value='$value03'>$option03</option>
	</select>";
  }

 /**
  * Función para desplegar el campo input FleetMon Json Vessel URL
  */
 function iex_fleetmon_json_vessel_url_input( $args ){
 	$option = get_option('iex_options');                                                                                                                                      
	echo "<input type='text' id='fleetmon_json_vessel_url_input' name='iex_options[fleetmon_options][json_vessel_url]' value='{$option['fleetmon_options']['json_vessel_url']}' />";
 }
 /**
  * Función para desplegar el campo input FleetMon Json Port URL
  */
 function iex_fleetmon_json_port_url_input( $args ){
 	$option = get_option('iex_options');                                                                                                                                      
	echo "<input type='text' id='fleetmon_json_port_url_input' name='iex_options[fleetmon_options][json_port_url]' value='{$option['fleetmon_options']['json_port_url']}' />";
 } 
 
/**
 * Función de validación de opciones personalziadas
 */
function iex_clean_options( $option ){
	trim($option, " \t\n\r\0\x0B");
	return $option;
}

/******************************* Termina IEX SETTINGS  ************************************************************/






/******************************************************************************************************************
 * 
 *     NAVIERAS
 *  
 *     Funciones para construir el submenú de administración de Navieras
 * 
 ******************************************************************************************************************/


/**
 * Despliega la vista para la página Navieras
 */
function iex_navieras_page(){
	?>
		<div class="wrap">
			<h2>Administración de Navieras</h2>
			<p>Imgrese el nombre de una naviera</p>
			<form id="iex_navieras_admin_form" name="iex_navieras_admin_form">
				<input id="url_pl" type="hidden" value="<?php echo IEX_URL; ?>"/>
				<input id="url_aa" type="hidden" value="<?php echo admin_url("admin-ajax.php"); ?>"/>
				<input type="hidden" id="id_naviera" name="id_naviera"/>
				<table>
					<tr>
						<td>Naviera</td>
						<td><input type="text" id="naviera" name="naviera"/></td>
					</tr>
					<tr>
						<td><button id="btn_add_naviera">Agregar</button></td>
						<td><button id="btn_edit_naviera" disabled>Editar</button> <button id="btn_delete_naviera" style="margin-left: 2px;" disabled>Eliminar</button></td>
					</tr>
				</table>
				
			</form>
			
			<div class="iex_clarant" style="height: 50px"></div>
			
			<table class="display" id="naviera_table">
				<thead>
					<tr>
		                <th>ID</th>
		                <th>Naviera</th>
		            </tr>
		        </thead>
		        <tfoot>
					<tr>
		                <th>ID</th>
		                <th>Naviera</th>
		            </tr>
		        </tfoot>
			</table>
		</div><!-- .wrap -->
	<?php
}


/******************************* Termina IEX SETTINGS  ************************************************************/






/******************************************************************************************************************
 * 
 *     RUTAS
 *  
 *     Funciones para construir el submenú de administración de Rutas
 * 
 ******************************************************************************************************************/
function iex_rutas_page(){
	?>
		<div class="wrap">
			<h2>Adminsitración de Rutas</h2>
			<p>Ingrese los datos de una Ruta Marítima</p>
			<form id="iex_rutas_admin_form" name="iex_rutas_admin_form">
				<input id="url_pl" type="hidden" value="<?php echo IEX_URL; ?>"/>
				<input id="url_aa" type="hidden" value="<?php echo admin_url("admin-ajax.php"); ?>"/>			
				<table>
					<tr>
						<td>Naviera</td>
						<td>
							<select id="select_naviera" name="select_naviera" style="width:200px;"></select>
						</td>
						<td>Buque</td>
						<td>
							<select id="select_buque" name="select_buque" class="js-data-example-ajax" style="width:200px;"></select>
						</td>
						<td>Puerto</td>					
						<td>
							<select id="select_puerto" name="select_puerto" class="js-data-example-ajax" style="width:200px;"></select>
						</td>						
					</tr>
					<tr>
						<td>ETA</td>
						<td>
							<input type="text" id="eta" name="eta" />
						</td>					
						<td>Viaje</td>
						<td><input type="text" id="viaje" name="viaje"/></td>
						<td>Tipo</td>
						<td>
							<select id="select_tipo_ruta" name="select_tipo_ruta" style="width:200px;">
								<option value="e">Exportación</option>
								<option value="i">Importación</option>
							</select>
						</td>						
					</tr>
					<tr>
						<td>Ruta Intermodal</td>	
						<td><input type="checkbox" id="chk_ruta_intermodal" name="chk_ruta_intermodal"/></td>
					</tr>
					<tr>
						<td>Nombre</td>
						<td><input type="text" id="nombre_ruta_intermodal" name="nombre_ruta_intermodal" disabled/></td>
					</tr>
					<tr>
						<td><button id="btn_add_ruta">Agregar</button></td>
					</tr>
				</table>
			</form>
			
			
			<div class="iex_clarant" style="height: 50px"></div>
			
			<table class="display" id="ruta_table">
				<thead>
					<tr>
		                <th>ID</th>
		                <th>Buque</th>
		                <th>Viaje</th>
		                <th>Puerto</th>
		                <th>ETA</th>
		                <th>Naviera</th>
		                <th>Tipo</th>
		                <th>IEX</th>
		            </tr>
		        </thead>
		        <tfoot>
					<tr>
		                <th>ID</th>
		                <th>Buque</th>
		                <th>Viaje</th>
		                <th>Puerto</th>
		                <th>ETA</th>
		                <th>Naviera</th>
		                <th>Tipo</th>
		                <th>IEX</th>
		            </tr>
		        </tfoot>
			</table>			
		</div><!-- .wrap -->
	<?php
}



/******************************************************************************************************************
 * 
 *     PUERTOS
 *  
 *     Funciones para construir el submenú de administración de Puertos
 * 
 ******************************************************************************************************************/
function iex_puertos_page(){
	?>
		<div class="wrap">
			<h2>Adminsitración de Puertos</h2>
			<p>Ingrese los datos de una Puerto</p>
			<form id="iex_puertos_admin_form" name="iex_puertos_admin_form">
				<input id="url_pl" type="hidden" value="<?php echo IEX_URL; ?>"/>
				<input id="url_aa" type="hidden" value="<?php echo admin_url("admin-ajax.php"); ?>"/>			
				<table>
					<tr>
						<td>Puerto</td>
						<td>
							<select id="select_puerto" name="select_puerto" class="js-data-example-ajax" style="width:200px;"></select>
						</td>
					</tr>
					<tr>
						<td><button id="btn_add_puerto">Agregar</button></td>
					</tr>
				</table>
			</form>
			
			
			<div class="iex_clarant" style="height: 50px"></div>
			
			<table class="display" id="puerto_table">
				<thead>
					<tr>
		                <th>ID</th>
		                <th>Locode</th>
		                <th>Puerto</th>
		                <th>ISO</th>
		                <th>País</th>
		            </tr>
		        </thead>
		        <tfoot>
					<tr>
		                <th>ID</th>
		                <th>Locode</th>
		                <th>Puerto</th>
		                <th>ISO</th>
		                <th>País</th>
		            </tr>
		        </tfoot>
			</table>			
		</div><!-- .wrap -->
	<?php
}

/******************************************************************************************************************
 * 
 *     RUTAS
 *  
 *     Funciones para construir el submenú de administración de Rutas
 * 
 ******************************************************************************************************************/
function iex_buques_page(){
	?>
		<div class="wrap">
			<h2>Adminsitración de Rutas</h2>
			<p>Ingrese los datos del Buque</p>
			<form id="iex_buques_admin_form" name="iex_buques_admin_form">
				<input id="url_pl" type="hidden" value="<?php echo IEX_URL; ?>"/>
				<input id="url_aa" type="hidden" value="<?php echo admin_url("admin-ajax.php"); ?>"/>			
				<table>
					<tr>
						<td>Buque</td>
						<td>
							<select id="select_buque" name="select_buque" class="js-data-example-ajax" style="width:200px;"></select>
						</td>
						<td>Naviera</td>
						<td>
							<select id="select_naviera" name="select_naviera" style="width:200px;"></select>
						</td>
					</tr>
					<tr>
						<td>Alias</td>
						<td><input type="text" id="alias_buque" name="alias_buque"/></td>
					</tr>
					<tr>
						<td><button id="btn_add_buque">Agregar</button></td>
					</tr>
				</table>
			</form>
			
			
			<div class="iex_clarant" style="height: 50px"></div>
			
			<table class="display" id="buque_table">
				<thead>
					<tr>
		                <th>ID</th>
		                <th>Buque</th>
		                <th>Alias</th>
		                <th>Tipo</th>
		                <th>Naviera</th>
		                <th>Bandera</th>
		                <th>MMSI</th>
		                <th>IMO</th>
		            </tr>
		        </thead>
		        <tfoot>
					<tr>
		                <th>ID</th>
		                <th>Buque</th>
		                <th>Alias</th>
		                <th>Tipo</th>
		                <th>Naviera</th>
		                <th>Bandera</th>
		                <th>MMSI</th>
		                <th>IMO</th>
		            </tr>
		        </tfoot>
			</table>			
		</div><!-- .wrap -->
	<?php
}









 
 
 





 
 
