@extends('principal')
@section('contenido')
<main class="main">
            @include('breadcrumb.bread')
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">

                       <h2>Listado de Clientes</h2><br/>
                      
                        <button class="btn btn-primary btn-lg rounded" type="button" data-toggle="modal" data-target="#abrirmodal">
                            <i class="fa fa-plus fa-2x"></i>&nbsp;&nbsp;Agregar Cliente
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                          
                                <div class="input-group">
                                   
                                    <input type="text" id="buscarTexto" name="buscarTexto" class="form-control" placeholder="Buscar texto" value="">
                                    <button class="btn btn-primary"><i class="fa fa-search"></i> Buscador</button>
                                  
                                </div>
                            
                            </div>
                        </div>
                        <table id="tablaClientes" class="table table-bordered table-striped table-sm table-responsive">
                            <thead>
                                <tr class="bg-dark text-light">
                                   
                                    <th>Cliente</th>
                                    <th>Tipo de Documento</th>
                                    <th>Número Documento</th>
                                    <th>Teléfono</th>
                                    <th>Email</th>
                                    <th>Dirección</th>
                                    <th>Editar</th>
                                </tr>
                            </thead>
                            <tbody>

                               @foreach($clientes as $client)
                               
                                <tr>
                                    
                                    <td>{{$client->nombre}}</td>
                                    <td>{{$client->tipo_documento}}</td>
                                    <td>{{$client->num_documento}}</td>
                                    <td>{{$client->telefono}}</td>
                                    <td>{{$client->email}}</td>
                                    <td>{{$client->direccion}}</td>
                            
                                    <td>
                                        <button type="button" class="btn btn-warning text-light btn-sm rounded" data-id_cliente="{{$client->id}}" data-nombre="{{$client->nombre}}" data-tipo_documento="{{$client->tipo_documento}}" data-num_documento="{{$client->num_documento}}" data-direccion="{{$client->direccion}}" data-telefono="{{$client->telefono}}" data-email="{{$client->email}}" data-toggle="modal" data-target="#abrirmodalEditarCliente">
                                          <i class="fa fa-edit fa-2x"></i> Editar
                                        </button> &nbsp;
                                    </td>


                                    
                                </tr>

                                @endforeach
                               
                            </tbody>
                        </table>
                            
                            {{$clientes->render()}}

                    </div>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
            <!--Inicio del modal agregar-->
            <div class="modal fade" id="abrirmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-dark modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Agregar cliente</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true" class="text-light">×</span>
                            </button>
                        </div>
                       
                        <div class="modal-body">
                             

                            <form action="{{route('cliente.store')}}" method="post" class="form-horizontal">
                               
                                {{csrf_field()}}
                                
                                @include('cliente.form')

                            </form>
                        </div>
                        
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->


             <!--Inicio del modal actualizar-->
             <div class="modal fade" id="abrirmodalEditarCliente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-dark modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Actualizar cliente</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true" class="text-light">×</span>
                            </button>
                        </div>
                       
                        <div class="modal-body">
                             

                            <form action="{{route('cliente.update','test')}}" method="post" class="form-horizontal">
                                
                                {{method_field('patch')}}
                                {{csrf_field()}}

                                <input type="hidden" id="id_cliente" name="id_cliente" value="">
                                
                                @include('cliente.form')

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
                    $.each($("#tablaClientes tbody tr"), function() {
                        
                        if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
                            $(this).hide();
                        else
                            $(this).show();

                    });
                });

    </script>
@endpush

@endsection