(function($){


var $url_aa;
var $url_pl;

function createTablePorts(data){
    var strHtml = '<table class="table table-stripped"><thead><th><img src="'+ $url_pl+'/images/anchor.png" width="20" height="20" style="margin-right:10px"/>PUERTO</th><th><img src="'+ $url_pl+'/images/calendar.jpg" width="20" height="20" style="margin-right:10px"/>ETA</th></thead><tbody>';
	$.each(data,function(index,value){
		strHtml +='<tr><td>'+ value.puerto +'</td><td>'+ value.eta +'</td></tr>'; 
	});
	strHtml += '<tbody></table>';
	return strHtml;
}


/**
 * 
 */
function createTable(data){
	$('#result_container').empty();
	if(data.error != undefined){
		var str = 'No se encontraron itinerarios';
	}else{
		var str = '<table class="table">';
		str += '<thead><tr><th></th></thead>';
		$.each(data,function(index,value){
			str += '<tr><td><div><img src="'+ $url_pl+'/images/vessel.png" width="60" height="60" style="margin-rigth: 10px"/></div><div><h2>' + value.buque +'</h2><h3><small> Viaje: '+ value.viaje +'</small></h3>';
			str += '<form name="form_'+value.viaje +'">';
			//str +=    '<input type="hidden"/>';
			//str +=    '<button type="button" class="btn btn-primary">Cotizar</button>';
			str += '</form>';
			str += '</td><td><p></div>'+ createTablePorts(value.puertos) +'</p></td></tr>';
			console.log(value.puertos.puerto);
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
	$url_pl = $('input#url_pl').val();
	
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