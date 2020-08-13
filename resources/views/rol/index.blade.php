@extends('principal')
@section('contenido')
<main class="main">
             @include('breadcrumb.bread')
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">

                       <h2>Listado de Roles</h2><br/>
                      
                       
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                            {!!Form::open(array('url'=>'rol','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!} 
                                <div class="input-group">
                                   
                                    <input type="text" name="buscarTexto" class="form-control" placeholder="Buscar texto" value="{{$buscarTexto}}">
                                    <button type="submit"  class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>&nbsp;
                                    <a href={{url('usuario')}}  class="btn btn-primary">Limpiar</a>
                                </div>
                                </div>
                            {{Form::close()}}
                            </div>
                     
                        <table class="table table-bordered table-striped table-sm table-responsive">
                            <thead>
                                <tr class="bg-dark text-light">
                                   
                                    <th>Rol</th>
                                    <th>Descripción</th>
                                    <th>Estado</th>
                                   
                                </tr>
                            </thead>
                            <tbody>

                               @foreach($roles as $rol)
                               
                                <tr>
                                    
                                    <td>{{$rol->nombre}}</td>
                                    <td>{{$rol->descripcion}}</td>
                                    <td>

                                      @if($rol->condicion=="1")

                                        <button type="button" class="btn btn-success rounded btn-sm">
                                    
                                          <i class="fa fa-check fa-2x"></i> Activo
                                        </button>

                                      @else
                                         <button type="button" class="btn btn-danger rounded btn-sm">
                                    
                                         <i class="fa fa-check fa-2x"></i> Desactivado
                                         </button>

                                      @endif
                                        
                                       
                                    </td>

                                   
                                </tr>

                                @endforeach
                               
                            </tbody>
                        </table>
                            
                            {{$roles->render()}}

                    </div>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
             
            
        </main>

@endsection