<link href="public/css/certifications/form.css" rel="stylesheet" />
<script type='text/javascript'>
    var formCode = '<?php echo $_GET["formCode"]; ?>';
    var code = '<?php
if (isset($_GET["code"])) {
    echo $_GET["code"];
} else {
    echo "0";
}
?>';
    var get_csrf_token_name = '<?php echo $this->security->get_csrf_token_name(); ?>';
    var get_csrf_hash = '<?php echo $this->security->get_csrf_hash(); ?>';
</script>
<section class="main-content">
    <div class="container">
        <div id='controls'>
            <br/>
            <legend>Registro de información para detalle de certificaciones laborales, comerciales y de vecindad.</legend>
            <br/>

            <div class='form-group' >
                <label for='txtIdentificador'>Identificador de formulario:</label>
                <br/>
                <label class='label label-info' id='txtIdentificador'></label>
            </div>
            <div class='form-group'>
                <label for='txtPersonaNoFigura'>La persona encuestada figura en la certificación?</label>
                <br/>
                <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-primary active">
                        <input type="radio" name="txtPersonaNoFigura" value="1"> Si
                    </label>
                    <label class="btn btn-primary">
                        <input type="radio" name="txtPersonaNoFigura" value="0"> No
                    </label>
                </div>
            </div>

            <div class='left'>
                <!-- Start Principal Fields -->
                <div class='form-group'>
                    <label for='txtTipoCertificacion'>Tipo de Certificado</label>
                    <select class='form-control' id='txtTipoCertificacion' name='txtTipoCertificacion'>
                        <option value=''>Seleccione el tipo de certificación...</option>
                        <option value='1'>Laboral</option>
                        <option value='2'>Comercial</option>
                        <option value='3'>Vecindad</option>
                        <!-- <option value='4'>Mixta</option> -->
                    </select>
                </div>
                <div class='form-group' >
                    <label id='labelFechaExpedicion' for='txtFechaExpedicion'>Fecha Expedicion</label>
                    <input type='date' name='txtFechaExpedicion' class='form-control' id='txtFechaExpedicion' name='txtFechaExpedicion'>
                </div>
                <div class='form-group'>
                    <label id="labeltxtMunicipioExpedicion" for='txtMunicipioExpedicion'>Municipio</label>
                    <select class='form-control' id="txtMunicipioExpedicion" name="txtMunicipioExpedicion">
                    </select>
                    <div class='form-group' id='containertxtOtroMunicipio' style='display: none;'>
                        <label id='lblCualOtroMunicipio' for='txtOtroMunicipio'>Cual?</label>
                        <input type='text' class='form-control' id='txtOtroMunicipio' name='txtOtroMunicipio'>
                    </div>
                </div>
                <div class='form-group'>
                    <label id="labeltxtVeredaCertificacion" for='txtVeredaCertificacion'>Vereda</label>
                    <select class='form-control' id="txtVeredaCertificacion" name="txtVeredaCertificacion">
                    </select>
                    <div class='form-group' id='containertxtOtraVereda' style='display: none;'>
                        <label id='lblCualOtraVereda' for='txtOtraVereda'>Cual?</label>
                        <input type='text' class='form-control' id='txtOtraVereda' name='txtOtraVereda'>
                    </div>
                </div>
                <div class='form-group' >
                    <label id="labeltxtPredioCertificacion" for='txtPredioCertificacion'>Predio</label>
                    <select class='form-control' id="txtPredioCertificacion" name="txtPredioCertificacion">
                    </select>
                    <div class='form-group' id="containertxtOtroPredio" style='display: none;'>
                        <label id='lblCualOtroPredio' for='txtOtroPredio'>Cual?</label>
                        <input type='text' class='form-control' id='txtOtroPredio' name='txtOtroPredio'>
                    </div>
                    <button id="addVereda" class="btn btn-primary">Agregar Predio</button>
                </div>
                <div id="contentPredios">

                </div>
                </br>
                <div class='form-group'>
                    <label id='labelFechaSuministrada' for='txtFechaSuministrada'>Fecha Suministrada</label>
                    <br/>
                    <div id='containerFechaSuministrada' class="btn-group" data-toggle="buttons">
                        <label class="btn btn-primary active">
                            <input type="radio" name="txtFechaSuministrada" value="1"> Si
                        </label>
                        <label class="btn btn-primary">
                            <input type="radio" name="txtFechaSuministrada" value="0"> No
                        </label>
                    </div>
                </div>
                <div class='form-group' id='containerTxtFechaInicio' style='display: none;'>
                    <label id='labeltxtFechaInicio' for='txtFechaInicio'>Fecha de Inicio</label>
                    <input type='date' class='form-control' id='txtFechaInicio' name='txtFechaInicio'>
                </div>
                <div id='containerTxtFechaFin' class='form-group' style='display: none;'>
                    <label id='labeltxtFechafin' for='txtFechaFin' id="containerTxtFechaFin">Fecha de Fin</label>
                    <input type='date' class='form-control' id='txtFechaFin' name='txtFechaFin'>
                </div>
                <div id='containerTxtCargo' class='form-group' style='display: none;'>
                    <br/>
                    <label id='labeltxtCargo' for='txtCargo'>Cargo</label>
                    <input type='text' class='form-control' id='txtCargo' name='txtCargo'>
                </div>
            </div>
            <!-- End Principal Fields -->

            <!-- Start Optional fields -->
            <div class='right'>
                <div class='form-group' id='containerTxtTipoPersonaJuridica' style='display: none;'>
                    <label for='txtTipoPersonaJuridica'>Tipo Persona Juridica</label>
                    <select id='txtTipoPersonaJuridica' name='txtTipoPersonaJuridica' class='form-control'>
                        <option value=''>Seleccione...</option>
                        <option value='1'>1. Persona Natural</option>
                        <option value='2'>2. JAC</option>
                        <option value='3'>3. Unidad de Justicia</option>
                        <option value='4'>4. Asociación</option>
                        <option value='5'>5. Alcaldía</option>
                        <option value='6'>6. Personería</option>
                        <option value='7'>7. Empresa Privada</option>
                        <option value='8'>8. Otra Entidad Pública</option>
                    </select>
                </div>
                <div class='form-group' id='containerTxtNombreEmpresa' style='display: none;'>
                    <label for='txtNombreEmpresa'>Nombre Empresa</label>
                    <input type='text' class='form-control' id='txtNombreEmpresa' name='txtNombreEmpresa'>
                </div>
                <div class='form-group' id='containerTxtNITEmpresa' style='display: none;'>
                    <label for='txtNITEmpresa'>NIT Empresa</label>
                    <input type='text' maxlength="10" class='form-control' id='txtNITEmpresa' name='txtNITEmpresa'>
                </div>
                <div class='form-group' id='containerTxtNombrePersonaJuridica' style='display: none;'>
                    <label id="labeltxtNombrePersonaJuridica" for='txtNombrePersonaJuridica'>Nombre Persona</label>
                    <input type='text' class='form-control' id='txtNombrePersonaJuridica' name='txtNombrePersonaJuridica'>
                </div>
                <div class='form-group' id='containerTxtNITPersonaJuridica' style='display: none;'>
                    <label for='txtNITPersonaJuridica'>NIT Persona Juridica</label>
                    <input type='text' maxlength="11" class='form-control' id='txtNITPersonaJuridica' name='txtNITPersonaJuridica'>
                </div>
                <div class='form-group' id='containerTxtDocumentoIdentificacion' style='display: none;'>
                    <label id="labeltxtDocumentoIdentificacion" for='txtDocumentoIdentificacion'>Documento Identificación</label>
                    <input type='text' maxlength="10" class='form-control' id='txtDocumentoIdentificacion' name='txtDocumentoIdentificacion'>
                </div>

                <div class='form-group' id='containerTxtNombrePersonaFirma' style='display: none;'>
                    <label for="txtNombrePersonaFirma">Nombre de la persona que firma</label>
                    <input type="text" class='form-control' id='txtNombrePersonaFirma' name='txtNombrePersonaFirma'>
                </div>
                <div class='form-group' id='containerTxtCargoPersonaFirma' style='display: none;'>
                    <label for="txtCargoPersonaFirma">Cargo de la persona que firma</label>
                    <input type="text" class='form-control' id='txtCargoPersonaFirma' name='txtCargoPersonaFirma'>
                </div>
                <div class='form-group' id='containerTxtDescripcionRelacion' style='display: none;'>
                    <label id="labeltxtDescripcionRelacion" for='txtDescripcionRelacion'>Descripción Relación</label>
                    <textarea class='form-control' id='txtDescripcionRelacion' name='txtDescripcionRelacion'></textarea>
                </div>
                <div class='form-group' id='containerTxtValoresCertificados' style='display: none;'>
                    <label for='txtValoresCertificados'>Valores Certificados</label>
                    <br/>
                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-primary active">
                            <input type="radio" name="txtValoresCertificados" value="1"> Si
                        </label>
                        <label class="btn btn-primary">
                            <input type="radio" name="txtValoresCertificados" value="0"> No
                        </label>
                    </div>
                </div>
                <div class='form-group' id='containerTxtUnidades' style='display: none;'>
                    <label for='txtUnidades'>Unidades</label>
                    <input type='text' class='form-control' id='txtUnidades' name='txtUnidades'>
                </div>
                <div class='form-group' id='containerTxtCantidad' style='display: none;'>
                    <label for='txtCantidad'>Cantidad</label>
                    <input type='text' class='form-control' id='txtCantidad' name='txtCantidad'>
                </div>
                <div class='form-group' id='containerTxtDescripcionUnidades' name='containerTxtDescripcionUnidades' style='display: none;'>
                    <label for='txtDescripcionUnidades'>Descripción Unidades</label>
                    <select class='form-control' id='txtDescripcionUnidades' name='txtDescripcionUnidades'>
                        <option value=''>Seleccione...</option>
                        <option value='Oro'>Oro</option>
                        <option value='Pescado'>Pescado</option>
                        <option value='Madera'>Madera</option>
                        <option value='Arena'>Arena</option>
                        <option value='Gravilla'>Gravilla</option>
                        <option value='Otro'>Otro</option>
                    </select>
                    <div class='form-group' id='containerTxtOtraDescripcionUnidades' style='display: none;'>
                        <label for='txtOtraDescripcionUnidades'>Cual?</label>
                        <input type='text' class='form-control' id='txtOtraDescripcionUnidades' name='txtOtraDescripcionUnidades'>
                    </div>
                </div>
                <div class='form-group' id="containerTxtDireccionCertificacion" style='display: none;'>
                    <label for='txtDireccionCertificacion'>Dirección Certificación</label>
                    <input type='text' class='form-control' id='txtDireccionCertificacion' name='txtDireccionCertificacion'>
                </div>
                <div class='form-group' id="containerNFechas" style='display: none;'>
                    <label for='txtDireccionCertificacion'>Registro de fechas adicionales</label>
                    <br/>
                    <button id='addDates' class="btn btn-primary" >Agregar Fechas</button>
                    <div id="contentFechas">

                    </div>
                </div>
                <div class='form-group' id='containerTxtZona' style='display: none;'>
                    <label for='txtZona'>Zona</label>
                    <select class='form-control' id='txtZona' name='txtZona'>
                        <option value=''>
                            Seleccione...
                        </option>
                        <option value='1'>
                            Urbana
                        </option>
                        <option value='2'>
                            Rural
                        </option>
                        <option value='3'>
                            No figura en la certificación
                        </option>
                    </select>
                </div>
                <div class='form-group' id='containerTxtBarrio' style='display: none;'>
                    <label for='txtBarrio'>Barrio</label>
                    <input type='text' class='form-control' id='txtBarrio' name='txtBarrio'>
                </div>
                <div class='form-group' id='containerChkObservaciones' style='display: none;'>
                    <label id='labeltxtObservaciones' for="chkObservaciones">Observaciones</label>
                    <br/>
                    <div id='containerBtnObservaciones' class="btn-group" data-toggle="buttons">
                        <label class="btn btn-primary active">
                            <input type="radio" name="chkObservaciones" value="1"> Si
                        </label>
                        <label class="btn btn-primary">
                            <input type="radio" name="chkObservaciones" value="0"> No
                        </label>
                    </div>
                </div>
                <div class='form-group' id='containerTxtObservaciones' style='display: none;'>
                    <input type="text" class='form-control' id='txtObservaciones' name='txtObservaciones' style="height: 5em;">
                </div>
            </div>
            <!-- End Optional fields -->
            <legend style='clear: both;'></legend>
            <buttton id='saveInformation' class='btn btn-success btn-md'>Guardar Información</button>
        </div>
        <br/>
        <br/>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Información:</h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-success" style='text-align: center;' role="alert">
                    <img src='public/img/ajax-loader.gif' alt='loading...'/>
                    Cargando por favor espere...
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>