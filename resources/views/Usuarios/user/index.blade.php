@extends('principal')
@section('breadcrumb')
    {{ Breadcrumbs::render('user') }}
@endsection
@section('contenido')
        
<div class="container-fluid mt-6">
                
                <div class="card">
                    <div class="card-header">

                       <h2>Listado de Usuarios</h2><br/>
                      @if(Auth::user()->idrol == 4 || Auth::user()->idrol == 1)
                        <button class="btn btn-primary btn-lg rounded" type="button" data-toggle="modal" data-target="#abrirmodal">
                            <i class="fa fa-plus"></i>&nbsp;&nbsp;Agregar Usuario
                        </button>
                    @endif
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                         
                                <div class="input-group">
                                   
                                    <input type="text" id="buscarTexto" name="buscarTexto" class="form-control" placeholder="Buscar texto" value="">
                                    <button  class="btn btn-primary"><i class="fa fa-search"></i> Buscador</button>
                                   
                                </div>
                       
                            </div>
                        </div>
                        <table id="tablaUsuarios" class="table table-bordered table-striped  dt-responsive nowrap" style="width: 100%" >
                            <thead>
                                <tr class="bg-dark text-light">
                                   
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Usuario</th>
                                    <th>Rol</th>
                                    <th>Seccion</th>
                                    <th>Estado</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
            <!--Inicio del modal agregar-->
            <div class="modal fade" id="abrirmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-dark modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Agregar usuario</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true" class="text-light">×</span>
                            </button>
                        </div>
                       
                        <div class="modal-body">
                             

                            <form action="{{route('user.store')}}" method="post" class="form-horizontal was-validated" enctype="multipart/form-data" >
                               
                                {{csrf_field()}}
                                
                                @include('Usuarios.user.form')

                            </form>
                        </div>
                        
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->


             <!--Inicio del modal actualizar-->
             <div class="modal fade" id="abrirmodalEditarUsuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-dark modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Actualizar usuario</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true" class="text-light">×</span>
                            </button>
                        </div>
                       
                        <div class="modal-body">
                             
 
                            <form action="{{route('user.update','test')}}" method="post" class="form-horizontal was-validated" enctype="multipart/form-data">
                                
                                {{method_field('patch')}}
                                {{csrf_field()}}

                                <input type="hidden" id="id_usuario" name="id_usuario" value="">
                                
                                @include('Usuarios.user.form')

                            </form>
                        </div>
                        
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->

            
             <!-- Inicio del modal Cambiar Estado del usuario -->
             <div class="modal fade" id="cambiarEstadoUsuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-dark" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Cambiar Estado del Usuario</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true" class="text-light">×</span>
                            </button>
                        </div>

                    <div class="modal-body">
                        <form action="{{route('user.destroy','test')}}" method="POST" class="was-validated">
                         {{method_field('delete')}}
                         {{csrf_field()}} 

                            <input type="hidden" id="id_usuario" name="id_usuario" value="">

                                <p>¿Está seguro que desea cambiar el estado?</p>
        

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success rounded">Aceptar</button>
                                <button type="button" class="btn btn-danger rounded" data-dismiss="modal">Cerrar</button>
                            </div>

                         </form>
                    </div>
                    <!-- /.modal-content -->
                   </div>
                <!-- /.modal-dialog -->
                </div>
            </div>
            <!-- Fin del modal Eliminar -->
           

           
            
@push('scripts')

<script>
    
           
$(document).ready(function () {

olTable = $('#tablaUsuarios').DataTable({
    "ajax":"tabla_usuarios",
    "deferRender": true,
    "retrieve": true,
    "processing": true,
    "language": {

        "sProcessing":     "Procesando...",
        "sLengthMenu":     "Mostrar _MENU_ registros",
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "Ningún dato disponible en esta tabla",
        "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
        "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":    "",
        "sSearch":         "Buscar:",
        "sUrl":            "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }

},
columns: [
    
        {data: 'usuario_nombre'},
        {data: 'email'},
        {data: 'usuario_login'},
        {data: 'rol'},
        {data: 'seccion'},
        {data: 'estado'},
        {data: 'accion',"searchable": false }
        
    ]
});

    $("#buscarTexto").keyup(function() {
        olTable.search(this.value).draw();
    });    

    $(".imagen").on("change",function(e){

        let reader = new FileReader();

        // Leemos el archivo subido y se lo pasamos a nuestro fileReader
            reader.readAsDataURL(e.target.files[0]);

        // Le decimos que cuando este listo ejecute el código interno
            reader.onload = function(){

                $(".previsualizar").attr("src",reader.result);

            };

        })

});



            
         /*EDITAR USUARIO EN VENTANA MODAL*/
         $('#abrirmodalEditarUsuario').on('show.bs.modal', function (event) {
        
        //console.log('modal abierto');
        /*el button.data es lo que está en el button de editar*/
        var button = $(event.relatedTarget)
        
        var nombre_modal_editar = button.data('nombre')
        var tipo_documento_modal_editar = button.data('tipo_documento')
        var num_documento_modal_editar = button.data('num_documento')
        var direccion_modal_editar = button.data('direccion')
        var telefono_modal_editar = button.data('telefono')
        var email_modal_editar = button.data('email')
        var id_rol_modal_editar = button.data('id_rol')
        var usuario_modal_editar = button.data('usuario')
        var seccion_modal_editar = button.data('seccion')
        //var password_modal_editar = button.data('password')
        var id_usuario = button.data('id_usuario')
        var nombreImagen = button.data('imagen')
        var modal = $(this)

        // modal.find('.modal-title').text('New message to ' + recipient)
        /*los # son los id que se encuentran en el formulario*/
        modal.find('.modal-body #nombre').val(nombre_modal_editar);
        modal.find('.modal-body #tipo_documento').val(tipo_documento_modal_editar);
        modal.find('.modal-body #num_documento').val(num_documento_modal_editar);
        modal.find('.modal-body #direccion').val(direccion_modal_editar);
        modal.find('.modal-body #telefono').val(telefono_modal_editar);
        modal.find('.modal-body #email').val(email_modal_editar);
        modal.find('.modal-body #id_rol').val(id_rol_modal_editar);
        modal.find('.modal-body #usuario').val(usuario_modal_editar);
        modal.find('.modal-body #id_seccion').val(seccion_modal_editar);
        //modal.find('.modal-body #password').val(password_modal_editar);
        modal.find('.modal-body #id_usuario').val(id_usuario);
        modal.find('.modal-body .previsualizar').attr('src','../storage/archivos/usuario/'+nombreImagen);
        })

     /*INICIO ventana modal para cambiar el estado del usuario*/
        
        $('#cambiarEstadoUsuario').on('show.bs.modal', function (event) {
        
        //console.log('modal abierto');
        
        var button = $(event.relatedTarget) 
        var id_usuario = button.data('id_usuario')
        var modal = $(this)
        // modal.find('.modal-title').text('New message to ' + recipient)
        
        modal.find('.modal-body #id_usuario').val(id_usuario);
        })
         
        /*FIN ventana modal para cambiar estado del usuario*/

        $('#abrirmodal').on('show.bs.modal', function (event) {
            
            var modal = $(this)
            modal.find('.modal-body .previsualizar').attr('src','../storage/archivos/usuario/noimagen.jpg');
       
        });
    
        </script>
  

  @endpush

@endsection