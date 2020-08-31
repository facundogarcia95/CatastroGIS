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
                    <div class="col-md-12 border">
                      <label class="form-control-label m-1" for="dirección">Dirección</label>
                      
                      <p class="m-1 font-weight-bold">{{$empleado->direccion}}</p>
                    </div>
                    @endif

            </div>

            
            <br/><br/>

           <div class="form-group row border m-1  bg-light">

              <h3 class="m-2">Fichas del empleado</h3>

              <div class="col-md-12">
                <table id="detalles" class="table table-responsive  table-bordered table-default table-sm">
                <thead>
                    <tr class="bg-dark text-light">
                        <th>Nombre de ficha</th>
                        <th>Acción</th>
                    </tr>
                </thead>

                <tbody>
                   
                   @foreach($fichas as $ficha)

                    <tr>
                     
                      <td>{{$ficha->nombre}}</td>
                      <td>  
                          <a href="{{ action('FichaController@show', ['id' => $ficha->id]) }}" class="btn btn-warning rounded text-light btn-sm" >
                            <i class="fa fa-edit fa-2x"></i> Ver/Editar
                          </a> &nbsp; 
                          <button type="button" class="btn btn-danger rounded  btn-sm" data-id_ficha="{{$ficha->id}}" data-toggle="modal" data-target="#cambiarEstadoFicha">
                            <i class="fa fa-times fa-2x"></i> Desactivar
                          </button>
                      </td>
                      
                    </tr> 


                   @endforeach
                   
                </tbody>
                
                
                </table>
              </div>
            
            </div>

            <div class="modal-footer form-group row">
            
              <div class="col-md">

                  <a href="{{url('ficha/create',$empleado->id)}}" class="btn btn-success pull-right"><i class="fa fa-plus-square fa-2x"></i> Agregar ficha</button>
              
              </div>

            </div>


    </div><!--fin del div card body-->

           <!-- Inicio del modal Cambiar Estado de Ficha -->
        <div class="modal fade" id="cambiarEstadoFicha" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dark" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Cambiar Estado de la Ficha</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true" class="text-light">×</span>
                        </button>
                    </div>

                <div class="modal-body">
                    <form action="{{route('ficha.destroy','test')}}" method="POST">
                     {{method_field('delete')}}
                     {{csrf_field()}} 

                        <input type="hidden" id="id_ficha" name="id_ficha" value="">

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