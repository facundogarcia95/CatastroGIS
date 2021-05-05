<h4>Expediente</h4>

<div class="form-group row">
    <div class="col-lg-4 col-md-6 col-xs-12">
        <div class="input-group mt-2 ">
            <div class="input-group-addon">Nro:</div>
            <input type="number" id="mejora_nro_exp" name="mejora_nro_exp" class="form-control text-uppercase" placeholder="Ingrese Nro. Expediente" required>
        </div>
    </div>   
    <div class="col-lg-4 col-md-6 col-xs-12">
        <div class="input-group mt-2 ">
            <div class="input-group-addon">Letra:</div>
            <input type="text" id="mejora_letra_exp" name="mejora_letra_exp" class="form-control text-uppercase" placeholder="Ingrese Letra Expediente" required>
        </div>
    </div>  
    <div class="col-lg-4 col-md-6 col-xs-12">
        <div class="input-group mt-2 ">
            <div class="input-group-addon">Fecha:</div>
            <input type="date" id="mejora_fecha_exp" name="mejora_fecha_exp" class="form-control" placeholder="Ingrese Fecha Expediente" required>
        </div>
    </div>  
</div>
<hr>
<div class="form-group row">
    <label class="col-md-3 form-control-label" for="nombre">Tipo de Construccion</label>
    <div class="col-md-9">
        <select class="form-control text-uppercase" name="tipo_mejora_categoria_id" id="tipo_mejora_categoria_id" onchange="esPH(this.value)" required>
            <option value=""></option>
        @foreach($mejoraconstrucciones as $mejoraconstruccion)
           <option value="{{$mejoraconstruccion->tipo_mejora_categoria_id}}">{{$mejoraconstruccion->tipo_mejora_categoria_descrip}}</option>                
        @endforeach
        </select>
    </div>
</div>
<div class="form-group row">
    <label class="col-md-3 form-control-label" for="nombre">Tipo de Uso</label>
    <div class="col-md-9">
        <select class="form-control text-uppercase" name="tipo_mejora_uso_id" id="tipo_mejora_uso_id" required>
            <option value=""></option>
        @foreach($mejorausos as $mejorauso)
           <option value="{{$mejorauso->tipo_mejora_uso_id}}">{{$mejorauso->tipo_mejora_uso_descrip}}</option>                
        @endforeach
        </select>
    </div>
</div>
<div class="form-group row">
    <label class="col-md-3 form-control-label" for="nombre">Superficie Cubierta</label>
    <div class="col-md-9">
        <input type="text" id="mejora_sup_cub" name="mejora_sup_cub" class="form-control" placeholder="Ingrese Superficie Cubierta" required>
    </div>
</div>
<div class="form-group row">
    <label class="col-md-3 form-control-label" for="nombre">Superficie Semicubierta</label>
    <div class="col-md-9">
        <input type="text" id="mejora_sup_semi_cub" name="mejora_sup_semi_cub" class="form-control" placeholder="Ingrese Superficie Semicubierta">
    </div>
</div>
<div class="form-group row">
    <label class="col-md-3 form-control-label" for="nombre">Superficie Semicubierta PH</label>
    <div class="col-md-9">
        <input type="text" id="mejora_sup_comun_ph" name="mejora_sup_comun_ph" class="form-control" placeholder="Ingrese Superficie Semicubierta PH">
    </div>
</div>
<div class="form-group row">
    <label class="col-md-3 form-control-label" for="nombre">Porcentaje de Dominio</label>
    <div class="col-md-9">
        <input type="number" id="mejora_porc_dominio" name="mejora_porc_dominio" class="form-control" placeholder="Ingrese Porcentaje de dominio">
    </div>
</div>
<div class="form-group row">
    <label class="col-md-3 form-control-label" for="nombre">Mejora DPC</label>
    <div class="col-md-9">
        <input type="text" id="mejora_categoria_dpc" name="mejora_categoria_dpc" class="form-control" placeholder="Mejora DPC">
    </div>
</div>
<div class="form-group row">
    <label class="col-md-3 form-control-label" for="nombre">Tipo de Mejora</label>
    <div class="col-md-9">
        <select class="form-control" name="tipo_mejora_id" id="tipo_mejora_id" required>
            <option value=""></option>
        @foreach($tipomejoras as $tipomejora)
           <option value="{{$tipomejora->tipo_mejora_id}}">{{$tipomejora->tipo_mejora_descrip}}</option>                
        @endforeach
        </select>
    </div>
</div>
<div class="form-group row">
    <label class="col-md-3 form-control-label" for="nombre">Destino de Mejora</label>
    <div class="col-md-9">
        <select class="form-control" name="tipo_mejora_destino_id" id="tipo_mejora_destino_id">
            <option value=""></option>
        @foreach($tipomejoradestinos as $tipomejoradestino)
           <option value="{{$tipomejoradestino->tipo_mejora_destino_id}}">{{$tipomejoradestino->tipo_mejora_destino_descrip}}</option>                
        @endforeach
        </select>
    </div>
</div>
<div class="form-group row">
    <label class="col-md-3 form-control-label" for="nombre">Observaciones</label>
    <div class="col-md-9">
        <input type="textarea" id="mejora_observacion" name="mejora_observacion" class="form-control" placeholder="Observaciones">
    </div>
</div>

<div class="modal-footer">
 <input type="hidden" id="parcela_id" name="parcela_id" value="{{$parcela_id}}" required>
 <input type="hidden" id="idrol" name="idrol" value="{{$idrol}}" required>
 <input type="hidden" id="bloquear" name="bloquear" value="{{$bloqueo->usuario_id}}">
 @if(Auth::user()->idrol != 3)
 {!!$bloqueo->user->usuario_nombre!!}
 @else
    No posee permisos
 @endif
 <button type="button" class="btn btn-success rounded" id="buttonAltaMejora" onclick="$('#altaMejora').modal('show')"><i class="fa fa-times fa-2x"></i> Alta</button>
 <button type="button" class="btn btn-danger rounded" id="buttonBajaMejora" onclick="$('#bajaMejora').modal('show')"><i class="fa fa-times fa-2x"></i> Baja</button>
 <button type="submit" class="btn btn-success rounded"  id="buttonGuardarMejora"><i class="fa fa-save fa-2x"></i> Guardar</button>    
 <button type="button" class="btn btn-danger rounded" data-dismiss="modal"><i class="fa fa-times fa-2x"></i> Cerrar</button>
</div>