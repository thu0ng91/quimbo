    <section class="main-content">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h3>Buscar <strong>formulario</strong></h3>
            <div class="well-container">
              <?php echo form_open("form/do_search", array("id" => "FormSearch", "name" => "FormSearch", "class" => "form-horizontal")); ?>
                <fieldset>
                  <legend>Datos del formulario</legend>
                  <p class="text-info text-right"><span class="text-danger">*</span> Indica un campo requerido</p>
                  <div class="form-group">
                    <label for="TxtFormNo" class="col-sm-3 control-label">Identificador del Formulario</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="TxtFormNo" name="TxtFormNo"
                        placeholder="Identificador del Formulario" title="Ingrese el Identificador del Formulario!">
                    </div>
                    <div class="col-sm-3 pull-right"></div>
                  </div>
                  <div class="form-group">
                    <label for="TxtPersonIdentity" class="col-sm-3 control-label">Identificación de la persona</label>
                    <div class="col-sm-3">
                      <input type="text" class="form-control" id="TxtPersonIdentity" name="TxtPersonIdentity"
                        placeholder="Número de Identificación" title="Ingrese el Número de Identificación!">
                    </div>
                    <div class="col-sm-3 pull-right"></div>
                  </div>
<?php if ($inRUserType != 3) { ?>
                  <div class="form-group">
                    <label for="TxtPersonName" class="col-sm-3 control-label">Nombres y/o apellidos</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="TxtPersonName" name="TxtPersonName"
                        placeholder="Nombres" title="Ingrese el Nombre!">
                    </div>
                    <div class="col-sm-3 pull-right"></div>
                  </div>
<?php } ?>
                </fieldset>
                <div class="form-actions clearfix">
                  <div class="pull-right">
                    <input type="hidden" name="TxtUserType" id="TxtUserType" value="<?php echo $inRUserType; ?>">
                    <button type="submit" class="btn btn-primary">Buscar <span class="fa fa-search"></span></button>
                    <button type="reset" class="btn btn-default">Limpiar</button>
                  </div>
                </div>
              <?php echo form_close(); ?>
            </div>
            <div class="results hide-alt">
              <h3>Lista de <strong>resultados</strong></h3>
              <div class="well-container">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Identificación</th>
                      <th>Nombre</th>
                      <th>Formulario</th>
                      <th>Acción</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="hide-alt" id="responseLoader">
              <div class="alert alert-info text-center">
                <img src="public/img/ajax-loader.gif" alt="Cargando" width="32" height="32">
                <span> Buscando, espere por favor &#8230;</span>
              </div>
            </div>
            <div class="hide-alt" id="responseContainer">
              <div class="alert alert-danger">
                <h4>Error!</h4>
                <p id="responseText"></p>
                <p><a class="btn btn-danger" href="<?php echo site_url("form/start"); ?>">Crear Nuevo</a></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>