<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{csrf_token()}}">

    <!-- Icons -->
    <link href="{{asset('css/librerias/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/librerias/simple-line-icons.min.css')}}" rel="stylesheet">
    <!-- Main styles for this application -->
    <link href="{{asset('css/librerias/jquery-ui.css')}}" rel="stylesheet"/>
    <link href="{{asset('css/librerias/style.css')}}" rel="stylesheet">
    <link href="{{asset('css/librerias/estilos.css')}}" rel="stylesheet">
    <link href="{{asset('css/librerias/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/librerias/responsive.bootstrap.min.css')}}" rel="stylesheet">

    <!-- <script src="('js/librerias/jquery.min.js')"></script> -->
    <script src="{{asset('js/librerias/jquery-ui.js')}}"></script>
    <script src="{{asset('js/librerias/moment.min.js')}}"></script>
    <script src="{{asset('js/librerias/jquery-migrate-3.0.0.min.js')}}"></script>
    <script src="{{asset('js/librerias/popper.min.js')}}"></script>
    <script src="{{asset('js/librerias/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/librerias/pace.min.js')}}"></script>
    <!-- Plugins and scripts required by all views -->
    <script src="{{asset('js/librerias/Chart.min.js')}}"></script>
    <script src="{{asset('js/librerias/util.js')}}"></script>
    <!-- GenesisUI main scripts -->
    <script src="{{asset('js/librerias/template.js')}}"></script>
    <script src="{{asset('js/librerias/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('js/librerias/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/librerias/dataTables.bootstrap4.min.js')}}"></script>
     
    <script src="{{asset('js/librerias/inputmask.js')}}"></script>
    <script src="{{asset('js/librerias/inputmask.extensions.js')}}"></script>   
    <script src="{{asset('js/librerias/dataTables.responsive.min.js')}}"></script>  

</head>
<body>

        
    
        
        <div class="card">
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

            <!-- Si viene asignar, cambio agregar persona -->
                
            <div class="card-header">

                <h2>Gestión de Personas <i class="fa fa-info-circle text-primary pull-right mt-2 ml-2" style="cursor:pointer" data-toggle="collapse" data-target=".info" aria-expanded="false"></i></h2><br/>

                <div class="collapse info">
                    <p class="f-15">En el siguiente apartado podrá gestionar la alta o modificación de personas.</p>
                    <p class="f-15">Las mismas podrán ser personas Físicas o Jurídicas, cambiando sus respectivos datos según sea el caso.</p>
                </div> <br/>    

                @if(!session('asignar'))   
                    <button class="btn btn-primary btn-lg rounded" type="button" data-toggle="modal" data-target="#abrirmodal">
                        <i class="fa fa-plus"></i>&nbsp;&nbsp;Agregar Persona
                    </button>
                @endif       
               

            </div>        
            <!-- -- -- -- -- -- -- -->

            <div class="card-body">
                <div class="form-group row">
                    <div class="col-md-6">   
                        @if(!session('asignar'))          
                            <form action="{{url('gestion/personas')}}" method="get" class="was-validated">  
                        @else 
                            <form action="{{url('grillaPersonas')}}" method="get" class="was-validated">  
                        @endif
                            <div class="input-group">       
                                <input type="text" id="buscarTexto" name="buscarTexto" class="form-control" placeholder="Buscar texto" value="{{$busqueda}}">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Buscador</button>                       
                            @if(!session('asignar'))          
                                <a  class="btn btn-primary ml-1 limpiar" href="{{url('gestion/personas')}}"><i class="fa fa-trash"></i> Limpiar</a>                       
                            @else 
                                <a  class="btn btn-primary ml-1 limpiar" href="{{url('grillaPersonas')}}"><i class="fa fa-trash"></i> Limpiar</a>                       
                            @endif
                            </div>           
                        </form>
                    </div>
                </div>
                <table id="tablaMejorasUsos" class="table table-bordered table-striped table-sm table-responsive">
                    <thead>
                        <tr class="bg-dark text-light">
                            <th>ID</th>
                            <th>Tipo de Persona</th>
                            <th>Denominación</th>
                            <th>Apellido</th>
                            <th>Nombre</th>
                            <th>CUIT/CUIL</th>
                            <th>Documento</th>
                            <th>Pais</th>
                            <!-- Si viene asignar, cambio agregar persona -->
                            @if(!session('asignar'))
                                <th>Editar</th>
                            @else
                                <th>Asignar</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($modulo_personas as $modulo_persona)
                        <tr>
                            <td>{{$modulo_persona->persona_id}}</td>
                            <td>{{$modulo_persona->tipo_persona_descrip}}</td>
                            <td>{{$modulo_persona->persona_denominacion}}</td>
                            <td>{{$modulo_persona->persona_apellido}}</td>
                            <td>{{$modulo_persona->persona_nombre}}</td>
                            <td>{{$modulo_persona->persona_cuit}}</td>
                            <td>{{$modulo_persona->persona_nro_doc}}</td>
                            <td>{{$modulo_persona->pais_nombre}}</td>
                            <!-- Si viene asignar, cambio agregar persona -->
                            <td>
                                @if(!session('asignar'))
                                    <button type="button" class="btn btn-warning rounded text-light btn-sm" 
                                        data-persona_id="{{$modulo_persona->persona_id}}"
                                        data-tipo_persona_id="{{$modulo_persona->tipo_persona_id}}"
                                        data-tipo_persona_juridica_id="{{$modulo_persona->tipo_persona_juridica_id}}"
                                        data-tipo_documento_id="{{$modulo_persona->tipo_documento_id}}"
                                        data-tipo_persona_descrip="{{$modulo_persona->tipo_persona_descrip}}"
                                        data-persona_denominacion="{{$modulo_persona->persona_denominacion}}"
                                        data-persona_nombre="{{$modulo_persona->persona_nombre}}"
                                        data-persona_apellido="{{$modulo_persona->persona_apellido}}"
                                        data-persona_cuit="{{$modulo_persona->persona_cuit}}"
                                        data-persona_es_cuit="{{$modulo_persona->persona_es_cuit}}"
                                        data-persona_fecha_nac="{{$modulo_persona->persona_fecha_nac}}"
                                        data-persona_nro_doc="{{$modulo_persona->persona_nro_doc}}"
                                        data-pais_id="{{$modulo_persona->pais_id}}"
                                        data-persona_sexo="{{$modulo_persona->persona_sexo}}"
                                        data-persona_fallecida="{{$modulo_persona->persona_fallecida}}"
                                        data-persona_email="{{$modulo_persona->persona_email}}"
                                        data-persona_conyuge="{{$modulo_persona->persona_conyuge}}"
                                        data-toggle="modal" 
                                        data-target="#editarPersona">
                                            <i class="fa fa-edit fa-2x"></i> Editar
                                    </button> 
                                @else
                                    <button type="button" class="btn btn-primary rounded text-light btn-sm" onclick="asignarPersona({{$modulo_persona->persona_id}}, '{{$modulo_persona->persona_denominacion}}')">
                                        <i class="fa fa-plus fa-1x"></i> Asignar
                                    </button> 
                                @endif                    
                            </td> 
                        </tr>
                        @endforeach                   
                    </tbody>
                </table>                
                {{$modulo_personas->appends(request()->query())->links()}}         
            </div>
        </div>

        <!-- Fin ejemplo de tabla Listado -->
                    <!--Inicio del modal agregar-->
                    <div class="modal fade" id="abrirmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-dark modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Agregar Persona</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true" class="text-light">×</span>
                                    </button>
                                </div>
                            
                                <div class="modal-body">
                                    <form id="formStorePersona" action="{{route('personas.store')}}" method="post" class="form-horizontal was-validated" enctype="multipart/form-data"  >
                                        {{csrf_field()}}
                                        @include('gestion.personas.form')
                                    </form>
                                </div>                            
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!--Fin del modal-->    
            <!-- Fin ejemplo de tabla Listado -->
        
                    <!--Inicio del modal actualizar-->
                    <div class="modal fade" id="editarPersona" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-dark modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Actualizar Persona</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true" class="text-light">×</span>
                                    </button>
                                </div>                           
                                <div class="modal-body">                                 
                                    <form action="{{route('personas.update','test')}}" method="post" class="form-horizontal was-validated" enctype="multipart/form-data">
                                        {{method_field('patch')}}
                                        {{csrf_field()}}
                                        <input type="hidden" id="persona_id" name="persona_id" value="">                            
                                        @include('gestion.personas.form')
                                    </form>
                                </div>                            
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!--Fin del modal-->
    </div>

    <script>
        function asignarPersona(persona_id, persona_denominacion){
            // Cierro modal
            window.parent.$('#buscarTitular').modal('hide');
            // Asigno ID 
            window.parent.$('.persona').val(persona_id);
            // Asigno Denominacion (solo visual) 
            window.parent.$('.persona_den').text(persona_denominacion);
        }
    </script>

    <script src="{{asset('js/principal.js')}}"></script>  


</body>
</html>