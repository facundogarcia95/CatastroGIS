
@extends('principal')
@section('contenido')


<main class="main">

 <div class="card-body">
   
            <div class="form-group row border m-1 bg-light">

              <div class="col-md-12 border"> 

                  <h2 class="text-left text-uppercase p-3">Datos Empleado</h2>
              
              </div>

                    <div class="col-md-3 border">  

                        <label class="form-control-label m-1" for="nombre">Nombre y Apellido</label>
                        
                        <p class="m-1 font-weight-bold">{{$empleado->nombre}} {{$empleado->apellido}}</p>
                            
                    </div>

                    <div class="col-md-3 border">  

                    <label class="form-control-label m-1" for="documento">Documento</label>

                    <p class="m-1 font-weight-bold">{{$empleado->num_documento}}</p>
                    
                    </div>

                    <div class="col-md-3 border">
                            <label class="form-control-label m-1" for="num_tel">Teléfono</label>
                            
                            <p class="m-1 font-weight-bold">{{$empleado->telefono}}</p>
                    </div>

                    <div class="col-md-3 border">
                      <label class="form-control-label m-1" for="email">Email</label>
                      
                      <p class="m-1 font-weight-bold">{{$empleado->email}}</p>
                    </div>

                    @if($empleado->direccion)
                    
                    <div class="col-md-8 border">
                      <label class="form-control-label m-1" for="dirección">Dirección</label>
                      
                      <p class="m-1 font-weight-bold">{{$empleado->direccion}}</p>
                    </div>

                    <div class="col-md-4 border">
                      <label class="form-control-label m-1" for="fecha">Fecha Nacimiento</label>
                      
                      <p class="m-1 font-weight-bold">{{$empleado->fecha_nacimiento}}</p>
                    </div>

                    @endif

            </div>

            
            <br/><br/>

           <div class="form-group row border m-1  bg-light">

              <h3 class="m-2">Novedades del empleado</h3>

              <div class="col-sm-12">
                <table id="detalles" class="table table-responsive table-bordered table-striped table-sm">
                <thead>
                    <tr class="bg-dark text-light">
                        <th>Nombre de ficha</th>
                        <th>Acción</th>
                    </tr>
                </thead>

                <tbody>
                   
                  @if(count($novedades) == 0)
                    <tr>
                      <td colspan="2">
                        <p class="h5 text-danger"> No se encontraron novedades.</p>
                      </td>
                    </tr>
                  @endif

                   @foreach($novedades as $novedad)

                    <tr>
      
                      <td>
                        <a class="h5 text-primary"  href="{{ action('NovedadController@show', ['id' => Crypt::encrypt($novedad->id)]) }}">{{$novedad->denominacion}}</a>
                      </td>
                      <td>  
                          <button type="button" class="btn btn-danger rounded  btn-sm" data-id_novedad="{{$novedad->id}}" data-toggle="modal" data-target="#cambiarEstadoNovedad">
                            <i class="fa fa-times fa-2x"></i> Desactivar
                          </button>
                      </td>
                      
                    </tr> 


                   @endforeach
                   
                </tbody>

                @if(count($novedades) < $cantidad)
                <tfoot>
                  <th colspan="2"> <a href="{{ action('NovedadController@create', ['empleado' => Crypt::encrypt($empleado->id)]) }}" class="btn btn-success pull-right"><i class="fa fa-plus-square fa-2x"></i> Agregar Novedad</a></th>
                </tfoot>
                @endif
                
                </table>
              </div>
            
            </div>


    </div><!--fin del div card body-->

           <!-- Inicio del modal Cambiar Estado de Ficha -->
        <div class="modal fade" id="cambiarEstadoNovedad" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dark" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Cambiar Estado de la Novedad</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true" class="text-light">×</span>
                        </button>
                    </div>

                <div class="modal-body">
                    <form action="{{route('novedad.destroy','test')}}" method="POST">
                     {{method_field('delete')}}
                     {{csrf_field()}} 

                        <input type="hidden" id="id_novedad" name="id_novedad" value="">

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