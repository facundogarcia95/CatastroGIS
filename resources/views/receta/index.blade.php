@extends('principal')
@section('contenido')
<main class="main">
            @include('breadcrumb.bread')
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">

                       <h2>Listado de Productos Elaborados</h2><br/>
                       
                       <a href="receta/create">

                          <button class="btn btn-primary btn-lg" type="button">
                              <i class="fa fa-plus fa-2x"></i>&nbsp;&nbsp;Agregar Receta
                          </button>

                        </a>
                       
                    </div>
                    <div class="card-body">

                        <div class="form-group row">
                            <div class="col-md-6">
                            {!! Form::open(array('url'=>'receta','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!} 
                                <div class="input-group">
                                    <input type="text" name="buscarTexto" class="form-control" placeholder="Buscar Nombre" value="{{$buscarTexto}}">
                                    <button type="submit"  class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            {{Form::close()}}
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr class="bg-primary">
                                    
                                    <th>Ver Detalle</th>
                                    <th>Nombre Receta</th>
                                    <th>Fecha Creación</th> 
                                    <th>Usuario</th>
                                    <th>Estado</th>
                                    <th>Cambiar Estado</th>
                                    <th>Descargar Reporte</th>
                                    
                                </tr>
                            </thead>
                            <tbody>

                              @foreach($recetas as $receta)
                               
                                <tr>
                                    <td>
                                     
                                     <a href="{{URL::action('RecetaController@show',$receta->id)}}">
                                       <button type="button" class="btn btn-warning btn-md">
                                         <i class="fa fa-eye fa-2x"></i> Ver detalle
                                       </button> &nbsp;

                                     </a>
                                   </td>

                                    <td>{{$receta->nombre}}</td>
                                    <td>{{$receta->created_at}}</td>
                                    <td>{{$receta->usuario}}</td>
                                    <td>
                                      
                                      @if($receta->condicion == 1)
                                        <label type="button" class=" text-success">
                                    
                                          <i class="fa fa-check fa-2x"></i> Registrado
                                        </label>

                                      @else

                                        <label type="button" class="text-danger">
                                    
                                          <i class="fa fa-check fa-2x"></i> Anulado
                                        
                                        </label>

                                       @endif
                                       
                                    </td>

                                    
                                    <td>

                          
                                            @if($receta->condicion == 1)

                                                <button type="button" class="btn btn-danger btn-sm" data-id_compra="{{$receta->id}}" data-toggle="modal" data-target="#cambiarEstadoCompra">
                                                    <i class="fa fa-times fa-2x"></i> Anular Receta
                                                </button>

                                                @else

                                                <label type="button" class="btn btn-info btn-sm">
                                                    <i class="fa fa-lock fa-2x"></i> Anulada
                                                </label>

                                            @endif
                                       
                                    </td>

                                    <td>
                                       
                                       <a href="{{url('pdfReceta',$receta->id)}}" target="_blank">
                                          
                                          <button type="button" class="btn btn-info btn-sm">
                                           
                                            <i class="fa fa-file fa-2x"></i> Descargar PDF
                                          </button> &nbsp;

                                       </a> 

                                   </td>
                                </tr>

                                @endforeach
                               
                            </tbody>
                        </table>

                        {{$recetas->render()}}
                        
                    </div>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
                       
           
        <!-- Inicio del modal cambiar estado de compra -->
         <div class="modal fade" id="cambiarEstadoReceta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-danger" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Cambiar Estado de Receta</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>

                    <div class="modal-body">
                        <form action="{{route('receta.destroy','test')}}" method="POST">
                          {{method_field('delete')}}
                          {{csrf_field()}} 

                            <input type="hidden" id="id_receta" name="id_receta" value="">

                                <p>Estas seguro de cambiar el estado?</p>
        

                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-success">Aceptar</button>
                            </div>

                         </form>
                    </div>
                    <!-- /.modal-content -->
                   </div>
                <!-- /.modal-dialog -->
             </div>
            <!-- Fin del modal Eliminar -->
           
            
        </main>
@endsection