
<div style="height: 25px"></div>
<div class="container" style="padding-top:25px; background-color:  #1e73be; padding-bottom: 25px;">
	<div class="container_inner clearfix grid2">
		<div class="contact_detail">
			<div class="two_columns_33_66 clearfix">
				<div class="column1">
					<div class="column_inner">
						<img src="<?php echo IEX_URL;  ?>/images/btn_quote.png"/>
					</div>
				</div>
				<div class="column2">
					<div class="column_inner">
						<div class="contact_form" >
							<form id="iex_cotiza_form" methos="post">
								<input id="url_pl" type="hidden" value="<?php echo IEX_URL; ?>"/>
								<input id="url_aa" type="hidden" value="<?php echo admin_url("admin-ajax.php"); ?>"/>
								<div class="two_columns_50_50 clearfix">
									<div class="column1">
										<div class="column_inner">
											<input  type="text" id="iex_nombre_cotiza" name="iex_nombre_cotiza" class="form-control" placeholder="Name"/>
										</div>
									</div>
									<div class="column2">
										<div class="column_inner">
											<input type="text" class="form-control" id="iex_apellidos_cotiza" name="iex_apellidos_cotiza" placeholder="Last Name">
										</div>
									</div>
								</div>
								<div class="two_columns_50_50 clearfix">
									<div class="column1">
										<div class="column_inner">
											<input type="text" class="form-control" id="iex_tel_cotiza" name="iex_tel_cotiza" placeholder="Phone">
										</div>
									</div>
									<div class="column2">
										<div class="column_inner">
											<input type="email" class="form-control" id="iex_mail_cotiza" name="iex_mail_cotiza" placeholder="Email">
										</div>
									</div>								
								</div>
							    <div class="two_columns_50_50 clearfix" style="margin-bottom: 15px">
									<div class="column1">
										<div class="column_inner">
											<select id="iex_service_cotiza" name="iex_service_cotiza" class="js-example-basic-single" data-placeholder="Services">
												<option value="sa">Air Service</option>
												<option value="sm">Maritime Servie</option>
												<option value="st">Inland Service</option>
												<option value="da">Customs Clearance</option>
												<option value="sc">Insurance</option>
												<option value="al">Storage</option>
											</select>
										</div>
									</div>
									<div class="column2">
										<div class="column_inner">
										</div>
									</div>								
								</div>					
								<div id="" class="two_columns_50_50 clearfix">
									<div class="column1">
										<div class="column_inner">
											<input type="text" class="form-control" id="iex_origen_cotiza" name="iex_origen_cotiza" placeholder="Origin">
										</div>
									</div>
									<div class="column2">
										<div class="column_inner">
											<input type="email" class="form-control" id="iex_destino_cotiza" name="iex_destino_cotiza" placeholder="Destiny">
										</div>
									</div>								
								</div>
								<textarea id="iex_descripcion_cotiza" name="iex_descripcion_cotiza" rows="5" class="form-control" placeholder="Description"></textarea>
								<a href="#" id="btn_enviar_solicitud" target="_self" data-hover-background-color="#1d3662" data-hover-border-color="#1d3662" data-hover-color="#ffffff" class="qbutton small center" style="color: rgb(255, 255, 255); border-color: rgb(178, 208, 120); border-radius: 2px; background-color: rgb(178, 208, 120);">Send</a>
							</form>
						</div>
				</div>
			</div>
		</div>
	</div>
</div>