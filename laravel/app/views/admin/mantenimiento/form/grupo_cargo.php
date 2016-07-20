<!-- /.modal -->
<div class="modal fade" id="grupocargoModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header logo">
        <button class="btn btn-sm btn-default pull-right" data-dismiss="modal">
            <i class="fa fa-close"></i>
        </button>
        <h4 class="modal-title">New message</h4>
      </div>
      <div class="modal-body">
        <form id="form_grupocargo" name="form_grupocargo" action="" method="post">
          <div class="form-group">
            <label class="control-label">Equipo
            </label>
            <select class="form-control" name="slct_grupop" id="slct_grupop">
                <option value=''>.::Seleccione::.</option>
            </select>
          </div>
          <div class="form-group">
            <label class="control-label">Cargo
            </label>
            <select class="form-control" name="slct_cargo" id="slct_cargo">
                <option value=''>.::Seleccione::.</option>
            </select>
          </div>
          <div class="form-group">
            <label class="control-label">Fecha de Inicio
            </label>
            <input type='text' class='form-control fecha' id='txt_fecha_inicio' name='txt_fecha_inicio' >
          </div>
          <div class="form-group">
            <label class="control-label">Estado:
            </label>
            <select class="form-control" name="slct_estado" id="slct_estado">
                <option value='0'>Inactivo</option>
                <option value='1' selected>Activo</option>
            </select>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>
<!-- /.modal -->
