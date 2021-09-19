@extends('principal')
@section('breadcrumb')
    {{ Breadcrumbs::render('tipos_de_ryb') }}
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

           <h2>Gestion de R y B de Parcela</h2><br/>

           <button class="btn btn-primary btn-lg rounded" type="button" data-toggle="modal" data-target="#abrirmodal">
                <i class="fa fa-plus"></i>&nbsp;&nbsp;Agregar R y B de Parcelas
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
            <table id="tablaTiposEstados" class="table table-bordered table-striped dt-responsive nowrap" style="width: 100%">
                <thead>
                    <tr class="bg-dark text-light">
                        <th>Código</th>
                        <th>Descripción</th>
                        <th>Abreviatura</th>
                        <th>UTM</th>
                        <th>Condicion</th>
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
                                <h4 class="modal-title">Agregar R y B</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true" class="text-light">×</span>
                                </button>
                            </div>
                           
                            <div class="modal-body">
                                <form action="{{route('tipo_de_ryb.store')}}" method="post" class="form-horizontal was-validated" enctype="multipart/form-data" >
                                    {{csrf_field()}}
                                    @include('codigos.tipo_de_ryb.form')
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
                 <div class="modal fade" id="editarTipoRyB" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-dark modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Actualizar R y B</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true" class="text-light">×</span>
                                </button>
                            </div>                           
                            <div class="modal-body">                                 
                                <form action="{{route('tipo_de_ryb.update','test')}}" method="post" class="form-horizontal was-validated" enctype="multipart/form-data">
                                    {{method_field('patch')}}
                                    {{csrf_field()}}    
                                    <input type="hidden" id="tipo_parcela_ryb_id" name="tipo_parcela_ryb_id" value="">                                    
                                    @include('codigos.tipo_de_ryb.form')    
                                </form>
                            </div>                            
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!--Fin del modal-->


                <div class="modal fade" id="cambiarEstadoRyB" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-dark" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Cambiar estado de R y B</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true" class="text-light">×</span>
                                </button>
                            </div>
    
                        <div class="modal-body">
                            <form action="{{route('tipo_de_ryb.destroy','test')}}" method="POST" class="was-validated">
                             {{method_field('delete')}}
                             {{csrf_field()}} 
    
                                <input type="hidden" id="tipo_parcela_ryb_id" name="tipo_parcela_ryb_id" value="">
    
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

</div>

@push('scripts')
    <script>
       $(document).ready(function () {

            olTable = $('#tablaTiposEstados').DataTable({
                    "ajax":"tabla_tipos_ryb",
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
                        
                            {data: 'tipo_parcela_ryb_codigo'},
                            {data: 'tipo_parcela_ryb_descrip'},
                            {data: 'tipo_parcela_ryb_abrev'},
                            {data: 'tipo_parcela_utm'},
                            {data: 'condicion'},
                            {data: 'accion',"searchable": false }
                        ]
            });

            $("#buscarTexto").keyup(function() {
                olTable.search(this.value).draw();
            });    

});
              
        $('#editarTipoRyB').on('show.bs.modal', function (event) {

            var button = $(event.relatedTarget) 
            var tipo_parcela_ryb_id = button.data('tipo_parcela_ryb_id')
            var tipo_parcela_ryb_codigo = button.data('tipo_parcela_ryb_codigo')
            var tipo_parcela_ryb_descrip = button.data('tipo_parcela_ryb_descrip')
            var tipo_parcela_ryb_abrev = button.data('tipo_parcela_ryb_abrev')
            var tipo_parcela_utm = button.data('tipo_parcela_utm')
            var tipo_estado_id = button.data('tipo_estado_id')
            var modal = $(this)

            modal.find('.modal-body #tipo_parcela_ryb_id').val(tipo_parcela_ryb_id);
            modal.find('.modal-body #tipo_parcela_ryb_codigo').val(tipo_parcela_ryb_codigo);
            modal.find('.modal-body #tipo_parcela_ryb_descrip').val(tipo_parcela_ryb_descrip);
            modal.find('.modal-body #tipo_parcela_ryb_abrev').val(tipo_parcela_ryb_abrev);
            modal.find('.modal-body #tipo_parcela_utm').val(tipo_parcela_utm);
            modal.find('.modal-body #tipo_estado_id').val(tipo_estado_id);
        })        


        $('#cambiarEstadoRyB').on('show.bs.modal', function (event) {
            
            var button = $(event.relatedTarget) 
            var tipo_parcela_ryb_id = button.data('tipo_parcela_ryb_id')
            var modal = $(this)
            
            modal.find('.modal-body #tipo_parcela_ryb_id').val(tipo_parcela_ryb_id);

    })

    </script>
    
    

    @endpush

    @push('css')

    

    @endpush
@endsection