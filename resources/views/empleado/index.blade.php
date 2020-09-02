@extends('principal')
@section('contenido')
<main class="main">
            @include('breadcrumb.bread')
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
  
                        <div class="col-sm-12">
                        <h2>Listado de Empleados</h2><br/>
                        
                            <button class="btn btn-primary btn-lg m-2 rounded" type="button" data-toggle="modal" data-target="#abrirmodal">
                                <i class="fa fa-plus fa-2x"></i>&nbsp;&nbsp;Agregar Empleado
                            </button>

                            @if($condicionEmpleado == 1)
                            <input type="checkbox" checked id="tipo_condicion" data-toggle="toggle" data-on="Activos" data-off="Inactivos" data-onstyle="success rounded font-btn my-3"  data-offstyle="danger rounded font-btn my-3" >                    
                            @else
                                <input type="checkbox" checked id="tipo_condicion" data-toggle="toggle" data-on="Inactivos" data-off="Activos" data-onstyle="danger rounded font-btn my-3" data-offstyle="success rounded font-btn my-3" >                    
                            @endif
                            
                        </div>

                        <div class="col-sm-12 mt-4">
                            @if ( session('mensaje') )
                                <div class="alert alert-success" role="alert">{{ session('mensaje') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>
                            @endif
                            @if ( session('error') )
                                <div class="alert alert-danger" role="alert">{{ session('error') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>
                            @endif
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                           
                                <div class="input-group">
                                   
                                    <input type="text" name="buscarTexto" class="form-control" placeholder="Buscar texto" value="">
                                    <button disabled class="btn btn-primary"><i class="fa fa-search"></i> Buscador</button>&nbsp;
                     
                                </div>
   
                            </div>
                        </div>
                        <table id="tablaempleados" class="table table-bordered table-striped table-sm table-responsive">
                            <thead>
                                <tr class="bg-dark text-light">
                                   
                                    <th>Nombre y Apellido</th>
                                    <th>Número Documento</th>
                                    <th>Dirección</th>
                                  
                                    <th>Foto</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>

                               @foreach($empleados as $empleado)
                               
                                <tr>
                                    
                                    <td><a class="h5 text-primary" href="{{ action('EmpleadoController@show', ['id' => Crypt::encrypt($empleado->id)]) }}">{{$empleado->nombre}} {{$empleado->apellido}} &nbsp; <i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i></a></td>
                                    <td>{{$empleado->num_documento}}</td>
                                    <td>{{$empleado->direccion}}</td>
                                   
                                    <td><img src="{{asset('storage/img/empleados/'.$empleado->foto)}}" id="" alt="{{$empleado->nombre}}" class="img-responsive" width="100px" height="100px"></td>
                                    <td>
                                            
                                        <button type="button" class="btn btn-warning text-light btn-sm rounded" data-id_empleado="{{$empleado->id}}" data-nombre="{{$empleado->nombre}}"
                                                data-apellido="{{$empleado->apellido}}" data-num_documento="{{$empleado->num_documento}}" data-fecha_nacimiento="{{$empleado->fecha_nacimiento}}"
                                                data-direccion="{{$empleado->direccion}}" data-telefono="{{$empleado->telefono}}" data-email="{{$empleado->email}}" 
                                                data-toggle="modal" data-target="#abrirmodalEditarEmpleado">
                                            <i class="fa fa-edit fa-2x"></i> Editar
                                        </button> &nbsp;
                                   
                                        @if($empleado->estado)

                                            <button type="button" class="btn btn-danger rounded btn-sm" data-id_empleado="{{$empleado->id}}" data-toggle="modal" data-target="#cambiarEstadoEmpleado">
                                                <i class="fa fa-times fa-2x"></i> DESACTIVAR
                                            </button>

                                        @else

                                            <button type="button" class="btn btn-success rounded btn-sm" data-id_empleado="{{$empleado->id}}" data-toggle="modal" data-target="#cambiarEstadoEmpleado">
                                                <i class="fa fa-check fa-2x "></i> ACTIVAR
                                            </button>

                                        @endif
                                    </td>


                                    
                                </tr>

                                @endforeach
                               
                            </tbody>
                        </table>
                            
                            {{$empleados->render()}}

                    </div>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
            <!--Inicio del modal agregar-->
            <div class="modal fade" id="abrirmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-dark modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Agregar empleado</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true" class="text-light">×</span>
                            </button>
                        </div>
                       
                        <div class="modal-body">
                             

                            <form action="{{route('empleado.store')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                               
                                {{csrf_field()}}
                                
                                @include('empleado.form')

                            </form>
                        </div>
                        
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->


             <!--Inicio del modal actualizar-->
             <div class="modal fade" id="abrirmodalEditarEmpleado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-dark modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Actualizar Empleado</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true" class="text-light">×</span>
                            </button>
                        </div>
                       
                        <div class="modal-body">
                             

                            <form action="{{route('empleado.update','test')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                                
                                {{method_field('patch')}}
                                {{csrf_field()}}

                                <input type="hidden" id="id_empleado" name="id_empleado" value="">
                                
                                @include('empleado.form')

                            </form>
                        </div>
                        
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->


        <!-- Inicio del modal cambiar estado de empleado -->
        <div class="modal fade" id="cambiarEstadoEmpleado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-danger" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h4 class="modal-title">Cambiar Estado del Empleado</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                      </div>

                      <form action="{{route('empleado.destroy','test')}}" method="POST">
                        {{method_field('delete')}}
                        {{csrf_field()}} 
                        
                        <div class="modal-body">
                    
                          <input type="hidden" id="idempleado" name="id_empleado" value="">

                              <p>¿Está seguro que desea cambiar el estado?</p>

                        </div>
                        <div class="modal-footer">
                              <button type="submit" class="btn btn-success">Aceptar</button>
                              <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>

                        </div>

                      </form>
                </div>
                  <!-- /.modal-content -->
            </div>
              <!-- /.modal-dialog -->
        </div>
          <!-- Fin del modal Eliminar -->
         

           
              <!-- FORMULARIO CONDICION EMPLEADO-->
              {!!Form::open(array('url'=>'empleado','id'=>'filtrar_condicion','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}                                      
                <input type="hidden" name="c" id="condicionEmpleado" value="">    
             {{Form::close()}}
            
        </main>

@push('scripts')

    <script>

        $("#tipo_condicion").on("change",function(){
            
            setInterval(() => {
                
                @if($condicionEmpleado == 1)

                if($(this).prop('checked')){
                    $("#condicionEmpleado").val(1)
                    $("#filtrar_condicion").submit();

                }else{
                    $("#condicionEmpleado").val(0)
                    $("#filtrar_condicion").submit();
                    
                }

            @else
                
                if($(this).prop('checked')){
                    $("#condicionEmpleado").val(0)
                    $("#filtrar_condicion").submit();

                }else{
                    $("#condicionEmpleado").val(1)
                        $("#filtrar_condicion").submit();
                    
                }

            @endif

            }, 600);
            
        })

            $("#buscarTexto").keyup(function(){
                _this = this;
                    // Show only matching TR, hide rest of them
                $.each($("#tablaempleados tbody tr"), function() {
                    
                    if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
                        $(this).hide();
                    else
                        $(this).show();

                });
            });


$(document).ready(function () {
    
    var hoy = new Date();
    let anio = parseInt(hoy.getFullYear()) - 18;
    let mes = parseInt(hoy.getMonth()) + 1;
    let dia = parseInt(hoy.getDate());

    if(dia<10){
        dia='0'+dia
    } 
    if(mes<10){
        mes='0'+mes
    } 

    $("#fecha_nacimiento").attr("max",anio+"-"+mes+"-"+dia);

});
           

    </script>

    <script src="{{asset('js/toggle.js')}}"></script>

@endpush

@push('css')

    <link href="{{asset('css/toggle.css')}}" rel="stylesheet"/>

@endpush

@endsection