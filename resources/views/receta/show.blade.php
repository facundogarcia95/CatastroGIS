@extends('principal')
@section('contenido')


<main class="main">

 <div class="card-body">

  <h2 class="text-center">Detalle de Receta</h2><br/><br/><br/>

    
            <div class="form-group row">

                    <div class="col-md-4 border">  

                        <label class="form-control-label h6" for="nombre">Nombre Receta:</label>
                        
                        <p class="h5">{{$receta->nombre}}</p>
                            
                    </div>

                    <div class="col-md-4 border">  

                    <label class="form-control-label h6"  for="documento">Usuario:</label>

                    <p class="h5">{{$receta->usuario}}</p>
                    
                    </div>

                    <div class="col-md-4 border">
                            <label class="form-control-label h6" for="num_compra">Número Receta:</label>
                            
                            <p class="h5">#{{$receta->id}}</p>
                    </div>

            </div>

            
            <br/><br/>

           <div class="form-group row border m-2">

              <h3>Lista de Insumos Utilizados</h3>

              <div class="table-responsive col-md-12">
                <table id="detalles" class="table table-bordered table-striped table-sm">
                <thead>
                    <tr class="bg-success">
                        <th>Producto</th>
                        <th>Cantidad</th>
             
                    </tr>
                </thead>

                <tbody>
                   
                   @foreach($detalles as $det)

                    <tr>
                     
                      <td><p class="h6">#{{$det->codigo}} - {{$det->producto}}</p></td>
                      <td><p class="h6">{{$det->cantidad}} {{$det->unidad}}</p></td>

                      
                    </tr> 


                   @endforeach
                   
                </tbody>
                
                
                </table>
              </div>
            
            </div>


    </div><!--fin del div card body-->
  </main>

@endsection