<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Ajuste;
use App\DetalleAjuste;
use App\Producto;
use DB;


class AjusteController extends Controller
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
            $ajustes=Ajuste::join('users','ajustes.idusuario','=','users.id')
            ->join('detalle_ajustes','ajustes.id','=','detalle_ajustes.idajuste')
            ->select('ajustes.id','ajustes.created_at',
             'users.nombre','ajustes.observacion','ajustes.condicion')
            ->where('ajustes.observacion','LIKE','%'.$sql.'%')
            ->orWhere('detalle_ajustes.motivo','LIKE','%'.$sql.'%')
            ->orderBy('ajustes.id','desc')
            ->groupBy('ajustes.id','ajustes.created_at',
            'users.nombre','ajustes.observacion','ajustes.condicion')
            ->paginate(10);
             
            $usuarioRol = \Auth::user()->idrol;
 
            return view('ajuste.index',["ajustes"=>$ajustes,"usuarioRol"=>$usuarioRol,"buscarTexto"=>$sql]);
            
            //return $compras;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
  
         $productosFaltante=DB::table('productos as prod')
         ->join('unidad_medidas as uni','prod.unidad_medida', '=','uni.id')
         ->select(DB::raw('CONCAT(prod.codigo," - ",prod.nombre) AS producto'),'prod.id', 'uni.unidad','prod.stock')
         ->where('prod.condicion','=','1')
         ->where('prod.tipo_producto','!=',1)
         ->where('prod.stock','>','0')
         ->get();

          $productosAgregacion=DB::table('productos as prod')
          ->join('unidad_medidas as uni','prod.unidad_medida', '=','uni.id')
          ->select(DB::raw('CONCAT(prod.codigo," - ",prod.nombre) AS producto'),'prod.id', 'uni.unidad','prod.stock')
          ->where('prod.condicion','=','1')
          ->where('prod.tipo_producto','!=',1)
          ->get();

         return view('ajuste.create',["productosFaltante"=>$productosFaltante,"productosAgregacion"=>$productosAgregacion]);
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

             $ajuste = new Ajuste();
             $ajuste->idusuario = \Auth::user()->id;
             $ajuste->observacion = $request->observacion;
             $ajuste->condicion = 1;
             $ajuste->tipo_ajuste = $request->tipo_ajuste;
             $ajuste->save();

             $id_producto=$request->id_producto;
             $cantidad=$request->cantidad;
             $motivo=$request->motivo;

             
             //Recorro todos los elementos
             $cont=0;
 
              while($cont < count($id_producto)){
                
                 $detalle = new DetalleAjuste();
                 /*enviamos valores a las propiedades del objeto detalle*/
                 /*al idcompra del objeto detalle le envio el id del objeto compra, que es el objeto que se ingresó en la tabla compras de la bd*/
                 $detalle->idajuste = $ajuste->id;
                 $detalle->idproducto = $id_producto[$cont];
                 $detalle->cantidad = $cantidad[$cont];
                 $detalle->motivo = $motivo[$cont];
                 $detalle->save();

                 if(intval($request->tipo_ajuste) == 1){
                    $producto = Producto::findOrFail($id_producto[$cont]);
                    $producto->stock = $producto->stock - $cantidad[$cont];
                    $producto->save();
                 }else if(intval($request->tipo_ajuste) == 2){
                    $producto = Producto::findOrFail($id_producto[$cont]);
                    $producto->stock = $producto->stock + $cantidad[$cont];
                    $producto->save();
                 }

                 $cont=$cont+1;
             }
                 
             DB::commit();

         } catch(Exception $e){
             
             DB::rollBack();
         }

         return Redirect::to('ajuste');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ajuste = Ajuste::join('users','ajustes.idusuario','=','users.id')
        ->join('detalle_ajustes','ajustes.id','=','detalle_ajustes.idajuste')
        ->select('ajustes.id',
        'ajustes.observacion','ajustes.created_at','users.nombre')
        ->where('ajustes.id','=',$id)
        ->orderBy('ajustes.id', 'desc')
        ->groupBy('ajustes.id','ajustes.observacion','ajustes.created_at','users.nombre')
        ->first();

        /*mostrar detalles*/
        $detalles = DetalleAjuste::join('productos','detalle_ajustes.idproducto','=','productos.id')
        ->join('unidad_medidas','productos.unidad_medida','=','unidad_medidas.id')
        ->select('detalle_ajustes.cantidad','productos.nombre as producto','unidad_medidas.unidad','detalle_ajustes.motivo')
        ->where('detalle_ajustes.idajuste','=',$id)
        ->orderBy('detalle_ajustes.id', 'desc')->get();
        
        return view('ajuste.show',['ajuste' => $ajuste,'detalles' =>$detalles]);
    }


    public function destroy(Request $request)
    {
        try{
 

            DB::beginTransaction();

            $ajuste = Ajuste::findOrFail($request->idajuste);
            $ajuste->condicion = 2;
            $ajuste->idusuario = \Auth::user()->idrol;
            $ajuste->save();

            DB::statement('UPDATE productos p
            JOIN detalle_ajustes df
              ON df.idproducto = p.id
             AND df.idajuste= :idajuste
             SET p.stock = p.stock + df.cantidad', array('idajuste' => $request->idajuste));


            DB::commit();

        } catch(Exception $e){
                
            DB::rollBack();
        }
            
        return Redirect::to('ajuste');
    }

    public function listarPDF(){

        $ajustes = Ajuste::join('detalle_ajustes','ajustes.id','=','detalle_ajustes.idajuste')
        ->join('productos','detalle_ajustes.idproducto','=','productos.id')
        ->join('categorias','productos.idcategoria','=','categorias.id')
        ->join('users','ajustes.idusuario','=','users.id')
        ->select('productos.codigo','productos.nombre','categorias.nombre as nombre_categoria','detalle_ajustes.cantidad','detalle_ajustes.motivo','users.nombre as usuario','ajustes.created_at as fecha')
        ->where('ajustes.condicion', '=', '1')
        ->orderBy('ajustes.created_at', 'desc')->get(); 


        $cont= DB::table('ajustes')
        ->select(DB::raw('COUNT(ajustes.id) as cantidad'))
        ->where('ajustes.condicion','=','1')
        ->get();

        $pdf= \PDF::loadView('pdf.ajustespdf',['ajustes'=>$ajustes,'cont'=>$cont[0]]);
        return $pdf->download('ajustes.pdf');
        
    }
}
