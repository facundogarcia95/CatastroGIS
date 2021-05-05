

    
    <div class="card">

        <div class="card-header">
        
            @if($bloqueo->usuario_id == Auth::user()->usuario_id) 
            <button class="btn btn-primary btn-lg rounded mt-2" type="button" data-toggle="modal" data-target="#abrirAgregarTitular">
                    <i class="fa fa-plus"></i>&nbsp;&nbsp;Agregar Relación
                </button>
            @endif
            
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
            <table id="tablaTipoDocumento" class="table table-bordered table-striped table-sm table-responsive">
                <thead>
                    <tr class="bg-dark text-light">
                       
                        <th>Figura</th>
                        <th>Tipo Persona</th>
                        <th>Denominación</th>
                        <th>Documento</th>
                        <th>CUIT/CUIL</th>
                        <th>Principal</th>
                        <th>Estado</th>
                        <th>Editar</th>
                    </tr>
                </thead>
                <tbody>
                    @isset($personas_parcelas)
                    @foreach($personas_parcelas as $persona_parcela)
                     <tr>
                         <td>{{$persona_parcela->tipo_persona_parcela_descrip}}</td>
                         <td>{{$persona_parcela->tipo_persona_descrip}}</td>
                         <td>{{$persona_parcela->persona_denominacion}}</td>
                         <td>{{$persona_parcela->persona_nro_doc}}</td>
                         <td>{{$persona_parcela->persona_cuit}}</td>
                         <td> 
                             @if ($persona_parcela->persona_parcela_ppal == 1)
                                <span style="color:#eb881e">Si</span>
                            @else
                                <span style="">No</span>
                            @endif                             
                        </td>
                         <td>@if ($persona_parcela->tipo_estado_id == 1)
                            <label class="text-success"><i class="fa fa-check "></i> {{$persona_parcela->tipo_estado_descrip}}</label> 
                            @else
                            <label class="text-danger"><i class="fa fa-times"></i> {{$persona_parcela->tipo_estado_descrip}}</label>
                            @endif</td>
                         <td>
                            @if($bloqueo->usuario_id != Auth::user()->usuario_id) 
                                <button type="button" class="btn btn-danger btn-md rounded pull-right" disabled><i class="fa fa-times"></i> Bloqueado</button> 
                            @else
                             <button type="button" class="btn btn-warning rounded text-light btn-sm" 
                                data-persona_parcela_id="{{$persona_parcela->persona_parcela_id}}"
                                data-persona_id="{{$persona_parcela->persona_id}}"
                                data-persona_denominacion="{{$persona_parcela->persona_denominacion}}"
                                data-tipo_persona_parcela_id="{{$persona_parcela->tipo_persona_parcela_id}}"
                                data-tipo_condicion_id="{{$persona_parcela->tipo_condicion_id}}"
                                data-tipo_instrumento_id="{{$persona_parcela->tipo_instrumento_id}}"
                                data-persona_parcela_dominio="{{$persona_parcela->persona_parcela_dominio}}"
                                data-persona_parcela_num_int="{{$persona_parcela->persona_parcela_num_int}}"
                                data-persona_parcela_ppal="{{$persona_parcela->persona_parcela_ppal}}"
                                data-persona_parcela_origen="{{$persona_parcela->persona_parcela_origen}}"
                                data-tipo_estado_id="{{$persona_parcela->tipo_estado_id}}"
                                data-toggle="modal" 
                                data-target="#editarTitular">
                                     <i class="fa fa-edit fa-2x"></i> Editar
                             </button> 
                             @endif
                         </td>                     
                     </tr>
                     @endforeach   
                     @endisset                
                 </tbody>
            </table>
                

         
        </div>
    </div>


    <!-- Fin ejemplo de tabla Listado -->


                   <!--Inicio del modal agregar-->
                   <div class="modal fade" style="overflow-y: auto !important;" id="abrirAgregarTitular" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-dark modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Agregar</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true" class="text-light">×</span>
                                </button>
                            </div>
                           
                            <div class="modal-body">
                                <form id="formularioAgregarTitular" action="{{route('personas_parcelas.store')}}" method="post" class="form-horizontal was-validated" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <input type="hidden" id="persona_parcela_id" name="persona_parcela_id" value="">                            
                                    <input type="hidden" name="parcela_id" value="{{$parcela->parcela_id}}">                            
                                    @include('gestion.padron.dominio.form')
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
                 <div style="overflow-y: auto !important; display: none;" class="modal fade" id="editarTitular" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dark modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Actualizar</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true" class="text-light">×</span>
                                </button>
                            </div>
                           
                            <div class="modal-body">
                                <form action="{{route('personas_parcelas.update','test')}}" method="post" class="form-horizontal was-validated" enctype="multipart/form-data">
                                    {{method_field('patch')}}
                                    {{csrf_field()}}
                                    <input type="hidden" id="persona_parcela_id" name="persona_parcela_id" value="">                            
                                    <input type="hidden" name="parcela_id" value="{{$parcela->parcela_id}}"> 
                                    @include('gestion.padron.dominio.form')
                                </form>
                            </div>
                            
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!--Fin del modal-->   

                 <!--Inicio del modal buscar titular-->
                 <div class="modal fade" id="buscarTitular" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-dark modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Buscar</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true" class="text-light">×</span>
                                </button>
                            </div>
                           
                            <div class="modal-body">
                                    <input type="hidden" id="persona_parcela_id" name="persona_parcela_id" value="">                            
                                    @php
                                        session(['asignar'=>true]);
                                    @endphp
                                    <iframe src="{{url('grillaPersonas')}}" class="w-100 " style="height: 60vh;">
                                    </iframe>
                            </div>
                            
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!--Fin del modal-->





@push('scripts')
    <script>

$(document).ready(function () {

        /*INICIO ventana modal para cambiar el estado*/
                
        $('#editarTitular').on('show.bs.modal', function (event) {

            //console.log('modal abierto');

            var button = $(event.relatedTarget) 
            var persona_parcela_id = button.data('persona_parcela_id')
            var persona_id = button.data('persona_id')
            var parcela_id = button.data('parcela_id')
            var persona_denominacion = button.data('persona_denominacion')
            var tipo_persona_parcela_id = button.data('tipo_persona_parcela_id')
            var persona_parcela_ppal = button.data('persona_parcela_ppal')
            var persona_parcela_origen = button.data('persona_parcela_origen')
            var tipo_condicion_id = button.data('tipo_condicion_id')
            var tipo_instrumento_id = button.data('tipo_instrumento_id')
            var persona_parcela_dominio = button.data('persona_parcela_dominio')
            var persona_parcela_num_int = button.data('persona_parcela_num_int')
            var tipo_estado_id = button.data('tipo_estado_id')
            var modal = $(this)
            // modal.find('.modal-title').text('New message to ' + recipient)
            modal.find('.modal-body #persona_parcela_id').val(persona_parcela_id);
            modal.find('.modal-body #persona_id').val(persona_id);
            modal.find('.modal-body #parcela_id').val(parcela_id);
            modal.find('.modal-body #persona_denominacion').text(persona_denominacion);
            modal.find('.modal-body #tipo_persona_parcela_id').val(tipo_persona_parcela_id);
            // Cambio el 1 por el true del checkbox
            /*if(persona_parcela_ppal == 1){
                modal.find('.modal-body #persona_parcela_ppal').val(true);
            }else{
                modal.find('.modal-body #persona_parcela_ppal').val(false);
            }*/
            modal.find('.modal-body #persona_parcela_origen').val(persona_parcela_origen);
            modal.find('.modal-body #tipo_condicion_id').val(tipo_condicion_id);
            modal.find('.modal-body #tipo_instrumento_id').val(tipo_instrumento_id);
            modal.find('.modal-body #persona_parcela_dominio').val(persona_parcela_dominio);
            modal.find('.modal-body #persona_parcela_num_int').val(persona_parcela_num_int);
            modal.find('.modal-body #tipo_estado_id').val(tipo_estado_id);

        })
        
        /*FIN ventana modal para cambiar estado*/
        
        
        /*INICIO ventana modal para agregar titular*/
                
        $('#abrirAgregarTitular').on('show.bs.modal', function (event) {

            //console.log('modal abierto');

            var button = $(event.relatedTarget) 
            var persona_parcela_id = button.data('persona_parcela_id')
            var persona_id = button.data('persona_id')
            var parcela_id = button.data('parcela_id')
            var persona_denominacion = button.data('persona_denominacion')
            var tipo_persona_parcela_id = button.data('tipo_persona_parcela_id')
            var persona_parcela_ppal = button.data('persona_parcela_ppal')
            var persona_parcela_origen = button.data('persona_parcela_origen')
            var tipo_condicion_id = button.data('tipo_condicion_id')
            var tipo_instrumento_id = button.data('tipo_instrumento_id')
            var persona_parcela_dominio = button.data('persona_parcela_dominio')
            var persona_parcela_num_int = button.data('persona_parcela_num_int')
            var tipo_estado_id = button.data('tipo_estado_id')
            var modal = $(this)
            // modal.find('.modal-title').text('New message to ' + recipient)
            modal.find('.modal-body #persona_parcela_id').val(persona_parcela_id);
            modal.find('.modal-body #persona_id').val(persona_id);
            modal.find('.modal-body #parcela_id').val(parcela_id);
            modal.find('.modal-body #persona_denominacion').text(persona_denominacion);
            modal.find('.modal-body #tipo_persona_parcela_id').val(tipo_persona_parcela_id);
            modal.find('.modal-body #persona_parcela_origen').val(persona_parcela_origen);
            modal.find('.modal-body #tipo_condicion_id').val(tipo_condicion_id);
            modal.find('.modal-body #tipo_instrumento_id').val(tipo_instrumento_id);
            modal.find('.modal-body #persona_parcela_dominio').val(persona_parcela_dominio);
            modal.find('.modal-body #persona_parcela_num_int').val(persona_parcela_num_int);
            modal.find('.modal-body #tipo_estado_id').val(tipo_estado_id);

        })
        
        /*FIN ventana modal para cambiar estado*/

        /*INICIO modal buscar personas */
                        
        $('#buscarTitular').on('show.bs.modal', function (event) {

        //console.log('modal abierto');

        var button = $(event.relatedTarget) 
        var modal = $(this)
        // modal.find('.modal-title').text('New message to ' + recipient)

        })


        /*FIN ventana modal para cambiar estado*/


        $("#formularioAgregarTitular").submit(function(e){ 
                    e.preventDefault();
                    if($(this).find('#persona_id').val()){
                        $('#formularioAgregarTitular')[0].submit();
                    }else{
                        $(".valid-persona").removeClass("d-none");
                        $(".valid-persona").addClass("d-block");
                    }
            });



        // Si es unico, dejo el porcentaje de dominio en 100%
        $( "#tipo_condicion_id" ).change(function() {
            if($( "#tipo_condicion_id" ).val() == 1){
                $( "#persona_parcela_dominio" ).val(100);
            }
        });

        let   aviso_ppal = 0;

        $(document).on("click.bs.toggle", "div[data-toggle^=toggle]", function (t) {

                if($(this).find("input[type=checkbox]").prop("checked")){

                    $(".persona_parcela_ppal_hidden").attr("value",1);

                    if(aviso_ppal == 0){
                        Swal.fire({
                            title: 'Información',
                            text: 'Esta acción dejará únicamente a este titular como titular principal del registro',
                            type: 'warning',
                            confirmButtonText: 'Aceptar',
                            confirmButtonColor: '#20A8D8'
                        })
                        aviso_ppal++;
                    }
                }else{
                    $(".persona_parcela_ppal_hidden").attr("value",0);
                }
        })

});
    </script>
    <script src="{{asset('js/librerias/toggle.js')}}"></script>
    

    @endpush

    @push('css')
            <link href="{{asset('css/librerias/toggle.css')}}" rel="stylesheet"/>
    @endpush
