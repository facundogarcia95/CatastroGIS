<!---------------------------------------------------
    MODAL DE CONSULTA DE DIRECCION / PADRÓN - NOMENCLA
------------------------------------------------------->
<div class="modal fade" id="abrirmodalConsulta" tabindex="-1" role="dialog" aria-labelledby="modalConsulta" aria-hidden="true">
   <div class="modal-dialog  modal-dark modal-lg " role="document">
       <div class="modal-content">
           <div class="modal-header bg-catastro">
               <h4 class="modal-title text-uppercase">Realizar Busqueda</h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true" class="text-light">×</span>
               </button>
           </div>
          
           <div class="modal-body">
                <!--=============================
                    BUSQUEDA POR CALLE Y NUMERACION
                ================================-->
               <div class="row">
                  <div class="col-md-7 col-sm-12 pt-2 pb-1">
    
                      <h5 class="font-weight-bold text-uppercase">Nombre de calle</h5>
                      <input id="nombre_calle" type="text" class="form-control" placeholder="Calle">
                                                   
                  </div>
                  <div class="col-md-3 col-sm-12 pt-2 pb-1">

                      <h5 class="font-weight-bold  text-uppercase">numeración</h5>
                      <input id="numeracion_calle" type="number" class=" form-control" placeholder="Número">

                  </div>
                  <div class="col-sm-2 pt-2 pb-1">

                     <h5 class="font-weight-bold text-light text-uppercase d-sm-none ">&nbsp;</h5>
                      <button type="button" class="buscarDireccion btn bg-catastro wrn-btn text-light rounded"><i class="fa fa-search"></i></button>
                  </div>
              </div>

              <!--=============================
                    BUSQUEDA POR PADRON / NOMENCLATURA
                ================================-->
              <div class="row">

                  <div class="col-md-10 col-sm-12 pt-2 pb-1">
    
                      <h5 class="font-weight-bold text-uppercase">Padrón / Nomenclatura</h5>
                      <input id="padronNomencla_busqueda" type="text" maxlength="20" class="form-control" placeholder="Padrón / Nomenclatura">
                                                   
                  </div>

                  <div class="col-sm-2 pt-2 pb-1">

                      <h5 class="font-weight-bold text-light text-uppercase d-sm-none ">&nbsp;</h5>
                      <button type="button" class="buscarPadronNomencla btn bg-catastro wrn-btn text-light rounded"><i class="fa fa-search"></i></button>

                  </div>

              </div>

              <!--=============================
                    BUSQUEDA POR TITULARES
                ================================-->
              <div class="row">

                <div class="col-md-10 col-sm-12 pt-2 pb-1">
  
                    <h5 class="font-weight-bold text-uppercase">POR PERSONA</h5>
                    <input id="titularesParcelas" name="persona_denominacion" type="text" class="form-control" placeholder="Titular / Cotitular Parcela">
                         
                </div>

                <div class="col-sm-2 pt-2 pb-2">

                    <h5 class="font-weight-bold text-light text-uppercase d-sm-none">&nbsp;</h5>
                    <button type="button" class="buscarPorPersona btn bg-catastro wrn-btn text-light rounded"><i class="fa fa-search"></i></button>

                </div>

            </div>
           </div>

           <div class="modal-footer">

               <div class="col-md-6">
                  <button class="btn btn-success btn-md rounded limpiar w-100">
                     <i class="fa fa-refresh fa-2x"></i> 
                     <b class="f-14">Limpiar</b>
                  </button>
               </div>
               <div class="col-md-6">
                  <button class="btn btn-danger btn-md rounded w-100" data-dismiss="modal">
                     <i class="fa fa-times fa-2x"></i> 
                     <b class="f-14">Cerrar</b>
                  </button>
               </div>
           </div>
           
       </div>
       <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
</div>

<!---------------------------------------------------
    BUSQUEDA POR NOMBRE / OTROS CAMPOS
------------------------------------------------------->

<div class="modal fixed-right fade" id="modalBuscarBarrio"  tabindex="-1" role="dialog" aria-labelledby="modalBuscarNombre" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-aside modal-lg " role="document">
        <div class="modal-content">
            <div class="modal-heade bg-catastro">

                <div class="row">
                    <div class="col-12 m-3">

                        <h5 class="font-weight-bold text-light">REALIZAR BÚSQUEDA</h5>

                    </div>
                </div>

            </div>
           
            <div class="modal-body">
                 
                <div class="row">
                   <div class="col-12 pt-1 pb-2">
     
                       <h5 class="font-weight-bold text-uppercase">BUSQUEDA POR NOMBRE</h5>
                       <input  type="text" class="nombre_barrio form-control" placeholder="Nombre del Barrio, Loteo o Empresa">
                                                    
                   </div>
                </div>

                <form id="formularioBusquedaBarrio" action="{{url('buscarBarrio')}}" method="GET" class="was-validated">

                    <div class="row  pt-2">
        
                            <div class="col-12  pt-2 pb-3 bg-catastro">
                                <h5 class="font-weight-bold text-light">BUSQUEDA POR OTROS CAMPOS</h5>
                            </div>

                            <div class="col-12 pt-1 pb-1 nombreBarrio">
                                
                            </div>

                            <div class="col-6  mb-3 mt-2">
                                <h5 class="font-weight-bold  text-uppercase">Alternativo:</h5>
                                <input type="text" name="nombre_alternativo" class="nombre_alternativo form-control" placeholder="Nombre Alternativo">
                            </div>

                            <div class="col-6  mb-3 mt-2">
                                <h5 class="font-weight-bold  text-uppercase">Estado:</h5>
                                <select name="estado_barrio_id" class="estado_barrio_id form-control">

                                    <option value="" selected >Seleccionar</option>

                                    @foreach ($estado_barrios as $estado)
                                        <option value="{{$estado->estado_barrio_id}}">{{$estado->descripcion}}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="col-6 mt-1 mb-3">
                                <h5 class="font-weight-bold  text-uppercase">Fuente:</h5>
                                <select name="fuente_barrio_id" class="fuente_barrio_id form-control">

                                    <option value="" selected >Seleccionar</option>

                                    @foreach ($fuente_barrios as $fuente)
                                        <option value="{{$fuente->fuente_barrio_id}}">{{$fuente->descripcion}}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="col-6 mt-1 mb-3">
                                <h5 class="font-weight-bold  text-uppercase">Dominio/Tipo:</h5>
                                <select name="dominio_barrio_id" class="dominio_barrio_id form-control">

                                    <option value="" selected >Seleccionar</option>

                                    @foreach ($dominio_barrios as $dominio)
                                        <option value="{{$dominio->dominio_barrio_id}}">{{$dominio->descripcion}}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="col-6 mt-1 mb-3">
                                <h5 class="font-weight-bold  text-uppercase">Expediente:</h5>
                                <input type="text" name="expediente_barrio" class="expediente_barrio form-control" placeholder="Expediente">
                            </div>

                            <div class="col-6 mt-1 mb-3">
                                <h5 class="font-weight-bold  text-uppercase">Distrito:</h5>
                                <select  name="distrito_id" class="distrito_id form-control">

                                    <option value="" selected >Seleccionar</option>

                                    @foreach ($distritos as $distrito)
                                        <option value="{{$distrito->distrito_id}}">{{$distrito->distrito_nombre}}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="col-6 mt-1 mb-3">
                                <h5 class="font-weight-bold  text-uppercase">Zona:</h5>
                                <input type="text" name="zona_barrio" class="zona_barrio form-control" placeholder="Zona">
                            </div>

                            <div class="col-6 mt-1 mb-3">
                                <h5 class="font-weight-bold  text-uppercase">N° Zona:</h5>
                                <input type="text" name="nro_zona_barrio" class="nro_zona_barrio form-control" placeholder="N° de Zona">
                            </div>


                            <div class="col-6 mt-1 mb-3">
                                <h5 class="font-weight-bold  text-uppercase">N° Plano:</h5>
                                <input type="text" name="nro_plano_barrio" class="nro_plano_barrio form-control" placeholder="N° de Plano">
                            </div>

                            <div class="col-6 mt-1 mb-3">
                                <h5 class="font-weight-bold  text-uppercase">Fecha plano:</h5>
                                <input type="date" name="fecha_plano_barrio" class="fecha_plano_barrio form-control" >
                            </div>

                            <div class="col-12 mt-1 mb-3">
                                <h5 class="font-weight-bold  text-uppercase">Matricula Profesional:</h5>
                                <input type="number" name="matricula_profesional" class="matricula_profesional form-control" placeholder="Matricula del profesional">
                            </div>

                            <div class="col-12 mt-1 mb-3">
                                <h5 class="font-weight-bold  text-uppercase">Observación:</h5>
                                <textarea name="observacion" class="form-control observacion"></textarea>
                            </div>

                            <div class="col-md-6 mt-2">
                                <button type="submit" class="btn_buscar btn btn-md rounded w-100 bg-primary text-light">
                                <i class="fa fa-search fa-2x"></i> 
                                <b class="f-14">Buscar</b>
                                </button>
                            </div>     
                            
                            <div class="col-md-6 mt-2">
                                <button type="button" class="limpiar_busqueda_barrio btn btn-md rounded w-100 bg-success text-light">
                                <i class="fa fa-refresh fa-2x"></i> 
                                <b class="f-14">Limpiar</b>
                                </button>
                            </div>
                                          
                        
                    </div>
 
                </form>
            </div>
 
            <div class="modal-footer">
 
                <div class="col-md-12">
                   <button type="button" class="btn btn-md rounded w-100 bg-default-color text-light" data-dismiss="modal">
                      <i class="fa fa-times fa-2x"></i> 
                      <b class="f-14">Cerrar</b>
                   </button>
                </div>
            </div>
            
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
 

<!---------------------------------------------------
    BARRIOS ENCONTRADOS EN LA BUSQUEDA DE BARRIOS
------------------------------------------------------->

<div class="modal fixed-right fade" id="respuestaBusquedaBarrios" tabindex="-1" role="dialog" aria-labelledby="respuestaBusquedaBarrios" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-aside modal-lg " role="document">
        <div class="modal-content">
            <div class="modal-heade bg-catastro">

                <div class="row">
                    <div class="col-12 m-3">

                        <h5 class="font-weight-bold text-light">BARRIOS ENCONTRADOS</h5>

                    </div>
                </div>

            </div>
           
            <div class="modal-body">
                 
                <div class="row barriosEncontrados">
              
                </div>

            </div>
 
            <div class="modal-footer">
 
                <div class="col-md-12">
                   <button class="btn btn-md rounded w-100 bg-default-color text-light" data-dismiss="modal">
                      <i class="fa fa-times fa-2x"></i> 
                      <b class="f-14">Cerrar</b>
                   </button>
                </div>
            </div>
            
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<!------------------------------------------------
    MODAL DE ALTA DE BARRIO
-------------------------------------------------->

<div class="modal fixed-right fade" id="modalAltaBarrio" tabindex="-1" role="dialog" aria-labelledby="modalBuscarNombre" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-aside modal-lg " role="document">
        <div class="modal-content">
            <div class="modal-heade bg-catastro">

                <div class="row">
                    <div class="col-12 m-3">

                        <h5 class="font-weight-bold text-light">ALTA DE BARRIO</h5>

                    </div>
                </div>

            </div>
           
            <div class="modal-body">
                 
                <form id="formularioAltaBarrio" action="{{url('altaBarrio')}}" method="POST" class="was-validated">
                    {{ csrf_field() }}
                    <div class="row  pt-2">
        
                            <div class="col-6  mb-3 mt-2">
                                <h5 class="font-weight-bold  text-uppercase">Barrio:</h5>
                                <input type="text" name="barrio_nombre" class="barrio_nombre form-control text-uppercase" placeholder="Nombre Alternativo">
                            </div>                            
                            
                            <div class="col-6  mb-3 mt-2">
                                <h5 class="font-weight-bold  text-uppercase">Loteo:</h5>
                                <input type="text" name="barrio_loteo" class="barrio_loteo form-control text-uppercase" placeholder="Nombre Alternativo">
                            </div>                        

                            <div class="col-6  mb-3 mt-2">
                                <h5 class="font-weight-bold  text-uppercase">Empresa:</h5>
    
                                <input type="hidden" name="barrio_empresa" class="barrio_empresa">
                 
                                <select name="id_empresa" class="id_empresa form-control text-uppercase">

                                    <option value="" selected >Seleccionar</option>

                                    @foreach ($personas as $persona)
                                        <option value="{{$persona->persona_id}}" denominacion="{{$persona->persona_denominacion}}">{{$persona->persona_denominacion}}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="col-md-6 mt-2 mb-3"><br/>
                                <a target="_blank" href="./gestion/personas" type="button" class="btn_buscar btn btn-md rounded w-100 bg-primary text-light" >
                                <i class="fa fa-user fa-2x"></i> 
                                <b class="f-14">Nueva Empresa</b>
                                </a>
                            </div> 

                            <div class="col-6  mb-3 mt-2">
                                <h5 class="font-weight-bold  text-uppercase">Alternativo:</h5>
                                <input type="text" name="nombre_alternativo" class="nombre_alternativo form-control text-uppercase" placeholder="Nombre Alternativo">
                            </div>

                            <div class="col-6  mb-3 mt-2">
                                <h5 class="font-weight-bold  text-uppercase">Estado:</h5>
                                <select name="estado_barrio_id" class="estado_barrio_id form-control text-uppercase" required>

                                    <option value="" selected >Seleccionar</option>

                                    @foreach ($estado_barrios as $estado)
                                        <option value="{{$estado->estado_barrio_id}}">{{$estado->descripcion}}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="col-6 mt-1 mb-3">
                                <h5 class="font-weight-bold  text-uppercase">Fuente:</h5>
                                <select name="fuente_barrio_id" class="fuente_barrio_id form-control text-uppercase" required>

                                    <option value="" selected >Seleccionar</option>

                                    @foreach ($fuente_barrios as $fuente)
                                        <option value="{{$fuente->fuente_barrio_id}}">{{$fuente->descripcion}}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="col-6 mt-1 mb-3">
                                <h5 class="font-weight-bold  text-uppercase">Dominio/Tipo:</h5>
                                <select name="dominio_barrio_id" class="dominio_barrio_id form-control text-uppercase" required>

                                    <option value="" selected >Seleccionar</option>

                                    @foreach ($dominio_barrios as $dominio)
                                        <option value="{{$dominio->dominio_barrio_id}}">{{$dominio->descripcion}}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="col-6 mt-1 mb-3">
                                <h5 class="font-weight-bold  text-uppercase">Expediente:</h5>
                                <input type="text" name="expediente_barrio" class="expediente_barrio form-control text-uppercase" placeholder="Expediente">
                            </div>

                            <div class="col-6 mt-1 mb-3">
                                <h5 class="font-weight-bold  text-uppercase">Distrito:</h5>
                                <select  name="distrito_id" class="distrito_id form-control text-uppercase" required>

                                    <option value="" selected >Seleccionar</option>

                                    @foreach ($distritos as $distrito)
                                        <option value="{{$distrito->distrito_id}}">{{$distrito->distrito_nombre}}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="col-6 mt-1 mb-3">
                                <h5 class="font-weight-bold  text-uppercase">Zona:</h5>
                                <input type="text" name="zona_barrio" class="zona_barrio form-control text-uppercase" placeholder="Zona">
                            </div>

                            <div class="col-6 mt-1 mb-3">
                                <h5 class="font-weight-bold  text-uppercase">N° Zona:</h5>
                                <input type="text" name="nro_zona_barrio" class="nro_zona_barrio form-control text-uppercase" placeholder="N° de Zona">
                            </div>


                            <div class="col-6 mt-1 mb-3">
                                <h5 class="font-weight-bold  text-uppercase">N° Plano:</h5>
                                <input type="number" name="nro_plano_barrio" class="nro_plano_barrio form-control text-uppercase" placeholder="N° de Plano">
                            </div>

                            <div class="col-6 mt-1 mb-3">
                                <h5 class="font-weight-bold  text-uppercase">Fecha plano:</h5>
                                <input type="date" name="fecha_plano_barrio" class="fecha_plano_barrio form-control text-uppercase" >
                            </div>

                            <div class="col-12 mt-1 mb-3">
                                <h5 class="font-weight-bold  text-uppercase">Matricula Profesional:</h5>
                                <input type="number" name="matricula_profesional" class="matricula_profesional form-control text-uppercase" placeholder="Matricula del profesional">
                            </div>

                            <div class="col-12 mt-1 mb-3">
                                <h5 class="font-weight-bold  text-uppercase">Observación:</h5>
                                <textarea name="observacion" class="form-control observacion text-uppercase"></textarea>
                            </div>

                            <div class="col-md-6 mt-2">
                                <button type="submit" class="btn_alta_barrio btn btn-md rounded w-100 bg-primary text-light">
                                <i class="fa fa-plus"></i> 
                                <b class="f-14">Añadir</b>
                                </button>
                            </div>           

                            <div class="col-md-6 mt-2">
                                <button type="button" class="limpiar_busqueda_barrio btn btn-md rounded w-100 bg-success text-light">
                                <i class="fa fa-refresh fa-2x"></i> 
                                <b class="f-14">Limpiar</b>
                                </button>
                            </div>
                            
                        
                    </div>
 
                </form>
            </div>
 
            <div class="modal-footer">
 
                <div class="col-md-12">
                   <button type="button" class="btn btn-md rounded w-100 bg-default-color text-light" data-dismiss="modal">
                      <i class="fa fa-times fa-2x"></i> 
                      <b class="f-14">Cerrar</b>
                   </button>
                </div>
            </div>
            
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
 

<!---------------------------------------------------
    BAJA DE BARRIOS
------------------------------------------------------->

<div class="modal fixed-right fade" id="modalBajaBarrio" tabindex="-1" role="dialog" aria-labelledby="modalBuscarNombre" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-aside modal-lg " role="document">
        <div class="modal-content">
            <div class="modal-heade bg-catastro">

                <div class="row">
                    <div class="col-12 m-3">

                        <h5 class="font-weight-bold text-light">BUSCAR BARRIO A ELIMINAR</h5>

                    </div>
                </div>

            </div>
           
            <div class="modal-body">
                 
                    <div class="row">

                        <div class="col-12 pt-1 pb-2">
            
                            <h5 class="font-weight-bold text-uppercase">BUSQUEDA POR NOMBRE</h5>
                            <input  type="text" class="nombre_barrio form-control" placeholder="Nombre del Barrio, Loteo o Empresa">
                                                            
                        </div>

                    </div>

                    <form id="formularioBajaBarrio" action="{{url('bajaBarrio')}}" method="POST" class="was-validated">

                        {{method_field('delete')}}
                        {{csrf_field()}} 

                    <div class="row  pt-2 bajaBarrio d-none">
        
                            <input type="hidden" name="barrio_id" class="barrio_id">

                            <div class="col-12  pt-2 pb-3 bg-catastro">
                                <h5 class="font-weight-bold text-light">BARRIO SELECCIONADO</h5>
                            </div>

                            <div class="col-12 pt-1 pb-1 nombreBarrio">
                                
                            </div>

                            <div class="col-6  mb-3 mt-2">
                                <h5 class="font-weight-bold  text-uppercase">Alternativo:</h5>
                                <input type="text" class="nombre_alternativo form-control" placeholder="Nombre Alternativo">
                            </div>

                            <div class="col-6  mb-3 mt-2">
                                <h5 class="font-weight-bold  text-uppercase">Estado:</h5>
                                <select  class="estado_barrio_id form-control">

                                    <option value="" selected >Seleccionar</option>

                                    @foreach ($estado_barrios as $estado)
                                        <option value="{{$estado->estado_barrio_id}}">{{$estado->descripcion}}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="col-6 mt-1 mb-3">
                                <h5 class="font-weight-bold  text-uppercase">Fuente:</h5>
                                <select  class="fuente_barrio_id form-control">

                                    <option value="" selected >Seleccionar</option>

                                    @foreach ($fuente_barrios as $fuente)
                                        <option value="{{$fuente->fuente_barrio_id}}">{{$fuente->descripcion}}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="col-6 mt-1 mb-3">
                                <h5 class="font-weight-bold  text-uppercase">Dominio/Tipo:</h5>
                                <select class="dominio_barrio_id form-control">

                                    <option value="" selected >Seleccionar</option>

                                    @foreach ($dominio_barrios as $dominio)
                                        <option value="{{$dominio->dominio_barrio_id}}">{{$dominio->descripcion}}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="col-6 mt-1 mb-3">
                                <h5 class="font-weight-bold  text-uppercase">Expediente:</h5>
                                <input type="text"  class="expediente_barrio form-control" placeholder="Expediente">
                            </div>

                            <div class="col-6 mt-1 mb-3">
                                <h5 class="font-weight-bold  text-uppercase">Distrito:</h5>
                                <select class="distrito_id form-control">

                                    <option value="" selected >Seleccionar</option>

                                    @foreach ($distritos as $distrito)
                                        <option value="{{$distrito->distrito_id}}">{{$distrito->distrito_nombre}}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="col-6 mt-1 mb-3">
                                <h5 class="font-weight-bold  text-uppercase">Zona:</h5>
                                <input type="text" class="zona_barrio form-control" placeholder="Zona">
                            </div>

                            <div class="col-6 mt-1 mb-3">
                                <h5 class="font-weight-bold  text-uppercase">N° Zona:</h5>
                                <input type="text" class="nro_zona_barrio form-control" placeholder="N° de Zona">
                            </div>


                            <div class="col-6 mt-1 mb-3">
                                <h5 class="font-weight-bold  text-uppercase">N° Plano:</h5>
                                <input type="number" class="nro_plano_barrio form-control" placeholder="N° de Plano">
                            </div>

                            <div class="col-6 mt-1 mb-3">
                                <h5 class="font-weight-bold  text-uppercase">Fecha plano:</h5>
                                <input type="date" class="fecha_plano_barrio form-control" >
                            </div>

                            <div class="col-12 mt-1 mb-3">
                                <h5 class="font-weight-bold  text-uppercase">Matricula Profesional:</h5>
                                <input type="number" class="matricula_profesional form-control" placeholder="Matricula del profesional">
                            </div>

                            <div class="col-12 mt-1 mb-3">
                                <h5 class="font-weight-bold  text-uppercase">Observación:</h5>
                                <textarea class="form-control observacion"></textarea>
                            </div>

                            <div class="col-md-6 mt-2">
                                <button type="submit" class="btn_baja_barrio btn btn-md rounded w-100 bg-danger text-light">
                                <i class="fa fa-trash fa-2x"></i> 
                                <b class="f-14">Eliminar</b>
                                </button>
                            </div>     
                            
                            <div class="col-md-6 mt-2">
                                <button type="button" class="limpiar_busqueda_barrio btn btn-md rounded w-100 bg-success text-light">
                                <i class="fa fa-refresh fa-2x"></i> 
                                <b class="f-14">Limpiar</b>
                                </button>
                            </div>
                                          
                    </div>

                </form>

            </div>
 
            <div class="modal-footer">
 
                <div class="col-md-12">
                   <button type="button" class="btn btn-md rounded w-100 bg-default-color text-light" data-dismiss="modal">
                      <i class="fa fa-times fa-2x"></i> 
                      <b class="f-14">Cerrar</b>
                   </button>
                </div>
            </div>
            
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
 

<!---------------------------------------------------
    MODIFICACION DE BARRIOS
------------------------------------------------------->

<div class="modal fixed-right fade" id="modalModificacionBarrio" tabindex="-1" role="dialog" aria-labelledby="modalModificacionBarrio" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-aside modal-lg " role="document">
        <div class="modal-content">
            <div class="modal-header bg-catastro">

                <div class="row">
                    <div class="col-12 m-3">

                        <h5 class="font-weight-bold text-light">BUSCAR BARRIO A MODIFICAR</h5>

                    </div>
                </div>

            </div>
           
            <div class="modal-body">
                 
                    <div class="row">

                        <div class="col-12 pt-1 pb-2">
            
                            <h5 class="font-weight-bold text-uppercase">BUSQUEDA POR NOMBRE</h5>
                            <input  type="text" class="nombre_barrio form-control" placeholder="Nombre del Barrio, Loteo o Empresa">
                                                            
                        </div>

                    </div>

                    <form id="formularioModificacionBarrio" action="{{url('modificacionBarrio')}}" method="POST" class="was-validated">
                        {{method_field('patch')}}
                        {{csrf_field()}} 

                    <div class="row  pt-2 modificarBarrio d-none">
        
                            <input type="hidden" name="barrio_id" class="barrio_id">

                            <div class="col-12  pt-2 pb-3 bg-catastro">
                                <h5 class="font-weight-bold text-light">BARRIO SELECCIONADO</h5>
                            </div>

                            <div class="col-6  mb-3 mt-2">
                                <h5 class="font-weight-bold  text-uppercase">Barrio:</h5>
                                <input type="text" name="barrio_nombre" class="barrio_nombre form-control text-uppercase" placeholder="Nombre Alternativo">
                            </div>                            
                            
                            <div class="col-6  mb-3 mt-2">
                                <h5 class="font-weight-bold  text-uppercase">Loteo:</h5>
                                <input type="text" name="barrio_loteo" class="barrio_loteo form-control text-uppercase" placeholder="Nombre Alternativo">
                            </div>                        

                            <div class="col-6  mb-3 mt-2">
                                <h5 class="font-weight-bold  text-uppercase">Empresa:</h5>
    
                                <input type="hidden" name="barrio_empresa" class="barrio_empresa">
                 
                                <select name="id_empresa" class="id_empresa form-control text-uppercase">

                                    <option value="" selected >Seleccionar</option>

                                    @foreach ($personas as $persona)
                                        <option value="{{$persona->persona_id}}" denominacion="{{$persona->persona_denominacion}}">{{$persona->persona_denominacion}}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="col-md-6 mt-2 mb-3"><br/>
                                <a target="_blank" href="./gestion/personas" type="button" class="btn_buscar btn btn-md rounded w-100 bg-primary text-light" >
                                    <i class="fa fa-user fa-2x"></i> 
                                    <b class="f-14">Nueva Empresa</b>
                                    </a>
                            </div> 

                            <div class="col-6  mb-3 mt-2">
                                <h5 class="font-weight-bold  text-uppercase">Alternativo:</h5>
                                <input type="text" name="nombre_alternativo" class="nombre_alternativo form-control" placeholder="Nombre Alternativo">
                            </div>

                            <div class="col-6  mb-3 mt-2">
                                <h5 class="font-weight-bold  text-uppercase">Estado:</h5>
                                <select  name="estado_barrio_id" class="estado_barrio_id form-control">

                                    <option value="" selected >Seleccionar</option>

                                    @foreach ($estado_barrios as $estado)
                                        <option value="{{$estado->estado_barrio_id}}">{{$estado->descripcion}}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="col-6 mt-1 mb-3">
                                <h5 class="font-weight-bold  text-uppercase">Fuente:</h5>
                                <select  name="fuente_barrio_id" class="fuente_barrio_id form-control">

                                    <option value="" selected >Seleccionar</option>

                                    @foreach ($fuente_barrios as $fuente)
                                        <option value="{{$fuente->fuente_barrio_id}}">{{$fuente->descripcion}}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="col-6 mt-1 mb-3">
                                <h5 class="font-weight-bold  text-uppercase">Dominio/Tipo:</h5>
                                <select name="dominio_barrio_id" class="dominio_barrio_id form-control">

                                    <option value="" selected >Seleccionar</option>

                                    @foreach ($dominio_barrios as $dominio)
                                        <option value="{{$dominio->dominio_barrio_id}}">{{$dominio->descripcion}}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="col-6 mt-1 mb-3">
                                <h5 class="font-weight-bold  text-uppercase">Expediente:</h5>
                                <input type="text" name="expediente_barrio"  class="expediente_barrio form-control" placeholder="Expediente">
                            </div>

                            <div class="col-6 mt-1 mb-3">
                                <h5 class="font-weight-bold  text-uppercase">Distrito:</h5>
                                <select name="distrito_id" class="distrito_id form-control" readonly>

                                    <option value="" selected >Seleccionar</option>

                                    @foreach ($distritos as $distrito)
                                        <option value="{{$distrito->distrito_id}}">{{$distrito->distrito_nombre}}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="col-6 mt-1 mb-3">
                                <h5 class="font-weight-bold  text-uppercase">Zona:</h5>
                                <input type="text" name="zona_barrio" class="zona_barrio form-control" placeholder="Zona">
                            </div>

                            <div class="col-6 mt-1 mb-3">
                                <h5 class="font-weight-bold  text-uppercase">N° Zona:</h5>
                                <input type="text"  name="nro_zona_barrio" class="nro_zona_barrio form-control" placeholder="N° de Zona">
                            </div>


                            <div class="col-6 mt-1 mb-3">
                                <h5 class="font-weight-bold  text-uppercase">N° Plano:</h5>
                                <input type="number"  name="nro_plano_barrio" class="nro_plano_barrio form-control" placeholder="N° de Plano">
                            </div>

                            <div class="col-6 mt-1 mb-3">
                                <h5 class="font-weight-bold  text-uppercase">Fecha plano:</h5>
                                <input type="date"  name="fecha_plano_barrio" class="fecha_plano_barrio form-control" >
                            </div>

                            <div class="col-12 mt-1 mb-3">
                                <h5 class="font-weight-bold  text-uppercase">Matricula Profesional:</h5>
                                <input type="number" name="matricula_profesional" class="matricula_profesional form-control" placeholder="Matricula del profesional">
                            </div>

                            <div class="col-12 mt-1 mb-3">
                                <h5 class="font-weight-bold  text-uppercase">Observación:</h5>
                                <textarea name="observacion" class="form-control observacion"></textarea>
                            </div>

                            <div class="col-md-6 mt-2">
                                <button type="submit" class="btn_modificar_barrio btn btn-md rounded w-100 bg-primary text-light">
                                <i class="fa fa-edit fa-2x"></i> 
                                <b class="f-14">Modificar</b>
                                </button>
                            </div>     
                            
                            <div class="col-md-6 mt-2">
                                <button type="button" class="limpiar_busqueda_barrio btn btn-md rounded w-100 bg-success text-light">
                                <i class="fa fa-refresh fa-2x"></i> 
                                <b class="f-14">Limpiar</b>
                                </button>
                            </div>
                                          
                    </div>

                </form>

            </div>
 
            <div class="modal-footer">
 
                <div class="col-md-12">
                   <button type="button" class="btn btn-md rounded w-100 bg-default-color text-light" data-dismiss="modal">
                      <i class="fa fa-times fa-2x"></i> 
                      <b class="f-14">Cerrar</b>
                   </button>
                </div>
            </div>
            
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
 
