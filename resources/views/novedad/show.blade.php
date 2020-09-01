@extends('principal')
@section('contenido')


<main class="main">

 <div class="card-body">
   
            <div class="form-group row border m-1 bg-light">

              <div class="col-md-12 border"> 

              <h2 class="text-left text-uppercase p-3"> {{$novedad->nombre}}}</h2>
              
              </div>

                    <div class="col-md-4 border">  

                        <label class="form-control-label m-1" for="nombre">Empleado</label>
                        
                        <p class="m-1 font-weight-bold">{{$empleado->nombre}} {{$empleado->apellido}}</p>
                            
                    </div>

                    <div class="col-md-4 border">  

                    <label class="form-control-label m-1" for="documento">Documento</label>

                    <p class="m-1 font-weight-bold">{{$empleado->num_documento}}</p>
                    
                    </div>

                    <div class="col-md-4 border">
                      <label class="form-control-label m-1" for="fecha_nacimient0">Fecha</label>
                      
                      <p class="m-1 font-weight-bold">{{$empleado->fecha_nacimiento}}</p>
                    </div>

            </div>

            
            <br/><br/>

           <div class="form-group row border m-1  bg-light">

              <h3 class="m-2">Detalle de Novedad</h3>

              <div class="col-md-12">
                <table id="detalles" class="table table-responsive  table-bordered table-default table-sm">
                <thead>
                    <tr class="bg-dark text-light">

                        
                    </tr>
                </thead>
                 
                <tbody>
                   
                   @foreach($detalles as $det)

                    <tr>
         
                    </tr> 


                   @endforeach
                   
                </tbody>
                
                
                </table>
              </div>
            
            </div>


    </div><!--fin del div card body-->
  </main>

@endsection