<?php

namespace App\Http\Controllers;


use App\Mejora;
use App\MejoraConstruccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\DataTables;

class MejoraController extends Controller
{
   public function __construct()
   {
       $this->middleware('auth');
   }

   public function index(Request $request)
   {           
        
        return view('gestion.padron.mejoras.index');
          
   }

   public function datatable(Request $request){
          $mejoras = Mejora::select(
               'mejoras.*',
               'tipo_mejora_destino_descrip',
               'tipo_mejora_destino_abrev',
               'tipo_mejora_uso_descrip',
               'tipo_mejora_abrev',
               'tipo_mejora_categoria_descrip')
          ->leftJoin('tipos_mejoras_destinos','mejoras.tipo_mejora_destino_id','=','tipos_mejoras_destinos.tipo_mejora_destino_id')
          ->leftJoin('tipos_mejoras_usos','mejoras.tipo_mejora_uso_id','=','tipos_mejoras_usos.tipo_mejora_uso_id')
          ->leftJoin('tipos_mejoras','mejoras.tipo_mejora_id','=','tipos_mejoras.tipo_mejora_id')
          ->leftJoin('tipos_mejoras_categorias','mejoras.tipo_mejora_categoria_id','=','tipos_mejoras_categorias.tipo_mejora_categoria_id')
          ->where("parcela_id","=",$request->parcela_id)
          ->orderBy('mejora_f_pro','desc')->get();
          return  DataTables::of($mejoras)          
          ->editColumn('expediente', function(Mejora $mejora) {
               return $mejora->mejora_nro_exp."-".$mejora->mejora_letra_exp."-".\Carbon\Carbon::parse($mejora->mejora_fecha_exp)->format('Y');
          })
          ->editColumn('fecha', function(Mejora $mejora) {
               return \Carbon\Carbon::parse($mejora->mejora_fecha_exp)->format('d/m/Y');
          })
          ->editColumn('tipo', function(Mejora $mejora) {
               if($mejora->tipo_mejora){
                    return $mejora->tipo_mejora->tipo_mejora_abrev;
               }else{
                    return null;
               }
          })->editColumn('destino', function(Mejora $mejora) {
               if($mejora->tipo_mejora_destino){
                    return $mejora->tipo_mejora_destino->tipo_mejora_destino_descrip;
               }else{
                    return null;
               }
          })->editColumn('categoria', function(Mejora $mejora) {
               if($mejora->tipo_mejora_categoria){
                    return $mejora->tipo_mejora_categoria->tipo_mejora_categoria_descrip;
               }else{
                    return null;
               }
          })->editColumn('estado', function(Mejora $mejora) {
               if($mejora->tipo_estado_id == 1){
                    $estado= '<label class="text-success"><i class="fa fa-check "></i> Alta</label>';
               }else{
                    $estado= '<label class="text-danger "><i class="fa fa-check "></i> Baja</label>';
               }
               return $estado;
          })->editColumn('editar', function(Mejora $mejora) {
               return ' <button type="button" class="btn btn-warning rounded text-light btn-sm" 
                         data-mejora_nro_exp="'.$mejora->mejora_nro_exp.'"
                         data-mejora_letra_exp="'.$mejora->mejora_letra_exp.'"
                         data-mejora_fecha_exp="'.$mejora->mejora_fecha_exp.'"
                         data-tipo_mejora_categoria_id="'.$mejora->tipo_mejora_categoria_id.'"
                         data-tipo_mejora_uso_id="'.$mejora->tipo_mejora_uso_id.'"
                         data-mejora_sup_cub="'.$mejora->mejora_sup_cub.'"
                         data-mejora_sup_semi_cub="'.$mejora->mejora_sup_semi_cub.'"
                         data-mejora_sup_comun_ph="'.$mejora->mejora_sup_comun_ph.'"
                         data-mejora_porc_dominio="'.$mejora->mejora_porc_dominio.'"
                         data-mejora_categoria_dpc="'.$mejora->mejora_categoria_dpc.'"
                         data-tipo_mejora_id="'.$mejora->tipo_mejora_id.'"
                         data-tipo_mejora_destino_id="'.$mejora->tipo_mejora_destino_id.'"
                         data-mejora_observacion="'.$mejora->mejora_observacion.'"
                         data-tipo_estado_id="'.$mejora->tipo_estado_id.'"
                         data-parcela_id="'.$mejora->parcela_id.'"
                         data-mejora_id="'.$mejora->mejora_id.'"
                         data-toggle="modal" 
                         data-target="#editarMejora">
                    <i class="fa fa-edit fa-2x"></i>
                    </button>';
          })->rawColumns(['expediente','fecha','tipo','destino','categoria','estado','editar'])
          ->make(true);
     }

   public function store(Request $request)
   {   
        $Mejora = new Mejora();
        $Mejora->parcela_id = $request->parcela_id;
        $Mejora->tipo_mejora_id = $request->tipo_mejora_id;
        $Mejora->tipo_mejora_categoria_id = $request->tipo_mejora_categoria_id;
        $Mejora->tipo_mejora_destino_id = $request->tipo_mejora_destino_id;
        $Mejora->tipo_mejora_uso_id = $request->tipo_mejora_uso_id;
        $Mejora->mejora_nro_exp = $request->mejora_nro_exp;
        $Mejora->mejora_letra_exp = $request->mejora_letra_exp;
        $Mejora->mejora_fecha_exp = $request->mejora_fecha_exp;
        $Mejora->mejora_sup_cub = $request->mejora_sup_cub;
        $Mejora->mejora_sup_semi_cub = $request->mejora_sup_semi_cub;
        $Mejora->mejora_sup_comun_ph = $request->mejora_sup_comun_ph;
        $Mejora->mejora_porc_dominio = $request->mejora_porc_dominio;
        $Mejora->mejora_clandestina_id = $request->mejora_clandestina_id;
        $Mejora->tipo_exp_avaluo_id = $request->tipo_exp_avaluo_id;
        $Mejora->mejora_categoria_dpc = $request->mejora_categoria_dpc;
        $Mejora->mejora_id_old = $request->mejora_id_old;
        $Mejora->mejora_valor = $request->mejora_valor;
        $Mejora->mejora_observacion = $request->mejora_observacion;
        $Mejora->mejora_f_alta = date("Y-m-d H:i:s");
        $Mejora->mejora_f_pro = date("Y-m-d H:i:s");
        $Mejora->usuario_id =\Auth::user()->usuario_id;
        $Mejora->tipo_estado_id = 1;
        $Mejora->save();
        return back()->with("success","Mejora agregada exitosamente");//vuelve a la misma pagina
   }

   public function update(Request $request)
   {
       session(['redirectElement' => 'collapseMejoras']);
        $Mejora = Mejora::findOrFail($request->mejora_id);
        $request["mejora_f_pro"] = date("Y-m-d H:i:s");
        $request["usuario_id"] =\Auth::user()->usuario_id;
        $Mejora->update($request->all());//carga todos los registros para actualizar
        return back()->with("success","Mejora actualizada exitosamente");
   }

   public function baja(Request $request)
   {
       session(['redirectElement' => 'collapseMejoras']);

        $Mejora = Mejora::find($request->mejora_id);
        if($Mejora){
             $request["mejora_f_pro"] = date("Y-m-d H:i:s");
             $request["mejora_f_baja"] = date("Y-m-d H:i:s");
             $request["mejora_mot_baja"] = "Baja";
             $request["usuario_id"] = \Auth::user()->usuario_id;
             $request["tipo_estado_id"] = 2;
             $Mejora->update($request->all());
             return Response::json(array( "baja" => 1), 200);
        }else{
               return Response::json(array( "baja" => 0), 200);
        }
   }

   public function alta(Request $request)
   {
       session(['redirectElement' => 'collapseMejoras']);
        $Mejora = Mejora::findOrFail($request->mejora_id);
        $request["mejora_f_pro"] = date("Y-m-d H:i:s");
        $request["usuario_id"] =\Auth::user()->usuario_id;
        $request["tipo_estado_id"] = 1;
        $Mejora->update($request->all());
        return Response::json(array( "alta" => 1), 200);
   } 

   public function consultarPH(Request $request){
        $mejoraconstruccion = MejoraConstruccion::where("tipo_mejora_categoria_id","=",$request->parametro)->first();
        $ph = $mejoraconstruccion->ph;
        return Response::json(array( "ph" => $ph), 200);
    }

    
}