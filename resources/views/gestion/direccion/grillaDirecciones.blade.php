<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{csrf_token()}}">
    @php
      if(!isset($sorter)){
          $sorter = 'ASC';
      }  
    @endphp
 
    <link href="{{asset('css/librerias/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/librerias/simple-line-icons.min.css')}}" rel="stylesheet">
    <script src="{{asset('js/librerias/sweetalert2.all.min.js')}}"></script>
    <link href="{{asset('css/librerias/jquery-ui.css')}}" rel="stylesheet"/>
    <link href="{{asset('css/librerias/style.css')}}" rel="stylesheet">
    <link href="{{asset('css/librerias/estilos.css')}}" rel="stylesheet">
    <link href="{{asset('css/librerias/responsive.bootstrap.min.css')}}" rel="stylesheet">


    <script src="{{asset('js/librerias/bootstrap.min.js')}}"></script>
    <script>
    function asignarDireccion(direccion_nomencla, direccion_id){
        Swal.fire({
            title: '¿Desea asociar esta dirección al padrón seleccionado?',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: `Confirmar`,
            denyButtonText: `Cancelar`,
            }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.value) {
                console.log(result);
                // Cierro modal
                window.parent.$('#buscarDireccion').modal('hide');
                // Asigno ID 
                window.parent.$('#direccion_id').val(direccion_id);
                // Tengo que disparar el evento de change porque en los hidden no se dispara solo
                window.parent.$('#direccion_id').trigger('change');
                // Asigno Denominacion (solo visual) 
                window.parent.$('.direccion_nomencla_rud_real').text(direccion_nomencla);
                //Swal.fire('Saved!', '', 'success') 
                //window.parent.location.reload(false);              
            } else {
                //Swal.fire('Changes are not saved', '', 'info')
                console.log("Error swal fire");
            }
        })
    }
    </script>
</head>

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
            <h2>Módulo de Direcciones</h2><br/>
            <button class="btn btn-primary btn-lg rounded" type="button" data-toggle="modal" data-target="#abrirmodalDireccion">
                    <i class="fa fa-plus"></i>&nbsp;&nbsp;Agregar Dirección
            </button>     
        </div>
        <div class="card-body">
            <div class="form-group row">
                <div class="col-md-6">                         
                        <form action="{{url('gestion/direcciones')}}" method="get" class="was-validated">  
                        <div class="input-group">       
                            <input type="text" id="buscarTexto" name="buscarTexto" class="form-control" placeholder="Buscar texto" value="@if (isset($busqueda)) {{$busqueda}} @endif">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Buscador</button>                       
                            <a  class="btn btn-primary ml-1 limpiar" href="{{url('gestion/direcciones')}}"><i class="fa fa-trash"></i> Limpiar</a>                       
                            </div>           
                    </form>
                </div>
            </div>
            <table id="tablaDirecciones" class="table table-bordered table-striped dt-responsive nowrap" style="width: 100%">
                <thead>
                    <tr class="bg-dark text-light">
                        <th>  {!! TableSorter::sort('DireccionController@index', 'Etiqueta RUD', 'direccion_nomencla', $sorter,10) !!}</th>
                        <th>  {!! TableSorter::sort('DireccionController@index', 'Calle', 'nombre', $sorter,10) !!}</th>
                        <th>  {!! TableSorter::sort('DireccionController@index', 'Numeración', 'direccion_numeracion', $sorter,10) !!}</th>
                        <th>  {!! TableSorter::sort('DireccionController@index', 'Ult. Modificación', 'direccion_f_modif', $sorter,10) !!}</th>
                        <th>Estado</th>
                        <th>Editar</th>      
                    </tr>
                </thead>
                <tbody>
                    @foreach($direcciones as $direccion)
                        <tr>
                            <td>{{$direccion->direccion_nomencla}}</td>
                            @if ($direccion->calle_id && $direccion->departamento_id == env('DEPARTAMENTO_ID'))
                                <td><a href="./../cartografia?eje_id={{$direccion->calle_id}}" target="_blank">{{$direccion->nombre}}</a></td>
                            @else                                
                                <td>
                                    <span>{{$direccion->nombre}}</span>
                                    @if($direccion->nombre != null && !$direccion->calle_id)
                                        <span class="tooltip">
                                            <i class="fa fa-exclamation-triangle text-warning" aria-hidden="true"></i>
                                            <span class="tooltiptext">NO HOMOLOGADA</span>
                                        </span>
                                    @endif
                                </td>
                            @endif
                            <td>{{$direccion->direccion_numeracion}}</td>
                             <td>{{Carbon\Carbon::parse($direccion->direccion_f_modif)->diffForHumans()}}</td> 
                            @if ($direccion->tipo_estado_id == 1)
                                <td><label class="text-success"><i class="fa fa-check "></i>{{$direccion->tipo_estado_descrip}}</label></td>
                            @else
                                <td><label class="text-danger ">
                                    <i class="fa fa-check "></i> {{$direccion->tipo_estado_descrip}}
                                </label></td>
                            @endif
                            <td>
                                <button type="button" class="btn btn-warning rounded text-light btn-sm" 
                                    data-direccion_nomencla="{{$direccion->direccion_nomencla}}"
                                    data-direccion_id="{{$direccion->direccion_id}}"
                                    data-calle_id="{{$direccion->calle_id}}"
                                    data-ejes_mendoza="{{$direccion->nombre}}"
                                    data-direccion_numeracion="{{$direccion->direccion_numeracion}}"
                                    data-barrio_id="{{$direccion->barrio_id}}"
                                    data-barrio_nombre="{{$direccion->nombre_de_barrio}}"
                                    data-direccion_manzana="{{$direccion->direccion_manzana}}"
                                    data-direccion_casa="{{$direccion->direccion_casa}}"
                                    data-direccion_local="{{$direccion->direccion_local}}"
                                    data-direccion_piso="{{$direccion->direccion_piso}}"
                                    data-direccion_depto="{{$direccion->direccion_depto}}"
                                    data-direccion_area="{{$direccion->direccion_area}}"
                                    data-direccion_torre="{{$direccion->direccion_torre}}"
                                    data-direccion_lote="{{$direccion->direccion_lote}}"
                                    data-direccion_cp="{{$direccion->direccion_cp}}"
                                    data-direccion_observ="{{$direccion->direccion_observ}}"
                                    data-provincia_id="{{$direccion->provincia_id}}"
                                    data-departamento_id="{{$direccion->departamento_id}}"
                                    data-distrito_id="{{$direccion->distrito_id}}"
                                    data-toggle="modal" 
                                    data-target="#editarDireccion">
                                        <i class="fa fa-edit fa-2x"></i> Editar
                                </button> 
                            </td>
                        </tr>
                    @endforeach                   
                </tbody>
            </table>      
            {{$direcciones->appends(request()->query())->links()}}         
        </div>
    </div>

    <!-- Fin ejemplo de tabla Listado -->
                   <!--Inicio del modal agregar-->
                   <div class="modal fade" id="abrirmodalDireccion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-dark modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Agregar Dirección</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true" class="text-light">×</span>
                                </button>
                            </div>
                           
                            <div class="modal-body">
                                
                                <form action="{{route('direccion.store','test')}}" method="post" class="form-horizontal was-validated" enctype="multipart/form-data">
                                    {{method_field('post')}}
                                    {{csrf_field()}}
                                    <input type="hidden" id="direccion_id" name="direccion_id" value="">
                                    @include('gestion.direccion.form')
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
                 <div class="modal fade" id="editarDireccion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-dark modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Actualizar Dirección @if (isset($direccion))
                                    - {{$direccion->direccion_nomencla}}
                                @endif</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true" class="text-light">×</span>
                                </button>
                            </div>                           
                            <div class="modal-body">    

                                <form action="{{route('direccion.update','test')}}" method="post" class="form-horizontal was-validated" enctype="multipart/form-data">
                                    {{method_field('patch')}}
                                    {{csrf_field()}}
                                    <input type="hidden" id="direccion_id" name="direccion_id" value="">
                                    @include('gestion.direccion.form')
                                </form>

                            </div>                            
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!--Fin del modal-->
</div>



@push('css')

   <style>
      .tooltip {
         position: relative;
         display: inline-block;
         }

         .tooltip .tooltiptext {
         visibility: hidden;
         width: 150px;
         background-color: black;
         color: #fff;
         text-align: center;
         border-radius: 5px;
         margin: 6px;

         /* Position the tooltip */
         position: absolute;
         z-index: 1;
         }

         .tooltip:hover .tooltiptext {
         visibility: visible;
         }

   </style>
@endpush

@push('scripts')
    <script>

        $(document).ready(function () {
            $("#provincia_id").change();
        });

        /*INICIO ventana modal para cambiar el estado*/                
        $('#abrirmodalDireccion').on('show.bs.modal', function (event) {

            var button = $(event.relatedTarget) 
            var direccion_id = button.data('direccion_id')
            var direccion_nomencla = button.data('direccion_nomencla')
            var calle_id = button.data('calle_id')
            var ejes_mendoza = button.data('ejes_mendoza')
            var direccion_numeracion = button.data('direccion_numeracion')
            var barrio_id = button.data('barrio_id')
            var barrio_nombre = button.data('barrio_nombre')
            var direccion_manzana = button.data('direccion_manzana')
            var direccion_casa = button.data('direccion_casa')
            var direccion_local = button.data('direccion_local')
            var direccion_piso = button.data('direccion_piso')
            var direccion_depto = button.data('direccion_depto')
            var direccion_area = button.data('direccion_area')
            var direccion_torre = button.data('direccion_torre')
            var direccion_lote = button.data('direccion_lote')
            var direccion_cp = button.data('direccion_cp')
            var direccion_observ = button.data('direccion_observ')
            var modal = $(this)
            // modal.find('.modal-title').text('New message to ' + recipient)
            modal.find('.modal-body #direccion_id').val(direccion_id);
            modal.find('.modal-body #direccion_nomencla').val(direccion_nomencla);
            modal.find('.modal-body #calle_id').val(calle_id);
            modal.find('.modal-body #ejes_mendoza').val(ejes_mendoza);
            modal.find('.modal-body #direccion_numeracion').val(direccion_numeracion);
            modal.find('.modal-body #barrio_id').val(barrio_id);
            modal.find('.modal-body #barrio_nombre').val(barrio_nombre);
            modal.find('.modal-body #direccion_manzana').val(direccion_manzana);
            modal.find('.modal-body #direccion_casa').val(direccion_casa);
            modal.find('.modal-body #direccion_local').val(direccion_local);
            modal.find('.modal-body #direccion_piso').val(direccion_piso);
            modal.find('.modal-body #direccion_depto').val(direccion_depto);
            modal.find('.modal-body #direccion_area').val(direccion_area);
            modal.find('.modal-body #direccion_torre').val(direccion_torre);
            modal.find('.modal-body #direccion_lote').val(direccion_lote);
            modal.find('.modal-body #direccion_cp').val(direccion_cp);
            modal.find('.modal-body #direccion_observ').val(direccion_observ);
        })        
        /*FIN ventana modal para cambiar estado*/


        //-----------------------------------------
        //FUNCIONALIDAD PARA CAMBIAR LOS DEPARTAMENTES/ DISTRITOS SEGUN EL SELECT PADRE
        //-----------------------------------------


     

    </script>
    
    

@endpush