<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Expires" content="0">
<meta http-equiv="Last-Modified" content="0">
<meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
<meta http-equiv="Pragma" content="no-cache">
<title>UNION</title>
<script src="./jquery.3.5.1.min/jquery-3.5.1.min.js"></script>
<script src="./jquery-ui-1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="./jquery-ui-1.12.1/jquery-ui.css">
<script src="general.js?<?php rand().rand().rand() ?>" charset="utf-8"></script>
<script src="union.js?<?php rand().rand().rand() ?>" charset="utf-8"></script>

    <!-- Cartografia -->
    <link rel="stylesheet" href="./ol_5_3_0/ol.css" type="text/css" charset="utf-8">
    <script src="./ol_5_3_0/ol.js" charset="utf-8"></script>
	<style>
	body {
	   margin: 0;
	   padding: 0;
	}
      #map {
        width: 100% !important;
        height: 100% !important;
      }
	  .pagina{
		  width: 100%;
		  overflow: hidden;
   		  position: relative;
		  /*padding: 10px;*/
	  }

	  .buscador{
		  width: 200px;
		  padding: 12px 20px;
		  margin: 8px 15px 8px 0px;
		  border: 1px solid #ccc;
		  border-radius: 4px;
		  box-sizing: border-box;	
	  }

	  .cantidad{
		  margin: auto;
		  width: 150px;
		  padding: 12px 20px;
		  margin: 8px 0;
		  border: 1px solid #ccc;
		  border-radius: 4px;
		  box-sizing: border-box;	  
	  }
	  
		.botones {
			color: #fff;
			background-color: #20a8d8;
			border-color: #20a8d8;
			border-radius: 2px;
			display: inline-block;
			font-weight: normal;
			text-align: center;
			white-space: nowrap;
			vertical-align: middle;
			-webkit-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			user-select: none;
			border: 1px solid transparent;
			padding: 0.5rem 0.75rem;
			font-size: 0.875rem;
			line-height: 1.25;
			transition: all 0.15s ease-in-out;
			margin: 5px;
		}

		.botones span {
		  cursor: pointer;
		  display: inline-block;
		  position: relative;
		  transition: 0.5s;
		}
		.botones:hover {
		  background-color: #1B8EB7;
		}

/*
		.botones span:after {
		  content: '\00bb';
		  position: absolute;
		  opacity: 0;
		  top: 0;
		  right: -20px;
		  transition: 0.5s;
		}

		.botones:hover span {
		  padding-right: 15px;
		}

		.botones:hover span:after {
		  opacity: 1;
		  right: 0;
		}*/

		.spanFijo{
			  display: inline-block;
			  border-radius: 2px;
			  background-color: #e6e6e6;
			  border: none;
			  color: #000;
			  text-align: center;
			  /*font-size: 20px;*/
			  padding: 10px;
			  width: auto;
			  transition: all 0.5s;
			  margin: 5px;			
			  /*border: 1px solid #ccc;
		 	  border-radius: 4px;
		      box-sizing: border-box;*/
		}

		.subtituloFijo{
			  display: inline-block;
			  border-radius: 2px;
			  background-color: #e6e6e6;
			  border: none;
			  color: #000;
			  text-align: center;
			  padding: 7px;
			  width: auto;
			  transition: all 0.5s;
			  margin: 5px 5px 5px 0px;			
		}

		  .lists{
			  width: 200px;
			  padding: 8px 15px;
			  margin: 8px 15px 8px 0px;
			  border: 1px solid #ccc;
			  border-radius: 4px;
			  box-sizing: border-box;	
		  }

		  .completarDatosClass{
		  	  background-color: #E5D3D2;
			  padding: 15px;
		  }



#union{
	  border-top: 3px solid #C2CFD6;
}
#busqueda{
	  border-bottom: 3px solid #C2CFD6;
}

	  .nomenclas{
		  padding: 6px 10px;
		  margin: 8px 0px 8px 3px;
		  border: 1px solid #ccc;
		  border-radius: 4px;
		  box-sizing: border-box;	
	  }

		input[type=checkbox]
		{
		  /* Double-sized Checkboxes */
		  -ms-transform: scale(1.5); /* IE */
		  -moz-transform: scale(1.5); /* FF */
		  -webkit-transform: scale(1.5); /* Safari and Chrome */
		  -o-transform: scale(1.5); /* Opera */
		  transform: scale(1.5);
		  padding: 10px;
		  margin: 10px;
		}

		div.scrollable {
		    width: 100%;
		    margin: 0;
		    padding: 0;
		    overflow-y: scroll;

		}

		.hov{
			background-color: #FFF;
		}

		.hov:hover{
			background-color: #DF8482;
		}

		.hovSel{
			background-color: #DF8482 !important;
		}

		/* Start by setting display:none to make this hidden.
   Then we position it in relation to the viewport window
   with position:fixed. Width, height, top and left speak
   for themselves. Background we set to 80% white with
   our animation centered, and no-repeating */
.modal {
    display:    none;
    position:   fixed;
    z-index:    1000;
    top:        0;
    left:       0;
    height:     100%;
    width:      100%;
    background: rgba( 255, 255, 255, .8 ) 
                url('http://i.stack.imgur.com/FhHRx.gif') 
                50% 50% 
                no-repeat;
}

/* When the body has the loading class, we turn
   the scrollbar off with overflow:hidden */
body.loading .modal {
    overflow: hidden;   
}

/* Anytime the body has the loading class, our
   modal element will be visible */
body.loading .modal {
    display: block;
}


	.sidepanel  {
	  width: 0;
	  position: absolute;
	  z-index: 2;
	  height: 100%;
	  left: 0;
	  background-image: linear-gradient(#F0F3F5, #F0F3F5, #F0F3F5);
	  overflow-x: hidden;
	  transition: 0.5s;
	  padding-top: 20px;
	  border-radius: 0px 20px 20px 0px;
	}
	.sidepanel a {
	  padding: 8px 8px 8px 32px;
	  text-decoration: none;
	  font-size: 25px;
	  color: #BA3D48;
	  display: block;
	  transition: 0.3s;
	}

	.sidepanel a:hover {
	  color: #f1f1f1;
	}

.sidepanel .closebtn {
  position: absolute;
  top: 5px;
  right: 20px;
  font-size: 30px;
  color: #000;
  padding: 0;
	background: transparent;
	border: 0;
}

.openbtn {
  font-size: 20px;
  cursor: pointer;
  background-color: #111;
  color: white;
  padding: 10px 15px;
  border: none;
}

.openbtn:hover {
  background-color:#444;
}

</style>
<script type='module' src='index.js'></script>
</head>
<body>
<input type='button' id='opciones' onclick='openNav()' class='ui-btn ui-btn-inline ui-corner-all ui-shadow botones' style='position: absolute;left: 80px; margin-top: 15px; z-index: 1; font-size: 16px; font-weight: 100;' value='Unir Parcelas'></input>
<div id='1j' class='pagina'>	
    <div id='panelIzquierdo' class='sidepanel'>
        <a href='javascript:void(0)' class='closebtn' onclick='closeNav()'><span aria-hidden="true" class="text-light">×</span></a>
        <div id='busqueda' class='ui-widget' align='center' style='padding: 5px;'>
            <label for='tags'></label> 
            <font size="2"><input maxlength='21' placeholder='Padrón o Nomenclatura...' class='buscador' id='tags' onkeyup='valid()'></font>
            </br>
            <button id='confNom' class='botones' style='display:none;' onclick='validarNomenclatura(2)'><span>Validar</span></button>
            <button id='canNom' class='botones' style='display:none;' onclick='limpiar(1)'><span>Cancelar</span></button>
        </div>
        <div class=''>
            <div id='completarDatosUnion' class='completarDatosClass' style='display:none;'>
                <span style='font-weight: bold;'>Parcelas a unir</span>
                <div style='padding-top: 10px;' id='parcelasAUnir'></div>
                <div id='datosUnion' style='padding-top: 5px;'>
                    <div style='padding:30px;'><span style='font-weight: bold;'>Nueva Nomenclatura</span></div>
                
                    <div id='nuevaNomenclaturaDiv' nomenclaTemproal='0' confirmarvalue='1' name='nuevaNomenclaturaDiv' style='display:none; background-color:#FFF;width: auto; '>
						<br>
						<div style='padding:0px 5px 0px 5px;'>
							<label for='tipo_nomenclatura_union'>Tipo de Nomenclatura:</label>
							<select name='tipo_nomenclatura' id='tipo_nomenclatura_union' onchange='nomProvisoriaUnion(this)'>
								<option value='Provisoria'>Provisoria</option>
								<option value='Antigua'>Antigua</option>
								<option value='Posicional'>Posicional</option>
							</select>
							<input id='dependenciaUnion' title='Dependencia' style='background-color: #e6e6e6; display:none; ' readonly='' class='desgloses nomenclas' autocomplete='off' size='2' maxlength='2' name='' onkeyup='datosUnionATemporal(datosUnionATemporal);' type='textbox' value=''/>
							<input id='distritoUnion' title='Distrito' readonly='' style='background-color: #e6e6e6; display:none; ' class='desgloses nomenclas' autocomplete='off' size='2' maxlength='2' name='' onkeyup='datosUnionATemporal();' type='textbox' value=''/>
							<input id='seccionUnion' title='Seccion' readonly='' style='background-color: #e6e6e6; display:none; ' class='desgloses nomenclas' autocomplete='off' size='2' maxlength='2' name='' onkeyup='datosUnionATemporal();' type='textbox' value=''/>
							<input id='manzanaUnion' title='Manzana' readonly='' style='background-color: #e6e6e6; display:none; ' class='desgloses nomenclas' autocomplete='off' size='4' maxlength='4' name='' onkeyup='datosUnionATemporal();' type='textbox' value=''/>
							<input id='parcelaUnion' title='Parcela' readonly='' style='background-color: #e6e6e6; display:none; ' class='desgloses nomenclas' autocomplete='off' size='6' maxlength='6' name='' onkeyup='datosUnionATemporal(1);' type='textbox' value='' />
							<input id='parcelaX' title='Coordenada X' maxlength='7' placeholder='Coordenada X' style='background-color: #fff; display:none; ' class='desgloses nomenclas' autocomplete='off' size='7' maxlength='7' name='' onkeyup='datosUnionATemporal(1);' type='textbox' value='' />
							<input id='parcelaY' title='Coordenada Y' maxlength='7' placeholder='Coordenada Y' style='background-color: #fff; display:none; ' class='desgloses nomenclas' autocomplete='off' size='7' maxlength='7' name='' onkeyup='datosUnionATemporal(1);' type='textbox' value='' />
							<input id='subparcelaUnion' title='Subparcela' readonly='' style='background-color: #e6e6e6; display:none; ' class='desgloses nomenclas' autocomplete='off' size='4' maxlength='4' name='' onkeyup='datosUnionATemporal();' type='textbox' value='' />
							<img id='validacionNomenclaUnion' style='' src='./imgs/ok.png' alt='Validacion' width='15' height='15'> <br>
							<!--<input type='checkbox' checked='' id='checkProvisoria' onclick='nomProvisoriaUnion(this)'/>NOMENCLATURA PROVISORIA-->
						</div>
                    </div>

                    <div style='padding-top:15px; font-weight: bold;'><span>Titular (principales)</span></div>
                    <div><select class='lists' name='nuevoTitular' onchange='datosUnionATemporal()' id='nuevoTitular'><option value='primerOpcion'>Seleccionar..</option></select></div>
                    <div style='padding-top:5px; font-weight: bold;'><span>Direccion (real)</span></div>
                    <div><select class='lists' name='nuevaDireccion' onchange='datosUnionATemporal()' id='nuevaDireccion'><option value='primerOpcion'>Seleccionar..</option></select></div>
                    <div style='padding-top:5px; font-weight: bold;'><span>Expediente</span></div>
                    <div><input class='buscador' name='nuevoExpediente' onkeyup='datosUnionATemporal();' id='nuevoExpediente' maxlength='30' type='textbox'></input></div> 						
                </div>
            </div>
        </div>
    
        <div id='union' align='center' style='display:block; padding:15px 15px 25px 15px;'>
            <button class='botones' id='confirmarUnion' onclick='confirmarUnion()' value='Confirmar Union'><span>Confirmar</span></button>
            <button class='botones' id='cancelarUnion' onclick='destruir_temporal_session()' value='Cancelar Union'><span>Cancelar</span></button>
        </div>

        <div id='resumenFinal'></div>
    </div>
	 <div id="map" style=" cursor: pointer; min-height:100vh; im !important"  class="map"></div>
</div>
<script>
	$(document).ready(function () {
		nomProvisoriaUnion(document.getElementById("tipo_nomenclatura_union"));
		$(".ol-unselectable").removeAttr("height")

	});
</script>
</body>
</html>