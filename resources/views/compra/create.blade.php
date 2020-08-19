@extends('principal')
@section('contenido')


<main class="main">

 <div class="card-body">

 <h2>Agregar Compra</h2>

 <br/>
    <form action="{{route('compra.store')}}" method="POST">
    {{csrf_field()}}

            <div class="form-group row">

            <div class="col-md-8">  

                <label class="form-control-label" for="nombre">Nombre del Proveedor</label>
                
                    <select class="form-control selectpicker" name="id_proveedor" id="id_proveedor" data-live-search="true">
                                                    
                    <option value="0" disabled>Seleccione</option>
                    
                    @foreach($proveedores as $prove)
                    
                    <option value="{{$prove->id}}">{{$prove->nombre}}</option>
                            
                    @endforeach

                    </select>
                
                </div>
            </div>

            <div class="form-group row">

                <div class="col-md-8">  

                        <label class="form-control-label" for="documento">Documento</label>
                        
                        <select class="form-control" name="tipo_identificacion" id="tipo_identificacion" required>
                                                        
                            <option value="" selected>Seleccione</option>
                            <option value="FACTURA">Factura</option>
                            <option value="TICKET">Ticket</option>
                            

                        </select>
                </div>
            </div>


            <div class="form-group row">

                <div class="col-md-8">
                        <label class="form-control-label" for="num_compra">Número Factura/Ticket (Opcional)</label>
                        
                        <input type="text" id="num_compra" name="num_compra" class="form-control" placeholder="Ingrese el número compra" pattern="[0-9]{0,15}">
                </div>
            </div>

            <div class="form-group row">

                <div class="col-md-4">
                    
                    <div class="form-group">

                        <label  for="autocompletad_pv">Buscar Producto </label>
                    
                        <input type="text" class="form-control" placeholder="Ingresar nombre..." id="autocompletad_pv">
                    
                    </div>

                </div>

                 <div class="col-md-4">  

                        <label class="form-control-label" for="nombre">Producto</label>

                            <select class="form-control selectpicker" name="id_producto" id="id_producto" data-live-search="true">
                                                            
                            <option value="" selected>Seleccione</option>
                            
                            @foreach($productos as $prod)
                                           
                                <option value="{{$prod->id}}">#{{$prod->producto}} ({{$prod->unidad}})</option>              

                            @endforeach

                            </select>

                </div>

            </div>

            <div class="form-group row">

                <div class="col-md-3 mt-2">
                        <label class="form-control-label" for="cantidad">Cantidad</label>
                        
                        <input type="number" id="cantidad" name="cantidad" class="form-control" placeholder="Ingrese cantidad" pattern="[0-9]{0,15}">
                </div>

                <div class="col-md-3 mt-2">
                        <label class="form-control-label" for="precio_compra">Precio Compra</label>
                        
                        <input type="number" id="precio_compra" name="precio_compra" class="form-control" placeholder="Ingrese precio de compra" pattern="[0-9]{0,15}">
                </div>

               
                <div class="col-md-3 mt-4">
                        
                    <button type="button" id="agregar" class="btn btn-primary rounded bt-md"><i class="fa fa-plus fa-2x"></i> Agregar detalle</button>
                </div>


            </div>

            <br/><br/>

           <div class="form-group row">

              <h3 class="ml-1">Lista de Compras a Proveedores</h3>

              <div class="mt-1 col-md-12">
                <table id="detalles" class="table-responsive table table-bordered table-striped table-sm">
                <thead>
                    <tr class="bg-dark text-light">
                        <th>Eliminar</th>
                        <th>Producto</th>
                        <th>Precio($)</th>
                        <th>Cantidad</th>
                        <th>SubTotal ($)</th>
                    </tr>
                </thead>
                 
                <tfoot>
                  

                    <tr>
                        <th  colspan="4"><p align="right">SUB TOTAL:</p></th>
                        <th><p align="right"><span id="total">$ 0.00</span> </p></th>
                    </tr>

                    <tr class="collapse" id="impuesto">
                        <th colspan="4"><p align="right">TOTAL IMPUESTO ({{$negocio[0]->impuesto}}%):</p></th>
                        <th><p align="right"><span id="total_impuesto">$ 0.00</span></p> <input type="hidden" name="impuestoHidden" id="impuestoHidden" value="21"></th>
                    </tr>

                    <tr>
                        <th  colspan="4"><p align="right">TOTAL PAGAR:</p></th>
                        <th><p align="right"><span align="right" id="total_pagar_html">$ 0.00</span> <input type="hidden" name="total_pagar" id="total_pagar"></p></th>
                    </tr>  

                </tfoot>

                <tbody>
                </tbody>
                
                
                </table>
              </div>
            
            </div>

            <div class="modal-footer form-group row" id="guardar">
            
            <div class="col-md">
               <input type="hidden" name="_token" value="{{csrf_token()}}">
              
                <button type="submit" class="btn btn-success rounded pull-right"><i class="fa fa-plus-square fa-1x"></i> Registrar</button>
            
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

     autoCompleteProductosCompras();

  });

   var cont=0;
   total=0;
   subtotal=[];
   $("#guardar").hide();

     function agregar(){

          id_producto= $("#id_producto").val();
          tipo_identificacion= $("#tipo_identificacion").val();
          producto= $("#id_producto option:selected").text();
          cantidad= $("#cantidad").val();
          precio_compra= $("#precio_compra").val();
          impuesto=$("#impuestoHidden").val();
        
          
          if(id_producto !="" && cantidad!="" && cantidad>0 && precio_compra!="" && tipo_identificacion != ""){
            
             subtotal[cont]=cantidad*precio_compra;
             total= total+subtotal[cont];
             
             var fila= '<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-danger btn-sm" onclick="eliminar('+cont+');"><i class="fa fa-times fa-2x"></i></button></td> <td><input type="hidden" name="id_producto[]" value="'+id_producto+'">'+producto+'</td> <td><input type="number" id="precio_compra[]" name="precio_compra[]"  value="'+precio_compra+'" class="form-control" readonly> </td>  <td><input type="number" name="cantidad[]" value="'+cantidad+'" class="form-control" readonly> </td> <td>$'+subtotal[cont]+' </td></tr>';
             cont++;
             limpiar();
             totales();
            
             evaluar();
             $('#detalles').append(fila);
            
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
        $("#precio_compra").val("");
        

     }

     function totales(){

        impuesto=$("#impuestoHidden").val();

        $("#total").html("$ " + total.toFixed(2));

        total_impuesto=total*impuesto/100;
        total_pagar=total+total_impuesto;
        $("#total_impuesto").html("$ " + total_impuesto.toFixed(2));
        $("#total_pagar_html").html("$ " + total_pagar.toFixed(2));
        $("#total_pagar").val(total_pagar.toFixed(2));
        
     }



     function evaluar(){

         if(total>0){

           $("#guardar").show();

         } else{
              
           $("#guardar").hide();
         }
     }

     function eliminar(index){

       impuesto=$("#impuestoHidden").val();

       total=total-subtotal[index];
       total_impuesto= total*impuesto/100;
       total_pagar_html = total + total_impuesto;
       
        $("#total").html("$" + total);
        $("#total_impuesto").html("$" + total_impuesto);
        $("#total_pagar_html").html("$" + total_pagar_html);
        $("#total_pagar").val(total_pagar_html.toFixed(2));
       
        $("#fila" + index).remove();
        evaluar();
     }

     $("#tipo_identificacion").on("change",function(e){

         if($(this).val() == "FACTURA"){
             $("#impuesto").collapse("show");
             impuesto=$("#impuestoHidden").val(21);
         }else{
            $("#impuesto").collapse("hide");
            impuesto=$("#impuestoHidden").val(0);
         }

         totales();

       });

 </script>
@endpush

@endsection