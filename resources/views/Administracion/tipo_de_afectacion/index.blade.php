@extends('principal')
@section('breadcrumb')
    {{ Breadcrumbs::render('tipo_de_afectacion') }}
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
            <div class="alert alert-danger" role="alert">{{ trans(session('error')) }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true" class="text-dark">&times;</span>
                </button>
            </div>
        @endif

        <div class="card-header">


           <h2>Tipos de Afectaciones</h2><br/>

           <button class="btn btn-primary btn-lg rounded" type="button" data-toggle="modal" data-target="#abrirmodal">
                <i class="fa fa-plus"></i>&nbsp;&nbsp;Agregar Tipo de Afectación
            </button>
            
        </div>
        <div class="card-body">
            <div class="form-group row">
                <div class="col-md-6">
             
                    <div class="input-group">
                        <input type="text" id="buscarTexto" name="search" class="form-control" placeholder="Buscar texto" >
                        <button type="button" class="btn btn-primary"><i class="fa fa-search" disabled></i> Buscador</button>
                    </div> 
           
                </div>
            </div>
            <table id="tablaTiposParcelas" class="table table-bordered table-striped table-responsive dt-responsive" style="width: 100% !important">
                <thead>
                    <tr class="bg-dark text-light">
                       
                        <th>Código</th>
                        <th>Descripción</th>
                        <th>Estado</th>
                        <th>Sección</th>
                        <th>Editar</th>
                    </tr>
                </thead>
              
            </table>
                


         
        </div>
    </div>


    <!-- Fin ejemplo de tabla Listado -->


                   <!--Inicio del modal agregar-->
                   <div class="modal fade" id="abrirmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-dark modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Agregar Tipo de Afectación</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true" class="text-light">×</span>
                                </button>
                            </div>
                           
                            <div class="modal-body">
                                 
    
                                <form action="{{route('tipo_de_afectacion.store')}}" method="post" class="form-horizontal was-validated" enctype="multipart/form-data" >
                                   
                                    {{csrf_field()}}
                                    
                                    @include('Administracion.tipo_de_afectacion.form')
    
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
                 <div class="modal fade" id="editarTipoParcela" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-dark modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Actualizar Afectación</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true" class="text-light">×</span>
                                </button>
                            </div>
                           
                            <div class="modal-body">
                                 
                                <form action="{{route('tipo_de_afectacion.update','test')}}" method="post" class="form-horizontal was-validated" enctype="multipart/form-data">
                                    
                                    {{method_field('patch')}}
                                    {{csrf_field()}}
    
                                    <input type="hidden" id="tipo_afectacion_id" name="tipo_afectacion_id" value="">
                                    
                                    @include('Administracion.tipo_de_afectacion.form')
                                    
    
                                </form>
                            </div>
                            
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!--Fin del modal-->



</div>

@push('scripts')
    <script>

    $(document).ready(function () {

        olTable = $('#tablaTiposParcelas').DataTable({
                "ajax":"tabla_tipo_de_afectacion",
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
                    
                        {data: 'tipo_afectacion_codigo'},
                        {data: 'tipo_afectacion_descrip'},
                        {data: 'condicion'},
                        {data: 'seccion'},
                        {data: 'accion',"searchable": false }
                    ]
        });

        $("#buscarTexto").keyup(function() {
            olTable.search(this.value).draw();
        });    

});


        /*INICIO ventana modal */
                
        $('#editarTipoParcela').on('show.bs.modal', function (event) {

            var button = $(event.relatedTarget) 
            var tipo_afectacion_id = button.data('tipo_afectacion_id')
            var tipo_afectacion_codigo = button.data('tipo_afectacion_codigo')
            var tipo_afectacion_descrip = button.data('tipo_afectacion_descrip')
            var seccion_id = button.data('seccion_id')
            var tipo_estado_id = button.data('tipo_estado_id')
           // var tipo_documento_abrev = button.data('tipo_documento_abrev')
            var modal = $(this)
            // modal.find('.modal-title').text('New message to ' + recipient)

            modal.find('.modal-body #tipo_afectacion_id').val(tipo_afectacion_id);
            modal.find('.modal-body #tipo_afectacion_codigo').val(tipo_afectacion_codigo);
            modal.find('.modal-body #tipo_afectacion_descrip').val(tipo_afectacion_descrip);
            modal.find('.modal-body #seccion_id').val(seccion_id);
            modal.find('.modal-body #tipo_estado_id').val(tipo_estado_id);
            //modal.find('.modal-body #tipo_documento_abrev').val(tipo_documento_abrev);

        })
        
        /*FIN ventana modal para cambiar estado*/


    </script>

    
    <script src="{{asset('js/librerias/dataTables.bootstrap4.min.js')}}"></script>

@endpush

@push('css')

    

@endpush
@endsection