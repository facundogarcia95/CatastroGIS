

    
    <div class="card">
        <div class="card-body">
            <table id="tablaOrigen" class="table table-bordered table-striped table-sm table-responsive">
                <thead>
                    <tr class="bg-dark text-light">
                        <th colspan="4" class="bg-catastro">Origen ({{count($origen)}}) @if(Auth::user()->idrol != 1 && Auth::user()->idrol != 4 ) @else @if($bloqueo->usuario_id == Auth::user()->usuario_id && $tempUnionDesglose == null)<i class="fa fa-plus text-light m-2 pull-right fa-2x pointer agregar_origen" data-toggle="modal" data-target="#modalSeleccionarOrigen" ></i> @elseif($tempUnionDesglose != null && $tempUnionDesglose->usuario_id == Auth::user()->usuario_id) <i class="fa fa-plus text-light m-2 pull-right fa-2x pointer agregar_origen" data-toggle="modal" data-target="#modalSeleccionarOrigen" ></i> @endif @endif @isset($origen[0]) @if($origen[0]->tipo_parcela_alta_desc) <br>  Tipo de Origen: {{$origen[0]->tipo_parcela_alta_desc}} @endif @endisset</th>
                    </tr>
                    <tr class="bg-dark text-light">
                        <th>Padrón</th>
                        <th>Nomenclatura</th>
                        <th>Estado</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($origen as $orig)
                    <tr>
                        <td><a href="./{{$orig->parcela_id}}">{{$orig->parcela_padron}}</a></td>
                        <td>{{$orig->parcela_nomenclatura}}</td>
                        <td>{{$orig->tipo_parcela_estado_descrip}}  </td>
                        <td class="text-center">
                            @if($tempUnionDesglose != null && $tempUnionDesglose->usuario_id != Auth::user()->usuario_id || Auth::user()->idrol == 3)
                                <i class="fa fa-lock fa-2x text-danger"></i>
                            @else
                                <form  action="{{url('quitarUnion')}}" method="POST" class="was-validated">
                                    <a href="#" class="link-origenDestino"><i class="fa fa-times text-danger fa-2x "></i></a>
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="origen" value="{{$orig->parcela_id}}">
                                    <input type="hidden" name="parcela" value="{{$parcela->parcela_id}}">
                                </form>
                            @endif
                        </td>              
                    </tr>
                    @endforeach       
                 </tbody>
            </table>
            <br>
            <table id="tablaDestino" class="table table-bordered table-striped table-sm table-responsive">
                <thead>
                    <tr class="bg-dark text-light">
                        <th colspan="4" class="bg-catastro">Destino ({{count($destino)}}) @if(($origen->count() > 0 && $origen[0]->ph == 1) || $tempUnionDesglose != null) @else @if($bloqueo->usuario_id == Auth::user()->usuario_id && (Auth::user()->idrol == 1 || Auth::user()->idrol == 4 ) && $tempUnionDesglose == null)<i class="fa fa-plus text-light m-2 pull-right fa-2x pointer agregar_destino" data-toggle="modal" data-target="#modalSeleccionarDestino" ></i>@endif @endif</th>
                    </tr>
                    <tr class="bg-dark text-light">                       
                        <th>Padrón</th>
                        <th>Nomenclatura</th>
                        <th>Estado</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($destino as $dest) 
                     <tr>
                         <td><a href="./{{$dest->parcela_dest_id}}">{{$dest->parcela_padron}}</a></td>
                         <td>{{$dest->parcela_nomenclatura}}</td>
                         <td>{{$dest->tipo_parcela_estado_descrip}}</td>
                         <td class="text-center">
                            @if($tempUnionDesglose != null && $tempUnionDesglose->usuario_id != Auth::user()->usuario_id || Auth::user()->idrol == 3)
                                <i class="fa fa-lock fa-2x text-danger"></i>
                            @else
                            <form action="{{url('quitarDestino')}}" method="POST" class="was-validated">
                                <a href="#" class="link-origenDestino"><i class="fa fa-times text-danger fa-2x "></i></a>
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="parcela" value="{{$parcela->parcela_id}}">
                                <input type="hidden" name="destino" value="{{$dest->parcela_dest_id}}">
                            </form>
                            @endif
                        </td>              
                     </tr>
                     @endforeach                   
                 </tbody>
            </table>                
        </div>
    </div>

    @if(Auth::user()->idrol == 1 || Auth::user()->idrol == 4 )
    <div class="modal fade" id="modalSeleccionarOrigen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dark modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Seleccionar Nomenclatura Origen</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-light">×</span>
                    </button>
                </div>
                
                <form action="{{url('agregarUnion')}}" method="POST" id="agregarUnionForm" class="was-validated">
                    <div class="modal-body">
                        @csrf
                        @method('patch')
                        
                        <div class="row">
                            <div class="col-sm-12 col-md-6 ">
                                <div class="input-group">
                                    <div class="input-group-addon bg-secondary font-weight-bold">
                                        Nomenclatura:
                                    </div>
                                    <input id="nomenclatura_origen" type="text" class="form-control font-weight-bold f-16"  maxlength="21"  value="">
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 ">
                                <div class="input-group">
                                    <div class="input-group-addon bg-secondary font-weight-bold">
                                        Padrón:
                                    </div>
                                    <input id="padron_origen" type="text" class="form-control font-weight-bold f-16"  maxlength="21"  value="">
                                </div>
                            </div>
                        </div>

                        <div class="collapse mt-2" id="collapseOrigen">
                            <div class="row">
                                
                                <input type="hidden" class="parcela_id" name="parcela_origen_id" value="">
                                <input type="hidden" name="parcela_id" value="{{$parcela->parcela_id}}">

                                <div class="col-sm-12 col-md-6 ">
                                    <div class="input-group-addon font-weight-bold">
                                        Padron:
                                    </div>
                                    <label class="form-control padron_union"></label>
                                </div>
                                <div class="col-sm-12 col-md-6 ">
                                    <div class="input-group-addon font-weight-bold">
                                        Estado:
                                    </div>
                                    <label class="form-control estado_union"></label>
                                </div>

                                <div class="col-sm-12 ">
                                    <div class="input-group-addon font-weight-bold">
                                        Destino:
                                    </div>
                                    <label class="form-control destino_union"></label>
                                </div>
                            </div>
                        </div> 
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success btn-agregar-union" disabled>Agregar</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modalSeleccionarDestino" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dark modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Seleccionar Nomenclatura Destino</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-light">×</span>
                    </button>
                </div>
                
                <form action="{{url('agregarDestino')}}" method="POST" id="agregarDestinoForm" class="was-validated">
                    <div class="modal-body">
                        @csrf
                        @method('patch')
                            
                        <div class="row">
                            <div class="col-sm-12 col-md-6 ">
                                <div class="input-group">
                                    <div class="input-group-addon bg-secondary font-weight-bold">
                                        Nomenclatura:
                                    </div>
                                    <input id="nomenclatura_destino" type="text" class="form-control font-weight-bold f-16" maxlength="21"  value="">
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 ">
                                <div class="input-group">
                                    <div class="input-group-addon bg-secondary font-weight-bold">
                                        Padrón:
                                    </div>
                                    <input id="padron_destino" type="text" class="form-control font-weight-bold f-16" maxlength="21"  value="">
                                </div>
                            </div>
                        </div>

                        <div class="collapse mt-2" id="collapseDestino">
                            <div class="row">
                                <input type="hidden" class="parcela_id" name="parcela_destino_id" value="">
                                <input type="hidden" name="parcela_id" value="{{$parcela->parcela_id}}">
                                <div class="col-sm-12 col-md-6 ">
                                    <div class="input-group-addon font-weight-bold">
                                        Padron:
                                    </div>
                                    <label class="form-control padron_destino"></label>
                                </div>
                                <div class="col-sm-12 col-md-6 ">
                                    <div class="input-group-addon font-weight-bold">
                                        Estado:
                                    </div>
                                    <label class="form-control estado_destino"></label>
                                </div>

                                <div class="col-sm-12 ">
                                    <div class="input-group-addon font-weight-bold">
                                        Clasificación:
                                    </div>
                                    <label class="form-control clasificacion_destino"></label>
                                </div>
                            </div>
                        </div> 
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success btn-agregar-desglose" disabled>Agregar</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif

    @push('scripts')
        <script>
        $(document).ready(function () {

            var listado = false;

            @if(Auth::user()->idrol == 1 || Auth::user()->idrol == 4 )

                $.ajax({
                    type: "GET",
                    url: URLBASE+"listadoNomenclaturasOrigen",
                    data: "",
                    success: function (response) {
                        
                        listado = true;
                        $("#nomenclatura_origen").attr("placeholder","Listado Completado");

                        $("#nomenclatura_origen").autocomplete({ 
                                autoFocus: false,
                                minLength: 8,
                                source: response.parcelas,
                                open: function() {
                                    setTimeout(function() {
                                        $('.ui-autocomplete').css('z-index', 9999);
                                    }, 0);
                                    $(".ui-helper-hidden-accessible").css("display", "none");
                                },
                                select: function(event, ui) {
                                    console.log(ui.item)
                                    $(".parcela_id").val(ui.item.parcela_id);
                                    $(".padron_union").text(ui.item.parcela_padron);
                                    $(".estado_union").text(ui.item.tipo_estado_descrip);
                                    $(".destino_union").text(ui.item.tipo_parcela_ryb_descrip);
                                    $("#collapseOrigen").collapse('show');
                                    $(".btn-agregar-union").removeAttr("disabled")
                                }
                            });  

                    },error: function (response) {
                            console.log(response.responseText);
                    }
                });

                $.ajax({
                    type: "GET",
                    url: URLBASE+"listadoPadronesOrigen",
                    data: "",
                    success: function (response) {
                        
                        listado = true;

                        $("#padron_origen").attr("placeholder","Listado completado");

                        $("#padron_origen").autocomplete({ 
                                autoFocus: false,
                                minLength: 2,
                                source: response.parcelas,
                                open: function() {
                                    setTimeout(function() {
                                        $('.ui-autocomplete').css('z-index', 9999);
                                    }, 0);
                                    $(".ui-helper-hidden-accessible").css("display", "none");
                                },
                                select: function(event, ui) {
                                   
                                    $(".parcela_id").val(ui.item.parcela_id);
                                    $("#nomenclatura_origen").val(ui.item.parcela_nomenclatura);    
                                    $(".padron_union").text(ui.item.parcela_padron);
                                    $(".estado_union").text(ui.item.tipo_estado_descrip);
                                    $(".destino_union").text(ui.item.tipo_parcela_ryb_descrip);
                                    $("#collapseOrigen").collapse('show');
                                    $(".btn-agregar-union").removeAttr("disabled")

                                }
                            });  

                    },error: function (response) {
                            console.log(response.responseText);
                    }
                });

            //===========================================================
            
                $.ajax({
                    type: "GET",
                    url: URLBASE+"listadoPadronesDestino",
                    data: "",
                    success: function (response) {

                        listado = true;
                        $("#padron_destino").attr("placeholder","Listado completado");

                        $("#padron_destino").autocomplete({ 
                                autoFocus: false,
                                minLength: 2,
                                source: response.parcelas,
                                open: function() {
                                    setTimeout(function() {
                                        $('.ui-autocomplete').css('z-index', 9999);
                                    }, 0);
                                    $(".ui-helper-hidden-accessible").css("display", "none");
                                },
                                select: function(event, ui) {

                                    $(".parcela_id").val(ui.item.parcela_id);
                                    $("#nomenclatura_destino").val(ui.item.parcela_nomenclatura);    
                                    $(".padron_destino").text(ui.item.parcela_padron);
                                    $(".estado_destino").text(ui.item.tipo_estado_descrip);
                                    $(".clasificacion_destino").text(ui.item.tipo_parcela_ryb_descrip);
                                    $("#collapseDestino").collapse('show');
                                    $(".btn-agregar-desglose").removeAttr("disabled")

                                }
                            });  

                    },error: function (response) {
                            console.log(response.responseText);
                    }
                });

                $.ajax({
                    type: "GET",
                    url: URLBASE+"listadoNomenclaturasDestino",
                    data: "",
                    success: function (response) {
                       
                        listado = true;
                        $("#nomenclatura_destino").removeAttr("placeholder","Listado completado");

                        $("#nomenclatura_destino").autocomplete({ 
                                autoFocus: false,
                                minLength: 8,
                                source: response.parcelas,
                                open: function() {
                                    setTimeout(function() {
                                        $('.ui-autocomplete').css('z-index', 9999);
                                    }, 0);
                                    $(".ui-helper-hidden-accessible").css("display", "none");
                                },
                                select: function(event, ui) {

                                    $(".parcela_id").val(ui.item.parcela_id);
                                    $(".padron_destino").text(ui.item.parcela_padron);
                                    $(".estado_destino").text(ui.item.tipo_estado_descrip);
                                    $(".clasificacion_destino").text(ui.item.tipo_parcela_ryb_descrip);
                                    $("#collapseDestino").collapse('show');
                                    $(".btn-agregar-desglose").removeAttr("disabled")

                                }
                            });  

                    },error: function (response) {
                            console.log(response.responseText);
                    }
                });

                $("#modalSeleccionarOrigen").on("hidden.bs.modal",function(){
                    $(".btn-agregar-union").attr("disabled",true);
                    $("#collapseOrigen").collapse('hide');
                    $("#padron_origen").val("");
                    $("#nomenclatura_origen").val("");
                    $(".parcela_id").val("");
                })

                $("#modalSeleccionarDestino").on("hidden.bs.modal",function(){
                    $(".btn-agregar-desglose").attr("disabled",true);
                    $("#padron_destino").val("");
                    $("#nomenclatura_destino").val("");
                    $("#collapseDestino").collapse('hide');
                    $(".parcela_id").val("");
                })


                $("#modalSeleccionarOrigen").on("show.bs.modal",function(){
                    if(!listado){
                        $("#padron_origen").attr("placeholder","Cargando listado");
                        $("#nomenclatura_origen").attr("placeholder","Cargando listado");
                    }
                })

                $("#modalSeleccionarDestino").on("show.bs.modal",function(){
                    if(!listado){
                        $("#padron_destino").attr("placeholder","Cargando listado");
                        $("#nomenclatura_destino").attr("placeholder","Cargando listado");
                    }
                })


                $(".link-origenDestino").on("click",function(e){

                    Swal.fire({
                        type: 'warning',
                        title: 'Desasociar padrón.',
                        html: 'La siguiente acción quitará la relación con el padrón actual',
                        showDenyButton: true,
                        showCancelButton: true,
                        confirmButtonText: `Quitar`,
                        denyButtonText: `Cancelar`,
                        }).then((result) => {
                            console.log(result);
                        /* Read more about isConfirmed, isDenied below */
                        if (result.value) {
                            $(this).parent().submit();
                        } else{
                            return false;
                        }
                    })

                })
            @endif
            
        });
        </script>        
    @endpush
