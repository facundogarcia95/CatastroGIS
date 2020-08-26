@extends('principal')
@section('contenido')
<main class="main">
    @include('breadcrumb.bread')
    <div class="container-fluid" >
        <!-- Ejemplo de tabla Listado -->
        <div class="card" >
            <div class="card-body">
                <table class="table table-bordered table-striped table-sm table-responsive">
                    <thead>
                        <tr class="bg-dark text-light">
                           
                            <th class="w-25">Versión</th>
                            <th class="w-25">Fecha</th>
                            <th class="w-50"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($versiones as $version)
                            <tr>
                            <td><a href="{{url('version',$version->id)}}">{{$version->version}}</a></td>
                                <td>{{$version->fecha}}</td>
                                <td>{{$version->descripcion}}</td>
                            </tr>
                        @endforeach
                       
                    </tbody>
                </table>

            </div>
        </div>
        <!-- Fin ejemplo de tabla Listado -->
    </div>

</main>
@endsection