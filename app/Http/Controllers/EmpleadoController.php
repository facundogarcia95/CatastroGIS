<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Empleado;
use DB;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request){

            $condicion= $request->get('c')??1;

            $empleados=DB::table('empleados')
            ->where('empleados.estado','=',$condicion) 
            ->orderBy('id','desc')
            ->paginate(20);

            return view('empleado.index',["empleados"=>$empleados,'condicionEmpleado'=>$condicion]);
           
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $empleado= new Empleado();
        $empleado->nombre = $request->nombre;
        $empleado->apellido = $request->apellido;
        $empleado->num_documento = $request->num_documento;
        $empleado->fecha_nacimiento = $request->fecha_nacimiento;
        $empleado->direccion = $request->direccion;
        $empleado->telefono = $request->telefono;
        $empleado->email = $request->email;
        $empleado->estado = 1;

             //inicio registrar imagen
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
                $path = $request->file('imagen')->storeAs('empleados',$fileNameToStore,'public');

            
            } else{

                $fileNameToStore="noimagen.jpg";
            }
            
           $empleado->foto=$fileNameToStore;

        $empleado->save();

        return Redirect::to("empleado")->with('mensaje', '¡Empleado Agregado!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $novedades = Empleado::join('novedades', 'empleados.id','=','novedades.idempleado')
        ->join('detalle_novedades','novedades.id','=','detalle_novedades.idnovedad')
        ->select('novedades.*','detalle_novedades.*')
        ->where('empleados.id','=',$id)
        ->orderBy('novedades.id','DESC')
        ->get();

        $empleado = Empleado::findOrFail($id);


        return view('empleado.show',['empleado' => $empleado,'novedades' =>$novedades]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $empleado= Empleado::findOrFail($request->id_empleado);
        $empleado->nombre = $request->nombre;
        $empleado->apellido = $request->apellido;
        $empleado->num_documento = $request->num_documento;
        $empleado->fecha_nacimiento = $request->fecha_nacimiento;
        $empleado->direccion = $request->direccion;
        $empleado->telefono = $request->telefono;
        $empleado->email = $request->email;

             //inicio registrar imagen
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
                $path = $request->file('imagen')->storeAs('empleados',$fileNameToStore,'public');
                
                $empleado->foto=$fileNameToStore;
            
        }
            
           

        $empleado->save();

        return Redirect::to("empleado")->with('mensaje', '¡Empleado Actualizado!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $empleado= Empleado::findOrFail($request->id_empleado);

        if($empleado->estado == 1){
            
            $empleado->estado = 0;
            $empleado->save();
           
    
        } else{

            $empleado->estado = 1;
            $empleado->save();

        }

        return back()->with('mensaje', '¡Estado Actualizado!');
    }
}
