<div class="form-group row">
        <label class="col-md-3 form-control-label" for="nombre">Contenido</label>
        <div class="col-md-9">
            <select class="form-control" name="tipo_regimen_id" id="tipo_regimen_id">
                @foreach($tiporegimenes as $tiporegimen)
                    @if($tiporegimen->en_regimen == 1)
                        <option value="{{$tiporegimen->tipo_regimen_id}}">{{$tiporegimen->tipo_regimen_descrip}}</option>                
                    @endif
                @endforeach
            </select>
        </div>
</div>
<div style="text-align:center"><h4>Origen</h4></div>
<div class="form-group row">
        <label class="col-md-3 form-control-label" for="nombre">Descripcion</label>
        <div class="col-md-9">
            <input type="text" id="parcela_document_descrip" name="parcela_document_descrip" class="form-control" placeholder="Origen del Documento">
        </div>
</div>
<div class="form-group row">
        <label class="col-md-3 form-control-label" for="nombre">Fecha</label>
        <div class="col-md-9">
            <input type="date" id="parcela_document_f_origen" name="parcela_document_f_origen" class="form-control" placeholder="Fecha del Origen">
        </div>
</div>
<div class="form-group row">
        <label class="col-md-3 form-control-label" for="nombre">Expediente</label>
        <div class="col-md-9">
            <input type="text" id="parcela_document_expediente" name="parcela_document_expediente" class="form-control" placeholder="Expediente">
        </div>
</div>
<div class="form-group row">
    <label class="col-md-3 form-control-label" for="nombre">Seccion</label>
    <div class="col-md-9">
        <select class="form-control" name="seccion_id" id="seccion_id">
            <option value=""></option>
            @foreach($secciones as $seccion)
            <option value="{{$seccion->seccion_id}}">{{$seccion->seccion_descrip}}</option>                
            @endforeach
        </select>
    </div>
</div>
<div class="form-group row">
        <label class="col-md-3 form-control-label" for="nombre">Observaciones</label>
        <div class="col-md-9">
            <input type="text" id="parcela_document_observaciones" name="parcela_document_observaciones" class="form-control" placeholder="Descripcion del archivo">
        </div>
</div>
<hr>
<div style="text-align:center"><h4>Archivo</h4></div>