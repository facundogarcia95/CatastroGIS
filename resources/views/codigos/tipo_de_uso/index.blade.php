@extends('principal')
@section('breadcrumb')
    {{ Breadcrumbs::render('tipo_de_uso') }}
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

           <h2>Gestion de Usos de Mejoras</h2><br/>

           <button class="btn btn-primary btn-lg rounded" type="button" data-toggle="modal" data-target="#abrirmodal">
                <i class="fa fa-plus"></i>&nbsp;&nbsp;Agregar Uso de Mejora
            </button>
            
        </div>
        <div class="card-body">
            <table id="tablaMejorasUsos" class="table table-bordered table-striped dt-responsive nowrap" style="width: 100%" >
                <thead>
                    <tr class="bg-dark text-light">
                        <th> Código </th>
                         <th> Descripcion </th>
                         <th> Visible </th>
                        <th> Editar </th>
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
                                <h4 class="modal-title">Agregar Uso de Mejora</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true" class="text-light">×</span>
                                </button>
                            </div>
                           
                            <div class="modal-body">
                                <form action="{{route('tipo_de_uso.store')}}" method="post" class="form-horizontal was-validated" enctype="multipart/form-data" >
                                    {{csrf_field()}}
                                    @include('codigos.tipo_de_uso.form')
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
                 <div class="modal fade" id="editarMejoraUso" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-dark modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Actualizar Uso de Mejora</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true" class="text-light">×</span>
                                </button>
                            </div>                           
                            <div class="modal-body">                                 
                                <form action="{{route('tipo_de_uso.update','test')}}" method="post" class="form-horizontal was-validated" enctype="multipart/form-data">
                                    {{method_field('patch')}}
                                    {{csrf_field()}}
                                    <input type="hidden" id="tipo_mejora_uso_id" name="tipo_mejora_uso_id" value="">                            
                                    @include('codigos.tipo_de_uso.form')
                                </form>
                            </div>                            
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!--Fin del modal-->


                <div class="modal fade" id="cambiarEstado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-dark" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Cambiar estado</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true" class="text-light">×</span>
                                </button>
                            </div>
    
                        <div class="modal-body">
                            <form action="{{route('tipo_de_uso.destroy','test')}}" method="POST" class="was-validated">
                             {{method_field('delete')}}
                             {{csrf_field()}} 
    
                                <input type="hidden" id="id" name="id" value="">
    
                                    <p>¿Está seguro que desea cambiar el estado?</p>
            
    
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success rounded">Aceptar</button>
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

        olTable = $('#tablaMejorasUsos').DataTable({
                "ajax":"tabla_tipos_uso",
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
                       
                        {data: 'tipo_mejora_uso_codigo'},
                        {data: 'tipo_mejora_uso_descrip'},
                        {data: 'condicion'},
                        {data: 'accion',"searchable": false }
                    ]
        });

        $("#buscarTexto").keyup(function() {
            olTable.search(this.value).draw();
        });    
   
});


                
        $('#editarMejoraUso').on('show.bs.modal', function (event) {
            //console.log('modal abierto');
            var button = $(event.relatedTarget) 
            var tipo_mejora_uso_id = button.data('tipo_mejora_uso_id')
            var tipo_mejora_uso_codigo = button.data('tipo_mejora_uso_codigo')
            var tipo_mejora_uso_descrip = button.data('tipo_mejora_uso_descrip')
            var tipo_estado_id = button.data('tipo_estado_id')
            var modal = $(this)
            // modal.find('.modal-title').text('New message to ' + recipient)

            modal.find('.modal-body #tipo_mejora_uso_id').val(tipo_mejora_uso_id);
            modal.find('.modal-body #tipo_mejora_uso_codigo').val(tipo_mejora_uso_codigo);
            modal.find('.modal-body #tipo_mejora_uso_descrip').val(tipo_mejora_uso_descrip);
            modal.find('.modal-body #tipo_estado_id').val(tipo_estado_id);
        })        


        $('#cambiarEstado').on('show.bs.modal', function (event) {
        
            //console.log('modal abierto');
            
            var button = $(event.relatedTarget) 
            var id = button.data('id')
            var modal = $(this)
            // modal.find('.modal-title').text('New message to ' + recipient)
            
            modal.find('.modal-body #id').val(id);

        })
        
    </script>




@endpush

@push('css')



@endpush
@endsection