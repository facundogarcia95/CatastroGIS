@inject('controlador', 'App\Http\Controllers\ParcelaController')
@extends('principal')
@section('breadcrumb')
    {{ Breadcrumbs::render('padrones') }}
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
        
         <h3>Listado de Padrones <i class="fa fa-info-circle text-primary ml-2 pull-right" style="cursor:pointer" data-toggle="collapse" data-target=".info" aria-expanded="false"></i></h3><br/>
         <div class="collapse info">
            <p class="f-15">Usted podrá filtrar el listado de padrones según sus criterios de búsqueda haciendo click sobre el botón <u>"Filtrar Listado"</u>.</p>
            <p class="f-15">Una vez que ha realizado el filtro de padrones, el sistema le permitirá descargar el resultado en formato <b>PDF</b> si el mismo contiene menos de 1000 registros.</p>
            <p class="f-15">Podrá realizar alta de padrones haciendo click sobre el respectivo botón, para luego seleccionar la parcela desde el mapa o bien escribir su nomenclatura y el sistema localizará a la misma.</p>
         </div>
               
            <div class="row">
               <div class="col-sm-12  mt-2">
                  <a class="btn bg-catastro text-light btn-md rounded pull-left mr-2" data-toggle="collapse"  href="#collapseBusquedaPadron" >
                     <i class="fa fa-arrow-down"></i>&nbsp;&nbsp;Filtrar Listado
                  </a>  
                                
                  @if(Auth::user()->idrol==1 || Auth::user()->idrol==4  || Auth::user()->idrol==2)
                     <button class="ml-1 btn bg-success text-light btn-md rounded pull-right font-weight-bold" type="button" data-toggle="modal" data-target="#altaPura">
                        <i class="fa fa-plus-square"></i>&nbsp;&nbsp;Alta Pura
                     </button>
                  @endif

                  @if(app('request')->input('search'))
                  <form action="{{url('exportar_resultadoPadrones')}}" method="GET" class="was-validated">
                     @foreach ($request as $key => $value)
                        <input type="hidden" name="{{$key}}" value="{{$value}}">
                     @endforeach
                     <button class="ml-1 btn bg-primary text-light btn-md rounded pull-right font-weight-bold" type="submit" >
                        <i class="fa fa-file"></i>&nbsp;&nbsp;Exportar Resultado
                     </button>
                  </form>
                  @endif  
               </div>
            </div>
       
          <div class="collapse" id="collapseBusquedaPadron">
            <form action="{{url('gestion/padron')}}" method="GET" class="was-validated">
               <input type="hidden" name="search" value="true"> 
                  <div class="row bg-white ml-1 mr-1 mt-3">
                     <div class="col-md-12 col-sm-12 mt-2 mb-1" >
                        <p class="font-weight-bold text-uppercase text-catastro"> datos de la parcela</p><hr class="text-danger"/>
                     </div>
                     <div class="col-sm-12 mb-1">
                        <div class="form-row">
                           <div class="col-sm-6 col-md-2"><input type="text" name="parcela_distrito" class="form-control rounded" maxlength="2" placeholder="Distrito" value="{{app('request')->input('parcela_distrito')}}"></div>
                           <div class="col-sm-6 col-md-2"><input type="text" name="parcela_seccion" class="form-control rounded" maxlength="2" placeholder="Sección" value="{{app('request')->input('parcela_seccion')}}"></div>
                           <div class="col-sm-6 col-md-3"><input type="text" name="parcela_manzana" class="form-control rounded" maxlength="4" placeholder="Manzana" value="{{app('request')->input('parcela_manzana')}}"></div>
                           <div class="col-sm-6 col-md-3"><input type="text" name="parcela_parcela" class="form-control rounded" maxlength="6" placeholder="Parcela" value="{{app('request')->input('parcela_parcela')}}"></div>
                           <div class="col-sm-6 col-md-2"> <input type="text" name="parcela_subparcela" class="form-control rounded" maxlength="4" placeholder="Subparcela" value="{{app('request')->input('parcela_subparcela')}}"></div>
                        </div>
                     </div>
                     <div class="col-sm-12 col-md-6 mb-1 mt-1">
                        <div class="form-row mb-3">
                             <div class="col-5"> <input type="number" name="parcela_padron" class="form-control rounded" placeholder="Padrón" value="{{app('request')->input('parcela_padron')}}"></div>
                             <div class="col-7"> <input type="text" name="parcela_nomenclatura" class="form-control rounded" placeholder="Nomenclatura" value="{{app('request')->input('parcela_nomenclatura')}}"></div>
                        </div>
                        <div class="form-group">
                           <input type="text" name="parcela_plano_nro" class="form-control rounded" placeholder="Plano" value="{{app('request')->input('parcela_plano_nro')}}">
                        </div>
                     </div>
                     <div class="col-sm-12 col-md-6 mb-1 mt-1">
                        <div class="form-group">
                              <input type="text" name="direccion_nomencla_rud_real" class="form-control rounded" placeholder="RUD Real" value="{{app('request')->input('direccion_nomencla_rud_real')}}">
                        </div>
                        <div class="form-row">
                           <div class="col-md-12"><input type="text" name="parcela_expediente" class="form-control rounded" placeholder="Expediente" value="{{app('request')->input('parcela_expediente')}}"></div>
                        </div>
                     </div>

                     <div class="col-md-12 col-sm-12 mt-2 mb-1" >
                        <p class="font-weight-bold text-uppercase text-catastro"> datos de la titularidad</p><hr class="text-danger"/>
                     </div>

                     <div class="col-sm-12 mb-1 mt-1">
                        <div class="form-row">
                           <div class="col-sm-12 col-md-4"><input type="text" name="persona_denominacion" value="{{app('request')->input('persona_denominacion')}}" class="form-control rounded titulares" placeholder="Titular" ></div>
                           <div class="col-sm-12 col-md-4"><input type="text" name="persona_nro_doc" class="form-control rounded" placeholder="N° DNI" value="{{app('request')->input('persona_nro_doc')}}"></div>
                           <div class="col-sm-12 col-md-4"><input type="text" name="persona_cuit"  id="persona_cuit" class="form-control rounded" placeholder="N° Cuit" value="{{app('request')->input('persona_cuit')}}"></div>
                        </div>
                     </div>

                     <div class="col-sm-12 mb-1 mt-1 mb-2">
                        <a class="ml-1 btn bg-info text-light btn-md rounded pull-right limpiar font-weight-bold" href="{{url('gestion/padron')}}"  >
                           <i class="fa fa-recycle"></i>&nbsp;&nbsp;Limpiar
                        </a>
                        <button class="btn bg-info text-light btn-md rounded pull-right ml-1 mr-1 font-weight-bold" type="submit" >
                           <i class="fa fa-search"></i>&nbsp;&nbsp;Buscar
                        </button>
                     </div>

                  </div>
            </form>
          </div>
       </div>

       <div class="card-body">
         @if ($parcelas->count() > 0)
            <span id="icon_excel"></span>
         @endif
         <table id="tablaParcelas" class="table table-bordered table-striped table-sm table-responsive">
            <thead>
                <tr class="bg-dark text-light">
                    <th>  {!! TableSorter::sort('ParcelaController@index', 'Padrón', 'parcela_padron', $sorter,10) !!}</th>
                    <th>Padrón Origen</th>
                    <th>  {!! TableSorter::sort('ParcelaController@index', 'Nomenclatura', 'parcela_nomenclatura', $sorter,10) !!}</th>
                    <th>  {!! TableSorter::sort('ParcelaController@index', 'RUD Real', 'direccion_nomencla_rud_real', $sorter,10) !!}</th>
                    <th>Titulares</th>
                    <th>  {!! TableSorter::sort('ParcelaController@index', 'Avalúo', 'parcela_avaluo', $sorter,10) !!}</th>
                    <th>  {!! TableSorter::sort('ParcelaController@index', 'Fracción', 'parcela_fraccion_ori', $sorter,10) !!}</th>
                    <th>Estado</th>
                    <th>Gestionar</th>
                </tr>
            </thead>
            <tbody>
               @if ($parcelas->count() > 0)
                  @foreach ($parcelas as $parcela)

                     <tr>
                        <td><a href="{{url('gestion/padron',$parcela->parcela_id)}}"><b>{{$parcela->parcela_padron}}</b></a></td>
                        <td>  
                           @php
                              $parcelas_origen = $controlador->parcelas_origen($parcela->parcela_id);
                           @endphp
                           @if (count($parcelas_origen) >1)
                              <a href="#collapse{{$parcela->parcela_id}}" data-toggle="collapse" class="text-catastro font-weight-bold">Padrones ({{count($parcelas_origen)}})</a>
                                 <div class="collapse" id="collapse{{$parcela->parcela_id}}">
                                    @foreach ($parcelas_origen as $item)
                                       @if ($item->parcela_id != 0 && $item->parcela_id != null)
                                          <a href="{{url('gestion/padron',$item->parcela_origen->parcela_id)}}">
                                             
                                                {{$item->parcela_origen->parcela_padron}}
                                          
                                          </a> <br/> 
                                       @else
                                             <p class="text-catastro text-uppercase">Sin Origen</p>
                                       @endif
                                    @endforeach
                              </div>
                           @elseif(count($parcelas_origen) == 1)
                              @foreach ($parcelas_origen as $item)
                                    @if ($item->parcela_id != 0 && $item->parcela_id != null)
                                          <a href="{{url('gestion/padron',$item->parcela_origen->parcela_id)}}">
                                                {{$item->parcela_origen->parcela_padron}}
                                          </a> <br/> 
                                       @else
                                             <p class="text-catastro text-uppercase">Sin Origen</p>
                                       @endif
                              @endforeach
                           @else
                              <p class="text-catastro text-uppercase">Sin Origen</p>
                           @endif
                           
                        </td>
                        <td>
                           {{$parcela->parcela_nomenclatura}}
                        </td>
                        <td>
                           @if (isset($parcela->direccion_nomencla_rud_real) &&  $parcela->direccion_nomencla_rud_real != "")
                              {{$parcela->direccion_nomencla_rud_real}}
                           @else
                              <p class="text-catastro text-uppercase text-center"> - </p>
                           @endif
                        </td>
                        <td>  
                           @php
                              $titulares = $controlador->titulares($parcela->parcela_id);
                           @endphp
                           @if (count($titulares) >1)
                              <a href="#collapsePersonas{{$parcela->parcela_id}}" data-toggle="collapse" class="text-catastro font-weight-bold">Titulares ({{count($titulares)}})</a>
                                 <div class="collapse" id="collapsePersonas{{$parcela->parcela_id}}">
                                    @foreach ($titulares as $item)
                                          <a href="{{url('gestion/personas?persona_id='.$item->persona_id)}}">
                                             {{$item->persona_denominacion}} 
                                          </a> <br/>
                                    @endforeach
                              </div>
                           @elseif(count($titulares) == 1)
                              @foreach ($titulares as $item)
                                 <a href="{{url('gestion/personas?persona_id='.$item->persona_id)}}" >
                                       {{$item->persona_denominacion}}
                                    </a> <br/>
                              @endforeach
                           @else
                              <p class="text-catastro text-uppercase text-center"> - </p>
                           @endif
                           
                        </td>
                        <td>
                           @if (isset($parcela->parcela_avaluo) &&  $parcela->parcela_avaluo != "")
                                 {{$parcela->parcela_avaluo}}
                           @else
                           <p class="text-catastro text-uppercase text-center"> - </p>
                           @endif
                        
                        </td>
                        <td>
                           @if (isset($parcela->parcela_fraccion_ori) &&  $parcela->parcela_fraccion_ori != "")
                              {{$parcela->parcela_fraccion_ori}}
                           @else
                           <p class="text-catastro text-uppercase text-center"> - </p>
                           @endif
                        </td>
                        <td>
                           {{$parcela->tipo_estado_codigo}} - {{$parcela->tipo_estado_parcela}}
                        </td>
                        <td style="text-align:center">
                           <a href="{{url('gestion/padron',$parcela->parcela_id)}}" class="btn btn-warning rounded text-light btn-sm" title="Gestionar este Padrón">
                              <i class="fa fa-edit fa-2x"></i>
                           </a>
                        </td>
                     </tr>
                     
                  @endforeach
               @else
               <tr>
                  <td colspan="9"><b class="text-catastro">No se encontraron registros</b></a></td>
               </tr>
               @endif
            </tbody>
          
        </table>
        {{$parcelas->appends(request()->query())->links()}}
       </div>

         <!-- ===========================
            MODAL DE ALTA PURA
         ================================-->

       @if(Auth::user()->idrol==1 || Auth::user()->idrol==4)
         <div class="modal fade" id="altaPura" tabindex="-1" role="dialog" aria-labelledby="altaPura" aria-hidden="true" style="width: 100% !important;">
            <div class="modal-dialog modal-dark modal-lg " role="document">
               <div class="modal-content">
                  <div class="modal-header bg-catastro">
                        <h4 class="modal-title">Alta Pura de Padrón</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-light">×</span>
                        </button>
                  </div>

                  <div class="modal-body">
                     <div class="col-sm-12 text-center p-0 mt-1 carto shadow-box" style=" max-height: 170px;">  
                        @include('cartografia.cartoPadron')
                     </div>
                     <form id="generarAltaPura" action="{{url('gestion/alta_pura')}}" method="GET" class="was-validated">
                        {{csrf_field()}} 
                           <div class="form-row m-2">
                                 <div class="col-sm-12">
                                    <div class="input-group mt-2 ">
                                       <div class="input-group-addon">
                                           Tipo Nomenclatura:
                                       </div>
                                       <select id="tipo_nomenclatura" name="tipo_nomenclatura" class="form-control">
                                         
                                          <option value="2"  @if(old('tipo_nomenclatura') == 2) selected @endif>Provisoria</option>
                                          <option value="3"  @if(old('tipo_nomenclatura') == 3) selected @endif>Posicional</option>
                                          <option value="1"  @if(old('tipo_nomenclatura') == 1) selected @endif>Antigua Nomenclatura</option>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="col-sm-12 col-md-8">
                                    <div class="input-group mt-2 ">
                                       <div class="input-group-addon">
                                           Nomenclatura:
                                       </div>
                                       <input type="text" class="form-control" name="parcela_nomenclatura" data-mask="" id="nomenclatura" readonly value="{{ old('parcela_nomenclatura') }}">
                                    </div>
                                 </div>
                                 <div class="col-sm-12 col-md-4">
                                    <div class="input-group mt-2 ">
                                       <div class="input-group-addon">
                                           Sup. Mensura:
                                       </div>
                                       <input type="number" class="form-control" name="parcela_super_mensura"  min="1" step="1" required value="0">
                                    </div>
                                 </div>
                                 <div class="col-sm-4 tradicional">
                                    <div class="input-group mt-2">
                                       <div class="input-group-addon">
                                          Distrito:
                                       </div>
                                       <input type="text" class="form-control parcela_distrito" name="parcela_distrito" maxlength="2"  value="{{ old('parcela_distrito')}}" required>
                                    </div>
                                 </div>
                                 <div class="col-sm-4 tradicional">
                                    <div class="input-group mt-2 ">
                                       <div class="input-group-addon">
                                          Seccion:
                                       </div>
                                       <input type="text" class="form-control parcela_seccion" name="parcela_seccion" maxlength="2" value="{{ old('parcela_seccion') }}" required>
                                    </div>
                                 </div>
                                 <div class="col-sm-4 tradicional">
                                    <div class="input-group mt-2 ">
                                       <div class="input-group-addon">
                                          Manzana:
                                       </div>
                                       <input type="text" class="form-control parcela_manzana" name="parcela_manzana" maxlength="4" value="{{ old('parcela_manzana') }}" required>
                                    </div>
                                 </div>
                                 <div class="col-sm-5 tradicional">
                                    <div class="input-group mt-2 ">
                                       <div class="input-group-addon">
                                          Parcela:
                                       </div>
                                       <input type="text" class="form-control parcela_parcela" name="parcela_parcela" maxlength="6" value="{{ old('parcela_parcela') }}" required>
                                    </div>
                                 </div>

                                 <div class="col-sm-6 posicional d-none">
                                    <div class="input-group mt-2 ">
                                       <div class="input-group-addon">
                                          Coordenada X:
                                       </div>
                                       <div class="input-group-addon bg-secondary font-weight-bold f-16">{{env('FIJO_COORDENADA_X')}}</div>
                                       <input type="text" class="form-control parcela_x" name="parcela_x" maxlength="6" value="{{ old('parcela_x') }}" required>
                                    </div>
                                 </div>
                                 <div class="col-sm-6 posicional d-none">
                                    <div class="input-group mt-2 ">
                                       <div class="input-group-addon">
                                          Coordenada Y:
                                       </div>
                                       <div class="input-group-addon bg-secondary font-weight-bold f-16">{{env('FIJO_COORDENADA_Y')}}</div>
                                       <input type="text" class="form-control parcela_y" name="parcela_y" maxlength="6" value="{{ old('parcela_y') }}" required>
                                    </div>
                                 </div>

                                 <div class="col-sm-4 subparcela">
                                    <div class="input-group mt-2 ">
                                       <div class="input-group-addon">
                                          Sub Parcela:
                                       </div>
                                       <input type="text" class="form-control parcela_subparcela" name="parcela_subparcela" id="parcela_subparcela" maxlength="4" value="{{ old('parcela_subparcela') }}" >
                                    </div>
                                 </div>
                                 <div class="col-sm-3">
                                    <div class="input-group mt-2 ">
                                       <div class="input-group-addon">
                                          Dig:
                                       </div>
                                       <input type="number" max="9" min="0" class="form-control parcela_dig_veri" name="parcela_dig_veri"  value="0">
                                    </div>
                                 </div>  

                                 <div class="col-sm-12 col-md-6">
                                    <div class="input-group mt-2 ">
                                       <div class="input-group-addon">
                                          Estado Parcela:
                                       </div>
                                       <select class="form-control tipo_parcela_estado" required  name="tipo_parcela_estado_id"> 
                                          @foreach ($estadosParcela as $estado)
                                             <option value="{{$estado->tipo_parcela_estado_id}}" @isset($parcela) @if($estado->tipo_parcela_estado_id == $parcela->tipo_parcela_estado_id) selected @endif  @endisset>
                                                {{$estado->tipo_parcela_estado_codigo}} - {{$estado->tipo_parcela_estado_descrip}}
                                             </option>
                                          @endforeach
                                       </select>
                                    </div>
                                 </div>
                                 <div class="col-sm-12 col-md-6">
                                    <div class="input-group mt-2 ">
                                       <div class="input-group-addon">
                                          R y B de Parcela:
                                       </div>
                                       <select class="form-control tipo_parcela_ryb" required  name="tipo_parcela_ryb_id"> 
                                          @foreach ($rybparcela as $ryb)
                                             <option value="{{$ryb->tipo_parcela_ryb_id}}" @isset($parcela) @if($ryb->tipo_parcela_ryb_id == $parcela->tipo_parcela_ryb_id) selected @endif  @endisset>
                                                {{$ryb->tipo_parcela_ryb_codigo}} - {{$ryb->tipo_parcela_ryb_descrip}}
                                             </option>
                                          @endforeach
                                       </select>
                                    </div>
                                 </div>                                 

                           </div>
                           <div class="modal-footer">
                              <button type="button" class="btn btn-success rounded d-none btn-generar">Generar</button>
                              <button type="button" class="btn btn-danger rounded" data-dismiss="modal">Cerrar</button>
                           </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
       @endif
   </div>
</div>



@push('scripts')
<script>
   
   var arregloNomenclaProvisoria = [FIJO_DEPARTAMENTO_PROVISORIO,'00','00','0000',armarNomencla('{{$siguientePadron}}',6,'0',1),'0000','0'];
   var arregloNomenclaDefinitiva = [FIJO_DEPARTAMENTO,'00','00','0000','000000','0000','0'];
   var arregloNomenclaPosicional = [FIJO_DEPARTAMENTO,FIJO_COORDENADA_X+'000000',FIJO_COORDENADA_Y+'000000','0000','0'];

   /*===============
   COMENTADO HASTA QUE SE REVEA LISTADO DE TITULARES SON 1 MILLON Y TARDA EN CARGAR
   =================*/
   /*$.ajax({
      url: 'titularesAutocompletar',
      type: 'get',
      data: {},
      success: function(response) {

         $(".titulares").autocomplete({ 
            autoFocus: false,
            minLength: 4,
            source: response.titulares,
            open: function() {
                  setTimeout(function() {
                     $('.ui-autocomplete').css('z-index', 9999);
                  }, 0);
                  $(".ui-helper-hidden-accessible").css("display", "none");
            },
            select: function(event, ui) {
            }
         });

      },
      error: function(resp) {
         console.log(resp);
      }

   });*/

   /*====================================
      CAPTURO EL EVENTO CHANGE PARA DEFINIR LA MASCA DE LA NOMENCLATURA
   =====================================*/
   $("#tipo_nomenclatura").on("change",function () { 
      if($(this).val() == 1){

         $(".btn-generar").addClass("d-none");

         $("#nomenclatura").attr("data-inputmask","'mask': '99-99-99-9999-999999-9999-9'")
         $('[data-mask]').inputmask()
         $("#nomenclatura").val(arregloNomenclaDefinitiva.join("-")); 
         $(".tradicional").removeClass("d-none")
         $(".posicional").addClass("d-none")
         $(".subparcela").removeClass("col-sm-9");
         $(".subparcela").addClass("col-sm-4");
         $(".parcela_distrito").removeAttr("readonly")
         $(".parcela_seccion").removeAttr("readonly")
         $(".parcela_seccion").removeAttr("readonly")
         $(".parcela_manzana").removeAttr("readonly")
         $(".parcela_parcela").removeAttr("readonly")
         $(".parcela_subparcela").removeAttr("readonly")

         if(vectorSource != null){
            if(vectorSource.getFeatures().length >0){
               var features = vectorSource.getFeatures();
               var lastFeature = features[features.length - 1];
               vectorSource.removeFeature(lastFeature);
            }
         }



      }else if($(this).val() == 2){

         $(".btn-generar").removeClass('d-none');

         $("#nomenclatura").attr("data-inputmask","'mask': 'AA-99-99-9999-999999-9999-9'") 
         $('[data-mask]').inputmask()
         $("#nomenclatura").val(arregloNomenclaProvisoria.join("-")); 
         $(".tradicional").removeClass("d-none")
         $(".posicional").addClass("d-none")
         $(".subparcela").removeClass("col-sm-9");
         $(".subparcela").addClass("col-sm-4");
         $(".parcela_distrito").attr("readonly",true)
         $(".parcela_seccion").attr("readonly",true)
         $(".parcela_seccion").attr("readonly",true)
         $(".parcela_manzana").attr("readonly",true)
         $(".parcela_parcela").attr("readonly",true)
         $(".parcela_subparcela").attr("readonly",true)


      }else{

         $(".btn-generar").addClass("d-none");

         $("#nomenclatura").attr("data-inputmask","'mask': '99-9999999-9999999-9999-9'")
         $('[data-mask]').inputmask()
         $("#nomenclatura").val(arregloNomenclaPosicional.join("-")); 
         $(".posicional").removeClass("d-none")
         $(".tradicional").addClass("d-none")
         $(".subparcela").removeClass("col-sm-4");
         $(".subparcela").addClass("col-sm-9");

         if(vectorSource != null){
            if(vectorSource.getFeatures().length >0){
               var features = vectorSource.getFeatures();
               var lastFeature = features[features.length - 1];
               vectorSource.removeFeature(lastFeature);
            }
         }

         $(".parcela_distrito").removeAttr("readonly")
         $(".parcela_seccion").removeAttr("readonly")
         $(".parcela_seccion").removeAttr("readonly")
         $(".parcela_manzana").removeAttr("readonly")
         $(".parcela_parcela").removeAttr("readonly")
         $(".parcela_subparcela").removeAttr("readonly")


      }

      $(".parcela_distrito").val("");
      $(".parcela_seccion").val("");
      $(".parcela_manzana").val("");
      $(".parcela_parcela").val("");
      $(".parcela_subparcela").val("");
      $(".parcela_dig_veri").val(0);
      $(".parcela_dig_veri").val(0);
      $(".parcela_x").val("");
      $(".parcela_y").val("");


		highlightLayerSource.clear('');


   });

   var datos;
   /*====================================
      CAPTURO TODOS LOS EVENTOS KEYUP PARA ARMAR LA NOMENCLATURA
   =====================================*/
   $(".parcela_distrito").on("keyup",function(){
      if($("#tipo_nomenclatura").val() == 1){
         arregloNomenclaDefinitiva[1] = armarNomencla($(this).val(),2,'0',1)
         $("#nomenclatura").val(arregloNomenclaDefinitiva.join("-"));  
      }else if($("#tipo_nomenclatura").val() == 2){
         arregloNomenclaProvisoria[1] = armarNomencla($(this).val(),2,'0',1)
         $("#nomenclatura").val(arregloNomenclaProvisoria.join("-"));  
      }
      datos = buscarPorNomenclatura($("#nomenclatura").val().split("-").join(""));  

      if(datos != null){
         $(".btn-generar").removeClass("d-none");
      }else{
         $(".btn-generar").addClass("d-none");
      }

   });

   $(".parcela_seccion").on("keyup",function(){
      if($("#tipo_nomenclatura").val() == 1){
         arregloNomenclaDefinitiva[2] = armarNomencla($(this).val(),2,'0',1)
         $("#nomenclatura").val(arregloNomenclaDefinitiva.join("-"));  
      }else if($("#tipo_nomenclatura").val() == 2){
         arregloNomenclaProvisoria[2] = armarNomencla($(this).val(),2,'0',1)
         $("#nomenclatura").val(arregloNomenclaProvisoria.join("-"));  
      }
      datos = buscarPorNomenclatura($("#nomenclatura").val().split("-").join(""));  

      if(datos != null){
         $(".btn-generar").removeClass("d-none");
      }else{
         $(".btn-generar").addClass("d-none");
      }

   });

   $(".parcela_manzana").on("keyup",function(){
      if($("#tipo_nomenclatura").val() == 1){
         arregloNomenclaDefinitiva[3] = armarNomencla($(this).val(),4,'0',1)
         $("#nomenclatura").val(arregloNomenclaDefinitiva.join("-"));  
      }else if($("#tipo_nomenclatura").val() == 2){
         arregloNomenclaProvisoria[3] = armarNomencla($(this).val(),4,'0',1)
         $("#nomenclatura").val(arregloNomenclaProvisoria.join("-"));  
      }

      datos = buscarPorNomenclatura($("#nomenclatura").val().split("-").join(""));  

      if(datos != null){
         $(".btn-generar").removeClass("d-none");
      }else{
         $(".btn-generar").addClass("d-none");
      }

   });

   $(".parcela_parcela").on("keyup",function(){
      if($("#tipo_nomenclatura").val() == 1){
         arregloNomenclaDefinitiva[4] = armarNomencla($(this).val(),6,'0',1)
         $("#nomenclatura").val(arregloNomenclaDefinitiva.join("-"));  
      }else if($("#tipo_nomenclatura").val() == 2){
         arregloNomenclaProvisoria[4] = armarNomencla($(this).val(),6,'0',1)
         $("#nomenclatura").val(arregloNomenclaProvisoria.join("-"));  
      }
     
      datos = buscarPorNomenclatura($("#nomenclatura").val().split("-").join(""));  

      if(datos != null){
         $(".btn-generar").removeClass("d-none");
      }else{
         $(".btn-generar").addClass("d-none");
      }


   });

   $(".parcela_subparcela").on("keyup",function(){
      if($("#tipo_nomenclatura").val() == 1){
         arregloNomenclaDefinitiva[5] = armarNomencla($(this).val(),4,'0',1)
         $("#nomenclatura").val(arregloNomenclaDefinitiva.join("-"));  
      }else if($("#tipo_nomenclatura").val() == 2){
         arregloNomenclaProvisoria[5] = armarNomencla($(this).val(),4,'0',1)
         $("#nomenclatura").val(arregloNomenclaProvisoria.join("-"));  
      }else{
         arregloNomenclaPosicional[3] = armarNomencla($(this).val(),4,'0',1)
         $("#nomenclatura").val(arregloNomenclaPosicional.join("-"));  
      }

   });


   $(".parcela_dig_veri").on("keyup",function(){
      if($("#tipo_nomenclatura").val() == 1){
         arregloNomenclaDefinitiva[6] = armarNomencla(0,1,'0',1)
         $("#nomenclatura").val(arregloNomenclaDefinitiva.join("-"));  
      }else if($("#tipo_nomenclatura").val() == 2){
         arregloNomenclaProvisoria[6] = armarNomencla(0,1,'0',1)
         $("#nomenclatura").val(arregloNomenclaProvisoria.join("-"));  
      }else{
         arregloNomenclaPosicional[4] = armarNomencla(0,1,'0',1)
         $("#nomenclatura").val(arregloNomenclaPosicional.join("-"));  
      }
   });

   $(".parcela_x").on("keyup",function(){
      if($("#tipo_nomenclatura").val() == 3){
         arregloNomenclaPosicional[1] = FIJO_COORDENADA_X+armarNomencla($(this).val(),6,'0',1)
         arregloNomenclaPosicional[2] = FIJO_COORDENADA_Y+armarNomencla($(".parcela_y").val(),6,'0',1)

         $("#nomenclatura").val(arregloNomenclaPosicional.join("-"));
         datos = buscarPorNomenclatura($("#nomenclatura").val().split("-").join("").replace("_",""));
         if(datos != null){
            $(".btn-generar").removeClass("d-none");
         }else{
            $(".btn-generar").addClass("d-none");
         }
            marcador(arregloNomenclaPosicional[1],arregloNomenclaPosicional[2]);
      }
   });


   $(".parcela_y").on("keyup",function(){
      if($("#tipo_nomenclatura").val() == 3){
         arregloNomenclaPosicional[1] = FIJO_COORDENADA_X+armarNomencla($(".parcela_x").val(),6,'0',1)
         arregloNomenclaPosicional[2] = FIJO_COORDENADA_Y+armarNomencla($(this).val(),6,'0',1)
         $("#nomenclatura").val(arregloNomenclaPosicional.join("-"));  
        
         datos =  buscarPorNomenclatura($("#nomenclatura").val().split("-").join("").replace("_",""));
         if(datos != null){
            $(".btn-generar").removeClass("d-none");
         }else{
            $(".btn-generar").addClass("d-none");
         }
         marcador(arregloNomenclaPosicional[1],arregloNomenclaPosicional[2]);
      }
   });


   $(document).ready(function () {

      $("#tipo_nomenclatura").trigger("change");

         @if(app('request')->input('search') )
           // $( "#collapseBusquedaPadron" ).show()
         @endif


      });

      $("#altaPura").on("show.bs.modal",function(){
         moduloActivado = "NINGUNO";

         $(".ol-viewport").remove();

         setTimeout(() => {
            $.getScript("{{asset('js/cartografia_js/iniciar_mapa.js')}}", function() {});         
         }, 600);
         setTimeout(() => {
            $.getScript("{{asset('js/cartografia_js/single_click.js')}}", function() {});
            $.getScript("{{asset('js/cartografia_js/funciones_generales.js')}}", function() {});
         }, 800);

         setTimeout(() => {
            $(".ol-unselectable").css('max-width',$(".ol-viewport").width());  
            buscarPorNomenclatura($("#nomenclatura").val().split("-").join(""));   
         }, 1200);

      });

      $("#altaPura").on("hidden.bs.modal",function(){
         $(".carto").html('<div id="map" style=" cursor: pointer; height: 100%; min-height: 150px" class="map">');
      
      });

      var vectorSource = new ol.source.Vector();

      function marcador(coordenada_x,coordenada_y){


         vectorSource.clear();

         $.ajax({
            type: "get",
            url: "../transformarCoordenada",
            data: {
               coordenadaX:coordenada_x,
               coordenadaY:coordenada_y,
               from:22182,
               to:3857
            },
            async: true,
            success: function (response) {
               coordenada_x = response.coordenada[0];
               coordenada_y = response.coordenada[1];
   
                  /*===========================
                  CREACION DEL MARCADOR
                  ============================*/
               var iconFeature = new ol.Feature({
                     geometry: new ol.geom.Point([coordenada_x,coordenada_y])  
               });

               vectorSource.addFeature(iconFeature);
               
               var vectorLayer = new ol.layer.Vector({
                  source: vectorSource
               });

               var style = [];

               var fill = new ol.style.Fill({
                     color: "#E1401E"
                     });

               var stroke = new ol.style.Stroke({
                     color: 'black',
                     width: 2
                  });	

               var styleIcono = new ol.style.Style({											
                  image: new ol.style.Circle({
                  fill: fill,
                  stroke: stroke,
                  cursor: 'pointer',
                  radius: 4,
                  }),
                     fill: fill,
                     stroke: stroke
                  });
               style.push(styleIcono);
               iconFeature.setStyle(styleIcono);
               map.addLayer(vectorLayer);

            },error: function(resp){
               console.log(resp)
            }
         });

         intersectarCoordenada(coordenada_x,coordenada_y);
      }

      function intersectarCoordenada(coordenada_x,coordenada_y){
         $.ajax({
            type: "get",
            url: "../intersectar_coordenadas",
            data: {coordenada_x : coordenada_x, coordenada_y: coordenada_y, from: 22182},
            success: function (response) {
               console.log(response)
               if(response.intersectado[0] != undefined){
                  if(response.intersectado[0].nomenc21 != null){

                     if($("#nomenclatura").val().split("-").join("").substring(0,16) != response.intersectado[0].nomenc21.substring(0,16)){
                        Swal.fire({
                           position: 'center',
                           type: 'error',
                           title: 'Aviso de coordenada erronea',
                           html:'La coordenada no se encuentra dentro del poligono seleccionado.<br/> Por favor, verifique antes de continuar.',
                           showConfirmButton: true
                        });
                     }
                  }else{

                     Swal.fire({
                           position: 'center',
                           type: 'error',
                           title: 'No hemos podido intersectar polígono',
                           html:'La coordenada está tocando un polígono.',
                           showConfirmButton: true
                        });
                  }
               }
            },error: function (response){
               console.log(response);
            }
         });
      }


      $(".btn-generar").on("click",function(){
         
         console.log($("#parcela_subparcela").val());
         if($("#parcela_subparcela").val() != "0000" && $("#parcela_subparcela").val() != ""){

            Swal.fire({
                  type: 'warning',
                  title: 'Alta de PH.',
                  html: 'Se está dando de alta una PH, la misma será asociada a su correspondiente Matriz.',
                  showDenyButton: true,
                  showCancelButton: true,
                  confirmButtonText: `Continuar`,
                  denyButtonText: `Cancelar`,
                  }).then((result) => {
                     console.log(result);
                  /* Read more about isConfirmed, isDenied below */
                  if (result.value) {
                     $("#generarAltaPura").submit();
                  } else{
                     return false;
                  }
            })

         }else{

            $("#generarAltaPura").submit();
         }

      })

      @if( session('error-ph') )

         Swal.fire({
                  type: 'error',
                  title: 'Alta de PH.',
                  html: 'La nomenclatura matriz no tiene cargada la mejora PH. Debe cargar la misma.',
                  showDenyButton: true,
                  showCancelButton: false,
                  confirmButtonText: `Entendido`
            })

      @endif


      
</script>
@endpush
@endsection