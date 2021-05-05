
    <div class="card">
      <div class="card-header">    
          @if($bloqueo->usuario_id == Auth::user()->usuario_id)         
              <button class="btn btn-primary btn-lg rounded mt-2" type="button" data-toggle="modal" data-target="#abrirmodalTramite">
                  <i class="fa fa-plus "></i>&nbsp;&nbsp;Agregar Trámite
              </button>
          @endif
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

          <table id="tablaTramites" class="table table-bordered table-striped dt-responsive nowrap" style="width: 100%">
              <thead>
                  <tr class="bg-dark text-light">
                     <th>ID</th>
                     <th>Fecha</th>
                      <th>N° Expediente</th>
                      <th>Letra Expediente</th>
                      <th>Tipo de Trámite</th>
                      <th>Estado</th>
                      <th>Usuario</th>
                      <th>Observacion</th>
                  </tr>
              </thead>

          </table>                     
      </div>
  </div>
      <div class="modal fade" id="abrirmodalTramite" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
          <div class="modal-dialog modal-dark modal-lg" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h4 class="modal-title">Agregar Trámite</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true" class="text-light">×</span>
                      </button>
                  </div>                    
                  <div class="modal-body">
                      <form action="{{route('tramites.store')}}" method="post" class="form-horizontal was-validated" enctype="multipart/form-data" >
                          {{csrf_field()}}
                          @include('gestion.padron.tramites.form')

                          <div class="modal-footer">
                              <input type="hidden" id="parcela_id" name="parcela_id" value="{{$parcela->parcela_id}}" required>
                              @if(Auth::user()->idrol == 3)
                                 No posee permisos
                              @else
                                 @if(Auth::user()->usuario_id != $bloqueo->usuario_id)
                                    <button type="button" class="btn btn-danger rounded" disabled><i class="fa fa-times fa-2x"></i> Bloqueado</button>
                                 @else
                                    <button type="submit" class="btn btn-success rounded" id="buttonGuardarDocumento"><i class="fa fa-save fa-2x"></i> Guardar</button>
                                 @endif
                              @endif
                              <button type="button" class="btn btn-danger rounded" data-dismiss="modal"><i class="fa fa-times fa-2x"></i> Cerrar</button>
                          </div>
                      </form>
                  </div>                            
              </div>
          </div>
      </div>


@push('scripts')
  <script>
       $(document).ready(function () {

            olTable = $('#tablaTramites').DataTable({
                  "ajax":{
                     url:"{{url('tabla_tramites')}}",
                     data:{"parcela_id":{{$parcela->parcela_id}}}
                  },
                  "deferRender": true,
                  "retrieve": true,
                  "processing": true,
                  "order": [[0,'desc']],
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
                           {data: 'id'},
                           {data: 'fecha'},
                           {data: 'nro_exp'},
                           {data: 'letra_exp'},
                           {data: 'tipo_tramite'},
                           {data: 'estado'},
                           {data: 'usuario'},
                           {data: 'observacion'}
                        ]
            });

               $("#buscarTexto").keyup(function() {
                  olTable.search(this.value).draw();
               });    

            });

  </script>
@endpush