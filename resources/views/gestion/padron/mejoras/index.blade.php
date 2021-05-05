


    
    <div class="card">

        <div class="card-header">
            @if($bloqueo->usuario_id == Auth::user()->usuario_id)
            <button class="btn btn-primary btn-lg rounded  mt-2" type="button" data-toggle="modal" data-target="#abrirmodal">
                    <i class="fa fa-plus"></i>&nbsp;&nbsp;Agregar Mejora
                </button>
            @endif
        </div>

        <div class="card-body">
            <table id="tablaMejoras" class="table table-bordered table-striped dt-responsive nowrap" style="width: 100%" >
                <thead>
                    <tr class="bg-dark text-light">
                        <th>Expediente</th>
                        <th>Exp. Fecha</th>
                        <th>Uso</th>
                        <th>Tipo</th>
                        <th>Categoria</th>
                        <th>Superficie</th>
                        <th>Destino</th>
                        <th>Estado</th>
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
                        <h4 class="modal-title">Agregar Mejora</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="text-light">×</span>
                        </button>
                    </div>
                    
                    <div class="modal-body">
                        <form action="{{route('mejoras.store')}}" method="post" class="form-horizontal was-validated" enctype="multipart/form-data" >
                            {{csrf_field()}}
                            @include('gestion.padron.mejoras.form')
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
        <div class="modal fade" id="editarMejora" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dark modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Actualizar Mejora</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-light">×</span>
                    </button>
                </div>                           
                <div class="modal-body">                                 
                    <form action="{{route('mejoras.update','test')}}" method="post" class="form-horizontal was-validated" enctype="multipart/form-data">
                        {{method_field('patch')}}
                        {{csrf_field()}}
                        <input type="hidden" id="mejora_id" name="mejora_id" value="">
                        @include('gestion.padron.mejoras.form')
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!--Fin del modal-->
   
    <!--Inicio del modal baja-->
    <div class="modal fade" id="bajaMejora" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog  modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-catastro">
                        <h4 class="modal-title text-light">Baja Mejora</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="text-light">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="f-17">Confirma la Baja de esta Mejora?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" onclick="bajaMejora()">Confirmar</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!--Fin del modal-->

    <!--Inicio del modal alta-->
    <div class="modal fade" id="altaMejora" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog  modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-catastro">
                        <h4 class="modal-title text-light">Alta Mejora</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="text-light">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="f-17">Confirma la Alta de esta Mejora?</p>
                    </div>
                    <div class="modal-footer ">
                        <button type="button" class="btn btn-success" onclick="altaMejora()">Confirmar</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!--Fin del modal-->        


@push('scripts')
    <script>
        $('#abrirmodal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var tipo_estado_id = button.data('tipo_estado_id');
            var modal = $(this);
            if (typeof tipo_estado_id === 'undefined') {                
                modal.find('.modal-body #buttonAltaMejora').prop('hidden', true);
                modal.find('.modal-body #buttonBajaMejora').prop('hidden', true);
            }
            var idrol = parseInt($('.modal-body #idrol').val());
            if(idrol == 3){
                modal.find('.modal-body #buttonGuardarMejora').prop('hidden', true);
            }
            var bloquear = parseInt($('.modal-body #bloquear').val());
            if(idrol == 2 && bloquear == 1){//si es operador y esta en uso por otro usuario
                modal.find('.modal-body #buttonGuardarMejora').prop('hidden', true);
            }            
        });
        $('#editarMejora').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var parcela_id = button.data('parcela_id');
            var mejora_id = button.data('mejora_id');
            var tipo_mejora_id = button.data('tipo_mejora_id');
            var tipo_mejora_categoria_id = button.data('tipo_mejora_categoria_id');
            var tipo_mejora_destino_id = button.data('tipo_mejora_destino_id');
            var tipo_mejora_uso_id = button.data('tipo_mejora_uso_id');
            var mejora_nro_exp = button.data('mejora_nro_exp');
            var mejora_letra_exp = button.data('mejora_letra_exp');
            var mejora_fecha_exp = button.data('mejora_fecha_exp');
            var mejora_sup_cub = button.data('mejora_sup_cub');
            var mejora_sup_semi_cub = button.data('mejora_sup_semi_cub');
            var mejora_sup_comun_ph = button.data('mejora_sup_comun_ph');
            var mejora_porc_dominio = button.data('mejora_porc_dominio');
            var mejora_clandestina_id = button.data('mejora_clandestina_id');
            var tipo_exp_avaluo_id = button.data('tipo_exp_avaluo_id');
            var mejora_categoria_dpc = button.data('mejora_categoria_dpc');
            var mejora_valor = button.data('mejora_valor');
            var mejora_observacion = button.data('mejora_observacion');
            var tipo_estado_id = button.data('tipo_estado_id');
            var modal = $(this);
            var idrol = parseInt($('.modal-body #idrol').val());
            var bloquear = parseInt($('.modal-body #bloquear').val());
            modal.find('.modal-body #buttonBajaMejora').prop('hidden', true);
            modal.find('.modal-body #buttonAltaMejora').prop('hidden', true);
            if(idrol == 3){//si es consulta no puede guardar
                modal.find('.modal-body #buttonGuardarMejora').prop('hidden', true);
            }
            if(idrol == 2 && bloquear == 1){//ai es poerador y esta en uso por otro usuario
                modal.find('.modal-body #buttonGuardarMejora').prop('hidden', true);
            }
            if(tipo_estado_id == 2 && (idrol == 1 || idrol == 4)){//esta de baja y es administrador el usuario
                modal.find('.modal-body #buttonBajaMejora').prop('hidden', true);
                modal.find('.modal-body #buttonAltaMejora').prop('hidden', false);
                modal.find('.modal-body #buttonGuardarMejora').prop('hidden', true);                
            }else{
                if(tipo_estado_id == 1 && (idrol == 1 || idrol == 4)){//esta de alta y es administrador el usuario
                    modal.find('.modal-body #buttonBajaMejora').prop('hidden', false);
                    modal.find('.modal-body #buttonAltaMejora').prop('hidden', true);
                    modal.find('.modal-body #buttonGuardarMejora').prop('hidden', false);
                }
            }            
            modal.find('.modal-body #parcela_id').val(parcela_id);
            modal.find('.modal-body #mejora_id').val(mejora_id);
            modal.find('.modal-body #tipo_mejora_id').val(tipo_mejora_id);
            modal.find('.modal-body #tipo_mejora_categoria_id').val(tipo_mejora_categoria_id);
            modal.find('.modal-body #tipo_mejora_destino_id').val(tipo_mejora_destino_id);
            modal.find('.modal-body #tipo_mejora_uso_id').val(tipo_mejora_uso_id);                        
            modal.find('.modal-body #mejora_nro_exp').val(mejora_nro_exp);
            modal.find('.modal-body #mejora_letra_exp').val(mejora_letra_exp);
            modal.find('.modal-body #mejora_fecha_exp').val(mejora_fecha_exp);
            modal.find('.modal-body #mejora_sup_cub').val(mejora_sup_cub);
            modal.find('.modal-body #mejora_sup_semi_cub').val(mejora_sup_semi_cub);
            modal.find('.modal-body #mejora_sup_comun_ph').val(mejora_sup_comun_ph);
            modal.find('.modal-body #mejora_porc_dominio').val(mejora_porc_dominio);
            modal.find('.modal-body #mejora_clandestina_id').val(mejora_clandestina_id);
            modal.find('.modal-body #tipo_exp_avaluo_id').val(tipo_exp_avaluo_id);
            modal.find('.modal-body #mejora_categoria_dpc').val(mejora_categoria_dpc);
            modal.find('.modal-body #mejora_valor').val(mejora_valor);
            modal.find('.modal-body #mejora_observacion').val(mejora_observacion);
            modal.find('.modal-body #tipo_estado_id').val(tipo_estado_id);
            esPH(tipo_mejora_categoria_id);
        });
        /*FIN ventana modal para cambiar estado*/

        /*==========================
        ACTIVAR O DESACTIVAR LA COLOCACION DE M2 DE PH Y PORCENTAJE DE DOMINIO.
        ======================*/
        function esPH(valor){
            var tipo_mejora_categoria_id = parseInt(valor);
            if(!(tipo_mejora_categoria_id > 0)){ tipo_mejora_categoria_id = 0; }
            $.ajax({
                type: "GET",
                url: "{{url('consultarPH')}}",
                data: { parametro : tipo_mejora_categoria_id },
                success: function(response) {
                    if(response.ph){
                        $('.modal-body #mejora_sup_comun_ph').prop('disabled', false);
                        $('.modal-body #mejora_porc_dominio').prop('disabled', false);
                    }else{
                        $('.modal-body #mejora_sup_comun_ph').prop('disabled', true);
                        $('.modal-body #mejora_porc_dominio').prop('disabled', true);
                    }
                }
            });
        }
        
        /*==========================
        DAR DE BAJA LA MEJORA.
        ======================*/
        function bajaMejora(){
            var valor = parseInt($('.modal-body #mejora_id').val());
            $.ajax({
                type: "GET",
                url: "{{url('bajaMejora')}}",
                data: { mejora_id : valor, _token: $("meta[name='csrf-token']").attr("content") },
                success: function(response) {
                    console.log(response);
                    if(response.baja === 1){
                        document.location.reload(true);
                    }else{
                        Swal.fire({
                            position: 'center',
                            type: 'error',
                            title: 'Ocurrió un error',
                            showConfirmButton: false,
                            timer: 1800
                        })
                    }
                }
            });
        }

        /*==========================
        DAR DE BAJA LA MEJORA.
        ======================*/
        function altaMejora(){
            var valor = parseInt($('.modal-body #mejora_id').val());
            $.ajax({
                type: "GET",
                url: "{{url('altaMejora')}}",
                data: { mejora_id : valor, _token: $("meta[name='csrf-token']").attr("content") },
                success: function(response) {
                    if(response.alta === 1){
                        document.location.reload(true);
                    }else{
                        Swal.fire({
                            position: 'center',
                            type: 'error',
                            title: 'Ocurrió un error',
                            showConfirmButton: false,
                            timer: 1800
                        })
                    }
                }
            });
        }        

        $(document).ready(function () {
            
            olTable = $('#tablaMejoras').DataTable({
                "ajax":{
                    url:"tabla_mejoras",
                    data:{"parcela_id":{{$parcela->parcela_id}}}
                },
                "deferRender": true,
                "retrieve": true,
                "processing": true,
                "language": {

                    "sProcessing":     "Procesando...",
                    "sLengthMenu":     "Mostrar _MENU_ registros",
                    "sZeroRecords":    "No se encontraron resultados",
                    "sEmptyTable":     "<font color='red'><b>SIN DATOS DE MEJORAS PARA ESTE PADRON</b></font>",
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
                
                    {data: 'expediente'},
                    {data: 'fecha'},
                    {data: 'tipo_mejora_uso_descrip'},
                    {data: 'tipo'},
                    {data: 'categoria'},
                    {data: 'mejora_sup_cub'},
                    {data: 'destino'},
                    {data: 'estado'},
                    {data: 'editar',"sortable": false },
                ]
            });
        });

    </script>
@endpush