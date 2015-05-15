<?php



function iex_load_scripts_to_cotizador(){
	
	wp_register_style( 'bootstrap-style', IEX_URL . '/js/bootstrap/css/bootstrap.min.css');
	wp_enqueue_style( 'bootstrap-style' );
	
	wp_enqueue_style('select2_css', IEX_URL . '/js/plugins/select2/select2.min.css'); 	

	wp_register_script('jquery-1_11_2', IEX_URL . '/js/jquery-1_11_2.js',array('jquery'),"1.11.2",false);
	wp_enqueue_script('jquery-1_11_2');
	
	
	wp_enqueue_script('select2_js', IEX_URL . '/js/plugins/select2/select2.full.min.js');
	
	wp_register_script( 'bootstrap-js', IEX_URL . '/js/bootstrap/js/bootstrap.min.js', array('jquery'), "1", false );
	wp_enqueue_script( 'bootstrap-js' );
	
	wp_register_script( 'iex_cotizador-js', IEX_URL . '/js/libraries/iex_cotizador.js', array('jquery'), "1", false );
	wp_enqueue_script( 'iex_cotizador-js' );		

}

/**
 * 
 */
add_shortcode('iex_cotizador','iex_searcher_function');
function iex_searcher_function(){
	
	iex_load_scripts_to_cotizador();
		
	//start output buffering
 	ob_start();
	$template = IEX_DIR_PATH . "/templates/cotizador_template.php";

	load_template($template);

	//get content from buffer and output it
	$temp_content = ob_get_contents();
	ob_end_clean();	
	return $temp_content;	
}



/**
 * 
 */
add_shortcode('iex_cotizador_en','iex_searcher_en_function');
function iex_searcher_en_function(){
	
	iex_load_scripts_to_cotizador();
	
	//start output buffering
 	ob_start();
	$template = IEX_DIR_PATH . "/templates/cotizador_en_template.php";

	load_template($template);

	//get content from buffer and output it
	$temp_content = ob_get_contents();
	ob_end_clean();	
	return $temp_content;	
}


/**
 * 
 */
 add_shortcode('iex_maritime_search','iex_maritime_search_function');
 function iex_maritime_search_function(){
 	
	wp_enqueue_style('jquery-ui_css', IEX_URL . '/js/jquery-ui/jquery-ui.min.css');
	wp_enqueue_script('jquery-ui_js', IEX_URL . '/js/jquery-ui/jquery-ui.min.js');	
	
	
	wp_register_style( 'bootstrap-style', IEX_URL . '/js/bootstrap/css/bootstrap.min.css');
	wp_enqueue_style( 'bootstrap-style' );
	
	wp_enqueue_style('select2_css', IEX_URL . '/js/plugins/select2/select2.min.css'); 	

	wp_register_script('jquery-1_11_2', IEX_URL . '/js/jquery-1_11_2.js',array('jquery'),"1.11.2",false);
	wp_enqueue_script('jquery-1_11_2');
	
	
	wp_enqueue_script('select2_js', IEX_URL . '/js/plugins/select2/select2.full.min.js');
	
	wp_register_script( 'iex_maritime_search-js', IEX_URL . '/js/libraries/iex_maritime_search.js', array('jquery'), "1", false );
	wp_enqueue_script( 'iex_maritime_search-js' );
	
	//start output buffering
 	ob_start();
	$template = IEX_DIR_PATH . "/templates/maritime_search_template.php";

	load_template($template);

	//get content from buffer and output it
	$temp_content = ob_get_contents();
	ob_end_clean();	
	return $temp_content;	
 }
 