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
                            <h2>Listado de Productos</h2><br/>
                      
                            <button class="btn btn-primary btn-lg m-2 rounded" type="button" data-toggle="modal" data-target="#abrirmodal">
                                <i class="fa fa-plus fa-2x"></i>&nbsp;&nbsp;Agregar Producto
                            </button>  
                            <a href="{{url('listarProductoPdf')}}" target="_blank">
                                <button type="button" class="btn btn-report btn-lg m-2 text-light rounded">
                                    <i class="fa fa-file fa-2x"></i>&nbsp;&nbsp;Reporte PDF
                                    
                                </button>
                            </a>
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
                            {!!Form::open(array('url'=>'producto','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!} 
                                <div class="input-group">
                                   
                                    <input type="text" name="buscarTexto" class="form-control" placeholder="Buscar texto" value="{{$buscarTexto}}">
                                    <button type="submit"  class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button> &nbsp;<a href={{url('producto')}}  class="btn btn-primary">Limpiar</a>
                                </div>
                            {{Form::close()}}
                            </div>
                        </div>
                        <table class="table-responsive table table-bordered table-striped table-sm">
                            <thead>
                                <tr class="bg-dark text-light">
                                    <th>Tipo</th>
                                    <th>Categoria</th>
                                    <th>Producto</th>
                                    <th>Codigo</th>
                                    <th>Precio Venta ($)</th>
                                    <th>Stock</th>                
                                    <th>Imagen</th>
                      
                                    <th>Editar</th>
                                    <th>Cambiar Estado</th>
                                </tr>
                            </thead>
                            <tbody>

                               @foreach($productos as $prod)
                               
                                <tr>
                                    <td><b>{{$prod->tipoProducto}}</b>
                                        @if($prod->idreceta)
                                        <br/>
                                        <a href="{{ action('RecetaController@show', ['id' => $prod->idreceta]) }}" class="btn btn-warning rounded btn-md">
                                            <i class="fa fa-eye fa-2x"></i> RECETA
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
                                            {{$prod->precio_venta}}
                                        @endif
                                       
                                    </td>
                                <td> 

                                    @if($prod->idreceta)

                                    {{round($productoControlador->stock($prod->id),2)}}  {{$prod->unidad}}<br/> (Según Insumos)

                                    @else

                                    {{$prod->stock}} {{$prod->unidad}}

                                    @endif
                                </td>

                                    <td>
                                         <img src="{{asset('storage/img/producto/'.$prod->imagen)}}" id="imagen1" alt="{{$prod->nombre}}" class="img-responsive" width="100px" height="100px">
                                    </td>
            
                            
                                    <td class="text-center">
                                        @if($prod->idreceta)
                                            <a href="{{ action('RecetaController@edit', ['id' => $prod->id]) }}" class="btn btn-info rounded btn-md">
                                                <i class="fa fa-edit fa-2x"></i> RECETA
                                            </a>
                                        @else
                                        <button type="button" class="btn rounded btn-warning btn-sm" data-id_producto="{{$prod->id}}" data-id_categoria="{{$prod->idcategoria}}" data-id_tipoproductos="{{$prod->idtipoproductos}}" data-codigo="{{$prod->codigo}}" data-stock="{{$prod->stock}}" data-nombre="{{$prod->nombre}}" data-precio_venta="{{$prod->precio_venta}}" data-unidad_medida="{{$prod->id_unidad}}"  data-toggle="modal" data-target="#abrirmodalEditar">
                                            <i class="fa fa-edit fa-2x"></i> EDITAR</button>

                                        @endif
                                        
                                      
                                    </td>

                                    
                                    <td class="text-center">

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
            <!--Inicio del modal agregar-->
            <div class="modal fade" id="abrirmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-dark modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Agregar producto</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true" class="text-light">×</span>
                            </button>
                        </div>
                       
                        <div class="modal-body">
                             

                            <form action="{{route('producto.store')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                               
                                {{csrf_field()}}
                                
                                @include('producto.form')

                            </form>
                        </div>
                        
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->


             <!--Inicio del modal actualizar-->
             <div class="modal fade" id="abrirmodalEditar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-dark modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Actualizar producto</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true" class="text-light">×</span>
                            </button>
                        </div>
                       
                        <div class="modal-body">
                             

                            <form action="{{route('producto.update','test')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                                
                                {{method_field('patch')}}
                                {{csrf_field()}}

                                <input type="hidden" id="id_producto" name="idproducto" value="">
                                
                                @include('producto.form')

                            </form>
                        </div>
                        
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->


             <!--Inicio del modal Cambiar Estado-->
             <div class="modal fade" id="cambiarEstado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Cambiar Estado del Producto</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                       
                        <div class="modal-body">
                             

                            <form action="{{route('producto.destroy','test')}}" method="post" class="form-horizontal">
                                
                                {{method_field('delete')}}
                                {{csrf_field()}}

                                <input type="hidden" id="id_producto" name="idproducto" value="">
                                
                                <p>¿Está seguro que desea cambiar el estado?</p>
        

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">Aceptar</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                </div>


                            </form>
                        </div>
                        
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->
           
           
           
            
        </main>
@push('scripts')
    <script>
        function tipoProducto(tipo) {

            if(tipo == "1"){
                window.location.href = "../receta/create";
            }
            if(tipo == "2"){
                $("#precio_venta").prop('required',true);
                $(".collapsePrecioVenta").collapse('show');
                $(".collapseDatosProducto").collapse('show'); 
            }
            if(tipo == "3"){
                $("#precio_venta").removeAttr('required');
                $(".collapsePrecioVenta").collapse('hide');
                $(".collapseDatosProducto").collapse('show'); 
            }

          }
    </script>
@endpush
@endsection