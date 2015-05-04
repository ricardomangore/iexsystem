(function($){


var $url_aa;
/**
 * 
 */
function createTable(data){
	$('#result_container').empty();
	if(data.error != undefined){
		var str = 'No se encontraron itinerarios';
	}else{
		var str = '<table class="table table-hover">';
		str += '<thead><tr><th>Viaje</th><th>Buque</th><th>Puerto</th><th>ETA</th></tr></thead>';
		$.each(data,function(index,value){
			str += '<tr><td>' + value.viaje + '</td><td>' + value.buque + '</td><td>' + value.puerto + '</td><td>' + value.eta + '</td></tr>';
		});
	}
	str += '</table>';
	$('#result_container').append(str);	
}

/**
 * 
 */
function btnRouteFinderHandler(event){
	var $form = event.data.form;
	
	$.ajax({
		url : $url_aa,
		type : 'GET',
		dataType : 'json',
		contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
		data : 'action=get_routes_by_port&' + $form.serialize(),
		success:function(response){
					createTable(response);//$('#result_container').append('<p>asdfasdf</p>');
			    }
	});
}

/**
 * 
 */
function initSelectPuerto(action,processFunction){
	$("#iex_select_port").select2({
		ajax : {
			delay    : 250,
			url      : $url_aa + "?action=" + action,
			dataType : 'json',
			data: function (params) {
				    var queryParameters = {
				      						q: params.term
				    					  };
				 
				    return queryParameters;
				  },
			processResults: processFunction/*function (data) {
				var retorno = [];
				$.each(data,function(index,value){
					retorno.push({
						id : value.locode + "_" + value.country_isocode + "_" + value.country_name +"_"+ value.name,
						text : value.name,
						country_isocode: value.country_isocode,
						country_name: value.country_name
					});
				});
		      return {
		        results: retorno
		      };
		    }*/,
		    cache: true
		},
		templateResult : function(puertoData){
			var $puerto = $('<div>'+puertoData.text+' : ' + puertoData.country_name + '</div>');
			return $puerto;
		},		
		placeholder : "Seleccione un puerto"
	});
}



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
					console.log(response);
			    }
	});	
}



$(document).on('ready',function(event){
	
	$url_aa = $('input#url_aa').val();
	
	
	initSelectPuerto('get_puertodb',function (data) {
		var retorno = [];
		$.each(data,function(index,value){
			retorno.push({
				id : value.id_port,
				text : value.name,
				country_isocode: value.country_isocode,
				country_name: value.country_name
			});
		});
      return {
        results: retorno
      };
    });
	
	
	$('#btn_route_finder').on('click',{form:$('#iex_route_finder_form')},btnRouteFinderHandler);
});


})($);