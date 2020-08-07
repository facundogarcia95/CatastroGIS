@extends('principal')
@section('contenido')


<main class="main">

 <div class="card-body">

  <h2 class="text-center">Detalle de Faltante</h2><br/><br/><br/>

    
            <div class="form-group row">

                    <div class="col-md-4">  

                        <label class="form-control-label" for="nombre">Usuario</label>
                        
                        <p>{{$faltante->nombre}}</p>
                            
                    </div>

                    <div class="col-md-4">  

                    <label class="form-control-label" for="documento">Motivo</label>

                    <p>{{$faltante->motivo}}</p>
                    
                    </div>

                    <div class="col-md-4">
                            <label class="form-control-label" for="num_compra">Fecha Creación</label>
                            
                            <p>{{$faltante->create_at}}</p>
                    </div>

                    <div class="col-md-12">
                      <label class="form-control-label" for="num_compra">Fecha Creación</label>
                      
                      <p>{{$faltante->observacion}}</p>
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

                    </tr>
                </thead>
          

                <tbody>
                   
                   @foreach($detalles as $det)

                    <tr>
                     
                      <td>{{$det->producto}}</td>
                      <td>{{$det->cantidad}}</td>
                      <td>${{$det->unidad}}</td>
                    
                    
                    </tr> 


                   @endforeach
                   
                </tbody>
                
                
                </table>
              </div>
            
            </div>


    </div><!--fin del div card body-->
  </main>

@endsection