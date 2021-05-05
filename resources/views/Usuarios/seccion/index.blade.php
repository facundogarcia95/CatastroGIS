@extends('principal')
@section('breadcrumb')
    {{ Breadcrumbs::render('seccion') }}
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

           <h2>Secciones</h2><br/>
          
            <button class="btn btn-primary btn-lg rounded" type="button" data-toggle="modal" data-target="#abrirmodal">
                <i class="fa fa-plus"></i>&nbsp;&nbsp;Agregar Sección
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
            <table id="tablaSecciones" class="table table-bordered table-striped dt-responsive nowrap" style="width: 100%" >
                <thead>
                    <tr class="bg-dark text-light">
                        <th>Sección</th>
                        <th>Afectación</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                
            </table>
                

         
        </div>
    </div>

               <!--Inicio del modal agregar-->
               <div class="modal fade" id="abrirmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-dark modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Agregar Sección</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true" class="text-light">×</span>
                            </button>
                        </div>
                       
                        <div class="modal-body">
                             

                            <form action="{{route('seccion.store')}}" method="post" class="form-horizontal was-validated" enctype="multipart/form-data" >
                               
                                {{csrf_field()}}
                                
                                @include('Usuarios.seccion.form')

                            </form>
                        </div>
                        
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->

    <!-- Fin ejemplo de tabla Listado -->

             <!--Inicio del modal actualizar-->
             <div class="modal fade" id="abrirmodalEditarSeccion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-dark modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Actualizar sección</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true" class="text-light">×</span>
                            </button>
                        </div>
                       
                        <div class="modal-body">
                             
                            <form action="{{route('seccion.update','test')}}" method="post" class="form-horizontal was-validated" enctype="multipart/form-data">
                                
                                {{method_field('patch')}}
                                {{csrf_field()}}

                                <input type="hidden" id="seccion_id_edit" name="seccion_id" value="">
                                
                                @include('Usuarios.seccion.form')
                                

                            </form>
                        </div>
                        
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->

            
             <!-- Inicio del modal Cambiar Estado del usuario -->
             <div class="modal fade" id="cambiarEstado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-dark" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Cambiar Estado</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true" class="text-light">×</span>
                            </button>
                        </div>

                    <div class="modal-body">
                        <form action="{{route('seccion.destroy','test')}}" method="POST" class="was-validated">
                         {{method_field('delete')}}
                         {{csrf_field()}} 

                            <input type="hidden" id="seccion_id_estado" name="seccion_id" value="">

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
            </div>
            <!-- Fin del modal Eliminar -->


            <!-- Inicio del modal Cambiar Estado del usuario -->
            <div class="modal fade" id="cambiarAfectacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-dark" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Cambiar Afectación</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true" class="text-light">×</span>
                            </button>
                        </div>

                    <div class="modal-body">
                        <form action="{{url('afectacion')}}" method="POST" class="was-validated">
                            {{method_field('put')}}
                            {{csrf_field()}} 

                            <input type="hidden" id="idSeccion" name="seccion_id" value="">

                                <p>¿Está seguro que desea cambiar la afectación?</p>
        

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


</div>

@push('scripts')
    <script>

 
$(document).ready(function () {

    olTable = $('#tablaSecciones').DataTable({
        "ajax":"tabla_seccion",
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
            {data: 'seccion_descrip'},
            {data: 'afectacion'},
            {data: 'estado'},
            {data: 'acciones',"searchable": false }
        ]
    });

    $("#buscarTexto").keyup(function() {
        olTable.search(this.value).draw();
    });    

    olTable.columns.adjust().draw();

});

        /*INICIO ventana modal para cambiar el estado*/
                
        $('#cambiarEstado').on('show.bs.modal', function (event) {

            //console.log('modal abierto');

            var button = $(event.relatedTarget) 
            var seccion_id = button.data('id_seccion')
            var modal = $(this)
            // modal.find('.modal-title').text('New message to ' + recipient)

            modal.find('.modal-body #seccion_id_estado').val(seccion_id);

        })
        
        /*FIN ventana modal para cambiar estado*/


        /*INICIO ventana modal para cambiar la afectacion */
                
         $('#cambiarAfectacion').on('show.bs.modal', function (event) {

                //console.log('modal abierto');
                var button = $(event.relatedTarget) 
                var seccion_id = button.data('id_seccion')
                var modal = $(this)
                // modal.find('.modal-title').text('New message to ' + recipient)

                modal.find('.modal-body #idSeccion').val(seccion_id);

        })

        /*FIN ventana modal para cambiar estado del usuario*/

        /*INICIO ventana modal para cambiar la afectacion */
                
        $('#abrirmodalEditarSeccion').on('show.bs.modal', function (event) {

            //console.log('modal abierto');
            var button = $(event.relatedTarget) 
            var seccion_id = button.data('id_seccion')
            var seccion_descrip = button.data('seccion_descrip')
            var modal = $(this)
            // modal.find('.modal-title').text('New message to ' + recipient)

            modal.find('.modal-body #seccion_id_edit').val(seccion_id);
            modal.find('.modal-body #nombre').val(seccion_descrip);

        })

        /*FIN ventana modal para cambiar estado del usuario*/

    </script>
    
    

  @endpush

  @push('css')

  

  @endpush
@endsection