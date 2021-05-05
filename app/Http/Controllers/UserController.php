<?php

namespace App\Http\Controllers;

use App\Rol;
use Illuminate\Http\Request;
use App\User;
use App\Seccion;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
    
        $usuario = User::find(Auth::user()->usuario_id);
        if($usuario->idrol == 4){

            $secciones = Seccion::where('tipo_estado_id','=',1)->get();

             $roles=Rol::where('tipo_estado_id','=','1')->get(); 

        }else{
  
            $secciones = Seccion::where('tipo_estado_id','=',1)->get();

             $roles=Rol::where('tipo_estado_id','=',1)->where('grupo_id','!=',4)->get(); 

        }
           
            return view('Usuarios.user.index',["roles"=>$roles,"secciones"=>$secciones]);
             
    }


    public function datatable(Request $request){

        $idrol = Auth::user()->idrol;
        if($idrol == 4){
            $usuarios=User::orderBy('usuarios.usuario_id','desc')->get();
        }else if($idrol == 1){
            $usuarios=User::where('idrol','!=',4)->orderBy('usuarios.usuario_id','desc')->get(); 
        }else{
            $usuarios=User::where('usuario_id','=', Auth::user()->usuario_id)->get();
        }
  
       return  DataTables::of($usuarios)
       ->editColumn('seccion', function(User $user) {
            return $user->seccion->seccion_descrip;
        })->editColumn('rol', function(User $user) {
            return $user->rol->grupo_nombre;
        })->editColumn('estado', function(User $user) {
            if($user->condicion=="1"){
                $estado= '<label  class="text-success "><i class="fa fa-check "></i> Activo</label>';
            }else{
                $estado=  '<label class="text-danger "> <i class="fa fa-check "></i> Desactivado</label>';
            }
           return $estado;
        })->editColumn('accion', function(User $user) {

            $desactivar = "";

            if(Auth::user()->idrol == 4 || Auth::user()->idrol == 1){

                if($user->condicion){

                    if($user->idrol != 4 || Auth::user()->idrol == 4){
                        $desactivar = '<button type="button" class="btn btn-danger rounded  btn-sm" 
                        data-id_usuario="'.$user->usuario_id.'" 
                        data-toggle="modal" data-target="#cambiarEstadoUsuario">
                        <i class="fa fa-times fa-2x"></i> Desactivar
                        </button>';
                    }

                }else{
                    if($user->idrol != 4 || Auth::user()->idrol == 4){
                        $desactivar = ' <button type="button" class="btn btn-success rounded  btn-sm" 
                        data-id_usuario="'.$user->usuario_id.'" 
                        data-toggle="modal" data-target="#cambiarEstadoUsuario">
                        <i class="fa fa-times fa-2x"></i> Activar
                        </button>';
                    }
                }

            }

            return '<button type="button" class="btn btn-warning rounded text-light btn-sm" 
                            data-id_usuario="'.$user->usuario_id.'" 
                            data-nombre="'.$user->usuario_nombre.'" 
                            data-tipo_documento="'.$user->tipo_documento.'" 
                            data-num_documento="'.$user->num_documento.'"  
                            data-email="'.$user->email.'" 
                            data-id_rol="'.$user->idrol.'"  
                            data-usuario="'.$user->usuario_login.'" 
                            data-seccion="'.$user->idseccion.'"  
                            data-imagen="'.$user->imagen.'"  
                            data-toggle="modal" data-target="#abrirmodalEditarUsuario">
                        <i class="fa fa-edit fa-2x"></i> Editar
                    </button> &nbsp;'.$desactivar;
        })->rawColumns(['seccion','rol','estado','accion'])
           ->make(true);

   }

    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'nombre' => 'required',
            'usuario' => 'required',
            'password' => 'required'
        ]);

        if($validatedData){

        $user= new User();
        $user->usuario_nombre = $request->nombre;
        $user->tipo_documento = $request->tipo_documento;
        $user->num_documento = $request->num_documento;
        $user->email = $request->email;
        $user->usuario_login = $request->usuario;
        $user->password = bcrypt( $request->password);
        $user->condicion = '1';
        $user->idrol = $request->id_rol;  
        $user->idseccion = $request->seccion_id; 
        $user->created_at = now(); 
          
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
                $path = $request->file('imagen')->storeAs('usuario',$fileNameToStore,'public');

            
            } else{

                $fileNameToStore="noimagen.jpg";
            }
            
           $user->imagen=$fileNameToStore;

            //fin registrar imagen
            $user->save();
        }
            
            return Redirect::to("Usuarios/user"); 
    }

    public function update(Request $request)
    {
        //
            
        $validatedData = $request->validate([
            'id_usuario' => 'required',
            'nombre' => 'required',
            'usuario' => 'required'
        ]);

        if($validatedData){

        $user= User::findOrFail($request->id_usuario);
        $user->usuario_nombre = $request->nombre;
        $user->tipo_documento = $request->tipo_documento;
        $user->num_documento = $request->num_documento;
        $user->email = $request->email;
        $user->usuario_login = $request->usuario;
        if($request->password != ""){
            $user->password = bcrypt($request->password);
        }
        $user->condicion = '1';
        $user->idrol = $request->id_rol;   
        $user->idseccion = $request->seccion_id;   
        $user->updated_at = now();   
           
           //Editar imagen

           if($request->hasFile('imagen')){

                    /*si la imagen que subes es distinta a la que está por defecto 
                    entonces eliminaría la imagen anterior, eso es para evitar 
                    acumular imagenes en el servidor*/ 
                if($user->imagen != 'noimagen.jpg'){ 

                    Storage::delete('public/storage/archivos/usuario/'.$user->imagen);
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
                $path = $request->file('imagen')->storeAs('usuario',$fileNameToStore,'public');
                
                
                
            } else {
                
                $fileNameToStore = $user->imagen; 
            }

               $user->imagen=$fileNameToStore;


         //fin editar imagen

          $user->save();
          return Redirect::to("Usuarios/user");

        }else{

            abort(404,'Faltan campos obligatorios');

        }

         
    }


    public function destroy(Request $request)
    {

        $user= User::findOrFail($request->id_usuario);
         
         if($user->condicion=="1"){

                $user->condicion= '0';
                $user->save();
                return Redirect::to("Usuarios/user");

           }else{

                $user->condicion= '1';
                $user->save();
                return Redirect::to("Usuarios/user");

            }
    }




}
