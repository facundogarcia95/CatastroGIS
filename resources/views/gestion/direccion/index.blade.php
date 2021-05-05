@extends('principal')
@section('breadcrumb')
    {{ Breadcrumbs::render('direccion') }}
@endsection
@section('contenido')
@php
 session(['asignarDireccion'=>false])   
@endphp

<!-- La grilla de direcciones esta separada porque luego se utiliza para asignar una direccion desde parcelas -->
@include('gestion.direccion.grillaDirecciones')

@push('scripts')
    <script>

        /*INICIO ventana modal para cambiar el estado*/                
        $('#editarDireccion').on('show.bs.modal', function (event) {
            //console.log('modal abierto');
            var button = $(event.relatedTarget) 
            var direccion_id = button.data('direccion_id')
            var direccion_nomencla = button.data('direccion_nomencla')
            var calle_id = button.data('calle_id')
            var ejes_mendoza = button.data('ejes_mendoza')
            var direccion_numeracion = button.data('direccion_numeracion')
            var barrio_id = button.data('barrio_id')
            var barrio_nombre = button.data('barrio_nombre')
            var direccion_manzana = button.data('direccion_manzana')
            var direccion_casa = button.data('direccion_casa')
            var direccion_local = button.data('direccion_local')
            var direccion_piso = button.data('direccion_piso')
            var direccion_depto = button.data('direccion_depto')
            var direccion_area = button.data('direccion_area')
            var direccion_torre = button.data('direccion_torre')
            var direccion_lote = button.data('direccion_lote')
            var direccion_cp = button.data('direccion_cp')
            var direccion_observ = button.data('direccion_observ')
            var provincia_id = button.data('provincia_id')
            var departamento_id = button.data('departamento_id')
            var distrito_id = button.data('distrito_id')
            var modal = $(this)
            // modal.find('.modal-title').text('New message to ' + recipient)
            modal.find('.modal-body #direccion_id').val(direccion_id);
            modal.find('.modal-body #direccion_nomencla').val(direccion_nomencla);
            modal.find('.modal-body #calle_id').val(calle_id);
            modal.find('.modal-body #ejes_mendoza').val(ejes_mendoza);
            modal.find('.modal-body #direccion_numeracion').val(direccion_numeracion);
            modal.find('.modal-body #barrio_id').val(barrio_id);
            modal.find('.modal-body #barrio_nombre').val(barrio_nombre);
            modal.find('.modal-body #direccion_manzana').val(direccion_manzana);
            modal.find('.modal-body #direccion_casa').val(direccion_casa);
            modal.find('.modal-body #direccion_local').val(direccion_local);
            modal.find('.modal-body #direccion_piso').val(direccion_piso);
            modal.find('.modal-body #direccion_depto').val(direccion_depto);
            modal.find('.modal-body #direccion_area').val(direccion_area);
            modal.find('.modal-body #direccion_torre').val(direccion_torre);
            modal.find('.modal-body #direccion_lote').val(direccion_lote);
            modal.find('.modal-body #direccion_cp').val(direccion_cp);
            modal.find('.modal-body #direccion_observ').val(direccion_observ);
            modal.find('.modal-body .provincia_id').val(provincia_id);
            modal.find('.modal-body .departamento_id').val(departamento_id);
            modal.find('.modal-body .distrito_id').val(distrito_id);

            modal.find('.modal-body .prov_dep_dist').collapse("hide")
            modal.find('.modal-body .provincia_id').attr("readonly",true)
            modal.find('.modal-body .departamento_id').attr("readonly",true)
            modal.find('.modal-body .distrito_id').attr("readonly",true)
        })        
        /*FIN ventana modal para cambiar estado*/


        /* AUTOCOMPLETAR CALLES */
        $.ajax({
            url: 'direccionesAutocompletar',
            type: 'get',
            data: {},
            success: function(response) {
                $(".ejes_mendoza").autocomplete({ 
                    autoFocus: false,
                    minLength: 4,
                    source: response.ejes,
                    open: function() {
                        setTimeout(function() {
                            $('.ui-autocomplete').css('z-index', 9999);
                        }, 0);
                        $(".ui-helper-hidden-accessible").css("display", "none");
                    },
                    select: function(event, ui) {
                        $('.calle_id').val(ui.item.eje_id);
                        $(".provincia_id").val(ui.item.provincia_id);
                        $(".departamento_id").val(ui.item.departamento_id);
                        $(".distrito_id").val(ui.item.distrito_id);
                        $(".prov_dep_dist").collapse('hide');
                    }
                });

            },
            error: function(resp) {
                console.log(resp);
            }

        });

        /* AUTOCOMPLETAR BARRIOS */
        $.ajax({
            url: 'barriosAutocompletar',
            type: 'get',
            data: {},
            success: function(response) {
                $(".barrio_nombre").autocomplete({ 
                    autoFocus: false,
                    minLength: 4,
                    source: response.barrios,
                    open: function() {
                        setTimeout(function() {
                            $('.ui-autocomplete').css('z-index', 9999);
                        }, 0);
                        $(".ui-helper-hidden-accessible").css("display", "none");
                    },
                    select: function(event, ui) {
                        document.getElementById('barrio_id').value = ui.item.barrio_id;
                    }
                });

            },
            error: function(resp) {
                console.log(resp);
            }

        });

$(document).ready(function () {
    
   
        $(".provincia_id").on("change",function (e) { 
            var provincia = $(this).val(); 
            $.each($(".departamento_id option"), function() {

                if($(this).attr("provincia_id") == provincia){
                    $(this).show();
                }else{
                    $(this).hide();
                }
            })
            $.each($(".departamento_id option"), function() {
                if($(this).css("display") != "none"){
                    $(this).prop("selected", true);
                    return false;
                }
            })
            $(".departamento_id").change();
        });

        $(".departamento_id").on("change",function (e) { 
            var departamento = $(this).val(); 
            $.each($(".distrito_id option"), function() {

                if($(this).attr("departamento_id") == departamento){
                    $(this).show();
                }else{
                    $(this).hide();
                }
            })
            $.each($(".distrito_id option"), function() {
                if($(this).css("display") != "none"){
                    $(this).prop("selected", true);
                    return false;
                }
            })
        });


        $(".ejes_mendoza").on("keyup",function(){
            if($(this).val() == "" || $(this).val() == null){
                $(".prov_dep_dist").collapse('show');
                $(".calle_id").val("");
            }
        })

        $(".barrio_nombre").on("keyup",function(){
            if($(this).val() == "" || $(this).val() == null){
                $(".barrio_id").val("");
            }
        })

});



    </script>
    
    

@endpush

@endsection