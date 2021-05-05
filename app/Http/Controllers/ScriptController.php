<?php

namespace App\Http\Controllers;

use App\Barrio;
use App\BarrioDissolve;
use App\BarrioMigracion;
use App\Distrito;
use App\Parcela;
use App\ParcelaPos;
use App\Persona;
use App\PersonaNew;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Collection;

class ScriptController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('Administrador');
    }

    public function index(Request $request)
    {

    }


    /*====================================
      PROCESO PARA MIGRACION DE BARRIOS

        -PRIMERO DEBEMOS OBTENER CAPA DE BARRIOS CON SUS RESPECTIVOS NOMBRES
        -LLUEGO EJECUTAMOS EL SCRIPT inicio_script_barrio PARA GENERAR LOS BARRIOS
          EN EL ALFANUMERICO
        -LUEGO EJECUTAMOS EL SCRIPT pasaje_barrio_id_a_postgres PARA PASAR EL ID CORRESPONDIENTE A CADA 
        BARRIO A LA CAPA.
        -UTILIZAMOS EL SCRIPT PARA PASAR LOS ID CORRESPONDIENTES A LAS PARCELAS.
    ======================================*/
    public function inicio_script_barrio(Request $request){
      
      Barrio::query()->truncate();

      $barrios_gllen = DB::connection('pgsql')->select('select barrio,distrito from barrios_gllen where barrio is not null group by barrio,distrito');
      $cantidad = 0;

      foreach($barrios_gllen as $barrio){

         $barrio_new = new Barrio();
         $barrio_new->barrio_nombre = $barrio->barrio;
         $barrio_new->departamento_id = 369;
         $distrito = Distrito::where('distrito_nombre','LIKE','%'.$barrio->distrito.'%')->first();
         if(!$distrito){
           dd($barrio->distrito);
         }
         $barrio_new->distrito_id = $distrito->distrito_id;
         $barrio_new->estado_barrio_id = 1;
         $barrio_new->dominio_barrio_id = 4;
         $barrio_new->fuente_barrio_id = 1;
         $barrio_new->usuario_f_alta = date("Y-m-d H:i:s");
         $barrio_new->usuario_alta_id = 1;
         $barrio_new->tipo_estado_id = 1;
         $barrio_new->save();

         $cantidad++;

      }
      
      $this->pasaje_barrio_id_a_postgres();

    }


    public function pasaje_barrio_id_a_postgres(){

      $barrios = Barrio::all();
      $cantidad = 0;
      foreach($barrios as $barrio){

         $barrio_dissolve = BarrioMigracion::where('barrio','LIKE','%'.$barrio->barrio_nombre.'%')->update(['barrio_id' => $barrio->barrio_id]);
         $cantidad = $cantidad + $barrio_dissolve;

      }

      $this->pasaje_id_a_parcelario();
    }


    public function pasaje_id_a_parcelario(){
      
      $cantidad = 0;

      DB::connection('pgsql')->select('UPDATE '.env('PARCELARIO').' SET barrio_id = 0');

      $cantidad = DB::connection('pgsql')->select('UPDATE '.env('PARCELARIO').' SET barrio_id = t.barrio_id FROM (select '.env('PARCELARIO').'.nomenc21, barrios_gllen.barrio_id from '.env('PARCELARIO').',barrios_gllen where ST_Intersects('.env('PARCELARIO').'.geom, barrios_gllen.geom))t WHERE '.env('PARCELARIO').'.nomenc21=t.nomenc21');
      
      $dissolve = new BarrioController();

      $dissolve->barrios_dissolve();
      
      dd("Canditad de parcelas con Barrio ".count($cantidad));

    }


    /*=============
    FIN MIGRACION BARRIO
    =============*/


    /*=============
    SCRIPT PARA GENERAR CAPA DE POLIGONOS ROJOS (POLIGONOS SIN PADRON DE NOMENCLATURA)
    =============*/

    public function poligonos_sin_padrones(){
      
      ini_set('memory_limit', -1);
      set_time_limit(0);


      $parcelas_mysql = DB::connection('mysql')->select('SELECT LEFT(parcela_nomenclatura,16) AS parcela_nomenclatura FROM parcelas');
      $parcelas_postgres = DB::connection('pgsql')->select('SELECT LEFT(nomenc21,16) AS nomenc16, nomenc21 FROM gllen_parcelas_pos WHERE nomenc21 IS NOT NULL');
      DB::connection('pgsql')->select('TRUNCATE TABLE poligonos_sin_padron;'); 
      
      $parcelas_mysql_noms = [];
      foreach($parcelas_mysql as $parcela_mysql){
        array_push($parcelas_mysql_noms, $parcela_mysql->parcela_nomenclatura);
      }

      // INSERTO LAS PARCELAS DEL PARCELARIO QUE NO MATCHEAN CON EL ALFANUMERICO
      for($i = 0 ; $i < count($parcelas_postgres); $i++){

        if(!in_array($parcelas_postgres[$i]->nomenc16, $parcelas_mysql_noms)){

          $query =  "INSERT INTO poligonos_sin_padron SELECT * FROM gllen_parcelas_pos WHERE nomenc21 = '".$parcelas_postgres[$i]->nomenc21."' LIMIT 1";
          DB::connection('pgsql')->select($query);

        }

      }	


    }

    /*========================
      SCRIPT QUE EJECUTA LA MIGRACION DE LAS AUDITORIAS
      BASADA EN UN AÑO QUE RECIBE COMO PARAMETRO, TAMBIEN REQUIERE DEL
      NOMBRE DE LA TABLA DE AUDITORIAS QUE SE VA A MIGRAR
    ============================*/
    public function vista_auditorias_migracion(Request $request){

      $auditorias = DB::table('auditorias')->select(DB::raw('count(auditoria_id) as data'), DB::raw('YEAR(auditoria_fecha) year'))
      ->groupby('year')
      ->get();
      return view('migraciones.auditoria',["auditorias"=>$auditorias]);

    }

    public function auditorias_migracion(Request $request){

      ini_set('memory_limit', -1);
      set_time_limit(0);
      
      $validacion = DB::table('auditorias')->select(DB::raw('count(auditoria_id) as data'), DB::raw('YEAR(auditoria_fecha) year'))
      ->whereRaw('YEAR(auditoria_fecha) = '.$request->year)
      ->groupby('year')
      ->first();


      if(isset($validacion)){
        return back()->with('error','El año '.$request->year.' ya ha sido migrado.');
      }



      $db_old_audit = 
      <<<EOT
        CONCAT('{"',auditoria_det_campo,'":"',auditoria_det_old,'"}')
      EOT;

      $db_new_audit = 
      <<<EOT
        CONCAT('{"',auditoria_det_campo,'":"',auditoria_det_new,'"}')
      EOT;

      $respuesta = DB::table($request->tabla)->select(
        $request->tabla.'.auditoria_id',
        'auditoria_script',
        'auditoria_host',
        'aud_tip_id',
        'usuarios_id',
        'auditoria_fecha',
        'auditoria_tabla',
        'auditoria_registro_id',
        'auditoria_det_descripcion',
        DB::raw('IF(auditoria_det_old IS NOT NULL, '.$db_old_audit.', NULL) AS auditoria_detalle_old'),
        DB::raw('IF(auditoria_det_new IS NOT NULL, '.$db_new_audit.', NULL) AS auditoria_detalle_new')
      )->leftJoin('auditorias_detalle','auditorias_detalle.auditoria_id','=',$request->tabla.'.auditoria_id') 
      ->where($request->tabla.'.auditoria_fecha', '>=', $request->year.'-01-01')
      ->where($request->tabla.'.auditoria_fecha', '<=', $request->year.'-12-31')
      ->orderBy($request->tabla.'.auditoria_fecha','ASC')
      ->get();

      $insert = collect();

      foreach ($respuesta as $registro) 
      {
        $insert->push([
          "auditoria_script" => $registro->auditoria_script,
          "auditoria_host" => $registro->auditoria_host,
          "aud_tip_id" => $registro->aud_tip_id,
          "usuario_id" => $registro->usuarios_id,
          "auditoria_fecha" => $registro->auditoria_fecha,
          "auditoria_tabla" => $registro->auditoria_tabla,
          "auditoria_registro_id" => $registro->auditoria_registro_id,
          "auditoria_descripcion" => $registro->auditoria_det_descripcion,
          "auditoria_detalle_old" => $registro->auditoria_detalle_old,
          "auditoria_detalle_new" => $registro->auditoria_detalle_new
          ]);

      }

      // dividirá el conjunto de datos en colecciones más pequeñas que contienen 500 valores cada una, puede variarlos 
      // segun el rendimiento que se desee. 

      foreach ($insert->chunk(500) as $chunk)
      {
        DB::table('auditorias')->insert($chunk->toArray());
      }

      return back()->with('success','Aditorias migradas exitosamente.');

    }


    /*=============
    SCRIPT PARA CALCULO DE AVALUO
    =============*/

    public function avaluo_js(Request $request){
        $arreglo = [
          $request->parcela_id,
          $request->pe_id,
          $request->cantser,
          $request->parcela_super_mensura,
          $request->lado_frente,
          $request->parcela_lateral_norte,
          $request->parcela_lateral_sur,
          $request->parcela_lateral_este,
          $request->parcela_lateral_oeste
        ];
        return $arreglo;
      }



      /*=======================
      MIGRACION DE PERSONAS
      
        COMENTAR OBSERVER AUDITORIA 

      -SE USAN 3 TABLAS 
        PERSONAS_OLD (LA VIGENTE)
        PERSONAS_NEW (LA NUEVA)
        PERSONAS_PADRON_ELECTORAL(ES LA DEL PADRON ELECTORAL)

        QUEDA TODO EN PERSONAS_NEW, LUEGO SE CAMBIA EL NOMBRE
      =========================*/

      public function migracionPersonas(Request $request){

        ini_set('memory_limit', -1);
        set_time_limit(0);

        $personas_old = DB::table('personas_old')->get();

        DB::table('personas_new')->truncate();

        $insert = collect();

        foreach ($personas_old as $persona) {

            $insert->push([
              "persona_id" => $persona->persona_id,
              "tipo_persona_id" => $persona->tipo_persona_id,
              "tipo_documento_id" => $persona->tipo_documento_id,
              "persona_nro_doc" => $persona->persona_nro_doc,
              "persona_es_cuit" => 0,
              "persona_cuit" => $persona->persona_cuit,
              "persona_denominacion" => $persona->persona_denominacion,
              "persona_apellido" => $persona->persona_apellido,
              "persona_nombre" => $persona->persona_nombre,
              "persona_sexo" => null,
              "razon_social" => $persona->razon_social,
              "persona_conyuge" => $persona->persona_conyuge,
              "persona_fallecida" =>  $persona->persona_fallecido,
              "persona_fecha_nac" => $persona->persona_fecha_nac,
              "pais_id" => $persona->pais_id,
              "persona_tel_movil" => $persona->persona_tel_movil,
              "tipo_estado_id" => $persona->tipo_estado_id,
              "persona_email" => $persona->persona_email,
              "persona_f_proce" => $persona->persona_f_proce,
              "persona_f_alta" => $persona->persona_f_alta,
              "usuario_id" => $persona->usuario_id,
              "tipo_persona_juridica_id" =>  $persona->tipo_persona_juridica_id
            ]);

        }

        foreach ($insert->chunk(500) as $chunk)
        {
          DB::table('personas_new')->insert($chunk->toArray());
        }


        $personas_padron_electoral = DB::table('personas_padron_electoral')
        ->leftJoin('personas_old','personas_old.persona_nro_doc','=','personas_padron_electoral.persona_nro_doc')
        ->select(DB::raw('COUNT(*) AS c'),DB::raw('personas_padron_electoral.*'),DB::raw('personas_old.persona_id as id_old'))
        ->groupBy('personas_padron_electoral.persona_nro_doc')
        ->havingRaw('c = 1')
        ->get();

        $insert = collect();

        foreach ($personas_padron_electoral as $persona_padron) {

          if($persona_padron->id_old){

              $persona = PersonaNew::find($persona_padron->id_old);  
              $persona->tipo_persona_id = $persona_padron->tipo_persona_id;
              $persona->tipo_documento_id = $persona_padron->tipo_documento_id;
              if($persona_padron->persona_cuit != null && $persona_padron->persona_cuit != ""){
                $persona->persona_cuit = $persona_padron->persona_cuit;
              }
              $persona->persona_es_cuit = $persona_padron->persona_es_cuit;
              $persona->persona_denominacion = $persona_padron->persona_denominacion;
              $persona->persona_apellido = $persona_padron->persona_apellido;
              $persona->persona_nombre = $persona_padron->persona_nombre;
              $persona->persona_sexo = $persona_padron->persona_sexo;
              $persona->persona_fallecida = $persona_padron->persona_fallecida;
              $persona->razon_social = $persona_padron->razon_social;
              $persona->persona_conyuge = $persona_padron->persona_conyuge;
              $persona->persona_fecha_nac = $persona_padron->persona_fecha_nac;
              $persona->pais_id = $persona_padron->pais_id;
              $persona->persona_tel_movil = $persona_padron->persona_tel_movil;
              $persona->tipo_estado_id = $persona_padron->tipo_estado_id;
              $persona->persona_email = $persona_padron->persona_email;
              $persona->persona_f_proce = date("Y-m-d H:i:s");
              $persona->tipo_persona_juridica_id = $persona_padron->tipo_persona_juridica_id;
              $persona->save();


          }else{

            $insert->push([
              "tipo_persona_id" => $persona_padron->tipo_persona_id,
              "tipo_documento_id" => $persona_padron->tipo_documento_id,
              "persona_nro_doc" => $persona_padron->persona_nro_doc,
              "persona_es_cuit" => $persona_padron->persona_es_cuit,
              "persona_cuit" => $persona_padron->persona_cuit,
              "persona_denominacion" => $persona_padron->persona_denominacion,
              "persona_apellido" => $persona_padron->persona_apellido,
              "persona_nombre" => $persona_padron->persona_nombre,
              "persona_sexo" => $persona_padron->persona_sexo,
              "persona_fallecida" => $persona_padron->persona_fallecida,
              "razon_social" => $persona_padron->razon_social,
              "persona_conyuge" => $persona_padron->persona_conyuge,
              "persona_fecha_nac" => $persona_padron->persona_fecha_nac,
              "pais_id" => $persona_padron->pais_id,
              "persona_tel_movil" => $persona_padron->persona_tel_movil,
              "tipo_estado_id" => $persona_padron->tipo_estado_id,
              "persona_email" => $persona_padron->persona_email,
              "persona_f_proce" => null,
              "persona_f_alta" => date("Y-m-d H:i:s"),
              "usuario_id" => 1,
              "tipo_persona_juridica_id" =>  $persona_padron->tipo_persona_juridica_id
            ]);
          
          }

        }


        foreach ($insert->chunk(500) as $chunk)
        {
          DB::table('personas_new')->insert($chunk->toArray());
        }

        echo "Script finalizado";

      }

      
          /*=======================
      MIGRACION DE USUARIOS

        COMENTAR OBSERVER AUDITORIA 

      -SE USAN 3 TABLAS 
        !!NO BORRAR TABLA USUARIOS HASTA TENER LA MIGRACION REALIZADA!!

        USUARIOS_OLD (LA DE GUAYMALLEN CON LA ESTRUCTURA VIEJA)
        USUARIOS_NEW (CON LA ESTRUCTURA NUEVA Y VACIA)
      
      QUEDA TODO EN USUARIOS_NEW, LUEGO SE CAMBIA EL NOMBRE
      =========================*/

      public function migracionUsuarios(Request $request){

        
        ini_set('memory_limit', -1);
        set_time_limit(0);

        DB::table('usuarios_new')->truncate();

        $usuarios_old = DB::table('usuarios_old')->select(
          'usuario_id',
          'usuario_nombre',
          DB::raw("'DNI' AS tipo_documento"),
          DB::raw("NULL AS num_documento"),
          DB::raw("NULL AS email"),
          'usuario_login',
          DB::raw("usuario_clave AS password"),
          DB::raw("tipo_estado_id AS condicion"),
          DB::raw("grupo_id AS idrol"),
          DB::raw("IF(seccion_id IS NULL,1,seccion_id) AS idseccion"),
          DB::raw("'noimagen.jpg' AS imagen"),
          DB::raw("NULL AS remember_token"),
          DB::raw("NOW() AS created_at"),
          DB::raw("NOW() AS updated_at")
        )->orderBy('usuario_id','ASC')->get();

        foreach ($usuarios_old as $usuario) {

          $existe = DB::table('usuarios_new')->where('usuario_login','=',$usuario->usuario_login)->orderBy('condicion','DESC')->first();

          if(!$existe){
            
            $insert = [
                [
                "usuario_id" => $usuario->usuario_id,
                "usuario_nombre" => $usuario->usuario_nombre,
                "tipo_documento" => $usuario->tipo_documento,
                "num_documento" => $usuario->num_documento,
                "email" => $usuario->email,
                "usuario_login" => $usuario->usuario_login,
                "password" => $usuario->password,
                "condicion" => $usuario->condicion,
                "idrol" => $usuario->idrol,
                "idseccion" => $usuario->idseccion,
                "imagen" => $usuario->imagen,
                "remember_token" => $usuario->remember_token,
                "created_at" => $usuario->created_at,
                "updated_at" => $usuario->updated_at
              ]
            ];

            DB::table('usuarios_new')->insert($insert);

          }else{


            if($usuario->condicion == 1){
              
              $insert = [
                [
                "usuario_id" => $usuario->usuario_id,
                "usuario_nombre" => $usuario->usuario_nombre,
                "tipo_documento" => $usuario->tipo_documento,
                "num_documento" => $usuario->num_documento,
                "email" => $usuario->email,
                "usuario_login" => $usuario->usuario_login,
                "password" => $usuario->password,
                "condicion" => $usuario->condicion,
                "idrol" => $usuario->idrol,
                "idseccion" => $usuario->idseccion,
                "imagen" => $usuario->imagen,
                "remember_token" => $usuario->remember_token,
                "created_at" => $usuario->created_at,
                "updated_at" => $usuario->updated_at
                ]
              ];

              
              DB::table('usuarios_new')->where('usuario_id', $existe->usuario_id)
              ->update(['usuario_login' => $usuario->usuario_login."_".microtime(true)]);

              DB::table('usuarios_new')->insert($insert);
            

            }else{

                $insert = [
                  [
                  "usuario_id" => $usuario->usuario_id,
                  "usuario_nombre" => $usuario->usuario_nombre,
                  "tipo_documento" => $usuario->tipo_documento,
                  "num_documento" => $usuario->num_documento,
                  "email" => $usuario->email,
                  "usuario_login" => $usuario->usuario_login."_".microtime(true),
                  "password" => $usuario->password,
                  "condicion" => $usuario->condicion,
                  "idrol" => $usuario->idrol,
                  "idseccion" => $usuario->idseccion,
                  "imagen" => $usuario->imagen,
                  "remember_token" => $usuario->remember_token,
                  "created_at" => $usuario->created_at,
                  "updated_at" => $usuario->updated_at
                  ]
                ];

                DB::table('usuarios_new')->insert($insert);

            }

          }

        }


        echo "Script usuarios terminado";

      }

     /*=======================
      MIGRACION DE REQUERIMIENTOS

      -SE USAN 4 TABLAS 
        NOTICIAS_OLD (LA DE GUAYMALLEN CON LA ESTRUCTURA VIEJA)
        NOTICIAS_HILOS_OLD (LA DE GUAYMALLEN CON LA ESTRUCTURA VIEJA)

        NOTICIAS_NEW (CON LA ESTRUCTURA NUEVA)
        NOTICIAS_HILOS_NEW (CON LA ESTRUCTURA NUEVA)
      
      QUEDA TODO EN NOTICIAS_NEW Y NOTICIAS_HILOS_NEW, LUEGO SE CAMBIA EL NOMBRE
      =========================*/

      public function migracionRequerimientos(Request $request){

        ini_set('memory_limit', -1);
        set_time_limit(0);

        DB::table('noticias_new')->truncate();
        DB::table('noticias_hilos_new')->truncate();

        $noticias_old = DB::table('noticias_old')->select(
           'noticia_id',
           'noti_cat_id',
           DB::raw('noticias_asunto as noticia_asunto'),
           DB::raw('noticias_texto as primer_hilo'),
           DB::raw('noticias_fecha as noticia_created'),
           DB::raw('noticias_fecha as noticia_update'),
           'usuario_id',
           DB::raw('NULL as estado')
          )->get();

        $noticias_hilos_old = DB::table('noticias_hilos_old')->orderBy('noti_hilo_fecha','ASC')->get();

         $insert = collect();
         $insert2 = collect();
         $insert3 = collect();

          foreach ($noticias_old as $noticia_old) {
            
         
            $estado = DB::table('noticias_old')
            ->leftJoin('noticias_hilos_old','noticias_hilos_old.noticia_id','=','noticias_old.noticia_id')
            ->select(DB::raw('noticias_hilos_old.not_h_est_id'))
            ->where('noticias_hilos_old.noticia_id','=',$noticia_old->noticia_id)
            ->orderBy('noticias_hilos_old.noti_hilo_fecha','DESC')->first();
              
              $insert->push([

                "noticia_id" => $noticia_old->noticia_id,
                "noti_cat_id" => $noticia_old->noti_cat_id,
                "noticia_asunto" => $noticia_old->noticia_asunto,
                "noticia_created" => $noticia_old->noticia_created,
                "noticia_update" => $noticia_old->noticia_update,
                "usuario_id" => $noticia_old->usuario_id,
                "estado" => $estado->not_h_est_id
                ]);


              $insert2->push([
                "noticia_id" => $noticia_old->noticia_id,
                "noti_hilo_fecha" => $noticia_old->noticia_created,
                "noti_hilo_texto" => $noticia_old->primer_hilo,
                "usuario_id" => $noticia_old->usuario_id,
                "not_h_est_id" => $estado->not_h_est_id
                ]);

           
          }


          foreach ($noticias_hilos_old as  $hilo_old) {
            
            $insert3->push([
              "noticia_id" => $hilo_old->noticia_id,
              "noti_hilo_fecha" => $hilo_old->noti_hilo_fecha,
              "noti_hilo_texto" => $hilo_old->noti_hilo_texto,
              "usuario_id" => $hilo_old->usuario_id,
              "not_h_est_id" => $hilo_old->not_h_est_id
              ]);

          }

          foreach ($insert->chunk(500) as $chunk)
          {
            DB::table('noticias_new')->insert($chunk->toArray());
          }

          
          foreach ($insert2->chunk(500) as $chunk)
          {
            DB::table('noticias_hilos_new')->insert($chunk->toArray());
          }

          foreach ($insert3->chunk(500) as $chunk)
          {
            DB::table('noticias_hilos_new')->insert($chunk->toArray());
          }
  
          echo "Script Requerimientos Terminados";
      
      }

        /*=======================
      MIGRACION DE PARCELAS

        COMENTAR OBSERVER AUDITORIA 

      -SE USAN 2 TABLAS 
        PARCELAS_OLD (LA DE GUAYMALLEN CON LA ESTRUCTURA VIEJA)
      
        PARCELAS (CON LA ESTRUCTURA NUEVA)
      
      QUEDA TODO EN PARCELAS (CON LA ESTRUCTURA NUEVA)
      =========================*/

      public function migracionParcelas(Request $request){

        ini_set('memory_limit', -1);
        set_time_limit(0);

          DB::table('parcelas')->truncate();

          $parcelas_old = DB::table('parcelas_old')->orderBy('parcela_id','ASC')->get();
    
          $insert = collect();

          foreach ($parcelas_old as $parcela) {

            $insert->push([
              'parcela_id' => $parcela->parcela_id,
              'tipo_parcela_estado_id' => $parcela->tipo_parcela_estado_id,
              'parcela_nomenclatura' => $parcela->parcela_nomenclatura,
              'parcela_dependencia'=> $parcela->parcela_dependencia,
              'parcela_distrito'=> $parcela->parcela_distrito,
              'parcela_seccion'=> $parcela->parcela_seccion,
              'parcela_manzana'=> $parcela->parcela_manzana,
              'parcela_parcela'=> $parcela->parcela_parcela,
              'parcela_subparcela' => $parcela->parcela_subparcela,
              'parcela_dig_veri' => $parcela->parcela_dig_veri,
              'parcela_padron'=> $parcela->parcela_padron,
              'parcela_padron_terr'=> $parcela->parcela_padron_terr,
              'parcela_fraccion_ori'=> $parcela->parcela_fraccion_ori,
              'uni_med_id'=> $parcela->uni_med_id,
              'parcela_super_mensura'=> $parcela->parcela_super_mensura,
              'parcela_super_titulo'=> $parcela->parcela_super_titulo,
              'parcela_super_cultivada'=> $parcela->parcela_super_cultivada,
              'parcela_super_libre'=> $parcela->parcela_super_libre,
              'parcela_padron_pasaje'=> $parcela->parcela_padron_pasaje,
              'parcela_plano_nro'=> $parcela->parcela_plano_nro,
              'parcela_plano_fecha'=> $parcela->parcela_plano_fecha,
              'parcela_lateral_norte'=> $parcela->parcela_lateral_norte,
              'parcela_lateral_sur'=> $parcela->parcela_lateral_sur,
              'parcela_lateral_este'=> $parcela->parcela_lateral_este,
              'parcela_lateral_oeste'=> $parcela->parcela_lateral_oeste,
              'parcela_ochava'=> $parcela->parcela_ochava,
              'parcela_lado_frente'=> $parcela->parcela_lado_frente,
              'tipo_bonificacion_id'=> $parcela->tipo_bonificacion_id,
              'tipo_parcela_ryb_id'=> $parcela->tipo_parcela_ryb_id,
              'parcela_avaluo'=> $parcela->parcela_avaluo,
              'parcela_avaluo_imp'=> $parcela->parcela_avaluo_imp,
              'parcela_avaluo_utm'=> $parcela->parcela_avaluo_utm,
              'parcela_porc_comun'=> $parcela->parcela_porc_comun,
              'parcela_porc_uf'=> $parcela->parcela_porc_uf,
              'parcela_sup_uf'=> $parcela->parcela_sup_uf,
              'tipo_parcela_uso_id'=> $parcela->tipo_parcela_uso_id,
              'tipo_estado_id'=> $parcela->tipo_estado_id,
              'parcela_f_proceso'=> $parcela->parcela_f_proceso,
              'parcela_f_estado'=> $parcela->parcela_f_estado,
              'parcela_f_alta'=> $parcela->parcela_f_alta,
              'direccion_nomencla_rud_real'=> $parcela->direccion_nomencla_rud_real,
              'tipo_parcela_alta_id'=> $parcela->tipo_parcela_alta_id,
              'usuario_id'=> $parcela->usuario_id,
              'tipo_nomenclatura'=> $parcela->tipo_nomenclatura,
              'nomencla_proceso_dpc'=> $parcela->nomencla_proceso_dpc,
              'parcela_observacion'=> $parcela->parcela_observacion,
              'parcela_expediente'=> $parcela->parcela_expediente,
              'parcela_x'=> $parcela->direccion_x,
              'parcela_y'=> $parcela->direccion_y,
              'wkt'=> null,
              'geom'=> null,
              'produccion' => 1

              ]);

          }

          foreach ($insert->chunk(500) as $chunk)
          {
            DB::table('parcelas')->insert($chunk->toArray());
          }
  
          echo "Script de Parcelas Terminado";

      }

}