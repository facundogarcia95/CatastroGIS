<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Contracts\Encryption\DecryptException;

use App\Empleado;
use App;
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

        try{
                
            $id = Crypt::decrypt($id);

            $empleado = Empleado::findOrFail($id);

            $novedades = Empleado::join('novedades', 'empleados.id','=','novedades.idempleado')
            ->join('tipos_novedades','novedades.idtiponovedad','=','tipos_novedades.id')
            ->select('novedades.id','tipos_novedades.denominacion')
            ->where('empleados.id','=',$id)
            ->orderBy('tipos_novedades.denominacion','ASC')
            ->get();

            $cantidad = DB::table('tipos_novedades')->get()->count();

        } catch (DecryptException $e) {
            
            App::abort(403, 'Manipulación en la URL.');

        }

        return view('empleado.show',['empleado' => $empleado,'novedades' =>$novedades,'cantidad' => $cantidad]);

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
