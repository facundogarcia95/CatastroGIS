
<div class="form-group row">
   <label class="col-md-3 form-control-label" for="tramite_fecha_exp">Fecha</label>
   <div class="col-md-9">
       <input type="date" id="tramite_fecha_exp" name="tramite_fecha_exp" class="form-control" placeholder="Ingrese Fecha" required>
       {!!$errors->first('tramite_fecha_exp','<span class="invalid-feedback">:message</span>')!!}
   </div>
</div>

<div class="form-group row">
   <label class="col-md-3 form-control-label" for="nombre">Tipo Trámite</label>
   <div class="col-md-9">
       <select id="tipo_tramite" name="tipo_tramite" class="form-control" required>
         @foreach ($tiposTramites as $tipo)
             <option value="{{$tipo->tipo_tramite_id}}">{{$tipo->tipo_tramite_codigo}} - {{$tipo->tipo_tramite_descrip}}</option>
         @endforeach
      </select>
      {!!$errors->first('tipo_tramite','<span class="invalid-feedback">:message</span>')!!}
   </div>
</div>

<div class="form-group row">
   <label class="col-md-3 col-sm-4 form-control-label" for="tramite_nro_exp">N° Exp.</label>
   <div class="col-md-3 col-sm-8">
       <input type="text" id="tramite_nro_exp" name="tramite_nro_exp" class="form-control" placeholder="Ingrese N° Exp." required>
       {!!$errors->first('tramite_nro_exp','<span class="invalid-feedback">:message</span>')!!}
   </div>
   <label class="col-md-3 col-sm-4 form-control-label" for="tramite_letra_exp">Letra Exp.</label>
   <div class="col-md-3 col-sm-8">
       <input type="text" id="tramite_letra_exp" name="tramite_letra_exp" class="form-control" placeholder="Ingrese Letra Exp.">
   </div>
</div>

<div class="form-group row">
   <label class="col-md-3 col-sm-4 form-control-label" for="tramite_superficie">Superficie</label>
   <div class="col-md-3 col-sm-8">
      <input type="text" id="tramite_superficie" name="tramite_superficie" class="form-control" placeholder="Ingrese Superficie">
  </div>
</div>