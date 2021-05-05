
    <div class="card">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card-header">    
            @if($bloqueo->usuario_id == Auth::user()->usuario_id)         
            <button class="btn btn-primary btn-lg rounded mt-2" type="button" data-toggle="modal" data-target="#abrirmodalDocumento">
                    <i class="fa fa-plus "></i>&nbsp;&nbsp;Agregar Regímenes
                </button>
            @endif
        </div>
        <div class="card-body">
            <table id="tablaDocumentacion" class="table table-bordered table-striped table-sm table-responsive">
                <thead>
                    <tr class="bg-dark text-light">
                        <th>Tipo Régimen</th>
                        <th>Tipo Documento</th>
                        <th>Descripción</th>
                        <th>Archivo</th>
                        <th>Fecha Carga</th>
                        <th>Usuario</th>
                        <th>Editar</th>
                    </tr>
                </thead>
                <tbody>
                    @if(empty($parceladocumentos->all()))                        
                        <tr>
                            <th colspan="7" style="text-align:center"><font color="RED"><b>SIN DOCUMENTACION RELACIONADA</b></font></th>
                        </tr>
                    @else
                        @foreach($parceladocumentos as $parceladocumento)
                        <tr>
                            <td>{{$parceladocumento->tipo_regimen_descrip}}</td>
                            <td>{{$parceladocumento->tipo_doc_descrip}}</td>
                            <td>{{$parceladocumento->parcela_document_descrip}}</td>
                            <td><a href="{{ URL::to( 'storage/archivos/parceladocs' . $parceladocumento->parcela_document_archivo)  }}" target="_blank" download="{{ $parceladocumento->parcela_document_original }}">{{ $parceladocumento->parcela_document_original }}</a></td>
                            <td>{{\Carbon\Carbon::parse($parceladocumento->parcela_document_f_proc)->format('d/m/Y')}}</td>
                            <td>{{$parceladocumento->usuario_nombre}}</td>
                            <td>
                                @if($bloqueo->usuario_id != Auth::user()->usuario_id) 
                                    <button type="button" class="btn btn-danger btn-md rounded pull-right" disabled><i class="fa fa-times"></i> Bloqueado</button> 
                                @else
                                <button type="button" class="btn btn-warning rounded text-light btn-sm" 
                                data-parcela_document_id="{{$parceladocumento->parcela_document_id}}"
                                data-tipo_regimen_id="{{$parceladocumento->tipo_regimen_id}}"
                                data-parcela_document_origen="{{$parceladocumento->parcela_document_origen}}"
                                data-parcela_document_f_origen="{{$parceladocumento->parcela_document_f_origen}}"
                                data-parcela_document_expediente="{{$parceladocumento->parcela_document_expediente}}"
                                data-parcela_document_ordenanza="{{$parceladocumento->parcela_document_ordenanza}}"
                                data-seccion_id="{{$parceladocumento->seccion_id}}"
                                data-parcela_document_descrip="{{$parceladocumento->parcela_document_descrip}}"
                                data-parcela_document_archivo="{{$parceladocumento->parcela_document_archivo}}"
                                data-parcela_document_original="{{$parceladocumento->parcela_document_original}}"
                                data-parcela_document_observaciones="{{$parceladocumento->parcela_document_observaciones}}"
                                data-tipo_doc_id="{{$parceladocumento->tipo_doc_id}}"
                                data-parcela_id="{{$parceladocumento->parcela_id}}"
                                data-toggle="modal" 
                                data-target="#editarDocumentacion">
                                    <i class="fa fa-edit fa-2x"></i>
                                    &nbsp; Editar </button>    
                                @endif
                            </td>                        
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>                
            {{$parceladocumentos->render()}}         
        </div>
    </div>
        <div class="modal fade" id="abrirmodalDocumento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dark modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Agregar Regímenes</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="text-light">×</span>
                        </button>
                    </div>                    
                    <div class="modal-body">
                        <form action="{{route('documentos.store')}}" method="post" class="form-horizontal was-validated" enctype="multipart/form-data" >
                            {{csrf_field()}}
                            @include('gestion.padron.documentos.form')
                            <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="nombre">Archivo</label>
                                    <div class="col-md-9">
                                        <input type="file" id="parcela_document_archivo" name="parcela_document_archivo" max-file-size="10240" class="form-control" required>
                                    </div>
                            </div>
                            <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="nombre">Tipo de Archivo</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="tipo_doc_id" id="tipo_doc_id">
                                            @foreach($tipodocumentaciones as $tipodocumentacion)
                                            <option value="{{$tipodocumentacion->tipo_doc_id}}">{{$tipodocumentacion->tipo_doc_descrip}}</option>                
                                            @endforeach
                                        </select>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" id="parcela_id" name="parcela_id" value="{{$parcela_id}}" required>
                                <input type="hidden" id="idrol" name="idrol" value="{{$idrol}}" required>
                                <input type="hidden" id="bloquear" name="bloquear" value="{{$bloqueo->usuario_id}}">
                                @if(Auth::user()->idrol != 3)
                                {!!$bloqueo->user->usuario_nombre!!}
                                @else
                                   No posee permisos
                                @endif
                                <button type="submit" class="btn btn-success rounded" id="buttonGuardarDocumento"><i class="fa fa-save fa-2x"></i> Guardar</button>
                                <button type="button" class="btn btn-danger rounded" data-dismiss="modal"><i class="fa fa-times fa-2x"></i> Cerrar</button>
                            </div>
                        </form>
                    </div>                            
                </div>
            </div>
        </div>
    <div class="modal fade" id="editarDocumentacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dark modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Actualizar Regímenes</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-light">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('documentos.update','test')}}" method="post" class="form-horizontal was-validated" enctype="multipart/form-data">
                        {{method_field('patch')}}
                        {{csrf_field()}}
                        <input type="hidden" id="parcela_document_id" name="parcela_document_id" value="">
                        @include('gestion.padron.documentos.form')
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="nombre">Archivo</label>
                            <div class="col-md-9">
                                <span id="downloadArchivoModal"></span>&nbsp;<button type="button" id="button_cambio_archivo" class="btn btn-success rounded" onclick="cargamodalcambio()"> Cambiar</button>
                                <input type="hidden" id="parcela_document_archivo" name="parcela_document_archivo" class="form-control">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="nombre">Tipo de Archivo</label>
                            <div class="col-md-9">
                                <select class="form-control" name="tipo_doc_id" id="tipo_doc_id">
                                    @foreach($tipodocumentaciones as $tipodocumentacion)
                                    <option value="{{$tipodocumentacion->tipo_doc_id}}">{{$tipodocumentacion->tipo_doc_descrip}}</option>                
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" id="url_archivos_documentos" name="url_archivos_documentos" value="{{asset('storage/archivos/parceladocs')}}" required>
                            <input type="hidden" id="parcela_id" name="parcela_id" value="{{$parcela_id}}" required>
                            <input type="hidden" id="idrol" name="idrol" value="{{$idrol}}" required>
                            <input type="hidden" id="bloquear" name="bloquear" value="{{$bloqueo->usuario_id}}">
                            @if(Auth::user()->idrol != 3)
                            {!!$bloqueo->user->usuario_nombre!!}
                            @else
                               No posee permisos
                            @endif
                            <button type="button" class="btn btn-danger rounded" id="buttonEliminarDocumento" onclick="$('#eliminarDocumento').modal('show')"><i class="fa fa-times fa-2x"></i> Baja</button>
                            <button type="submit" class="btn btn-success rounded" id="buttonGuardarDocumento"><i class="fa fa-save fa-2x"></i> Guardar</button>
                            <button type="button" class="btn btn-danger rounded" data-dismiss="modal"><i class="fa fa-times fa-2x"></i> Cerrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="eliminarDocumento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-danger modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Eliminar Documento</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-light">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Confirma la eliminacion de este registro?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="eliminarDocumento()">Confirmar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="otroArchivo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dark modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Cargar archivo reemplazo</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-light">×</span>
                    </button>
                </div>
                <div class="modal-body">
                <form action="{{url('archivo')}}" method="post" class="form-horizontal was-validated" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group row">
                            <input type="hidden" id="parcela_document_id2" name="parcela_document_id2" value="">
                            <label class="col-md-3 form-control-label" for="nombre">Nuevo Archivo</label>
                            <div class="col-md-9">
                                <input type="file" id="parcela_document_archivo" name="parcela_document_archivo" class="form-control"  max-file-size="10240" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success rounded" id="buttonGuardarDocumento"><i class="fa fa-save fa-2x"></i> Guardar</button>
                            <button type="button" class="btn btn-danger rounded" data-dismiss="modal"><i class="fa fa-times fa-2x"></i> Cerrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@push('scripts')
    <script>
        $('#abrirmodal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var modal = $(this);
            modal.find('.modal-body #buttonEliminarDocumento').prop('hidden', true);
            var idrol = parseInt($('.modal-body #idrol').val());
            if(idrol == 3){
                modal.find('.modal-body #buttonGuardarDocumento').prop('hidden', true);
            }
            var bloquear = parseInt($('.modal-body #bloquear').val());
            if(idrol == 2 && bloquear == 1){
                modal.find('.modal-body #buttonGuardarDocumento').prop('hidden', true);
            }            
        });
        $('#editarDocumentacion').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var parcela_document_id = button.data('parcela_document_id');
            var parcela_document_origen = button.data('parcela_document_origen');
            var parcela_document_f_origen = button.data('parcela_document_f_origen');
            var parcela_document_expediente = button.data('parcela_document_expediente');
            var parcela_document_ordenanza = button.data('parcela_document_ordenanza');
            var seccion_id = button.data('seccion_id');
            var parcela_document_descrip = button.data('parcela_document_descrip');
            var parcela_document_archivo = button.data('parcela_document_archivo');
            var parcela_document_original = button.data('parcela_document_original');
            var parcela_document_observaciones = button.data('parcela_document_observaciones');
            var tipo_regimen_id = button.data('tipo_regimen_id');
            var tipo_doc_id = button.data('tipo_doc_id');
            var parcela_id = button.data('parcela_id');
            var url_archivos_documentos = $('.modal-body #url_archivos_documentos').val();
            var modal = $(this);
            var idrol = parseInt($('.modal-body #idrol').val());
            var bloquear = parseInt($('.modal-body #bloquear').val());
            modal.find('.modal-body #buttonEliminarDocumento').prop('hidden', true);
            if(idrol == 3){
                modal.find('.modal-body #buttonGuardarDocumento').prop('hidden', true);
            }
            if(idrol == 2 && bloquear == 1){
                modal.find('.modal-body #buttonGuardarDocumento').prop('hidden', true);
            }
            if(idrol == 1 || idrol == 4){
                modal.find('.modal-body #buttonEliminarDocumento').prop('hidden', false);
            }
            modal.find('.modal-body #parcela_document_id').val(parcela_document_id);
            modal.find('.modal-body #parcela_document_origen').val(parcela_document_origen);
            modal.find('.modal-body #parcela_document_f_origen').val(parcela_document_f_origen);
            modal.find('.modal-body #parcela_document_expediente').val(parcela_document_expediente);
            modal.find('.modal-body #seccion_id').val(seccion_id);
            modal.find('.modal-body #parcela_document_descrip').val(parcela_document_descrip);            
            modal.find('.modal-body #parcela_document_archivo').val(parcela_document_archivo);
            modal.find('.modal-body #parcela_document_observaciones').val(parcela_document_observaciones);
            modal.find('.modal-body #tipo_regimen_id').val(tipo_regimen_id);
            modal.find('.modal-body #tipo_doc_id').val(tipo_doc_id);
            modal.find('.modal-body #downloadArchivoModal').html("<a href='"+url_archivos_documentos+parcela_document_archivo+"' target='_blank' download='"+parcela_document_original+"'>"+parcela_document_original+"</a>");
        })        
        function eliminarDocumento(){
            var valor = parseInt($('.modal-body #parcela_document_id').val());
            $.ajax({
                type: "GET",
                url: "{{url('eliminarDocumento')}}",
                data: { parcela_document_id : valor },
                success: function(response) {
                    if(response.eliminado){
                        document.location.reload(true);
                    }else{
                        alert('Error en la baja del registro');
                    }
                }
            });
        }
        function cargamodalcambio(){
            var parcela_document_id = parseInt($('.modal-body #parcela_document_id').val());
            $('#parcela_document_id2').val(parcela_document_id);
            $('#otroArchivo').modal('show');
        }
    </script>
@endpush