
<div class="form-group row">
    <label class="col-md-3 form-control-label" for="tipo_persona_id">Tipo de Persona</label>
    <div class="col-md-9">
        <select class="form-control tipo_persona_id" name="tipo_persona_id" id="tipo_persona_id">
                               
             @foreach($TipoPersona as $TipoPerson)
                 <option value="{{$TipoPerson->tipo_persona_id}}">{{$TipoPerson->tipo_persona_descrip}}</option>
             
              @endforeach
    
        </select>
    </div>
</div>

<div class="form-group row persona_juridica" id="persona_juridica" style="display:none;">
    <label class="col-md-3 form-control-label" for="tipo_persona_juridica_id">Tipo de Persona Jurídica</label>
    <div class="col-md-9">
        <select class="form-control" name="tipo_persona_juridica_id" id="tipo_persona_juridica_id">
                                    
            @foreach($TipoPersonaJuridica as $TipoPersonaJuridic)
    
                <option value="{{$TipoPersonaJuridic->tipo_persona_juridica_id}}">{{$TipoPersonaJuridic->tipo_persona_juridica_descrip}}</option>
                
             @endforeach      
    
        </select>
    </div>
</div>


<div id="denominacion" class="form-group row denominacion" style="display:none;">
    <label class="col-md-3 form-control-label" for="persona_denominacion">Denominación</label>
    <div class="col-md-9">
        <input type="text" id="persona_denominacion" name="persona_denominacion" class="form-control" placeholder="Ingrese la Denominación" pattern="^[a-zA-Z_áéíóúñ\s]{0,30}$">      
    </div>
</div>

<div class="nombres">
    <div class="form-group row">
        <label class="col-md-3 form-control-label" for="persona_nombre">Nombre</label>
        <div class="col-md-9">
            <input type="text" id="persona_nombre" name="persona_nombre" class="form-control" placeholder="Ingrese el Nombre" pattern="^[a-zA-Z_áéíóúñ\s]{0,30}$">      
        </div>
    </div>

    <div class="form-group row apellidos">
        <label class="col-md-3 form-control-label" for="persona_apellido">Apellido</label>
        <div class="col-md-9">
            <input type="text" id="persona_apellido" name="persona_apellido" class="form-control" placeholder="Ingrese el Apellido" pattern="^[a-zA-Z_áéíóúñ\s]{0,30}$">      
        </div>
    </div>
</div>

<div class="documentos">
    <div class="form-group row">
        <label class="col-md-3 form-control-label" for="tipo_documento_id">Tipo de Documento</label>
        <div class="col-md-9">
            <select class="form-control" name="tipo_documento_id" id="tipo_documento_id">
                                        
                @foreach($TipoDocumento as $TipoDocument)
                @if ($TipoDocument->tipo_documento_id == 3 )
                    <option selected value="{{$TipoDocument->tipo_documento_id}}">{{$TipoDocument->tipo_documento_descrip}}</option>
                    @else
                    <option value="{{$TipoDocument->tipo_documento_id}}">{{$TipoDocument->tipo_documento_descrip}}</option>
                @endif
                    
                @endforeach
                
        
            </select>
        </div>
    </div>


    <div class="form-group row">
        <label class="col-md-3 form-control-label" for="persona_nro_doc">Número de Documento</label>
        <div class="col-md-9">
            <input type="text" id="persona_nro_doc" name="persona_nro_doc" class="form-control" placeholder="Ingrese el número de documento" pattern="[0-9]{0,15}">
        </div>
    </div>
</div>

<div class="form-group row">
    <label class="col-md-3 form-control-label" for="persona_cuit">CUIT / CUIL</label>
    <div class="col-md-9" >
        <input type="text" id="persona_cuit" name="persona_cuit"  data-inputmask="'mask': '99-99999999-9'" data-mask="" class="form-control" placeholder="Ingrese el número de CUIT o CUIL" maxlength="13"  pattern="^(20|23|27|30|33)([0-9]{9}|-[0-9]{8}-[0-9]{1})$" required>
        <div class='invalid-feedback valid-cuil d-none'>CUIT inválido</div>
        <div class='invalid-feedback existente-cuil d-none'>El CUIT <a id='cuit_param' href=''>ya existe</a> en la base de personas</div>
    </div>
</div>

<div class="form-group row">
    <label class="col-md-3 form-control-label" for="persona_es_cuit">Es CUIT</label>
    <div class="col-md-9">
        <select class="form-control" name="persona_es_cuit" id="persona_es_cuit">
            <option value="1">Si</option>  
            <option selected value="0">No</option>
        </select>
    </div>
</div>

<div class="form-group row">
    <label class="col-md-3 form-control-label" for="persona_sexo">Sexo</label>
    <div class="col-md-9">
        <select class="form-control" name="persona_sexo" id="persona_sexo">
            <option selected value="M">Masculino</option>
            <option value="F">Femenino</option>
            <option value="S">Sin Definir</option>      
        </select>
    </div>
</div>

<div class="form-group row fecha_nacimiento">
    <label class="col-md-3 form-control-label" for="persona_fecha_nac">Fecha de Nacimiento</label>
    <div class="col-md-9">
        <input type="date" id="persona_fecha_nac" name="persona_fecha_nac" class="form-control" placeholder="Ingrese la fecha de nacimiento" pattern="[0-9]{0,15}">
    </div>
</div>

<div class="form-group row">
    <label class="col-md-3 form-control-label" for="persona_fallecida">Fallecido</label>
    <div class="col-md-9">
        <select class="form-control" name="persona_fallecida" id="persona_fallecida">
            <option value="1">Si</option>  
            <option selected value="0">No</option>
        </select>
    </div>
</div>

<div class="form-group row">
    <label class="col-md-3 form-control-label" for="pais_id">País de nacimiento</label>
    <div class="col-md-9">
        <select class="form-control" name="pais_id" id="pais_id">
                                    
            @foreach($Paises as $Pais)
            @if ($Pais->pais_id == 12 )
                <option selected value="{{$Pais->pais_id}}">{{$Pais->pais_nombre}}</option>
            @else
                <option value="{{$Pais->pais_id}}">{{$Pais->pais_nombre}}</option>
            @endif
            
         @endforeach     
            
    
        </select>
    </div>
</div>


<div class="form-group row">
    <label class="col-md-3 form-control-label" for="persona_email">E-Mail</label>
    <div class="col-md-9">
        <input type="email" id="persona_email" name="persona_email" class="form-control" placeholder="Ingrese el email">
    </div>
</div>

<div class="form-group row conyuge">
    <label class="col-md-3 form-control-label" for="persona_conyuge">Anexo</label>
    <div class="col-md-9">
        <input type="text" id="persona_conyuge" name="persona_conyuge" class="form-control" placeholder="Ingrese anexos" pattern="^[a-zA-Z_áéíóúñ\s]{0,30}$">
    </div>
</div>

<div class="modal-footer">
<button type="submit" class="btn btn-success rounded"><i class="fa fa-save fa-2x"></i> Guardar</button>
<button type="button" class="btn btn-danger rounded" data-dismiss="modal"><i class="fa fa-times fa-2x"></i> Cerrar</button>

</div>