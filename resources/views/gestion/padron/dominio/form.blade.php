<div class="form-group row">
    <div class="col-md-9">
        <input type="hidden" id="persona_parcela_id" name="persona_parcela_id" class="form-control" placeholder="Ingrese el Origen" required>
   </div>
</div>

<div class="form-group row">
    <label class="col-md-3 form-control-label" for="nombre">Persona</label>
    <div class="col-md-9">
        <input class="persona" type="hidden" id="persona_id" name="persona_id" class="" required>
        <label class="persona_den" id="persona_denominacion" class="pr-2"></label>
        <button type="button" class="btn btn-primary rounded ml-0" 
            data-toggle="modal" 
            data-target="#buscarTitular">
            <i class="fa fa-search fa-1x"></i>
         Buscar</button>
         <div class="invalid-feedback valid-persona d-none">Seleccione el titular</div>
   </div>
</div>

<div class="form-group row">
    <label class="col-md-3 form-control-label" for="nombre">Figura</label>
    <div class="col-md-9">
        <select class="form-control" name="tipo_persona_parcela_id" id="tipo_persona_parcela_id" required>
            
            @foreach($tipopersonaparcela as $tipopersonaparcela)
            
            <option value="{{$tipopersonaparcela->tipo_persona_parcela_id}}">{{$tipopersonaparcela->tipo_persona_parcela_descrip}}</option>
            
            @endforeach
            
        </select>
    </div>
</div>

<div class="form-group row">
    <label class="col-md-3 form-control-label" for="nombre">Principal</label>
    <div class="col-md-9">
        @if(isset($persona_parcela))
            @if ($persona_parcela->persona_parcela_ppal == 1)
                <input type="checkbox" data-toggle="toggle" data-on="ES PRINCIPAL" data-off="NO ES PRINCIPAL" data-onstyle="success rounded font-btn "  data-offstyle="danger rounded font-btn"  id="persona_parcela_ppal"  checked >
            @else
                <input type="checkbox" data-toggle="toggle" data-on="ES PRINCIPAL" data-off="NO ES PRINCIPAL" data-onstyle="success rounded font-btn "  data-offstyle="danger rounded font-btn "  id="persona_parcela_ppal"  >
            @endif
            <input type="hidden" name="persona_parcela_ppal" class="persona_parcela_ppal_hidden" @if ($persona_parcela->persona_parcela_ppal == 1) value="1" @else value="0" @endif >
        @else
            <input type="checkbox" data-toggle="toggle" data-on="ES PRINCIPAL" data-off="NO ES PRINCIPAL" data-onstyle="success rounded font-btn "  data-offstyle="danger rounded font-btn"  id="persona_parcela_ppal"  checked >
        @endif
       
        
    </div>
</div>

<div class="form-group row">
    <label class="col-md-3 form-control-label" for="nombre">Origen</label>
    <div class="col-md-9">
        <input type="text" id="persona_parcela_origen" name="persona_parcela_origen" class="form-control" placeholder="Ingrese el Origen">
   </div>
</div>

<div class="form-group row">
    <label class="col-md-3 form-control-label" for="nombre">Tipo Instrumento</label>
    <div class="col-md-9">
        <select class="form-control" name="tipo_instrumento_id" id="tipo_instrumento_id" required>
            
            @foreach($tipoinstrumento as $tipoinstrumento)
            
            <option value="{{$tipoinstrumento->tipo_instrumento_id}}">{{$tipoinstrumento->tipo_instrumento_descrip}}</option>
            
            @endforeach
            
        </select>
   </div>
</div>

<div class="form-group row">
    <label class="col-md-3 form-control-label" for="nombre">Condición</label>
    <div class="col-md-9">
        <select class="form-control" name="tipo_condicion_id" id="tipo_condicion_id" required>
                
            @foreach($tipocondicion as $tipocondicion)
            
            <option value="{{$tipocondicion->tipo_condicion_id}}">{{$tipocondicion->tipo_condicion_descrip}}</option>
            
            @endforeach
            
        </select>
    </div>
</div>
   
<div class="form-group row">
    <label class="col-md-3 form-control-label" for="nombre">Porcentaje de Dominio</label>
    <div class="col-md-9">
        <input type="number" step="0.01" min="0" max="100" id="persona_parcela_dominio" name="persona_parcela_dominio" class="form-control" placeholder="Ingrese el porcentaje de dominio" required>
     </div>
</div>

<div class="form-group row">
    <label class="col-md-3 form-control-label" for="nombre">Nro Instrumento</label>
    <div class="col-md-9">
        <input type="text" id="persona_parcela_num_int" name="persona_parcela_num_int" class="form-control" placeholder="Ingrese el número de instrumento" required>
   </div>
</div>

<div class="form-group row">
    <label class="col-md-3 form-control-label" for="nombre">Fecha</label>
    <div class="col-md-9">
        <input type="date" id="persona_parcela_f_int" name="persona_parcela_f_int" class="form-control" placeholder="Ingrese la fecha" required value="@isset($persona_parcela){{Carbon\Carbon::parse($persona_parcela->persona_parcela_f_int)->format('Y-m-d') }}@endisset">
   </div>
</div>

<div class="form-group row">
    <label class="col-md-3 form-control-label" for="nombre">Estado</label>
    <div class="col-md-9">
    
        <select class="form-control" name="tipo_estado_id" id="tipo_estado_id" required>
        
        @foreach($tipoestados as $estado)
          
           <option value="{{$estado->tipo_estado_id}}">{{$estado->tipo_estado_descrip}}</option>
                
        @endforeach

        </select>
    
    </div>
</div>


<div class="modal-footer">
 <button type="submit" class="btn btn-success rounded"><i class="fa fa-save fa-2x"></i> Guardar</button>
 <button type="button" class="btn btn-danger rounded" data-dismiss="modal"><i class="fa fa-times fa-2x"></i> Cerrar</button>
</div>