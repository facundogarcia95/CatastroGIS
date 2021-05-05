<?php

namespace App\Http\Controllers;

use App\CapasCartografia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use DB;

class CartografiaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){

        $estado_barrios = DB::connection('mysql2')
        ->table('estado_barrio')->get();

        $fuente_barrios = DB::connection('mysql2')
        ->table('fuentes_barrios')->get();

        $dominio_barrios = DB::connection('mysql2')
        ->table('dominio_barrio')->get();

        $distritos = DB::connection('mysql2')
        ->table('distritos')->where('departamento_id','=',369)->get();

        $personas = DB::connection('mysql')
        ->table('personas')
        ->select('persona_id','persona_denominacion')
        ->where('tipo_persona_id','=',2)
        ->where('tipo_estado_id','=',1)
        ->whereNotNull('persona_denominacion')
        ->groupBy('persona_denominacion')
        ->get();

        $buscar = null;
        if($request->buscarCarto){
            if($request->parcela_padron){
                $buscar = $request->parcela_padron;
            }else{
                $buscar = $request->parcela_nomenclatura;
            }
        }

        return view('cartografia.index',
        [
            "estado_barrios"=>$estado_barrios,
            "fuente_barrios"=>$fuente_barrios,
            "dominio_barrios"=>$dominio_barrios,
            "distritos"=>$distritos,
            "personas"=>$personas,
            "buscar"=> $buscar,
            "barrio_id"=>$request->barrio_id??0
        ]);
    }


    public function get_distrito(Request $request){

        $distrito = DB::connection('mysql2')->table("distritos")
        ->where($request->parametro,'=',$request->valor)
        ->first();


        if($distrito){

            return Response::json(
                array(
                    "success" => true,
                    "mensaje" => "Servicion web exitoso",
                    "distrito" => $distrito
                )
                ,200);

        }else{

            return Response::json(
                array(
                    "mensaje" => "Distrito no encontrada",
                    "distrito" => null
                )
                ,401);

        }
    }

    public function capas(Request $request){


        if($request->grupo){

            $capas = CapasCartografia::where('nombre_visible','<>',null)->orderBy('grupo','ASC')->get();

        }else{

            $capas = CapasCartografia::all();

        }
         
        return Response::json(
            array(
                "capas" => $capas
            )
            ,200);

    }

    public function es_coordenada(Request $request){


        $respuesta = DB::connection('pgsql')->select("select count(geom) as cantidad from ".env('DISTRITOS')." where st_intersects(ST_GeomFromText('POINT($request->coordenada_x $request->coordenada_y)',22182), ".env('DISTRITOS').".geom)");

        return Response::json(
            array(
                "es_coordenada" => $respuesta[0]->cantidad
            )
            ,200);

    }
}
