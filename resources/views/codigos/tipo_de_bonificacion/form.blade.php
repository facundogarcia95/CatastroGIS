
<div class="form-group row">
    <label class="col-md-3 form-control-label" for="nombre">Codigo</label>
    <div class="col-md-9">
        <input type="number" id="tipo_bonificacion_codigo" name="tipo_bonificacion_codigo" class="form-control" placeholder="Ingrese codigo de estado" required>
        
    </div>
</div>

<div class="form-group row">
    <label class="col-md-3 form-control-label" for="nombre">Descripción</label>
    <div class="col-md-9">
        <input type="text" id="tipo_bonificacion_descrip" name="tipo_bonificacion_descrip" class="form-control" placeholder="Ingrese la descripcion" required>
        
    </div>
</div>

<div class="form-group row">
    <label class="col-md-3 form-control-label" for="nombre">Porcentaje</label>
    <div class="col-md-9">
        <input type="text" id="tipo_bonificacion_porc" name="tipo_bonificacion_porc" class="form-control" placeholder="Ingrese el porcentaje">
        
    </div>
</div>

<div class="form-group row">
    <label class="col-md-3 form-control-label" for="nombre">Activo</label>
    <div class="col-md-9">
        <select class="form-control" name="tipo_estado_id" id="tipo_estado_id" required>
            @foreach($estados as $estado)
            <option value="{{$estado->tipo_estado_id}}">{{$estado->tipo_estado_descrip}}</option>                
            @endforeach
        </select>
    </div>
</div>

<div class="modal-footer">
 <button type="submit" class="btn btn-success rounded"><i class="fa fa-save fa-2x"></i> Guardar</button>
 <button type="button" class="btn btn-danger rounded" data-dismiss="modal"><i class="fa fa-times fa-2x"></i> Cerrar</button>
</div>