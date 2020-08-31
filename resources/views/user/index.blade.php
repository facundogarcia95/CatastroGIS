@extends('principal')
@section('contenido')
<main class="main">
            @include('breadcrumb.bread')
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">

                       <h2>Listado de Usuarios</h2><br/>
                      
                        <button class="btn btn-primary btn-lg rounded" type="button" data-toggle="modal" data-target="#abrirmodal">
                            <i class="fa fa-plus fa-2x"></i>&nbsp;&nbsp;Agregar Usuario
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                         
                                <div class="input-group">
                                   
                                    <input type="text" id="buscarTexto" name="buscarTexto" class="form-control" placeholder="Buscar texto" value="">
                                    <button  class="btn btn-primary"><i class="fa fa-search"></i> Buscador</button>
                                   
                                </div>
                       
                            </div>
                        </div>
                        <table id="tablaUsuarios" class="table table-bordered table-striped table-sm table-responsive">
                            <thead>
                                <tr class="bg-dark text-light">
                                   
                                    <th>Nombre</th>
                                    <th>Tipo Documento</th>
                                    <th>Número</th>
                                    <th>Dirección</th>
                                    <th>Teléfono</th>
                                    <th>Email</th>
                                    <th>Usuario</th>
                                    <th>Rol</th>
                                    <th>Imagen</th>
                                    <th>Estado</th>
                                    <th>Editar</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>

                               @foreach($usuarios as $user)
                               
                                <tr>
                                    
                                    <td>{{$user->nombre}}</td>
                                    <td>{{$user->tipo_documento}}</td>
                                    <td>{{$user->num_documento}}</td>
                                    <td>{{$user->direccion}}</td>
                                    <td>{{$user->telefono}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->usuario}}</td>
                                    <td>{{$user->rol}}</td>
                            
                                    <td>
                                         <img src="{{asset('storage/img/usuario/'.$user->imagen)}}" id="imagen1" alt="{{$user->nombre}}" class="img-responsive" width="100px" height="100px">
                                    </td>

                                    <td>
                                      
                                      @if($user->condicion=="1")
                                        <label  class="text-success h6">
                                    
                                          <i class="fa fa-check fa-2x"></i> Activo
                                        </label>

                                      @else

                                        <label class="text-danger h6">
                                    
                                          <i class="fa fa-check fa-2x"></i> Desactivado
                                        </label>

                                       @endif
                                       
                                    </td>
                            
                                    <td>
                                        <button type="button" class="btn btn-warning rounded text-light btn-sm" data-id_usuario="{{$user->id}}" data-nombre="{{$user->nombre}}" data-tipo_documento="{{$user->tipo_documento}}" data-num_documento="{{$user->num_documento}}" data-direccion="{{$user->direccion}}" data-telefono="{{$user->telefono}}" data-email="{{$user->email}}" data-id_rol="{{$user->idrol}}"  data-usuario="{{$user->usuario}}"  data-imagen1="{{$user->imagen}}"  data-toggle="modal" data-target="#abrirmodalEditarUsuario">
                                          <i class="fa fa-edit fa-2x"></i> Editar
                                        </button> &nbsp;
                                    </td>

                                    
                                    <td>

                                       @if($user->condicion)

                                        <button type="button" class="btn btn-danger rounded  btn-sm" data-id_usuario="{{$user->id}}" data-toggle="modal" data-target="#cambiarEstadoUsuario">
                                            <i class="fa fa-times fa-2x"></i> Desactivar
                                        </button>

                                        @else

                                         <button type="button" class="btn btn-success rounded btn-sm" data-id_usuario="{{$user->id}}" data-toggle="modal" data-target="#cambiarEstado">
                                            <i class="fa fa-check fa-2x"></i> Activar
                                        </button>

                                        @endif
                                       
                                    </td>

                                    
                                </tr>

                                @endforeach
                               
                            </tbody>
                        </table>
                            
                            {{$usuarios->render()}}

                    </div>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
            <!--Inicio del modal agregar-->
            <div class="modal fade" id="abrirmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-dark modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Agregar usuario</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true" class="text-light">×</span>
                            </button>
                        </div>
                       
                        <div class="modal-body">
                             

                            <form action="{{route('user.store')}}" method="post" class="form-horizontal" enctype="multipart/form-data" >
                               
                                {{csrf_field()}}
                                
                                @include('user.form')

                            </form>
                        </div>
                        
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->


             <!--Inicio del modal actualizar-->
             <div class="modal fade" id="abrirmodalEditarUsuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-dark modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Actualizar usuario</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true" class="text-light">×</span>
                            </button>
                        </div>
                       
                        <div class="modal-body">
                             

                            <form action="{{route('user.update','test')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                                
                                {{method_field('patch')}}
                                {{csrf_field()}}

                                <input type="hidden" id="id_usuario" name="id_usuario" value="">
                                
                                @include('user.form')

                            </form>
                        </div>
                        
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->

            
             <!-- Inicio del modal Cambiar Estado del usuario -->
             <div class="modal fade" id="cambiarEstadoUsuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-dark" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Cambiar Estado del Usuario</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true" class="text-light">×</span>
                            </button>
                        </div>

                    <div class="modal-body">
                        <form action="{{route('user.destroy','test')}}" method="POST">
                         {{method_field('delete')}}
                         {{csrf_field()}} 

                            <input type="hidden" id="id_usuario" name="id_usuario" value="">

                                <p>¿Está seguro que desea cambiar el estado?</p>
        

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success rounded">Aceptar</button>
                                <button type="button" class="btn btn-danger rounded" data-dismiss="modal">Cerrar</button>
                            </div>

                         </form>
                    </div>
                    <!-- /.modal-content -->
                   </div>
                <!-- /.modal-dialog -->
             </div>
            <!-- Fin del modal Eliminar -->
           

           
            
        </main>
@push('scripts')

        <script>
    
            $("#buscarTexto").keyup(function(){
                        _this = this;
                            // Show only matching TR, hide rest of them
                        $.each($("#tablaUsuarios tbody tr"), function() {
                            
                            if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
                                $(this).hide();
                            else
                                $(this).show();
    
                        });
                    });
    
        </script>
    @endpush
@endsection