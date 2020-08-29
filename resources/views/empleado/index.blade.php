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
                                   
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Número Documento</th>
                                    <th>Dirección</th>
                                    <th>Teléfono</th>
                                    <th>Email</th>
                                    <th>Foto</th>
                                    <th>Editar</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>

                               @foreach($empleados as $empleado)
                               
                                <tr>
                                    
                                    <td>{{$empleado->nombre}}</td>
                                    <td>{{$empleado->apellido}}</td>
                                    <td>{{$empleado->num_documento}}</td>
                                    <td>{{$empleado->direccion}}</td>
                                    <td>{{$empleado->telefono}}</td>
                                    <td>{{$empleado->email}}</td>
                                    <td><img src="{{asset('storage/img/empleados/'.$empleado->foto)}}" id="" alt="{{$empleado->nombre}}" class="img-responsive" width="100px" height="100px"></td>
                                    <td>
                                        <button type="button" class="btn btn-warning text-light btn-sm rounded" data-id_empleado="{{$empleado->id}}" data-nombre="{{$empleado->nombre}}"
                                                data-apellido="{{$empleado->apellido}}" data-num_documento="{{$empleado->num_documento}}"
                                                data-direccion="{{$empleado->direccion}}" data-telefono="{{$empleado->telefono}}" data-email="{{$empleado->email}}" 
                                                data-toggle="modal" data-target="#abrirmodalEditarEmpleado">
                                            <i class="fa fa-edit fa-2x"></i> Editar
                                        </button> &nbsp;
                                    </td>
                                    <td>
                                        @if($empleado->estado)

                                            <button type="button" class="btn btn-danger rounded btn-sm" data-id_empleado="{{$empleado->id}}" data-toggle="modal" data-target="#cambiarEstado">
                                                <i class="fa fa-times fa-2x"></i> DESACTIVAR
                                            </button>

                                            @else

                                            <button type="button" class="btn btn-success rounded btn-sm" data-id_empleado="{{$empleado->id}}" data-toggle="modal" data-target="#cambiarEstado">
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
                             

                            <form action="{{route('empleado.store')}}" method="post" class="form-horizontal">
                               
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
                             

                            <form action="{{route('empleado.update','test')}}" method="post" class="form-horizontal">
                                
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

           
              <!-- FORMULARIO CONDICION EMPLEADO-->
              {!!Form::open(array('url'=>'empleado','id'=>'filtrar_condicion','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}                                      
              <input type="hidden" name="condicionEmpleado" id="condicionEmpleado" value="">    
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
                    $("#condicionProducto").val(0)
                    $("#filtrar_condicion").submit();

                }else{
                    $("#condicionProducto").val(1)
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

    </script>

    <script src="{{asset('js/toggle.js')}}"></script>

@endpush

@push('css')

    <link href="{{asset('css/toggle.css')}}" rel="stylesheet"/>

@endpush

@endsection