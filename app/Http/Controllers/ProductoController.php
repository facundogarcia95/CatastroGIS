<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use DB;

class ProductoController extends Controller
{
    //
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //

        if($request){

            $sql=trim($request->get('buscarTexto'));
            $productos=DB::table('productos as p')
            ->join('categorias as c','p.idcategoria','=','c.id')
            ->join('tipo_productos as t','p.tipo_producto','=','t.id')
            ->join('unidad_medidas as uni','p.unidad_medida','=','uni.id')
            ->select('p.id','p.idcategoria','p.nombre','p.precio_venta','p.codigo','p.stock','p.imagen','p.condicion', 'p.idreceta','c.nombre as categoria', 't.nombre as tipoProducto', 't.id as idtipoproductos', 'uni.id as id_unidad', 'uni.unidad')
            ->where('p.nombre','LIKE','%'.$sql.'%')
            ->orwhere('p.codigo','LIKE','%'.$sql.'%')
            ->orderBy('p.id','desc')
            ->paginate(10);
           
            /*listar las categorias en ventana modal*/
            $categorias=DB::table('categorias')
            ->select('id','nombre','descripcion')
            ->where('condicion','=','1')->get(); 
 

            /*Listar tipo de productos */
            $tipoProductos = DB::table('tipo_productos')
            ->get();

            $unidades = DB::table('unidad_medidas')
            ->get();

            $recetas = DB::table('recetas')
            ->where('recetas.condicion','=','1')
            ->get();

            return view('producto.index',["productos"=>$productos,"categorias"=>$categorias,"buscarTexto"=>$sql,"tipoProductos"=>$tipoProductos, "unidades" => $unidades, "recetas" => $recetas]);
     
            //return $productos;
        }
       
    }

    public function stock($id){

        $respuesta=DB::table('productos as p')
        ->join('recetas','p.idreceta','=','recetas.id')
        ->join('detalle_recetas as d','recetas.id','=','d.idreceta')
        ->join('productos as prod', 'd.idproducto','=','prod.id')
        ->select(DB::raw('round(min(prod.stock / d.cantidad)-0.5) as stock') )
        ->where('p.id','=',$id)->first();

        $producto= Producto::findOrFail($id);
        $producto->stock = $respuesta->stock;
        $producto->save();

        return $respuesta->stock;

    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $existencia = DB::table('productos')
        ->select('codigo')
        ->where("codigo","=",$request->codigo)
        ->get();


        if (!isset($existencia[0])){

                if($request->idTipoProductos == 2){$request->precio_venta = null;}
                $producto= new Producto();
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

                //Get filename with the extension
                $filenamewithExt = $request->file('imagen')->getClientOriginalName();
                
                //Get just filename
                $filename = pathinfo($filenamewithExt,PATHINFO_FILENAME);
                
                //Get just ext
                $extension = $request->file('imagen')->guessClientExtension();
                
                //FileName to store
                $fileNameToStore = time().'.'.$extension;
                
                //Upload Image
                $path = $request->file('imagen')->storeAs('public/img/producto',$fileNameToStore);

            
                } else{

                    $fileNameToStore="noimagen.jpg";
                }
                
                $producto->imagen=$fileNameToStore;


                $producto->save();
                
                return Redirect::to("producto")->with('mensaje', 'Producto Agregado!');

        }else{

                return Redirect::to("producto")->with('error', 'El código de producto ingresado ya existe!');

        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //

        $validar = DB::table('productos')
        ->select('codigo')
        ->where("id","=",$request->id_producto)
        ->get();


        if ($validar[0]->codigo != $request->codigo){

            $existencia = DB::table('productos')
            ->where("codigo","=",$request->codigo)
            ->get();
            
        }

        if(!isset($existencia[0]->codigo)){
                 
            if($request->idTipoProductos == 2){$request->precio_venta = null;}

                $producto= Producto::findOrFail($request->id_producto);
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
                    Storage::delete('public/img/producto/'.$producto->imagen);
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
                $path = $request->file('imagen')->storeAs('public/img/producto',$fileNameToStore);
                
                
                
                } else {
                    
                    $fileNameToStore = $producto->imagen; 
                }

                $producto->imagen=$fileNameToStore;
        
                $producto->save();

                return Redirect::to("producto")->with('mensaje', 'Producto Modificado!');

        }else{

                return Redirect::to("producto")->with('error', 'El código de producto ingresado ya existe!');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        // 
            $producto= Producto::findOrFail($request->id_producto);

            if($producto->condicion=="1"){
                
                $producto->condicion= '0';
                $producto->save();
                return Redirect::to("producto");
        
            } else{

                $producto->condicion= '1';
                $producto->save();
                return Redirect::to("producto");

            }
    }

       public function listarPdf(){


            $productos = Producto::join('categorias','productos.idcategoria','=','categorias.id')
            ->select('productos.id','productos.idcategoria','productos.codigo','productos.nombre','categorias.nombre as nombre_categoria','productos.stock','productos.condicion', 'productos.condicion', 'productos.precio_venta')
            ->where('productos.condicion', '=', '1')
            ->orderBy('productos.nombre', 'desc')->get(); 


            $cont=Producto::count();

            $pdf= \PDF::loadView('pdf.productospdf',['productos'=>$productos,'cont'=>$cont]);
            return $pdf->download('productos.pdf');
          
    }
}
