<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|Se utiliza resource para abarcar rutas (route) por defecto, las cuales son
| index,show,edit,store,update y destroy.
|
|Cualquier otra ruta deberá utilizarse los metodos get,post,put,patch o delete.
| En caso de estas rutas en el navbar debera colocarse url en lugar route
|

*/

use App\DatosExport;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['guest']], function () {
     
    Route::get('/','Auth\LoginController@showLoginForm')->name('fromLogin');
    Route::post('auth.login', 'Auth\LoginController@login')->name('login');

});

Route::group(['middleware' => ['auth','query']], function () {

    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
    Route::get('/home', 'RequerimientoController@index')->name('home');   
        /*========================
    RUTAS DE REQUERIMIENTOS
    ===========================*/

    Route::resource('requerimiento', 'RequerimientoController');  

    /*========================
    RUTAS DE VERSIONADO DE LA APP
    ===========================*/

    Route::get('version', 'VersionController@index')->name('versiones');
    Route::get('version/{id}', 'VersionController@show')->name('versiones.show');
    
    /*========================
    RUTAS DE GESTION DE USUARIOS
    ===========================*/

    Route::resource('Usuarios/user', 'UserController',['names' => ['index' => 'user']]);   
    Route::get('Usuarios/tabla_usuarios', 'UserController@datatable');

    /*========================
    RUTAS DE GESTION DE SECCIONES
    ===========================*/

    Route::resource('Usuarios/seccion', 'SeccionController',['names' => ['index' => 'seccion']]);
    Route::put('afectacion', 'SeccionController@afectacion');   
    Route::get('Usuarios/tabla_seccion', 'SeccionController@datatable');   

    /*==================
    RUTAS DE GESTION DE BLOQUEOS
    ===========================*/

    Route::resource('Usuarios/bloqueo', 'BloqueoController',['names' => ['index' => 'bloqueo']]);  
    Route::get('Usuarios/tabla_bloqueos', 'BloqueoController@datatable');
    Route::get('consultarBloqueo', 'BloqueoController@consultar_bloqueo');
    Route::post('liberarBloqueo', 'BloqueoController@liberarBloqueo');

    //Route::put('afectacion', 'BloqueoController@afectacion');   

    /*==================
    RUTAS DE ADMINISTRACION
    ===========================*/

    Route::resource('Administracion/Parcelas/tipo_de_condicion', 'TipoDeCondicionController',['names' => ['index' => 'tipo_de_condicion']]);  
    Route::get('Administracion/Parcelas/tabla_tipo_de_condicion', 'TipoDeCondicionController@datatable');
    Route::resource('Administracion/Parcelas/tipo_de_instrumento', 'TipoDeInstrumentoController',['names' => ['index' => 'tipo_de_instrumento']]); 
    Route::get('Administracion/Parcelas/tabla_tipo_de_instrumento', 'TipoDeInstrumentoController@datatable');
    Route::resource('Administracion/Parcelas/tipo_de_parcela', 'TipoDeParcelaController',['names' => ['index' => 'tipo_de_parcela']]);  
    Route::get('Administracion/Parcelas/tabla_tipo_de_parcela', 'TipoDeParcelaController@datatable');
    Route::resource('Administracion/Parcelas/tipo_de_profesional', 'TipoDeProfesionalController',['names' => ['index' => 'tipo_de_profesional']]);  
    Route::get('Administracion/Parcelas/tabla_tipo_de_profesional', 'TipoDeProfesionalController@datatable');
    Route::resource('Administracion/Parcelas/tipo_de_servicio', 'TipoDeServicioController',['names' => ['index' => 'tipo_de_servicio']]);  
    Route::get('Administracion/Parcelas/tabla_tipo_de_servicio', 'TipoDeServicioController@datatable');
    Route::resource('Administracion/Personas/tipo_de_documento', 'TipoDeDocumentoController',['names' => ['index' => 'tipo_de_documento']]);  
    Route::get('Administracion/Personas/tabla_tipo_de_documento', 'TipoDeDocumentoController@datatable');
    Route::resource('Administracion/Personas/tipo_de_persona_parcela', 'TipoDePersonaParcelaController',['names' => ['index' => 'tipo_de_persona_parcela']]); 
    Route::get('Administracion/Personas/tabla_tipo_de_persona_parcela', 'TipoDePersonaParcelaController@datatable');
    Route::resource('Administracion/tipo_de_afectacion', 'TipoDeAfectacionController',['names' => ['index' => 'tipo_de_afectacion']]);  
    Route::get('Administracion/tabla_tipo_de_afectacion', 'TipoDeAfectacionController@datatable');
    Route::resource('Administracion/Mejoras/tipo_de_mejora', 'TipoDeMejoraController',['names' => ['index' => 'tipo_de_mejora']]);  
    Route::get('Administracion/Mejoras/tabla_tipo_de_mejora', 'TipoDeMejoraController@datatable');
    Route::resource('Administracion/Mejoras/tipo_de_mejora_destino', 'TipoDeMejoraDestinoController',['names' => ['index' => 'tipo_de_mejora_destino']]);
    Route::get('Administracion/Mejoras/tabla_tipo_de_mejora_destino', 'TipoDeMejoraDestinoController@datatable');
    Route::resource('Administracion/Mejoras/tipo_de_tramite', 'TipoDeTramiteController',['names' => ['index' => 'tipo_de_tramite']]);
    Route::get('Administracion/Mejoras/tabla_tipo_de_tramite', 'TipoDeTramiteController@datatable');
    Route::resource('Administracion/Parcelas/poligonos_sin_padrones', 'PoligonosSinPadronController',['names' => ['index' => 'poligonos_sin_padrones']]);  
    Route::get('script_poligonos_sin_padrones', 'ScriptController@poligonos_sin_padrones');    
    Route::get('avaluo_js', 'ScriptController@avaluo_js');    
    Route::resource('Administracion/Avaluo/config_calc_avaluo', 'CalculoAvaluoController',['names' => ['index' => 'config_calc_avaluo']]);
    Route::get('Administracion/Avaluo/tabla_calculo_avaluo', 'CalculoAvaluoController@datatable');
    Route::resource('Administracion/Avaluo/config_utm', 'UtmController',['names' => ['index' => 'config_utm']]);
    Route::get('Administracion/Avaluo/tablaUTM', 'UtmController@datatable');
    
    //Route::put('afectacion', 'BloqueoController@afectacion');

    /*==================
    RUTAS DE CODIGOS
    ===========================*/
    Route::resource('codigos/tipo_de_bonificacion', 'TipoDeBonificacionController',['names' => ['index' => 'tipo_de_bonificacion']]);
    Route::get('codigos/tabla_tipos_de_bonificaciones', 'TipoDeBonificacionController@datatable');
    Route::resource('codigos/tipo_de_estado', 'ParcelaEstadoController',['names' => ['index' => 'tipo_de_estado']]);
    Route::get('codigos/tabla_tipos_de_estados', 'ParcelaEstadoController@datatable');
    Route::resource('codigos/tipo_de_uso', 'MejoraUsoController',['names' => ['index' => 'tipo_de_uso']]);
    Route::get('codigos/tabla_tipos_uso', 'MejoraUsoController@datatable');
    Route::resource('codigos/tipo_de_construccion', 'MejoraConstruccionController',['names' => ['index' => 'tipo_de_construccion']]);
    Route::get('codigos/tabla_de_construccion', 'MejoraConstruccionController@datatable');
    Route::resource('codigos/tipo_de_ryb', 'TipoParcelaRyBController',['names' => ['index' => 'tipo_de_ryb']]);
    Route::get('codigos/tabla_tipos_ryb', 'TipoParcelaRyBController@datatable');


    /*===========================
    RUTAS DE PARCELA
    ====================*/

    Route::get('parcelaPorParametro', 'ParcelaController@get_parcela');
    Route::get('titularesAutocompletar', 'ParcelaController@get_titulares');
    Route::get('buscarPersonaParcela', 'ParcelaController@get_personas_parcelas');
    Route::post('serviciosPadron', 'ParcelaController@servicios')->name('datos.servicios');
    Route::patch('planoPadron', 'ParcelaController@plano')->name('actualizar.datos.plano');
    Route::get('grillaPersonas', 'PersonasController@iframe');
    Route::get('gestion/direccion/grillaDirecciones', 'DireccionController@iframe');
    Route::get('gestion/direccion/grillaDirecciones_parcelas', 'DireccionController@iframe_parcelas');
    Route::patch('datosGeneralesParcela', 'ParcelaController@actualizardatosGenerales')->name('datos.generales');
    Route::get('cambiarDireccion', 'ParcelaController@cambiarDireccion');
    Route::get('listadoNomenclaturasOrigen', 'ParcelaController@listadoNomenclaturasOrigen');
    Route::get('listadoPadronesOrigen', 'ParcelaController@listadoPadronesOrigen');
    Route::get('listadoNomenclaturasDestino', 'ParcelaController@listadoNomenclaturasDestino');
    Route::get('listadoPadronesDestino', 'ParcelaController@listadoPadronesDestino');
    Route::post('asociarMatrizPH', 'ParcelaController@asociarMatrizPH');
    
    
    /*===========================
    RUTAS DE GESTION
    ====================*/
    
    Route::resource('gestion/padron/personas_parcelas', 'PersonaParcelaController',['names' => ['index' => 'personas_parcelas']]);
    Route::resource('gestion/padron/mejoras', 'MejoraController',['names' => ['index' => 'mejoras']]);
    Route::get('gestion/padron/tabla_mejoras', 'MejoraController@datatable');
    Route::get('gestion/direccionParcela', 'DireccionController@direccion_parcela');
    Route::resource('gestion/padron/documentos', 'ParcelaDocumentoController',['names' => ['index' => 'documentos']]);
    Route::get('gestion/union', 'unionDesgloseController@union')->name('modulo_union');
    Route::patch('agregarUnion', 'unionDesgloseController@agregarUnion');
    Route::delete('quitarUnion', 'unionDesgloseController@quitarUnion');
    Route::patch('agregarDestino', 'unionDesgloseController@agregarDestino');
    Route::delete('quitarDestino', 'unionDesgloseController@quitarDestino');
    Route::get('gestion/trabajo_pendiente', 'unionDesgloseController@trabajo_pendiente');
    Route::get('gestion/desglose', 'unionDesgloseController@desglose')->name('modulo_desglose');
    //Route::resource('gestion/direccion', 'DireccionController',['names' => ['index' => 'Direccion']]);
    Route::get('gestion/direccionesAutocompletar', 'DireccionController@autocompletar_direcciones');
    Route::get('gestion/barriosAutocompletar', 'DireccionController@autocompletar_barrios');
    Route::resource('gestion/personas', 'PersonasController',['names' => ['index' => 'modulo_personas']]);
    Route::resource('gestion/direcciones', 'DireccionController',['names' => ['index' => 'index']]);
    Route::get('gestion/tabla_personas', 'PersonasController@datatable');
    Route::get('gestion/consultarCuit', 'PersonasController@consultarcuit');
    Route::resource('gestion/padron', 'ParcelaController',['names' => ['index' => 'parcelas']]);  
    Route::get('gestion/alta_pura', 'ParcelaController@altapura');
    Route::get('gestion/padron/{id}', 'ParcelaController@show')->name('edicion_padron');  
    Route::get('gestion/titularesAutocompletar', 'ParcelaController@autocompleatar_titulares');
    Route::get('consultarPH', 'MejoraController@consultarPH');
    Route::get('bajaMejora', 'MejoraController@baja')->name("mejoras.baja");
    Route::get('altaMejora', 'MejoraController@alta')->name("mejoras.alta");
    Route::get('eliminarDocumento', 'ParcelaDocumentoController@baja')->name("parcelaDocumentos.baja");
    Route::post('archivo', 'ParcelaDocumentoController@archivo');
    Route::get('exportar_resultadoPadrones','ReporteGeneralController@exportar_busquedaPadrones');
    Route::resource('gestion/padron/tramites', 'TramiteController',['names' => ['index' => 'index']]);
    Route::get('tabla_tramites', 'TramiteController@datatable');

    /*==================
    RUTAS DE AUDITORIAS
    ====================*/

    Route::resource('auditorias', 'AuditoriaController',['names' => ['index' => 'auditorias']]);  
    Route::get('auditorias/tabla_auditorias', 'AuditoriaController@datatable');

    /*==================
    PDF
    ====================*/

    Route::get('reporte_parcela/{id}','PDFController@reporte');

    /*==================
    RUTAS DE CARTOGRAFIA
    ====================*/

    Route::get('cartografia', 'CartografiaController@index')->name('cartografia');
    Route::get('buscarDistrito', 'CartografiaController@get_distrito');
    Route::get('extendParcela', 'PostgresController@get_extend_parcela');
    Route::get('transformarCoordenada', 'PostgresController@transformarCoordenada');
    Route::get('intersectar_coordenadas', 'PostgresController@intersectar_coordenadas');
    Route::get('callesAutocompletar', 'PostgresController@get_calles');
    Route::get('buscarDireccion', 'PostgresController@get_direccion');   
    Route::get('buscarNomencla', 'PostgresController@get_parcela_nomencla');  
    Route::get('capas_cartografia','CartografiaController@capas')->name('capas_cartografia');
    Route::get('es_coordenada','CartografiaController@es_coordenada')->name('es_coordenada');

    /*===================
    RUTAS DE BARRIOS
    ====================*/

    Route::get('buscarBarrio', 'BarrioController@get_barrio');
    Route::get('barriosAutocompletar', 'BarrioController@get_barrios_autocompletar'); 
    Route::get('generar_poligono', 'BarrioController@generar_poligono');  
    Route::get('intersectar_poligono', 'BarrioController@intersectar_poligono');  
    Route::get('zoomBarrio', 'BarrioController@zoom_barrio');  
    Route::get('barriosDissolve', 'BarrioController@barrios_dissolve'); 
    Route::get('jsonBarrios','BarrioController@json_barrios');
    Route::put('asignarBarrio', 'BarrioController@asignar_barrio');  
    Route::put('actualizarDireccion', 'BarrioController@actualizar_direccion');  
    Route::post('altaBarrio', 'BarrioController@alta_barrio');  
    Route::delete('bajaBarrio', 'BarrioController@baja_barrio');
    Route::patch('modificacionBarrio', 'BarrioController@modificacion_barrio');
    Route::get('listadoBarrios','BarrioController@listadoBarrios');

    /*==========================
    RUTA DE REPORTES
    ============================*/

    Route::get('reporteGeneral','ReporteGeneralController@index')->name('reporte_general');
    Route::get('limpiarReporteDinamico','ReporteGeneralController@destroy');
    Route::get('autocompletarSelect','ReporteGeneralController@autocompletarSelect');
    Route::post('consultaDinamica','ReporteGeneralController@generarwhere');
    Route::get('tablaConsultaDinamica','ReporteGeneralController@datatable');
    Route::get('reporteDinamicoPDF', 'ReporteGeneralController@pdfReporte');
    Route::get('reporteCartografia', 'ReporteGeneralController@reporteCartografia');
    Route::get('vistaHorizont', 'ReporteGeneralController@vistaHorizont');
    Route::post('get_elem_parcela', 'ReporteGeneralController@get_elem_parcela');
    Route::post('historialConsulta','ReporteGeneralController@historialConsulta');

    /*==========================
    RUTA DE VALORES TOTALES GENERALES
    ============================*/
    Route::get('totales','ReporteGeneralController@totales')->name('totales');
    Route::get('get_tipos_mejoras','ReporteGeneralController@get_tipos_mejoras')->name('totales');
    Route::get('nomenclasParcelas','ReporteGeneralController@nomenclasParcelas');
    Route::get('estadosPersonas','ReporteGeneralController@estadosPersonas');
    Route::get('gestionadoMejoras','ReporteGeneralController@gestionadoMejoras');
    Route::get('gestionadoParcelas','ReporteGeneralController@gestionadoParcelas');
    Route::get('gestionadoPersonas','ReporteGeneralController@gestionadoPersonas');

});

  Route::group(['middleware' => ['Cors']], function () {

    Route::get('webservice/padron/{padron}','CorsController@web_service_padron');
    Route::get('verificarSession', 'CorsController@verificarSession'); 
    Route::get('tabla_requerimientos', 'RequerimientoController@datatable'); 
    Route::get('ultimoPadron','CorsController@ultimo_padron');
    Route::get('padronlibre','CorsController@padronlibresobre200000');
    
  });


  Route::group(['middleware' => ['Script']], function() {

    Route::get('scripts_barrio_migracion','ScriptController@inicio_script_barrio');
    Route::get('vista_auditorias_migracion','ScriptController@vista_auditorias_migracion'); //PARAMETROS tabla & year
    Route::get('auditorias_migracion','ScriptController@auditorias_migracion'); //PARAMETROS tabla & year
    Route::get('migracionPersonas','ScriptController@migracionPersonas');
    Route::get('migracionUsuarios','ScriptController@migracionUsuarios');
    Route::get('migracionRequerimientos','ScriptController@migracionRequerimientos');
    Route::get('migracionParcelas','ScriptController@migracionParcelas');
    
  });

Route::fallback(function(){ return response()->view('errors.404', [], 404); });