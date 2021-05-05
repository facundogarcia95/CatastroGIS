@inject('Reporte', 'App\Http\Controllers\ReporteGeneralController')
@extends('principal')
@section('breadcrumb')
    {{ Breadcrumbs::render('reporte_dinamico') }}
@endsection
@section('contenido')


    
   <div class="card">
        @if ( session('success'))
            <div class="alert alert-success" role="alert">{{session('success')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true" class="text-dark">&times;</span>
                </button>
            </div>
        @elseif( session('error') )
            <div class="alert alert-danger" role="alert">{{ trans(session('error')) }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true" class="text-dark">&times;</span>
                </button>
            </div>
        @endif

      <div class="card-header">
         <h2>Reporte Dinámico <i class="fa fa-info-circle text-primary pull-right mt-2 ml-2" style="cursor:pointer" data-toggle="collapse" data-target=".info" aria-expanded="false"></i></h2> 
         <div class="collapse panel-collapse info"><br/>
            <p class="f-15">El siguiente reporte le proporcionará toda la información disponible relacionada con las parcelas según el criterios de búsqueda que usted defina.</p>
            <p class="f-15">Podrá descargar en formato <b>PDF</b> el resultado de su búsqueda, como así también visualizar su historial de búsquedas.</p>
         </div>     
      </div>
      <div class="card-body">
          
         <div class="container">
            <form action="{{url('consultaDinamica')}}" method="POST" id="formulario-consulta">
               @csrf
               <div class="row ">
                  <div class="col-md-8 col-sm-12 mt-4">
                        <div class="card">
                              <div class="card-header bg-dark text-light">
                                 <h5>Gestor de consultas     
                                 <i class="fa fa-plus text-light agregarCondicion pull-right ml-3 mt-1"></i>
                                 @if ($historial)
                                    <button type="button" class="btn btn-sm btn-primary historial pull-right rounded ml-3"  data-toggle="modal" data-target="#abrirmodalHistorial"  type="button">Historial de Búsquedas</button>
                                 @endif  
                              </h5> 
                              </div>                       
                              <div class="card-body"> 
                                 <input type="hidden" name="html_sentencia" value="" id="html_sentencia">
                                 <input type="hidden" name="consulta" value="1">
                                 <input type="hidden" class="andor" name="andor[]" value="">
                                 <table class="table  gestorConsultas mb-0">
                                    <tbody class="bg-light">
                                       <tr>
                                          <td colspan="5">
                                             <select class="form-control" name="distrito">
                                                <option valus="0">SELECCIONAR DISTRITO</option>
                                                  @foreach ($distritos as $distrito)
                                                      <option value="{{$distrito->distrito_id}}">{{$distrito->distrito_nombre}}</option>
                                                  @endforeach
                                             </select>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td><input type="text" maxlength="1" value="-" valorParentesis="(" name="parentesis[]" readonly class="parentesis" style="width: 16px !important; min-height: 20px; cursor:pointer"></td>
                                          <td> 
                                             <select class="form-control campo_condicion" name="campo_condicion[]">
                                             @php 
                                                foreach($listado as $item){
                                                   echo "<option value='".$item["nombre_tabla"].$item["nombre_campo"]."'>".$item["nombre_mostrado"]."</option>";
                                                }
                                             @endphp
                                             </select>
                                          </td>
                                          <td>
                                             <select class="form-control igualdades" name="igualdades[]">
                                                <option value="=">IGUAL</option>
                                                <option value="<=">MENOR O IGUAL</option>
                                                <option value=">=">MAYOR O IGUAL</option>
                                                <option value="!=">DISTINTO A</option>
                                                <option value="LIKE">QUE CONTENGA</option>
                                                <option value="NOT LIKE">QUE NO CONTENGA</option>
                                             </select>
                                          </td>
                                          <td>
                                             <input type="text" class="form-control valores" name="valores[]" required>
                                          </td>
                                          <td><input type="text" maxlength="1" value="-" valorParentesis=")" name="parentesis[]" readonly class=" parentesis" style="width: 16px !important; min-height: 20px; cursor:pointer;"></td>
                                       </tr>
                                      
                                    </tbody>
                                 </table>
                                 <table class="table table-dark mt-0">
                                    <tr>
                                       <td colspan="5">
                                          @if ((Auth::user()->idrol  == 1 || Auth::user()->idrol == 4) && session('query') != null)
                                             @if ($horizont == null || $horizont->visto == 1)
                                                <button type="button" class="btn btn-md bg-catastro text-light horizont">Enviar Resultado a Horizont</button>                
                                             @elseif($horizont->visto == 0)
                                                <button type="button" class="btn btn-md bg-catastro text-light" disabled>Esperando lectura de Horizont</button>            
                                             @endif
                                          @endif
                                          <a href="{{url('limpiarReporteDinamico')}}" class="btn-danger btn pull-right btn-sm m-1">Limpiar</a>
                                          <button type="submit" class="btn-primary btn pull-right btn-sm m-1 consultar">Consultar</button>
                                       </td>
                                    </tr>
                                 </table>
                              </div>
                        </div>
                  </div>
                  <div class="col-md-4 col-sm-12 mt-4">
                        <div class="card h-100">
                              <div class="card-header bg-dark text-light">
                                 <h5>Campos a visualizar </h5>   
                              </div>                       
                              <div class="card-body">                           
                                 <select class="form-control h-100" multiple placeholder=" Click para selección de campos" name="visualizar[]" required>
                                    @php 
                                       foreach($listado as $item){
                                          
                                          $selected = "";
                                          if($item["nombre_campo"] == "parcela_padron"){ 
                                             $selected = "selected";
                                          }
                                          echo "<option value='".$item["nombre_campo"]."' $selected>".$item["nombre_mostrado"]."</option>";
                                          
                                       }
                                    @endphp
                                 </select>
   
                              </div>
                        </div>
                  </div>
                  <div class="col-md-4 col-sm-12 mt-0 col-md-offset-8">
                        <div class="card">
                              <div class="card-header bg-dark text-light">
                                 <h5>Ordenar por:</h5>
                                 <div class="row">
                                          <div class="col-md-6 col-sm-12">
                                                <select class="form-control" name="order">
                                                   @php 
                                                      foreach($listado as $item){
                                                         if($item["nombre_campo"] == "parcela_padron"){
                                                            echo "<option value='".$item["nombre_campo"]."' selected>".$item["nombre_mostrado"]."</option>";
                                                         }else{
                                                            echo "<option value='".$item["nombre_campo"]."'>".$item["nombre_mostrado"]."</option>";
                                                         }
                                                      }
                                                   @endphp
                                                </select>
                                          </div>
                                       <div class="col-md-6 col-sm-12">
                                             <select class="form-control" name="by">
                                                   <option value="ASC">ASCENDENTE</option>
                                                   <option VALUE="DESC">DESCENDENTE</option>
                                             </select>
                                       </div>
                                 </div>
                              </div>                       
                        </div>
                  </div>
               </div>                  
            </form>
            @if(session('query') != null)
            <div class="row ">   
               <div class="col-sm-12 mt-2">
                  <div class="card ">
                     <div class="card-header bg-dark text-light"> 
                        <label class="h5">Resultado de búsqueda</label> 
                        <a href="{{url('reporteDinamicoPDF')}}" target="_blank" class="btn btn-md btn-danger text-light pull-right rounded font-weight-bold"><i class="fa fa-file"></i> PDF</a>
                        <a href="{{url('reporteCartografia')}}" target="_blank" class="btn btn-md btn-success text-light pull-right rounded font-weight-bold mr-3"><i class="fa fa-map"></i> MAPA</a>
                     </div>
                     <div class="card-body">                     
                        <table id="tablaConsulta" class="table table-dark table-striped mt-0 border text-center dt-responsive nowrap" style="width: 100%">
                           <thead class="bg-dark text-light">
                              @foreach ($listado as $item)
                                 @foreach ($visualizar as $visual)
                                    @if($visual == $item["nombre_campo"])
                                       <th class="text-center">{{$item["nombre_mostrado"]}}</th>
                                    @endif
                                 @endforeach
                              @endforeach
                           </thead>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
            @endif
         </div>

      </div>
   </div>

</div>

        <!--Inicio del modal Historia-->
        <div class="modal fade" id="abrirmodalHistorial" tabindex="-1" role="dialog" aria-labelledby="modalHistorial"  aria-hidden="true">
         <div class="modal-dialog modal-dark modal-lg" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true" class="text-light">×</span>
                     </button>
                 </div>
                
                 <div class="modal-body">
                      
                     @if($historial != "")
      
                        <div class="col-lg-12 mt-2 mb-2 pl-0 pr-0 bg-light table-responsive">
            
                              <div class="card-header mt-2 mb-1 ml-0 bg-catastro text-light" id="historiales">
                                 <h5 style="cursor:pointer" >Historial de Consultas <i class="fa fa-eye text-light mt-2 ml-2" style="cursor:pointer" data-toggle="collapse" data-target=".historial" aria-expanded="false" href=".historial"></i></h5>   
                              </div>                       
                              <table class="table table-hover">
                                 @foreach ($historial as $consulta)
                                 <form action="{{url('historialConsulta')}}" method="POST" id="formulario-consulta">
                                       <input type="hidden" name="historial_id" value="{{$consulta->historial_busqueda_dinamica_id}}">
                                    <tr>
                                       @csrf
                                       <td>{{$consulta->historial_busqueda_dinamica_sentencia}}</td>
                                       <td><label class="text-catastro f-14 ">{{ Carbon\Carbon::parse($consulta->historial_busqueda_dinamica_fecha)->diffForHumans()}}</label></td>
                                       <td><button type="submit" class="btn btn-sm btn-primary rounded">Ir</button></td>
                                    </tr>
                                 </form>
                                 @endforeach
                              </table>
                              
                        </div>
         
                     @endif

                 </div>
                 
             </div>
             <!-- /.modal-content -->
         </div>
         <!-- /.modal-dialog -->
     </div>
     <!--Fin del modal-->



@push('scripts')

   <script>
      
      var parametros = {!!$listado!!};
        


   $(".agregarCondicion").on("click",function(){
            parentesis = '<td><input type="text" maxlength="1" valorParentesis="(" value="-" name="parentesis[]" readonly class="parentesis" style="width: 16px !important; min-height: 20px; cursor:pointer"></td>';
            parentesis2 = '<td><input type="text" maxlength="1" valorParentesis=")" value="-" name="parentesis[]" readonly class="parentesis" style="width: 16px !important; min-height: 20px; cursor:pointer"></td>';
            selectCampos = "<td><select class='form-control campo_condicion' name='campo_condicion[]'>";
            $.each(parametros, function(i, obj) {
               selectCampos += "<option value='"+obj["nombre_tabla"]+obj["nombre_campo"]+"'>"+obj["nombre_mostrado"]+"</option>"; 
            });
            selectCampos += "</select></td>";
            selectIgualdad = `<td><select class="form-control igualdades" name="igualdades[]">
                                    <option value="=">IGUAL</option>
                                    <option value="<=">MENOR O IGUAL</option>
                                    <option value=">=">MAYOR O IGUAL</option>
                                    <option value="!=">DISTINTO A</option>
                                    <option value="LIKE">QUE CONTENGA</option>
                                    <option value="NOT LIKE">QUE NO CONTENGA</option>
                                 </select></td>`;
            valor = '<td><input type="text" class="form-control valores" name="valores[]" required></td>';
            andor = "<tr><td colspan='5'><select class='form-control mx-auto andor' name='andor[]' style='max-width:80px;'><option value='AND'> Y </option><option value='OR'> Ó</option></select></td></tr>";
            html = andor+"<tr>"+parentesis+selectCampos+selectIgualdad+valor+parentesis2+"</tr>";
            $(".gestorConsultas tbody").append(html);

   })

   $(document).on("click",'.parentesis',function () {
            
               if($(this).val() == "-"){

                  $(this).val($(this).attr("valorParentesis"));

               }else{

                  $(this).val("-");

               }
            
   })


   $(document).on("click",'.consultar',function(){

            $(this).text('Consultando...');
            $(this).attr('disabled',true);
            $("#html_sentencia").val($(".gestorConsultas").html());

            var cantidadParentesis = 0;
            var cantidadParentesis1 = 0;
            var cantidadParentesis2 = 0;
            $(".parentesis").each(function() {
               if($( this ).val() != "-"){

                  if($( this ).val() == "("){
                     cantidadParentesis1++;
                  }else{
                     cantidadParentesis2++;
                  }
                     cantidadParentesis++;

               }
            });

            if(cantidadParentesis % 2 == 0){

               if(cantidadParentesis1 != cantidadParentesis2){
                  alert("Existe disparidad de parentesis");
                  $(this).text('Consultar');
                  $(this).removeAttr('disabled');
                  return false;
               }else{
                  $("#formulario-consulta").submit();
               }

            }else{

               alert("La cantidad de parentesis debe ser par");
               $(this).text('Consultar');
               $(this).removeAttr('disabled');
               return false;

            }
         
   })


   $(document).on("change",".campo_condicion",function(){
               var valor = $(this).val()
               var select = $(this);
               $(this).children("option").each(function(index, element){
                  if (valor == element.value){
                     $(this).attr('selected',true);
                  }else{
                     $(this).removeAttr('selected');
                  }
               });  

               if(valor == "tipos_parcelas_estados.tipo_parcela_estado_codigo"){

                  $(this).parent().parent().find('.valores').replaceWith('{!! $Reporte->generarSelect("tipos_parcelas_estados","tipo_parcela_estado_codigo","tipo_parcela_estado_id","tipo_parcela_estado_descrip"); !!}')
               
               }else if(valor == "tipos_parcelas_ryb.tipo_parcela_ryb_codigo"){
                 
                  $(this).parent().parent().find('.valores').replaceWith('{!! $Reporte->generarSelect("tipos_parcelas_ryb","tipo_parcela_ryb_codigo","tipo_parcela_ryb_id","tipo_parcela_ryb_descrip"); !!}')
               
               }else{
                  
                  let valorCargado = $(this).parent().parent().find('.valores').val();
                  $(this).parent().parent().find('.valores').replaceWith('<input type="text" class="form-control valores" name="valores[]" value="'+valorCargado+'" required>');
               
               }
   });


   @if(session('query') != null)

      olTable = $('#tablaConsulta').DataTable({
         "ajax":"tablaConsultaDinamica",
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
            @foreach ($visualizar as $campo)
               {data: '{{$campo}}'},
            @endforeach
         ]
   });

  
   
   $('.gestorConsultas').html(`{!!session("formulario_html")!!}`);
    

   $(document).ready(function () {
               var igualdades = {!!json_encode(session("igualdades"))!!};
               var index = 0;
               if(igualdades != null){

                  $(".igualdades").each(function(){
                     $( this ).val(igualdades[index]);
                     index++;
                  });

               }
               var valores = {!!json_encode(session("valores"))!!};
               var index = 0;

               if(valores != null){

                  $(".valores").each(function(){
                     $( this ).val(valores[index]);
                     index++;
                  });
           
               }
               var andor =  {!!json_encode(session("andor"))!!};
               var index = 0;

               if(andor != null){

                  $(".andor").each(function(){
                     $( this ).val(andor[index]);
                     index++;
                  });

               }
              

   })

   $(".horizont").on('click', function(){
      
      $(this).text('Enviando');
      var btn = $(this);
      $.ajax({
         type: "GET",
         url: "vistaHorizont",
         beforeSend: function(response){
         },
         success: function (response) {
            
            if(response.actualizada){
               
               btn.text('Datos a Horizont enviados');
               btn.removeClass('horizont');
               btn.attr('disabled',true);

               Swal.fire({
                  position: 'center',
                  type: 'success',
                  title: 'Datos actualizados',
                  html:'Se ha realizado actualizacion de los datos enviados a Horizont.',
                  showConfirmButton: true
               });

            }else{

               btn.text('Horizont aún no ha leido los datos');

               Swal.fire({
                  position: 'center',
                  type: 'error',
                  title: 'Datos no leidos por Horizont',
                  html:'Horizon aún no ha realizado una lectura sobre los datos anteriormente enviados.',
                  showConfirmButton: true
               });

            }

         },error: function(response){
            alert(response);
         }

      });
   })

   @endif

   </script>

@endpush


@endsection