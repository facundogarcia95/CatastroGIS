
<html>
  <head>
  	<script src="JqueryMobile/jquery-1.11.3.min.js"></script>
	<script src="JqueryMobile/jquery.mobile-1.4.5.js"></script>
	<link rel="stylesheet" href="JqueryMobile/jquery.mobile-1.4.5.css">
    <style>
      #mapGoogle, #pano {
        float: left;
        height: 100%;
        width: 50%;
      }
    </style>
	</head>
	<body>
		<div id="mapGoogle"></div>
		<div id="pano"></div>
    <script>
		function initialize() {
		// ENVIAR PARAMETROS EN ORDEN, PRIMERO X Y DESPUES Y
		var url = document.URL;
		var parametrosArr = url.split("?");
		var parametros = parametrosArr[1];
		var coordenadas = parametros.split("&");
		var x = coordenadas[0].replace("x=","");
		var y = coordenadas[1].replace("y=","");
		var xMov = '';
		var yMov = '';
		var anguloCamara = '';

		x = Number(x);
		y = Number(y);
		// Coordenada del punto sobre la linea
		var coordenadaDelPunto = '';
		// TRAER PUNTO EN EL QUE SE ENCUENTRA LA CAMARA (OSEA AL QUE SE MOVIO, SOBRE LA CALLE)
		var Url = 'https://maps.googleapis.com/maps/api/streetview/metadata?location=' + x + '%2C' + y + '&key=AIzaSyCifu1NjWlRRbvLXIGVJbqaB7ydLVmbKgQ';
		$.ajax({
			url: Url,
			jsonpCallback: 'getJson',
			type: 'get',
			async: false,
			success: function(response){
				xMov = response.location.lat;
				yMov = response.location.lng;
			}
		});		

		// ENVIO LOS PUNTOS DOS PUNTOS, EL CLICKEADO Y EL DE GOOGLE MAPS, Y DEVUELVO EL ANGULO DE AZIMUTH
		var URL = "./scripts/azimuth.php";
		$.ajax({
			url: URL,
			data: {x:x, y:y, xMov:xMov, yMov:yMov},
			jsonpCallback: 'getJson',
			type: 'get',
			async: false,
			success: function(response){
				anguloCamara = response;
			}
		});			
		
		anguloCamara = Number(anguloCamara);
		// EL ANGULO DE AZIMUTH TIENE EL 0 EN EL X POSITIVO, EL 90 EN EL Y POSITIVO, 180 EN X NEGATIVO Y 270 EN Y NEGATIVO
		// EL ANGULO USADO POR GOOGLE TIENE EL 0 EN EL Y POSITIVO, EL 90 EN EL X POSITIVO, 180 EN Y NEGATIVO Y 270 EN X NEGATIVO
		// PASO DEL AZIMUTH AL DE GOOGLE
		// VIENE EL ANGULO EN QUE SE MOVIO LA CAMARA, POR LO TANTO LA DOY VUELTA PARA QUE MIRE PARA EL OTRO LADO
		//console.log(anguloCamara);
		anguloCamara = anguloCamara + 180;
		if(anguloCamara > 360){
			anguloCamara = anguloCamara - 360;
		}
		//anguloCamara = Math.sqrt((anguloCamara * anguloCamara));
		//console.log(anguloCamara);
		anguloCamara = anguloCamara - 90;
		//console.log(anguloCamara);
		anguloCamara = anguloCamara - 360;
		//console.log(anguloCamara);
		anguloCamara = Math.sqrt((anguloCamara * anguloCamara));
		//console.log(anguloCamara);
		
		// DIRECCIONO LA CAMARA DEL STREET VIEW
		var fenway = {lng: y, lat: x};
		var mapGoogle = new google.maps.Map(document.getElementById('mapGoogle'), {
			center: fenway,
			zoom: 18
		});
		var panorama = new google.maps.StreetViewPanorama(
		document.getElementById('pano'), {
			position: fenway,
			pov: {
				heading: anguloCamara ,	// angulo de vision del tipito, 0 - 360
				pitch: 10	// angulo de la camara con respecto al auto
			}
		});
		mapGoogle.setStreetView(panorama);
		//var a = panorama;
		//console.log(a);
		//console.log(mapGoogle.getStreetView().getPosition()); // ESTE NO
	}
    </script>
	
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCifu1NjWlRRbvLXIGVJbqaB7ydLVmbKgQ&callback=initialize">
    </script>
	
  </body>
</html>