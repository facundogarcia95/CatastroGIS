@inject('controlador', 'App\Http\Controllers\ParcelaController')
@inject('personasController', 'App\Http\Controllers\PersonasController')
@extends('principal')
@section('breadcrumb')
    {{ Breadcrumbs::render('edicion_padron',$parcela) }}
@endsection
@php
 session(['asignarDireccion'=>true]);
 $protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === 0 ? 'https://' : 'http://';
@endphp
@section('contenido')
<div class="container-fluid mt-6">
    
    <div class="card">
        
        @if ($tempUnionDesglose != null)
            <div class="alert alert-warning" role="alert">El padrón se encuentra en proceso de Unión/Desglose
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true" class="text-dark">&times;</span>
                </button>
            </div>
        @endif
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
       
        <span class="error-nomencla"></span>
 
 
        <div class="card-header">
            <i class="fa fa-info-circle text-primary ml-2 pull-right fa-2x" style="cursor:pointer" data-toggle="collapse" data-target=".info" aria-expanded="false"></i>
            <h4 class="text-left">EDICIÓN DE PADRON </h4>
            <div class="collapse info"><br/>
                <p class="f-15">La edición de padrón consta de 5 secciones, sobre las cuales usted podrá trabajar sus datos.</p>
                <p class="f-15">Los mismos son: <ul>
                    <li><b>DATOS GENERALES:</b> En ellos editará la información más relevante del padrón.</li>
                    <li><b>DATOS FISICOS:</b> Es toda aquella infomación que se obtiene del plano de la parcela.</li>
                    <li><b>ORIGEN/DESTINO:</b> Esta es una solapa informativa donde podrá ver si el padrón proviene de un desglose o unión, como así también si ha sido desglosado o unido posteriormente.</li>
                    <li><b>DATOS DE DOMINIO:</b> En ella se gestionan las titularidades del padrón como así también las personas físicas o jurídicas.</li>
                    <li><b>DATOS DE REGÍMENES:</b> Podrá cargar excepciones o regímenes en formato de documento.</li>
                    <li><b>REFERENCIA DE COLORES:</b> Polígono <svg width="30" height="15" ><rect width="30" height="15"  stroke="black" fill="blue"  rx="5" ry="5" /></svg> posee geometría en parcelario. Polígono <svg width="30" height="15" ><rect width="30" height="15"  stroke="black" fill="orange"  rx="5" ry="5" /></svg> referencia histórica de geometría. Polígono <svg width="30" height="15" ><rect width="30" height="15"  stroke="black" fill="rgb(134,136,144)"  rx="5" ry="5" /></svg> es PH</li>
                </ul></p>
             </div>
        </div>

        <div class="card-body m-2">
    
                @if (Auth::user()->idrol != 3 )
                    <form action="{{url('datosGeneralesParcela')}}"  class="was-validated" method="POST" id="formDatosGenereles">
                        @csrf
                        @method('patch')
                    <input type="hidden" name="parcela_id" value="{{$parcela->parcela_id}}">
                @endif
            <div class="row ">
                    <div class="col-lg-8 col-md-12 col-sm-12 rounded shadow-box mt-2 ">
                        <div class="input-group  mt-2">
                            <div class="alert alert-error w-100 mt-2 mb-2 bloqueo  @if($bloqueo->usuario_id == Auth::user()->usuario_id) d-none @endif" role="alert"><a  @if (Auth::user()->idrol == 4 || Auth::user()->idrol == 1 ) href="../../Usuarios/bloqueo?padron={{$parcela->parcela_padron}}" @endif> @if($bloqueo && Auth::user()->idrol != 3) Padrón en uso por {{$bloqueo->user->usuario_nombre}} @else No posee permisos para editar @endif </a>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true" class="text-dark">&times;</span>
                                </button>
                            </div>
                        </div>

                        <div class="form-row mb-2">
                            <div class="col-lg-6 col-md-12">
                                <div class="input-group mt-2 ">
                                    <div class="input-group-addon">
                                        Padrón Municipal:
                                    </div>
                                <input type="number" class="form-control font-weight-bold f-16" min="1" readonly value="{{$parcela->parcela_padron}}">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="input-group mt-2 ">
                                    <div class="input-group-addon">
                                        Padrón Rentas:
                                    </div>
                                    <input type="text" class="form-control parcela_padron_terr font-weight-bold f-16"  @if (Auth::user()->idrol != 3 ) name="parcela_padron_terr" @endif readonly value="{{$parcela->parcela_padron_terr??0}}" >
                                </div>
                            </div>
                        </div>

                        <div class="input-group">
                            <div class="input-group-addon">
                                Nomenclatura:
                            </div>
                            <div id="popup"></div>
                            @if ($parcela->tipo_nomenclatura == 3) 
                                <input type="text" class="form-control f-20 text-center font-weight-bold nomenclatura" tipo="3"  minlength="20" @if (Auth::user()->idrol == 4 || Auth::user()->idrol == 1 )  name="parcela_nomenclatura"   @endif data-inputmask="'mask': '99-9999999-9999999-9999-9'" data-mask="" value="{{$parcela->parcela_nomenclatura}}" readonly >
                            @elseif($parcela->tipo_nomenclatura == 2)
                                <input type="text" class="form-control f-20 text-center font-weight-bold nomenclatura" tipo="2" minlength="20" @if (Auth::user()->idrol == 4 || Auth::user()->idrol == 1 )  name="parcela_nomenclatura"  @endif  data-inputmask="'mask': 'AA-99-99-9999-999999-9999-9'" data-mask="" value="{{$parcela->parcela_nomenclatura}}" readonly>
                            @elseif($parcela->tipo_nomenclatura == 1)
                                <input type="text" class="form-control f-20 text-center font-weight-bold nomenclatura" tipo="1" minlength="20" @if (Auth::user()->idrol == 4 || Auth::user()->idrol == 1 )  name="parcela_nomenclatura" @endif data-inputmask="'mask': '99-99-99-9999-999999-9999-9'" data-mask="" value="{{$parcela->parcela_nomenclatura}}" readonly>
                            @else
                                <input type="text" class="form-control f-20 text-center font-weight-bold nomenclatura" tipo="0" minlength="20" @if (Auth::user()->idrol == 4 || Auth::user()->idrol == 1 )  name="parcela_nomenclatura" @endif data-inputmask="'mask': '99-99-99-9999-999999-9999-9'" data-mask="" value="{{$parcela->parcela_nomenclatura}}" readonly>
                            @endif    
                        </div>

                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="input-group mt-2 ">
                                    <div class="input-group-addon">
                                        Tipo Nomenclatura:
                                    </div>
                                    <select class="form-control font-weight-bold tipo_nomenclatura" @if (Auth::user()->idrol != 3 )  required name="tipo_nomenclatura" @endif readonly> 
                                    @switch($parcela->tipo_nomenclatura)
                                            @case(1)
                                                <option value="1" selected>Antigua Nomenclatura</option>
                                                <option value="3">Posicional</option>     
                                            @break
                                            @case(2)
                                                <option value="2" selected>Provisoria</option>
                                                <option value="1">Antigua Nomenclatura</option>
                                                <option value="3">Posicional</option>    
                                            @break
                                            @case(3)
                                                <option value="3" selected readonly>Posicional</option>
                                            
                                            @break
                                            @default 
                                                <option value="0" selected readonly>Sin Definir</option>
                                                <option value="2">Provisoria</option>
                                                <option value="1">Antigua Nomenclatura</option>
                                                <option value="3">Posicional</option>    
                                    @endswitch
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-2 gestionarVisibilidad">
                                <label class="form-control mt-2 mb-0">
                                    Distrito:
                                </label>
                                <div class="input-group">
                                    <input type="text" class="form-control font-weight-bold f-16 parcela_distrito" name="parcela_distrito" readonly  maxlength="2" value="{{$parcela->parcela_distrito}}">
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-2 gestionarVisibilidad">
                                <label class="form-control mt-2 mb-0">
                                    Seccion:
                                </label>
                                <div class="input-group">
                                    <input type="text" class="form-control font-weight-bold f-16 parcela_seccion" name="parcela_seccion" readonly  maxlength="2" value="{{$parcela->parcela_seccion}}">
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-2 gestionarVisibilidad">
                                <label class="form-control mt-2 mb-0">
                                    Manz:
                                </label>
                                <div class="input-group">
                                    <input type="text" class="form-control font-weight-bold f-16 parcela_manzana" name="parcela_manzana" readonly  maxlength="4" value="{{$parcela->parcela_manzana}}">
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-3 gestionarVisibilidad">
                                <label class="form-control mt-2 mb-0">
                                    Parcela:
                                </label>
                                <div class="input-group">
                                    <input type="text" class="form-control font-weight-bold f-16 parcela_parcela" name="parcela_parcela" readonly  maxlength="6" value="{{$parcela->parcela_parcela}}">
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-3 gestionarDimension">
                                <label class="form-control mt-2 mb-0">
                                    Subparcela:
                                </label>
                                <div class="input-group ">
                                    <input type="text" class="form-control font-weight-bold f-16 parcela_subparcela" name="parcela_subparcela" readonly  maxlength="4"  value="{{$parcela->parcela_subparcela}}">
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-3 gestionarDimension">
                                <label class="form-control mt-2 mb-0">
                                    Dig. Verif:
                                </label>
                                <div class="input-group ">
                                    <input type="text" class="form-control font-weight-bold f-16 dig_ver" name="parcela_dig_veri" readonly maxlength="1"  value="@if($parcela->parcela_dig_veri){{$parcela->parcela_dig_veri}}@else 0 @endif" >
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-3 gestionarDimension">
                                <label class="form-control mt-2 mb-0">
                                    Fracción:
                                </label>
                                <div class="input-group">
                                    <input type="text" class="form-control font-weight-bold f-16 parcela_fraccion_ori" name="parcela_fraccion_ori" readonly maxlength="8"  value="{{$parcela->parcela_fraccion_ori}}">
                                </div>
                            </div>
                            
                            <div class="col-md-12 col-lg-6 @if ($parcela->tipo_nomenclatura != 3) d-none @endif nomenclaPosicional">
                                <div class="input-group mt-2 ">
                                    <div class="input-group-addon">
                                        Coordenada X:
                                    </div>
                                    <div class="input-group-addon bg-secondary font-weight-bold f-16">
                                        {{env('FIJO_COORDENADA_X')}}
                                    </div>
                                    <input type="text" class="form-control font-weight-bold f-16 coordX" name="parcela_x" min="0"  maxlength="6" readonly value="{{substr($parcela->parcela_x??'0000000',1,6)}}">
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6 @if ($parcela->tipo_nomenclatura != 3) d-none @endif nomenclaPosicional">
                                <div class="input-group mt-2 ">
                                    <div class="input-group-addon">
                                            Coordenada Y:
                                    </div>
                                    <div class="input-group-addon bg-secondary font-weight-bold f-16">
                                        {{env('FIJO_COORDENADA_Y')}}
                                    </div>
                                    <input type="text" class="form-control font-weight-bold f-16 coordY" min="0" name="parcela_y"   maxlength="6" readonly value="{{substr($parcela->parcela_y??'0000000',1,6)}}">
                                </div>
                            </div>

                            <div class="col-md-6 titulares-div">
                                <label class="form-control mt-2 mb-0">
                                    Titulares:
                                </label>
                                <div class="input-group">
                                    @php
                                        $titulares = $controlador->titulares($parcela->parcela_id);
                                    @endphp
                                    @if (count($titulares) >1)
                                        <a  class="form-control font-weight-bold text-primary" href="#collapsePersonas{{$parcela->parcela_id}}" data-toggle="collapse" class="text-catastro font-weight-bold">{{$titulares[0]->persona_denominacion}} ({{count($titulares)}}) <span class="text-catastro ml-2">(P)</span>
                                        </a>
                                        
                                    @elseif(count($titulares) == 1)
                                            <a  class="form-control font-weight-bold" href="{{url('gestion/personas?persona_id='.$titulares[0]->persona_id)}}" >
                                                    {{$titulares[0]->persona_denominacion}} <span class="text-catastro ml-2">(P)</span>
                                            </a>
                                    @else
                                        <label class="text-uppercase font-weight-bold text-center form-control"> NO POSEE </label>
                                    @endif   
                                </div>
                                
                                <div class="collapse" id="collapsePersonas{{$parcela->parcela_id}}">
                                    @foreach ($titulares as $item)
                                        <a class="form-control font-weight-bold text-primary" href="{{url('gestion/personas?persona_id='.$item->persona_id)}}">
                                            {{$item->persona_denominacion}} 
                                        </a> 
                                    @endforeach
                                </div>
                            </div>
                    
                        </div>

                        <div class="form-row">
                            <div class="col-sm-12 col-md-6">
                                <div class="input-group mt-2 ">
                                    <div class="input-group-addon">
                                        Estado Parcela:
                                    </div>
                                    <select class="form-control font-weight-bold tipo_parcela_estado" required disabled  name="tipo_parcela_estado_id"> 
                                        @foreach ($estadosParcela as $estado)
                                            <option value="{{$estado->tipo_parcela_estado_id}}" @if($estado->tipo_parcela_estado_id == $parcela->tipo_parcela_estado_id) selected @endif>
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
                                   <select class="form-control tipo_parcela_ryb" required disabled  name="tipo_parcela_ryb_id"> 
                                      @foreach ($rybparcela as $ryb)
                                         <option value="{{$ryb->tipo_parcela_ryb_id}}" @isset($parcela) @if($ryb->tipo_parcela_ryb_id == $parcela->tipo_parcela_ryb_id) selected @endif  @endisset>
                                            {{$ryb->tipo_parcela_ryb_codigo}} - {{$ryb->tipo_parcela_ryb_descrip}}
                                         </option>
                                      @endforeach
                                   </select>
                                </div>
                             </div>  
                        </div>

                        <div class="form-row mb-2">
                            <div class="col-12">
                                <div class="input-group mt-2">
                                    <div class="input-group-addon">
                                        Dirección Real:
                                    </div>
                                    <a  href="#datosFisicos" class="redirectNomencla form-control font-weight-bold f-16 direccion_nomencla_rud_real" >{{$parcela->direccion_nomencla_rud_real??'NO POSEE'}}</a>
                                </div>
                            </div>
                        </div>
   
                        @if(Auth::user()->idrol != 3)
                                <div class="col-12 mb-2 mt-2 ">
                                    <a href="{{url('reporte_parcela',$parcela->parcela_id)}}" class="mb-1 btn btn-success btn-md rounded pull-left text-light" target="_blank"><i class="fa fa-file-pdf-o"></i> Reporte</a>  
                                    @if($bloqueo->usuario_id != Auth::user()->usuario_id) 
                                        <button type="button" class="btn btn-danger btn-md rounded pull-right " readonly><i class="fa fa-times"></i> Bloqueado</button> 
                                    @else  
                                        @if(Auth::user()->idrol != 3)
                                            @if($tempUnionDesglose == null || ($tempUnionDesglose != null && $tempUnionDesglose->usuario_id == Auth::user()->usuario_id))
                                                <button type="button" class="btn btn-primary btn-md rounded pull-right editarDatosGenerales" ><i class="fa fa-edit"></i> Editar</button>
                                            @else
                                                <button type="button" class="btn btn-danger btn-md rounded pull-right " readonly><i class="fa fa-times"></i> Bloqueado</button> 
                                            @endif
                                        @endif
                                        <button type="button" class="btn btn-danger btn-md rounded pull-right d-none cancelarEdicionDatosGenerales mb-1 ml-1" ><i class="fa fa-times"></i> Cancelar</button>  
                                        <button type="button" class="btn btn-success btn-md rounded pull-right d-none guardarDatosGenerales mb-1" ><i class="fa fa-save"></i> Actualizar</button>  
                                    @endif
                                </div> 
                            </form>
                        @endif

                    </div>
                <div class="col-lg-4 col-md-12 col-sm-12 text-center mt-2  shadow-box"  >
                    @include('cartografia.cartoPadron')
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-lg-12 col-md-12  rounded shadow-box">

                    <ul class="nav nav-tabs mt-2" id="myTab" role="tablist">
                        <li class="nav-item ">
                            <a class="nav-link active rounded datosfisicos" id="datosfisicosBtn"  data-toggle="tab" href="#datosFisicos" role="tab" aria-controls="datosFisicos" aria-selected="true">Datos Físicos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link rounded origenDestino"  data-toggle="tab" href="#origenDestino" role="tab" aria-controls="origenDestino" aria-selected="false">Origen/Destino</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link rounded dominio"  data-toggle="tab" href="#dominio" role="tab" aria-controls="dominio" aria-selected="false">Dominio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link rounded regimenes" data-toggle="tab" href="#regimenes" role="tab" aria-controls="regimenes" aria-selected="false">Regímenes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link rounded regimenes" data-toggle="tab" href="#tramites" role="tab" aria-controls="tramites" aria-selected="false">Trámites</a>
                        </li>
                    </ul>
                    <div class="tab-content mb-2">
                        <div class="tab-pane fade active show" id="datosFisicos" role="tabpanel" aria-labelledby="datosFisicos-tab">
                            <ul class="todo-list"  style="overflow-x: hidden;">
            
                                <!-- ==============================
                                        DATOS DE PLANO
                                    ==============================-->
                                    <li class="itemSlide" >
            
                                        <div class="box-group" id="accordion">
            
                                            <!--=====================================
                                                CAJA GESTOR 
                                            ======================================-->                  
            
                                            <div class="panel box box-info">
            
                                                <!--=====================================
                                                        CABEZA DE LA CAJA GESTOR 
                                                ======================================-->  
                                                
                                                <div class="box-header with-border">
            
                                                    <div class="row ">
                                                        <div class="col-12"> 
                                                           <span class="handle ">
                                                             <h4 class="box-title text-catastro font-weight-bold "><a  class="text-catastro collapsePlano" data-toggle="collapse"  data-target="#collapsePlano" href="#collapsePlano">DATOS DEL PLANO</a></h4> 
                                                           </span>
                                                       
                                                        </div>
                                                    </div>
              
                                                </div>
            
                                                <!--=====================================
                                                MÓDULOS COLAPSABLES
                                                ======================================-->   
                                                
                                                <div id="collapsePlano" class="panel-collapse collapse collapseSlide" data-parent="#datosFisicos">
            
                                                         <!--=====================================
                                                                MODIFICAR NOMBRE 
                                                        ======================================-->      
                                                         <form action="{{url('planoPadron')}}" method="POST" class="was-validated" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('patch')
                                                            <input type="hidden" name="parcela_id" value="{{$parcela->parcela_id}}">
                                                            <div class="row mt-4">
                                                                <div class="col-12">
                                                                        <div class="col-12"><h6 class="box-title text-catastro font-weight-bold mt-2">MEDIDAS</h6> </div>
                                                                        <div class="form-row m-2">
                                                                            <div class="col-lg-6 col-md-12">
                                                                                <div class="input-group mt-2 ">
                                                                                    <div class="input-group-addon">
                                                                                        Sup Mensura:
                                                                                    </div>
                                                                                <input type="number" name="parcela_super_mensura" min="0" step="0.001" class="form-control font-weight-bold f-16"  value="{{$parcela->parcela_super_mensura??0}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-6 col-md-12">
                                                                                <div class="input-group mt-2 ">
                                                                                    <div class="input-group-addon">
                                                                                        Sup S/Título:
                                                                                    </div>
                                                                                    <input type="number" name="parcela_super_titulo" min="0" step="0.001" class="form-control font-weight-bold f-16"  value="{{$parcela->parcela_super_titulo??0}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-6 col-md-12">
                                                                                <div class="input-group mt-2 ">
                                                                                    <div class="input-group-addon">
                                                                                        Sup % Común:
                                                                                    </div>
                                                                                <input type="number" name="parcela_porc_comun"  step="0.1" min="0" max="100" class="form-control font-weight-bold f-16"  value="{{$parcela->parcela_porc_comun??0.00}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-6 col-md-12">
                                                                                <div class="input-group mt-2 ">
                                                                                    <div class="input-group-addon">
                                                                                        Sup Libre:
                                                                                    </div>
                                                                                    <input type="number"  name="parcela_super_libre" min="0"  step="0.001" class="form-control font-weight-bold f-16" value="{{$parcela->parcela_super_libre??0}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-6 col-md-12">
                                                                                <div class="input-group mt-2 ">
                                                                                    <div class="input-group-addon">
                                                                                        Sup Cultivada:
                                                                                    </div>
                                                                                    <input type="number"  name="parcela_super_cultivada" min="0" step="0.001" class="form-control font-weight-bold f-16" value="{{$parcela->parcela_super_cultivada??0}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-6 col-md-12">
                                                                                <div class="input-group mt-2 ">
                                                                                    <div class="input-group-addon">
                                                                                        Padrón Pasaje:
                                                                                    </div>
                                                                                    <input type="number"  name="parcela_padron_pasaje" min="0" class="form-control font-weight-bold f-16" value="{{$parcela->parcela_padron_pasaje}}">
                                                                                </div>
                                                                            </div>
                                                                      
                                                                            <div class="col-lg-6 col-md-12">
                                                                                <div class="input-group mt-2 ">
                                                                                    <div class="input-group-addon">
                                                                                        Med Lateral N°:
                                                                                    </div>
                                                                                    <input type="number"  name="parcela_lateral_norte" min="0"  step="0.001" class="form-control font-weight-bold f-16" value="{{$parcela->parcela_lateral_norte??0}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-6 col-md-12">
                                                                                <div class="input-group mt-2 ">
                                                                                    <div class="input-group-addon">
                                                                                        Med Lateral S°:
                                                                                    </div>
                                                                                    <input type="number"  name="parcela_lateral_sur" min="0" step="0.001" class="form-control font-weight-bold f-16" value="{{$parcela->parcela_lateral_sur??0}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-6 col-md-12">
                                                                                <div class="input-group mt-2 ">
                                                                                    <div class="input-group-addon">
                                                                                        Med Lateral E°:
                                                                                    </div>
                                                                                    <input type="number"  name="parcela_lateral_este" min="0" step="0.001" class="form-control font-weight-bold f-16" value="{{$parcela->parcela_lateral_este??0}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-6 col-md-12">
                                                                                <div class="input-group mt-2 ">
                                                                                    <div class="input-group-addon">
                                                                                        Med Lateral O°:
                                                                                    </div>
                                                                                    <input type="number"  name="parcela_lateral_oeste" min="0" step="0.001" class="form-control font-weight-bold f-16" value="{{$parcela->parcela_lateral_oeste??0}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-6 col-md-12">
                                                                                <div class="input-group mt-2 ">
                                                                                    <div class="input-group-addon">
                                                                                        Ochava:
                                                                                    </div>
                                                                                    <input type="number"  name="parcela_ochava" min="0" step="0.001" class="form-control font-weight-bold f-16" value="{{$parcela->parcela_ochava??0}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-6 col-md-12 mb-1">
                                                                                <div class="input-group mt-2 ">
                                                                                    <div class="input-group-addon">
                                                                                        Punto Cardinal Frente:
                                                                                    </div>
                                                                                    <input type="text"  name="parcela_lado_frente" maxlength="1" class="form-control font-weight-bold f-16" value="{{$parcela->parcela_lado_frente}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-6 col-md-12 mb-1">
                                                                                <div class="input-group mt-2 ">
                                                                                    <div class="input-group-addon">
                                                                                        Cantidad de Frentes:
                                                                                    </div>
                                                                                    <input type="number" max="4" min="0"  name="parcela_cant_frentes" maxlength="1" class="form-control font-weight-bold f-16" value="{{$parcela->parcela_cant_frentes}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-12"><h6 class="box-title text-catastro font-weight-bold mt-2">PLANO</h6> </div>
                                                                            <div class="col-lg-6  col-md-12">
                                                                                <div class="input-group mt-2 ">
                                                                                    <div class="input-group-addon">
                                                                                        Plano N°:
                                                                                    </div>
                                                                                    <input type="number"  name="parcela_plano_nro" min="0" class="form-control font-weight-bold f-16" value="{{$parcela->parcela_plano_nro}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-6 col-md-12">
                                                                                <div class="input-group mt-2 ">
                                                                                    <div class="input-group-addon">
                                                                                        Plano Fecha:
                                                                                    </div>
                                                                                    <input type="date"  name="parcela_plano_fecha"  class="form-control font-weight-bold f-16" value="@if($parcela->parcela_plano_fecha) {{ Carbon\Carbon::parse($parcela->parcela_plano_fecha)->format('Y-m-d') }} @else @endif">
                                                                                </div>
                                                                            </div>
                                                                            @isset($documentosPlano[0])
                                                                            <div class="col-sm-12 col-md-2 mt-3 mb-2">
                                                                                <button type="button" class="h-100 w-100 btn btn-warning btn-md pull-right documentosPlano"><i class="fa fa-files-o"></i> Ver Documentos</button>
                                                                            </div>
                                                                            @endisset
                                                                            <div class="col-sm-12 col-md-10 mt-2 mb-2">
                                                                                <div class="input-group mt-2 ">
                                                                                    <div class="input-group-addon">
                                                                                        Agregar Documento:
                                                                                    </div>
                                                                                    <input type="file"  name="documento_plano" class="form-control f-16"/>
                                                                                </div>
                                                                            </div>
                                                                          
                                                                        </div>
                                                                        <div class="row m-2 pb-2 border" style="display: none; background-color: rgba(202, 202, 199, 0.171)"id="documentosPlano">
                                                                            @isset($documentosPlano[0])
                                                                                <div class="col-sm-12 mt-1" style="">
                                                                                    <h4 class="text-dark">Documento Vigente</h4>
                                                                                </div>
                                                                                    <div class="col-sm-12 col-md-6">
                                                                                        <div class="input-group mt-2 ">
                                                                                            <div class="input-group-addon font-weight-bold bg-secondary">
                                                                                                Archivo:
                                                                                            </div>
                                                                                            <a class="form-control text-primary" href="{{ URL::to( 'storage/archivos/parceladocs' . $documentosPlano[0]["parcela_document_archivo"])  }}" target="_blank" download="{{ $documentosPlano[0]["parcela_document_original"] }}">{{ $documentosPlano[0]["parcela_document_original"]}}</a>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-sm-12 col-md-6">
                                                                                        <div class="input-group mt-2 ">
                                                                                            <div class="input-group-addon font-weight-bold bg-secondary">
                                                                                                Usuario/Seccion:
                                                                                            </div>
                                                                                        <label class="form-control">{{$documentosPlano[0]["usuario_nombre"]}} / {{$documentosPlano[0]["seccion_descrip"]}}</label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-sm-12 col-md-12">
                                                                                        <div class="input-group mt-2 ">
                                                                                            <div class="input-group-addon font-weight-bold bg-secondary" >
                                                                                                Fecha:
                                                                                            </div>
                                                                                           <label class="form-control">{{$documentosPlano[0]["parcela_document_f_origen"]}}</label>
                                                                                        </div>
                                                                                    </div>
                                                                            @endisset
                                                                            @isset($documentosPlano[1])
                                                                            <hr/>
                                                                                <div class="col-sm-12 mt-2 ">
                                                                                    <hr class="my-4 text-catastro">
                                                                                    <h4 class="text-dark">Históricos</h4>
                                                                                </div>
                                                                                @for ($i = 1; $i < $documentosPlano->count(); $i++)
                                                                                    <div class="col-sm-12 col-md-6 mb-1">
                                                                                        <div class="input-group mt-2 ">
                                                                                            <div class="input-group-addon font-weight-bold bg-secondary">
                                                                                                Archivo:
                                                                                            </div>
                                                                                            <a class="form-control text-primary" href="{{ URL::to( 'storage/archivos/parceladocs' . $documentosPlano[$i]["parcela_document_archivo"])}}" target="_blank" download="{{ $documentosPlano[$i]["parcela_document_original"] }}">{{ $documentosPlano[$i]["parcela_document_original"] }}</a>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-sm-12 col-md-6 mb-1">
                                                                                        <div class="input-group mt-2 ">
                                                                                            <div class="input-group-addon font-weight-bold bg-secondary">
                                                                                                Usuario/Seccion:
                                                                                            </div>
                                                                                        <label class="form-control">{{$documentosPlano[$i]["usuario_nombre"]}} / {{$documentosPlano[$i]["seccion_descrip"]}}</label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-sm-12 col-md-12 mb-1">
                                                                                        <div class="input-group mt-2 ">
                                                                                            <div class="input-group-addon font-weight-bold bg-secondary">
                                                                                                Fecha:
                                                                                            </div>
                                                                                        <label class="form-control">{{$documentosPlano[$i]["parcela_document_f_origen"]}}</label>
                                                                                        </div>
                                                                                    </div>
                                                                                @endfor
                                                                            @endisset   
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-sm-12 mb-2 mt-2">
                                                                                @if($bloqueo->usuario_id != Auth::user()->usuario_id) 
                                                                                    <button type="button" class="btn btn-danger btn-md rounded pull-right" readonly><i class="fa fa-times"></i> Bloqueado</button> 
                                                                                @else
                                                                                    @if($tempUnionDesglose == null || ($tempUnionDesglose != null && $tempUnionDesglose->usuario_id == Auth::user()->usuario_id))
                                                                                        <button type="submit" class="btn btn-success btn-md rounded pull-right" ><i class="fa fa-save"></i> Actualizar</button>
                                                                                    @else
                                                                                        <button type="button" class="btn btn-danger btn-md rounded pull-right" readonly><i class="fa fa-times"></i> Bloqueado</button> 
                                                                                    @endif
                                                                                @endif  
                                                                            </div>    
                                                                        </div>

                                                                    </div>                                                                                                       
                                                            </div>
                                                        </form>
                                                </div>
            
                                            </div>
            
                                        </div>
            
                                    </li>    
                                    
                                    <!-- ==============================
                                        DATOS DE MEJORAS
                                    ==============================-->
                                    <li class="itemSlide">
            
                                        <div class="box-group">
            
                                            <!--=====================================
                                                CAJA GESTOR 
                                            ======================================-->                  
            
                                            <div class="panel box box-info">
            
                                                <!--=====================================
                                                        CABEZA DE LA CAJA GESTOR 
                                                ======================================-->  
                                                
                                                <div class="box-header with-border">
            
                                                    <div class="row ">
                                                        <div class="col-12"> 
                                                           <span class="handle ">
                                                             <h4 class="box-title text-catastro font-weight-bold "><a  class="text-catastro collapseMejoras" data-toggle="collapse" data-target="#collapseMejoras"  href="#collapseMejoras">DATOS DE MEJORAS</a></h4> 
                                                           </span>
                                                       
                                                        </div>
                                                    </div>
              
                                                </div>
            
                                                <!--=====================================
                                                MÓDULOS COLAPSABLES
                                                ======================================-->   
                                                
                                                <div id="collapseMejoras" class="panel-collapse collapse collapseSlide" data-parent="#datosFisicos">
            
                                                         <!--=====================================
                                                                MODIFICAR NOMBRE 
                                                        ======================================-->      
           
                                                       <div class="row mt-4">
                                                            <div class="col-12">

                                                                @include('gestion.padron.mejoras.index')

                                                            </div>                                                                                                       
                                                       </div>
                                             
                                                </div>
            
                                            </div>
            
                                        </div>
            
                                    </li>    

                                      <!-- ==============================
                                        DATOS DE DIRECCIÓN
                                    ==============================-->
                                    <li class="itemSlide" id="aco2">
            
                                        <div class="box-group" id="accordion2">
            
                                            <!--=====================================
                                                CAJA GESTOR 
                                            ======================================-->                  
            
                                            <div class="panel box box-info">
            
                                                <!--=====================================
                                                        CABEZA DE LA CAJA GESTOR 
                                                ======================================-->  
                                                
                                                <div class="box-header with-border">
            
                                                    <div class="row ">
                                                        <div class="col-12"> 
                                                           <span class="handle ">
                                                             <h4 class="box-title text-catastro font-weight-bold "><a  class="text-catastro collapseDireccion" data-toggle="collapse" data-target="#collapseDireccion" href="#collapseDireccion">DATOS DE DIRECCIÓN</a></h4> 
                                                           </span>
                                                       
                                                        </div>
                                                    </div>
              
                                                </div>
            
                                                <!--=====================================
                                                MÓDULOS COLAPSABLES
                                                ======================================-->   
                                                
                                                <div id="collapseDireccion" class="panel-collapse collapse collapseSlide" data-parent="#datosFisicos">
            
                                                         <!--=====================================
                                                                MODIFICAR NOMBRE 
                                                        ======================================-->      
                                                        <div class="card">
                                                            <input type="hidden" id="direccion_id"></input>
                                                            @if ($direccion_real)
                                                                    <div class="row ml-2 mt-2 mr-2">
                                                                            <div class="col-lg-6 col-md-12">
                                                                                <div class="input-group mt-2 ">
                                                                                    <div class="input-group-addon d-md-down-none">
                                                                                        Dirección Real:
                                                                                    </div>
                                                                                    <a class="form-control  f-16 direccion_nomencla_rud_real text-primary" target="_blank" href="{{$protocol}}{{$_SERVER['SERVER_NAME']}}/{{env('RUTA_RUD')}}?direccion_nomencla={{$parcela->direccion_nomencla_rud_real}}">{{$parcela->direccion_nomencla_rud_real??'NO POSEE'}}</a>
                                                                                </div>
                                                                            </div>     
                                                                            <div class="col-lg-6 col-md-12">
                                                                                <div class="input-group mt-2 ">
                                                                                    @if($bloqueo->usuario_id != Auth::user()->usuario_id) 
                                                                                        <button type="button" class="btn btn-danger btn-md rounded pull-right" readonly><i class="fa fa-times"></i> Bloqueado</button> 
                                                                                    @else
                                                                                        @if($tempUnionDesglose == null || ($tempUnionDesglose != null && $tempUnionDesglose->usuario_id == Auth::user()->usuario_id))
                                                                                            <a href="{{$protocol}}{{$_SERVER['SERVER_NAME']}}/{{env('RUTA_RUD')}}?asignar=1&tipo_direccion=r&parcela_padron={{$parcela->parcela_padron}}&parcela_id={{$parcela->parcela_id}}" class="btn btn-primary btn-md rounded pull-right" ><i class="fa fa-edit"></i> Cambiar Dirección</a>
                                                                                        @else
                                                                                            <button type="button" class="btn btn-danger btn-md rounded pull-right" readonly><i class="fa fa-times"></i> Bloqueado</button> 
                                                                                        @endif
                                                                                    @endif
                                                                                </div>
                                                                            </div>                                                                                       
                                                                    </div>      
                                                                    <div class="row ml-2 mt-1 mr-2">
                                                                        <div class="col-lg-6 col-md-12">
                                                                            <div class="input-group mt-2 ">
                                                                                <div class="input-group-addon">
                                                                                    Calle: 
                                                                                </div>
                                                                                <span class="form-control">{{$direccion_real->direccion_calle}}</span>
                                                                            </div>
                                                                        </div> 
                                                                        <div class="col-lg-6 col-md-12">
                                                                            <div class="input-group mt-2 ">
                                                                                <div class="input-group-addon">
                                                                                    Manzana:
                                                                                </div>
                                                                                <span class="form-control">{{$direccion_real->direccion_manzana}}</span>
                                                                            </div>
                                                                        </div>                                                                                              
                                                                    </div>  
                                                                    <div class="row ml-2 mt-1 mr-2">
                                                                        <div class="col-lg-6 col-md-12">
                                                                            <div class="input-group mt-2 ">
                                                                                <div class="input-group-addon">
                                                                                    Numeración:
                                                                                </div>
                                                                                <span class="form-control">{{$direccion_real->direccion_numeracion}}</span>
                                                                            </div>
                                                                        </div>   
                                                                        <div class="col-lg-6 col-md-12">
                                                                            <div class="input-group mt-2 ">
                                                                                <div class="input-group-addon">
                                                                                    Casa:
                                                                                </div>
                                                                                <span class="form-control">{{$direccion_real->direccion_casa}}</span>
                                                                            </div>
                                                                        </div>                                                                                          
                                                                    </div>  
                                                                    <div class="row ml-2 mt-1 mr-2">
                                                                        <div class="col-lg-6 col-md-12">
                                                                            <div class="input-group mt-2 ">
                                                                                <div class="input-group-addon">
                                                                                    Barrio:
                                                                                </div>
                                                                                @if ($direccion_real->barrio_id)
                                                                                    <a class="form-control f-16 text-primary" target="_blank" href="../../cartografia?barrio_id={{$direccion_real->barrio_id}}" class="form-control">{{$direccion_real->barrio_nombre}}</a>
                                                                                @else
                                                                                    <span class="form-control">{{$direccion_real->barrio_nombre}}</a>                                                                                    
                                                                                @endif
                                                                            </div>
                                                                        </div>    
                                                                        <div class="col-lg-6 col-md-12">
                                                                            <div class="input-group mt-2 ">
                                                                                <div class="input-group-addon">
                                                                                    Local:
                                                                                </div>
                                                                                <span class="form-control">{{$direccion_real->direccion_local}}</span>
                                                                            </div>
                                                                        </div>                                                                                         
                                                                    </div>     
                                                                    <div class="row ml-2 mt-1 mr-2">
                                                                        <div class="col-lg-6 col-md-12">
                                                                            <div class="input-group mt-2 ">
                                                                                <div class="input-group-addon">
                                                                                    Provincia:
                                                                                </div>
                                                                                <span class="form-control">{{$direccion_real->provincia_nombre}}</span>
                                                                            </div>
                                                                        </div>  
                                                                        <div class="col-lg-6 col-md-12">
                                                                            <div class="input-group mt-2 ">
                                                                                <div class="input-group-addon">
                                                                                    Piso:
                                                                                </div>
                                                                                <span class="form-control">{{$direccion_real->direccion_piso}}</span>
                                                                            </div>
                                                                        </div>                                                                                           
                                                                    </div>   
                                                                    <div class="row ml-2 mt-1 mr-2">
                                                                        <div class="col-lg-6 col-md-12">
                                                                            <div class="input-group mt-2 ">
                                                                                <div class="input-group-addon">
                                                                                    Departamento:
                                                                                </div>
                                                                                <span class="form-control">{{$direccion_real->departamento_nombre}}</span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6 col-md-12">
                                                                            <div class="input-group mt-2 ">
                                                                                <div class="input-group-addon">
                                                                                    Depto:
                                                                                </div>
                                                                                <span class="form-control">{{$direccion_real->direccion_depto}}</span>
                                                                            </div>
                                                                        </div>                                                                                             
                                                                    </div>  
                                                                    <div class="row ml-2 mt-1 mr-2">
                                                                        <div class="col-lg-6 col-md-12">
                                                                            <div class="input-group mt-2 ">
                                                                                <div class="input-group-addon">
                                                                                    Distrito:
                                                                                </div>
                                                                                <span class="form-control">{{$direccion_real->distrito_nombre}}</span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6 col-md-12">
                                                                            <div class="input-group mt-2 ">
                                                                                <div class="input-group-addon">
                                                                                    Área:
                                                                                </div>
                                                                                <span class="form-control">{{$direccion_real->direccion_area}}</span>
                                                                            </div>
                                                                        </div>                                                                                             
                                                                    </div>
                                                                    <div class="row ml-2 mt-1 mr-2">
                                                                        <div class="col-lg-6 col-md-12">
                                                                            <div class="input-group mt-2 ">
                                                                                <div class="input-group-addon">
                                                                                    Código Postal:
                                                                                </div>
                                                                                <span class="form-control">{{$direccion_real->direccion_cp}}</span>
                                                                            </div>
                                                                        </div>  
                                                                        <div class="col-lg-6 col-md-12">
                                                                            <div class="input-group mt-2 ">
                                                                                <div class="input-group-addon">
                                                                                    Torre:
                                                                                </div>
                                                                                <span class="form-control">{{$direccion_real->direccion_torre}}</span>
                                                                            </div>
                                                                        </div>                                                                                           
                                                                    </div> 
                                                                    <div class="row ml-2 mt-1 mb-3 mr-2">
                                                                        <div class="col-lg-6 col-md-12">
                                                                            <div class="input-group mt-2 ">
                                                                                <div class="input-group-addon">
                                                                                    Coordenadas:
                                                                                </div>
                                                                                @if($direccion_real->urlGoogleMaps) 
                                                                                    <a class="form-control f-16 text-primary" target="_blank" href="{{$direccion_real->urlGoogleMaps}}" class="form-control">{{$direccion_real->direccion_x}} , {{$direccion_real->direccion_y}}</a>
                                                                                @else
                                                                                    <span class="form-control f-16 " target="_blank" href="{{$direccion_real->urlGoogleMaps}}" class="form-control">Sin Coordenadas</span>
                                                                                @endif
                                                                            </div>
                                                                        </div>  
                                                                        <div class="col-lg-6 col-md-12">
                                                                            <div class="input-group mt-2 ">
                                                                                <div class="input-group-addon">
                                                                                    Lote:
                                                                                </div>
                                                                                <span class="form-control">{{$direccion_real->direccion_lote}}</span>
                                                                            </div>
                                                                        </div>                                                                                           
                                                                    </div>      
                                                                   <!-- <iframe src='GoogleMaps.html?x=-32.899879455566&y=-68.78816986084' height='380' width='750'></iframe></br><font size='1' color='#820101'><img src='imgs/advertencia.png' alt='' width='10' height='10'>      --> 
                                                            @else
                                                                    @if($bloqueo->usuario_id != Auth::user()->usuario_id) 
                                                                        <div class="col-lg-12 col-md-12">
                                                                            <h6 class="text-catastro mt-3">NO SE ENCONTRARON REGISTROS </h6>
                                                                            <button type="button" class="btn btn-danger btn-md rounded pull-right mb-2"><i class="fa fa-times"></i> Bloqueado</button> 
                                                                    @else
                                                                    <div class="col-lg-6 col-md-12">
                                                                        <div class="input-group m-2 ">
                                                                                @if($tempUnionDesglose == null || ($tempUnionDesglose != null && $tempUnionDesglose->usuario_id == Auth::user()->usuario_id))
                                                                                    <a href="{{$protocol}}{{$_SERVER['SERVER_NAME']}}/{{env('RUTA_RUD')}}?asignar=1&tipo_direccion=r&parcela_padron={{$parcela->parcela_padron}}&parcela_id={{$parcela->parcela_id}}" class="btn btn-primary btn-md rounded pull-right" ><i class="fa fa-edit"></i> Agregar Dirección</a>
                                                                                @else
                                                                                    <button type="button" class="btn btn-danger btn-md rounded pull-right" readonly><i class="fa fa-times"></i> Bloqueado</button> 
                                                                                @endif
                                                                        </div>
                                                                    @endif
                                                                    </div>   
                                                            @endif                                                                   
                                                        </div>
                                             
                                                </div>
            
                                            </div>
            
                                        </div>
            
                                    </li>

                                        <!-- ==============================
                                        SERVICIOS
                                    ==============================-->
                                    <li class="itemSlide" id="aco3">
            
                                        <div class="box-group" id="accordion3">
            
                                            <!--=====================================
                                                CAJA GESTOR 
                                            ======================================-->                  
            
                                            <div class="panel box box-info">
            
                                                <!--=====================================
                                                        CABEZA DE LA CAJA GESTOR 
                                                ======================================-->  
                                                
                                                <div class="box-header with-border">
            
                                                    <div class="row ">
                                                        <div class="col-12"> 
                                                           <span class="handle ">
                                                             <h4 class="box-title text-catastro font-weight-bold "><a  class="text-catastro collapseServicios" data-toggle="collapse"  data-target="#collapseServicios" href="#collapseServicios">SERVICIOS</a></h4> 
                                                           </span>
                                                       
                                                        </div>
                                                    </div>
              
                                                </div>
            
                                                <!--=====================================
                                                MÓDULOS COLAPSABLES
                                                ======================================-->   
                                                
                                                <div id="collapseServicios" class="panel-collapse collapse collapseSlide" data-parent="#datosFisicos">
            
                                                         <!--=====================================
                                                                MODIFICAR NOMBRE 
                                                        ======================================-->      
           
                                                      
                                                        <form action="{{url('serviciosPadron')}}" method="POST" class="w-100 was-validated">
                                                            <div class="row mt-4 mr-2 mb-2">

                                                            <div class="col-md-1 col-sm-12 pr-2 text-center mt-2 ml-2">
                                                                <i class="fa fa-plus agregarServicio" style="cursor: pointer"></i> 
                                                            </div>
                                                            <div class="col-md-10 col-sm-12 m-1 p-0">
                                                                @csrf
                                                                <input type="hidden" name="parcela_id" value="{{$parcela->parcela_id}}">
                                                                
                                                                
                                                                <select class="select2bs4" multiple="multiple" data-placeholder="Listado de Servicios" name="servicios[]" >
                                                                        @foreach ($listadoServicios as $servicio)
                                                                            <option value="{{$servicio->tipo_servicio_id}}">{{$servicio->tipo_servicio_descrip}}</option>
                                                                        @endforeach
                                                                </select>
                                                                
                                                            </div> 
                                                            <div class="col-12 mb-2 mr-0 pr-0">
                                                                @if($bloqueo->usuario_id != Auth::user()->usuario_id) 
                                                                    <button type="button" class="btn btn-danger btn-md rounded pull-right" readonly><i class="fa fa-times"></i> Bloqueado</button> 
                                                                @else
                                                                    @if($tempUnionDesglose == null || ($tempUnionDesglose != null && $tempUnionDesglose->usuario_id == Auth::user()->usuario_id))
                                                                        <button type="submit" class="btn btn-success btn-md rounded pull-right" ><i class="fa fa-save"></i> Actualizar</button>
                                                                    @else
                                                                        <button type="button" class="btn btn-danger btn-md rounded pull-right" readonly><i class="fa fa-times"></i> Bloqueado</button> 
                                                                    @endif
                                                                @endif  
                                                            </div>    
                                                        </div>
                                                    </form>                                                                                              
                                             
                                                </div>
            
                                            </div>
            
                                        </div>
            
                                    </li>
                                    
                                    
                            </ul>
                        </div>
                        <div class="tab-pane fade" id="origenDestino" role="tabpanel" aria-labelledby="origenDestino-tab">
                            @include('gestion.padron.origenDestino.index')
                        </div>
                        <div class="tab-pane fade" id="dominio" role="tabpanel" aria-labelledby="dominio-tab">
                            @include('gestion.padron.dominio.index')
                        </div>
                        <div class="tab-pane fade" id="regimenes" role="tabpanel" aria-labelledby="regimenes-tab">
                            @include('gestion.padron.documentos.index')
                        </div>
                        <div class="tab-pane fade" id="tramites" role="tabpanel" aria-labelledby="tramites-tab">
                            @include('gestion.padron.tramites.index')
                        </div>
                    </div>

                </div>
                <div class="col-lg-12 col-md-12  rounded mt-2"></div>
            </div>
        </div>
    </div>
</div>

<!--=======================================
    SE COMENTA LA GRILLA DE DIRECCIONES YA QUE 
    NO SE USA EN GUAYMALLÉN (RUD)
    =======================================

<div class="modal fade" id="buscarDireccion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dark modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Buscar Direccion</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-light">×</span>
                </button>
            </div>
            
            <div class="modal-body">
                <iframe src="{{url('gestion/direccion/grillaDirecciones_parcelas?asignar='.$parcela->parcela_nomenclatura)}}" class="w-100 " style="height: 60vh;">
                </iframe>
            </div>
            
        </div>
    </div>
</div>

<form id="form-cambiarDireccion" action="{{url('cambiarDireccion')}}" method="GET" class="was-validated">
    @csrf
    <input type="hidden" id="parcela_id_direccion" name="parcela_id" value="">
    <input type="hidden" id="direccion_direccion_id" name="direccion_id" value="">
</form>

-->

@push('css')

    <link rel="stylesheet" href="{{asset('/css/librerias/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/librerias/select2.css')}}">
    <link rel="stylesheet" href="{{asset('/css/librerias/select2-bootstrap4.css')}}">
    <style>
        .select2-container{
            width: 100% !important;
        }
        .nomenclatura:hover {
            color: blue;
            cursor: copy;
            text-decoration: underline;
        }
        #popup {display:none; position:fixed; top:30%; left:50%; z-index:9999; background: rgb(150, 149, 149); font-weight: bold; padding:5px; border-radius: 3px; color:white}
    </style>

@endpush

@push('scripts')

<script src="{{asset('/js/librerias/select2.js')}}"></script>

<script>

    $(document).ready(function () {


            $(".panel-collapse").on('show.bs.collapse', function () {
                $('.panel-collapse.show').each(function(){
                        $(this).collapse('hide');         
                });
            });

        $(".ol-unselectable").css('max-width',$(".ol-viewport").width());  


            $('[data-mask]').inputmask()

            window.nomenclaArreglo =  $(".nomenclatura").val().split("-");
            window.nomenclaOrigen =  $(".nomenclatura").val();
            window.nomenclaArregloOrigen = $(".nomenclatura").val().split("-");
            window.nomenclaArregloPosicional = $(".nomenclatura").val().split("-");;
            window.tipoOrigen = $(".nomenclatura").attr("tipo");

            var contador = 1;
            var servicios = [ @foreach ($parcela->servicios() as $servicio) {{$servicio->servicio_id}}, @endforeach];
            var wkt,feature,geometrico,puntos;
            
            function dibujar(Source){
                
                highlightLayerSource.clear('');

                var format = new ol.format.WKT();
                feature = format.readFeature(wkt, { dataProjection: 'EPSG:4326',featureProjection: 'EPSG:3857'});
				geometrico = feature.getGeometry();
                puntos = geometrico.getCoordinates();

                highlightLayerSourceHover.addFeature(feature);

                var extent = highlightLayerSourceHover.getExtent();

                var centro_vector = ol.extent.getCenter(extent);//centro del vector

                map.getView().fit(extent,  map.getSize());

            }

            @if($destino->count() == 0)
                
                @if($origen->count() > 0 && $origen[0]->cubierta == 1)

                var estilo_ph = new ol.style.Style({
                                fill: new ol.style.Fill({
                                    color: 'rgb(134, 136, 144)'
                                }),
                                stroke: new ol.style.Stroke({
                                    color: 'rgb(0, 0, 0)',
                                    width: 3
                                })
                            });

                highlightLayer.setStyle(estilo_ph)      
                    var data = buscarPorNomenclatura('{{$origen[0]->parcela_nomenclatura}}');
                @else
                    var data = buscarPorNomenclatura('{{$parcela->parcela_nomenclatura}}');
                @endif
                
            @else

                @if($mejoraph)
                    var data = buscarPorNomenclatura('{{$parcela->parcela_nomenclatura}}');
                @else

                    @if($parcela->wkt != null)

                        wkt = "{{$parcela->wkt}}";
                        dibujar(highlightLayerSource);

                    @else

                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 7000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })
                        
                        Toast.fire({
                            type: 'error',
                            html: 'No se encontró registro del polígono histórico.'
                        })				

                    @endif

                @endif
  
            @endif



            map.on('singleclick', function(evt) {

                var Info = new Array();
                    Info[0] = Capas[2].getGetFeatureInfoUrl(
                    evt.coordinate, view.getResolution(), view.getProjection(), { 'INFO_FORMAT': 'application/json' });           


                    $.ajax({
                        url: Info[0],
                        jsonpCallback: 'getJson',
                        success: function(data) {
                                    
                                    if (data.features[0] != undefined) {

                                        if(data.features[0].properties.nomenc21 != null){
                                            Nom = data.features[0].properties.nomenc21.slice(0, 20);
                                            datosPoligono = data;
                                        
                                            /*=========================
                                            REMARCO LA PARCELA CLICKEADO
                                            =========================== */
                                            
                                            //dibujarPoligono(datosPoligono);
                                            datos = buscarPorNomenclatura(Nom)
                                            if(datos.parcela_id != undefined){
                                                    window.location.href = './'+datos.parcela_id;
                                            }else{
                                                const Toast = Swal.mixin({
                                                    toast: true,
                                                    position: 'top-end',
                                                    showConfirmButton: false,
                                                    timer: 7000,
                                                    timerProgressBar: true,
                                                    didOpen: (toast) => {
                                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                                    }
                                                })
                                                
                                                Toast.fire({
                                                    type: 'error',
                                                    html: 'La parcela no está asociada a un padrón.'
                                                })
                                            }
                                        }else{
                                                const Toast = Swal.mixin({
                                                    toast: true,
                                                    position: 'top-end',
                                                    showConfirmButton: false,
                                                    timer: 7000,
                                                    timerProgressBar: true,
                                                    didOpen: (toast) => {
                                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                                    }
                                                })
                                                
                                                Toast.fire({
                                                    type: 'error',
                                                    html: 'La parcela no tiene el campo nomenclatura.'
                                                })
                                        }
                                    }
                        },
                        error: function() {
                                    Swal.fire({
                                        position: 'center',
                                        type: 'error',
                                        title: 'Ocurrió un error',
                                        showConfirmButton: false,
                                        timer: 1800
                                    })
                                    
                        }

                    });

            });

           //Iniciar multiple select con los servicios
            $('.select2bs4').select2({
                        theme: 'bootstrap4'
            });
            $('.select2bs4').val(servicios).trigger('change');


            $('.agregarServicio').on("click",function(){
                if (contador % 2 == 0){
                    $('.select2bs4').trigger('click');
                }else{
                    $('.select2-selection').trigger('click');
                }
                contador++;
            });

            $(".documentosPlano").on("click",function(){
                $("#documentosPlano").toggle();
            })
            //Abrir elemento sobre el cual se estaba trabajando luego de actualizar
            @if(session('redirectElement'))
            
                $(".{{session('redirectElement')}}").click();
                window.location.href = "#{{session('redirectElement')}}";

                @php session(['redirectElement' => null]) @endphp
            @endif 
   
            //Acción que habilita la edicion de los datos generales
            $('.editarDatosGenerales').on("click",function(){
                $(this).addClass("d-none");
                $(".guardarDatosGenerales").removeClass("d-none");
                $(".cancelarEdicionDatosGenerales").removeClass("d-none");
                $(".tipo_parcela_estado").removeAttr('disabled');
                $(".tipo_parcela_ryb").removeAttr('disabled');
                $(".dig_ver").removeAttr('readonly');

                @if(Auth::user()->idrol == 1 || Auth::user()->idrol == 4)

                        $(".parcela_subparcela").removeAttr('readonly');
                        $(".coordY").removeAttr('readonly');
                        $(".coordX").removeAttr('readonly');
                        $(".parcela_padron_terr").removeAttr('readonly');
                        $(".tipo_nomenclatura").removeAttr('disabled');
                        if(tipoOrigen == 1 || tipoOrigen == 0){
                            $(".parcela_parcela").removeAttr('readonly');
                            $(".parcela_distrito").removeAttr('readonly');
                            $(".parcela_manzana").removeAttr('readonly');
                            $(".parcela_seccion").removeAttr('readonly');
                        }
                        $(".parcela_fraccion_ori").removeAttr('readonly');
                
                @endif
            })

            $('.cancelarEdicionDatosGenerales').on("click",function(){

                $(".tipo_nomenclatura").val(tipoOrigen);
                $(".tipo_nomenclatura").attr("tipo",tipoOrigen);
                $(".tipo_nomenclatura").trigger("change");

    
                if(tipoOrigen == 2){
                    $(".nomenclatura").attr("data-inputmask","'mask': 'AA-99-99-9999-999999-9999-9'")
                    $('[data-mask]').inputmask()
                    $(".parcela_distrito").val(armarNomencla(nomenclaArregloOrigen[1],2,'0',1));
                    $(".parcela_seccion").val(armarNomencla(nomenclaArregloOrigen[2],2,'0',1));
                    $(".parcela_manzana").val(armarNomencla(nomenclaArregloOrigen[3],4,'0',1));
                    $(".parcela_parcela").val(armarNomencla(nomenclaArregloOrigen[4],6,'0',1));
                    $(".parcela_subparcela").val(armarNomencla(nomenclaArregloOrigen[5],4,'0',1));
                    $(".dig_ver").val(armarNomencla(nomenclaArregloOrigen[6],1,'0',1));

                    if(nomenclaArregloOrigen[6] == "_"){
                        nomenclaArregloOrigen[6] = 0;
                    }
                    $(".nomenclatura").val(nomenclaArregloOrigen.join("-"));

                }else if(tipoOrigen == 3){
                    $(".nomenclatura").attr("data-inputmask","'mask': '99-9999999-9999999-9999-9'")
                    $('[data-mask]').inputmask()
                    $(".coordX").val(armarNomencla(nomenclaArregloOrigen[1],6,'0',1).substr(1,6));
                    $(".coordY").val(armarNomencla(nomenclaArregloOrigen[2],6,'0',1).substr(1,6));
                    $(".parcela_subparcela").val(armarNomencla(nomenclaArregloOrigen[3],4,'0',1));
                    $(".dig_ver").val(armarNomencla(nomenclaArregloOrigen[4],1,'0',1));

                    if(nomenclaArregloOrigen[4] == "_"){
                        nomenclaArregloOrigen[4] = 0;
                    }
                   
                    $(".nomenclatura").val(nomenclaArregloOrigen.join("-"));

                }else{
                    
                    $(".nomenclatura").attr("data-inputmask","'mask': '99-99-99-9999-999999-9999-9'")
                    $('[data-mask]').inputmask()
                    $(".parcela_distrito").val(armarNomencla(nomenclaArregloOrigen[1],2,'0',1));
                    $(".parcela_seccion").val(armarNomencla(nomenclaArregloOrigen[2],2,'0',1));
                    $(".parcela_manzana").val(armarNomencla(nomenclaArregloOrigen[3],4,'0',1));
                    $(".parcela_parcela").val(armarNomencla(nomenclaArregloOrigen[4],6,'0',1));
                    $(".parcela_subparcela").val(armarNomencla(nomenclaArregloOrigen[5],4,'0',1));
                    $(".dig_ver").val(armarNomencla(nomenclaArregloOrigen[6],1,'0',1));
                    if(nomenclaArregloOrigen[6] == "_"){
                        nomenclaArregloOrigen[6] = 0;
                    }
                    $(".nomenclatura").val(nomenclaArregloOrigen.join("-"));
                }

                $(this).addClass("d-none");

                $(".guardarDatosGenerales").addClass("d-none");
                $('.editarDatosGenerales').removeClass("d-none");
                $(".nomenclatura").attr('readonly','true');
                $(".parcela_padron_terr").attr('readonly','true');
                $(".coordX").attr('readonly','true');
                $(".coordY").attr('readonly','true');
                $(".parcela_distrito").attr('readonly','true');
                $(".parcela_seccion").attr('readonly','true');
                $(".parcela_manzana").attr('readonly','true');
                $(".parcela_parcela").attr('readonly','true');
                $(".parcela_fraccion_ori").attr('readonly','true');
                $(".parcela_subparcela").attr('readonly','true');
                $(".dig_ver").attr('readonly','true');
                $(".tipo_parcela_estado").val('{{$parcela->tipo_parcela_estado_id}}');
                $(".tipo_parcela_ryb").val('{{$parcela->tipo_parcela_ryb_id}}');
                
                $(".tipo_parcela_estado").attr('disabled','true');
                $(".tipo_parcela_ryb").attr('disabled','true');
     


                $(".tipo_nomenclatura").attr('disabled','true');


            });        

            //Al cambiar el tipo de nomenclatura se cambian las mascaras y validaciones
            $(".tipo_nomenclatura").on('change',function(){
                $(".nomenclatura").removeClass('bg-danger')
                $(".error-nomencla").html('');
        
                switch (this.value) {
                    case "1":
                            $(".nomenclaPosicional").addClass('d-none');
                            $(".nomenclatura").attr("data-inputmask","'mask': '99-99-99-9999-999999-9999-9'")
                            $('[data-mask]').inputmask()
                            $('.gestionarVisibilidad').removeClass("d-none")
                            $(".gestionarDimension").removeClass('col-lg-4')
                            $(".gestionarDimension").addClass('col-lg-3')
                            $(".nomenclatura").attr("tipo","1")
                            $(".parcela_distrito").removeAttr('readonly');
                            $(".parcela_seccion").removeAttr('readonly');
                            $(".parcela_manzana").removeAttr('readonly');
                            $(".parcela_parcela").removeAttr('readonly');
                            @if($origen->count() > 0 && $origen[0]->cubierta == 1)
                                $(".parcela_subparcela").removeAttr('readonly');
                            @endif
                            if(tipoOrigen !=3){
                                nomenclaArreglo = nomenclaOrigen.split("-");
                            }
                            nomenclaArreglo[0] = FIJO_DEPARTAMENTO;
                            nomenclaArreglo[1] = $(".parcela_distrito").val();
                            nomenclaArreglo[2] = $(".parcela_seccion").val();
                            nomenclaArreglo[3] = $(".parcela_manzana").val();
                            nomenclaArreglo[4] = $(".parcela_parcela").val();
                            nomenclaArreglo[5] = $(".parcela_subparcela").val();
                            nomenclaArreglo[6] = 0;
                            
                            $(".nomenclatura").val(nomenclaArreglo.join("-"));
                            $(".nomenclatura").attr('readonly','true');
                            $(".titulares-div").removeClass('col-lg-12')
                            $(".titulares-div").addClass('col-lg-6')
                           
                    break;

                    case "3":
                            
                            $(".nomenclaPosicional").removeClass('d-none');
                            $(".nomenclatura").attr("data-inputmask","'mask': '99-9999999-9999999-9999-9'")
                            $('[data-mask]').inputmask()
                            $('.gestionarVisibilidad').addClass("d-none")
                            $(".gestionarDimension").removeClass('col-lg-3')
                            $(".gestionarDimension").addClass('col-lg-4')

                            $(".titulares-div").removeClass('col-lg-6')
                            $(".titulares-div").addClass('col-lg-12')
                           

                            nomenclaArregloPosicional[0] = FIJO_DEPARTAMENTO;
                            if($(".coordX").val() == "000000" && $(".coordY").val() == "000000"){
                                nomenclaArregloPosicional[1] = FIJO_COORDENADA_X+"000000";
                                nomenclaArregloPosicional[2] = FIJO_COORDENADA_Y+"000000"; 
                            }else{
                                $(".coordX").val(armarNomencla($(".coordX").val(),6,'0',1));
                                $(".coordY").val(armarNomencla($(".coordY").val(),6,'0',1));
                                nomenclaArregloPosicional[1] = FIJO_COORDENADA_X+$(".coordX").val();
                                nomenclaArregloPosicional[2] = FIJO_COORDENADA_Y+$(".coordY").val();
                            }
                            $(".nomenclatura").attr("tipo","3")
                            nomenclaArregloPosicional[3] = armarNomencla($(".parcela_subparcela").val(),4,'0',1);
                            nomenclaArregloPosicional[4] = 0;
                            $(".nomenclatura").val(nomenclaArregloPosicional.join("-"));
                            $(".nomenclatura").attr('readonly','true');
                            $(".parcela_parcela").attr('readonly','true');
                            @if($origen->count() > 0 && $origen[0]->cubierta == 1)
                                $(".parcela_subparcela").removeAttr('readonly');
                            @endif

                    break;
                
                    default:
                            if(this.value == 2){
                                $(".nomenclatura").attr("data-inputmask","'mask': 'AA-99-99-9999-999999-9999-9'")
                                $(".parcela_distrito").attr('readonly','true');
                                $(".parcela_seccion").attr('readonly','true');
                                $(".parcela_manzana").attr('readonly','true');
                                $(".parcela_parcela").attr('readonly','true');
                            }else{
                                $(".nomenclatura").attr("data-inputmask","'mask': '99-99-99-9999-999999-9999-9'")
                                $(".parcela_parcela").removeAttr('readonly');
                            }
                            $('[data-mask]').inputmask()
                            $('.gestionarVisibilidad').removeClass("d-none")
                            

                            if(this.value == 2){
                                nomenclaArreglo[0] = FIJO_DEPARTAMENTO_PROVISORIO;
                                $(".nomenclatura").val(nomenclaArreglo.join("-"));
                            }
                            $(".gestionarDimension").removeClass('col-lg-4')
                            $(".gestionarDimension").addClass('col-lg-3')
                            $(".nomenclaPosicional").addClass('d-none');
                            $(".nomenclatura").attr("tipo",this.value);
                            $(".nomenclatura").attr('readonly','true');
                        
                            @if($origen->count() > 0 && $origen[0]->cubierta == 1)
                                $(".parcela_subparcela").removeAttr('readonly');
                            @endif
                            $(".titulares-div").removeClass('col-lg-12')
                            $(".titulares-div").addClass('col-lg-6')
                    break;
                }

            });
      

            $(".coordX").on("keyup",function(){
                nomenclaArregloPosicional[1] = FIJO_COORDENADA_X+armarNomencla($(this).val(),6,'0',1);
                $(".nomenclatura").val(nomenclaArregloPosicional.join("-"));
            });

            $(".coordY").on("keyup",function(){
                nomenclaArregloPosicional[2] = FIJO_COORDENADA_Y+armarNomencla($(this).val(),6,'0',1);
                $(".nomenclatura").val(nomenclaArregloPosicional.join("-"));
            });

            $(".parcela_parcela").on("keyup",function(){
                if($(".nomenclatura").attr('tipo') != 3){
                    nomenclaArreglo[4] = armarNomencla($(this).val(),6,'0',1);
                    $(".nomenclatura").val(nomenclaArreglo.join("-"));
                }
            });

            $(".parcela_distrito").on("keyup",function(){
                if($(".nomenclatura").attr('tipo') != 3){
                    nomenclaArreglo[1] = armarNomencla($(this).val(),2,'0',1);
                    $(".nomenclatura").val(nomenclaArreglo.join("-"));
                }
            });

            $(".parcela_seccion").on("keyup",function(){
                if($(".nomenclatura").attr('tipo') != 3){
                    nomenclaArreglo[2] = armarNomencla($(this).val(),2,'0',1);
                    $(".nomenclatura").val(nomenclaArreglo.join("-"));
                }
            });

            $(".parcela_manzana").on("keyup",function(){
                if($(".nomenclatura").attr('tipo') != 3){
                    nomenclaArreglo[3] = armarNomencla($(this).val(),2,'0',1);
                    $(".nomenclatura").val(nomenclaArreglo.join("-"));
                }
            });

            $(".parcela_subparcela").on("keyup",function(){
                
                if($(".nomenclatura").attr('tipo') != 3){
                    nomenclaArreglo[5] = armarNomencla($(this).val(),4,'0',1);
                    $(".nomenclatura").val(nomenclaArreglo.join("-"));
                }else{
                    nomenclaArregloPosicional[3] = armarNomencla($(this).val(),4,'0',1);
                    $(".nomenclatura").val(nomenclaArregloPosicional.join("-"));
                }
            });

            $(".dig_ver").on("keyup",function(){

                if($(".nomenclatura").attr('tipo') != 3){
                    nomenclaArreglo[6] = armarNomencla($(this).val(),1,'0',1);
                    $(".nomenclatura").val(nomenclaArreglo.join("-"));
                }else{
                    nomenclaArregloPosicional[4] = armarNomencla($(this).val(),1,'0',1);
                    $(".nomenclatura").val(nomenclaArregloPosicional.join("-"));
                }
                
            });


        

            if($(".nomenclatura").attr("tipo") == "3"){

                    coorX =  $(".coordX").val();
                    coorY =  $(".coordY").val();
                    dig_ver =  0;
                    $(".coordX").val(armarNomencla(coorX,6,'0',1));
                    $(".coordY").val(armarNomencla(coorY,6,'0',1));
                    nomenclaArregloPosicional[4] = dig_ver;
                    $(".nomenclatura").val(nomenclaArregloPosicional.join("-"));

            }else{

                parcela_distrito =  $(".parcela_distrito").val();
                parcela_seccion =  $(".parcela_seccion").val();
                parcela_manzana =  $(".parcela_manzana").val();
                parcela_parcela =  $(".parcela_parcela").val();
                parcela_subparcela =  $(".parcela_subparcela").val();
                dig_ver =  $(".dig_ver").val();

                $(".parcela_distrito").val(armarNomencla(parcela_distrito,2,'0',1));
                $(".parcela_seccion").val(armarNomencla(parcela_seccion,2,'0',1));
                $(".parcela_manzana").val(armarNomencla(parcela_manzana,4,'0',1));
                $(".parcela_parcela").val(armarNomencla(parcela_parcela,6,'0',1));
                $(".parcela_subparcela").val(armarNomencla(parcela_subparcela,4,'0',1));
                $(".dig_ver").val(armarNomencla(dig_ver,1,'0',1));
                nomenclaArreglo[6] = dig_ver;
                $(".nomenclatura").val(nomenclaArreglo.join("-"));

            }

            @if ($parcela->tipo_nomenclatura == 1)
                
                origen = "{{$parcela->parcela_nomenclatura}}";
                origen = origen.substring(0,20);
                nomenclatura = FIJO_DEPARTAMENTO+$(".parcela_distrito").val()+$(".parcela_seccion").val()+ $(".parcela_manzana").val()+$(".parcela_parcela").val()+$(".parcela_subparcela").val();
            
                if(origen != nomenclatura){
                    $(".nomenclatura").val( window.nomenclaOrigen)
                    Swal.fire({
                                position: 'center',
                                type: 'error',
                                title: 'Diferencia en los datos.',
                                html:'Los datos fraccionados de la nomenclatura no concuerdan con la misma.',
                                showConfirmButton: true
                        });
                }
             
            @elseif($parcela->tipo_nomenclatura == 2)    
                origen = "{{$parcela->parcela_nomenclatura}}";
                origen = origen.substring(0,20);

                nomenclatura = FIJO_DEPARTAMENTO_PROVISORIO+$(".parcela_distrito").val()+$(".parcela_seccion").val()+ $(".parcela_manzana").val()+$(".parcela_parcela").val()+$(".parcela_subparcela").val();
                if(origen != nomenclatura){
                    $(".nomenclatura").val( window.nomenclaOrigen)
                    Swal.fire({
                                position: 'center',
                                type: 'error',
                                title: 'Diferencia en los datos.',
                                html:'Los datos fraccionados de la nomenclatura no concuerdan con la misma.',
                                showConfirmButton: true
                        });
                }
             

            @elseif($parcela->tipo_nomenclatura == 3)
                
                origen = "{{$parcela->parcela_nomenclatura}}";
                origen = origen.substring(0,20);
                nomenclatura = FIJO_DEPARTAMENTO+FIJO_COORDENADA_X+$(".coordX").val()+FIJO_COORDENADA_Y+$(".coordY").val()+$(".parcela_subparcela").val();
                
                if(origen != nomenclatura){
                    $(".nomenclatura").val( window.nomenclaOrigen)
                    Swal.fire({
                                position: 'center',
                                type: 'error',
                                title: 'Diferencia en los datos.',
                                html:'Los datos fraccionados de la nomenclatura no concuerdan con la misma.',
                                showConfirmButton: true
                        });
                }
               
            @else

            $(".nomenclatura").val( window.nomenclaOrigen)
                    Swal.fire({
                                position: 'center',
                                type: 'error',
                                title: 'Tipo de nomenclatura sin definir.',
                                html:'Por favor, defina el tipo de nomenclatura.',
                                showConfirmButton: true
                        });
            @endif


        // Click direccion
        $(".redirectNomencla").on('click',function () {
            $("#datosfisicosBtn").click();
            $("#collapseDireccion").collapse("show");
        });

        //Activo imagen de fondo
        TileWMStotal[0].setVisible(true);

        // Mejoras
        $('#collapseMejoras').on('show.bs.collapse', function () {
            TileWMStotal[3].setVisible(true);
        })   
        
        $('#collapseMejoras').on('hide.bs.collapse', function () {
            TileWMStotal[3].setVisible(false);
        })       

        @if($parcela->tipo_nomenclatura == 3) 
                $('.gestionarVisibilidad').addClass("d-none");
                $(".gestionarDimension").removeClass('col-lg-3');
                $(".gestionarDimension").addClass('col-lg-4');

                $(".titulares-div").removeClass('col-lg-6');
                $(".titulares-div").addClass('col-lg-12');
        @endif


        // Cada vez que cambia el ID del hidden de la direccion, actualizo los datos
        $( "#direccion_id" ).change(function() {
            $("#direccion_direccion_id").val($("#direccion_id" ).val());
            $("#parcela_id_direccion").val($("#parcela_id" ).val());
            $( "#form-cambiarDireccion" ).submit();
        });


    });


    $('#buscarDireccion').on('show.bs.modal', function (event) {
        //console.log('modal abierto');

        var button = $(event.relatedTarget) 
        var modal = $(this)
        // modal.find('.modal-title').text('New message to ' + recipient)

    })


    $(".guardarDatosGenerales").on("click",function(e){
        
        @if($mejoraph)

            Swal.fire({
                type: 'warning',
                title: 'La parcela es una PH.',
                html: 'Recuerde que si cambió su nomenclatura, también cambiará la de sus PH',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: `Continuar`,
                denyButtonText: `Cancelar`,
                }).then((result) => {
                    console.log(result);
                /* Read more about isConfirmed, isDenied below */
                if (result.value) {
                $("#formDatosGenereles").submit();
                } else{
                    return false;
                }
            })

        @endif

        @if($origen->count() > 0 && $origen[0]->tipo_mejora_categoria_id == 10)

            if($(".parcela_subparcela").val() == "0000"){

                    Swal.fire({
                                    position: 'center',
                                    type: 'error',
                                    title: 'El atributo Sub-Parcela debe ser distinto a 0000.',
                                    html:'Por favor, defina dicho campo.',
                                    showConfirmButton: true
                    });

                    return false;
            }else{
                $("#formDatosGenereles").submit();
            }

        @elseif($destino->count() > 0)     

            if($(".parcela_subparcela").val() != "0000"){

                Swal.fire({
                                position: 'center',
                                type: 'error',
                                title: 'El atributo Sub-Parcela debe ser igual a 0000.',
                                html:'Por favor, defina dicho campo.',
                                showConfirmButton: true
                });

                return false;

            }else{
                $("#formDatosGenereles").submit();
            }
            
        @endif

        $("#formDatosGenereles").submit();
    })

    $(document).on('click','.nomenclatura',function(){

        var $temp = $("<input>");
        var text = $(this).val().replaceAll("-","");
        $("body").append($temp);
        $temp.val(text).select();
        document.execCommand("copy");
        $temp.remove();

        $('#popup').html("Nomenclatura copiada");
        $('#popup').show();

        setTimeout(() => {
        $('#popup').hide();
        }, 2000);

    })


    @if(substr($parcela->parcela_nomenclatura,16,20) != "0000" && $origen->count() == 0)

        setTimeout(() => {
            
            Swal.fire({
                type: 'warning',
                title: 'La parcela PH no tiene Origen.',
                html: '¿Desea buscar su matriz y asociarla en caso de existir?',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: `Asociar`,
                denyButtonText: `Cancelar`,
                }).then((result) => {

                if (result.value) {

                    //EN LOS METODOS POST DESDE AJAX HAY QUE ENVIAR SI O SI EL _TOKEN.
                        $.ajax({
                            type: "POST",
                            url: "{{url('asociarMatrizPH')}}",
                            data: {_token:'{{csrf_token()}}',nomenclatura:'{{$parcela->parcela_nomenclatura}}', destino:'{{$parcela->parcela_id}}'},
                            dataType: "json",
                            success: function (response) {
                                if(response.success){
                                    window.location.reload();
                                }else{
                                    Swal.fire({
                                        position: 'center',
                                        type: 'error',
                                        title: 'Matriz no encontrada',
                                        showConfirmButton: false,
                                        timer: 1800
                                    })
                                }                              
                            },error: function (response){
                                console.log(response);
                            }
                        });
                        //BUSCAR LA MATRIZ, ASOCIARLA y RECARGAR LA PAGINA EN CASO DE EXISTIR
                
                } else{
                    return false;
                }
            })
            
        }, 4000);


    @endif

</script>

                
@endpush



@endsection