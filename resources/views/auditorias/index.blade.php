@extends('principal')
@section('breadcrumb')
    {{ Breadcrumbs::render('auditorias') }}
@endsection
@section('contenido')

<div class="container-fluid mt-6">
    <!-- Ejemplo de tabla Listado -->
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


           <h2>Auditorias</h2><br/>
            
        </div>
        <div class="card-body">
            <div class="form-group row">
                <div class="col-md-12">
                    <form method="GET" id="form-busqueda" action="{{action('AuditoriaController@index')}}" class="was-validated">
                                                
                        <div class="pull-left pb-2">
                            <div class="input-group d-none mostrarAuditorias">
                                @if(app('request')->input('relevantes') == 1)
                                <input type="checkbox" data-toggle="toggle" data-on="OCULTAR ACCESOS" data-off="MOSTRAR TODAS" data-onstyle="success rounded font-weight-bold font-btn "  data-offstyle="info text-light font-weight-bold rounded font-btn">    
                                @else
                                <input type="checkbox" data-toggle="toggle" data-on="OCULTAR ACCESOS" data-off="MOSTRAR TODAS" data-onstyle="success rounded font-weight-bold font-btn "  data-offstyle="info text-light font-weight-bold rounded font-btn" checked >
                                @endif
                                <input type="hidden" id="relevantes" name="relevantes" value="{{app('request')->input('relevantes')??0}}" >
                            </div>
                        </div>

                        <div class="input-group pb-2">
                            <span class="btn bg-catastro text-light"> Padrón</span>
                            <input type="textbox" name="padron" class="form-control" placeholder="Buscar padrón" value="{{app('request')->input('padron')}}" >
                            <button  class="btn bg-catastro text-light"> Desde</button>
                            <input type="date" name="fechaDesde" class="form-control" placeholder="Buscar Fecha" value="{{app('request')->input('fechaDesde')}}" >
                            <button  class="btn bg-catastro text-light"> Hasta</button>
                            <input type="date" name="fechaHasta" class="form-control" placeholder="Buscar Fecha" value="{{app('request')->input('fechaHasta')}}" >
                        </div> 
                        <div class="input-group pb-2">
                            <span class="btn bg-catastro text-light"> Usuario</span>
                            <select class="form-control"   name="usuarios"> 
                                <option value="">Seleccionar..</option>
                                @foreach ($usuarios as $usuario)
                                    <option @if($usuario->usuario_id == app('request')->input('usuarios') ) selected @endif value="{{$usuario->usuario_id}}" >
                                        {{$usuario->usuario_nombre}}
                                    </option>
                                @endforeach
                            </select>

                            <span class="btn bg-catastro text-light"> Tipo</span>
                            <select class="form-control"   name="tipo"> 
                                <option value="">Seleccionar..</option>
                                @foreach ($tipos as $tipo)
                                    <option @if($tipo->aud_tip_id == app('request')->input('tipo') ) selected @endif value="{{$tipo->aud_tip_id}}" >
                                        {{$tipo->aud_tip_descripcion}}
                                    </option>
                                @endforeach
                            </select>

                            <button class="tn btn-primary ml-1"><i class="fa fa-search" disabled></i> Buscar</button>
                            <div class="tn btn-primary ml-1">
                                <a href="./auditorias" class="btn btn-md text-light text-light ">
                                    <i class="fa fa-trash"></i> Limpiar
                                </a>
                            </div>
                        </div> 
                       
                       

                    </form>   
           
                </div>

    
            </div>
    
            <table id="tablaAuditorias" class="table table-bordered table-striped table-responsive dt-responsive" style="width: 100% !important">
                <thead>
                    <tr class="bg-dark text-light">
                       
                        <th>Fecha</th>
                        <th>Descripcion</th>
                        <th>Usuario</th>
                        <th>Host</th>
                        <th>Accion</th>
                        <th>Tabla</th>
                        <th>Registro ID</th>
                        <th>Script</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($auditorias as $auditoria)
                    <tr>
                        <td >
                            
                            @if ($auditoria->auditoria_detalle_old || $auditoria->auditoria_detalle_new)
                                <span >{{$auditoria->auditoria_fecha}}</span> <i class="fa fa-plus text-primary" style="cursor:pointer;" data-toggle="modal" data-target="#modalAuditoria{{$auditoria->auditoria_id}}"></i>
                            @else
                                {{$auditoria->auditoria_fecha}}
                            @endif
                            
                            @if ($auditoria->auditoria_detalle_old || $auditoria->auditoria_detalle_new)

                                <div class="modal fade" id="modalAuditoria{{$auditoria->auditoria_id}}" tabindex="-1" role="dialog" aria-labelledby="modalAuditoria" aria-hidden="true">
                                    <div class="modal-dialog modal-dark modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-catastro">
                                                <h4 class="modal-title">Detalle de auditoria</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true" class="text-light">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                @if ($auditoria->auditoria_detalle_old)
                                                    <div class="@if($auditoria->auditoria_detalle_new) col-sm-6 @else col-sm-12 @endif pull-left">
                                                        <h6 class="text-catastro"><b>@if($auditoria->auditoria_detalle_new) VALOR ANTERIOR: @else VALOR ELIMINADO: @endif</b></h6>
                                                            @foreach (json_decode($auditoria->auditoria_detalle_old) as $key => $value)
                                                                <div class="input-group mt-2 ">
                                                                    <div class="input-group-addon">
                                                                        <b>{{$key}}</b>
                                                                    </div>
                                                                    <label class="form-control @php if($auditoria->auditoria_detalle_new){ if(json_decode($auditoria->auditoria_detalle_old)->$key != json_decode($auditoria->auditoria_detalle_new)->$key) echo "bg-danger text-light"; } @endphp">{{$value}}</label>
                                                                </div>
                                                            @endforeach
                                                    </div>              
                                               @endif

                                               @if($auditoria->auditoria_detalle_new)

                                               @if ($auditoria->auditoria_detalle_old)
                                               <div class="col-sm-6 pull-right">
                                                   @else
                                                   <div class="col-sm-12">
                                                       @endif
                                                       <h6 class="text-catastro"><b>VALOR NUEVO:</b></h6>
                                                            @foreach (json_decode($auditoria->auditoria_detalle_new) as $key => $value)
                                                                <div class="input-group mt-2 ">
                                                                    <div class="input-group-addon">
                                                                        <b>{{$key}}</b>
                                                                    </div>
                                                                    @if ($auditoria->auditoria_detalle_old)
                                                                    <label class="form-control @php if(json_decode($auditoria->auditoria_detalle_old)->$key != json_decode($auditoria->auditoria_detalle_new)->$key) echo "bg-success text-light"; @endphp">{{$value}}</label>
                                                                    @else
                                                                        <label class="form-control">{{$value}}</label>
                                                                    @endif
                                                                   
                                                                </div>
                                                            @endforeach
                                                                
                                                        </div>            
                                                    @endif
                                                  
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary rounded" data-dismiss="modal">Cerrar</button>
                                            </div>
                                       </div>
                                    </div>
                                </div>

                            @endif                                
                        </td>
                        <td>{{$auditoria->auditoria_descripcion}}</td>
                       
                        @if( $auditoria->usuario )
                            <td>{{$auditoria->usuario->usuario_nombre}}</td>                           
                        @else
                           <td></td>
                        @endif 
                        <td>{{$auditoria->auditoria_host}}</td>                        
                        <td>{{$auditoria->tipos->aud_tip_descripcion}}</td>                           
                        <td>{{$auditoria->auditoria_tabla}}</td>
                        @if ($auditoria->auditoria_tabla == "parcelas")
                            <td><a target="_blank" href="./gestion/padron/{{$auditoria->auditoria_registro_id}}">{{$auditoria->auditoria_registro_id}}</a></td>
                        @else
                            <td>{{$auditoria->auditoria_registro_id}}</td>
                        @endif
                        <td>{{$auditoria->auditoria_script}}</td>
                    </tr>
                    
                    @endforeach   
                </tbody>
            </table>
                
            {{$auditorias->appends(request()->query())->links()}} <label class="pull-right font-weight-bold">Total de Auditorias: {{$auditorias->total()}} </label>  

         
        </div>
    </div>




</div>

@push('scripts')
     
    <script>

          $(document).on("click.bs.toggle", "div[data-toggle^=toggle]", function (t) {

            if($(this).find("input[type=checkbox]").prop("checked")){
                $("#relevantes").attr("value",1);
                $("#form-busqueda").submit();
            }else{
                $("#relevantes").attr("value",0);
                $("#form-busqueda").submit();
            }

          });

          $(document).ready(function () {
              $(".mostrarAuditorias").removeClass('d-none');
          });
    </script>
     <script src="{{asset('js/librerias/toggle.js')}}"></script>

@endpush

@push('css')

<style>
    .dataTables_length{
        display: none;
    }
    .dataTables_paginate{
        display: none;
    }
    .dataTables_info{
        display: none;
    }
</style>
<link href="{{asset('css/librerias/toggle.css')}}" rel="stylesheet"/>

@endpush


@endsection