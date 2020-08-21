@inject('NegocioControlador', 'App\Http\Controllers\NegocioController')
@php
   $negocio = $NegocioControlador->create();
@endphp
<label class="dropdown-item" data-id="{{$negocio->id}}" data-nombre="{{$negocio->Nombre}}" data-cuil="{{$negocio->Cuil}}" data-email="{{$negocio->Email}}" 
    data-instagram="{{$negocio->Instagram}}" data-facebook="{{$negocio->Facebook}}" data-impuesto="{{$negocio->impuesto}}" 
    data-direccion="{{$negocio->Direccion}}" data-telefono="{{$negocio->Telefono}}" data-web="{{$negocio->web}}" data-toggle="modal" data-target="#abrirmodalEditarNegocio">
    <i class="fa fa-briefcase"></i> Mi negocio</label>

