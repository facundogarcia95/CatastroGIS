@extends('principal')
@section('contenido')
<main class="main">
            @include('breadcrumb.bread')
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">

                       <h2>Listado de Ajustes</h2><br/>
                       
                       <a href="ajuste/create" style="text-decoration: none">
                        <button class="btn btn-primary btn-lg m-2 rounded" type="button">
                            <i class="fa fa-plus fa-2x"></i>&nbsp;&nbsp;Agregar Ajuste
                        </button>
                        </a>

                        <a href="{{url('listarAjustesPdf')}}" target="_blank" style="text-decoration: none">
                          <button type="button" class="btn btn-report btn-lg m-2 text-light rounded">
                              <i class="fa fa-file fa-2x"></i>&nbsp;&nbsp;Reporte PDF
                              
                          </button>
                      </a>
                       
                    </div>
                    <div class="card-body">

                        <div class="form-group row">
                            <div class="col-md-6">
                            {!! Form::open(array('url'=>'ajuste','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!} 
                                <div class="input-group">
                                   
                                    <input type="text" name="buscarTexto" class="form-control" placeholder="Buscar texto" value="{{$buscarTexto}}">
                                    <button type="submit"  class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>&nbsp;
                                    <a href={{url('ajuste')}}  class="btn btn-primary">Limpiar</a>
                                </div>
                            {{Form::close()}}
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm table-responsive">
                            <thead>
                                <tr class="bg-dark text-light">
                                    
                                    <th>Ver Detalle</th>
                                    <th>Fecha Ajuste</th>
                                    <th>Usuario</th>
                                    <th>Observacion</th> 
                                    <th>Estado</th>
                                    @if ($usuarioRol == 1)
                                    <th>Cambiar Estado</th> 
                                    @endif
                                    
                                </tr>
                            </thead>
                            <tbody>
                              @foreach($ajustes as $ajuste)
                               
                                <tr>
                                    <td>
                                     
                                     <a href="{{URL::action('AjusteController@show',$ajuste->id)}}" style="text-decoration:none">
                                       <button type="button" class="btn btn-detalle btn-sm rounded text-light">
                                         <i class="fa fa-eye fa-2x"></i> Detalle
                                       </button> &nbsp;

                                     </a>
                                   </td>

                                    <td>{{$ajuste->created_at}}</td>
                                    <td>{{$ajuste->nombre}}</td>
                                    <td>
                                      @isset($ajuste->observacion)
                                        {{$ajuste->observacion}}
                                      @else    
                                        SIN OBSERVACIÓN
                                      @endisset
                                    </td>
                                    <td>
                                      
                                      @if($ajuste->condicion==1)
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

                                      

                                            @if($ajuste->condicion==1)

                                                <button type="button" class="btn btn-danger btn-sm rounded" data-idajuste="{{$ajuste->id}}" data-toggle="modal" data-target="#cambiarEstadoAjuste">
                                                    <i class="fa fa-times fa-2x"></i> Anular Ajuste
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

                        {{$ajustes->render()}}
                        
                    </div>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
                       
           
        <!-- Inicio del modal cambiar estado de Ajuste -->
         <div class="modal fade" id="cambiarEstadoAjuste" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-dark" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Cambiar Estado de Ajuste</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true" class="text-light">×</span>
                            </button>
                        </div>

                    <div class="modal-body">
                        <form action="{{route('ajuste.destroy','test')}}" method="POST">
                          {{method_field('delete')}}
                          {{csrf_field()}} 

                            <input type="hidden" id="idajuste" name="idajuste" value="">

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