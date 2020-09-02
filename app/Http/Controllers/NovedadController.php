<?php

namespace App\Http\Controllers;

use Closure;

use App\Empleado;
use App\TipoNovedad;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Redirect;

use App;
use DB;


class NovedadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try{

            $idempleado = Crypt::decrypt($request->get("empleado"));
            $empleado = Empleado::findOrFail($idempleado);
            
            $tipoNovedadesUsadas = DB::table('novedades')
            ->select('idtiponovedad')
            ->where('idempleado','=',$empleado->id)
            ->where('estado','=',1)
            ->groupBy('idtiponovedad')
            ->get();

            $tiposNovedades = DB::table('tipos_novedades')
            ->get();


            foreach($tiposNovedades as $key => $tipo){
                foreach($tipoNovedadesUsadas as $tiposUsadas){
                    if($tipo->id == $tiposUsadas->idtiponovedad){
                        unset($tiposNovedades[$key]);
                    }
                }
            }

        } catch (DecryptException $e) {
            
            App::abort(403, 'Manipulación en la URL.');

        }


        return view('novedad.create',['empleado' => $empleado,'tiposNovedades' =>$tiposNovedades]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function detalleNovedad(Request $request){

        try{
            $idEmpleado = Crypt::decrypt($request->get('empleado'));
            $empleado = Empleado::findOrFail($idEmpleado);

            $idTipo = Crypt::decrypt($request->get('tipo'));
            $tipoNovedad = TipoNovedad::findOrFail($idTipo);


        } catch (DecryptException $e) {
                
            App::abort(403, 'Manipulación en la URL.');
            
        }

        return view('novedad.detalle',["empleado"=>$empleado,"tipoNovedad"=>($tipoNovedad)]);
    }


    public function store(Request $request)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

   
}
