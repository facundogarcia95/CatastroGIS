@extends('principal')
@section('contenido')
<main class="main">
         @include('breadcrumb.bread')
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <div class="col-sm-12 mt-4">
                            <h2>Listado de Categorías</h2><br/>
                        
                            <button class="btn btn-primary btn-lg rounded" type="button" data-toggle="modal" data-target="#abrirmodal">
                                <i class="fa fa-plus fa-2x"></i>&nbsp;&nbsp;Agregar Categoría
                            </button>
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
                            {!!Form::open(array('url'=>'categoria','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!} 
                                <div class="input-group">
                                   
                                    <input type="text" name="buscarTexto" class="form-control" placeholder="Buscar texto..." value="{{$buscarTexto}}">
                                    <button type="submit"  class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                <a href="{{url('categoria')}}" class="btn btn-primary ml-2"> Limpiar</a>

                                </div>
                            {{Form::close()}}
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm table-responsive">
                            <thead>
                                <tr class="bg-dark text-light">
                                   
                                    <th>Categoría</th>
                                    <th>Descripción</th>
                                    <th>Estado</th>
                                    <th>Editar</th>
                                    <th>Cambiar Estado</th>
                                </tr>
                            </thead>
                            <tbody>

                               @foreach($categorias as $cat)
                               
                                <tr>
                                    
                                    <td>{{$cat->nombre}}</td>
                                    <td>{{$cat->descripcion}}</td>
                                    <td>

                                      @if($cat->condicion=="1")

                                        <label class="text-success">
                                    
                                          <i class="fa fa-check fa-2x"></i> Activo
                                        </label>

                                      @else
                                         <label class="text-danger">
                                    
                                         <i class="fa fa-times fa-2x"></i> Desactivado
                                         </label>

                                      @endif
                                        
                                       
                                    </td>

                                    <td>
                                        <button type="button" class="btn btn-warning rounded btn-sm" data-id_categoria="{{$cat->id}}" data-nombre="{{$cat->nombre}}" data-descripcion="{{$cat->descripcion}}" data-toggle="modal" data-target="#abrirmodalEditarCat">

                                          <i class="fa fa-edit fa-2x"></i> Editar
                                        </button> &nbsp;
                                    </td>

                                    <td>

                                        
                                        @if($cat->condicion)

                                        <button type="button" class="btn btn-danger rounded btn-sm" data-id_categoria="{{$cat->id}}" data-toggle="modal" data-target="#cambiarEstado">
                                            <i class="fa fa-times fa-2x"></i> Desactivar
                                        </button>

                                        @else

                                        <button type="button" class="btn btn-success rounded btn-sm" data-id_categoria="{{$cat->id}}" data-toggle="modal" data-target="#cambiarEstado">
                                            <i class="fa fa-check fa-2x"></i> Activar
                                        </button>

                                        @endif
                                       
                                    </td>
                                </tr>

                                @endforeach
                               
                            </tbody>
                        </table>
                            
                            {{$categorias->render()}}

                    </div>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
            <!--Inicio del modal agregar-->
            <div class="modal fade" id="abrirmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-dark modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Agregar categoría</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true" class="text-light">×</span>
                            </button>
                        </div>
                       
                        <div class="modal-body">
                             

                            <form action="{{route('categoria.store')}}" method="post" class="form-horizontal">
                               
                                {{csrf_field()}}
                                
                                @include('categoria.form')

                            </form>
                        </div>
                        
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->


             <!--Inicio del modal actualizar-->
             <div class="modal fade" id="abrirmodalEditarCat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-dark modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Actualizar categoría</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true" class="text-light">×</span>
                            </button>
                        </div>
                       
                        <div class="modal-body">
                             

                            <form action="{{route('categoria.update','test')}}" method="post" class="form-horizontal">
                                
                                {{method_field('patch')}}
                                {{csrf_field()}}

                                <input type="hidden" id="id_categoria" name="id_categoria" value="">
                                
                                @include('categoria.form')

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
                <div class="modal-dialog modal-dark modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Cambiar Estado de la Categoría</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true" class="text-light">×</span>
                            </button>
                        </div>
                       
                        <div class="modal-body">
                             

                            <form action="{{route('categoria.destroy','test')}}" method="post" class="form-horizontal">
                                
                                {{method_field('delete')}}
                                {{csrf_field()}}

                                <input type="hidden" id="id_categoria" name="id_categoria" value="">
                                
                                <p>¿Está seguro que desea cambiar el estado?</p>
        

                                <div class="modal-footer">
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
           
           
           
            
        </main>

@endsection