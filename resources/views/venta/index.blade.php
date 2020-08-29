@extends('principal')
@section('contenido')
<main class="main">
            @include('breadcrumb.bread')
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">

                       <h2>Listado de Ventas</h2><br/>
                       
                       <a href="venta/create">

                        <button class="btn btn-primary btn-lg rounded" type="button">
                            <i class="fa fa-plus fa-2x"></i>&nbsp;&nbsp;Agregar Venta
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
                                    <input id="buscarPorTexto" type="text" class="form-control" placeholder="Buscar texto" value="">
                                    <input id="fecha" type="date"  class="form-control d-none" >
                                    <button disabled class="btn btn-primary"><i class="fa fa-search"></i> Buscador</button>
                                    
                                </div>

                            </div>
                        </div>
                        <table id="tablaventa" class="table table-bordered table-striped table-sm table-responsive ">
                            <thead>
                                <tr class="bg-dark text-light" >
                                    
                                    <th>Ver Detalle</th>
                                    <th>Fecha Venta</th>
                                    <th>Número Venta</th>
                                    <th>Cliente</th>
                                    <th>Tipo de Facturación</th>
                                    <th>Usuario</th>
                                    <th>Total ($)</th>
                                    <th>Estado</th>
                                    @if ($usuarioRol == 1 || $usuarioRol == 4)
                                    <th>Cambiar Estado</th>
                                    @endif
                                    <th>Reporte</th>
                                    
                                </tr>
                            </thead>
                            <tbody>

                              @foreach($ventas as $vent)
                               
                                <tr>
                                    <td>
                                     
                                     <a href="{{URL::action('VentaController@show',$vent->id)}}" style="text-decoration: none">
                                       <button type="button" class="btn btn-detalle btn-sm rounded text-light">
                                         <i class="fa fa-eye fa-2x "></i> Detalle
                                       </button> &nbsp;

                                     </a>
                                   </td>

                                    <td>{{$vent->fecha_venta}}</td>
                                    <td>{{$vent->num_venta}}</td>
                                    <td>{{$vent->cliente}}</td>
                                    <td>{{$vent->tipo_identificacion}}</td>
                                    <td>{{$vent->nombre}}</td>
                                    <td>${{number_format($vent->total,2)}}</td>
                                    <td>
                                      
                                      @if($vent->estado=="Registrado")
                                     
                                         <label class="text-success"> <i class="fa fa-check fa-2x"></i> Registrada </label>
                       

                                      @elseif($vent->estado=="Anulado")

                                      <label class="text-danger"> 
                                          <i class="fa fa-times fa-2x"></i> Anulada
                                        </label>

                                      @else

                                      <label class="text-danger"> 
                                        <i class="fa fa-times fa-2x"></i> Anulada con pérdida
                                      </label>

                                       @endif
                                       
                                    </td>

                                    @if ($usuarioRol == 1 || $usuarioRol == 4)
                                    <td >

                                       @if($vent->estado=="Registrado")

                                        <button type="button" class="btn btn-danger btn-sm rounded mr-2" data-id_venta="{{$vent->id}}" data-toggle="modal" data-target="#cambiarEstadoVenta">
                                            <i class="fa fa-times fa-2x"></i> Anular Venta
                                        </button>

                                        @else

                                        <label class="text-dark ml-2" >
                                                <i class="fa fa-lock fa-2x "></i> BLOQUEADO
                                        </label>

                                        @endif
                                       
                                    </td>
                                    @endif
                                    
                                    <td>
                                       
                                        <a href="{{url('pdfVenta',$vent->id)}}" target="_blank" style="text-decoration: none">
                                           
                                           <button type="button" class="btn btn-report btn-sm rounded text-light">
                                            
                                             <i class="fa fa-file fa-2x"></i> Descargar PDF
                                           </button> &nbsp;

                                        </a> 

                                    </td>
                                </tr>

                                @endforeach
                               
                            </tbody>
                        </table>

                        {{$ventas->render()}}
                        
                    </div>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
                       
           
        <!-- Inicio del modal cambiar estado de venta -->
        <div class="modal fade" id="cambiarEstadoVenta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dark" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Cambiar Estado de Venta</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true" class="text-light">×</span>
                            </button>
                        </div>

                        <form action="{{route('venta.destroy','test')}}" method="POST">
                            {{method_field('delete')}}
                            {{csrf_field()}} 

                                <div class="modal-body">
                            
                                    <input type="hidden" id="id_venta" name="id_venta" value="">

                                        <p>¿Está seguro que desea cambiar el estado?</p>
            
                                        <div class=" mb-3">
                                            <input type="checkbox" name="retornoStock" checked="true" class="big-checkbox"> <b > Anular venta con pérdida de stock</b>
                                        </div>

                                        <label class="form-control-label" for="observacion">Observacion</label>
                                    
                                        <textarea  name="observacion" class="form-control" placeholder="Agregar observacion" required></textarea>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">Aceptar</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                </div>
                       
                        </form>
                    <!-- /.modal-content -->
                   </div>
                <!-- /.modal-dialog -->
            </div>
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
        $.each($("#tablaventa tbody tr"), function() {    
             if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
                $(this).hide();
            else
                $(this).show();
         });
    });

</script>
@endpush
@endsection