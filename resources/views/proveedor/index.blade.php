@extends('principal')
@section('contenido')
<main class="main">
            @include('breadcrumb.bread')
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">

                       <h2>Listado de Proveedores</h2><br/>
                      
                        <button class="btn btn-primary btn-lg rounded" type="button" data-toggle="modal" data-target="#abrirmodal">
                            <i class="fa fa-plus fa-2x"></i>&nbsp;&nbsp;Agregar Proveedor
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

                        <table id="tablaProveedores" class="table table-bordered table-striped table-sm table-responsive">
                            <thead>
                                <tr class="bg-dark text-light">
                                   
                                    <th>Proveedor</th>
                                    <th>Tipo de Documento</th>
                                    <th>Número Documento</th>
                                    <th>Teléfono</th>
                                    <th>Email</th>
                                    <th>Dirección</th>
                                    <th>Editar</th>
                                </tr>
                            </thead>
                            <tbody>

                               @foreach($proveedores as $prove)
                               
                                <tr>
                                    
                                    <td>{{$prove->nombre}}</td>
                                    <td>{{$prove->tipo_documento}}</td>
                                    <td>{{$prove->num_documento}}</td>
                                    <td>{{$prove->telefono}}</td>
                                    <td>{{$prove->email}}</td>
                                    <td>{{$prove->direccion}}</td>
                            
                                    <td>
                                        <button type="button" class="btn btn-warning text-light rounded btn-sm" data-id_proveedor="{{$prove->id}}" data-nombre="{{$prove->nombre}}" data-tipo_documento="{{$prove->tipo_documento}}" data-num_documento="{{$prove->num_documento}}" data-direccion="{{$prove->direccion}}" data-telefono="{{$prove->telefono}}" data-email="{{$prove->email}}" data-toggle="modal" data-target="#abrirmodalEditarProveedor">
                                          <i class="fa fa-edit fa-2x"></i> Editar
                                        </button> &nbsp;
                                    </td>

                                    
                                </tr>

                                @endforeach
                               
                            </tbody>
                        </table>
                            
                            {{$proveedores->render()}}

                    </div>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
            <!--Inicio del modal agregar-->
            <div class="modal fade" id="abrirmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-dark modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Agregar proveedor</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true" class="text-light">×</span>
                            </button>
                        </div>
                       
                        <div class="modal-body">
                             

                            <form action="{{route('proveedor.store')}}" method="post" class="form-horizontal">
                               
                                {{csrf_field()}}
                                
                                @include('proveedor.form')

                            </form>
                        </div>
                        
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->


             <!--Inicio del modal actualizar-->
             <div class="modal fade" id="abrirmodalEditarProveedor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-dark modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Actualizar proveedor</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true" class="text-light">×</span>
                            </button>
                        </div>
                       
                        <div class="modal-body">
                             

                            <form action="{{route('proveedor.update','test')}}" method="post" class="form-horizontal">
                                
                                {{method_field('patch')}}
                                {{csrf_field()}}

                                <input type="hidden" id="id_proveedor" name="id_proveedor" value="">
                                
                                @include('proveedor.form')

                            </form>
                        </div>
                        
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->

           
            
        </main>
@push('scripts')

    <script>

        $("#buscarTexto").keyup(function(){
                    _this = this;
                        // Show only matching TR, hide rest of them
                    $.each($("#tablaProveedores tbody tr"), function() {
                        
                        if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
                            $(this).hide();
                        else
                            $(this).show();

                    });
                });

    </script>
@endpush
@endsection