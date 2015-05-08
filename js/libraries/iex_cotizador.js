(function($){


    var $url_aa;

	function btnEnviarCotizacionHandler(event){
				$('#iex_wait').remove();
				$('#iex_message').remove();
		
		var $form = event.data.form;
        //alert($form.serialize());
		$.ajax({
			url : $url_aa,
			type : 'GET',
			dataType : 'json',
			contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
			data : 'action=procesa_cotizacion&' + $form.serialize(),
			beforeSend: function(){
				$('#iex_cotiza_form').append('<div id="iex_wait">Procesando su cotización...</div>');
			},
			success:function(response){
						$('#iex_wait').remove();
						$('#iex_cotiza_form').append('<div id="iex_message" class="alert alert-success" role="alert" style="margin-top:20px"> <button type="button" id="iex_close_message" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Su cotización ha sido enviada. <strong>Agradecemos su interes en nuestros servicios.</strong></div>');
						$('#iex_message').delay(7000).fadeOut('slow');
						$('#iex_close_message').on('click',function(event){
							$('#iex_message').remove();
						});
				    },
			complete: function(){
				$('#iex_wait').remove();
			}
		});
		event.preventDefault();	
	}
	
	
	
	$(document).on('ready',function(event){
		$url_aa = $('input#url_aa').val();
		var $selectService = $('#iex_service_cotiza');
		$formCotiza = $('#iex_cotiza_form');
		$selectService.select2();
		$('#btn_enviar_solicitud').on('click',{'form': $formCotiza},btnEnviarCotizacionHandler); 
	});

})($);