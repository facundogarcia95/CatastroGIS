@extends('principal')
@section('breadcrumb')
    {{ Breadcrumbs::render('tipo_de_construccion') }}
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
           <h2>Gestión de Construccion de Mejoras</h2><br/>
           <button class="btn btn-primary btn-lg rounded" type="button" data-toggle="modal" data-target="#abrirmodal">
                <i class="fa fa-plus"></i>&nbsp;&nbsp;Agregar Construccion de Mejora
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
            <table id="tablaMejorasConstrucciones" class="table table-bordered table-striped dt-responsive nowrap" style="width: 100%">
                <thead>
                    <tr class="bg-dark text-light">
                        <th>Codigo</th>
                        <th>Descripción</th>
                        <th>coeficiente</th>
                        <th>Visible</th>
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
                                <h4 class="modal-title">Agregar Construccion de Mejora</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true" class="text-light">×</span>
                                </button>
                            </div>
                           
                            <div class="modal-body">
                                <form action="{{route('tipo_de_construccion.store')}}" method="post" class="form-horizontal was-validated" enctype="multipart/form-data" >
                                    {{csrf_field()}}
                                    @include('codigos.tipo_de_construccion.form')
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
                 <div class="modal fade" id="editarMejoraConstruccion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-dark modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Actualizar Construccion de Mejora</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true" class="text-light">×</span>
                                </button>
                            </div>                           
                            <div class="modal-body">                                 
                                <form action="{{route('tipo_de_construccion.update','test')}}" method="post" class="form-horizontal was-validated" enctype="multipart/form-data">
                                    {{method_field('patch')}}
                                    {{csrf_field()}}
                                    <input type="hidden" id="tipo_mejora_categoria_id" name="tipo_mejora_categoria_id" value="">                            
                                    @include('codigos.tipo_de_construccion.form')
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

                olTable = $('#tablaMejorasConstrucciones').DataTable({
                        "ajax":"tabla_de_construccion",
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
                            
                                {data: 'tipo_mejora_categoria_codigo'},
                                {data: 'tipo_mejora_categoria_descrip'},
                                {data: 'tipo_mejora_categoria_coeficiente'},
                                {data: 'condicion'},
                                {data: 'accion',"searchable": false }
                            ]
                });

            $("#buscarTexto").keyup(function() {
                olTable.search(this.value).draw();
            });    

        });


        /*INICIO ventana modal para cambiar el estado*/                
        $('#editarMejoraConstruccion').on('show.bs.modal', function (event) {
            //console.log('modal abierto');
            var button = $(event.relatedTarget) 
            var tipo_mejora_categoria_id = button.data('tipo_mejora_categoria_id')
            var tipo_mejora_categoria_codigo = button.data('tipo_mejora_categoria_codigo')
            var tipo_mejora_categoria_descrip = button.data('tipo_mejora_categoria_descrip')
            var tipo_mejora_categoria_coeficiente = button.data('tipo_mejora_categoria_coeficiente')
            var tipo_estado_id = button.data('tipo_estado_id')
            var modal = $(this)
            // modal.find('.modal-title').text('New message to ' + recipient)

            modal.find('.modal-body #tipo_mejora_categoria_id').val(tipo_mejora_categoria_id);
            modal.find('.modal-body #tipo_mejora_categoria_codigo').val(tipo_mejora_categoria_codigo);
            modal.find('.modal-body #tipo_mejora_categoria_descrip').val(tipo_mejora_categoria_descrip);
            modal.find('.modal-body #tipo_mejora_categoria_coeficiente').val(tipo_mejora_categoria_coeficiente);
            modal.find('.modal-body #tipo_estado_id').val(tipo_estado_id);
        })        
        /*FIN ventana modal para cambiar estado*/
    </script>
    
    

@endpush

@push('css')



@endpush
@endsection