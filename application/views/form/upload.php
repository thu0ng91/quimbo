<script type="text/javascript">
    /*
     * Autor: Juan Camilo Martinez Morales
     * Fecha: 04/08/2014
     * Modificacion: Se agrega procedimiento por ajax 
     * para obtener los documentos cargados para el formulario actual 
     */

    $(document).ready(function() {

    });

    function getFilesFromForm() {
        $.ajax({
            url: "index.php/form/",
            type: "POST",
            data: {},
            success: function() {

            },
            error: function() {

            }
        });
    }


</script>          
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
                            <label for="TxtFileHabeasData" class="col-sm-3 control-label">01. Formato + Habeas Data</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" id="TxtFileHabeasData" name="TxtFileHabeasData"
                                       placeholder="Habeas Data" title="Ingrese el Doc de Habeas Data!">
                            </div>
                            <label for="TxtHabeasData" class="col-sm-1 control-label">No. de Folios</label>
                            <div class="col-sm-2">
                                <input type="number" class="form-control" id="TxtHabeasData" name="TxtHabeasData"
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
                            <label for="TxtFileIdentification" class="col-sm-3 control-label">02. Documento de Identidad</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" id="TxtFileIdentification" name="TxtFileIdentification"
                                       placeholder="Documento de Identidad" title="Ingrese el Documento de Identidad!">
                            </div>
                            <label for="TxtIdentification" class="col-sm-1 control-label">No. de Folios</label>
                            <div class="col-sm-2">
                                <input type="number" class="form-control" id="TxtIdentification" name="TxtIdentification"
                                       placeholder="No. de Folios" title="Ingrese el No. de Folios!" min="0">
                            </div>
                            <div class="col-sm-3 pull-right"></div>
                        </div>
                        <div class="form-group">
                            <label for="TxtFileLawyer" class="col-sm-3 control-label">03. Poder de Abogado</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" id="TxtFileLawyer" name="TxtFileLawyer"
                                       placeholder="Poder de Abogado" title="Ingrese el Poder de Abogado!">
                            </div>
                            <label for="TxtLawyer" class="col-sm-1 control-label">No. de Folios</label>
                            <div class="col-sm-2">
                                <input type="number" class="form-control" id="TxtLawyer" name="TxtLawyer"
                                       placeholder="No. de Folios" title="Ingrese el No. de Folios!" min="0">
                            </div>
                            <div class="col-sm-3 pull-right"></div>
                        </div>
                        <div class="form-group">
                            <label for="TxtFileCertifieds" class="col-sm-3 control-label">04. Certificaciones Laborales</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" id="TxtFileCertifieds" name="TxtFileCertifieds"
                                       placeholder="Certificaciones Laborales" title="Ingrese las Certificaciones Laborales!">
                            </div>
                            <label for="TxtCertifieds" class="col-sm-1 control-label">No. de Folios</label>
                            <div class="col-sm-2">
                                <input type="number" class="form-control" id="TxtCertifieds" name="TxtCertifieds"
                                       placeholder="No. de Folios" title="Ingrese el No. de Folios!" min="0">
                            </div>
                            <div class="col-sm-3 pull-right"></div>
                        </div>
                        <div class="form-group">
                            <label for="TxtFileAutorize" class="col-sm-3 control-label">05. Autorización de Entidiades</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" id="TxtFileAutorize" name="TxtFileAutorize"
                                       placeholder="Autorización de Entidiades" title="Ingrese la Autorización de Entidiades!">
                            </div>
                            <label for="TxtAutorize" class="col-sm-1 control-label">No. de Folios</label>
                            <div class="col-sm-2">
                                <input type="number" class="form-control" id="TxtAutorize" name="TxtAutorize"
                                       placeholder="No. de Folios" title="Ingrese el No. de Folios!" min="0">
                            </div>
                            <div class="col-sm-3 pull-right"></div>
                        </div>
                        <div class="form-group">
                            <label for="TxtFileThirdParty" class="col-sm-3 control-label">06. Certificaciones de Terceros</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" id="TxtFileThirdParty" name="TxtFileThirdParty"
                                       placeholder="Certificaciones de Terceros" title="Ingrese las Certificaciones de Terceros!">
                            </div>
                            <label for="TxtThirdParty" class="col-sm-1 control-label">No. de Folios</label>
                            <div class="col-sm-2">
                                <input type="number" class="form-control" id="TxtThirdParty" name="TxtThirdParty"
                                       placeholder="No. de Folios" title="Ingrese el No. de Folios!" min="0">
                            </div>
                            <div class="col-sm-3 pull-right"></div>
                        </div>
                        <div class="form-group">
                            <label for="TxtFileCommercial" class="col-sm-3 control-label">07. Certificaciones Comerciales</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" id="TxtFileCommercial" name="TxtFileCommercial"
                                       placeholder="Certificaciones Comerciales" title="Ingrese las Certificaciones Comerciales!">
                            </div>
                            <label for="TxtCommercial" class="col-sm-1 control-label">No. de Folios</label>
                            <div class="col-sm-2">
                                <input type="number" class="form-control" id="TxtCommercial" name="TxtCommercial"
                                       placeholder="No. de Folios" title="Ingrese el No. de Folios!" min="0">
                            </div>
                            <div class="col-sm-3 pull-right"></div>
                        </div>
                        <div class="form-group">
                            <label for="TxtFileInvoices" class="col-sm-3 control-label">08. Facturas - Recibos</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" id="TxtFileInvoices" name="TxtFileInvoices"
                                       placeholder="Facturas - Recibos" title="Ingrese las Facturas - Recibos!">
                            </div>
                            <label for="TxtInvoices" class="col-sm-1 control-label">No. de Folios</label>
                            <div class="col-sm-2">
                                <input type="number" class="form-control" id="TxtInvoices" name="TxtInvoices"
                                       placeholder="No. de Folios" title="Ingrese el No. de Folios!" min="0">
                            </div>
                            <div class="col-sm-3 pull-right"></div>
                        </div>
                        <div class="form-group">
                            <label for="TxtFileNeighbor" class="col-sm-3 control-label">09. Certificaciones de Vecindad</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" id="TxtFileNeighbor" name="TxtFileNeighbor"
                                       placeholder="Certificaciones de Vecindad" title="Ingrese las Certificaciones de Vecindad!">
                            </div>
                            <label for="TxtNeighbor" class="col-sm-1 control-label">No. de Folios</label>
                            <div class="col-sm-2">
                                <input type="number" class="form-control" id="TxtNeighbor" name="TxtNeighbor"
                                       placeholder="No. de Folios" title="Ingrese el No. de Folios!" min="0">
                            </div>
                            <div class="col-sm-3 pull-right"></div>
                        </div>
                        <div class="form-group">
                            <label for="TxtFilePQR" class="col-sm-3 control-label">10. Derechos de Petición a Entidades de Control</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" id="TxtFilePQR" name="TxtFilePQR"
                                       placeholder="Derechos de Petición a Entidades de Control"
                                       title="Ingrese los Derechos de Petición a Entidades de Control!">
                            </div>
                            <label for="TxtPQR" class="col-sm-1 control-label">No. de Folios</label>
                            <div class="col-sm-2">
                                <input type="number" class="form-control" id="TxtPQR" name="TxtPQR"
                                       placeholder="No. de Folios" title="Ingrese el No. de Folios!" min="0">
                            </div>
                            <div class="col-sm-3 pull-right"></div>
                        </div>
                        <div class="form-group">
                            <label for="TxtFileEmgesa" class="col-sm-3 control-label">11. Radicados Emgesa</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" id="TxtFileEmgesa" name="TxtFileEmgesa"
                                       placeholder="Radicados Emgesa" title="Ingrese los Radicados Emgesa!">
                            </div>
                            <label for="TxtEmgesa" class="col-sm-1 control-label">No. de Folios</label>
                            <div class="col-sm-2">
                                <input type="number" class="form-control" id="TxtEmgesa" name="TxtEmgesa"
                                       placeholder="No. de Folios" title="Ingrese el No. de Folios!" min="0">
                            </div>
                            <div class="col-sm-3 pull-right"></div>
                        </div>
                        <div class="form-group">
                            <label for="TxtFileOthers" class="col-sm-3 control-label">12. Otros</label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" id="TxtFileOthers" name="TxtFileOthers"
                                       placeholder="Otros" title="Ingrese Otros!">
                            </div>
                            <label for="TxtOthers" class="col-sm-1 control-label">No. de Folios</label>
                            <div class="col-sm-2">
                                <input type="number" class="form-control" id="TxtOthers" name="TxtOthers"
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