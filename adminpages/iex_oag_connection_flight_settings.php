<?php

add_action('admin_menu','iex_oag_connection_flight_menu');
function iex_oag_connection_flight_menu(){
	add_submenu_page('iexsystem/adminpages/iex_system_settings.php','Connection Flights','Connection Flights','manage_options',__FILE__,'iex_oag_connection_flight_page');
}




function iex_oag_connection_flight_page(){
	?>
		<div class="wrap">
			<?php screen_icon(); ?>
			<h2>OAG Connection Flights HHH</h2>	
			<form action="options.php" method="post">
				
				<?php
					//Carga los valores del arreglo iex_oag_account instanciado en el script install.php
				    settings_fields('iex_connection_flight');
					
					//Carga la secciones registradas a nombre de 'iex_settings_page' 
					do_settings_sections('iex_oag_connection_flight_page');
				?>	
				<input type="submit" type="submit" value="Save Changes" />
			</form>	
		</div>
	<?php
}