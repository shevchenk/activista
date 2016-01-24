<!-- /.modal -->
<div class="modal fade" id="problemaModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header logo">
        <button class="btn btn-sm btn-default pull-right" data-dismiss="modal">
            <i class="fa fa-close"></i>
        </button>
        <h4 class="modal-title">New message</h4>
      </div>
      <div class="modal-body">
        <form id="form_problemas" name="form_problemas" action="" method="post">
            <div class="row form-group">

              <div class="col-sm-12">
                <div class="col-sm-6">
                  <label class="control-label">RESPONSABLE
                  </label>
                  <h4><?php echo strtoupper( Session::get('persona') ); ?></h4>
                </div>
                <div class="col-sm-3">
                  <label class="control-label">SEDE
                  </label>
                  <h4 id="l_sede"></h4>
                </div>
                <div class="col-sm-3">
                  <label class="control-label">TIPO DE PROBLEMA:
                  </label>
                  <h4 id="l_tipo_problema"></h4>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="col-sm-8">
                  <label class="control-label">DESCRIPCIÓN DEL PROBLEMA: 
                  </label>
                  <h4 id="l_descripcion"></h4>
                </div>
                <div class="col-sm-4">
                  <label class="control-label">FECHA DEL PROBLEMA:
                  </label>
                  <h4 id="l_fecha_problema"></h4>
                </div>
              </div>
              <div class="col-sm-12">
                  <div class="col-sm-12">
                      <div class="box-body table-responsive">
                          <table id="t_detalle" class="table table-bordered">
                              <thead>
                                  <tr>
                                      <th>N</th>
                                      <th>Descripcion</th>
                                      <th>Estado</th>
                                      <th>Fecha del estado</th>
                                      <th>Fecha registro</th>
                                  </tr>
                              </thead>
                              <tbody id="tb_detalle"></tbody>
                          </table>
                      </div><!-- /.box-body -->
                  </div>
              </div>
              <div class="col-sm-12" id="alumno">
                  
              </div>
              <div class="col-sm-12" id="div_notas">
                  <div class="col-sm-12">
                      <div class="box-body table-responsive">
                          <table id="t_notas" class="table table-bordered">
                              <thead>
                                  <tr>
                                      <th>N</th>
                                      <th>Curso</th>
                                      <th>Frecuencia</th>
                                      <th>Hora</th>
                                      <th>Profesor</th>
                                      <th>Fecha inicial</th>
                                      <th>Fecha fin</th>
                                      <th>Nota</th>
                                  </tr>
                              </thead>
                              <tbody id="tb_notas"></tbody>
                          </table>
                      </div><!-- /.box-body -->
                  </div>
              </div>
              <div class="col-sm-12"  id="div_pagos">
                  <div class="col-sm-12">
                      <div class="box-body table-responsive">
                          <table id="t_pagos" class="table table-bordered">
                              <thead>
                                  <tr>
                                      <th>N</th>
                                      <th>Curso</th>
                                      <th>Recibo</th>
                                      <th>Monto</th>
                                  </tr>
                              </thead>
                              <tbody id="tb_pagos"></tbody>
                          </table>
                      </div><!-- /.box-body -->
                  </div>
              </div>
              <div id="campos_editables">
                <div class="col-sm-12">
                  <div class="col-sm-6">
                    <label class="control-label">DESCRIPCIÓN DE LA ATENCIÓN: 
                        <a id="error_resultado" style="display:none" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="bottom" title="Ingrese descripcion de solucion">
                            <i class="fa fa-exclamation"></i>
                        </a>
                    </label>
                    <textarea id="resultado" name="resultado" class="form-control" rows="2" required placeholder="Ingrese descripcion de solucion"></textarea>
                  </div>
                  <div class="col-sm-3">
                    <label class="control-label">FECHA ATENCIÓN:
                        <a id="error_fecha_estado" style="display:none" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="bottom" title="Ingrese descripcion de solucion">
                            <i class="fa fa-exclamation"></i>
                        </a>
                    </label>
                    <input type="text" class="form-control" placeholder="AAAA-MM-DD HH:mm" name="fecha_estado" id="fecha_estado" onfocus="blur()">
                  </div>
                  <div class="col-sm-3">
                    <label class="control-label">Estado:
                      <a id="error_estado_problema_id" style="display:none" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="bottom" title="Seleccione estado">
                          <i class="fa fa-exclamation"></i>
                      </a>
                    </label>
                    <select class="form-control" name="slct_estado_problema_id" id="slct_estado_problema_id">
                    </select>
                  </div>
                </div>
              </div>
            </div>
        </form>
      </div>
      <div class="modal-footer" id="b_footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>
<!-- /.modal -->
