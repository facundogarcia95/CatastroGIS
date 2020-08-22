<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Compra;
use App\Producto;
use App\DetalleCompra;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use DB;


class CompraController extends Controller
{

    public function index(Request $request){
      
        if($request){
        
            $sql=trim($request->get('buscarTexto'));
            $compras=Compra::join('proveedores','compras.idproveedor','=','proveedores.id')
            ->join('users','compras.idusuario','=','users.id')
            ->join('detalle_compras','compras.id','=','detalle_compras.idcompra')
             ->select('compras.id','compras.tipo_identificacion',
             'compras.num_compra','compras.created_at as fecha_compra','compras.impuesto',
             'compras.estado','compras.total','proveedores.nombre as proveedor','users.nombre')
            ->where('compras.num_compra','LIKE','%'.$sql.'%')
            ->orWhere('compras.created_at','LIKE','%'.$sql.'%')
            ->orderBy('compras.id','desc')
            ->groupBy('compras.id','compras.tipo_identificacion',
            'compras.num_compra','compras.created_at','compras.impuesto',
            'compras.estado','compras.total','proveedores.nombre','users.nombre','users.idrol')
            ->paginate(10);
             
            $usuarioRol = \Auth::user()->idrol;
 
            return view('compra.index',["compras"=>$compras,"usuarioRol"=>$usuarioRol,"buscarTexto"=>$sql]);
            
            //return $compras;
        }
      
 
     }
 
        public function create(){
 
             /*listar las proveedores en ventana modal*/
             $proveedores=DB::table('proveedores')->get();
            
             /*listar los productos en ventana modal*/
             $productos=DB::table('productos as prod')
             ->join('unidad_medidas as uni','prod.unidad_medida', '=','uni.id')
             ->select(DB::raw('CONCAT(prod.codigo," - ",prod.nombre) AS producto'),'prod.id', 'uni.unidad')
             ->where('prod.condicion','=','1')
             ->where('prod.idreceta','=',null)
             ->get(); 
 
             $negocio=DB::table('negocio')->get();

             return view('compra.create',["proveedores"=>$proveedores,"productos"=>$productos, "negocio"=>$negocio]);
  
        }
 
         public function store(Request $request){
         
         //dd($request->all());
 
             try{
 

                 DB::beginTransaction();
 
                 $mytime= Carbon::now('America/Argentina/Mendoza');
 
                 $compra = new Compra();
                 $compra->idproveedor = $request->id_proveedor;
                 $compra->idusuario = \Auth::user()->id;
                 $compra->tipo_identificacion = $request->tipo_identificacion;
                 $compra->num_compra = $request->num_compra??0;
                 $compra->fecha_compra = $mytime->toDateString();
                 $compra->impuesto = $request->impuestoHidden??0;
                 $compra->total = $request->total_pagar;
                 $compra->estado = 'Registrado';
                 $compra->save();
 
                 $id_producto=$request->id_producto;
                 $cantidad=$request->cantidad;
                 $precio=$request->precio_compra;
                
 
                 
                 //Recorro todos los elementos
                 $cont=0;
     
                  while($cont < count($id_producto)){
 
                     $detalle = new DetalleCompra();
                     /*enviamos valores a las propiedades del objeto detalle*/
                     /*al idcompra del objeto detalle le envio el id del objeto compra, que es el objeto que se ingresó en la tabla compras de la bd*/
                     $detalle->idcompra = $compra->id;
                     $detalle->idproducto = $id_producto[$cont];
                     $detalle->cantidad = $cantidad[$cont];
                     $detalle->precio = $precio[$cont];    
                     $detalle->save();
                   
                     
                     $producto = Producto::findOrFail($id_producto[$cont]);
                     $producto->stock = $producto->stock +$cantidad[$cont];
                     $producto->save();

                     $cont=$cont+1;
                     
                 }
                     
                 DB::commit();

             } catch(Exception $e){
                 
                 DB::rollBack();
             }
 
             return Redirect::to('compra');
         }
 
         public function show($id){
 
             $compra = Compra::join('proveedores','compras.idproveedor','=','proveedores.id')
             ->join('detalle_compras','compras.id','=','detalle_compras.idcompra')
             ->select('compras.id','compras.tipo_identificacion',
             'compras.num_compra','compras.created_at as fecha_compra','compras.impuesto',
             'compras.estado',DB::raw('sum(detalle_compras.cantidad*precio) as total'),'proveedores.nombre','compras.observacion')
             ->where('compras.id','=',$id)
             ->orderBy('compras.id', 'desc')
             ->groupBy('compras.id','compras.tipo_identificacion',
             'compras.num_compra','compras.created_at','compras.impuesto',
             'compras.estado','proveedores.nombre','compras.observacion')
             ->first();
 
             /*mostrar detalles*/
             $detalles = DetalleCompra::join('productos','detalle_compras.idproducto','=','productos.id')
             ->select('detalle_compras.cantidad','detalle_compras.precio','productos.nombre as producto')
             ->where('detalle_compras.idcompra','=',$id)
             ->orderBy('detalle_compras.id', 'desc')->get();
             
             $negocio = DB::table('negocio')->get();

             return view('compra.show',['compra' => $compra,'detalles' =>$detalles,'negocio'=>$negocio]);
         }
         
         public function destroy(Request $request){
 
     
            try{
 

                DB::beginTransaction();

                 $compra = Compra::findOrFail($request->id_compra);
                 $compra->estado = 'Anulado';
                 $compra->observacion = $request->observacion;
                 $compra->idusuario = \Auth::user()->idrol;
                 $compra->save();

                DB::statement('UPDATE productos p
                 JOIN detalle_compras di
                 ON di.idproducto = p.id
                 AND di.idcompra = :idcompra
                 SET p.stock = p.stock - di.cantidad', array('idcompra' => $request->id_compra));

                DB::commit();

            } catch(Exception $e){
                    
                DB::rollBack();
            }

            return Redirect::to('compra');
 
     }
 
         public function pdf(Request $request,$id){
         
             $compra = Compra::join('proveedores','compras.idproveedor','=','proveedores.id')
             ->join('users','compras.idusuario','=','users.id')
             ->join('detalle_compras','compras.id','=','detalle_compras.idcompra')
             ->select('compras.id','compras.tipo_identificacion',
             'compras.num_compra','compras.created_at','compras.impuesto',DB::raw('sum(detalle_compras.cantidad*precio) as total'),
             'compras.estado','proveedores.nombre','proveedores.tipo_documento','proveedores.num_documento',
             'proveedores.direccion','proveedores.email','proveedores.telefono','users.usuario')
             ->where('compras.id','=',$id)
             ->orderBy('compras.id', 'desc')
             ->groupBy('compras.id','compras.tipo_identificacion',
             'compras.num_compra','compras.created_at','compras.impuesto',
             'compras.estado','proveedores.nombre','proveedores.tipo_documento','proveedores.num_documento',
             'proveedores.direccion','proveedores.email','proveedores.telefono','users.usuario')
             ->take(1)->get();
 
             $detalles = DetalleCompra::join('productos','detalle_compras.idproducto','=','productos.id')
             ->select('detalle_compras.cantidad','detalle_compras.precio',
             'productos.nombre as producto')
             ->where('detalle_compras.idcompra','=',$id)
             ->orderBy('detalle_compras.id', 'desc')->get();
 
             $numcompra=Compra::select('num_compra')->where('id',$id)->get();
             
             $negocio=DB::table('negocio')->first();

             $pdf= \PDF::loadView('pdf.compra',['compra'=>$compra,'detalles'=>$detalles,'negocio'=>$negocio]);
             return $pdf->stream();
         }
 
 
}
