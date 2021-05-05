<?php

namespace App\Http\Controllers;

use App\CategoriaRequerimiento;
use App\EstadoRequerimiento;
use App\Events\AsignarUsuariosRequerimiento;
use App\HiloRequerimiento;
use App\Requerimiento;
use App\RequerimientoAsignado;
use App\RequerimientoFile;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Facades\DataTables;

class RequerimientoController extends Controller
{

    public function __construct()
    {
        ini_set('memory_limit', -1);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->middleware('auth');
        $this->middleware('Consulta');

        $requeSeleccionado = false;
        
        if($request->requePendiente){

            $requeSeleccionado = true;
            $noticias = Requerimiento::orderBy('noticia_update','desc')->where('noticia_id','=',$request->requePendiente)->paginate(5);
        
        }else{

          
            if($request->fechaDesde || $request->fechaHasta || $request->buscarTexto || $request->estado){


                $busqueda = $request->all();

                $query = Requerimiento::orderBy('noticia_update','desc');
  
                foreach ($busqueda as $key => $value) {
  
                    if($value != null){

                        switch ($key) {
                                case 'fechaDesde':
                                $query->where('noticia_update','>=',$value);
                                break;
                                case 'fechaHasta':
                                    $query->where('noticia_update','<=',$value);
                                break;
                                case 'buscarTexto':
                                    $query->where('noticia_asunto','like','%'.$value.'%')->orWhere('noticia_id','=',$value);
                                break;
                                case 'estado':
                                    $query->where('estado','=',$value);
                                break;
                                default:
                                    $query->where($key,'=',$value);
                                break;
                        } 

                    }
              
                }

                $noticias = $query->paginate(5);

            }else{

                $noticias = Requerimiento::orderBy('noticia_update','desc')->where('estado','!=',4)->paginate(5);

            }

        }

        $categorias = CategoriaRequerimiento::all();
        $estados = EstadoRequerimiento::where('not_h_desc','!=','Iniciado')->orderBy('not_h_desc','asc')->get();
        $requeridos = Requerimiento::orderBy('noticia_update','desc')->where('estado','=',2)->orWhere('estado','=',1)->count();
        $enpruebas = Requerimiento::orderBy('noticia_update','desc')->where('estado','=',6)->count();
        $cerrados = Requerimiento::orderBy('noticia_update','desc')->where('estado','=',4)->count();
        $reformulados = Requerimiento::orderBy('noticia_update','desc')->where('estado','=',5)->count();
        $enprocesos = Requerimiento::orderBy('noticia_update','desc')->where('estado','=',3)->count();
        $masespecificacion = Requerimiento::orderBy('noticia_update','desc')->where('estado','=',7)->count();
        $usuarios = User::where('condicion','=',1)->orderBy('usuario_nombre','asc')->get();

        return view('home',['noticias' => $noticias, 'categorias' => $categorias, 'estados' => $estados, 'requeridos' => $requeridos, 'enprocesos' => $enprocesos, 'enpruebas' => $enpruebas, 'reformulados' => $reformulados, 'masespecificacion' => $masespecificacion, 'cerrados' => $cerrados, "requeSeleccionado" => $requeSeleccionado,'usuarios'=>$usuarios]);

    }


    public function datatable(){

        if(Auth::user()){

            $requerimientos = Requerimiento::select('noticias.noticia_id','noticias.noticia_asunto','not_h_desc','not_h_icono')
            ->join('noticias_hilos','noticias_hilos.noticia_id','=','noticias.noticia_id')
            ->join('noticias_h_estados','noticias.estado','=','noticias_h_estados.not_h_est_id')
            ->where('noticias_hilos.usuario_id','=',Auth::user()->usuario_id)->where('noticias.estado','!=',4)->groupBy('noticias_hilos.noticia_id')->orderBy('noticias.noticia_update','DESC')->get();

            return  DataTables::of($requerimientos)
            ->editColumn('asunto', function(Requerimiento $requerimiento) {

                $asunto= "<a href='".url('requerimiento?requePendiente='.$requerimiento->noticia_id)."' class='font-weight-bold f-15 text-left text-primary'>".$requerimiento->noticia_asunto."</a>";
                return $asunto;
            })
            ->editColumn('ultima_actividad', function(Requerimiento $requerimiento) {
                $ult= Carbon::parse($requerimiento->ultimoHilo()->noti_hilo_fecha)->diffForHumans();
                return $ult;
            })
            ->editColumn('estado', function(Requerimiento $requerimiento) {
                $url= asset('storage/archivos/iconos/'.$requerimiento->not_h_icono);

                $estado= "<p class='font-weight-bold f-15 text-left text-primary'><label class='text-dark font-weight-bold'>Estado: </label> ".$requerimiento->not_h_desc." <img class='direct-chat-timestamp' style='max-width: 30px' src='".$url."'></p>";
                return $estado;
            })->rawColumns(['asunto','estado'])
            ->make(true);

        }else{

            $requerimientos = Requerimiento::where('usuario_id','=',0);
            return  DataTables::of($requerimientos)
            ->editColumn('asunto', function() {
              return "";
            })
            ->editColumn('estado', function() {
                return "";
            })->rawColumns(['asunto','estado'])
            ->make(true);
        }

    }

    public function cantidadRequesPendiente(){

        $this->middleware('auth');

        $requesPendientes = Requerimiento::join('noticias_hilos','noticias_hilos.noticia_id','=','noticias.noticia_id')
        ->where('noticias_hilos.usuario_id','=',Auth::user()->usuario_id)->where('noticias.estado','!=',4)->groupBy('noticias_hilos.noticia_id')->get();
        
        return $requesPendientes;
    }

    /**
     * Store a newly update resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $this->middleware('auth');
        $this->middleware('Consulta');

        $validatedData = $request->validate([
            'asunto' => 'required',
            'noti_cat_id' => 'required|integer',
            'noti_hilo_texto' => 'required'
        ]);

        if($validatedData){
            $categoria = CategoriaRequerimiento::find($request->noti_cat_id);

            if($categoria){

                $requerimiento = new Requerimiento();
                $requerimiento->noticia_asunto = $request->asunto;
                $requerimiento->noti_cat_id = $request->noti_cat_id;
                $requerimiento->noticia_created = now();
                $requerimiento->noticia_update = now();
                $requerimiento->usuario_id = Auth::user()->usuario_id;
                $requerimiento->estado = $categoria->not_h_est_id;
                $requerimiento->save();

                $hilo = new HiloRequerimiento();
                $hilo->noticia_id = $requerimiento->noticia_id;
                $hilo->noti_hilo_fecha = now();
                $hilo->noti_hilo_texto = $request->noti_hilo_texto;
                $hilo->usuario_id = Auth::user()->usuario_id;
                $hilo->not_h_est_id = $categoria->not_h_est_id;
                $hilo->save();

                if($request->hasFile('archivos')){

                    foreach($request->file('archivos') as $archivo)
                    {
                        //Get filename with the extension
                        $nombreArchivo = $archivo->getClientOriginalName();

                        //Get just ext
                        $extension = $archivo->guessClientExtension();
                            
                        //FileName to store
                        $fileNameToStore = time().'-'.$nombreArchivo;

                        //Upload 
                        $path = $archivo->storeAs('requerimientos',$fileNameToStore,'noticias');

                        if($path){

                            $file = new RequerimientoFile();
                            $file->noticia_hilo_id = $hilo->noti_hilo_id;
                            $file->file_name = $nombreArchivo;
                            $file->file_url = $fileNameToStore;
                            $file->file_datetime = now();
                            $file->usuario_id = Auth::user()->usuario_id;
                            $file->save();
                        }

                    }

                }

                if($request->asignados){

                    event(new AsignarUsuariosRequerimiento($requerimiento,$request->asignados));

                }

                return Redirect::to("home"); 
                
            }else{
                return back()->with('error','Categoría inválida');
            }
   
        }else{
            return back()->with('error','Debe completar los campos obligatorios');
        }

           

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Requerimiento  $requerimiento
     * @return \Illuminate\Http\Response
     */
    public function edit(Requerimiento $requerimiento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Requerimiento  $requerimiento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
        $this->middleware('auth');
        $this->middleware('Consulta');

        $validatedData = $request->validate([
            'noticia_id' => 'required|integer',
            'not_h_est_id' => 'required|integer',
            'noti_hilo_texto' => 'required'
        ]);

        if($validatedData){

            $requerimiento = Requerimiento::findOrFail($request->noticia_id);
            $estado = EstadoRequerimiento::findOrFail($request->not_h_est_id);

            $requerimiento->noticia_update = now();
            $requerimiento->estado = $estado->not_h_est_id;
            $requerimiento->save();

            $hilo = new HiloRequerimiento();
            $hilo->noticia_id = $requerimiento->noticia_id;
            $hilo->noti_hilo_fecha = now();
            $hilo->noti_hilo_texto = $request->noti_hilo_texto;
            $hilo->usuario_id = Auth::user()->usuario_id;
            $hilo->not_h_est_id =  $estado->not_h_est_id;
            $hilo->save();


            if($request->hasFile('archivos')){

                foreach($request->file('archivos') as $archivo)
                {
                    //Get filename with the extension
                    $nombreArchivo = $archivo->getClientOriginalName();

                    //Get just ext
                    $extension = $archivo->guessClientExtension();
                        
                    //FileName to store
                    $fileNameToStore = time().'-'.$nombreArchivo;

                    //Upload 
                    $path = $archivo->storeAs('requerimientos',$fileNameToStore,'noticias');

                    if($path){

                        $file = new RequerimientoFile();
                        $file->noticia_hilo_id = $hilo->noti_hilo_id;
                        $file->file_name = $nombreArchivo;
                        $file->file_url = $fileNameToStore;
                        $file->file_datetime = now();
                        $file->usuario_id = Auth::user()->usuario_id;
                        $file->save();
                    }

                }

            }

            if($request->asignados){

                    event(new AsignarUsuariosRequerimiento($requerimiento,$request->asignados));
            
            }
        }

        return Redirect::to("home"); 

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Requerimiento  $requerimiento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $this->middleware('auth');
        $this->middleware('Consulta');
        
        $requerimiento = Requerimiento::findOrFail($request->noticia_id);
        $requerimiento->estado = 4;
        $requerimiento->save();

        if($request->asignados){

            event(new AsignarUsuariosRequerimiento($requerimiento,$request->asignados));


        }

        return Redirect::to("home"); 
        
    }


}
