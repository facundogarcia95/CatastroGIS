@extends('principal')
@section('breadcrumb')
    {{ Breadcrumbs::render('desglose') }}
@endsection
@section('contenido')

<div class="container-fluid mt-6" >
    <div class="card">
        @if( session('error') )
            <div class="alert alert-danger" role="alert">{{session('error')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true" class="text-dark">&times;</span>
                </button>
            </div>
        @endif
        <iframe style="background-color:white;  min-height: 80vh !important" 
        class="w-100" src="{{ url('operacion/desglose.php?uid=') }}{{Auth::user()->usuario_id}}" frameborder="0"></iframe>
       
    </div>
</div>

@push('scripts')
    <script>
        $("body").css("overflow-y",'hidden')
    </script>
@endpush

@endsection