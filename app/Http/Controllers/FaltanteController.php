<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Faltante;
use App\DetalleFaltante;
use App\Producto;
use DB;


class FaltanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request){
        
            $sql=trim($request->get('buscarTexto'));
            $faltantes=Faltante::join('users','faltantes.idusuario','=','users.id')
            ->join('detalle_faltantes','faltantes.id','=','detalle_faltantes.idfaltante')
            ->select('faltantes.id','faltantes.created_at',
             'users.nombre','faltantes.motivo','faltantes.condicion')
            ->where('faltantes.motivo','LIKE','%'.$sql.'%')
            ->orWhere('faltantes.observacion','LIKE','%'.$sql.'%')
            ->orderBy('faltantes.id','desc')
            ->groupBy('faltantes.id','faltantes.created_at',
            'users.nombre','faltantes.motivo','faltantes.condicion')
            ->paginate(8);
             
            $usuarioRol = \Auth::user()->idrol;
 
            return view('faltante.index',["faltantes"=>$faltantes,"usuarioRol"=>$usuarioRol,"buscarTexto"=>$sql]);
            
            //return $compras;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         /*listar los productos en ventana modal*/
         $productos=DB::table('productos as prod')
         ->join('unidad_medidas as uni','prod.unidad_medida', '=','uni.id')
         ->select(DB::raw('CONCAT(prod.codigo," - ",prod.nombre) AS producto'),'prod.id', 'uni.unidad')
         ->where('prod.condicion','=','1')
         ->where('prod.idreceta','=',null)
         ->get();

         return view('faltante.create',["productos"=>$productos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{

             DB::beginTransaction();

             $faltante = new Faltante();
             $faltante->idusuario = \Auth::user()->id;
             $faltante->motivo = $request->motivo;
             $faltante->observacion = $request->observacion;
             $faltante->condicion = 1;
             $faltante->save();

             $id_producto=$request->id_producto;
             $cantidad=$request->cantidad;

             
             //Recorro todos los elementos
             $cont=0;
 
              while($cont < count($id_producto)){

                 $detalle = new DetalleFaltante();
                 /*enviamos valores a las propiedades del objeto detalle*/
                 /*al idcompra del objeto detalle le envio el id del objeto compra, que es el objeto que se ingresó en la tabla compras de la bd*/
                 $detalle->idfaltante = $faltante->id;
                 $detalle->idproducto = $id_producto[$cont];
                 $detalle->cantidad = $cantidad[$cont];
                 $detalle->save();
                 $cont=$cont+1;
             }
                 
             DB::commit();

         } catch(Exception $e){
             
             DB::rollBack();
         }

         return Redirect::to('faltante');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $faltante = Faltante::join('users','faltantes.idusuario','=','users.id')
        ->join('detalle_faltantes','faltantes.id','=','detalle_faltantes.idfaltante')
        ->select('faltantes.id','faltantes.motivo',
        'faltantes.observacion','faltantes.created_at','users.nombre')
        ->where('faltantes.id','=',$id)
        ->orderBy('faltantes.id', 'desc')
        ->groupBy('faltantes.id','faltantes.motivo',
        'faltantes.observacion','faltantes.created_at','users.nombre')
        ->first();

        /*mostrar detalles*/
        $detalles = DetalleFaltante::join('productos','detalle_faltantes.idproducto','=','productos.id')
        ->join('unidad_medidas','productos.unidad_medida','=','unidad_medidas.id')
        ->select('detalle_faltantes.cantidad','productos.nombre as producto','unidad_medidas.unidad')
        ->where('detalle_faltantes.idfaltante','=',$id)
        ->orderBy('detalle_faltantes.id', 'desc')->get();
        
        return view('faltante.show',['faltante' => $faltante,'detalles' =>$detalles]);
    }


    public function destroy(Request $request)
    {
        $faltante = Faltante::findOrFail($request->idfaltante);
        $faltante->condicion = 2;
        $faltante->save();
        return Redirect::to('faltante');
    }

    public function listarPDF(){

        $faltantes = Faltante::join('detalle_faltantes','faltantes.id','=','detalle_faltantes.idfaltante')
        ->join('productos','detalle_faltantes.idproducto','=','productos.id')
        ->join('categorias','productos.idcategoria','=','categorias.id')
        ->select('productos.codigo','productos.nombre','categorias.nombre as nombre_categoria','detalle_faltantes.cantidad','faltantes.motivo')
        ->where('faltantes.condicion', '=', '1')
        ->orderBy('faltantes.created_at', 'desc')->get(); 


        $cont=Faltante::count()
        ->where('fatantes.condicion','=','1');

        $pdf= \PDF::loadView('pdf.faltantespdf',['faltantes'=>$faltantes,'cont'=>$cont]);
        return $pdf->download('faltantes.pdf');
    }
}
