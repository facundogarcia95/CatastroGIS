    
    <div class="form-group row">
            <label class="col-md-3 form-control-label" for="titulo">Categoría</label>
            
            <div class="col-md-9">
            
                <select class="form-control" name="idCategoria" id="id_categoria" required>
                                                
                <option value="">Seleccionar</option>
                
                @foreach($categorias as $cat)
                  
                   <option value="{{$cat->id}}">{{$cat->nombre}}</option>
                        
                @endforeach

                </select>
            
            </div>
                                       
    </div>
    

    <div class="form-group row">
        <label class="col-md-3 form-control-label" for="titulo">Tipo de Producto</label>
        
        <div class="col-md-9" >
        
            <select class="form-control" name="idTipoProductos" id="id_tipoproductos" onchange="tipoProducto(this)" required>
                                            
            <option value="">Seleccionar</option>
            
            @foreach($tipoProductos as $tipo)
              
               <option value="{{$tipo->id}}">{{$tipo->nombre}}</option>
                    
            @endforeach

            </select>

        </div>
                                   
</div>
    
    
    <div class="form-group row">
                <label class="col-md-3 form-control-label" for="codigo">Código</label>
                <div class="col-md-9">
                    <input type="text" id="codigo" name="codigo" class="form-control" placeholder="Ingrese el Código" required pattern="[0-9]{0,15}">
                   
                </div>
    </div>

     <div class="form-group row">
                <label class="col-md-3 form-control-label" for="nombre">Nombre</label>
                <div class="col-md-9">
                    <input type="text" id="nombre" name="nombre" class="form-control text-uppercase" placeholder="Ingrese la nombre" required pattern="^[a-zA-Z0-9_áéíóúñ\s]{0,100}$">
                </div>
    </div>
    
    <div class="collapse" id="collapsePrecioVenta">
        <div class="form-group row">
                <label class="col-md-3 form-control-label" for="nombre">Precio Venta</label>
                <div class="col-md-9">
                    <input type="number" id="precio_venta" name="precio_venta" class="form-control" placeholder="Ingrese el precio venta" pattern="^{0,100}$">
                </div>
        </div>
    </div>

    <div class="form-group row">
                <label class="col-md-3 form-control-label" for="imagen">Imagen</label>
                <div class="col-md-9">
                  
                    <input type="file" id="imagen" name="imagen" class="form-control">
                       
                </div>
    </div>


    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times fa-2x"></i> Cerrar</button>
        <button type="submit" class="btn btn-success"><i class="fa fa-save fa-2x"></i> Guardar</button>
        
    </div>

   