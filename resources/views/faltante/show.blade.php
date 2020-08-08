@extends('principal')
@section('contenido')


<main class="main">
  @include('breadcrumb.bread')
 <div class="card-body">

  <h2 class="text-center">Detalle de Ajuste</h2><br/><br/><br/>

    
            <div class="form-group row ">

                    <div class="col-md-3 border">  

                        <label class="form-control-label h6" for="nombre">Creado por:</label>
                        
                        <p>{{$faltante->nombre}}</p>
                            
                    </div>

                    <div class="col-md-6 border">
                            <label class="form-control-label h6" for="observacion">Observacion</label>
                            
                            @isset($faltante->observacion)
                              <p>{{$faltante->observacion}}</p>
                            @else    
                              <p>SIN OBSERVACIÓN</p>
                            @endisset
                  
                    </div>

                    <div class="col-md-3 border">
                      <label class="form-control-label h6" for="fecha_creacion">Fecha Creación</label>
                      
                      <p>{{$faltante->created_at}}</p>
                    </div>

            </div>

            
            <br/><br/>

           <div class="form-group row border">

              <h3>Detalle de Faltante</h3>

              <div class="table-responsive col-md-12">
                <table id="detalles" class="table table-bordered table-striped table-sm">
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