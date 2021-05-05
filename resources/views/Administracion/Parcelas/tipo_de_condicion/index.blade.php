@extends('principal')
@section('breadcrumb')
    {{ Breadcrumbs::render('tipo_de_condicion') }}
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

           <h2>Tipos de Condiciones</h2><br/>

           <button class="btn btn-primary btn-lg rounded" type="button" data-toggle="modal" data-target="#abrirmodal">
                <i class="fa fa-plus"></i>&nbsp;&nbsp;Agregar Tipo de Condición
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
            <table id="tablaTiposCondiciones" class="table table-bordered table-striped dt-responsive nowrap" style="width: 100%">
                <thead>
                    <tr class="bg-dark text-light">
                       
                        <th>Descripción</th>
                        <th>Abreviatura</th>
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
                                <h4 class="modal-title">Agregar Tipo de Condición</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true" class="text-light">×</span>
                                </button>
                            </div>
                           
                            <div class="modal-body">
                                 
    
                                <form action="{{route('tipo_de_condicion.store')}}" method="post" class="form-horizontal was-validated" enctype="multipart/form-data" >
                                   
                                    {{csrf_field()}}
                                    
                                    @include('Administracion.Parcelas.tipo_de_condicion.form')
    
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
                 <div class="modal fade" id="editarTipoCondicion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-dark modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Actualizar Condición</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true" class="text-light">×</span>
                                </button>
                            </div>
                           
                            <div class="modal-body">
                                 
                                <form action="{{route('tipo_de_condicion.update','test')}}" method="post" class="form-horizontal was-validated" enctype="multipart/form-data">
                                    
                                    {{method_field('patch')}}
                                    {{csrf_field()}}
    
                                    <input type="hidden" id="tipo_condicion_id" name="tipo_condicion_id" value="">
                                    
                                    @include('Administracion.Parcelas.tipo_de_condicion.form')
                                    
    
                                </form>
                            </div>
                            
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!--Fin del modal-->

                  <!-- Inicio del modal Cambiar Estado del usuario -->
             <div class="modal fade" id="cambiarEstadoCondicion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-dark" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Cambiar estado de la condición</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true" class="text-light">×</span>
                            </button>
                        </div>

                    <div class="modal-body">
                        <form action="{{route('tipo_de_condicion.destroy','test')}}" method="POST" class="was-validated">
                         {{method_field('delete')}}
                         {{csrf_field()}} 

                            <input type="hidden" id="tipo_condicion_id_estado" name="id_condicion" value="">

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



</div>

@push('scripts')
<script>

$(document).ready(function () {

    olTable = $('#tablaTiposCondiciones').DataTable({
        "ajax":"tabla_tipo_de_condicion",
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
        
            {data: 'tipo_condicion_descrip'},
            {data: 'tipo_condicion_abrev'},
            {data: 'accion',"searchable": false }
        ]
});

    $("#buscarTexto").keyup(function() {
        olTable.search(this.value).draw();
    });    

});
            
    $('#editarTipoCondicion').on('show.bs.modal', function (event) {

        //console.log('modal abierto');

        var button = $(event.relatedTarget) 
        var tipo_condicion_id = button.data('tipo_condicion_id')
        var tipo_condicion_descrip = button.data('tipo_condicion_descrip')
        var tipo_condicion_abrev = button.data('tipo_condicion_abrev')
        var modal = $(this)
        // modal.find('.modal-title').text('New message to ' + recipient)

        modal.find('.modal-body #tipo_condicion_id').val(tipo_condicion_id);
        modal.find('.modal-body #tipo_condicion_descrip').val(tipo_condicion_descrip);
        modal.find('.modal-body #tipo_condicion_abrev').val(tipo_condicion_abrev);

    })

    $('#cambiarEstadoCondicion').on('show.bs.modal', function (event) {
        
        //console.log('modal abierto');
        
        var button = $(event.relatedTarget) 
        var id_condicion = button.data('id_condicion')
        var modal = $(this)
        // modal.find('.modal-title').text('New message to ' + recipient)
        
        modal.find('.modal-body #tipo_condicion_id_estado').val(id_condicion);
    })
        





    </script>
   
   

   @endpush

   @push('css')

   

   @endpush
@endsection