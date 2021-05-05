@extends('principal')
@section('breadcrumb')
    {{ Breadcrumbs::render('tipo_de_profesional') }}
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

           <h2>Tipos de Profesionales</h2><br/>

           <button class="btn btn-primary btn-lg rounded" type="button" data-toggle="modal" data-target="#abrirmodal">
                <i class="fa fa-plus"></i>&nbsp;&nbsp;Agregar Tipo de Profesional
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
            <table id="tablaTiposProfesionales" class="table table-bordered table-striped table-sm table-responsive">
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
                                <h4 class="modal-title">Agregar Tipo de Profesional</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true" class="text-light">×</span>
                                </button>
                            </div>
                           
                            <div class="modal-body">
                                 
    
                                <form action="{{route('tipo_de_profesional.store')}}" method="post" class="form-horizontal was-validated" enctype="multipart/form-data" >
                                   
                                    {{csrf_field()}}
                                    
                                    @include('Administracion.Parcelas.tipo_de_profesional.form')
    
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
                 <div class="modal fade" id="editarTipoProfesional" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-dark modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Actualizar Profesional</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true" class="text-light">×</span>
                                </button>
                            </div>
                           
                            <div class="modal-body">
                                 
                                <form action="{{route('tipo_de_profesional.update','test')}}" method="post" class="form-horizontal was-validated" enctype="multipart/form-data">
                                    
                                    {{method_field('patch')}}
                                    {{csrf_field()}}
    
                                    <input type="hidden" id="tipo_profesional_id" name="tipo_profesional_id" value="">
                                    
                                    @include('Administracion.Parcelas.tipo_de_profesional.form')
                                    
    
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

    olTable = $('#tablaTiposProfesionales').DataTable({
        "ajax":"tabla_tipo_de_profesional",
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
        
            {data: 'tipo_profesional_descrip'},
            {data: 'tipo_profesional_abrev'},
            {data: 'accion',"searchable": false }
        ]
});

    $("#buscarTexto").keyup(function() {
        olTable.search(this.value).draw();
    });    

});



        /*INICIO ventana modal para cambiar el estado*/
                
        $('#editarTipoProfesional').on('show.bs.modal', function (event) {

            //console.log('modal abierto');

            var button = $(event.relatedTarget) 
            var tipo_profesional_id = button.data('tipo_profesional_id')
            var tipo_profesional_descrip = button.data('tipo_profesional_descrip')
            var tipo_profesional_abrev = button.data('tipo_profesional_abrev')
            var modal = $(this)
            // modal.find('.modal-title').text('New message to ' + recipient)

            modal.find('.modal-body #tipo_profesional_id').val(tipo_profesional_id);
            modal.find('.modal-body #tipo_profesional_descrip').val(tipo_profesional_descrip);
            modal.find('.modal-body #tipo_profesional_abrev').val(tipo_profesional_abrev);

        })
        
        /*FIN ventana modal para cambiar estado*/


    </script>
   
   

   @endpush

   @push('css')

   

   @endpush
@endsection