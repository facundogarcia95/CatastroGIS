@extends('principal')
@section('contenido')


<main class="main bg-light">

 <div class="card-body  ">

    <div class="col-12 bg-dark rounded pt-3 pb-3">
        <h2 class="text-light">Agregar Novedad</h2>
    </div>

    <div class=" row   mt-5">


        @foreach ($tiposNovedades as $tipo)
            <div class="col-8 mt-2 mb-2 mx-auto">
                <a  href="{{ action('NovedadController@detalleNovedad', ['empleado' => Crypt::encrypt($empleado->id),'tipo' => Crypt::encrypt($tipo->id)])}}" class="pt-4 pb-4 btn btn-dark w-100 btn-lg rounded font-weight-bold">{{$tipo->denominacion}} &nbsp; <i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i></a>
            </div>
        @endforeach
            
    </div>

 </div>
 
</main>


@endsection