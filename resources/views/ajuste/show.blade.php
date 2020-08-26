@extends('principal')
@section('contenido')


<main class="main">
  @include('breadcrumb.bread')
 <div class="card-body">
    
            <div class="form-group row  border m-1 bg-light">
              
              <div class="col-md-12 border"> 

                <h2 class="text-left text-uppercase p-3">Detalle de Compra</h2>
            
              </div>

                    <div class="col-md-3 border">  

                        <label class="form-control-label h6" for="nombre">Creado por:</label>
                        
                        <p>{{$ajuste->nombre}}</p>
                            
                    </div>

                    <div class="col-md-6 border">
                            <label class="form-control-label h6" for="observacion">Observacion</label>
                            
                            @isset($ajuste->observacion)
                              <p>{{$ajuste->observacion}}</p>
                            @else    
                              <p>SIN OBSERVACIÓN</p>
                            @endisset
                  
                    </div>

                    <div class="col-md-3 border">
                      <label class="form-control-label h6" for="fecha_creacion">Fecha Creación</label>
                      
                      <p>{{$ajuste->created_at}}</p>
                    </div>

            </div>

            
            <br/><br/>

           <div class="form-group row border m-1  bg-light">

              <h3 class="m-2">Detalle de Ajuste</h3>

              <div class=" col-md-12">
                
                <table id="detalles" class="table table-responsive table-bordered table-striped table-sm">
                
                  <thead>
                    <tr class="bg-success">

                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Unidad</th>
                        <th>Motivo</th>

                    </tr>
                </thead>
          

                <tbody>
                   
                   @foreach($detalles as $det)

                    <tr>
                     
                      <td>{{$det->producto}}</td>
                      <td>{{$det->cantidad}}</td>
                      <td>{{$det->unidad}}</td>
                      <td><b>{{$det->motivo}}</b></td>
                    
                    
                    </tr> 


                   @endforeach
                   
                </tbody>
                
                
                </table>
              </div>
            
            </div>


    </div><!--fin del div card body-->
  </main>

@endsection