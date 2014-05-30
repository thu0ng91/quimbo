    <section class="main-content">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h3>Cierre del <strong>formulario</strong></h3>
            <div class="well-container">
              <?php echo form_open_multipart("form/do_finish", array("id" => "FormFinish", "name" => "FormFinish", "class" => "form-horizontal")); ?>
                <fieldset>
                  <legend>Datos del Formulario</legend>
                  <p class="text-info text-right"><span class="text-danger">*</span> Indica un campo requerido</p>
                  <div class="form-group">
                    <label for="TxtFormID" class="col-sm-3 control-label">Imprimir formulario <span class="text-danger">*</span></label>
                    <div class="col-sm-2">
                      <a class="btn btn-warning" href="<?php echo site_url("form/print_form"); ?>" target="_blank">
                        Imprimir formulario para firmar</a>
                    </div>
                    <div class="col-sm-3 pull-right"></div>
                  </div>
                  <div class="form-group">
                    <label for="TxtFormImage" class="col-sm-3 control-label">Imágen del Formulario firmado</label>
                    <div class="col-sm-4">
                      <input type="file" class="form-control" id="TxtFormImage" name="TxtFormImage"
                        placeholder="Imágen del Formulario" title="Ingrese la Imágen del Formulario!"
                        accept="image/*,application/pdf">
                    </div>
                    <div class="col-sm-3 pull-right"></div>
                  </div>
                  <div class="form-group">
                    <label for="TxtFormVideo" class="col-sm-3 control-label">Video del Formulario</label>
                    <div class="col-sm-4">
                      <input type="file" class="form-control" id="TxtFormVideo" name="TxtFormVideo"
                        placeholder="Imágen del Formulario" title="Ingrese el Video del Formulario!"
                        accept="video/*">
                    </div>
                    <div class="col-sm-3 pull-right"></div>
                  </div>
                  <div class="form-group">
                    <label for="TxtBarCode" class="col-sm-3 control-label">Código de Barras</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="TxtBarCode" name="TxtBarCode"
                        placeholder="Código de Barras" title="Ingrese el Codigo de Barras">
                    </div>
                    <div class="col-sm-3 pull-right"></div>
                  </div>
                </fieldset>
                <div class="form-actions clearfix">
                  <div class="pull-right">
                    <button type="submit" class="btn btn-primary">Cerrar Formulario
                       <span class="fa fa-repeat"></span></button>
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