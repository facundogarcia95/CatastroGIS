<div class="form-group row">
    <label class="col-md-10 form-control-label" for="nombre"><b>AVISO:</b> El proceso de actualizacion tiene un tiempo estimado de {{$tiempo_estimado}} minutos para su finalizacion.</label>
</div>
<div class="form-group row">
    <label class="col-md-3 form-control-label" for="nombre">UTM $</label>
    <div class="col-md-9">
        <select class="form-control text-uppercase" name="utm_id" id="utm_id">
            @foreach($utms as $utm)
            <option value="{{$utm->utm_id}}">{{$utm->utm_valor}}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="modal-footer">
 <button id="ejecutar_script" type="submit" class="btn btn-success rounded"><i class="fa fa-save fa-2x"></i> ACTUALIZAR VALORES</button>
 <button type="button" class="btn btn-danger rounded" data-dismiss="modal"><i class="fa fa-times fa-2x"></i> Cerrar</button>
</div>