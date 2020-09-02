
@extends('principal')
@section('contenido')


<main class="main">
    
    <div class="card-body">

        <div class="form-group row border m-1  bg-light">

            <h3 class="m-3">Detalle de {{$tipoNovedad->denominacion}}</h3>

            <div class="col-md-12 mt-3">
            
                <table id="detalles" class="table table-responsive  table-bordered table-default table-sm">
            
                    <thead>
                    

                    <tr class="bg-dark text-light">
                        <th>COLUMNA 1</th>
                        <th>COLUMNA 2</th>
                        <th>COLUMNA 3</th>
                        <th>COLUMNA 4</th>
                        <th>COLUMNA 5</th>
                    </tr>
                
                    </thead>
                
                @isset($idNovedad)
                    <form  action="{{route('novedad.update','test')}}"  method="POST"  enctype="multipart/form-data"> 
                        {{method_field('patch')}}     
                @else
                    <form  action="{{route('novedad.store')}}"  method="POST"  enctype="multipart/form-data">
                @endisset

                {{csrf_field()}}

                        <tbody>
                            
                            @isset($detalles)
                               
                                @foreach ($detalles as $detalle)
                                    
                                @endforeach

                            @endisset
                           
                        </tbody>

                    </form>

                </table>

            </div>
      
        </div>

    </div>

</main>


@endsection