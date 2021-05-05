   
<div class="form-group row">
    <label class="col-md-3 form-control-label" for="nombre">Código</label>
    <div class="col-md-9">
        <input type="text" id="tipo_afectacion_codigo" name="tipo_afectacion_codigo" class="form-control" placeholder="Ingrese el Código">
        
    </div>
</div>

<div class="form-group row">
    <label class="col-md-3 form-control-label" for="nombre">Descripción</label>
    <div class="col-md-9">
        <input type="text" id="tipo_afectacion_descrip" name="tipo_afectacion_descrip" class="form-control" placeholder="Ingrese la Descripción" required>
        
    </div>
</div>

<div class="form-group row">
    <label class="col-md-3 form-control-label" for="nombre">Estado</label>
    <div class="col-md-9">
    
        <select class="form-control" name="tipo_estado_id" id="tipo_estado_id" required>
        
        @foreach($estados as $estado)
          
           <option value="{{$estado->tipo_estado_id}}">{{$estado->tipo_estado_descrip}}</option>
                
        @endforeach

        </select>
    
    </div>
</div>

<div class="form-group row">
    <label class="col-md-3 form-control-label" for="rol">Seccion</label>
    
    <div class="col-md-9">
    
        <select class="form-control" name="seccion_id" id="seccion_id" required>
                                        
        <option value="" >Seleccione</option>
        
        @foreach($secciones as $seccion)
          
           <option value="{{$seccion->seccion_id}}">{{$seccion->seccion_descrip}}</option>
                
        @endforeach

        </select>
    
    </div>
                               
</div>



<div class="modal-footer">
 <button type="submit" class="btn btn-success rounded"><i class="fa fa-save fa-2x"></i> Guardar</button>
 <button type="button" class="btn btn-danger rounded" data-dismiss="modal"><i class="fa fa-times fa-2x"></i> Cerrar</button>
</div>