
<div class="form-group row">
    <label class="col-md-3 form-control-label" for="nombre">Estado de Parcela</label>
    <div class="col-md-9">
        <select class="form-control text-uppercase" name="tipo_parcela_estado_id" id="tipo_parcela_estado_id">
            @foreach($tipoparcelaestados as $tipoparcelaestado)
            <option value="{{$tipoparcelaestado->tipo_parcela_estado_id}}">{{$tipoparcelaestado->tipo_parcela_estado_codigo}}-{{$tipoparcelaestado->tipo_parcela_estado_descrip}}</option>                
            @endforeach
        </select>        
    </div>
</div>

<div class="form-group row">
    <label class="col-md-3 form-control-label" for="nombre">Parcela RyB</label>
    <div class="col-md-9">
        <select class="form-control text-uppercase" name="tipo_parcela_ryb_id" id="tipo_parcela_ryb_id">
            @foreach($tipoparcelarybs as $tipoparcelaryb)
            <option value="{{$tipoparcelaryb->tipo_parcela_ryb_id}}">{{$tipoparcelaryb->tipo_parcela_ryb_codigo}}-{{$tipoparcelaryb->tipo_parcela_ryb_descrip}}</option>                
            @endforeach
        </select>  
    </div>
</div>

<div class="form-group row">
    <label class="col-md-3 form-control-label" for="nombre">Calculo Avaluo Automatico</label>
    <div class="col-md-9">
        <select class="form-control text-uppercase" name="calculo_avaluo_auto" id="calculo_avaluo_auto">
            @foreach($calculosavaluosautos as $calculosavaluosauto)
            <option value="{{$calculosavaluosauto->calculo_avaluo_auto_id}}">{{$calculosavaluosauto->calculo_avaluo_auto_descr}}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group row">
    <label class="col-md-3 form-control-label" for="nombre">Calculo Avaluo Importe</label>
    <div class="col-md-9">
        <select class="form-control text-uppercase" name="calculo_avaluo_imp" id="calculo_avaluo_imp" onchange="cambio(this.value);">
            @foreach($calculosavaluosimps as $calculosavaluosimp)
            <option value="{{$calculosavaluosimp->calculo_avaluo_imp_id}}">{{$calculosavaluosimp->calculo_avaluo_imp_descr}}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="valor_utm collapse">
    <div class="form-group row">
        <label class="col-md-3 form-control-label" for="nombre">Valor UTM</label>
        <div class="col-md-9">
            <input type="number" step="1" min="0" id="tipo_parcela_utm" name="tipo_parcela_utm" class="form-control" placeholder="Ingrese Valor de UTM">
        </div>
    </div>

    <div class="form-group row">
        <label class="col-md-3 form-control-label" for="nombre">Fecha Desde</label>
        <div class="col-md-9">
            <input type="date" id="utm_fecha_desde" name="utm_fecha_desde" class="form-control" placeholder="Ingrese Fecha Desde">
        </div>
    </div>

    <div class="form-group row">
        <label class="col-md-3 form-control-label" for="nombre">Fecha Hasta</label>
        <div class="col-md-9">
            <input type="date" id="utm_fecha_hasta" name="utm_fecha_hasta" class="form-control" placeholder="Ingrese Fecha Hasta">
        </div>
    </div>
</div>

<div class="modal-footer">
 <button type="submit" class="btn btn-success rounded"><i class="fa fa-save fa-2x"></i> Guardar</button>
 <button type="button" class="btn btn-danger rounded" data-dismiss="modal"><i class="fa fa-times fa-2x"></i> Cerrar</button>
</div>