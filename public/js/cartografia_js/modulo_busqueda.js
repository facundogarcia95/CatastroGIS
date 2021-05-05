/*====================
AUTOCOMPLETAR CALLES
======================*/
function autoCompletarCalles() {

	$.ajax({
		 url: 'callesAutocompletar',
		 type: 'get',
		 data: {},
		 success: function(response) {
				console.log(response);
			  $("#nombre_calle").autocomplete({ // Completo el selector con barrios
					autoFocus: false,
					minLength: 3,
					source: response.calles,
					open: function() {
						 setTimeout(function() {
							  $('.ui-autocomplete').css('z-index', 9999);
						 }, 0);
						 $(".ui-helper-hidden-accessible").css("display", "none");
					},
					select: function(event, ui) {
					}
			  });
		 },
		 error: function(resp) {
			  console.log(resp);
		 }
	});

}


/*=============================
AUTOCOMPLETAR TITULARES
===============================*/

function autoCompletarTitulares() {

	/*===================
		SE DEJA COMENTADO HASTA QUE SE SOLUCIONE LA CARGA DE TITULARES, SON MAS DE 1 MILLÓN
	====================*/
	/*$.ajax({
		 url: 'titularesAutocompletar',
		 type: 'get',
		 data: {},
		 success: function(response) {

			  $("#titularesParcelas").autocomplete({ // Completo el selector con barrios
					autoFocus: false,
					minLength: 3,
					source: response.personas,
					open: function() {
						 setTimeout(function() {
							  $('.ui-autocomplete').css('z-index', 9999);
						 }, 0);
						 $(".ui-helper-hidden-accessible").css("display", "none");
					},
					select: function(event, ui) {
						$("#persona_id").val(ui.item.id)
					}
			  });
		 },
		 error: function(resp) {
			  console.log(resp);

		 }
	});*/

}


/*=============================
BUSCAR DIRECCION SELECCIONADA
===============================*/

$(".buscarPorPersona").on("click",function(){

	let persona_denominacion = $("#titularesParcelas").val();

	$.ajax({
		type: "GET",
		url: 'buscarPersonaParcela',
		data: {persona: persona_denominacion},
		success: function (data) {

			console.log(data);
			if(data.parcelas.length > 0){

				$("#abrirmodalConsulta").modal('hide');

				let HTML = `<div class="row" style="overflow-y: scroll; max-height: 70vh !important;">
									<div class="col-sm-12"> 
										<table class="table table-striped">
										<thead class="bg-catastro">
												<th colspan="2" class="text-center text-light font-weight-bold">PARCELAS ENCONTRADAS PARA `+persona_denominacion+`</th>
										</thead>
										<tbody class="w-100" style="overflow-y: auto; max-height: 400px;">
										<tr class="bg-dark"><td class="text-center text-light font-weight-bold">NOMENCLATURA</td><td class="text-center text-light font-weight-bold">RELACIÓN</td></tr>`;
										
										for(i=0; i<data.parcelas.length; i++){
											HTML = HTML + '<tr><td><a class="text-catastro" style="cursor:pointer" onclick="buscarPorNomenclatura('+"'"+data.parcelas[i].parcela_nomenclatura+"'"+')"><u>'+data.parcelas[i].parcela_nomenclatura+'</u></a></td>\
																		<td><label  class="text-catastro">'+data.parcelas[i].tipo_persona_parcela_descrip+'</label></td></tr>'
										}

										HTML = HTML + '</tbody></table></div></div>';

				
				Swal.fire({

					position: 'top-start',
					backdrop: false,
					title: '',
					imageUrl: './img/logo_las_heras.png',
					width:'auto',
					scrollbarPadding: true,
					html: HTML,
					showCancelButton: true,
					showConfirmButton: false,
					cancelButtonText: "Cerrar"

					}).then((result) => {
						
						if (result.dismiss == "cancel") {

							Seleccionsource.clear();//vacia el vector de datos
							highlightLayerSource.clear('');
							$("#abrirmodalConsulta").modal('show');


						}
				})

			}else{

				Swal.fire({
					position: 'center',
					type: 'error',
					title: 'Ups! No se encontraron registros.',
					showConfirmButton: true,
					timer: 3500
				});

			}

		},error: function (response){
			console.log(response);
		}
	});
});
/*=============================
BUSCAR DIRECCION SELECCIONADA
===============================*/


function buscarDireccion(calle,numero){

	$.ajax({
		url: 'buscarDireccion',
		data: { calle: calle,
				numeracion: numero
				},
		type: 'get',
		success: function(response) {

			if(response.success){

				var eje = response.eje_encontrado[0];

				var view = new ol.View({
					center: [eje.st_x, eje.st_y],
					zoom: 20,
					minZoom: 11,
					maxZoom: 21
				});
				map.setView(view);

				$("#abrirmodalConsulta").modal("hide")

				if(response.warning){
					SwalAlertHtml("Busqueda no encontrada", 
					"<label class='f-14'>"+response.warning+"</label>",
					"top-end")
				}

			}else{

				SwalAlertHtml("Busqueda no encontrada", 
				"<label class='f-14'>Lo sentimos, no hemos podido localizar la dirección</label>",
				"top-end")

			}
		
			
		},
		error: function(response) {

			console.log(response);

			SwalAlertHtml("Busqueda no encontrada", 
				"<label class='f-14'>Lo sentimos, no hemos podido localizar la dirección</label>",
				"top-end")

		}
	  });
	
}

$(".buscarDireccion").on("click",function(){

	

	if( $("#nombre_calle").val() != "" && $("#numeracion_calle").val() != ""){

		$("#nombre_calle").removeClass("border border-warning");
		$("#numeracion_calle").removeClass("border border-warning");
		
		buscarDireccion($("#nombre_calle").val(),$("#numeracion_calle").val());
		
	}else{
			SwalAlertHtml("Busqueda no realizada", 
					"<label class='f-14'>Debe completar ambos campos</label>",
					"top-end")

					if($("#nombre_calle").val() == "")
					$("#nombre_calle").addClass("border border-warning");
			
					if($("#numeracion_calle").val() == "")
					$("#numeracion_calle").addClass("border border-warning");

	}

	});


/*===========================
BUSQUEDA POR PADRON O NOMENCLATURA
============================*/	

$(".buscarPadronNomencla").on("click",function(){
	
		var dato = $("#padronNomencla_busqueda").val().trim();
		var nomencla;

		if(dato != "" ){

			if(dato.length >= 16){

				nomencla = buscarPorNomenclatura(dato);

			}else{

				nomencla = busquedaPorPadron(dato);

			}
	

				
			if(!nomencla){
					
					Swal.fire({
								position: 'center',
								type: 'error',
								title: 'Ups! No se encontraron registros.',
								showConfirmButton: true,
								timer: 3500
						});

			}

				$("#abrirmodalConsulta").modal("hide")

		 
		}else{

			Swal.fire({
					position: 'center',
					type: 'error',
					title: 'El campo no puede estar vacío.',
					showConfirmButton: true,
					timer: 3500
			});

		}

})

/*==================
BUSCO PARCELA A PARTIR DE UN PADRÓN MUNICIPAL
====================*/

function busquedaPorPadron(text){
	

	var nomencla = null; 

	$.ajax({
	  type:'get',
	  url: URLBASE+'parcelaPorParametro',
	  data:{parametro : "parcela_padron", valor: text},
	  async: false,
	  success:function(data) {
		  
		if (data.success) {

					$.ajax({
						type:'get',
						url: URLBASE+"extendParcela",
						data:{nomencla : data.parcela.parcela_nomenclatura.substr(0,20)},
						async: false,
						success:function(data) {
							
							console.log(data);
							if (data.success) {
								
											dibujarPoligono(data.center);							
			
											nomencla = data.nomenclatura;
											datos = data;
			
							}
			
						},error: function(data){
			
								console.log(data,"error");
											
									highlightLayerSource.clear('');
	
									const Toast = Swal.mixin({
										toast: true,
										position: 'top-end',
										showConfirmButton: false,
										timer: 7000,
										timerProgressBar: true,
										didOpen: (toast) => {
										toast.addEventListener('mouseenter', Swal.stopTimer)
										toast.addEventListener('mouseleave', Swal.resumeTimer)
										}
									})
									
									Toast.fire({
										type: 'error',
										html: 'No se encontró en cartografía.  <br/> Verifique que la nomenclatura correspondiente exista en el parcelario.'
									})
								
							
									}
			
							});

				return data.parcela.parcela_nomenclatura;
			}

	  },error: function(data){
			console.log(data.responseText); 
	  }
	});

	return nomencla;

}

/*==================
BUSCO PARCELA A PARTIR DE UNA NOMENCLATURA
====================*/

function buscarPorNomenclatura(text){

	var nomencla = null; 
	var datos = null; 

	$.ajax({
	  type:'get',
	  url: URLBASE+"extendParcela",
	  data:{nomencla : text},
	  async: false,
	  success:function(data) {
			if (data.success) {
									
				dibujarPoligono(data.center);
						
				nomencla = data.nomenclatura;
				datos = data;

			}else{
				highlightLayerSource.clear('');
			}
		},error: function(data){

				console.log(data,"error");
						
						highlightLayerSource.clear('');

						const Toast = Swal.mixin({
							toast: true,
							position: 'top-end',
							showConfirmButton: false,
							timer: 7000,
							timerProgressBar: true,
							didOpen: (toast) => {
							  toast.addEventListener('mouseenter', Swal.stopTimer)
							  toast.addEventListener('mouseleave', Swal.resumeTimer)
							}
						 })
						 
						 Toast.fire({
							type: 'error',
							html: 'No se encontró en cartografía.  <br/> Verifique que la nomenclatura correspondiente exista en el parcelario.'
						 })
					
		
				}

		});
	
		return datos;
}