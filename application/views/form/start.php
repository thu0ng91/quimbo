    <section class="main-content">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h3>Registro en el <strong>Censo</strong></h3>
            <div class="well-container">
              <div class="alert alert-info">
                <h4>Atención!</h4>
                <span>No olvide iniciar la Grabación</span>
              </div>
              <?php echo form_open("form/do_form", array("id" => "FormInit", "name" => "FormInit", "class" => "form-horizontal")); ?>
                <fieldset>
                  <legend>Datos del Formulario</legend>
                  <p class="text-info text-right"><span class="text-danger">*</span> Indica un campo requerido</p>
                  <div class="form-group">
                    <label for="TxtFormDate" class="col-sm-3 control-label">Fecha de Aplicación <span class="text-danger">*</span></label>
                    <div class="col-sm-2">
                      <input type="date" class="form-control" id="TxtFormDate" name="TxtFormDate" placeholder="Fecha de Aplicación"
                        title="Ingrese la Fecha de Aplicación!" value="<?php echo date("Y-m-d"); ?>">
                    </div>
                    <div class="col-sm-3 pull-right"></div>
                  </div>
                  <div class="form-group">
                    <label for="TxtFormState" class="col-sm-3 control-label">Departamento
                       <span class="text-danger">*</span></label>
                    <div class="col-sm-3">
                      <select class="form-control" name="TxtFormState" id="TxtFormState"
                          title="Seleccione el Departamento">
                        <option value="">Seleccione Uno</option>
<?php foreach($arrRStates as $arrLState) { ?>
                        <option value="<?php echo $arrLState["a05Codigo"]; ?>"><?php echo $arrLState["a05Nombre"]; ?></option>
<?php } ?>
                      </select>
                    </div>
                    <div class="col-sm-3 pull-right"></div>
                  </div>
                  <div class="form-group">
                    <label for="TxtFormTown" class="col-sm-3 control-label">Municipio
                       <span class="text-danger">*</span></label>
                    <div class="col-sm-3">
                      <select class="form-control" name="TxtFormTown" id="TxtFormTown"
                          title="Seleccione el Municipio">
                        <option value="">Seleccione Uno</option>
                      </select>
                    </div>
                    <div class="col-sm-3 pull-right"></div>
                  </div>
                  <div class="form-group">
                    <label for="TxtFormPlace" class="col-sm-3 control-label">Lugar de Aplicación <span class="text-danger">*</span></label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="TxtFormPlace" name="TxtFormPlace" placeholder="Lugar de Aplicación"
                        title="Ingrese el Lugar de Aplicación!">
                    </div>
                    <div class="col-sm-3 pull-right"></div>
                  </div>
                </fieldset>
                <div class="form-actions clearfix">
                  <div class="pull-right">
                    <button type="submit" class="btn btn-primary">Continuar <span class="fa fa-chevron-right"></span></button>
                    <button type="reset" class="btn btn-default">Limpiar</button>
                  </div>
                </div>
              <?php echo form_close(); ?>
            </div>
          </div>
          <div class="col-md-12">
            <div class="hide-alt" id="responseLoader">
              <div class="alert alert-info text-center">
                <img src="public/img/ajax-loader.gif" alt="Cargando" width="32" height="32">
                <span> Ingresando, espere por favor &#8230;</span>
              </div>
            </div>
            <div class="hide-alt" id="responseContainer">
              <div class="alert alert-danger">
                <h4>Error!</h4>
                <span id="responseText"></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>