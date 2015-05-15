<div class="panel panle-default">


<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
  Launch demo modal
</button>
	<form id="iex_route_finder_form" name="iex_route_finder_form" action="" method="GET">
		<input id="url_pl" type="hidden" value="<?php echo IEX_URL; ?>"/>
		<input id="url_aa" type="hidden" value="<?php echo admin_url("admin-ajax.php"); ?>"/>
			<div class="panel-body">
				<div class="two_columns_50_50 clearfix">
				
					<div class="column1">
						<div class="column_inner">
							<div class="panel-body">
								<div class="two_columns_50_50 clearfix">
									<div class="column1">
										<div class="column_inner">
											<select id="iex_select_port" name="iex_select_port" style="width:200px"></select>
										</div>
									</div>
									<div class="column2">
										<div class="column_inner">
											<!--<input type="text" id="iex_date" name="iex_date"/>-->
										</div>
									</div>								
								</div>
							</div>				
						</div>
					</div>
					
					<div class="column2">
						<div class="column_inner">
							<div class="panel-body">
								<div class="two_columns_50_50 clearfix">
									<div class="column1">
										<div class="column_inner">
											<!--<input type="text" class="form-control" id="iex_tel_cotiza" name="iex_tel_cotiza" placeholder="Teléfono">-->
										</div>
									</div>
									<div class="column2">
										<div class="column_inner">
											<!--<input type="email" class="form-control" id="iex_mail_cotiza" name="iex_mail_cotiza" placeholder="Email">-->
										</div>
									</div>								
								</div>
							</div>					
						</div>
					</div>	
												
				</div><!-- .two_columns -->
				<a href="#" id="btn_route_finder" target="_self" data-hover-background-color="#1d3662" data-hover-border-color="#1d3662" data-hover-color="#ffffff" class="qbutton small center" style="color: rgb(255, 255, 255); border-color: rgb(178, 208, 120); border-radius: 2px; background-color: rgb(178, 208, 120);">Buscar</a>	
			</div>
	</form>
	<div id="result_container"></div>
</div>