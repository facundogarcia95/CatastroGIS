
<!-- Etiqueta RUD 
    <div class="form-group row">
        <label class="col-md-3 form-control-label" for="direccion_nomencla">Dirección Nomenclatura</label>
        <input id="direccion_nomencla" type="text" name="direccion_nomencla" value="" class="col-md-8 form-control rounded ui-autocomplete-input" readonly autocomplete="off" required>
    </div>
-->
<!-- Calle -->
<div class="form-group row">
    <label class="col-md-3 form-control-label" for="ejes_mendoza">Calle</label>
    <input id="calle_id"  onkeyup="mostrarProvDeptoDis(this.value)"  type="hidden" name="calle_id" value="" class="calle_id">
    <input id="ejes_mendoza" type="text" name="ejes_mendoza" value="" class="col-md-8 form-control rounded ejes_mendoza ui-autocomplete-input" placeholder="Seleccione una calle válida.." autocomplete="off" required>
</div>

<!-- Numeracion -->
<div class="form-group row">
    <label class="col-md-3 form-control-label" for="direccion_numeracion">Numeración</label>
    <input id="direccion_numeracion" type="text" name="direccion_numeracion" value="" class="col-md-8 form-control rounded ui-autocomplete-input" placeholder="Numeración.." autocomplete="off" required>
 </div>

<!-- Provincia -->
<div class="collapse show prov_dep_dist">
    <div class="form-group row" >
        <label class="col-md-3 form-control-label" for="provincias">Provincia</label>
        <select id="provincia_id" name="provincia_id" value="" class="col-md-8 form-control rounded ui-autocomplete-input provincia_id" autocomplete="off" >
            @foreach($Provincias as $Provincia)
                <option value="{{$Provincia->provincia_id}}">{{$Provincia->provincia_nombre}}</option>
            @endforeach      
        </select>
    </div>

    <!-- Departamento -->
    <div class="form-group row" >
        <label class="col-md-3 form-control-label" for="departamentos">Departamento</label>
        <select id="departamento_id" name="departamento_id" value="" class="col-md-8 form-control rounded ui-autocomplete-input departamento_id" autocomplete="off" >
            @foreach($Departamentos as $Departamento)
                <option value="{{$Departamento->departamento_id}}" provincia_id="{{$Departamento->provincia_id}}">{{$Departamento->departamento_nombre}}</option>
            @endforeach   
        </select>
    </div>

    <!-- Distrito -->
    <div class="form-group row">
        <label class="col-md-3 form-control-label" for="distritos">Distrito</label>
        <select id="distrito_id" name="distrito_id" value="" class="col-md-8 form-control rounded ui-autocomplete-input distrito_id" autocomplete="off" >
            @foreach($Distritos as $Distrito)
                <option value="{{$Distrito->distrito_id}}" departamento_id="{{$Distrito->departamento_id}}">{{$Distrito->distrito_nombre}}</option>
            @endforeach  
        </select>
    </div>
</div>


<!-- Barrio -->
<div class="form-group row">
    <label class="col-md-3 form-control-label" for="barrios">Barrio</label>
    <input id="barrio_id" class="barrio_id" type="hidden" name="barrio_id" value="" >
    <input id="barrio_nombre" type="text" name="barrio_nombre" value="" class="col-md-8 form-control rounded ui-autocomplete-input barrio_nombre" placeholder="Contiene un autocompletado para barrios de {{str_replace("_"," ",env('MUNICIPIO'))}}" autocomplete="off">
</div>

<!-- Manzana -->
<div class="form-group row">
    <label class="col-md-3 form-control-label" for="direccion_manzana">Manzana</label>
    <input id="direccion_manzana" type="text" name="direccion_manzana" value="" class="col-md-8 form-control rounded ui-autocomplete-input" placeholder="Manzana.." autocomplete="off">
</div>

<!-- Casa -->
<div class="form-group row">
    <label class="col-md-3 form-control-label" for="direccion_casa">Casa</label>
    <input id="direccion_casa" type="text" name="direccion_casa" value="" class="col-md-8 form-control rounded ui-autocomplete-input" placeholder="Casa.." autocomplete="off">
</div>

<!-- Local -->
<div class="form-group row">
    <label class="col-md-3 form-control-label" for="direccion_local">Local</label>
    <input id="direccion_local" type="text" name="direccion_local" value="" class="col-md-8 form-control rounded ui-autocomplete-input" placeholder="Local.." autocomplete="off">
</div>

<!-- Piso -->
<div class="form-group row">
    <label class="col-md-3 form-control-label" for="direccion_piso">Piso</label>
    <input id="direccion_piso" type="text" name="direccion_piso" value="" class="col-md-8 form-control rounded ui-autocomplete-input" placeholder="Piso.." autocomplete="off">
</div>

<!-- Depto -->
<div class="form-group row">
    <label class="col-md-3 form-control-label" for="direccion_depto">Depto</label>
    <input id="direccion_depto" type="text" name="direccion_depto" value="" class="col-md-8 form-control rounded ui-autocomplete-input" placeholder="Depto.." autocomplete="off">
</div>

<!-- Area -->
<div class="form-group row">
    <label class="col-md-3 form-control-label" for="direccion_area">Area</label>
    <input id="direccion_area" type="text" name="direccion_area" value="" class="col-md-8 form-control rounded ui-autocomplete-input" placeholder="Area.." autocomplete="off">
</div>

<!-- Torre -->
<div class="form-group row">
    <label class="col-md-3 form-control-label" for="direccion_torre">Torre</label>
    <input id="direccion_torre" type="text" name="direccion_torre" value="" class="col-md-8 form-control rounded ui-autocomplete-input" placeholder="Torre.." autocomplete="off">
</div>

<!-- Lote -->
<div class="form-group row">
    <label class="col-md-3 form-control-label" for="direccion_lote">Lote</label>
    <input id="direccion_lote" type="text" name="direccion_lote" value="" class="col-md-8 form-control rounded ui-autocomplete-input" placeholder="Lote.." autocomplete="off">
</div>

<!-- CP -->
<div class="form-group row">
    <label class="col-md-3 form-control-label" for="direccion_cp">CP</label>
    <input id="direccion_cp" type="text" name="direccion_cp" value="" class="col-md-8 form-control rounded ui-autocomplete-input" placeholder="CP.." autocomplete="off">
</div>

<!-- Observacion -->
<div class="form-group row">
    <label class="col-md-3 form-control-label" for="direccion_observ">Observación</label>
    <input id="direccion_observ" type="text" name="direccion_observ" value="" class="col-md-8 form-control rounded ui-autocomplete-input" placeholder="Observación.." autocomplete="off">
</div>



<div class="modal-footer">
 <button type="submit" class="btn btn-success rounded"><i class="fa fa-save fa-2x"></i> Guardar</button>
 <button type="button" class="btn btn-danger rounded" data-dismiss="modal"><i class="fa fa-times fa-2x"></i> Cerrar</button>
</div>
