@extends('principal')
@section('contenido')


<main class="main">

 <div class="card-body">

  

    
            <div class="form-group row  m-1 bg-light">

                  <div class="col-md-12 border"> 

                    <h2 class="text-left text-uppercase p-3">Detalle de Venta</h2>
                
                </div>

                    <div class="col-md-4 border">  

                        <label class="form-control-label m-1" for="nombre">Cliente</label>
                        
                        <p class="m-1 font-weight-bold">{{$venta->nombre}}</p>
                            
                    </div>

                    <div class="col-md-4 border">  

                    <label class="form-control-label m-1" for="documento">Documento</label>

                    <p class="m-1 font-weight-bold">{{$venta->tipo_identificacion}}</p>
                    
                    </div>

                    <div class="col-md-4 border">
                            <label class="form-control-label m-1" for="num_venta">Número Venta</label>
                            
                            <p class="m-1 font-weight-bold">{{$venta->num_venta}}</p>
                    </div>

            </div>
            
            <br/><br/>

           <div class="form-group row border m-1  bg-light">

              <h3 class="m-2">Lista de Productos</h3>

              <div class=" col-md-12">
                <table id="detalles" class="table table-bordered  table-responsive table-default table-sm">
                <thead>
                    <tr class="bg-dark text-light">

                        <th>Producto</th>
                        <th>Precio Venta ($)</th>
                        <th>Descuento ($)</th>
                        <th>Cantidad</th>
                        <th>SubTotal ($)</th>
                    </tr>
                </thead>
                 
                <tfoot class="bg-white">
                   
                   <!--<th><h2>TOTAL</h2></th>
                   <th></th>
                   <th></th>
                   <th></th>
                   <th><h4 id="total">{{$venta->total}}</h4></th>-->
                   <tr>
                        <th  colspan="4"><p align="right">TOTAL:</p></th>
                        <th><p align="right">${{number_format($venta->total,2)}}</p></th>
                    </tr>
                    @if($venta->tipo_identificacion == "FACTURA") 
                    
                      <tr>
                          <th colspan="4"><p align="right">TOTAL IMPUESTO ({{$negocio[0]->impuesto}}%):</p></th>
                          <th><p align="right">${{number_format($venta->total*($negocio[0]->impuesto)/100,2)}}</p></th>
                      </tr>
                      
                    @endif
                    <tr>
                        <th  colspan="4"><p align="right">TOTAL PAGAR:</p></th>
                        @if($venta->tipo_identificacion == "FACTURA") 
                        <th><p align="right">${{number_format($venta->total+($venta->total*($negocio[0]->impuesto)/100),2)}}</p></th>
                        @else
                        <th><p align="right">${{number_format($venta->total,2)}}</p></th>
                        @endif
                    </tr>  
                </tfoot>

                <tbody>
                   
                   @foreach($detalles as $det)

                    <tr>
                     
                      <td>{{$det->producto}}</td>
                      <td>${{$det->precio}}</td>
                      <td>{{$det->descuento}}</td>
                      <td>{{$det->cantidad}}</td>
                      <td>${{number_format($det->cantidad*$det->precio - $det->cantidad*$det->precio*$det->descuento/100,2)}}</td>
                    
                    
                    </tr> 


                   @endforeach
                   
                </tbody>
                
                
                </table>
              </div>
            
            </div>


    </div><!--fin del div card body-->
  </main>

@endsection