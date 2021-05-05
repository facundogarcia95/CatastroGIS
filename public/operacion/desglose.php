<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Expires" content="0">
<meta http-equiv="Last-Modified" content="0">
<meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
<meta http-equiv="Pragma" content="no-cache">
<title>DESGLOSE</title>
<script src="./jquery.3.5.1.min/jquery-3.5.1.min.js"></script>
<script src="./jquery-ui-1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="./jquery-ui-1.12.1/jquery-ui.css">
<script src="crypto-js.js" charset="utf-8"></script>
<script src="general.js?<?php rand().rand().rand() ?>" charset="utf-8"></script>
<script src="desglose.js?<?php rand().rand().rand() ?>" charset="utf-8"></script>

    <!-- Cartografia -->
    <link rel="stylesheet" href="./ol_5_3_0/ol.css" type="text/css" charset="utf-8">
    <script src="./ol_5_3_0/ol.js" charset="utf-8"></script>
	<style>
	body {
	   margin: 0;
	   padding: 0;
	}	
	#map {
	width: 100%;
	height: 100%;
	}
	.pagina{
	  width: 100%;
	  overflow: hidden;
	  position: relative;
	}
	#busqueda{
	  border-bottom: 3px solid #C2CFD6;
	}

	.buscador{
	  width: 220px;
	  padding: 8px 14px;
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
	  font-color: #A07575;
	  border: none;
	  color: #000;
	  text-align: center;
	  padding: 10px;
	  width: auto;
	  transition: all 0.5s;
	  margin: 5px;			
	}

	.subtituloFijo{
	  /*display: inline-block;
	  border-radius: 2px;
	  background-color: #e6e6e6;
	  border: none;
	  color: #000;
	  text-align: center;
	  padding: 7px;
	  width: auto;
	  transition: all 0.5s;*/
	  margin: 5px 5px 5px 10px;			
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
		height: 450px;
		margin: 0;
		padding: 0;
		overflow-y: scroll;
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
	  top: 0;
	  right: 25px;
	  font-size: 36px;
	  color: #000;
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

	.col:hover{
		color: #0070A4 !important;
	}
</style>
<script type='module' src='index.js'></script>
</head>
<body>
<input type='button' id='opciones' onclick='openNav()' class='ui-btn ui-btn-inline ui-corner-all ui-shadow botones' style='position: absolute;left: 80px; margin-top:15px; z-index: 1; font-size: 16px; font-weight: 100;' value='Desglosar Parcela'></input>
<div id='1j' class='pagina'>	
	<div id='panelIzquierdo' class='sidepanel'>
		<a href='javascript:void(0)' class='closebtn' onclick='closeNav()'>×</a>

			<div id='busqueda' align='center' class='ui-widget'>
				<label for='tags'></label> 
				<input maxlength='21' placeholder='Padron o nomenclatura..' class='buscador' id='tags' onkeyup='valid()'> 
				</br>
				<button id='confNom' class='botones' style='display:none;' onclick='validarNomenclatura(1)'><span>Validar</span></button>
				<button id='canNom' class='botones' style='display:none;' onclick='limpiar(1)'><span>Cancelar</span></button>
			</div>						

			<div id='desglose' style='display:none'>
				<span class='spanFijo' id='tipoDesglose'></span>
				<input class='cantidad' type='number' min='0' max='500' oninput='validity.valid||(value=&quot;&quot;);' id='cantidad' placeholder='Cantidad..'></input>
				<button class='botones' id='confirmarDesglose' onclick='confirmarDesglose()' value='Confirmar Desglose'><span>Confirmar</span></button>
			</div>

			<div class=''>
				<div id='encabezado' align='center' style='border-bottom: 3px solid #C2CFD6;'>
				</div>
				<div id='completarDatosDesglose' class='completarDatosClass'>
				</div>
				<div id='confirmarCancelarDesglose'>
				</div>
			</div>

			<div id='resumenFinal' align='center'>
			</div>	
	</div>
	<div id='map' style=" cursor: pointer; height:100vh;" class="map"></div>
</div>
<script>
	$(document).ready(function () {
		$(".ol-unselectable").removeAttr("height")
	});
</script>
</body>
</html>