@extends('principal')
@section('contenido')


<main class="main">
@include('breadcrumb.bread')
 <div class="card-body">

 <h2>Agregar Producto Elaborado</h2><br/>

 <div class="col-sm-12 mt-4">
    @if ( session('error') )
        <div class="alert alert-danger" role="alert">{{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
        </div>
    @endif
</div>



    <form 
    
    @isset($productoEditar[0])

    action="{{route('receta.update','test')}}"
    
    @else

    action="{{route('receta.store')}}"
   
    @endisset

    method="POST" enctype="multipart/form-data">  

    @isset($productoEditar[0])
        {{method_field('patch')}}
    @endisset
    
    {{csrf_field()}}

    @isset($productoEditar[0])

        <input type="hidden" id="idproducto" name="idproducto" value="{{$productoEditar[0]->id}}">
        <input type="hidden" id="id_receta" name="id_receta" value="{{$productoEditar[0]->idreceta}}">
        <input type="hidden" id="idTipoProductos" name="idTipoProductos" value="{{$productoEditar[0]->tipo_producto}}">
    
    @endisset

    <div class="border p-2">   

            <div class="form-group row">

                <div class="col-md-4 mt-3">
                        <label class="form-control-label" for="cantidad">Nombre Producto</label>
                        
                        @isset($productoEditar[0])
                        
                            <input type="text" id="nombre" value="{{$productoEditar[0]->nombre}}" name="nombre" class="form-control text-uppercase" placeholder="Ingrese Nombre" pattern="^[a-zA-Z0-9_áéíóúñ\s]{0,100}$">

                        @else

                            <input type="text" id="nombre" name="nombre" class="form-control text-uppercase" placeholder="Ingrese Nombre" pattern="^[a-zA-Z0-9_áéíóúñ\s]{0,100}$">

                        @endisset
                            
                       
                        


                        
                </div>

            </div>

            <div class="form-group row">

                <div class="col-md-8">  

                    <label class="form-control-label" for="nombre">Categoria</label>

                        <select class="form-control selectpicker" name="idcategoria" id="idcategoria" data-live-search="true" required>
                                                        
                        <option value="0">Seleccione</option>
                        
                        @foreach($categorias as $categoria)
                        
                        <option value="{{$categoria->id}}"
                            @isset($productoEditar[0])

                                @if ($categoria->id == $productoEditar[0]->idcategoria)
                                    selected
                                @endif

                            @endisset>{{$categoria->nombre}}</option>
                                
                        @endforeach

                        </select>

                </div>

            </div>

            <div class="form-group row">
                
                <label class="col-md-12 form-control-label" for="titulo">Unidad de Medida</label>
                
                <div class="col-md-8" >
                
                    <select class="form-control" name="unidad_medida" id="unidad_medida" required>
                                                    
                    <option value="">Seleccionar</option>
                    
                    @foreach($unidades as $unidad)
                    
                    <option value="{{$unidad->id}}"
                            @isset($productoEditar[0])

                                @if ($unidad->id == $productoEditar[0]->unidad_medida)
                                    selected
                                @endif

                            @endisset
                            >{{$unidad->unidad}}</option>
                            
                    @endforeach

                    </select>

                </div>
                                        
            </div>

            <div class="form-group row">
                
                <label class="col-md-8 form-control-label" for="codigo">Código</label>
            
                <div class="col-md-8">

                            @isset($productoEditar[0])
                                
                                <input type="text" id="codigo" value="{{$productoEditar[0]->codigo}}" name="codigo" class="form-control" placeholder="Ingrese el Código" required pattern="[0-9]{0,15}">

                            @else

                                <input type="text" id="codigo" name="codigo" class="form-control" placeholder="Ingrese el Código" required pattern="[0-9]{0,15}">

                            @endisset

                
                </div>

            </div>


            <div class="form-group row">

                <label class="col-md-8 form-control-label" for="nombre">Precio Venta</label>

                <div class="col-md-8">

                    @isset($productoEditar[0])
                    
                        <input type="number" id="precio_venta" value="{{$productoEditar[0]->precio_venta}}" name="precio_venta" class="form-control" placeholder="Ingrese el precio venta" pattern="^[0-9]$">
                        
                    @else
                    
                        <input type="number" id="precio_venta" name="precio_venta" class="form-control" placeholder="Ingrese el precio venta" pattern="^[0-9]$">

                    @endisset


                </div>

            </div>



            <div class="form-group row">
        
                <label class="col-md-8 form-control-label" for="imagen">Imagen</label>
                
                <div class="col-md-8">
                
                    <input type="file" id="imagen" name="imagen" class="form-control">
                    
                </div>

            </div>

        </div>   

            <div class="form-group row mt-2">

                 <div class="col-md-8">  

                    <h4 class="text-left mt-1">Cargar Insumos</h4>

                        <label class="form-control-label" for="nombre">Insumo</label>

                            <select class="form-control selectpicker" name="id_insumo" id="id_insumo" data-live-search="true">
                                                            
                            <option value="" selected>Seleccione</option>
                            
                            @foreach($productos as $prod)
                            
                            <option value="{{$prod->id}}" nombre="{{$prod->producto}}" unidad="{{$prod->unidad}}">{{$prod->producto}} ({{$prod->unidad}})</option>
                                    
                            @endforeach

                            </select>

                </div>

            </div>

            <div class="form-group row">

                <div class="col-md-3">
                        <label class="form-control-label" for="cantidad">Cantidad</label>
                        
                        <input type="number" id="cantidad" name="cantidad" class="form-control" placeholder="Ingrese cantidad" pattern="[a-zA-Z0-9_áéíóúñ\s]{0,100}">
                </div>
               
                <div class="col-md-3 mt-3">
                        
                    <button type="button" id="agregar" class="btn btn-primary rounded"><i class="fa fa-plus fa-2x"></i> Agregar Insumo</button>
                </div>

            </div>

            <br/><br/>

           <div class="form-group row ">

              <h3 class="ml-1">Lista de Insumos del Producto</h3>

              <div class="mt-1 col-md-12">
                <table id="detalles" class="table table-bordered  table-respinsive table-striped table-sm">
                <thead>
                    <tr class="bg-dark text-light">
                        <th>Eliminar</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Unidad</th>
                    </tr>
                </thead>
                 
                <tbody>
                    @isset($insumosEditar[0])

                    @php
                        $count = 0;    
                    @endphp

                    @foreach ($insumosEditar as $insumo)


                    <tr class="selected" id="fila{{$count}}"><td><button type="button" class="btn btn-danger btn-sm" onclick="eliminar({{$count}});"><i class="fa fa-times fa-2x"></i></button></td> <td><input type="hidden" name="id_producto[]" value="{{$insumo->id}}">{{$insumo->nombre}}</td> <td><input type="number" step="0.1" name="cantidad[]" value="{{$insumo->cantidad}}"><td>{{$insumo->unidad}}</td></tr>


                    @php
                        $count++;    
                    @endphp
                        
                    @endforeach

                    @endisset

                </tbody>
                
                
                </table>
              </div>
            
            </div>

            <div class="modal-footer form-group row" id="guardar">
            
            <div class="col-md">
               <input type="hidden" name="_token" value="{{csrf_token()}}">
              
                <button type="submit" class="btn btn-success pull-right"><i class="fa fa-plus-square fa-2x"></i> Registrar</button>
            
            </div>

            </div>

    </form>

    </div><!--fin del div card body-->
  </main>

@push('scripts')
 <script>
     
  $(document).ready(function(){
     
     $("#agregar").click(function(){

         agregar();
     });

  });

  @isset($insumosEditar[0])

  var cont={{$count}};

   @else

   var cont=0;

   @endisset

   $("#guardar").hide();

  @isset($insumosEditar[0])

    $("#guardar").show();

  @endisset
     function agregar(){

          id_producto= $("#id_insumo").val();
          unidad= $("#id_insumo option:selected").attr('unidad');
          producto= $("#id_insumo option:selected").attr('nombre');
          cantidad= $("#cantidad").val();      
          
          if(id_producto !="" && cantidad!="" && cantidad>0){
            
             
            var fila= '<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-danger btn-sm" onclick="eliminar('+cont+');"><i class="fa fa-times fa-2x"></i></button></td> <td><input type="hidden" name="id_producto[]" value="'+id_producto+'">'+producto+'</td> <td><input type="number"  step="0.1" name="cantidad[]" class="form-control" readonly value="'+cantidad+'"></td><td>'+unidad+'</td> </tr>';

             cont++;
             limpiar();
             
             $('#detalles').append(fila);
             evaluar();
             
            }else{

               // alert("Rellene todos los campos del detalle de la compra, revise los datos del producto");
               
                Swal.fire({
                type: 'error',
                //title: 'Oops...',
                text: 'Rellene todos los campos del detalle de insumos',
              
                })
            
            }
         
     }

    
     function limpiar(){
        
        $("#cantidad").val("");
        $("#id_insumo").val("");
        
     }


     function eliminar(index){ 
       
        $("#fila" + index).remove();
        evaluar();
     }

     function evaluar(){

        var rowCount = $('#detalles tr').length;

        if(rowCount>0){

        $("#guardar").show();

        } else{
            
        $("#guardar").hide();

        }
}

 </script>
@endpush

@endsection