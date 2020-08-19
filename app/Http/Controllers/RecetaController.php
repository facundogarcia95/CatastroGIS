<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Receta;
use App\DetalleReceta;
use Illuminate\Support\Facades\Redirect;
use App\Producto;
use App\Http\Controllers\ProductoController;
use DB;


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
         ->select('recetas.id','recetas.nombre','recetas.condicion','recetas.created_at','users.nombre as usuario')
        ->where('recetas.nombre','LIKE','%'.$sql.'%')
        ->where('recetas.condicion','=','1')
        ->orderBy('recetas.id','desc')
        ->groupBy('recetas.id','recetas.nombre','recetas.condicion','users.nombre','recetas.created_at')
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
            

        $categorias = DB::table('categorias')
        ->select('id','nombre')
        ->get();

        $unidades = DB::table('unidad_medidas')
        ->select('id','unidad')
        ->get();

         /*listar los productos en ventana modal*/
         $productos=DB::table('productos as prod')
         ->join('unidad_medidas','prod.unidad_medida','=','unidad_medidas.id')
         ->select(DB::raw('CONCAT("#",prod.codigo," - ",prod.nombre) AS producto'),'prod.id', 'unidad_medidas.unidad')
         ->where('prod.condicion','=','1')
         ->where('prod.tipo_producto','=','3')
         ->get(); 

         return view('receta.create',["productos"=>$productos,"categorias" => $categorias, "unidades" => $unidades]);
    }

    public function edit($id){

        $categorias = DB::table('categorias')
        ->select('id','nombre')
        ->get();

        $unidades = DB::table('unidad_medidas')
        ->select('id','unidad')
        ->get();

         /*listar los productos en ventana modal*/
         $insumos=DB::table('productos as prod')
         ->join('unidad_medidas','prod.unidad_medida','=','unidad_medidas.id')
         ->select('prod.nombre as producto','prod.id', 'unidad_medidas.unidad')
         ->where('prod.condicion','=','1')
         ->where('prod.tipo_producto','=','3')
         ->get();

        
         $productoEditar = DB::table('productos')
         ->where('productos.id','=',$id)
         ->get();

         $insumosEditar = DB::table('productos as p')
         ->join('recetas','p.idreceta','=','recetas.id')
         ->join('detalle_recetas','recetas.id','=','detalle_recetas.idreceta')
         ->join('productos as prod','detalle_recetas.idproducto','=','prod.id')
         ->join('unidad_medidas','prod.unidad_medida','=','unidad_medidas.id')
         ->select('prod.id', 'prod.nombre','unidad_medidas.unidad', 'detalle_recetas.cantidad', 'detalle_recetas.id as id_detalle')
         ->where('p.id','=',$id)
         ->get(); 

        

         
        return view('receta.create',["insumosEditar"=>$insumosEditar,"productoEditar"=>$productoEditar,"productos"=>$insumos,"categorias" => $categorias, "unidades" => $unidades]);
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
            'nombre' => 'required|string',
            'idcategoria' =>'required',
            'unidad_medida' =>'required',
            'codigo' => 'required',
            'precio_venta' =>'required'
        ]);


        try{

            DB::beginTransaction();

            $receta = new Receta();
            $receta->idusuario = \Auth::user()->id;
            $receta->save();

            $idreceta = $receta->id;

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

            
            $existencia = DB::table('productos')
            ->select('codigo')
            ->where("codigo","=",$request->codigo)
            ->get();

            if (!isset($existencia[0])){

                $producto = new Producto();
                $producto->idcategoria = $request->idcategoria;
                $producto->codigo = $request->codigo;
                $producto->nombre = strtoupper($request->nombre);
                $producto->precio_venta = $request->precio_venta??0;
                $producto->tipo_producto = 1;
                $producto->idreceta =  $idreceta;
                $producto->unidad_medida = $request->unidad_medida;
                $producto->condicion = 1;

                //Handle File Upload
                if($request->hasFile('imagen')){

                //Get filename with the extension
                $filenamewithExt = $request->file('imagen')->getClientOriginalName();
                
                //Get just filename
                $filename = pathinfo($filenamewithExt,PATHINFO_FILENAME);
                
                //Get just ext
                $extension = $request->file('imagen')->guessClientExtension();
                
                //FileName to store
                $fileNameToStore = time().'.'.$extension;
                
                //Upload Image
                $path = $request->file('imagen')->storeAs('producto',$fileNameToStore,'public');

            
                } else{

                    $fileNameToStore="noimagen.jpg";
                }
                
                $producto->imagen=$fileNameToStore;


                $producto->save();

                DB::commit();

            }else{
                
                DB::rollBack();
                return Redirect::to("receta/create")->with('error', 'El código de producto ingresado ya existe!');
            
            }

            
        
        } catch(Exception $e){
                 
            DB::rollBack();

        }

         return Redirect::to("producto")->with('mensaje', 'Producto Agregado!');
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
             $producto = Producto::join('recetas', 'productos.idreceta','=','recetas.id')
             ->join('users','recetas.idusuario','=','users.id')
             ->join('detalle_recetas','recetas.id','=','detalle_recetas.idreceta')
             ->select('productos.id','productos.nombre','users.nombre as usuario')
             ->where('recetas.id','=',$id)
             ->groupBy('productos.id','productos.nombre','users.nombre')
             ->first();

             
             /*mostrar detalles*/
             $detalles = DetalleReceta::join('productos','detalle_recetas.idproducto','=','productos.id')
             ->join('unidad_medidas','unidad_medidas.id','=','productos.unidad_medida')
             ->select('productos.id','productos.nombre as producto','productos.codigo','detalle_recetas.cantidad','unidad_medidas.unidad')
             ->where('detalle_recetas.idreceta','=',$id)
             ->orderBy('detalle_recetas.id', 'desc')->get();
             
             return view('receta.show',['receta' => $producto,'detalles' =>$detalles]);

    }

   
    public function update(Request $request)
    {
              //
        $this->validate($request,[
            'nombre' => 'required|string',
            'idcategoria' =>'required',
            'unidad_medida' =>'required',
            'codigo' => 'required',
            'precio_venta' =>'required'
        ]);


        $deleted = DB::delete('delete from detalle_recetas where idreceta = ?',[$request->id_receta]);

            $id_producto=$request->id_producto;
            $cantidad=$request->cantidad;
                   
            //Recorro todos los elementos
            $cont=0;

             while($cont < count($id_producto)){

                $detalle = new DetalleReceta();
                $detalle->idreceta = $request->id_receta;
                $detalle->idproducto = $id_producto[$cont];
                $detalle->cantidad = $cantidad[$cont]; 
                $detalle->save();

                $cont++;
            }
    

            $validar = DB::table('productos')
            ->select('codigo')
            ->where("id","=",$request->idproducto)
            ->get();
    
    
            if ($validar[0]->codigo != $request->codigo){
    
                $existencia = DB::table('productos')
                ->where("codigo","=",$request->codigo)
                ->get();
                
            }
    
            if(!isset($existencia[0]->codigo)){
                     
                if($request->idTipoProductos == 2){$request->precio_venta = null;}
    
                    $producto= Producto::findOrFail($request->idproducto);
                    $producto->idcategoria = $request->idcategoria;
                    $producto->codigo = $request->codigo;
                    $producto->nombre = strtoupper($request->nombre);
                    $producto->precio_venta = $request->precio_venta??0;
                    $producto->tipo_producto = $request->idTipoProductos;
                    $producto->idreceta = $request->id_receta??null;
                    $producto->unidad_medida = $request->unidad_medida;
                    $producto->condicion = '1';
    
                    //Handle File Upload
                
                    if($request->hasFile('imagen')){
    
                        /*si la imagen que subes es distinta a la que está por defecto 
                        entonces eliminaría la imagen anterior, eso es para evitar 
                        acumular imagenes en el servidor*/ 
                    if($producto->imagen != 'noimagen.jpg'){ 
                        Storage::delete('public/storage/img/producto/'.$producto->imagen);
                    }
    
                    
                        //Get filename with the extension
                    $filenamewithExt = $request->file('imagen')->getClientOriginalName();
                    
                    //Get just filename
                    $filename = pathinfo($filenamewithExt,PATHINFO_FILENAME);
                    
                    //Get just ext
                    $extension = $request->file('imagen')->guessClientExtension();
                    
                    //FileName to store
                    $fileNameToStore = time().'.'.$extension;
                    
                    //Upload Image
                    $path = $request->file('imagen')->storeAs('producto',$fileNameToStore,'public');
                                       
                    
                    } else {
                        
                        $fileNameToStore = $producto->imagen; 
                    }
    
                    $producto->imagen=$fileNameToStore;
            
                    $producto->save();
    
            }else{
    
                    return Redirect::to("producto")->with('error', 'El código de producto ingresado ya existe!');
    
            }
                    
         return Redirect::to("producto")->with('mensaje', 'Producto Modificado!');   

    }

   
    public function destroy(Request $request){
 
     
        $compra = Receta::findOrFail($request->id_receta);
        $compra->condicion = 0;
        $compra->save();
        
        return Redirect::to('receta');

    }
}
