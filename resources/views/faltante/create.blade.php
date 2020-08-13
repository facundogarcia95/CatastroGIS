@extends('principal')
@section('contenido')


<main class="main">

 <div class="card-body">

 <h2>Agregar Ajuste</h2>

 <span><strong>(*) Campo obligatorio</strong></span><br/>

 <h3 class="text-left mt-5 mb-3">LLenar el formulario</h3>

    <form action="{{route('faltante.store')}}" method="POST">
    {{csrf_field()}}

            <div class="form-group row">

                <div class="col-md-8">

                        <label class="form-control-label" for="observacion">Observacion</label>
                        
                        <textarea  id="observacion" name="observacion" class="form-control" placeholder="Agregar observacion (Opcional)"></textarea>
                </div>

            </div>

            <br/>

            <div class="form-group row border">

                    <div class="col-md-8 mb-3 mt-2">  
    
                        <label class="form-control-label" for="nombre">Motivo de Faltante</label>
                    
                        <select class="form-control selectpicker" name="motivo" id="motivo" data-live-search="true">
                                                        
                        <option value="" selected>Seleccione</option>  
                        <option value="ROTO">ROTO</option>
                        <option value="PERDIDO">PERDIDO</option>
                        <option value="VENCIDO">VENCIDO</option>
                        <option value="FALLADO">FALLADO</option>            
                        <option value="ROBO">ROBO</option>            
                        <option value="OTRO">OTRO</option>            
    
                        </select>
                    
                    </div>
        

                 <div class="col-md-8 mb-2">  

                        <label class="form-control-label" for="nombre">Producto</label>

                            <select class="form-control selectpicker" name="id_producto" id="id_producto" data-live-search="true">
                                                            
                            <option value="" selected>Seleccione</option>
                            
                            @foreach($productos as $prod)
                                           
                            <option stock="{{$prod->stock}}" value="{{$prod->id}}">#{{$prod->producto}} ({{$prod->unidad}})</option>              

                            @endforeach

                            </select>

                </div>


                <div class="col-md-5 mb-3">
                        <label class="form-control-label" for="cantidad">Cantidad Sobrante</label>
                        
                        <input type="number" id="cantidad" name="cantidad" class="form-control" placeholder="Ingrese cantidad" pattern="[0-9]{0,15}">
                </div>

               

                <div class="col-md-3 mt-3">
                        
                    <button type="button" id="agregar" class="btn btn-primary w-100 rounded mt-1"><i class="fa fa-plus fa-2x"></i> Agregar detalle</button>
                </div>


            </div>

            <br/><br/>

           <div class="form-group row">

              <h3 class="m-1">Lista de Ajustes Agregados</h3>

              <div class=" col-md-12 mt-1">
                <table id="detalles" class="table table-responsive table-bordered table-striped table-sm">
                <thead>
                    <tr class="bg-dark text-light">
                        <th>Eliminar</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Motivo</th>
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
              
                <button type="submit" class="btn btn-success pull-right"><i class="fa fa-plus-square fa-2x"></i> Registrar</button>
            
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

     $("#id_producto").change(mostrarStockMaximo);

  });

  function mostrarStockMaximo(){
    stock= $("#id_producto option:selected").attr('stock');
    $("#cantidad").attr('placeholder','Stock actual del sistema: '+stock);
    $("#cantidad").attr('max',stock);
  }

   var cont=0;

   $("#guardar").hide();

     function agregar(){

          id_producto= $("#id_producto").val();
          producto= $("#id_producto option:selected").text();
          stock= $("#id_producto option:selected").attr('stock');
          cantidad= $("#cantidad").val();
          motivo= $("#motivo option:selected").text();

          
          if(id_producto !="" && cantidad!="" && cantidad>0 && motivo != "" ){
            
            if(cantidad <= stock){
             var fila= '<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-danger btn-sm" onclick="eliminar('+cont+');"><i class="fa fa-times fa-2x"></i></button></td> <td><input type="hidden" name="id_producto[]" value="'+id_producto+'">'+producto+'</td><td><input type="number" name="cantidad[]" value="'+cantidad+'"> </td><td><input type="hidden" name="motivo[]" value="'+motivo+'"><b>'+motivo+'</b> </td>  </tr>';
             cont++;
             limpiar();
            
             evaluar();
             $('#detalles').append(fila);

            }else{
                Swal.fire({
                type: 'error',
                //title: 'Oops...',
                text: 'La cantidad no puede supertar el stock',
              
                })
            }

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
        $("#motivo").val("");
        

     }


     function evaluar(){

        var rowCount = $('#detalles tr').length;

            if(rowCount>0){

            $("#guardar").show();

            } else{
                
            $("#guardar").hide();

            }
     }

     function eliminar(index){
       
        $("#fila" + index).remove();
        evaluar();
     }

 </script>
@endpush

@endsection