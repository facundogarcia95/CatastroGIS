@extends('principal')
@section('contenido')


<main class="main">

 <div class="card-body">
   
            <div class="form-group row border m-1 bg-light">

              <div class="col-md-12 border"> 

                  <h2 class="text-left text-uppercase p-3">Detalle de Compra</h2>
              
              </div>

                    <div class="col-md-3 border">  

                        <label class="form-control-label m-1" for="nombre">Proveedor</label>
                        
                        <p class="m-1 font-weight-bold">{{$compra->nombre}}</p>
                            
                    </div>

                    <div class="col-md-3 border">  

                    <label class="form-control-label m-1" for="documento">Tipo Documento</label>

                    <p class="m-1 font-weight-bold">{{$compra->tipo_identificacion}}</p>
                    
                    </div>

                    <div class="col-md-3 border">
                            <label class="form-control-label m-1" for="num_compra">Número Comprobante</label>
                            
                            <p class="m-1 font-weight-bold">{{$compra->num_compra}}</p>
                    </div>

                    <div class="col-md-3 border">
                      <label class="form-control-label m-1" for="fecha_compra">Fecha</label>
                      
                      <p class="m-1 font-weight-bold">{{$compra->fecha_compra}}</p>
                    </div>

                    @if($compra->observacion)
                    <div class="col-md-12 border">
                      <label class="form-control-label m-1" for="observacion">Observacion</label>
                      
                      <p class="m-1 font-weight-bold">{{$compra->observacion}}</p>
                    </div>
                    @endif

            </div>

            
            <br/><br/>

           <div class="form-group row border m-1  bg-light">

              <h3 class="m-2">Lista de Productos</h3>

              <div class="col-md-12">
                <table id="detalles" class="table table-responsive  table-bordered table-default table-sm">
                <thead>
                    <tr class="bg-dark text-light">

                        <th>Producto</th>
                        <th>Precio ($)</th>
                        <th>Cantidad</th>
                        <th>SubTotal ($)</th>
                    </tr>
                </thead>
                 
                <tfoot class="table-white">
                  
                   <!--<th><h2>TOTAL</h2></th>
                   <th></th>
                   <th></th>
                   <th><h4 id="total">${{$compra->total}}</h4></th>-->

                    <tr>
                        <th  colspan="3"><p align="right">TOTAL:</p></th>
                        <th><p align="right">${{number_format($compra->total,2)}}</p></th>
                    </tr>
                    @if($compra->tipo_identificacion == "FACTURA") 
                    <tr>
                        <th colspan="3"><p align="right">TOTAL IMPUESTO ( {{$negocio[0]->impuesto}} %):</p></th>
                        <th><p align="right">${{number_format($compra->total*($negocio[0]->impuesto)/100,2)}}</p></th>
                    </tr>
                    @endif
                    <tr>
                        <th  colspan="3"><p align="right">TOTAL PAGAR:</p></th>
                        @if($compra->tipo_identificacion == "FACTURA") 
                        <th><p align="right">${{number_format($compra->total+($compra->total*($negocio[0]->impuesto)/100),2)}}</p></th>
                        @else
                        <th><p align="right">${{number_format($compra->total,2)}}</p></th>
                        @endif
                    </tr> 

                </tfoot>

                <tbody>
                   
                   @foreach($detalles as $det)

                    <tr>
                     
                      <td>{{$det->producto}}</td>
                      <td>${{$det->precio}}</td>
                      <td>{{$det->cantidad}}</td>
                      <td>${{number_format($det->cantidad*$det->precio,2)}}</td>
                    
                    
                    </tr> 


                   @endforeach
                   
                </tbody>
                
                
                </table>
              </div>
            
            </div>


    </div><!--fin del div card body-->
  </main>

@endsection