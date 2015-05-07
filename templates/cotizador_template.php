
<div style="height: 25px"></div>
<div class="container" style="padding-top:25px; background-color:  #1e73be; padding-bottom: 25px;">
	<div class="container_inner clearfix grid2">
		<div class="contact_detail">
			<div class="two_columns_33_66 clearfix">
				<div class="column1">
					<div class="column_inner">
						<img src="<?php echo IEX_URL;  ?>/images/btn_cotizador.png"/>
					</div>
				</div>
				<div class="column2">
					<div class="column_inner">
						<div class="contact_form" id="iex_cotiza_form">
							<form id="iex_cotiza_form" methos="post">
								<input id="url_pl" type="hidden" value="<?php echo IEX_URL; ?>"/>
								<input id="url_aa" type="hidden" value="<?php echo admin_url("admin-ajax.php"); ?>"/>
								<div class="two_columns_50_50 clearfix">
									<div class="column1">
										<div class="column_inner">
											<input  type="text" id="iex_nombre_cotiza" name="iex_nombre_cotiza" class="form-control" placeholder="Nombre"/>
										</div>
									</div>
									<div class="column2">
										<div class="column_inner">
											<input type="text" class="form-control" id="iex_apellidos_cotiza" name="iex_apellidos_cotiza" placeholder="Apellidos">
										</div>
									</div>
								</div>
								<div class="two_columns_50_50 clearfix">
									<div class="column1">
										<div class="column_inner">
											<input type="text" class="form-control" id="iex_tel_cotiza" name="iex_tel_cotiza" placeholder="Teléfono">
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
											<select id="iex_service_cotiza" name="iex_service_cotiza" class="js-example-basic-single" data-placeholder="Seleccione un servicio">
												<option value="sa">Servicio Aéreo</option>
												<option value="sm">Servicio Marítimo</option>
												<option value="st">Servicio Terrestre</option>
												<option value="da">Despacho Aduanal</option>
												<option value="sc">Seguro a la Carga</option>
												<option value="al">Almacenaje</option>
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
											<input type="text" class="form-control" id="iex_origen_cotiza" name="iex_origen_cotiza" placeholder="Origen"/>
										</div>
									</div>
									<div class="column2">
										<div class="column_inner">
											<input type="text" class="form-control" id="iex_date" name="iex_date" placeholder="Destino"/>
										</div>
									</div>								
								</div>
								<textarea id="iex_descripcion_cotiza" name="iex_descripcion_cotiza" rows="5" class="form-control" placeholder="Describe tu carga"></textarea>
								<a href="#" id="btn_enviar_solicitud" target="_self" data-hover-background-color="#1d3662" data-hover-border-color="#1d3662" data-hover-color="#ffffff" class="qbutton small center" style="color: rgb(255, 255, 255); border-color: rgb(178, 208, 120); border-radius: 2px; background-color: rgb(178, 208, 120);">Enviar solicitud</a>
							</form>
							<div style="height:20px"></div>
						</div>
						
				</div>
			</div>
		</div>
	</div>
</div>
