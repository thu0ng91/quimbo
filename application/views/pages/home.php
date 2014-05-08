    <section class="main-content">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h3>Iniciar <strong>Sesión</strong></h3>
            <div class="well-container">
              <?php echo form_open("user/do_login", array("id" => "FormLogin", "name" => "FormLogin", "class" => "form-horizontal")); ?>
                <fieldset>
                  <legend>Datos de Usuario</legend>
                  <p class="text-info text-right"><span class="text-danger">*</span> Indica un campo requerido</p>
                  <div class="form-group">
                    <label for="TxtUsername" class="col-sm-3 control-label">Nombre de Usuario <span class="text-danger">*</span></label>
                    <div class="col-sm-3">
                      <input type="text" class="form-control" id="TxtUsername" name="TxtUsername" placeholder="Nombre de Usuario"
                        title="Ingrese su Nombre de Usuario!">
                    </div>
                    <div class="col-sm-3 pull-right"></div>
                  </div>
                  <div class="form-group">
                    <label for="TxtPassword" class="col-sm-3 control-label">Contraseña <span class="text-danger">*</span></label>
                    <div class="col-sm-3">
                      <input type="password" class="form-control" id="TxtPassword" name="TxtPassword" placeholder="Contraseña"
                        title="Ingrese su Contraseña!">
                    </div>
                    <div class="col-sm-3 pull-right"></div>
                  </div>
                </fieldset>
                <div class="form-actions clearfix">
                  <div class="pull-right">
                    <button type="submit" class="btn btn-primary">Ingresar <span class="fa fa-sign-in"></span></button>
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