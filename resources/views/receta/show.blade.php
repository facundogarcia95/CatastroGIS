@extends('principal')
@section('contenido')
@inject('productoControlador', 'App\Http\Controllers\ProductoController')


<main class="main">

 <div class="card-body">

    
            <div class="form-group row m-1 bg-light">

                  <div class="col-md-12 border"> 

                    <h2 class="text-left text-uppercase p-3">Detalle de Receta</h2>
                
                </div>

                    <div class="col-md-4 border">  

                        <label class="form-control-label m-1" for="nombre">Nombre Receta:</label>
                        
                        <p class="m-1 font-weight-bold">{{$receta->nombre}}</p>
                            
                    </div>

                    <div class="col-md-4 border">  

                    <label class="form-control-label m-1"  for="documento">Usuario:</label>

                    <p class="m-1 font-weight-bold">{{$receta->usuario}}</p>
                    
                    </div>

                    <div class="col-md-4 border">
                            <label class="form-control-label m-1" for="num_compra">Número Receta:</label>
                            
                            <p class="m-1 font-weight-bold">#{{$receta->id}}</p>
                    </div>

            </div>

            
            <br/><br/>

           <div class="form-group row border m-1  bg-light">

              <h3 class="m-2">Lista de Insumos Utilizados</h3>

              <div class="col-md-12">
                <table id="detalles" class="table table-responsive table-bordered table-striped table-sm">
                <thead>
                    <tr class="bg-dark text-light">
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Costo</th>
             
                    </tr>
                </thead>

                <tbody>

                   @php
                   $totalCosto = 0;    
                   @endphp

                   @foreach($detalles as $det)

                    <tr>
                     
                      <td><p class="h6">#{{$det->codigo}} - {{$det->producto}}</p></td>
                      <td><p class="h6">{{$det->cantidad}} {{$det->unidad}}</p></td>
                      
                      <td>
                        <p class="h6">

                          @if ($productoControlador->costoProducto($det->id) == null)
                              $0
                           
                          @else
                              ${{ ( $productoControlador->costoProducto($det->id) * $det->cantidad )}}
                              @php $totalCosto += $productoControlador->costoProducto($det->id) * $det->cantidad; @endphp
                          
                            @endif
                      </p>

                    </td>
                      
                    </tr> 


                   @endforeach
                   
                </tbody>

                <tfoot class="bg-light">
                    <tr>
                        <th  colspan="2"><p align="right">COSTO TOTAL:</p></th>
                        <th><p align="left">${{$totalCosto}}</p></th>
                    </tr>
                </tfoot>
                
                
                </table>
              </div>
            
            </div>


    </div><!--fin del div card body-->
  </main>

@endsection