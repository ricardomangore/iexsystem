(function($){

var $url_aa;


/**
 *selectBuqueListener 
 */
function selectBuqueListener(event){
    var $form = event.data.form;
	var valueBuque = $form.find('select#select_buque').val();
	array_buque = valueBuque.split('_');
	$form.find('input#alias_buque').attr('value',array_buque[3]);
}

/**
 * btnAddRutaListener 
 */
function btnAddRutaListener(event){
	var $form = event.data.form;
	var $table = event.data.table;

		$.ajax({
			url : $url_aa,
			type : 'GET',
			dataType : 'json',
			contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
			data : 'action=add_ruta&' + $form.serialize(),
			success:function(response){
						console.log(response.error);
						if(response[0].id !== undefined){
							$table.row.add([response[0].id, response[0].buque, response[0].viaje, response[0].puerto, response[0].eta, response[0].naviera, response[0].tipo, response[0].ruta_intermodal]).draw();
						}else if(response.error !== undefined){
							alert(response.error);
						}
				    },
		});	

}

/**
 * btnAddBuqueListener 
 */
function btnAddBuqueListener(event){
	var $form = event.data.form;
	var $table = event.data.table;

	$.ajax({
		url : $url_aa,
		type : 'GET',
		dataType: 'json',
		contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
		data: 'action=add_buque&' + $form.serialize(),
		error: function(jqXHR,textStatus,errorThrown){
			console.log(jqXHR);
			console.log( 'jq: ' + jqXHR + ": text :" + textStatus + ": errortrw :" +errorThrown );
		},
		success: function(response){
    			if(response.id !== undefined){
					$table.row.add([response.id,response.buque,response.alias,response.tipo, response.naviera, response.bandera, response.mmsi, response.imo]).draw();
				}else if(response.error !== undefined){
					alert(response.error);
				}else{
					alert("ERROR Inesperado: Reportelo a su administrador.");
				}

		} 
	});	
	
}

/**
 * btnAddPuertoListener 
 */
function btnAddPuertoListener(event){
    var $form = event.data.form;
    var $table = event.data.table;
	var valuePuerto = $form.find('select#select_puerto').val();
    
	$.ajax({
		url : $url_aa,
		type : 'GET',
		dataType: 'json',
		contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
		data:  {
					action: 'add_puerto',
					valuePuerto: valuePuerto
				},
		error: function(jqXHR,textStatus,errorThrown){
			console.log(jqXHR);
			console.log( 'jq: ' + jqXHR + ": text :" + textStatus + ": errortrw :" +errorThrown );
		},
		success: function(response){
				console.log(response.id);
    			if(response.id !== undefined){
					$table.row.add([response.id,response.locode,response.puerto,response.isocode, response.ciudad]).draw();
				}else if(response.error !== undefined){
					alert(response.error);
				}else{
					alert("ERROR Inesperado: Reportelo a su administrador.");
				}

		} 
	});
}


/**
 * chkBtnRutaIntemodalListener
 */
function chkBtnRutaIntemodalListener(event){
	$tagInput = event.data.tag;
	if($tagInput.attr('disabled') === 'disabled'){
		$tagInput.removeAttr('disabled');
		$tagInput.tooltip({
  content: "Awesome title!"
});
	}else{
		$tagInput.attr('disabled','disabled');
		$tagInput.val('');
	}
}

/**
 * 
 */
function initSelectBuque(action,processFunction,dataFunction){
	$("#select_buque").select2({
		ajax : {
			delay    : 250,
			url      : $url_aa + "?action=" + action,
			dataType : 'json',
			data: dataFunction,
			processResults: processFunction/*function (data) {
				var retorno = [];
				$.each(data,function(index,value){
					retorno.push({
						id : value.imo +"_"+ value.mmsi +"_"+ value.flag +"_"+ value.name +"_"+ value.type,
						text : value.name,
						imo: value.imo,
						mmsi: value.mmsi,
						flag: value.flag,
						type: value.type
					});
				});
		      return {
		        results: retorno
		      };
		    }*/,
		    cache: true
		},
		templateResult : function(buqueData){
			var $buque = $('<div id='+buqueData.imo +'_'+buqueData.mmsi+'><h4>'+buqueData.text+'</h4><ul><li>Bandera: '+ buqueData.flag +'</li><li>MMSI: '+ buqueData.mmsi+'</li><li>IMO: '+ buqueData.imo + '</li><li>Tipo : ' + buqueData.type +'</li></ul></div>');
			return $buque;
		},
		placeholder : "Seleccione un buque"
	});
}


/**
 * 
 */
function initSelectPuerto(action,processFunction){
	$("#select_puerto").select2({
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
			var $puerto = $('<h4>'+puertoData.text+' : ' + puertoData.country_name + '</h4>');
			return $puerto;
		},		
		placeholder : "Seleccione un puerto"
	});
}


/**
 * 
 */
function initSelectNaviera(processFunction){
	$("#select_naviera").select2({
		ajax : {
			delay    : 250,
			url      : $url_aa + "?action=get_naviera",
			dataType : 'json',
			data: function (params) {
				    var queryParameters = {
				      						q: params.term
				    					  };
				 
				    return queryParameters;
				  },
			processResults: processFunction,
		    cache: true
		},		
		placeholder : "Seleccione una naviera"
	});
}


/**
 * initDAtaTableBuques
 * 
 * Obtiene todas las navieras registradas
 */
function initDataTableBuques(url, $table){
    
    $.ajax({
    	url : url,
    	type : 'GET',
    	dataType: 'json',
    	contentType: 'application/x-www-form-urlencode; charset=UTF-8',
    	data : 'action=get_all_buques',
    	success: function(response){
					$table.rows.add(response).draw();
    			 }
    });
}



/**
 * getDataSetNavieras
 * 
 * Obtiene todas las navieras registradas
 */
function initDataTableNavieras(url, $table){
    
    $.ajax({
    	url : url,
    	type : 'GET',
    	dataType: 'json',
    	contentType: 'application/x-www-form-urlencode; charset=UTF-8',
    	data : 'action=get_all_navieras',
    	success: function(response){
					$table.rows.add(response).draw();
    			 }
    });
}

/**
 * initDataTablesRutas
 * 
 * Obtiene todas las navieras registradas
 */
function initDataTableRutas(url, $table){
    
    $.ajax({
    	url : url,
    	type : 'GET',
    	dataType: 'json',
    	contentType: 'application/x-www-form-urlencode; charset=UTF-8',
    	data : 'action=get_all_rutas',
    	success: function(response){
					$table.rows.add(response).draw();
    			 }
    });
}

/**
 * getDataSetPuertos
 * 
 * Obtiene todas las navieras registradas
 */
function initDataTablePuertos(url, $table){
    
    $.ajax({
    	url : url,
    	type : 'GET',
    	dataType: 'json',
    	contentType: 'application/x-www-form-urlencode; charset=UTF-8',
    	data : 'action=get_all_puertos',
    	success: function(response){
					$table.rows.add(response).draw();
    			 }
    });
}

/**
 * btn_add_naviera_listener
 * 
 * agrega un renglon a un data table 
 */
function btn_add_naviera_listener(event){
	event.preventDefault();
	var $table = event.data.table;
	var val = [ event.data.form.find('input[name=naviera]').val() ];
	
	
	$.ajax({
		url : event.data.form.find('input#url_aa').val(),
		type : 'POST',
		dataType: 'json',
		contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
		data: 'action=add_naviera&naviera='+ event.data.form.find('input[name=naviera]').val(),
		//error:function(){alert("error");},
		success:function(response){
					if(response.id !== undefined){
						$table.row.add([response.id,response.naviera]).draw();
					}else if(response.error !== undefined){
						alert(response.error);
					}else{
						alert("ERROR Inesperado: Reportelo a su administrador.");
					}
			    },
	}); 

}



function btnEditNavieraListener(event){
	event.preventDefault();
	console.log(event.data.form.serialize());
	$.ajax({
		url : event.data.form.find('input#url_aa').val(),
		type : 'POST',
		dataType : 'json',
		
	});
}

/**
 * Carga cuando todo el documento esta listo 
 */

$(document).ready(function(event){
    
    $url_aa = $('input#url_aa').val();
    var $formNaviera  = $('form[name=iex_navieras_admin_form]');
	var $formPuerto   = $('form[name=iex_puertos_admin_form]');
	var $formBuque    = $('form[name=iex_buques_admin_form]');
	var $formRuta     = $('form[name=iex_rutas_admin_form]'); 
    
    /**
     * Inicia la tabla de navieras cuando se encuentra en el documentdo adecuado 
     */
    if($('#naviera_table').length){
    		var $navieraTable = $('#naviera_table').DataTable();
			$('#naviera_table tbody').on( 'click', 'tr', function () {
		        if ( $(this).hasClass('selected') ) {//Si la clase 'selected' esta asignada
		            $(this).removeClass('selected');          
		        }
		        else {//Si la clase 'selected' no esta asignada
		        	dataNaviera = $navieraTable.row($navieraTable.row(this).index()).data();
		        	$('#btn_edit_naviera').removeAttr('disabled');
		            $('#btn_delete_naviera').removeAttr('disabled');
		            $('input#id_naviera').attr('value',dataNaviera[0]);
		            $('input#naviera').attr('value',dataNaviera[1]);
		            $navieraTable.$('tr.selected').removeClass('selected');
		            $(this).addClass('selected');
		        }
		    } );
		    
		    
    		initDataTableNavieras($('form[name=iex_navieras_admin_form]').find('input#url_aa').val(), $navieraTable);
    }
    if($('#puerto_table').length){
    	var $puertoTable = $('#puerto_table').DataTable();
    	initDataTablePuertos($('form[name=iex_puertos_admin_form]').find('input#url_aa').val(), $puertoTable);
    }
    if($('#buque_table').length){
    	var $buqueTable = $('#buque_table').DataTable();
    	initDataTableBuques($('form[name=iex_buques_admin_form]').find('input#url_aa').val(), $buqueTable);
    }
    if($('#ruta_table').length){
    	var $rutaTable = $('#ruta_table').DataTable();
    	initDataTableRutas($('form[name=iex_rutas_admin_form]').find('input#url_aa').val(), $rutaTable);
    }
   
   
	if($('form[name=iex_puertos_admin_form]').length){
		initSelectPuerto('get_puerto',function (data) {
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
		    });
	}
	if($('form[name=iex_buques_admin_form]').length){
		initSelectBuque('get_buque',
			     function (data) {
					var retorno = [];
					$.each(data,function(index,value){
						retorno.push({
							id : value.imo +"_"+ value.mmsi +"_"+ value.flag +"_"+ value.name +"_"+ value.type,
							text : value.name,
							imo: value.imo,
							mmsi: value.mmsi,
							flag: value.flag,
							type: value.type
						});
					});
			      return {
			        results: retorno
			      };
			    },
			    function (params) {
				    var queryParameters = {
				      						q: params.term
				    					  };
				 
				    return queryParameters;
				}
		    );
		initSelectNaviera(
			function (data) {
				var retorno = [];
				$.each(data,function(index,value){
					retorno.push({
						id : value.id + "_" + value.text,
						text : value.text,
					});
				});
		      return {
		        results: retorno
		      };
		    }
		);	
		$('#select_buque').on('change',{'form': $formBuque}, selectBuqueListener);	
	}
	/**
	 *Rutas Marítimas 
	 */
	if($('form[name=iex_rutas_admin_form]').length){
		initSelectBuque('get_buquedb',
			   function (data) {
					var retorno = [];
					$.each(data,function(index,value){
						retorno.push({
							id : value.id_vessel,
							text : value.name,
							imo: value.imo,
							mmsi: value.mmsi,
							flag: value.flag,
							type: value.type
						});
					});
			      return {
			        results: retorno
			      };
			    },
			    function (params) {
				    var queryParameters = {
				      						q: params.term,
				      						id_naviera: $('#select_naviera').val().split('_')[0]
				    					  };
				 
				    return queryParameters;
				}
		    );
		initSelectNaviera(
			function (data) {
				var retorno = [];
				$.each(data,function(index,value){
					retorno.push({
						id : value.id,
						text : value.text,
					});
				});
		      return {
		        results: retorno
		      };
		    }
		);
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
		$("#select_tipo_ruta").select2();
		$("#eta").datepicker();			
	}	
	
							
	$formNaviera.on('submit',function(event){
		event.preventDefault();
		return false;
	});
	$formPuerto.on('submit',function(event){
		event.preventDefault();
		return false;
	});
	$formBuque.on('submit',function(event){
		event.preventDefault();
		return false;
	});
	$formRuta.on('submit',function(event){
		event.preventDefault();
		return false;
	});

	$('button#btn_add_naviera').on('click',{'table': $navieraTable, 'form': $formNaviera}, btn_add_naviera_listener);
	$('button#btn_edit_naviera').on('click',{'form' : $formNaviera},btnEditNavieraListener);
	$('button#btn_add_puerto').on('click',{'table': $puertoTable, 'form': $formPuerto}, btnAddPuertoListener);
	$('button#btn_add_buque').on('click',{'table': $buqueTable, 'form': $formBuque}, btnAddBuqueListener);
	$('button#btn_add_ruta').on('click',{'table': $rutaTable, 'form': $formRuta}, btnAddRutaListener);
	$('#chk_ruta_intermodal').on('change',{'tag':$('#nombre_ruta_intermodal')},chkBtnRutaIntemodalListener);	
});



})($);
