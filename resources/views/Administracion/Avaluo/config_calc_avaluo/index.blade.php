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

           <h2>Lista de Calculo de Avaluos por RyB</h2><br/>

           <button class="btn btn-primary btn-lg rounded" type="button" data-toggle="modal" data-target="#abrirmodal">
                <i class="fa fa-plus"></i>&nbsp;&nbsp;Agregar Calculo Avaluo
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
            <table id="tablaCalculoAvaluo" class="table table-bordered table-striped dt-responsive nowrap" style="width: 100%">
                <thead>
                    <tr class="bg-dark text-light">
                        <th>RyB</th>
                        <th>Automatico</th>
                        <th>Importe</th>
                        <th>UTM</th>
                        <th>Fecha Desde</th>
                        <th>Fecha Hasta</th>
                        <th>Estado</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
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
                        <h4 class="modal-title">Agregar Cofiguracion Calculo Avaluo</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="text-light">×</span>
                        </button>
                    </div>
                    
                    <div class="modal-body">
                        <form action="{{route('config_calc_avaluo.store')}}" method="post" class="form-horizontal was-validated" enctype="multipart/form-data" >
                            {{csrf_field()}}
                            @include('Administracion.Avaluo.config_calc_avaluo.form')
                        </form>
                    </div>                            
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!--Fin del modal-->    
    <!-- Fin ejemplo de tabla Listado -->
    
    <div class="modal fade" id="editarCalculoAvaluo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dark modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Actualizar Cofiguracion Calculo Avaluo</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-light">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('config_calc_avaluo.update','test')}}" method="post" class="form-horizontal was-validated" enctype="multipart/form-data">
                        {{method_field('patch')}}
                        {{csrf_field()}}
                        <input type="hidden" id="calculo_avaluo_id" name="calculo_avaluo_id" value="">
                        @include('Administracion.Avaluo.config_calc_avaluo.form')
                    </form>
                </div>                            
            </div>
        </div>
    </div>

    <div class="modal fade" id="eliminarCalculoAvaluo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dark" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Eliminar Registro</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-light">×</span>
                    </button>
                </div>

            <div class="modal-body">
                <form action="{{route('config_calc_avaluo.destroy','test')}}" method="POST" class="was-validated">
                    {{method_field('delete')}}
                    {{csrf_field()}} 
                    <input type="hidden" id="calculo_avaluo_id" name="calculo_avaluo_id" value="">
                        <p>¿Está seguro que desea eliminarlo?</p>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success rounded">Confirmar</button>
                        <button type="button" class="btn btn-danger rounded" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
       $(document).ready(function () {


            olTable = $('#tablaCalculoAvaluo').DataTable({
                    "ajax":"tabla_calculo_avaluo",
                    "pageLength": 10,
                    "lengthMenu": [[1,5,10,25,50,100,-1], ['1','5','10','25','50','100','Todos']],                    
                    "deferRender": true,
                    "retrieve": true,
                    "processing": true,
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
                            {data: 'parcela_ryb'},
                            {data: 'automatico'},
                            {data: 'importe'},
                            {data: 'utm'},
                            {data: 'fecha_desde'},
                            {data: 'fecha_hasta'},
                            {data: 'parcela_estado'},
                            {data: 'edicion',"sortable": false },
                            {data: 'eliminar',"sortable": false }
                    ]                 
            });

            $("#buscarTexto").keyup(function() {
                olTable.search(this.value).draw();
            });
        });

        function cambio(valor){

            if(valor == 3){//deben ser requeridos

                for (let index = 0; index < document.getElementsByName("tipo_parcela_utm").length; index++) {
                    document.getElementsByName("tipo_parcela_utm")[index].required = true;
                }
                for (let index = 0; index < document.getElementsByName("utm_fecha_desde").length; index++) {
                    document.getElementsByName("utm_fecha_desde")[index].required = true;
                }
                for (let index = 0; index < document.getElementsByName("utm_fecha_hasta").length; index++) {
                    document.getElementsByName("utm_fecha_hasta")[index].required = true;
                }

                $(".valor_utm").collapse("show");

            }else{

                for (let index = 0; index < document.getElementsByName("tipo_parcela_utm").length; index++) {
                    document.getElementsByName("tipo_parcela_utm")[index].required = false;
                }
                for (let index = 0; index < document.getElementsByName("utm_fecha_desde").length; index++) {
                    document.getElementsByName("utm_fecha_desde")[index].required = false;
                }
                for (let index = 0; index < document.getElementsByName("utm_fecha_hasta").length; index++) {
                    document.getElementsByName("utm_fecha_hasta")[index].required = false;
                }

                $(".valor_utm").collapse("hide");

            }

        }

        $('#editarCalculoAvaluo').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) 
            var calculo_avaluo_id = button.data('calculo_avaluo_id')
            var tipo_parcela_estado_id = button.data('tipo_parcela_estado_id')
            var tipo_parcela_ryb_id = button.data('tipo_parcela_ryb_id')
            var calculo_avaluo_auto = button.data('calculo_avaluo_auto')
            var calculo_avaluo_imp = button.data('calculo_avaluo_imp')
            var tipo_parcela_utm = button.data('tipo_parcela_utm')
            var utm_fecha_desde = button.data('utm_fecha_desde')
            var utm_fecha_hasta = button.data('utm_fecha_hasta')
    
            var modal = $(this)
            modal.find('.modal-body #calculo_avaluo_id').val(calculo_avaluo_id);
            modal.find('.modal-body #tipo_parcela_estado_id').val(tipo_parcela_estado_id);
            modal.find('.modal-body #tipo_parcela_ryb_id').val(tipo_parcela_ryb_id);
            modal.find('.modal-body #calculo_avaluo_auto').val(calculo_avaluo_auto);
            modal.find('.modal-body #calculo_avaluo_imp').val(calculo_avaluo_imp);
            modal.find('.modal-body #tipo_parcela_utm').val(tipo_parcela_utm);
            modal.find('.modal-body #utm_fecha_desde').val(utm_fecha_desde);
            modal.find('.modal-body #utm_fecha_hasta').val(utm_fecha_hasta);

                
            if(calculo_avaluo_imp != 3){
                $(".valor_utm").collapse("hide")
            }else{
                $(".valor_utm").collapse("show")
            }
        })

        $('#eliminarCalculoAvaluo').on('show.bs.modal', function (event) {            
            var button = $(event.relatedTarget) 
            var calculo_avaluo_id = button.data('calculo_avaluo_id')
            var modal = $(this)            
            modal.find('.modal-body #calculo_avaluo_id').val(calculo_avaluo_id);
        });

    </script>
    @endpush
    @push('css')
    @endpush
@endsection