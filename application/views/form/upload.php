<section class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Documentos del <strong>formulario</strong></h3>
                <div class="well-container">
                    <?php echo form_open_multipart("form/do_uploads", array("id" => "FormDocs", "name" => "FormDocs", "class" => "form-horizontal")); ?>
                    <fieldset>
                        <legend>Subir documetos</legend>
                        <p class="text-info text-right"><span class="text-danger">*</span> Indica un campo requerido</p>
                        <div class="form-group">
                            <label for="TxtFileHabeasData01" class="col-sm-3 control-label">01. Formato + Habeas Data</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" id="TxtFileHabeasData01" name="TxtFileHabeasData01"
                                       placeholder="Habeas Data" title="Ingrese el Doc de Habeas Data!">
                            </div>
                            <label for="TxtHabeasData01" class="col-sm-1 control-label">No. de Folios</label>
                            <div class="col-sm-2">
                                <input type="number" class="form-control" id="TxtHabeasData01" name="TxtHabeasData01"
                                       placeholder="No. de Folios" title="Ingrese el No. de Folios!" min="0">
                            </div>
                            <div class="col-sm-3 pull-right"></div>
                        </div>
                        <!-- <div class="form-group">
                          <label for="TxtFileRegister" class="col-sm-3 control-label">Formato de Registro</label>
                          <div class="col-sm-4">
                            <input type="file" class="form-control" id="TxtFileRegister" name="TxtFileRegister"
                              placeholder="Formato de Registro" title="Ingrese el Formato de Registro!">
                          </div>
                          <label for="TxtRegister" class="col-sm-1 control-label">No. de Folios</label>
                          <div class="col-sm-2">
                            <input type="number" class="form-control" id="TxtRegister" name="TxtRegister"
                              placeholder="No. de Folios" title="Ingrese el No. de Folios!" min="0">
                          </div>
                          <div class="col-sm-3 pull-right"></div>
                        </div> -->
                        <div class="form-group">
                            <label for="TxtFileIdentification02" class="col-sm-3 control-label">02. Documento de Identidad</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" id="TxtFileIdentification02" name="TxtFileIdentification02"
                                       placeholder="Documento de Identidad" title="Ingrese el Documento de Identidad!">
                            </div>
                            <label for="TxtIdentification02" class="col-sm-1 control-label">No. de Folios</label>
                            <div class="col-sm-2">
                                <input type="number" class="form-control" id="TxtIdentification02" name="TxtIdentification02"
                                       placeholder="No. de Folios" title="Ingrese el No. de Folios!" min="0">
                            </div>
                            <div class="col-sm-3 pull-right"></div>
                        </div>
                        <div class="form-group">
                            <label for="TxtFileLawyer03" class="col-sm-3 control-label">03. Poder de Abogado</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" id="TxtFileLawyer03" name="TxtFileLawyer03"
                                       placeholder="Poder de Abogado" title="Ingrese el Poder de Abogado!">
                            </div>
                            <label for="TxtLawyer03" class="col-sm-1 control-label">No. de Folios</label>
                            <div class="col-sm-2">
                                <input type="number" class="form-control" id="TxtLawyer03" name="TxtLawyer03"
                                       placeholder="No. de Folios" title="Ingrese el No. de Folios!" min="0">
                            </div>
                            <div class="col-sm-3 pull-right"></div>
                        </div>
                        <div class="form-group">
                            <label for="TxtFileCertifieds04" class="col-sm-3 control-label">04. Certificaciones Laborales</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" id="TxtFileCertifieds04" name="TxtFileCertifieds04"
                                       placeholder="Certificaciones Laborales" title="Ingrese las Certificaciones Laborales!">
                            </div>
                            <label for="TxtCertifieds04" class="col-sm-1 control-label">No. de Folios</label>
                            <div class="col-sm-2">
                                <input type="number" class="form-control" id="TxtCertifieds04" name="TxtCertifieds04"
                                       placeholder="No. de Folios" title="Ingrese el No. de Folios!" min="0">
                            </div>
                            <div class="col-sm-3 pull-right"></div>
                        </div>
                        <div class="form-group">
                            <label for="TxtFileAutorize05" class="col-sm-3 control-label">05. Autorización de Entidiades</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" id="TxtFileAutorize05" name="TxtFileAutorize05"
                                       placeholder="Autorización de Entidiades" title="Ingrese la Autorización de Entidiades!">
                            </div>
                            <label for="TxtAutorize05" class="col-sm-1 control-label">No. de Folios</label>
                            <div class="col-sm-2">
                                <input type="number" class="form-control" id="TxtAutorize05" name="TxtAutorize05"
                                       placeholder="No. de Folios" title="Ingrese el No. de Folios!" min="0">
                            </div>
                            <div class="col-sm-3 pull-right"></div>
                        </div>
                        <div class="form-group">
                            <label for="TxtFileThirdParty06" class="col-sm-3 control-label">06. Certificaciones de Terceros</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" id="TxtFileThirdParty06" name="TxtFileThirdParty06"
                                       placeholder="Certificaciones de Terceros" title="Ingrese las Certificaciones de Terceros!">
                            </div>
                            <label for="TxtThirdParty06" class="col-sm-1 control-label">No. de Folios</label>
                            <div class="col-sm-2">
                                <input type="number" class="form-control" id="TxtThirdParty06" name="TxtThirdParty06"
                                       placeholder="No. de Folios" title="Ingrese el No. de Folios!" min="0">
                            </div>
                            <div class="col-sm-3 pull-right"></div>
                        </div>
                        <div class="form-group">
                            <label for="TxtFileCommercial07" class="col-sm-3 control-label">07. Certificaciones Comerciales</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" id="TxtFileCommercial07" name="TxtFileCommercial07"
                                       placeholder="Certificaciones Comerciales" title="Ingrese las Certificaciones Comerciales!">
                            </div>
                            <label for="TxtCommercial07" class="col-sm-1 control-label">No. de Folios</label>
                            <div class="col-sm-2">
                                <input type="number" class="form-control" id="TxtCommercial07" name="TxtCommercial07"
                                       placeholder="No. de Folios" title="Ingrese el No. de Folios!" min="0">
                            </div>
                            <div class="col-sm-3 pull-right"></div>
                        </div>
                        <div class="form-group">
                            <label for="TxtFileInvoices08" class="col-sm-3 control-label">08. Facturas - Recibos</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" id="TxtFileInvoices08" name="TxtFileInvoices08"
                                       placeholder="Facturas - Recibos" title="Ingrese las Facturas - Recibos!">
                            </div>
                            <label for="TxtInvoices08" class="col-sm-1 control-label">No. de Folios</label>
                            <div class="col-sm-2">
                                <input type="number" class="form-control" id="TxtInvoices08" name="TxtInvoices08"
                                       placeholder="No. de Folios" title="Ingrese el No. de Folios!" min="0">
                            </div>
                            <div class="col-sm-3 pull-right"></div>
                        </div>
                        <div class="form-group">
                            <label for="TxtFileNeighbor09" class="col-sm-3 control-label">09. Certificaciones de Vecindad</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" id="TxtFileNeighbor09" name="TxtFileNeighbor09"
                                       placeholder="Certificaciones de Vecindad" title="Ingrese las Certificaciones de Vecindad!">
                            </div>
                            <label for="TxtNeighbor09" class="col-sm-1 control-label">No. de Folios</label>
                            <div class="col-sm-2">
                                <input type="number" class="form-control" id="TxtNeighbor09" name="TxtNeighbor09"
                                       placeholder="No. de Folios" title="Ingrese el No. de Folios!" min="0">
                            </div>
                            <div class="col-sm-3 pull-right"></div>
                        </div>
                        <div class="form-group">
                            <label for="TxtFilePQR10" class="col-sm-3 control-label">10. Derechos de Petición a Entidades de Control</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" id="TxtFilePQR10" name="TxtFilePQR10"
                                       placeholder="Derechos de Petición a Entidades de Control"
                                       title="Ingrese los Derechos de Petición a Entidades de Control!">
                            </div>
                            <label for="TxtPQR10" class="col-sm-1 control-label">No. de Folios</label>
                            <div class="col-sm-2">
                                <input type="number" class="form-control" id="TxtPQR10" name="TxtPQR10"
                                       placeholder="No. de Folios" title="Ingrese el No. de Folios!" min="0">
                            </div>
                            <div class="col-sm-3 pull-right"></div>
                        </div>
                        <div class="form-group">
                            <label for="TxtFileEmgesa11" class="col-sm-3 control-label">11. Radicados Emgesa</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" id="TxtFileEmgesa11" name="TxtFileEmgesa11"
                                       placeholder="Radicados Emgesa" title="Ingrese los Radicados Emgesa!">
                            </div>
                            <label for="TxtEmgesa11" class="col-sm-1 control-label">No. de Folios</label>
                            <div class="col-sm-2">
                                <input type="number" class="form-control" id="TxtEmgesa11" name="TxtEmgesa11"
                                       placeholder="No. de Folios" title="Ingrese el No. de Folios!" min="0">
                            </div>
                            <div class="col-sm-3 pull-right"></div>
                        </div>
                        <div class="form-group">
                            <label for="TxtFileOthers12" class="col-sm-3 control-label">12. Otros</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" id="TxtFileOthers12" name="TxtFileOthers12"
                                       placeholder="Otros" title="Ingrese Otros!">
                            </div>
                            <label for="TxtOthers12" class="col-sm-1 control-label">No. de Folios</label>
                            <div class="col-sm-2">
                                <input type="number" class="form-control" id="TxtOthers12" name="TxtOthers12"
                                       placeholder="No. de Folios" title="Ingrese el No. de Folios!" min="0">
                            </div>
                            <div class="col-sm-3 pull-right"></div>
                        </div>
                        <div class="form-group">
                            <label for="TxtFileVideo13" class="col-sm-3 control-label">13. Videos</label>
                            <div class="col-sm-4">
                                <input type="file" accept=".wmv"class="form-control" id="TxtFileVideo13" name="TxtFileVideo13"
                                       placeholder="Otros" title="Ingrese Otros!">
                            </div>
                            <label for="TxtVideo13" class="col-sm-1 control-label">No. de Folios</label>
                            <div class="col-sm-2">
                                <input type="number" class="form-control" id="TxtVideo13" name="TxtVideo13"
                                       placeholder="No. de Folios" title="Ingrese el No. de Folios!" min="0">
                            </div>
                            <div class="col-sm-3 pull-right"></div>
                        </div>
                    </fieldset>
                    <div class="form-actions clearfix">
                        <div class="pull-right">
                            <input type="hidden" name="TxtFormID" id="TxtFormID" value="<?php echo $stRFormID; ?>">
                            <button type="submit" class="btn btn-primary">Subir Documentos
                                <span class="fa fa-file"></span></button>
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
                        <span> Subiendo, espere por favor &#8230;</span>
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