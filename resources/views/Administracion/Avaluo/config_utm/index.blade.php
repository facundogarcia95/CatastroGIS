@extends('principal')
@section('breadcrumb')
    {{ Breadcrumbs::render('config_calc_avaluo') }}
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

           <h2>Lista de UTM</h2><br/>

           <button class="btn btn-primary btn-lg rounded" type="button" data-toggle="modal" data-target="#abrirmodal">
                <i class="fa fa-plus"></i>&nbsp;&nbsp;Agregar UTM
            </button>
            
            <button class="btn btn-primary btn-lg rounded" type="button" data-toggle="modal" data-target="#editarUtm">
                <i class="fa fa-plus"></i>&nbsp;&nbsp;Actualizar UTM
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
            <table id="tablaUTM" class="table table-bordered table-striped dt-responsive nowrap" style="width: 100%">
                <thead>
                    <tr class="bg-dark text-light">
                        <th>Fecha Inicio</th>
                        <th>Fecha Fin</th>
                        <th>Valor</th>
                        <th>Estado</th>
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
                        <h4 class="modal-title">UTM</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="text-light">×</span>
                        </button>
                    </div>
                    
                    <div class="modal-body">
                        <form action="{{route('config_utm.store')}}" method="post" class="form-horizontal was-validated" enctype="multipart/form-data" >
                            {{csrf_field()}}
                            @include('Administracion.Avaluo.config_utm.form')
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
    <div class="modal fade" id="editarUtm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dark modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Actualizar Parcela con UTM Fijas</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-light">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('config_utm.update','test')}}" method="post" class="form-horizontal was-validated" enctype="multipart/form-data">
                    {{method_field('patch')}}
                    {{csrf_field()}}
                    @include('Administracion.Avaluo.config_utm.proceso')
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
            olTable = $('#tablaUTM').DataTable({
                    "ajax":"tablaUTM",
                    "pageLength": 5,
                    "lengthMenu": [[1,5,10,25,50,100,-1], ['1','5','10','25','50','100','Todos']],
                    "deferRender": true,
                    "retrieve": true,
                    "processing": true,
                    "order": [[2,"desc"]],
                    "language": {
                            "sProcessing":     "",
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
                            {data: 'fecha_desde'},
                            {data: 'fecha_hasta'},
                            {data: 'valor'},                            
                            {data: 'estado'}
                    ]                 
            });

            $("#buscarTexto").keyup(function() {
                olTable.search(this.value).draw();
            });
        });

        $("#ejecutar_script").click(function () { 
            Swal.fire({
                position: 'center',
                title: 'Actualizacion de Avaluo!',
                html: 'Se encuentra en proceso de actualizacion de los datos de avaluo de las parcelas, puede demorar varios minutos',
                allowOutsideClick: false,
                onBeforeOpen: () => {
                    Swal.showLoading()
                },
            });
           
        });
    </script>
    @endpush
    @push('css')
    @endpush
@endsection