@php
     setlocale(LC_TIME, "spanish");
@endphp
@extends('principal')

@section('breadcrumb')
    {{ Breadcrumbs::render('home') }}
@endsection

@section('contenido')

    <div class="container-fluid mt-6">

        @if ( session('success'))
            <div class="alert alert-success" role="alert">{{session('success')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true" class="text-dark">&times;</span>
                </button>
            </div>
        @elseif( session('error') )
            <div class="alert alert-danger" role="alert">{{session('error')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true" class="text-dark">&times;</span>
                </button>
            </div>
        @endif

        <div class="card-header">
    
               
                <div class="row mt-2 ">
                    <div class="col-lg-4 col-md-6  mt-2">
                        <button class="btn bg-catastro text-light btn-md rounded w-100  f-16"  data-toggle="modal" data-target="#abrirmodalRequerimiento"  type="button">
                            <i class="fa fa-plus"></i>&nbsp;&nbsp;Agregar Requerimiento
                        </button>
                    </div>
                    <div class="col-lg-8 col-md-12  mt-2"> 
                        <form method="GET" action="{{action('RequerimientoController@index')}}" class="was-validated">          
                            <div class="input-group">
                                <button  class="btn bg-catastro text-light"> Desde</button>
                                <input type="date" name="fechaDesde" class="form-control" placeholder="Buscar Fecha" value="{{app('request')->input('fechaDesde')}}" >
                                <button  class="btn bg-catastro text-light"> Hasta</button>
                                <input type="date" name="fechaHasta" class="form-control" placeholder="Buscar Fecha" value="{{app('request')->input('fechaHasta')}}" >
                            </div> 
                    </div>
                    <div class="col-lg-12 col-md-6 col-sm-12 mt-2">    
                            <div class="input-group">          
                                    <input type="text"  name="buscarTexto" class="form-control" placeholder="Buscar texto" value="{{app('request')->input('buscarTexto')}}">
                                    <button class="btn btn-md bg-primary  text-light text-light pt-2 pb-2 ml-2 f-16"><i class="fa fa-search" disabled=""></i> Buscar</button>
                                    <a href="{{action('RequerimientoController@index') }}" class="btn btn-md bg-primary  text-light text-light pt-2 pb-2 ml-2 f-16"><i class="fa fa-recycle" disabled=""></i> Limpiar</a>
                            </div>
                            @if (app('request')->input('estado'))
                            <input type="hidden" name="estado" value="{{app('request')->input('estado')}}">
                            @endif
                        </form>
                    </div>
                </div>  
 

            @if (!$requeSeleccionado)  
                <div class="row mt-3">
                    <div class="col-lg-2 col-6">
                    <!-- small card -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                        <h3>{{$requeridos}}</h3>
        
                        <p class="font-weight-bold ">Requeridos</p>
                        </div>
                        <div class="icon">
                        </div>
                        <a href="{{action('RequerimientoController@index', ["estado"=>2]) }}" class="small-box-footer font-weight-bold ">
                            <i class="fa fa-eye 
                            @if (app('request')->input('estado') == 2)
                                fa-2x
                            @endif
                            "></i>
                        </a>
                    </div>
                    </div>

                    <div class="col-lg-2 col-6">
                        <!-- small card -->
                        <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{$enprocesos}}</h3>
            
                            <p class="font-weight-bold ">En Proceso</p>
                        </div>
                        <div class="icon">
                        
                        </div>
                        <a href="{{action('RequerimientoController@index', ["estado"=>3]) }}" class="small-box-footer font-weight-bold ">
                            <i class="fa fa-eye 
                            @if (app('request')->input('estado') == 3)
                                fa-2x
                            @endif
                            "></i>
                        </a>
                        </div>
                    </div>

                    <div class="col-lg-2 col-6">
                        <!-- small card -->
                        <div class="small-box bg-primary">
                        <div class="inner">
                            <h3>{{$enpruebas}}</h3>
            
                            <p class="font-weight-bold ">En Prueba</p>
                        </div>
                        <div class="icon">
                        
                        </div>
                        <a href="{{action('RequerimientoController@index', ["estado"=>6]) }}" class="small-box-footer font-weight-bold">
                            <i class="fa fa-eye 
                            @if (app('request')->input('estado') == 6)
                                fa-2x
                            @endif
                            "></i>
                        </a>
                        </div>
                    </div>

                    <div class="col-lg-2 col-6">
                        <!-- small card -->
                        <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3 class="text-light">{{$masespecificacion}}</h3>
            
                            <p class="text-light font-weight-bold ">Especificación</p>
                        </div>
                        <div class="icon">
                        
                        </div>
                            <a href="{{action('RequerimientoController@index', ["estado"=>7]) }}" class="small-box-footer font-weight-bold ">
                            <i class="fa fa-eye
                                @if (app('request')->input('estado') == 7)
                                    fa-2x
                                @endif
                            "></i>
                        </a>
                        </div>
                    </div>

                    <div class="col-lg-2 col-6">
                        <!-- small card -->
                        <div class="small-box bg-secondary">
                        <div class="inner">
                            <h3 class="text-light">{{$reformulados}}</h3>
            
                            <p class="text-light font-weight-bold ">Reformulados</p>
                        </div>
                        <div class="icon">
                        
                        </div>
                            <a href="{{action('RequerimientoController@index', ["estado"=>5]) }}" class="small-box-footer font-weight-bold ">
                            <i class="fa fa-eye 
                            @if (app('request')->input('estado') == 5)
                                fa-2x
                            @endif
                            "></i>
                        </a>
                        </div>
                    </div>

                    <div class="col-lg-2 col-6">
                        <!-- small card -->
                        <div class="small-box bg-success">
                        <div class="inner">
                            <h3 class="text-light">{{$cerrados}}</h3>
            
                            <p class="text-light font-weight-bold ">Cerrados</p>
                        </div>
                        <div class="icon">
                        
                        </div>
                        <a href="{{action('RequerimientoController@index', ["estado"=>4]) }}" class="small-box-footer font-weight-bold ">
                            <i class="fa fa-eye 
                            @if (app('request')->input('estado') == 4)
                                fa-2x
                            @endif
                            "></i>
                        </a>
                    </div>
                    </div>
                
                </div>
           @endif



        </div>

        <script src="{{asset('js/librerias/jquery.min.js')}}"></script>
        <script src="{{asset('/js/librerias/select2.js')}}"></script>

    
        <div class="card-body-noticias">
            
            <div class="box-body">
                
                <ul class="todo-list"  style="overflow-x: hidden;">
                    @foreach ($noticias as $noticia)
                    
                    
                    <li class="itemSlide" id="{{$noticia->noticia_id}}">
                        
                        <div class="box-group" id="accordion">
                            
                                    <!--=====================================
                                        CAJA GESTOR 
                                    ======================================-->                  
    
                                    <div class="panel box box-info">
    
                                        <!--=====================================
                                                CABEZA DE LA CAJA GESTOR 
                                        ======================================-->  
                                        
                                        <div class="box-header with-border">
    
                                            
                            
                                            <div class="row ">
                                                <div class="col-md-6 col-sm-12 "> 
                                                    <span class="handle d-down-none">
                                                    <h4 class="box-title text-catastro font-weight-bold">&nbsp;#{{$noticia->noticia_id}}&nbsp; </h4> 
                                                    </span>
                                                    <h4 class="box-title">
                                                        <a class="text-uppercase  mr-2 text-catastro noticia_{{$noticia->noticia_id}}" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$noticia->noticia_id}}">{{$noticia->noticia_asunto}}</a>
                                                        <img class="direct-chat-timestamp" title="{{$noticia->categoria->noti_cat_descr}}" style="max-width: 30px" src="{{asset('storage/archivos/iconos/'.$noticia->categoria->noti_cat_icono)}}"> 
                                                    </h4>
                                                </div>
                                                <div class="col-md-6 col-sm-12">                                                                                      
                                                        <p class="font-weight-bold f-15 text-primary text-right mr-4"><label class="text-dark font-weight-bold ">Creado por:</label> {{$noticia->user->usuario_nombre}}</p>                                                    
                                                </div>
                                            </div>

                                            <div class="row rounded bg-noticias ml-0 mr-0">

                                                <div class="col-lg-6 col-md-8 col-sm-12 "> 
                                                    <p class="font-weight-bold f-15 text-left text-primary "><label class="text-dark font-weight-bold">Últ. Actividad:</label><span title="{{$noticia->ultimoHilo()->noti_hilo_fecha}}"> {{ Carbon\Carbon::parse($noticia->ultimoHilo()->noti_hilo_fecha)->diffForHumans() }} </span>  <label class="text-dark">por</label> {{$noticia->ultimoHilo()->user->usuario_nombre}}</p> 
                                                </div>

                                                <div class="col-lg-6 col-md-4 col-sm-12 m-0"> 
                                                    <p class="font-weight-bold f-15 text-right text-primary"><label class="text-dark font-weight-bold">Estado:</label> {{$noticia->estado()->not_h_desc}} <img class="direct-chat-timestamp " style="max-width: 30px" src="{{asset('storage/archivos/iconos/'.$noticia->estado()->not_h_icono)}}" ></p> 
                                                </div>                        

                                            </div>
    
                                        </div>

                                
    
                                        <!--=====================================
                                        MÓDULOS COLAPSABLES
                                        ======================================-->   
                                        
                                        <div id="{{'collapse'.$noticia->noticia_id}}" class="panel-collapse collapse collapseSlide">
    
    
                                                <!--=====================================
                                                        MODIFICAR NOMBRE 
                                                ======================================-->      

                                                <div class="row mt-4">
    
                                                        <div class="col-12">
                                                            
                                                            <form class="form-horizontal actualizar-requerimiento was-validated"  action="{{route('requerimiento.update','test')}}" method="POST" enctype="multipart/form-data">
                                                        

                                                                <!-- DIRECT CHAT -->
                                                                <div class="card direct-chat direct-chat-primary w-100" style="min-height: 60vh !important">
                                                                        <div class="card-header">
                                                                        <h4 class="card-title">Contenido:</h4>
                                                        
                                                                        </div>

                                                                        <div class="card-body ">
                                    
                                                                            <div class="input-group mt-2 ">
                                                            
                                                                                    <label class="col-md-3 col-sm-12 form-control-label font-weight-bold" for="asignar">Participantes: </label>
                                                                                    <div class="col-md-9 col-sm-12">                    
                                                                                            <select class="select2bs4 {{"noticia_".$noticia->noticia_id}}" multiple="multiple" data-placeholder=" Usuarios asignados" name="asignados[]" >
                                                                                                @foreach ($usuarios as $usuario)
                                                                                                    <option value="{{$usuario->usuario_id}}" >{{$usuario->usuario_nombre}}</option>       
                                                                                                @endforeach
                                                                                            </select>
                                                                                    </div>
                                                                                <script>
                                                                                    
                                                                                        var asignados = [@foreach ($noticia->asignados() as $asignado) {{$asignado->usuario_id}}, @endforeach];
                                                                                        $('{{".noticia_".$noticia->noticia_id}}').val(asignados).trigger('change');
                                                                                
                                                                                     
                                                                                </script>
                                                                            </div>

                                                                        <div class="direct-chat-messages ">

                                                                            @foreach ($noticia->hilos as $hilo)
                                                                        
                                                                                    @if ($hilo->user->rol->grupo_id == 4)
                                                                                        
                                                                                        <div class="direct-chat-msg mt-2">
                                                                                            <div class="direct-chat-infos clearfix mt-2">
                                                                                                <img class="direct-chat-img float-left" style="max-width: 15px !important; max-height: 15px !important;" src="{{asset('storage/archivos/iconos/'.$hilo->estado->not_h_icono)}}" alt="{{$hilo->estado->not_h_desc}}"><span class="direct-chat-name float-left mr-2 ml-1">{{$hilo->estado->not_h_desc}} -</span>
                                                                                                <span class="direct-chat-name float-left"> {{$hilo->user->usuario_nombre}} </span>
                                                                                            <span class="direct-chat-timestamp float-right" title="{{$hilo->noti_hilo_fecha}}">&nbsp;{{Carbon\Carbon::parse($hilo->noti_hilo_fecha)->diffForHumans()}}&nbsp;</span>
                                                                                            <label class="direct-chat-timestamp float-right font-weight-bold"> &nbsp;{{$hilo->estado->not_h_desc}}&nbsp;</label>
                                                                                                &nbsp;<img class="direct-chat-timestamp float-right" style="max-width: 20px !important" src="{{asset('storage/archivos/iconos/'.$hilo->estado->not_h_icono)}}" alt="{{$hilo->estado->not_h_desc}}">
                                                                                            </div>
                                                                                            
                                                                                            <img class="direct-chat-img" src="{{asset('storage/archivos/usuario/'.$hilo->user->imagen)}}" alt="message user image">
                                                                                    
                                                                                            <div class="direct-chat-text">
                                                                                                {!!$hilo->noti_hilo_texto!!}
                                                                                                <div class="row">
                                                                                                    @foreach ($hilo->archivos as $archivo)
                                                                                                        @if($archivo->extension($archivo->file_name) =="jpg" || $archivo->extension($archivo->file_name) =="png" || $archivo->extension($archivo->file_name) =="jpeg")
                                                                                                            <div class="col-sm-12 col-md-6 col-lg-3">
                                                                                                                <a class="direct-chat-timestamp text-dark font-weight-bold"  target="_blank" href="{{asset('storage/requerimientos/'.$archivo->file_url)}}">
                                                                                                                    <img src="{{asset('storage/requerimientos/'.$archivo->file_url)}}" class=" img-fluid"  alt="">
                                                                                                                </a>
                                                                                                            </div>
                                                                                                        @else
                                                                                                            <div class="col-sm-12 col-md-6 col-lg-3">
                                                                                                                <a class="direct-chat-timestamp text-dark font-weight-bold"  target="_blank" href="{{asset('storage/requerimientos/'.$archivo->file_url)}}">{{$archivo->file_name}}</a> |
                                                                                                            </div>
                                                                                                        @endif
                                                                                                        
                                                                                                    @endforeach
                                                                                                </div>
                                                                                            </div>

                                                                                        </div>
                                                                                    @else
                                                                                        
                                                                                        <div class="direct-chat-msg right mt-2">
                                                                                            <div class="direct-chat-infos clearfix mt-2">
                                                                                                <img class="direct-chat-img float-left" style="max-width: 15px !important; max-height: 15px !important;" src="{{asset('storage/archivos/iconos/'.$hilo->estado->not_h_icono)}}" alt="{{$hilo->estado->not_h_desc}}"><span class="direct-chat-name float-left mr-2 ml-1">{{$hilo->estado->not_h_desc}} -</span>
                                                                                                <span class="direct-chat-name float-left">{{$hilo->user->usuario_nombre}} </span>
                                                                                            <span class="direct-chat-timestamp float-right" title="{{$hilo->noti_hilo_fecha}}">{{Carbon\Carbon::parse($hilo->noti_hilo_fecha)->diffForHumans()}}</span>
                                                                                            </div>
                                                                                            
                                                                                            <img class="direct-chat-img" src="{{asset('storage/archivos/usuario/'.$hilo->user->imagen)}}" alt="message user image">
                                                                                          
                                                                                            <div class="direct-chat-text">
                                                                                                {!!$hilo->noti_hilo_texto!!}
                                                                                                <div class="row">
                                                                                                    @foreach ($hilo->archivos as $archivo)

                                                                                                        @if($archivo->extension($archivo->file_name) =="jpg" || $archivo->extension($archivo->file_name) =="png" || $archivo->extension($archivo->file_name) =="jpeg")                                                                                                        
                                                                                                            <div class="col-sm-12 col-md-6 col-lg-3">
                                                                                                                <a class="direct-chat-timestamp text-dark font-weight-bold"  target="_blank" href="{{asset('storage/requerimientos/'.$archivo->file_url)}}">
                                                                                                                    <img src="{{asset('storage/requerimientos/'.$archivo->file_url)}}" class=" img-fluid"  alt="">
                                                                                                                </a>
                                                                                                            </div>
                                                                                                        @else
                                                                                                            <div class="col-sm-12 col-md-6 col-lg-3">
                                                                                                                <a class="direct-chat-timestamp text-dark font-weight-bold"  target="_blank" href="{{asset('storage/requerimientos/'.$archivo->file_url)}}">{{$archivo->file_name}}</a> |
                                                                                                            </div>
                                                                                                        @endif
                                                                                                    
                                                                                                    @endforeach
                                                                                                </div>
                                                                                            </div>
                                                                                        

                                                                                            
                                                                            
                                                                                        </div>

                                                                                    @endif
                                                                            

                                                                            @endforeach
                                                        
                                                                        </div>                                                          
                                                        
                                                                        </div>                                                                
                                                            
                                                                    </div>
                                                                                                                                                                        
                                                            </div>                               
                                                                                                    
                                                    </div>

                                

                                                            
                                                    @csrf
                                                    @method('patch')
    
                                                    <input type="hidden" value="{{$noticia->noticia_id}}" name="noticia_id" required />        
    
                                            
                                                    <div class="row m-2">
    
                                                        <div class="col-sm-4 col-xs-12 form-group">
    
                                                            <label>Estado:</label>
                                            
                                                            <select class="form-control" name="not_h_est_id" required>                                                         
                                                                <option value="" >Seleccione</option>
                                                                @foreach ($estados as $estado)
                                                                    <option value="{{$estado->not_h_est_id}}" >{{$estado->not_h_desc}}</option>       
                                                                @endforeach
                                                            </select> 
                                                                
                                                        </div>
    
                                                        <div class="col-sm-8 col-xs-12 form-group">
    
                                                            <label>Archivos:</label>
                                            
                                                            <input type="file" class="form-control" name="archivos[]"  multiple/>
                                                                
                                                        </div>
    
                                                        <div class="col-12 form-group">
    
                                                            <label>Respuesta Requerimiento:</label>
                                                            
                                                            <textarea class="ckeditor" name="noti_hilo_texto" id="editor1" rows="10" cols="80"></textarea>
                                                                
                                                        </div>
    
                                                    </div>
                                                    
                                                    <div class="row">
    
                                                            <div class="col-12 form-group ">
            
                                                                <button class="btn btn-primary mr-2 pull-right" type="submit">
                                                                    <i class="fa fa-floppy-o"></i> Guardar
                                                                </button>
            
                                                            </div>
                                                        
                                                        </div>

                                                </form>
                                                                                        
                                        </div>
    
                                    </div>
    
                                </div>
    
                            </li>    
    
                        @endforeach
    
                    </ul>
 
                    {{$noticias->appends(request()->query())->links()}}

                </div>
    
            </div>

        </div>

   
        <!--Inicio del modal requerimientos Pendientes-->
        <div class="modal fade" id="abrirmodalRequerimiento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dark modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Agregar Requerimiento</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-light">×</span>
                        </button>
                    </div>
                
                    <div class="modal-body">
                        

                        <form action="{{route('requerimiento.store')}}" method="post" class="form-horizontal was-validated crear-requerimiento" enctype="multipart/form-data" >
                        
                            {{csrf_field()}}
                            
                                
                            <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="titulo">Asunto</label>
                                    <div class="col-md-9">
                                        <input type="text" name="asunto" class="form-control" placeholder="Ingrese el Asunto" required>
                                    </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="documento">Tipo de Requerimiento</label>
                                
                                <div class="col-md-9">                  
                                    <select class="form-control" name="noti_cat_id" required>                                                         
                                        <option value="" >Seleccione</option>
                                        @foreach ($categorias as $categoria)
                                            <option value="{{$categoria->noti_cat_id}}" >{{$categoria->noti_cat_descr}}</option>       
                                        @endforeach
                                    </select>                       
                                </div>                    
                            </div>
                                    

                            <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="imagen">Archivos</label>
                                    <div class="col-md-9">                    
                                        <input type="file" name="archivos[]" class="form-control" multiple>                           
                                    </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="asignar">Participantes</label>
                                <div class="col-md-9">                    
                                    <select class="select2bs4 pull-right asignadocreacion" multiple="multiple" data-placeholder=" Usuarios asignados" name="asignados[]" >
                                        @foreach ($usuarios as $usuario)
                                            <option value="{{$usuario->usuario_id}}" >{{$usuario->usuario_nombre}}</option>       
                                        @endforeach
                                    </select>  
                                    <script>
                                                                                    
                                        var asignado = [{{Auth::user()->usuario_id}}];
                                        $('.asignadocreacion').val(asignado).trigger('change');
                                
                                     
                                </script>                      
                                </div>
                             </div>

                            <div class="form-group row">
                                <label class="col-md-12 form-control-label" for="texto">Texto del Requerimiento</label>
                                <div class="col-md-12">                    
                                    <textarea class="ckeditor" name="noti_hilo_texto" id="editor1" rows="10" cols="80" required></textarea>                           
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success rounded"><i class="fa fa-save fa-2x"></i> Crear</button>
                                <button type="button" class="btn btn-danger rounded" data-dismiss="modal"><i class="fa fa-times fa-2x"></i> Cerrar</button>
                            </div>

                        </form>
                    </div>
                    
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!--Fin del modal-->

        <script>
            //Iniciar multiple select con los servicios
            $('.select2bs4').select2({
                            theme: 'bootstrap4'
                });
        </script>
        
    @push('scripts')

    <script src="{{ asset('/js/librerias/ckeditor/ckeditor.js') }}"></script>

    <script>
        $(".actualizar-requerimiento").on("submit",function(){

            Swal.fire({
            title: 'Notificando a los usuarios participantes...',
            html:'<img src="./css/librerias/images/loader.gif" />',
            showClass: {
                popup: 'animate__animated animate__fadeInDown'
            },
            padding: '3em',
            background: '#fff',
            showConfirmButton: false,
            backdrop: ` rgba(0, 0, 0,0.6)
                        left top
                        no-repeat
                        `
            })

            return true;
        })


        $(".crear-requerimiento").on("submit",function(){

            Swal.fire({
            title: 'Notificando a los usuarios participantes...',
            html:'<img src="./css/librerias/images/loader.gif" />',
            showClass: {
                popup: 'animate__animated animate__fadeInDown'
            },
            padding: '3em',
            background: '#fff',
            showConfirmButton: false,
            backdrop: ` rgba(0, 0, 0,0.6)
                        left top
                        no-repeat
                        `
            })

        return true;
        })

        @if(app('request')->input('requePendiente'))
            $(".noticia_{{app('request')->input('requePendiente')}}").trigger("click");
        @endif

    </script>
    @endpush

    @push('css')
        <link rel="stylesheet" href="{{asset('/css/librerias/adminlte.min.css')}}">
        <link rel="stylesheet" href="{{asset('/css/librerias/select2.css')}}">
        <link rel="stylesheet" href="{{asset('/css/librerias/select2-bootstrap4.css')}}">
        <style>
            .select2-container{
                width: 100% !important;
            }
            .select2-search__field{
                width: 100% !important;
            }
            p{
                margin-bottom: 5px !important;
            }
           label{
                margin-bottom: 0px !important;
            }
        </style>
    @endpush

@endsection