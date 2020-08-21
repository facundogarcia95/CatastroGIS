<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Negocio;

class NegocioController extends Controller
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
    public function create()
    {
        $negocio = DB::table('negocio')->first();
        return $negocio;
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
    public function update(Request $request)
    {

        $this->validate($request,[
            'Nombre' => 'required|string',
            'impuesto' =>'required'
        ]);


        $negocio= Negocio::findOrFail($request->id);
        $negocio->Nombre = strtoupper($request->Nombre);
        $negocio->Cuil = $request->Cuil;
        $negocio->Email = $request->Email;
        $negocio->Instagram = $request->Instagram;
        $negocio->Facebook = $request->Facebook;
        $negocio->impuesto = $request->impuesto;
        $negocio->Direccion = $request->Direccion;
        $negocio->Telefono = $request->Telefono;
        $negocio->web = $request->web;

        //Handle File Upload
        if($request->hasFile('logo')){

        //Get filename with the extension
        $filenamewithExt = $request->file('logo')->getClientOriginalName();
        
        //Get just filename
        $filename = pathinfo($filenamewithExt,PATHINFO_FILENAME);
        
        //Get just ext
        $extension = $request->file('logo')->guessClientExtension();
        
        //FileName to store
        $fileNameToStore = time().'.'.$extension;
        
        //Create Image
        $path = $request->file('logo')->storeAs('usuario',$fileNameToStore,'public');

    
        }else{

            $fileNameToStore="noimagen.jpg";

        }
        
        $negocio->logo=$fileNameToStore;


        $negocio->save();

        return back();

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
