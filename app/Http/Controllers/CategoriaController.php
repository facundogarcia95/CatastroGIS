<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categoria;
use Illuminate\Support\Facades\Redirect;
use DB;


class CategoriaController extends Controller
{
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
            $categorias=DB::table('categorias')->where('nombre','LIKE','%'.$sql.'%')
            ->orderBy('id','desc')
            ->paginate(3);
            return view('categoria.index',["categorias"=>$categorias,"buscarTexto"=>$sql]);
            //return $categorias;
        }
       
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

        $existencia = DB::table('categorias')
        ->select('nombre')
        ->where("nombre","=", strtoupper($request->nombre))
        ->get();


        if (!isset($existencia[0])){

            $categoria= new Categoria();
            $categoria->nombre= strtoupper($request->nombre);
            $categoria->descripcion= $request->descripcion;
            $categoria->condicion= '1';
            $categoria->save();

            return Redirect::to("categoria")->with('mensaje', 'Categoria Agregada!');

        }else{

            return Redirect::to("categoria")->with('error', 'El nombre de Categoria ya existe!');

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

        $validar = DB::table('categorias')
        ->select('nombre')
        ->where("id","=",$request->id_categoria)
        ->get();


        if ($validar[0]->nombre != strtoupper($request->nombre)){

            $existencia = DB::table('categorias')
            ->where("nombre","=",strtoupper($request->nombre))
            ->get();
            
        }

        if (!isset($existencia[0])){

            $categoria= Categoria::findOrFail($request->id_categoria);
            $categoria->nombre= strtoupper($request->nombre);
            $categoria->descripcion= $request->descripcion;
            $categoria->condicion= '1';
            $categoria->save();

             return Redirect::to("categoria")->with('mensaje', 'Categoria Modificada!');

        }else{

            return Redirect::to("categoria")->with('error', 'El nombre de Categoria ya existe!');

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
            $categoria= Categoria::findOrFail($request->id_categoria);

            if($categoria->condicion=="1"){
                
                $categoria->condicion= '0';
                $categoria->save();
                return Redirect::to("categoria");
        
            } else{

                $categoria->condicion= '1';
                $categoria->save();
                return Redirect::to("categoria");

            }
    }
}
