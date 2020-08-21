
<div class="modal fade" id="abrirmodalEditarNegocio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dark modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Datos de Negocio</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true" class="text-light">×</span>
                </button>
            </div>
           
            <div class="modal-body">
                 

                <form action="{{route('negocio.update','test')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                    
                    {{method_field('patch')}}
                    {{csrf_field()}}

                    <input type="hidden" id="negocio_id" name="id" value="">
                    
                    <div class="form-group row">
                      <label class="col-md-3 form-control-label" for="Nombre">Nombre</label>
                      <div class="col-md-9">
                          <input type="text" id="negocio_nombre" name="Nombre" class="form-control" placeholder="Nombre de la empresa" required >
                      
                      </div>
                   </div>

                   <div class="form-group row">
                      <label class="col-md-3 form-control-label" for="Cuil">Cuil</label>
                      <div class="col-md-9">
                          <input type="text" id="negocio_cuil" name="Cuil" class="form-control" placeholder="Ingrese el Cuil" >
                      </div>
                   </div>

                   <div class="form-group row">
                      <label class="col-md-3 form-control-label" for="Email">Email</label>
                      <div class="col-md-9">
                          <input type="email" id="negocio_email" name="Email" class="form-control" placeholder="Ingrese el Email" >
                      
                      </div>
                   </div>

                   <div class="form-group row">
                      <label class="col-md-3 form-control-label" for="Instagram">Instagram</label>
                      <div class="col-md-9">
                          <input type="text" id="negocio_instagram" name="Instagram" class="form-control" placeholder="Ingrese su Instagram"  >
                      </div>
                   </div>

                   <div class="form-group row">
                      <label class="col-md-3 form-control-label" for="Facebook">Facebook</label>
                      <div class="col-md-9">
                          <input type="text" id="negocio_facebook" name="Facebook" class="form-control" placeholder="Ingrese su Facebook"  >
                      </div>
                   </div>

                   <div class="form-group row">
                      <label class="col-md-3 form-control-label" for="impuesto">Impuesto</label>
                      <div class="col-md-9">
                          <input type="number" id="negocio_impuesto" max="100" min="0" name="impuesto" stop="100" class="form-control" placeholder="Ingrese su Impuesto" required >
                      </div>
                   </div>

                   <div class="form-group row">
                      <label class="col-md-3 form-control-label" for="Direccion">Direccion</label>
                      <div class="col-md-9">
                          <input type="number" id="negocio_direccion" name="Direccion" class="form-control" placeholder="Ingrese su Direccion"  >
                      </div>
                   </div>

                   <div class="form-group row">
                      <label class="col-md-3 form-control-label" for="Telefono">Telefono</label>
                      <div class="col-md-9">
                          <input type="number" id="negocio_telefono" name="Telefono" class="form-control" placeholder="Ingrese su Telefono"  >
                      </div>
                   </div>

                   <div class="form-group row">
                      <label class="col-md-3 form-control-label" for="web">Web</label>
                      <div class="col-md-9">
                          <input type="number" id="negocio_web" name="web" class="form-control" placeholder="Ingrese su Web"  >
                      </div>
                   </div>

                   <div class="form-group row">
                      <label class="col-md-3 form-control-label" for="logo">Logo</label>
                      <div class="col-md-9">
                      
                          <input type="file" name="logo" class="form-control">    
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success rounded"><i class="fa fa-save fa-2x"></i> Guardar</button>
                        <button type="button" class="btn btn-danger rounded" data-dismiss="modal"><i class="fa fa-times fa-2x"></i> Cerrar</button>
                        
                    </div>

                </form>
            </div>
            
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
