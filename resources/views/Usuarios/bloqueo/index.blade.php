@extends('principal')
@section('breadcrumb')
    {{ Breadcrumbs::render('Bloqueo') }}
@endsection
@section('contenido')

<div class="container-fluid mt-6">
    
    <div class="card">
        @if ( session('success'))
            <div class="alert alert-success" role="alert">{{session('success')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true" class="text-dark">&times;</span>
                </button>
            </div>
        @elseif( session('error') )
            <div class="alert alert-danger" role="alert">{{session('error')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true" class="text-dark">&times;</span>
                </button>
            </div>
        @endif

        <div class="card-header">

           <h2>Bloqueos</h2><br/>

        </div>
        <div class="card-body">
            <div class="form-group row">
                <div class="col-md-6">
             
                    <div class="input-group">
                       
                    <input type="text" id="buscarTexto" name="buscarTexto" class="form-control" placeholder="Buscar texto" value="{{$padron}}">
                        <button  class="btn btn-primary"><i class="fa fa-search"></i> Buscador</button>
                       
                    </div>
           
                </div>
            </div>
            <table id="tablaBloqueos" class="table table-bordered table-striped dt-responsive nowrap" style="width: 100%" >
                <thead>
                    <tr class="bg-dark text-light">
                       
                        <th>Padrón</th>
                        <th>Usuario</th>
                        <th>Descripción</th>
                        <th colspan="2">Eliminar Bloqueo</th>
                    </tr>
                </thead>
             
                </tbody>
            </table>       
        </div>
    </div>


    <!-- Fin ejemplo de tabla Listado -->


            
             <!-- Inicio del modal Cambiar Estado del usuario -->
             <div class="modal fade" id="cambiarEstado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-dark" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Eliminar bloqueo</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true" class="text-light">×</span>
                            </button>
                        </div>

                    <div class="modal-body">
                        <form action="{{route('bloqueo.destroy','test')}}" method="POST" class="was-validated">
                         {{method_field('delete')}}
                         {{csrf_field()}} 

                            <input type="hidden" id="parcela_id" name="parcela_id" value="">
                                <p>¿Desea eliminar el bloqueo del padrón?</p>
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
            </div>
            <!-- Fin del modal Eliminar -->


            
             <!-- Inicio del modal Cambiar Estado del usuario -->
             <div class="modal fade" id="redireccionAlPadron" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-dark" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Redireccionar al Padrón</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true" class="text-light">×</span>
                            </button>
                        </div>
                            
                    <div class="modal-body">
                                <p>¿Desea ir al padrón desbloqueado?</p>
                            <div class="modal-footer">
                                @if(session('parcela'))
                                    <a href="{{url('gestion/padron/'.session('parcela'))}}" class="btn btn-success rounded">Aceptar</a>
                                @endif
                                <button type="button" class="btn btn-danger rounded" data-dismiss="modal">Cerrar</button>
                            </div>

                         </form>
                    </div>
                    <!-- /.modal-content -->
                   </div>
                <!-- /.modal-dialog -->
                </div>
            </div>
            <!-- Fin del modal Eliminar -->


</div>

@push('scripts')
    <script>

          
$(document).ready(function () {

    olTable = $('#tablaBloqueos').DataTable({
        "ajax":"tabla_bloqueos",
        "deferRender": true,
        "retrieve": true,
        "processing": true,
        "language": {

            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
            "sFirst":    "Primero",
            "sLast":     "Último",
            "sNext":     "Siguiente",
            "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }

    },
    columns: [
        
            {data: 'padron'},
            {data: 'usuario'},
            {data: 'descripcion'},
            {data: 'accion',"searchable": false }
        ]
    });

        $("#buscarTexto").keyup(function() {
            olTable.search(this.value).draw();
        });   
        
        @isset($padron)
            olTable.search('{{$padron}}').draw();
        @endisset

        @if(session('parcela'))
            $("#redireccionAlPadron").modal("show");
        @endif 



    });


        /*INICIO ventana modal para cambiar el estado*/
                
        $('#cambiarEstado').on('show.bs.modal', function (event) {

            //console.log('modal abierto');

            var button = $(event.relatedTarget) 
            var parcela_id = button.data('parcela_id')
            var modal = $(this)
            // modal.find('.modal-title').text('New message to ' + recipient)

            modal.find('.modal-body #parcela_id').val(parcela_id);

        })
        
        /*FIN ventana modal para cambiar estado*/


       


    </script>
   
   

   @endpush

   @push('css')

   

   @endpush
@endsection