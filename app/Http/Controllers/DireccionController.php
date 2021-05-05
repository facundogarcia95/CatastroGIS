<?php

namespace App\Http\Controllers;

use App\Direccion;
use App\Barrio;
use App\Departamento;
use App\Distrito;
use App\Ejes;
use App\Parcela;
use App\Provincia;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;

class DireccionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('Consulta');
        ini_set('memory_limit', -1);
    }

    public function index(Request $request)
    {    
        $order = $request->order ? $request->order : null;

        /*listar los roles en ventana modal*/
        $direcciones = Direccion::orderBy('direccion_id','asc')->paginate(10);

        $direcciones = Direccion::select(
            'direcciones.*',
            DB::raw('CONCAT(vdirecciones.direccion_calle, " - ",vdirecciones.distrito_nombre, " - ",vdirecciones.departamento_nombre, " - ",vdirecciones.provincia_nombre ) as nombre'),
            'vdirecciones.barrio_nombre as nombre_de_barrio',
            DB::raw('IF(vdirecciones.barrio_id > 0, CONCAT(vdirecciones.barrio_nombre, " - ",vdirecciones.distrito_nombre, " - ",vdirecciones.departamento_nombre, " - ",vdirecciones.provincia_nombre ), "") as barrio_nombre'),
            'tipo_estado_descrip')
            ->leftJoin('ejes_mendoza','direcciones.calle_id', '=', 'ejes_mendoza.eje_id')
            ->leftJoin('vdirecciones','direcciones.direccion_id', '=', 'vdirecciones.direccion_id')
            ->leftJoin('tipos_estados','direcciones.tipo_estado_id', '=', 'tipos_estados.tipo_estado_id')
            ->where('direcciones.tipo_estado_id','=', '1');
       
        if($request->buscarTexto){

            $direcciones->where('direcciones.direccion_id','=', $request->buscarTexto); 
            $direcciones->orWhere('direcciones.direccion_nomencla','=', $request->buscarTexto); 
            $direcciones->orWhere('nombre','LIKE', "%" . $request->buscarTexto . "%"); 
            if((int)$request->buscarTexto){
                $direcciones->orWhere('direcciones.direccion_numeracion','=', $request->buscarTexto); 
            }
            $direcciones->orWhere('vdirecciones.barrio_nombre','LIKE', "%" . $request->buscarTexto . "%"); 
        }        
        
        if($request->param && $order){
            $direcciones = $direcciones->orderBy($request->param,$order)->paginate(10);
        }else{
            $direcciones = $direcciones->orderBy('direcciones.direccion_f_modif','desc')->paginate(10);
        }
        

        $ejes_mendoza = Ejes::orderBy('nombre','asc')->get();

        $Provincias = Provincia::orderBy('provincia_nombre','asc')->get();
        $Departamentos = Departamento::orderBy('departamento_nombre','asc')->get();
        $Distritos = Distrito::orderBy('distrito_nombre','asc')->get();

        return view('gestion.direccion.index',["direcciones"=>$direcciones, "ejes_mendoza"=>$ejes_mendoza, "busqueda"=>$request->buscarTexto??NULL, "Provincias"=>$Provincias, "Departamentos"=>$Departamentos, "Distritos"=>$Distritos, "sorter" => $order]);       
    }

 
    public function store(Request $request)
    {
        $Direccion = new Direccion();
        //dd($request);
        // Armo Nomenclatura
        $ultimaDireccion_id = Direccion::max('direccion_id');
        $ultimaDireccion_id = $ultimaDireccion_id + 1;

        // Completo campos
        // Si se selecciono una calle existente
        if($request->calle_id){
            $calle = Ejes::find($request->calle_id);
            $Direccion->calle_id = $request->calle_id;
            $Direccion->calle_nombre = $request->ejes_mendoza;
            $distrito = Distrito::find($calle->distrito_id);
            $departamento = Departamento::find($distrito->departamento_id);
            $provincia = Provincia::find($departamento->provincia_id);     
            $direccion_nomencla = $provincia->abrev_iso . $departamento->departamento_abrev . $distrito->distrito_abrev . str_pad($ultimaDireccion_id, 8, "0", STR_PAD_LEFT);       
        }else{
            // Si se escribio una calle nueva
            $Direccion->calle_id = null;
            $Direccion->calle_nombre = $request->ejes_mendoza;
            $distrito = Distrito::find($request->distrito_id);
            $departamento = Departamento::find($request->departamento_id);
            $provincia = Provincia::find($request->provincia_id);  
            $direccion_nomencla = $provincia->abrev_iso . $departamento->departamento_abrev . $distrito->distrito_abrev . str_pad($ultimaDireccion_id, 8, "0", STR_PAD_LEFT);       
        }

        $Direccion->direccion_nomencla = $direccion_nomencla;
        $Direccion->distrito_id = $distrito->distrito_id;
        $Direccion->departamento_id = $departamento->departamento_id;
        $Direccion->provincia_id = $provincia->provincia_id;        
        $Direccion->direccion_numeracion = $request->direccion_numeracion;
        $Direccion->barrio_id = $request->barrio_id??0;
        $Direccion->barrio_nombre = $request->barrio_nombre;

        if($request->calle_id == null){
            $Direccion->calle_exter = $request->ejes_mendoza;
        }else{
            $Direccion->calle_exter = null;
        }

        $Direccion->direccion_manzana = $request->direccion_manzana;
        $Direccion->direccion_casa = $request->direccion_casa;
        $Direccion->direccion_local = $request->direccion_local;
        $Direccion->direccion_piso = $request->direccion_piso;
        $Direccion->direccion_depto = $request->direccion_depto;
        $Direccion->direccion_area = $request->direccion_area;
        $Direccion->direccion_torre = $request->direccion_torre;
        $Direccion->direccion_lote = $request->direccion_lote;
        $Direccion->direccion_cp = $request->direccion_cp;
        $Direccion->direccion_observ = $request->direccion_observ;
        $Direccion->direccion_f_alta = now();
        $Direccion->direccion_f_modif = now();
        $Direccion->usuario_id_alta = Auth::user()->usuario_id;        
        $Direccion->usuario_id_modif = Auth::user()->usuario_id;        
        $Direccion->save();      
        return Redirect::to("gestion/direccion")->with("success","Agregado exitosamente");
    }

    public function update(Request $request)
    {
        $Direccion = Direccion::find($request->direccion_id);
        if($Direccion){
            
            if($request->calle_id != null){
                $calle = Ejes::find($request->calle_id);
                
                if($calle != null){
                    $request["usuario_id_modif"] =  Auth::user()->usuario_id;
                    $request["direccion_f_modif"] =  date("Y-m-d H:i:s");
                    $Direccion->update($request->all());
                }else{
                    return back()->with('error','La calle seleccionada no existe');
                    
                }
            }else{

                $request["calle_nombre"] = $request->ejes_mendoza;
                $request["usuario_id_modif"] =  Auth::user()->usuario_id;
                $request["direccion_f_modif"] =  date("Y-m-d H:i:s");
                    $Direccion->update($request->all());   
            }

        }else{

            return back()->with('error','La dirección seleccionada no existe');

        }

        return Redirect::to("gestion/direccion")->with("success","Actualizado exitosamente");        
    }

    
    public function autocompletar_direcciones(){
        
        $ejes = Ejes::select(
            DB::raw('CONCAT(nombre, " - ",distritos.distrito_nombre, " - ",departamentos.departamento_nombre, " - ",provincias.provincia_nombre ) as value'),
            'eje_id','ejes_mendoza.provincia_id','ejes_mendoza.departamento_id','ejes_mendoza.distrito_id')
            ->leftJoin('gestion_direcciones.distritos','ejes_mendoza.distrito_id', '=', 'distritos.distrito_id')
            ->leftJoin('gestion_direcciones.departamentos','distritos.departamento_id', '=', 'departamentos.departamento_id')
            ->leftJoin('gestion_direcciones.provincias','departamentos.provincia_id', '=', 'provincias.provincia_id')
            ->orderBy('eje_id','asc')->get();
        
            return Response::json(
                array(
                    "success" => true,
                    "ejes" => $ejes
                )
                ,200);
    }    
    
    public function autocompletar_barrios(){
        
        $barrios = Barrio::select(
            DB::raw('CONCAT(barrio_nombre, " - ",distritos.distrito_nombre, " - ",departamentos.departamento_nombre, " - ",provincias.provincia_nombre ) as value'),
            'barrio_id')
            ->leftJoin('gestion_direcciones.distritos','barrios.distrito_id', '=', 'distritos.distrito_id')
            ->leftJoin('gestion_direcciones.departamentos','distritos.departamento_id', '=', 'departamentos.departamento_id')
            ->leftJoin('gestion_direcciones.provincias','departamentos.provincia_id', '=', 'provincias.provincia_id')
            ->orderBy('barrio_id','asc')->get();
        
            return Response::json(
                array(
                    "success" => true,
                    "barrios" => $barrios
                )
                ,200);
    }

    public function iframe(Request $request){
        /*listar los roles en ventana modal*/
        $direcciones = Direccion::orderBy('direccion_id','asc')->paginate(10);

        $direcciones = Direccion::select(
            'direcciones.*',
            DB::raw('CONCAT(ejes_mendoza.nombre, " - ",vdirecciones.distrito_nombre, " - ",vdirecciones.departamento_nombre, " - ",vdirecciones.provincia_nombre ) as nombre'),
            'vdirecciones.barrio_nombre',
            DB::raw('CONCAT(vdirecciones.barrio_nombre, " - ",vdirecciones.distrito_nombre, " - ",vdirecciones.departamento_nombre, " - ",vdirecciones.provincia_nombre ) as barrio_nombre'),
            'tipo_estado_descrip')
            ->leftJoin('ejes_mendoza','direcciones.calle_id', '=', 'ejes_mendoza.eje_id')
            ->leftJoin('vdirecciones','direcciones.direccion_id', '=', 'vdirecciones.direccion_id')
            ->leftJoin('tipos_estados','direcciones.tipo_estado_id', '=', 'tipos_estados.tipo_estado_id')
            ->where('direcciones.tipo_estado_id','=', '1');

            if($request->buscarTexto){
                $direcciones->where('direcciones.direccion_id','=', $request->buscarTexto); 
                $direcciones->orWhere('direcciones.direccion_nomencla','=', $request->buscarTexto); 
                $direcciones->orWhere('nombre','LIKE', "%" . $request->buscarTexto . "%"); 
                if((int)$request->buscarTexto){
                    $direcciones->orWhere('direcciones.direccion_numeracion','=', $request->buscarTexto); 
                }
                $direcciones->orWhere('vdirecciones.barrio_nombre','LIKE', "%" . $request->buscarTexto . "%"); 
            }        
            
            $direcciones = $direcciones->orderBy('direcciones.direccion_id','asc')->paginate(10);
            
        /*$parcelas = Parcela::orderBy('parcelas.parcela_id','asc')
        ->rightJoin('gestion_direcciones.direcciones','gestion_direcciones.direcciones.direccion_nomencla', '=', 'parcelas.direccion_nomencla_rud_real')
        ->get();
        dd($parcelas);*/
        
        $ejes_mendoza = Ejes::orderBy('nombre','asc')->get();
        
        $Provincias = Provincia::orderBy('provincia_nombre','asc')->get();
        $Departamentos = Departamento::orderBy('departamento_nombre','asc')->get();
        $Distritos = Distrito::orderBy('distrito_nombre','asc')->get();

        return view('gestion.direccion.grillaDirecciones',["direcciones"=>$direcciones, "ejes_mendoza"=>$ejes_mendoza, "Provincias"=>$Provincias, "Departamentos"=>$Departamentos, "Distritos"=>$Distritos]);       
    }

    
    public function iframe_parcelas(Request $request){

        $order = $request->order ? $request->order : null;
        
        $parcelas = Parcela::where('parcela_nomenclatura','LIKE', substr($request->asignar,0,16).'%')->get();
        
        $direcciones = Direccion::select(
            'direcciones.*',
            DB::raw('CONCAT(ejes_mendoza.nombre, " - ",vdirecciones.distrito_nombre, " - ",vdirecciones.departamento_nombre, " - ",vdirecciones.provincia_nombre ) as nombre'),
            'vdirecciones.barrio_nombre',
            DB::raw('CONCAT(vdirecciones.barrio_nombre, " - ",vdirecciones.distrito_nombre, " - ",vdirecciones.departamento_nombre, " - ",vdirecciones.provincia_nombre ) as barrio_nombre'),
            'tipo_estado_descrip')
            ->leftJoin('ejes_mendoza','direcciones.calle_id', '=', 'ejes_mendoza.eje_id')
            ->leftJoin('vdirecciones','direcciones.direccion_id', '=', 'vdirecciones.direccion_id')
            ->leftJoin('tipos_estados','direcciones.tipo_estado_id', '=', 'tipos_estados.tipo_estado_id');

        foreach ($parcelas as $parcela) {
            if($parcela->direccion_nomencla_rud_real){
                $direcciones->orWhere('direcciones.direccion_nomencla','=',$parcela->direccion_nomencla_rud_real);
            }
        }

        $direcciones->where('direcciones.tipo_estado_id','=', '1');


        if($request->param && $order){
            $direcciones = $direcciones->orderBy($request->param,$order)->paginate(10);
        }else{
            $direcciones = $direcciones->orderBy('direcciones.direccion_f_modif','desc')->paginate(10);
        }

        return view('gestion.direccion.grillaDirecciones_parcelas',["direcciones"=>$direcciones, "sorter" => $order]);       
    }


}