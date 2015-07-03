<?php

/**
 * iex_create_option_select()
 * 
 * Crea una lista desplegable 
 */
 function iex_create_option_select( $args ){
 	echo "<select id='{$args['id']}' name='{$args['name']}'>";
	foreach($args[select_opt] as $key => $val){
		if($val == $args['param'])
			echo "<option value='$val' selected >$key</option>";
		else
			echo "<option value='$val'>$key</option>";
	}
	echo "</select>";
 }
 
 /**
  * iex_create_input_text()
  * 
  * Crea un campo de entrada de texto
  */
function iex_create_input_text( $args ){
	echo "<input type='text' id='{$args['id']}' name='{$args['name']}' value='{$args['param']}' />";
}

/**
 * iex_create_checkbox()
 * 
 * Crea un checkbox
 */
function iex_create_checkbox( $args ){
	if($args['param'] == 'true')
		echo "<input type='checkbox' id='{$args['id']}' name='{$args['name']}' checked />";
	else
		echo "<input type='checkbox' id='{$args['id']}' name='{$args['name']}' />";
}



/**********************************************************************************************************/
/**
  * iex_origen_criteria_location_type_input()
  * 
  * Crea un campo de texto para el parametro Origen Criteria Location Type
  */
 function iex_origen_criteria_location_type_input( $args ){
	echo "<select id='{$args['id']}' name='{$args['name']}'>";
	foreach($args[select_opt] as $key => $val){
		if($val == $args['param'])
			echo "<option value='$val' selected >$key</option>";
		else
			echo "<option value='$val'>$key</option>";
	}
	echo "</select>";
  }
  
   /**
  * iex_destination_criteria_location_type_input()
  * 
  * Crea un campo de texto para el parametro Origen Criteria Location Type
  */
 function iex_destination_criteria_location_type_input( $args ){
	echo "<select id='{$args['id']}' name='{$args['name']}'>";
	foreach($args[select_opt] as $key => $val){
		if($val == $args['param'])
			echo "<option value='$val' selected >$key</option>";
		else
			echo "<option value='$val'>$key</option>";
	}
	echo "</select>";
  }

/**
 * iex_request_time_input()
 * 
 * Crea un campo de texto para el parametro Request Time
 */
 function iex_request_time_input( $args ){
 	echo "<input type='text' id='{$args['id']}' name='{$args['name']}' value='{$args['param']}' />";
 }
 
/**
 * iex_carrier1_criteria()
 *    
 * Crea un campo de texto para el parametro Carrier 1 Criteria
 */
 function iex_carrier1_criteria_input( $args ){
 	$option = get_option('iex_direct_flight');
 	echo "<input type='text' id='iex_carrier1_criteria' name='iex_direct_flight[carrier1_criteria]' value='{$option['carrier1_criteria']}' />";
 }
 
 /**
  * iex_sort_order_input()
  * 
  * Crea un campo seleccionable para el parametro Sort Order
  */
 function iex_sort_order_input( $args ){
 	$option = get_option('iex_connection_flight');

	if($option['sort_order'] == 'E'){
		$option01 = 'Elapsed Time';
		$option02 = 'Departure date/time';
		$option03 = 'Arrival date/time';
		$value01  = 'E';
		$value02  = 'D';
		$value03  = 'A';
	}elseif($option['sort_order'] == 'D'){
		$option01 = 'Departure date/time';
		$option02 = 'Elapsed Time';
		$option03 = 'Arrival date/time';
		$value01  = 'D';
		$value02  = 'E';
		$value03  = 'A';		
	}elseif($option['sort_order'] == 'A'){
		$option01 = 'Arrival date/time';
		$option02 = 'Departure date/time';
		$option03 = 'Elapsed Time';
		$value01  = 'A';
		$value02  = 'D';
		$value03  = 'E';
	}
		
	echo "<select id='iex_sort_order' name='iex_direct_flight[sort_order]'>
		<option value='$value01'>$option01</option>
		<option value='$value02'>$option02</option>
		<option value='$value03'>$option03</option>
	    </select>";
 }
 
/**
 * iex_include_freighter_input
 * 
 * Crea un campo seleccionable para el parametro iex_include_freighter_input
 */
 function iex_include_freighter_input( $args ){
 	$option = get_option('iex_connection_flight');

	if($option['include_freighter'] == ' '){
		$option01 = 'Airliners';
		$option02 = 'Freighters';
		$option03 = 'Both';
		$value01  = ' ';
		$value02  = 'F';
		$value03  = 'B';
	}elseif($option['include_freighter'] == 'F'){
		$option01 = 'Freighters';
		$option02 = 'Airliners';
		$option03 = 'Both';
		$value01  = 'F';
		$value02  = ' ';
		$value03  = 'B';		
	}elseif($option['include_freighter'] == 'B'){
		$option01 = 'Both';
		$option02 = 'Freighters';
		$option03 = 'Airliners';
		$value01  = 'B';
		$value02  = 'F';
		$value03  = ' ';
	}
		
	echo "<select id='iex_include_freighter' name='iex_direct_flight[include_freighter]'>
		<option value='$value01'>$option01</option>
		<option value='$value02'>$option02</option>
		<option value='$value03'>$option03</option>
	    </select>";
 }
 
/**
 * iex_include_road_feeder_service_input()
 * 
 * Crea un campo seleccionable para el parametro include_road_feeder_service
 */ 
function iex_include_road_feeder_service_input( $args ){
	$option = get_option('iex_connection_flight');

	if($option['include_road_feeder_service'] == ' '){
		$option01 = 'Airliners';
		$option02 = 'Trucks';
		$option03 = 'Both';
		$value01  = ' ';
		$value02  = 'R';
		$value03  = 'B';
	}elseif($option['include_road_feeder_service'] == 'R'){
		$option01 = 'Trucks';
		$option02 = 'Both';
		$option03 = 'Airliners';
		$value01  = 'R';
		$value02  = 'B';
		$value03  = ' ';		
	}elseif($option['include_road_feeder_service'] == 'B'){
		$option01 = 'Both';
		$option02 = 'Airliners';
		$option03 = 'Trucks';
		$value01  = 'B';
		$value02  = ' ';
		$value03  = 'R';
	}
		
	echo "<select id='iex_include_road_feeder_service' name='iex_direct_flight[include_road_feeder_service]'>
		<option value='$value01'>$option01</option>
		<option value='$value02'>$option02</option>
		<option value='$value03'>$option03</option>
	    </select>";
	
}
 
 
/**
 * iex_wide_to_narrow_indicator_input()
 * 
 * Crea un Campo seleccionable para el parametro Wide to narrow indicator 
 */
function iex_wide_to_narrow_indicator_input( $args ){
	$option = get_option('iex_connection_flight');
	
	if($option['wide_to_narrow_indicator'] == ''){
		$option01 = 'Wide and Narrow';
		$option02 = 'Wide';
		$option03 = 'Narrow';
		$value01  = '';
		$value02  = 'W';
		$value03  = 'N';
	}elseif($option['wide_to_narrow_indicator'] == 'W'){
		$option01 = 'Wide';
		$option02 = 'Narrow';
		$option03 = 'Wide and Narrow';
		$value01  = 'W';
		$value02  = 'N';
		$value03  = '';		
	}elseif($option['wide_to_narrow_indicator'] == 'N'){
		$option01 = 'Narrow';
		$option02 = 'Wide and Narrow';
		$option03 = 'Wide';
		$value01  = 'N';
		$value02  = '';
		$value03  = 'W';
	}
		
	echo "<select id='iex_wide_to_narrow' name='iex_direct_flight[wide_to_narrow_indicator]'>
		<option value='$value01'>$option01</option>
		<option value='$value02'>$option02</option>
		<option value='$value03'>$option03</option>
	    </select>";	
}


/**
 * iex_cargo_carrier_dupe_priority_input()
 * 
 * Crea checkbox para el campo Cargo Carrier Dupe Priority
 */
function iex_cargo_carrier_dupe_priorit_input( $args ){
	$option = get_option('iex_connection_flight');	
	if($option['cargo_carrier_dupe_priorit'] == 'true')
		echo "<input type='checkbox' id='iex_cargo_carrier_dupe_priorit' name='iex_direct_flight[cargo_carrier_dupe_priorit]' checked/>";
	elseif($option['cargo_carrier_dupe_priorit'] == 'false')
		echo "<input type='checkbox' id='iex_cargo_carrier_dupe_priorit' name='iex_direct_flight[cargo_carrier_dupe_priorit]' />";
}