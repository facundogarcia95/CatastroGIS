@extends('principal')
@section('breadcrumb')
    {{ Breadcrumbs::render('poligonos_sin_padron') }}
@endsection
@section('contenido')

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

           <h2>POLIGONOS SIN PADRONES</h2><br/>

           <h6>Ejecutar el siguiente proceso limpiará por completo la capa de polígonos sin padron y la generará nuevamente a
            partir de la no coincidencia de registros entre el parcelario cartográfico y el alfanumérico.  
            (Puede demorar varios minutos)</h6><br/>

            <button id="ejecutar_script" class="btn btn-primary btn-lg rounded" type="button" data-toggle="modal" >
                <i class="fa fa-plus"></i>&nbsp;&nbsp;Ejecutar Script
            </button>
            
        </div>
        <div class="card-body">
            

        </div>
    </div>


    <!-- Fin ejemplo de tabla Listado -->




</div>

@push('scripts')

    <script>
        $("#ejecutar_script").click(function (e) { 
            e.preventDefault();
            $.ajax({
                type: "GET",
                url: "{{url('script_poligonos_sin_padrones')}}",
                success: function (response) {

                    Swal.fire({
                        position: 'center',
                        type: 'success',
                        title: 'Ejecución completada',
                        html:'Se ha realizado correctamente la actualización del parcelario',
                        showConfirmButton: true
                    });

                },
                beforeSend: function(response){

                    Swal.showLoading({
                        position: 'center'
                    });

                }
            });
        });
    </script>

   @endpush

   @push('css')

   

   @endpush
@endsection