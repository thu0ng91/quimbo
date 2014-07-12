    <section class="main-content">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h3>Registro en el <strong>Censo</strong></h3>
            <div class="well-container">
<?php if (!empty($inRSearch) && $arrRChapter["a02Letra"] == "A") { ?>
              <div class="alert alert-info">
                <h4>Atención!</h4>
                <span>No olvide iniciar la Grabación</span>
              </div>
<?php } ?>
              <?php echo form_open_multipart("form/do_chapter", array("id" => "FormChapter", "name" => "FormChapter", "class" => "form-horizontal", "novalidate" => "novalidate")); ?>
                <fieldset>
                  <legend>Capítulo <?php echo $arrRChapter["a02Letra"]; ?> - <?php echo $arrRChapter["a02Nombre"]; ?></legend>
                  <p class="text-info text-right"><span class="text-danger">*</span> Indica un campo requerido</p>
<?php foreach($arrRChapter["arrRQuestions"] as $arrLQuestion) { ?>
<?php if (isset($arrLQuestion["a03Tipo"])) { ?>
<?php if ($arrLQuestion["a03Tipo"] == "O") { ?>
                  <div class="form-group">
<?php if(!is_null($arrLQuestion["a03Tamanyo"])) { ?>
                    <label for="<?php echo $arrLQuestion["a03Input"]; ?>" class="col-sm-3 control-label">
                      <span class="pull-left"><?php echo $arrLQuestion["a03Numero"]; ?>.</span>
                      <?php echo $arrLQuestion["a03Pregunta"]; ?>
                      <span class="text-danger">*</span></label>
                    <div class="col-sm-<?php echo $arrLQuestion["a03Tamanyo"]; ?>">
                      <input type="text" class="form-control" id="<?php echo $arrLQuestion["a03Input"]; ?>"
                        name="<?php echo $arrLQuestion["a03Input"]; ?>" placeholder="<?php echo $arrLQuestion["a03Pregunta"]; ?>"
                        title="Campo requerido!" required value="<?php echo isset($arrRSearch[$arrLQuestion["a03Field"]]) ? $arrRSearch[$arrLQuestion["a03Field"]] : null; ?>">
                    </div>
<?php } else { ?>
                    <label for="<?php echo $arrLQuestion["a03Input"]; ?>" class="col-sm-3 control-label">
                      <span class="pull-left"><?php echo $arrLQuestion["a03Numero"]; ?>.</span>
                      <?php echo $arrLQuestion["a03Pregunta"]; ?>
                      <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                      <textarea class="form-control" id="<?php echo $arrLQuestion["a03Input"]; ?>"
                        name="<?php echo $arrLQuestion["a03Input"]; ?>" placeholder="<?php echo $arrLQuestion["a03Pregunta"]; ?>"
                        title="Campo requerido!" rows="7" required><?php echo isset($arrRSearch[$arrLQuestion["a03Field"]]) ? $arrRSearch[$arrLQuestion["a03Field"]] : null; ?></textarea>
                    </div>
<?php } ?>
                    <div class="col-sm-3 pull-right"></div>
                  </div>
<?php } if ($arrLQuestion["a03Tipo"] == "C") { ?>
                  <div class="form-group">
                    <label for="<?php echo $arrLQuestion["a03Input"]; ?>" class="col-sm-3 control-label">
                      <span class="pull-left"><?php echo $arrLQuestion["a03Numero"]; ?>.</span>
                      <?php echo $arrLQuestion["a03Pregunta"]; ?>
                      <span class="text-danger">*</span></label>
                    <div class="col-sm-<?php echo $arrLQuestion["a03Tamanyo"]; ?>">
                      <select class="form-control" name="<?php echo $arrLQuestion["a03Input"]; ?>"
                          id="<?php echo $arrLQuestion["a03Input"]; ?>" title="Campo requerido!"
                           required>
                        <option value="">Seleccione Uno</option>
<?php foreach ($arrLQuestion["arrRAnswers"] as $arrLAnswer) { ?>
                        <option value="<?php echo $arrLAnswer["a04Codigo"]; ?>"
                            <?php if (isset($arrRSearch[$arrLQuestion["a03Field"]]) && $arrRSearch[$arrLQuestion["a03Field"]] == $arrLAnswer["a04Codigo"]) { ?>selected="selected"<?php } ?>>
                          <?php echo $arrLAnswer["a04Numero"]; ?> - <?php echo $arrLAnswer["a04Respuesta"]; ?></option>
<?php } ?>
                      </select>
                    </div>
                    <div class="col-sm-3 pull-right"></div>
                  </div>
<?php } if ($arrLQuestion["a03Tipo"] == "M") { ?>
                  <div class="form-group">
<?php foreach ($arrLQuestion["arrRAnswers"] as $arrLAnswer) { ?>
                    <div class="checkbox">
                      <label for="<?php echo $arrLQuestion["a03Input"]; ?>" class="control-label">
                        <input type="checkbox" name="<?php echo $arrLQuestion["a03Input"]; ?>"
                            title="Campo requerido!">
                          <?php echo $arrLAnswer["a04Numero"]; ?> - <?php echo $arrLAnswer["a04Respuesta"]; ?>
                        </label>
                      <div class="col-sm-3 pull-right"></div>
                    </div>
<?php } ?>
                  </div>
<?php } if ($arrLQuestion["a03Tipo"] == "T") { ?>
                  <div class="form-group">
                    <label for="<?php echo $arrLQuestion["a03Input"]; ?>" class="col-sm-3 control-label">
                      <span class="pull-left"><?php echo $arrLQuestion["a03Numero"]; ?>.</span>
                      <?php echo $arrLQuestion["a03Pregunta"]; ?>
                      <span class="text-danger">*</span></label>
                    <div class="col-sm-<?php echo $arrLQuestion["a03Tamanyo"]; ?>">
                      <select class="form-control" name="<?php echo $arrLQuestion["a03Input"]; ?>"
                          id="<?php echo $arrLQuestion["a03Input"]; ?>" title="Campo requerido!"
                           required>
                        <option value="">Seleccione Uno</option>
<?php foreach ($arrRTowns as $arrLTown) { ?>
                        <option value="<?php echo $arrLTown["a06Codigo"]; ?>"
                            <?php if (isset($arrRSearch[$arrLQuestion["a03Field"]]) && $arrRSearch[$arrLQuestion["a03Field"]] == $arrLAnswer["a06Codigo"]) { ?>selected="selected"<?php } ?>>
                          <?php echo $arrLTown["a06Nombre"]; ?></option>
<?php } ?>
                      </select>
                    </div>
                    <div class="col-sm-3 pull-right"></div>
                  </div>
<?php } if ($arrLQuestion["a03Tipo"] == "D") { ?>
                  <div class="form-group">
                    <label for="<?php echo $arrLQuestion["a03Input"]; ?>" class="col-sm-3 control-label">
                      <span class="pull-left"><?php echo $arrLQuestion["a03Numero"]; ?>.</span>
                      <?php echo $arrLQuestion["a03Pregunta"]; ?>
                      <span class="text-danger">*</span></label>
                    <div class="col-sm-<?php echo $arrLQuestion["a03Tamanyo"]; ?>">
                      <select class="form-control" name="<?php echo $arrLQuestion["a03Input"]; ?>"
                          id="<?php echo $arrLQuestion["a03Input"]; ?>" title="Campo requerido!"
                           required>
                        <option value="">Seleccione Uno</option>
<?php foreach ($arrRStates as $arrLState) { ?>
                        <option value="<?php echo $arrLState["a05Codigo"]; ?>"
                            <?php if (isset($arrRSearch[$arrLQuestion["a03Field"]]) && $arrRSearch[$arrLQuestion["a03Field"]] == $arrLAnswer["a05Codigo"]) { ?>selected="selected"<?php } ?>>
                          <?php echo $arrLState["a05Nombre"]; ?></option>
<?php } ?>
                      </select>
                    </div>
                    <div class="col-sm-3 pull-right"></div>
                  </div>
<?php } ?>
<?php } else { ?>
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h5 class="panel-title"><?php echo $arrLQuestion[1]["a03Numero"]; ?>.
                        <?php echo $arrLQuestion[1]["a03Titulo"]; ?>
<?php if (strpos($arrLQuestion[1]["a03Input"], "BP08") !== false ||
    strpos($arrLQuestion[1]["a03Input"], "CP08") !== false ||
    strpos($arrLQuestion[1]["a03Input"], "CP018") !== false ||
    strpos($arrLQuestion[1]["a03Input"], "CP019") !== false) { ?>
                        <span class="pull-right">
                          <a href="#ModalExtra_<?php echo $arrLQuestion[1]["a03Input"]; ?>" data-toggle="modal"
                            class="label label-info" data-title="<?php echo $arrLQuestion[1]["a03Titulo"]; ?>">Ingresar más datos</a>
                        </span>
                      </h5>
<?php } ?>
                    </div>
                    <div class="panel-body">
<?php foreach ($arrLQuestion as $arrLSubQuestion) { ?>
<?php if ($arrLSubQuestion["a03Tipo"] == "O") { ?>
                      <div class="form-group">
<?php if(!is_null($arrLSubQuestion["a03Tamanyo"])) { ?>
                        <label for="<?php echo $arrLSubQuestion["a03Input"]; ?>" class="col-sm-3 control-label">
                          <?php echo $arrLSubQuestion["a03Pregunta"]; ?>
                          <span class="text-danger">*</span></label>
                        <div class="col-sm-<?php echo $arrLSubQuestion["a03Tamanyo"]; ?>">
                          <input type="text" class="form-control" id="<?php echo $arrLSubQuestion["a03Input"]; ?>"
                            name="<?php echo $arrLSubQuestion["a03Input"]; ?>" placeholder="<?php echo $arrLSubQuestion["a03Pregunta"]; ?>"
                            title="Campo requerido!" required value="<?php echo isset($arrRSearch[$arrLSubQuestion["a03Field"]]) ? $arrRSearch[$arrLSubQuestion["a03Field"]] : null; ?>">
                        </div>
                        <div class="col-sm-3 pull-right"></div>
<?php } else { ?>
                    <label for="<?php echo $arrLSubQuestion["a03Input"]; ?>" class="col-sm-3 control-label">
                      <?php echo $arrLSubQuestion["a03Pregunta"]; ?>
                      <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                      <textarea class="form-control" id="<?php echo $arrLSubQuestion["a03Input"]; ?>"
                        name="<?php echo $arrLSubQuestion["a03Input"]; ?>" placeholder="<?php echo $arrLSubQuestion["a03Pregunta"]; ?>"
                        title="Campo requerido!" rows="7" required><?php echo isset($arrRSearch[$arrLSubQuestion["a03Field"]]) ? $arrRSearch[$arrLSubQuestion["a03Field"]] : null; ?></textarea>
                    </div>
<?php } ?>
                      </div>
<?php } if ($arrLSubQuestion["a03Tipo"] == "C") { ?>
                      <div class="form-group">
                        <label for="<?php echo $arrLSubQuestion["a03Input"]; ?>" class="col-sm-3 control-label">
                          <?php echo $arrLSubQuestion["a03Pregunta"]; ?>
                          <span class="text-danger">*</span></label>
                        <div class="col-sm-<?php echo $arrLSubQuestion["a03Tamanyo"]; ?>">
                          <select class="form-control" name="<?php echo $arrLSubQuestion["a03Input"]; ?>"
                              id="<?php echo $arrLSubQuestion["a03Input"]; ?>" title="Campo requerido!"
                               required>
                            <option value="">Seleccione Uno</option>
<?php foreach ($arrLSubQuestion["arrRAnswers"] as $arrLAnswer) { ?>
                            <option value="<?php echo $arrLAnswer["a04Codigo"]; ?>"
                                <?php if (isset($arrRSearch[$arrLSubQuestion["a03Field"]]) && $arrRSearch[$arrLSubQuestion["a03Field"]] == $arrLAnswer["a04Codigo"]) { ?>selected="selected"<?php } ?>>
                              <?php echo $arrLAnswer["a04Numero"]; ?> - <?php echo $arrLAnswer["a04Respuesta"]; ?></option>
<?php } ?>
                          </select>
                        </div>
                        <div class="col-sm-3 pull-right"></div>
                      </div>
<?php } if ($arrLSubQuestion["a03Tipo"] == "P") { ?>
                  <div class="form-group">
                    <label for="<?php echo $arrLSubQuestion["a03Input"]; ?>" class="col-sm-3 control-label">
                      <?php echo $arrLSubQuestion["a03Pregunta"]; ?>
                      <span class="text-danger">*</span></label>
                    <div class="col-sm-<?php echo $arrLSubQuestion["a03Tamanyo"]; ?>">
                      <select class="form-control" name="<?php echo $arrLSubQuestion["a03Input"]; ?>"
                          id="<?php echo $arrLSubQuestion["a03Input"]; ?>" title="Campo requerido!"
                           required>
                        <option value="">Seleccione Uno</option>
<?php foreach ($arrRCountries as $arrRCountry) { ?>
                        <option value="<?php echo $arrRCountry["a12Codigo"]; ?>" <?php if ($arrRCountry["a12Codigo"] == 52) { ?>selected="selected"<?php } ?>>
                          <?php echo $arrRCountry["a12Nombre"]; ?></option>
<?php } ?>
                      </select>
                    </div>
                    <div class="col-sm-3 pull-right"></div>
                  </div>
<?php } if ($arrLSubQuestion["a03Tipo"] == "D") { ?>
                  <div class="form-group">
                    <label for="<?php echo $arrLSubQuestion["a03Input"]; ?>" class="col-sm-3 control-label">
                      <?php echo $arrLSubQuestion["a03Pregunta"]; ?>
                      <span class="text-danger">*</span></label>
                    <div class="col-sm-<?php echo $arrLSubQuestion["a03Tamanyo"]; ?>">
                      <select class="form-control" name="<?php echo $arrLSubQuestion["a03Input"]; ?>"
                          id="<?php echo $arrLSubQuestion["a03Input"]; ?>" title="Campo requerido!"
                           required>
                        <option value="">Seleccione Uno</option>
<?php foreach ($arrRStates as $arrLState) { ?>
                        <option value="<?php echo $arrLState["a05Codigo"]; ?>"
                            <?php if (isset($arrRSearch[$arrLSubQuestion["a03Field"]]) && $arrRSearch[$arrLSubQuestion["a03Field"]] == $arrLState["a05Codigo"]) { ?>selected="selected"<?php }
                              if (!isset($arrRSearch[$arrLSubQuestion["a03Field"]]) && $arrLState["a05Codigo"] == 13) { ?>selected="selected"<?php } ?>>
                          <?php echo $arrLState["a05Nombre"];  ?></option>
<?php } ?>
                      </select>
                    </div>
                    <div class="col-sm-3 pull-right"></div>
                  </div>
<?php } if ($arrLSubQuestion["a03Tipo"] == "M") { ?>
                      <div class="form-group">
<?php foreach ($arrLSubQuestion["arrRAnswers"] as $arrLAnswer) { ?>
                        <div class="checkbox">
                          <label for="<?php echo $arrLSubQuestion["a03Input"]."M0".$arrLAnswer["a04Numero"]; ?>" class="control-label">
                            <input type="checkbox" name="<?php echo $arrLSubQuestion["a03Input"]; ?>[]"
                                title="Campo requerido!" required value="<?php echo $arrLAnswer["a04Codigo"]; ?>"
                                <?php if (isset($arrRSearch[$arrLSubQuestion["a03Field"]]) && $arrRSearch[$arrLSubQuestion["a03Field"]] == "on"
                                        && strpos($arrLSubQuestion["a03Field"], "O0".$arrLAnswer["a04Numero"])) { ?>checked="checked"<?php } ?>>
                              <?php echo $arrLAnswer["a04Numero"]; ?> - <?php echo $arrLAnswer["a04Respuesta"]; ?>
                            </label>
                          <div class="col-sm-3 pull-right"></div>
                        </div>
<?php } ?>
                      </div>
<?php } if ($arrLSubQuestion["a03Tipo"] == "T") { ?>
                      <div class="form-group">
                        <label for="<?php echo $arrLSubQuestion["a03Input"]; ?>" class="col-sm-3 control-label">
                          <?php echo $arrLSubQuestion["a03Pregunta"]; ?>
                          <span class="text-danger">*</span></label>
                        <div class="col-sm-<?php echo $arrLSubQuestion["a03Tamanyo"]; ?>">
                          <select class="form-control" name="<?php echo $arrLSubQuestion["a03Input"]; ?>"
                              id="<?php echo $arrLSubQuestion["a03Input"]; ?>" title="Campo requerido!"
                               required>
                            <option value="">Seleccione Uno</option>
<?php foreach ($arrRTowns as $arrLTown) { ?>
<?php if (strpos($arrLSubQuestion["a03Input"], "BP08O02") !== false ||
    strpos($arrLSubQuestion["a03Input"], "CP08O02") !== false) {  ?>
                            <option value="<?php echo $arrLTown["a06Codigo"]; ?>"
                                <?php if (isset($arrRSearch[$arrLSubQuestion["a03Field"]]) && $arrRSearch[$arrLSubQuestion["a03Field"]] == $arrLTown["a06Codigo"]) { ?>selected="selected"<?php } ?>>
                              <?php echo $arrLTown["a06Nombre"]; ?></option>
<?php } else { ?>
                            <option value="<?php echo $arrLTown["a06Codigo"]; ?>"
                                <?php if (isset($arrRSearch[$arrLSubQuestion["a03Field"]]) && $arrRSearch[$arrLSubQuestion["a03Field"]] == $arrLTown["a06Codigo"]) { ?>selected="selected"<?php } ?>>
                              <?php echo $arrLTown["a06Nombre"]; ?></option>
<?php } ?>
<?php } ?>
                            <option value="9999">Otra</option>
                          </select>
                        </div>
                        <div class="col-sm-3 pull-right"></div>
                      </div>
<?php } ?>
<?php } ?>
                    </div>
                  </div>
<?php } ?>
<?php } ?>
                </fieldset>
                <div class="form-actions clearfix">
                  <div class="pull-right">
                    <input type="hidden" name="TxtChapter" id="TxtChapter" value="<?php echo $arrRChapter["a02Letra"]; ?>">
                    <input type="hidden" name="TxtAction" id="TxtAction" value="<?php echo is_null($inRSearch) || ($inRUserType == 1) ? "C" : "T"; ?>">
                    <input type="hidden" name="TxtSearch" id="TxtSearch" value="<?php echo is_null($inRSearch) ? "N" : "Y"; ?>">
<?php if (isset($arrRChapter["a02Siguiente"]) && (is_null($inRSearch) || $inRUserType == 1)) { ?>
                    <button type="submit" class="btn btn-primary"><span>Continuar</span> <span class="fa fa-chevron-right"></span></button>
<?php } else { ?>
                    <button type="submit" class="btn btn-primary">Terminar</button>
<?php } ?>
                    <button type="reset" class="btn btn-default">Limpiar</button>
                  </div>
                </div>
<!-- Modal -->
<?php foreach($arrRChapter["arrRQuestions"] as $arrLQuestion) { ?>
<?php if (!isset($arrLQuestion["a03Tipo"])) { ?>
<?php foreach($arrLQuestion as $arrLSubQuestion) { ?>
<?php if (strpos($arrLSubQuestion["a03Input"], "BP08") !== false ||
    strpos($arrLQuestion[1]["a03Input"], "CP08") !== false ||
    strpos($arrLQuestion[1]["a03Input"], "CP018") !== false ||
    strpos($arrLQuestion[1]["a03Input"], "CP019") !== false) { ?>
<?php if ($arrLSubQuestion["a03Posicion"] == 1) { ?>
                      <div class="modal fade" id="ModalExtra_<?php echo $arrLSubQuestion["a03Input"]; ?>"
                          tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                              <h4 class="modal-title" id="myModalLabel"></h4>
                            </div>
                            <div class="modal-body">
                              <table class="table table-striped">
                                <thead>
                                  <tr>
<?php if (strpos($arrLSubQuestion["a03Input"], "BP08") !== false ||
    strpos($arrLQuestion[1]["a03Input"], "CP08") !== false) { ?>
                                    <th>Coordenadas</th>
                                    <th>Municipio</th>
                                    <th>Corregimiento</th>
                                    <th>Vereda</th>
                                    <th>Predio</th>
                                    <th>Nombre del dueño</th>
                                    <th>Remover</th>
<?php } if (strpos($arrLSubQuestion["a03Input"], "CP018") !== false) { ?>
                                    <th>Familiares</th>
                                    <th>Nombres y Apellidos</th>
                                    <th>Cedula</th>
                                    <th>Parentesco</th>
                                    <th>Medida</th>
<?php } if (strpos($arrLSubQuestion["a03Input"], "CP019") !== false) { ?>
                                    <th>Documento</th>
                                    <th>Numero de Folios</th>
<?php } ?>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
<?php } ?>
<?php if ($arrLSubQuestion["a03Tipo"] == "O") { ?>
                                    <td>
                                      <div class="form-group">
                                        <div class="col-sm-12">
                                          <input type="text" class="form-control" name="<?php echo $arrLSubQuestion["a03Input"]; ?>[]"
                                            placeholder="<?php echo $arrLSubQuestion["a03Pregunta"]; ?>"
                                            title="Campo requerido!" required>
                                        </div>
                                        <div class="col-sm-3 pull-right"></div>
                                      </div>
                                    </td>
<?php } if ($arrLSubQuestion["a03Tipo"] == "C") { ?>
                                    <td>
                                      <div class="form-group">
                                        <div class="col-sm-12">
                                          <select class="form-control" name="<?php echo $arrLSubQuestion["a03Input"]; ?>[]"
                                              title="Campo requerido!" required>
                                            <option value="">Seleccione Uno</option>
<?php foreach ($arrLSubQuestion["arrRAnswers"] as $arrLAnswer) { ?>
                                            <option value="<?php echo $arrLAnswer["a04Codigo"]; ?>">
                          <?php echo $arrLAnswer["a04Numero"]; ?> - <?php echo $arrLAnswer["a04Respuesta"]; ?></option>
<?php } ?>
                                          </select>
                                        </div>
                                        <div class="col-sm-3 pull-right"></div>
                                      </div>
                                    </td>
<?php } if ($arrLSubQuestion["a03Tipo"] == "D") { ?>
                                    <td>
                                      <div class="form-group">
                                        <div class="col-sm-12">
                                          <select class="form-control" name="<?php echo $arrLSubQuestion["a03Input"]; ?>[]"
                                              title="Campo requerido!" required>
                                            <option value="">Seleccione Uno</option>
<?php foreach ($arrRStates as $arrLState) { ?>
                                            <option value="<?php echo $arrLState["a05Codigo"]; ?>" <?php if ($arrLState["a05Codigo"] == 13) { ?>selected="selected"<?php } ?>>
                          <?php echo $arrLState["a05Nombre"]; ?></option>
<?php } ?>
                                          </select>
                                        </div>
                                        <div class="col-sm-3 pull-right"></div>
                                      </div>
                                    </td>
<?php } if ($arrLSubQuestion["a03Tipo"] == "T") { ?>
                                    <td>
                                      <div class="form-group">
                                        <div class="col-sm-12">
                                          <select class="form-control" name="<?php echo $arrLSubQuestion["a03Input"]; ?>[]"
                                              title="Campo requerido!" required>
                                            <option value="">Seleccione Uno</option>
<?php foreach ($arrRTowns as $arrLTown) { ?>
<?php if ($arrLTown["a06Estado"] == "A") { ?>
                                            <option value="<?php echo $arrLTown["a06Codigo"]; ?>"><?php echo $arrLTown["a06Nombre"]; ?></option>
<?php } ?>
<?php } ?>
                                          </select>
                                        </div>
                                        <div class="col-sm-3 pull-right"></div>
                                      </div>
                                    </td>
<?php } ?>
<?php if (strpos($arrLSubQuestion["a03Input"], "BP08") !== false && $arrLSubQuestion["a03Posicion"] == 6 ||
    strpos($arrLSubQuestion["a03Input"], "CP08") !== false && $arrLSubQuestion["a03Posicion"] == 6 ||
    strpos($arrLSubQuestion["a03Input"], "CP018") !== false && $arrLSubQuestion["a03Posicion"] == 5 ||
    strpos($arrLSubQuestion["a03Input"], "CP019") !== false && $arrLSubQuestion["a03Posicion"] == 2) { ?>
                                    <td><a href="javascript:;" class="btn btn-danger">Remover</a></td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                            <div class="modal-footer">
                              <a href="javascript:;" class="btn btn-primary">Agregar Fila</a>
                              <a href="javascript:;" class="btn btn-default" data-dismiss="modal">Cerrar</a>
                            </div>
                          </div>
                        </div>
                      </div>
<?php } ?>
<?php } ?>
<?php } ?>
<?php } ?>
<?php } ?>
<!-- // Modal -->
              <?php echo form_close(); ?>
            </div>
            <?php //echo $stRChapters; ?>
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