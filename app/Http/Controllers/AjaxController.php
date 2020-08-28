<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AjaxController extends Controller
{
    // FUNCIONES DE SOLICITUDES AJAX

    public function index(Request $request){
        $funcion = $request->funcion;

        switch ($funcion) {
            case 'precio_compra_por_producto':
                $this->precio_compra_por_producto($request->idproducto);
            break;

            case 'ventas_por_vendedor':
                $this->ventas_por_vendedor($request->idvendedor);
            break;    
            
            case 'ventas_por_producto':
                $this->ventas_por_producto($request->idproducto);
            break; 

            case 'productos_venta':
                $this->productos_venta();
            break;  

            case 'productos_compra':
                $this->productos_compra();
            break;  

            case 'productos_faltante':
                $this->productos_faltante();
            break;  

            case 'productos_agregacion':
                $this->productos_agregacion();
            break;  

            case 'productos_receta':
                $this->productos_receta();
            break;  

            case 'productos_receta_edit':
                $this->productos_receta_edit($request->idproducto);
            break;  

            default:
                return response()->json(['error'=>'Acción no encontrada, intente nuevamente']);
            break;
        }

    }

    public function precio_compra_por_producto($id){
        
        $precios = DB::table('compras as c')
        ->join('detalle_compras as dc','dc.idcompra','=','c.id')
        ->select(DB::raw("DATE_FORMAT(c.fecha_compra,'%b %e %Y') AS t"),'dc.precio as y')
        ->where('dc.idproducto','=',$id)
        ->where(DB::raw('YEAR(c.fecha_compra)'), '=', DB::raw('YEAR(CURDATE())'))
        ->orderBy('c.fecha_compra','ASC')
        ->get();

        
        echo json_encode($precios);

    }

    public function ventas_por_vendedor($id){

        $ventas = DB::table('ventas as v')
        ->join('detalle_ventas as dv','dv.idventa','=','v.id')
        ->select(DB::raw("DATE_FORMAT(v.fecha_venta,'%b %e %Y') AS t"),DB::raw('SUM(v.total) as y'))
        ->where('v.idusuario','=',$id)
        ->where(DB::raw('YEAR(v.fecha_venta)'), '=', DB::raw('YEAR(CURDATE())'))
        ->groupBy('t')
        ->orderBy('v.fecha_venta','ASC')
        ->get();

        
        echo json_encode($ventas);

    } 

    function ventas_por_producto($id){

        $ventas = DB::table('ventas as v')
        ->join('detalle_ventas as dv','dv.idventa','=','v.id')
        ->select(DB::raw("DATE_FORMAT(v.fecha_venta,'%b %e %Y') AS t"),DB::raw('SUM(v.total) as y'))
        ->where('dv.idproducto','=',$id)
        ->where(DB::raw('YEAR(v.fecha_venta)'), '=', DB::raw('YEAR(CURDATE())'))
        ->groupBy('t')
        ->orderBy('v.fecha_venta','ASC')
        ->get();

        
        echo json_encode($ventas);
        
    }

    public function productos_venta(){
        
        $respuesta = DB::table('productos as p')
        ->select('p.id', 'p.nombre')
        ->where('p.tipo_producto','!=',3)
        ->where('p.condicion','=',1)
        ->where('p.stock','>',0)
        ->orderBy('p.nombre','ASC')
        ->get();

        $productos = array();
        
        foreach($respuesta as $res){

            $producto = array(
                'value'=> utf8_encode($res->nombre),
                'id'=> $res->id
                );
                array_push($productos,$producto);
        }

        
        echo json_encode($productos);

    }

    public function productos_compra(){
        
        $respuesta = DB::table('productos as p')
        ->select('p.id', 'p.nombre')
        ->where('p.tipo_producto','!=',1)
        ->where('p.condicion','=',1)
        ->orderBy('p.nombre','ASC')
        ->get();

        $productos = array();
        
        foreach($respuesta as $res){

            $producto = array(
                'value'=> utf8_encode($res->nombre),
                'id'=> $res->id
                );
                array_push($productos,$producto);
        }

        
        echo json_encode($productos);

    }


    public function productos_faltante(){
        
        $respuesta = DB::table('productos as p')
        ->select('p.id', 'p.nombre')
        ->where('p.tipo_producto','!=',1)
        ->where('p.stock','>',0)
        ->orderBy('p.nombre','ASC')
        ->get();

        $productos = array();
        
        foreach($respuesta as $res){

            $producto = array(
                'value'=> utf8_encode($res->nombre),
                'id'=> $res->id
                );
                array_push($productos,$producto);
        }

        
        echo json_encode($productos);

    }

    public function productos_agregacion(){
        
        $respuesta = DB::table('productos as p')
        ->select('p.id', 'p.nombre')
        ->where('p.tipo_producto','!=',1)
        ->orderBy('p.nombre','ASC')
        ->get();

        $productos = array();
        
        foreach($respuesta as $res){

            $producto = array(
                'value'=> utf8_encode($res->nombre),
                'id'=> $res->id
                );
                array_push($productos,$producto);
        }

        
        echo json_encode($productos);

    }


    public function productos_receta(){
        
        $respuesta = DB::table('productos as p')
        ->select('p.id', 'p.nombre')
        ->where('p.condicion','=',1)
        ->orderBy('p.nombre','ASC')
        ->get();

        $productos = array();
        
        foreach($respuesta as $res){

            $producto = array(
                'value'=> utf8_encode($res->nombre),
                'id'=> $res->id
                );
                array_push($productos,$producto);
        }

        
        echo json_encode($productos);

    }
    

    function productos_receta_edit($id){

        $respuesta = DB::table('productos as p')
        ->select('p.id', 'p.nombre')
        ->where('p.condicion','=',1)
        ->where('p.id','!=',$id)
        ->orderBy('p.nombre','ASC')
        ->get();

        $productos = array();
        
        foreach($respuesta as $res){

            $producto = array(
                'value'=> utf8_encode($res->nombre),
                'id'=> $res->id
                );
                array_push($productos,$producto);
        }

        
        echo json_encode($productos);

    }
    
}
