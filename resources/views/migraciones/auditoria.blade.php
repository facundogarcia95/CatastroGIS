@extends('principal')
@section('breadcrumb')
    {{ Breadcrumbs::render('auditoria_migracion') }}
@endsection
@section('contenido')

<div class="container-fluid mt-6">
    
    <div class="card">
   

        <div class="card-header">

           <h2>Migración de Auditorias</h2><br/>
            
        </div>
        <div class="card-body">
            <div class="form-group row">
                <div class="col-md-12">
             
                  <form action="{{url('auditorias_migracion')}}" method="GET" class="form-horizontal was-validated" >

                     {{csrf_field()}}
                     <div class="form-group row">
                        <label class="col-md-3 form-control-label font-weight-bold" for="year">AÑO A MIGRAR</label>
                        <div class="col-md-9">
                           <input type="hidden"  id="table" name="tabla" value="auditorias_old">   
                           <input type="number" min="2010" id="year" name="year" class="form-control" placeholder="Ingrese el Año" required>   
                        </div>
                     </div>

                     <div class="modal-footer">
                     <button type="submit" class="btn btn-primary rounded comenzar"><i class="fa fa-check fa-2x"></i> Comenzar</button>
                     </div>

                 </form>
           
                </div>

                <div class="col-md-12">
                  @if ( session('success'))
                        <div class="alert alert-success" role="alert">{{session('success')}}
                           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true" class="text-dark">&times;</span>
                           </button>
                        </div>
                  @elseif( session('error') )
                        <div class="alert alert-danger font-weight-bold" role="alert">{{session('error')}}
                           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true" class="text-dark">&times;</span>
                           </button>
                        </div>
                  @endif
                </div>
            </div>

            <div class="form-group row">
               <div class="col-md-12">
                  <h5>Auditorias migradas</h5><br/>
            
                  <table id="auditorias" class="table table-bordered table-striped dt-responsive nowrap" style="width: 100%">
                     <thead>
                         <tr class="bg-dark text-light">
                             <th>Auditorias</th>
                             <th>Año</th>
                         </tr>
                     </thead>
                     <tbody>
                        @foreach ($auditorias as $registro)
                           <tr>
                              <td>Cantidad: {{$registro->data}}</td>
                              <td>{{$registro->year}}</td>
                           </tr>
                        @endforeach
                     </tbody>
       
                 </table>
          
               </div>
           </div>
                
        </div>
    </div>

</div>

   @push('scripts')
      
   <script>
      $(".comenzar").on('click',function(){

         Swal.fire({
            title: 'Migrando auditorias',
            html:'<img src="./css/librerias/images/loader.gif" />',
            showClass: {
                popup: 'animate__animated animate__fadeInDown'
            },
            padding: '3em',
            background: '#fff',
            showConfirmButton: false,
            backdrop: ` rgba(0, 0, 0,0.6)
                        left top
                        no-repeat
                        `
            });
      })
   </script>

   @endpush
@endsection