(function($){


    var $url_aa;

	function btnEnviarCotizacionHandler(event){
		event.preventDefault();
		var $form = event.data.form;
		
		
		$.ajax({
			url : $url_aa,
			type : 'GET',
			dataType : 'json',
			contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
			data : 'action=procesa_cotizacion&' + $form.serialize(),
			success:function(response){
						console.log("asfd");
				    }
		});	
	}
	
	
	
	$(document).on('ready',function(event){
		$url_aa = $('input#url_aa').val();
		var $selectService = $('#iex_service_cotiza');
		$selectService.select2();
		
		$('#btn_enviar_solicitud').on('click',{form:$('#iex_cotiza_form')},btnEnviarCotizacionHandler); 
	});

})($);