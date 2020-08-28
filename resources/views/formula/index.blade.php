@extends('principal')
@section('contenido')
@inject('productoControlador', 'App\Http\Controllers\ProductoController')
@inject('recetaControlador', 'App\Http\Controllers\RecetaController')

<main class="main">
            @include('breadcrumb.bread')
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">

                        <div class="col-sm-12">
                            <h2>Listado de Fórmulas</h2><br/>
                      
                            <a href="{{url('receta/create')}}" style="text-decoration: none" target="_blank">
                                <button class="btn btn-primary btn-lg m-2 rounded" type="button" data-toggle="modal" data-target="#abrirmodal">
                                    <i class="fa fa-plus fa-2x"></i>&nbsp;&nbsp;Agregar Fórmula
                                </button>  
                            </a>
                            <a href="{{url('listarFormulaPdf')}}" style="text-decoration: none" target="_blank">
                                <button type="button" class="btn btn-report btn-lg m-2 text-light rounded">
                                    <i class="fa fa-file fa-2x"></i>&nbsp;&nbsp;Reporte PDF
                                    
                                </button>
                            </a>
                            @if($condicionProducto == 1)
                                <input type="checkbox" checked id="tipo_condicion" data-toggle="toggle" data-on="Fórmulas Activas" data-off="Fórmulas Inactivas" data-onstyle="success rounded font-btn my-3" data-offstyle="danger rounded font-btn my-3" >                    
                            @else
                                <input type="checkbox" checked id="tipo_condicion" data-toggle="toggle" data-on="Fórmulas Inactivas" data-off="Fórmulas Activas" data-onstyle="danger rounded font-btn my-3" data-offstyle="success rounded font-btn my-3" >                    
                            @endif
                         
                           
                        </div>
                        <div class="col-sm-12 mt-4">
                            @if ( session('mensaje') )
                                <div class="alert alert-success" role="alert">{{ session('mensaje') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>
                            @endif
                            @if ( session('error') )
                                <div class="alert alert-danger" role="alert">{{ session('error') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>
                            @endif
                        </div>
                        
                    </div>

                    <div class="card-body">
                        <div class="form-group row">
                         
                            <div class="col-md-6">
                            {!!Form::open(array('url'=>'formula','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!} 
                                <div class="input-group">
                                    
                                    <input type="text" name="buscarTexto" class="form-control" placeholder="Buscar texto" value="{{$buscarTexto}}">
                                    <button type="submit"  class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button> &nbsp;<a href={{url('formula')}}  class="btn btn-primary">Limpiar</a>
                                </div>
                            {{Form::close()}}
                            </div>
                            
                        </div>
                        <table class="table-responsive table table-bordered table-striped table-sm">
                            <thead>
                                <tr class="bg-dark text-light">
                                    <th>
                                         <a href="#" class="cabeceraTabla text-light" campo="tipo_producto" ></a>                             
                                    </th>
                                    <th>
                                        <a href="#" class="cabeceraTabla text-light" campo="idcategoria" >Categoria</a>                             
                                    </th>
                                    <th>  
                                        <a href="#" class="cabeceraTabla text-light" campo="nombre" >Producto</a>                             
                                    </th>
                                    <th>  
                                        <a href="#" class="cabeceraTabla text-light" campo="codigo" >Codigo</a>                            
                                    </th>
                                    <th>
                                        <a href="#" class="cabeceraTabla text-light" campo="precio_venta" >Precio Venta</a>                            
                                    </th>
                                    <th>
                                        Precio Costo
                                    </th>
                                    <th>
                                        <a href="#" class="cabeceraTabla text-light" campo="stock" >Stock</a>                            
                                    </th>                
                                    <th>Imagen</th>
                      
                                    <th>Editar</th>
                                    <th>
                                        <a href="#" class="cabeceraTabla text-light" campo="condicion" >Estado</a>                            
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                               @foreach($productos as $prod)
                               
                                <tr>
                                    <td>
                                        @if($prod->idreceta)
                                        <a style="text-decoration:none" href="{{ action('RecetaController@show', ['id' => $prod->idreceta]) }}" class="btn btn-detalle text-light rounded btn-sm">
                                            <i class="fa fa-eye "></i> VER FÓRMULA
                                        </a>
                                        @endif
                                    </td>
                                   <td>{{$prod->categoria}}</td>
                                    <td>{{$prod->nombre}}</td>
                                    <td>{{$prod->codigo}}</td>
                                    <td>
                                        @if ($prod->precio_venta == 0)
                                            SIN PRECIO
                                        @else
                                            ${{round($prod->precio_venta,2)}}
                                        @endif
                                       
                                    </td>
                                    <td>
                                        @if ($prod->costo == null)
                                            SIN PRECIO
                                        @else
                                            
                                            ${{round($prod->costo,2)}}
                                        @endif
                                       
                                    </td>
                                <td> 

                                    @if($prod->idreceta)

                                    {{round($prod->stock,2)}}  {{$prod->unidad}}<br/> (Según Insumos)

                                    @else

                                    {{round($prod->stock,2)}} {{$prod->unidad}}

                                    @endif
                                </td>

                                    <td>
                                         <img src="{{asset('storage/img/producto/'.$prod->imagen)}}" id="imagen1" alt="{{$prod->nombre}}" class="img-responsive" width="100px" height="100px">
                                    </td>
            
                            
                                    <td class="">
                                        @if($prod->idreceta)
                                            <a href="{{ action('RecetaController@edit', ['id' => $prod->id]) }}" class="btn btn-warning rounded btn-sm">
                                                <i class="fa fa-edit fa-2x"></i> EDITAR
                                            </a>
                                        @else
                                        <button type="button" class="btn rounded btn-warning btn-sm" data-id_producto="{{$prod->id}}" data-id_categoria="{{$prod->idcategoria}}" data-id_tipoproductos="{{$prod->idtipoproductos}}" data-codigo="{{$prod->codigo}}" data-stock="{{$prod->stock}}" data-nombre="{{$prod->nombre}}" data-precio_venta="{{$prod->precio_venta}}" data-unidad_medida="{{$prod->id_unidad}}"  data-toggle="modal" data-target="#abrirmodalEditar">
                                            <i class="fa fa-edit fa-2x"></i> EDITAR</button>

                                        @endif
                                        
                                      
                                    </td>

                                    
                                    <td class="">

                                       @if($prod->condicion)

                                        <button type="button" class="btn btn-danger rounded btn-sm" data-id_producto="{{$prod->id}}" data-toggle="modal" data-target="#cambiarEstado">
                                            <i class="fa fa-times fa-2x"></i> DESACTIVAR
                                        </button>

                                        @else

                                         <button type="button" class="btn btn-success rounded btn-sm" data-id_producto="{{$prod->id}}" data-toggle="modal" data-target="#cambiarEstado">
                                            <i class="fa fa-check fa-2x "></i> ACTIVAR
                                        </button>

                                        @endif
                                       
                                    </td>
                                </tr>

                                @endforeach
                               
                            </tbody>
                        </table>
                            
                            {{$productos->render()}}

                    </div>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>





             <!--Inicio del modal Cambiar Estado-->
             <div class="modal fade" id="cambiarEstado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-dark modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Cambiar Estado del Producto</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true" class="text-light">×</span>
                            </button>
                        </div>
                       
                        <div class="modal-body">
                             

                            <form action="{{route('formula.destroy','test')}}" method="post" class="form-horizontal">
                                
                                {{method_field('delete')}}
                                {{csrf_field()}}

                                <input type="hidden" id="id_producto" name="idproducto" value="">
                                
                                <p>¿Está seguro que desea cambiar el estado?</p>
        

                                <div class="modal-footer" >
                                    <button type="submit" class="btn btn-success rounded">Aceptar</button>
                                    <button type="button" class="btn btn-danger rounded" data-dismiss="modal">Cerrar</button>
                                </div>


                            </form>
                        </div>
                        
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->
           
            <!-- FORMULARIO PARA SORTER TABLA-->
            {!!Form::open(array('url'=>'formula','method'=>'GET','id'=>'orderTipo','autocomplete'=>'off','role'=>'search'))!!} 
                    <input type="hidden" id="orderBy" name="orderby" value="">
                    <input type="hidden" name="page" value="{{$page}}">
                    <input type="hidden" name="orden" value="{{$orden}}">
            {{Form::close()}}

            <!-- FORMULARIO CONDICION PRODUCTO-->
            {!!Form::open(array('url'=>'formula','id'=>'filtrar_condicion','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}                                      
                <input type="hidden" name="condicionProducto" id="condicionProducto" value="{{$condicionProducto}}">    
            {{Form::close()}}
            
        </main>
@push('scripts')
    <script>


        $(".cabeceraTabla").on("click",function(){
            var campoClick = $(this).attr('campo');
            $("#orderBy").val(campoClick);
            $("#orderTipo").submit();

        });

        $("#tipo_condicion").on("change",function(){
            setInterval(() => {
                
                @if($condicionProducto == 1)

                if($(this).prop('checked')){
                    $("#condicionProducto").val(1)
                    $("#filtrar_condicion").submit();

                }else{
                    $("#condicionProducto").val(0)
                    $("#filtrar_condicion").submit();
                    
                }

            @else
                
                if($(this).prop('checked')){
                    $("#condicionProducto").val(0)
                    $("#filtrar_condicion").submit();

                }else{
                    $("#condicionProducto").val(1)
                        $("#filtrar_condicion").submit();
                    
                }

            @endif

            }, 600);
            
        })


    </script>


<script src="{{asset('js/toggle.js')}}"></script>

@endpush

@push('css')

    <link href="{{asset('css/toggle.css')}}" rel="stylesheet"/>

@endpush

@endsection