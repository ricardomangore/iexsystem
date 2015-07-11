
<div class="panel panel-default">
	<div class="panel-body">
	
		<div style="height:20px"></div>
		
		<form id="cafod_form" action="#" method="post" class="form-horizontal" data-toggle="validator" role="form">
			<input id="url-p" type="hidden" value="<?php echo IEWS_DIR_URL; ?>"/>
			<input id="url-aa" type="hidden" value="<?php echo admin_url("admin-ajax.php");?>"/>

			<div class="form-group">
				<label class="col-sm-3 control-label">Origen:</label>
				<select name="origen" class="selectpicker with-ajax selectpicker-iatacode-by-city" data-live-search="true" required></select>
				<div class="help-block with-errors"></div>
			</div><!-- .form_group -->

			<div class="form-group">
				<label class="col-sm-3 control-label">Destino:</label>
				<select name="destino" class="selectpicker with-ajax selectpicker-iatacode-by-city" data-live-search="true" required></select>
				<div class="help-block with-errors"></div>		
			</div><!-- .form-group -->
			
			<div class="form-group">
				<label class="col-sm-3 control-label">Fecha:</label>
				<button class="btn btn-link" id="fecha-help" data-toggle="popover" data-trigger="focus" data-content="Ingrese la fecha con el formato YYYY-mm-dd, ej: <?php echo date("Y-m-d");?>"><span class="glyphicon glyphicon-question-sign" aria-hidden="true" ></span></button>
				<div class="col-sm-3">
					<input type="text" name="fecha" class="form-control" value="<?php echo date("Y-m-d");?>" placeholder="<?php echo date("Y-m-d");?>" pattern="^(19|20)\d\d([- /.])(0[1-9]|1[012])\2(0[1-9]|[12][0-9]|3[01])$" maxlength="10" data-error="Por favor, llene correctamente el campo de Fecha" tabindex="3" required/>
					<div class="help-block with-errors"></div>
				</div>
			</div><!-- .form-group -->

			
			<div class="row">		
			<div class="form-group">
				<div class="col-sm-5 col-md-offset-3">
			    	<button id="btn-cafod-search" type="button" class="btn btn-primary" tabindex="4"><span class="glyphicon glyphicon-search" aria-hidden="true" ></span>Buscar</button>
				</div>
			</div>
			</div>
		</form>
		<!-- Formulario de búsqueda -->


		<!-- Alert Content -->
		<div class="row">
			<div id="alert-content" class="col-md-6 col-md-offset-3"></div>
		</div>
		<!-- Alert Content -->
		<!-- Contenedor de la tabla -->
		<div id="retrieve_flights_content"></div>
		<!-- -->

	</div><!-- -.pale-body -->
</dvi><!-- .panel-default -->