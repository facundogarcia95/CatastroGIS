<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rol;
use DB;

class RolController extends Controller
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


            $roles=DB::table('roles')->where('nombre','LIKE','%'.$sql.'%')
            ->orderBy('id','desc')
            ->paginate(10);
            return view('rol.index',["roles"=>$roles,"buscarTexto"=>$sql]);
            //return $roles;
       
    }
}
