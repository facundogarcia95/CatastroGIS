@extends('principal')
@section('breadcrumb')
    {{ Breadcrumbs::render('personas') }}
@endsection
@section('contenido')
@php
 session(['asignar'=>false])   
@endphp

<!-- La grilla de personas esta separada porque luego se utiliza para asignar una persona desde parcelas -->
@include('gestion.personas.grillaPersonas')

@push('scripts')
    <script>

        /*INICIO ventana modal para cambiar el estado*/                
        $('#editarPersona').on('show.bs.modal', function (event) {
            //console.log('modal abierto');
            var button = $(event.relatedTarget) 
            var persona_id = button.data('persona_id')
            var tipo_persona_id = button.data('tipo_persona_id')
            var tipo_persona_juridica_id = button.data('tipo_persona_juridica_id')
            var tipo_documento_id = button.data('tipo_documento_id')
            var tipo_persona_descrip = button.data('tipo_persona_descrip')
            var persona_denominacion = button.data('persona_denominacion')
            var persona_nombre = button.data('persona_nombre')
            var persona_apellido = button.data('persona_apellido')
            var persona_cuit = button.data('persona_cuit')
            var persona_es_cuit = button.data('persona_es_cuit')
            var persona_nro_doc = button.data('persona_nro_doc')
            var persona_fecha_nac = button.data('persona_fecha_nac')
            var pais_id = button.data('pais_id')
            var persona_sexo = button.data('persona_sexo')
            var persona_fallecida = button.data('persona_fallecida')
            var persona_email = button.data('persona_email')
            var persona_conyuge = button.data('persona_conyuge')
            var modal = $(this)
            // modal.find('.modal-title').text('New message to ' + recipient)

            modal.find('.modal-body #persona_id').val(persona_id);
            modal.find('.modal-body #tipo_persona_id').val(tipo_persona_id);
            modal.find('.modal-body #tipo_persona_juridica_id').val(tipo_persona_juridica_id);
            modal.find('.modal-body #tipo_documento_id').val(tipo_documento_id);
            modal.find('.modal-body #tipo_persona_descrip').val(tipo_persona_descrip);
            modal.find('.modal-body #persona_denominacion').val(persona_denominacion);
            modal.find('.modal-body #persona_nombre').val(persona_nombre);
            modal.find('.modal-body #persona_apellido').val(persona_apellido);
            modal.find('.modal-body #persona_cuit').val(persona_cuit);
            modal.find('.modal-body #persona_es_cuit').val(persona_es_cuit);
            modal.find('.modal-body #persona_nro_doc').val(persona_nro_doc);
            modal.find('.modal-body #persona_fecha_nac').val(persona_fecha_nac);
            modal.find('.modal-body #pais_id').val(pais_id);
            modal.find('.modal-body #persona_sexo').val(persona_sexo);
            modal.find('.modal-body #persona_fallecida').val(persona_fallecida);
            modal.find('.modal-body #persona_email').val(persona_email);
            modal.find('.modal-body #persona_conyuge').val(persona_conyuge);

            // Disparo change del select para cambiar los campos segun el tipo de persona
           // $(".tipo_persona_id").trigger("change");  
        })  

        /*FIN ventana modal para cambiar estado*/

    

    </script>
@endpush
@endsection