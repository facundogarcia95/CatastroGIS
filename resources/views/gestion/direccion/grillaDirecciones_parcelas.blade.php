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
        </div>
        <div class="card-body">

            <table id="tablaDirecciones" class="table table-bordered table-striped dt-responsive nowrap" style="width: 100%">
                <thead>
                    <tr class="bg-dark text-light">
                        <th>  {!! TableSorter::sort('DireccionController@iframe_parcelas', 'Etiqueta RUD', 'direccion_nomencla', $sorter,10) !!}</th>
                        <th>  {!! TableSorter::sort('DireccionController@iframe_parcelas', 'Calle', 'nombre', $sorter,10) !!}</th>
                        <th>  {!! TableSorter::sort('DireccionController@iframe_parcelas', 'Numeración', 'direccion_numeracion', $sorter,10) !!}</th>
                        <th>  {!! TableSorter::sort('DireccionController@iframe_parcelas', 'Ult. Modificación', 'direccion_f_modif', $sorter,10) !!}</th>
                        <th>Estado</th>
                       <th>Asignar</th>       
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
                            <td><button type="button" class="btn btn-primary rounded text-light btn-sm" onclick="asignarDireccion('{{$direccion->direccion_nomencla}}','{{$direccion->direccion_id}}')">
                                <i class="fa fa-plus fa-1x"></i> Asignar
                            </button>                          
                            </td>
                        </tr>
                    @endforeach                   
                </tbody>
            </table>      
            {{$direcciones->appends(request()->query())->links()}}         
        </div>
    </div>

 
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

