<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Receta;
use App\DetalleReceta;

class RecetaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sql=trim($request->get('buscarTexto'));
        $recetas=Receta::join('users','recetas.idusuario','=','users.id')
        ->join('detalle_recetas','recetas.id','=','detalle_recetas.idreceta')
         ->select('recetas.id','recetas.nombre','recetas.condicion','users.nombre')
        ->where('recetas.nombre','LIKE','%'.$sql.'%')
        ->where('recetas.condicion','=','1')
        ->orderBy('recetas.id','desc')
        ->groupBy('recetas.id','recetas.nombre','recetas.condicion','users.nombre')
        ->paginate(8);
         

        return view('receta.index',["recetas"=>$recetas,"buscarTexto"=>$sql]);
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
         ->select(DB::raw('CONCAT(prod.codigo," ",prod.nombre) AS producto'),'prod.id')
         ->where('prod.condicion','=','1')
         ->where('prod.tipo_productos','=','2')
         ->get(); 


         return view('receta.create',["productos"=>$productos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,[
            'nombre' => 'required|string'
        ]);

        try{

            DB::beginTransaction();

            $mytime= Carbon::now('America/Argentina/Mendoza');

            $receta = new Receta();
            $receta->idusuario = \Auth::user()->id;
            $receta->nombre = $request->nombre;
            $receta->condicion = 1;
            $receta->save();

            $id_producto=$request->id_producto;
            $cantidad=$request->cantidad;
           

            
            //Recorro todos los elementos
            $cont=0;

             while($cont < count($id_producto)){

                $detalle = new DetalleReceta();
                /*enviamos valores a las propiedades del objeto detalle*/
                /*al idcompra del objeto detalle le envio el id del objeto compra, que es el objeto que se ingresó en la tabla compras de la bd*/
                $detalle->idreceta = $receta->id;
                $detalle->idproducto = $id_producto[$cont];
                $detalle->cantidad = $cantidad[$cont]; 
                $detalle->save();
                
                $cont++;
            }
                
            DB::commit();

        } catch(Exception $e){
                 
            DB::rollBack();
        }

        return Redirect::to('receta');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

          /*mostrar receta*/
 
             //$id = $request->id;
             $receta=Receta::join('users','recetas.idusuario','=','users.id')
             ->join('detalle_recetas','recetas.id','=','detalle_recetas.idreceta')
             ->select('recetas.id','recetas.nombre','recetas.condicion','users.nombre')
             ->where('recetas.id','=',$id)
             ->where('recetas.condicion','=','1')
             ->orderBy('recetas.id','desc')
             ->groupBy('recetas.id','recetas.nombre','recetas.condicion','users.nombre')
             ->first();

             
             /*mostrar detalles*/
             $detalles = DetalleReceta::join('productos','detalle_recetas.idproducto','=','productos.id')
             ->join('unidad_medidas','unidad_medidas.id','=','productos.unidad_medida')
             ->select('productos.nombre as producto','detalle_recetas.cantidad','unidad_medidas.unidad')
             ->where('detalle_recetas.idreceta','=',$id)
             ->orderBy('detalle_recetas.id', 'desc')->get();
             
             return view('receta.show',['receta' => $receta,'detalles' =>$detalles]);

    }

   
    public function update(Request $request, $id)
    {
        //
    }

   
    public function destroy(Request $request){
 
     
        $compra = Receta::findOrFail($request->id_receta);
        $compra->condicion = 0;
        $compra->save();
        
        return Redirect::to('receta');

    }
}
