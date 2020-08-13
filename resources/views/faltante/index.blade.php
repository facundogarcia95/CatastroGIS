@extends('principal')
@section('contenido')
<main class="main">
            @include('breadcrumb.bread')
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">

                       <h2>Listado de Ajustes</h2><br/>
                       
                       <a href="faltante/create" style="text-decoration: none">
                        <button class="btn btn-primary btn-lg m-2 rounded" type="button">
                            <i class="fa fa-plus fa-2x"></i>&nbsp;&nbsp;Agregar Ajuste
                        </button>
                        </a>

                        <a href="{{url('listarFaltantesPdf')}}" target="_blank" style="text-decoration: none">
                          <button type="button" class="btn btn-report btn-lg m-2 text-light rounded">
                              <i class="fa fa-file fa-2x"></i>&nbsp;&nbsp;Reporte PDF
                              
                          </button>
                      </a>
                       
                    </div>
                    <div class="card-body">

                        <div class="form-group row">
                            <div class="col-md-6">
                            {!! Form::open(array('url'=>'faltante','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!} 
                                <div class="input-group">
                                   
                                    <input type="text" name="buscarTexto" class="form-control" placeholder="Buscar texto" value="{{$buscarTexto}}">
                                    <button type="submit"  class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>&nbsp;
                                    <a href={{url('faltante')}}  class="btn btn-primary">Limpiar</a>
                                </div>
                            {{Form::close()}}
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm table-responsive">
                            <thead>
                                <tr class="bg-dark text-light">
                                    
                                    <th>Ver Detalle</th>
                                    <th>Fecha Ajuste</th>
                                    <th>Creado por</th>
                                    <th>Observacion</th> 
                                    <th>Estado</th>
                                    @if ($usuarioRol == 1)
                                    <th>Cambiar Estado</th> 
                                    @endif
                                    
                                </tr>
                            </thead>
                            <tbody>
                              @foreach($faltantes as $faltante)
                               
                                <tr>
                                    <td>
                                     
                                     <a href="{{URL::action('FaltanteController@show',$faltante->id)}}">
                                       <button type="button" class="btn btn-detalle btn-sm rounded text-light">
                                         <i class="fa fa-eye fa-2x"></i> Detalle
                                       </button> &nbsp;

                                     </a>
                                   </td>

                                    <td>{{$faltante->created_at}}</td>
                                    <td>{{$faltante->nombre}}</td>
                                    <td>
                                      @isset($faltante->observacion)
                                        {{$faltante->observacion}}
                                      @else    
                                        SIN OBSERVACIÓN
                                      @endisset
                                    </td>
                                    <td>
                                      
                                      @if($faltante->condicion==1)
                                        <label class=" text-success h6">
                                    
                                          <i class="fa fa-check fa-2x"></i> Registrado
                                        </label>

                                      @else

                                        <label class=" text-danger h6">
                                    
                                          <i class="fa fa-check fa-2x"></i> Anulado
                                        </label>

                                       @endif
                                       
                                    </td>

                                    @if ($usuarioRol == 1)
                                    <td>

                                      

                                            @if($faltante->condicion==1)

                                                <button type="button" class="btn btn-danger btn-sm rounded" data-idfaltante="{{$faltante->id}}" data-toggle="modal" data-target="#cambiarEstadoFaltante">
                                                    <i class="fa fa-times fa-2x"></i> Anular Faltante
                                                </button>

                                                @else

                                                <label  class="text-danger h6 ml-2 ">
                                                    <i class="fa fa-lock fa-2x"></i> 
                                                </label>

                                            @endif                 

                                     
                                    </td>

                                    @endif
                                    
                                </tr>

                                @endforeach
                               
                            </tbody>
                        </table>

                        {{$faltantes->render()}}
                        
                    </div>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
                       
           
        <!-- Inicio del modal cambiar estado de Faltante -->
         <div class="modal fade" id="cambiarEstadoFaltante" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-dark" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Cambiar Estado de Faltante</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true" class="text-light">×</span>
                            </button>
                        </div>

                    <div class="modal-body">
                        <form action="{{route('faltante.destroy','test')}}" method="POST">
                          {{method_field('delete')}}
                          {{csrf_field()}} 

                            <input type="hidden" id="idfaltante" name="idfaltante" value="">

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
@endsection