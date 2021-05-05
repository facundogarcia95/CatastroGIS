<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Aviso de Requerimiento</title>
</head>
<body>
    <p>Hola, se ha reportado un nuevo requerimiento o actualización a las {{\Carbon\Carbon::parse($requerimiento->noticia_update)->format('d/m/Y H:i:s')}}.</p>
    <br>
    <p>Datos del requerimiento:</p>
    <ul>
        <li><b>#:</b> {{ $requerimiento->noticia_id }}</li>        
        <li><b>Usuario:</b> {{ $requerimiento->ultimoHilo()->user->usuario_nombre }}</li>
        <li><b>Estado:</b> {{ $requerimiento->ultimoHilo()->estado->not_h_desc }}</li>
        <li><b>Asunto:</b> {{ $requerimiento->noticia_asunto }}</li>
        <li><b>Texto del último Hilo:</b> {!! $requerimiento->ultimoHilo()->noti_hilo_texto !!}</li>        
    </ul>  
</body>
</html>