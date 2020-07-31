@extends('principal')
@section('contenido')


<main class="main">

 <div class="card-body">

 <h2>Agregar Receta</h2>

 <span><strong>(*) Campo obligatorio</strong></span><br/><br/>

 <h3 class="text-left mt-4">Cargar Insumos</h3>

    <form action="{{route('receta.store')}}" method="POST">
    {{csrf_field()}}

         
    <div class="form-group row">

        <div class="col-md-4">
                <label class="form-control-label" for="cantidad">Nombre</label>
                
                <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Ingrese Nombre" pattern="^[a-zA-Z0-9_áéíóúñ\s]{0,100}$">
        </div>

    </div>
            <div class="form-group row border">

                 <div class="col-md-8">  

                        <label class="form-control-label" for="nombre">Producto</label>

                            <select class="form-control selectpicker" name="id_producto" id="id_producto" data-live-search="true">
                                                            
                            <option value="0" selected>Seleccione</option>
                            
                            @foreach($productos as $prod)
                            
                            <option value="{{$prod->id}}" unidad="{{$prod->unidad}}">{{$prod->producto}} ({{$prod->unidad}})</option>
                                    
                            @endforeach

                            </select>

                </div>

            </div>

            <div class="form-group row">

                <div class="col-md-3">
                        <label class="form-control-label" for="cantidad">Cantidad</label>
                        
                        <input type="number" id="cantidad" name="cantidad" class="form-control" placeholder="Ingrese cantidad" pattern="[a-zA-Z0-9_áéíóúñ\s]{0,100}">
                </div>
               
                <div class="col-md-3">
                        
                    <button type="button" id="agregar" class="btn btn-primary"><i class="fa fa-plus fa-2x"></i> Agregar Insumo</button>
                </div>

            </div>

            <br/><br/>

           <div class="form-group row border">

              <h3>Lista de Productos de la Receta</h3>

              <div class="table-responsive col-md-12">
                <table id="detalles" class="table table-bordered table-striped table-sm">
                <thead>
                    <tr class="bg-success">
                        <th>Eliminar</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Unidad</th>
                    </tr>
                </thead>
                 
                <tbody>
                </tbody>
                
                
                </table>
              </div>
            
            </div>

            <div class="modal-footer form-group row" id="guardar">
            
            <div class="col-md">
               <input type="hidden" name="_token" value="{{csrf_token()}}">
              
                <button type="submit" class="btn btn-success"><i class="fa fa-save fa-2x"></i> Registrar</button>
            
            </div>

            </div>

         </form>

    </div><!--fin del div card body-->
  </main>

@push('scripts')
 <script>
     
  $(document).ready(function(){
     
     $("#agregar").click(function(){

         agregar();
     });

  });

   var cont=0;

   $("#guardar").hide();

     function agregar(){

          id_producto= $("#id_producto").val();
          unidad= $("#id_producto option:selected").attr('unidad');
          producto= $("#id_producto option:selected").text();
          cantidad= $("#cantidad").val();      
          
          if(id_producto !="" && cantidad!="" && cantidad>0){
            
             
             var fila= '<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-danger btn-sm" onclick="eliminar('+cont+');"><i class="fa fa-times fa-2x"></i></button></td> <td><input type="hidden" name="id_producto[]" value="'+id_producto+'">'+producto+'</td> <td><input type="number" name="cantidad[]" value="'+cantidad+'"><td>'+unidad+'</td> </td></tr>';
             cont++;
             limpiar();
             
             $('#detalles').append(fila);
             evaluar();
             
            }else{

               // alert("Rellene todos los campos del detalle de la compra, revise los datos del producto");
               
                Swal.fire({
                type: 'error',
                //title: 'Oops...',
                text: 'Rellene todos los campos del detalle de la compras',
              
                })
            
            }
         
     }

    
     function limpiar(){
        
        $("#cantidad").val("");
        $("#id_producto").val("");
        
     }


     function eliminar(index){ 
       
        $("#fila" + index).remove();
        evaluar();
     }

     function evaluar(){

        var rowCount = $('#detalles tr').length;

        if(rowCount>0){

        $("#guardar").show();

        } else{
            
        $("#guardar").hide();

        }
}

 </script>
@endpush

@endsection