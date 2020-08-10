<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        DB::select('SET lc_time_names = "es_ES"');

        $comprasmes=DB::select('SELECT monthname(c.fecha_compra) as mes, sum(c.total) as totalmes from compras c where c.estado="Registrado" group by monthname(c.fecha_compra) order by month(c.fecha_compra) ASC limit 12');
       
        $ventasmes=DB::select('SELECT monthname(v.fecha_venta) as mes, sum(v.total) as totalmes from ventas v where v.estado="Registrado" group by monthname(v.fecha_venta) order by month(v.fecha_venta) ASC limit 12');

        $faltantesmes=DB::select('SELECT MONTHNAME(t.created_at) AS mes, SUM(total) AS totalmes FROM (SELECT (MAX(dc.precio) * df.cantidad) AS total, f.`created_at` FROM detalle_faltantes df INNER JOIN faltantes AS f ON f.id = df.idfaltante INNER JOIN detalle_compras AS dc  ON dc.idproducto = df.idproducto  AND f.condicion = 1 GROUP BY f.id, df.cantidad, f.created_at) AS t GROUP BY MONTHNAME(t.created_at) ORDER BY MONTH(t.created_at) ASC LIMIT 12');
        
        $ventasdia=DB::select('SELECT DATE_FORMAT(v.fecha_venta,"%d/%m/%Y") as dia, sum(v.total) as totaldia from ventas v where v.estado="Registrado" group by v.fecha_venta order by day(v.fecha_venta) desc limit 15');

        $productosvendidos=DB::select('SELECT p.nombre as producto, sum(dv.cantidad) as cantidad from productos p inner join detalle_ventas dv on p.id=dv.idproducto inner join ventas v on dv.idventa=v.id where v.estado="Registrado" and month(v.fecha_venta)=month(curdate()) AND YEAR(v.fecha_venta) = YEAR(CURDATE())   group by p.nombre order by sum(dv.cantidad) desc limit 5');

        $productosmenosvendidos=DB::select('SELECT p.nombre as producto, sum(dv.cantidad) as cantidad from productos p inner join detalle_ventas dv on p.id=dv.idproducto inner join ventas v on dv.idventa=v.id where v.estado="Registrado" and month(v.fecha_venta)=month(curdate()) AND YEAR(v.fecha_venta) = YEAR(CURDATE())   group by p.nombre order by sum(dv.cantidad) asc limit 5');

        $totales=DB::select('SELECT (select ifnull(sum(c.total),0) from compras c where MONTH(c.fecha_compra)= MONTH(curdate()) and c.estado="Registrado") as totalcompra, 
        (select ifnull(sum(v.total),0) from ventas v where MONTH(v.fecha_venta)=MONTH(curdate()) and v.estado="Registrado") as totalventa, 
        (SELECT ifnull(SUM(perdida),0) FROM (SELECT ((MAX(dc.precio)) * df.cantidad) AS perdida FROM detalle_faltantes df INNER JOIN faltantes AS f ON f.id = df.idfaltante INNER JOIN detalle_compras AS dc ON dc.idproducto = df.idproducto WHERE MONTH(f.created_at) = MONTH(CURDATE()) AND f.condicion = 1 GROUP BY df.idfaltante, df.cantidad)AS t) AS ajustes');

        $comprasporproveedor = DB::select('SELECT p.nombre, SUM(total) AS total, MONTH(fecha_compra) AS mes FROM compras INNER JOIN proveedores AS p ON p.id = compras.idproveedor WHERE estado = "Registrado" AND YEAR(compras.fecha_compra) = YEAR(CURDATE()) GROUP BY idproveedor, MONTH(fecha_compra), p.nombre ORDER BY idproveedor,mes DESC LIMIT 12');
        
      
        $datasetProveedoresCompras = [];

        foreach($comprasporproveedor as $reg){
            
            if (array_key_exists($reg->nombre, $datasetProveedoresCompras)){
                
               $data = array("total"=>$reg->total,"mes"=>$reg->mes);
              
               array_push($datasetProveedoresCompras[$reg->nombre],$data);
                
            }else{

                $data =  array("total"=>$reg->total,"mes"=>$reg->mes);
                
                $datasetProveedoresCompras[$reg->nombre] = array();
                array_push($datasetProveedoresCompras[$reg->nombre],$data);

            }
           
        }

        $productos = DB::table('productos')
        ->where('condicion','=','1')
        ->where('tipo_producto','!=','1')
        ->get();

        $vendedores = DB::table('users')
        ->where('condicion','=','1')
        ->where('idrol','!=','3')
        ->get();

        $productosVentas = DB::table('productos')
        ->where('condicion','=','1')
        ->where('tipo_producto','!=','3')
        ->get();

            return view('home',["comprasmes"=>$comprasmes,"ventasmes"=>$ventasmes,"faltantesmes"=>$faltantesmes,"ventasdia"=>$ventasdia,"productosvendidos"=>$productosvendidos,"productosmenosvendidos"=>$productosmenosvendidos,"totales"=>$totales,"comprasporproveedor" =>$datasetProveedoresCompras,'productos'=>$productos,"vendedores"=>$vendedores,"productosVentas"=>$productosVentas]);
    
        }
}
