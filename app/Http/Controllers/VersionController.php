<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class VersionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $versiones = DB::table('versiones')->get();

        return view('version.listado',["versiones"=>$versiones]);
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
    public function version()
    {
        $respuesta = DB::table('versiones')
        ->select('version')
        ->orderBy('fecha','DESC')
        ->first();

        return $respuesta->version;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $version = DB::table('versiones')
        ->select('id','version','descripcion','fecha')
        ->where('id','=',$id)
        ->orderBy('fecha','DESC')
        ->first();

        
        $detalles = DB::table('detalle_versiones')
        ->join('versiones','detalle_versiones.idversion','=','versiones.id')
        ->select('detalle_versiones.titulo','detalle_versiones.descripcion')
        ->where('detalle_versiones.idversion','=',$id)
        ->get();


        return view('version.versiones',["version"=>$version,"detalles"=>$detalles]);
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
