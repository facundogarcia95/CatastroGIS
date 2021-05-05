@extends('principal')

@section('breadcrumb')
    {{ Breadcrumbs::render('versionado', $version) }}
@endsection

@section('contenido')

    <div class="card-body">
       

        <div class="form-group row  m-1 bg-light">

            <div class="col-md-12 border"> 

              <h2 class="text-left text-uppercase p-3">Detalle de Versión</h2>
          
            </div>

              <div class="col-md-3 border">  

                  <label class="form-control-label m-1" for="Fecha">Fecha</label>
                  
                  <p class="m-1 font-weight-bold">{{$version->fecha}}</p>
                      
              </div>

              <div class="col-md-3 border">  

              <label class="form-control-label m-1" for="Versión">Versión</label>

              <p class="m-1 font-weight-bold">{{$version->version}}</p>
              
              </div>

              <div class="col-md-6 border">
                      <label class="form-control-label m-1" for="Descripción">Descripción</label>
                      
                      <p class="m-1 font-weight-bold">{{$version->descripcion}}</p>
              </div>

        </div>

            <br/><br/>

            @isset($detalles)
                
        <div class="form-group row border m-1  bg-light">
   
                 <h3 class="m-2">Detalles de versión</h3>
   
                 <div class=" col-md-12">
                   <table id="detalles" class="table table-bordered  table-responsive table-default table-sm">
                        <thead>
                            <tr class="bg-dark text-light">
        
                                <th>Título</th>
                                <th>Descripción</th>
                            </tr>
                        </thead>
                        <tbody>
                        
                            @foreach($detalles as $det)
        
                                <tr>
                                
                                    <td>{{$det->titulo}}</td>
                                    <td>{!! $det->descripcion !!}</td>
                            
                                </tr> 
        
                            @endforeach
                            
                            </tbody>
                 
                    </table>
                </div>
            
        </div>
        @endisset
    </div>
    
    
@endsection