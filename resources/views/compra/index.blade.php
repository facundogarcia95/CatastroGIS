
@extends('principal')
@section('contenido')
<main class="main">
            @include('breadcrumb.bread')
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">

                       <h2>Listado de Compras</h2><br/>
                       
                       <a href="compra/create">

                        <button class="btn btn-primary btn-lg rounded ml-2" type="button">
                            <i class="fa fa-plus fa-2x"></i>&nbsp;&nbsp;Agregar Compra
                        </button>

                        </a>
                       
                    </div>
                    <div class="card-body">

                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <button type="button" class="btn btn-primary date">
                                        <i class="fa fa-calendar-check-o"></i>     
                                    </button>
                                    <input id="fecha" type="date"  class="form-control d-none" >
                                    <input type="text" id="buscarPorTexto" name="buscarTexto" class="form-control" placeholder="Buscar texto" value="">
                                    <button disabled class="btn btn-primary "><i class="fa fa-search"></i> Buscador</button> &nbsp;
                                 
                                </div>
                            
                            </div>
                        </div>
                        <table id="tablacompra" class="table table-bordered table-striped table-sm table-responsive">
                            <thead>
                                <tr class="bg-dark text-light">
                                    
                                    <th>Ver Detalle</th>
                                    <th>Fecha Compra</th>
                                    <th>N° Comprobante</th>
                                    <th>Proveedor</th>
                                    <th>Tipo de identificación</th>
                                    <th>Usuario</th> 
                                    <th>Total ($)</th>
                                    <th>Estado</th>
                                    @if ($usuarioRol == 1)
                                    <th>Cambiar Estado</th> 
                                    @endif
                                    <th>Descargar Reporte</th>
                                    
                                </tr>
                            </thead>
                            <tbody>

                              @foreach($compras as $comp)
                               
                                <tr>
                                    <td>
                                     
                                     <a href="{{URL::action('CompraController@show',$comp->id)}}" style="text-decoration: none !important">
                                       <button type="button" class="btn btn-detalle rounded btn-md text-light">
                                         <i class="fa fa-eye "></i> Detalle
                                       </button> &nbsp;

                                     </a>
                                   </td>

                                    <td>{{$comp->fecha_compra}}</td>
                                    <td>{{$comp->num_compra}}</td>
                                    <td>{{$comp->proveedor}}</td>
                                    <td>{{$comp->tipo_identificacion}}</td>
                                    <td>{{$comp->nombre}}</td>
                                    <td>${{number_format($comp->total,2)}}</td>
                                    <td class="">
                                      
                                      @if($comp->estado=="Registrado")
                                        <label class=" text-success h6">
                                    
                                          <i class="fa fa-check fa-2x"></i> Registrado
                                        </label>

                                      @else

                                        <label class=" text-danger h6">
                                    
                                          <i class="fa fa-check fa-2x"></i> Anulado
                                        </label>

                                       @endif
                                       
                                    </td>

                                    @if ($usuarioRol == 1 || $usuarioRol == 4)
                                    <td >

                                            @if($comp->estado=="Registrado")

                                                <button type="button" class="btn btn-danger rounded btn-sm" data-id_compra="{{$comp->id}}" data-toggle="modal" data-target="#cambiarEstadoCompra">
                                                    <i class="fa fa-times fa-2x"></i> Anular Compra
                                                </button>

                                                @else

                                                <label class=" text-dark ml-2">
                                                    <i class="fa fa-lock fa-2x"></i> BLOQUEADO 
                                                </label>

                                            @endif                 

                                     
                                    </td>

                                    @endif
                                    
                                    <td>
                                       
                                       <a href="{{url('pdfCompra',$comp->id)}}" target="_blank" style="text-decoration: none !important">
                                          
                                          <button type="button" class="btn btn-report rounded text-light btn-sm" >
                                           
                                            <i class="fa fa-file fa-2x"></i> Descargar PDF
                                          </button> &nbsp;

                                       </a> 

                                   </td>
                                </tr>

                                @endforeach
                               
                            </tbody>
                        </table>

                        {{$compras->render()}}
                        
                    </div>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
                       
           
        <!-- Inicio del modal cambiar estado de compra -->
         <div class="modal fade" id="cambiarEstadoCompra" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
              <div class="modal-dialog modal-danger" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Cambiar Estado de Compra</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>

                        <form action="{{route('compra.destroy','test')}}" method="POST">
                          {{method_field('delete')}}
                          {{csrf_field()}} 
                          
                          <div class="modal-body">
                      
                            <input type="hidden" id="id_compra" name="id_compra" value="">

                                <p>¿Está seguro que desea cambiar el estado?</p>

                                
                                <label class="form-control-label" for="observacion">Observacion</label>
                                
                                <textarea  name="observacion" class="form-control" placeholder="Agregar observacion" required></textarea>
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
           
            
        </main>
        @push('scripts')
        <script>
            var booleanoDate = false;
        
            $(".date").on("click",function(){
                if(!booleanoDate){
                    $("#fecha").removeClass("d-none");
                    $("#buscarPorTexto").addClass("d-none");
                    booleanoDate = true;
                }else{
                    $("#fecha").addClass("d-none");
                    $("#buscarPorTexto").removeClass("d-none");
                    $("#buscarPorTexto").val("");
                    $("#buscarPorTexto").keyup();
                    booleanoDate = false;
                }
                   
            })
        
            $('#fecha').on("change",function(){
               if(booleanoDate){
                    $("#buscarPorTexto").val($(this).val());
                    $("#buscarPorTexto").keyup();
               }
            })


            $("#buscarPorTexto").keyup(function(){
            _this = this;
                // Show only matching TR, hide rest of them
            $.each($("#tablacompra tbody tr"), function() {
                
                if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
                    $(this).hide();
                else
                    $(this).show();

            });
          });
        
            

        
        </script>
        @endpush

@endsection