<link href="public/css/certifications/form.css" rel="stylesheet" />
<script type='text/javascript'>
    var formCode = '<?php echo $_GET["formCode"]; ?>';
    var code = '<?php if(isset($_GET["code"])){ echo $_GET["code"]; } else { echo "0"; } ?>';
    var get_csrf_token_name =  '<?php echo $this->security->get_csrf_token_name(); ?>';
    var get_csrf_hash = '<?php echo $this->security->get_csrf_hash(); ?>';
</script>
<section class="main-content">
    <div class="container">
        <div id='controls'>
            <br/>
            <legend>Registro de información para detalle de certificaciones laborales, comerciales y de vecindad.</legend>
            <br/>
            <div class='left'>
                <!-- Start Principal Fields -->

                <div class='form-group' >
                    <label for='txtIdentificador'>Identificador de formulario:</label>
                    <br/>
                    <label class='label label-info' id='txtIdentificador'></label>
                </div>
                <div class='form-group'>
                    <label for='txtTipoCertificacion'>Tipo de Certificación</label>
                    <select class='form-control' id='txtTipoCertificacion' name='txtTipoCertificacion'>
                        <option value=''>Seleccione el tipo de certificación...</option>
                        <option value='1'>Laboral</option>
                        <option value='2'>Comercial</option>
                        <option value='3'>Vecindad</option>
                    </select>
                </div>
                <div class='form-group' >
                    <label for='txtFechaExpedicion'>Fecha Expedicion</label>
                    <input type='date' name='txtFechaExpedicion' class='form-control' id='txtFechaExpedicion' name='txtFechaExpedicion'>
                </div>
                <div class='form-group'>
                    <label for='txtMunicipioExpedicion'>Municipio</label>
                    <select class='form-control' id="txtMunicipioExpedicion" name="txtMunicipioExpedicion">
                    </select>
                    <div class='form-group' style='display: none;'>
                        <label for='txtOtroMunicipio'>Cual?</label>
                        <input type='text' class='form-control' id='txtOtroMunicipio' name='txtOtroMunicipio'>
                    </div>
                </div>
                <div class='form-group'>
                    <label for='txtVeredaCertificacion'>Vereda</label>
                    <select class='form-control' id="txtVeredaCertificacion" name="txtVeredaCertificacion">
                    </select>
                    <div class='form-group' style='display: none;'>
                        <label for='txtOtraVereda'>Cual?</label>
                        <input type='text' class='form-control' id='txtOtraVereda' name='txtOtraVereda'>
                    </div>
                </div>
                <div class='form-group' >
                    <label for='txtPredioCertificacion'>Predio</label>
                    <select class='form-control' id="txtPredioCertificacion" name="txtPredioCertificacion">
                        <option value="1">Prueba Predio</option>
                    </select>
                    <div class='form-group' style='display: none;'>
                        <label for='txtOtroPredio'>Cual?</label>
                        <input type='text' class='form-control' id='txtOtroPredio' name='txtOtroPredio'>
                    </div>
                </div>
                <div class='form-group'>
                    <label for='txtFechaSuministrada'>Fecha Suministrada</label>
                    <br/>
                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-primary active">
                            <input type="radio" name="txtFechaSuministrada" value="1"> Si
                        </label>
                        <label class="btn btn-primary">
                            <input type="radio" name="txtFechaSuministrada" value="0"> No
                        </label>
                    </div>
                </div>
                <div class='form-group' id='containerTxtFechaInicio' style='display: none;'>
                    <label for='txtFechaInicio'>Fecha de Inicio</label>
                    <input type='date' class='form-control' id='txtFechaInicio' name='txtFechaInicio'>
                </div>
                <div id='containerTxtFechaFin' class='form-group' style='display: none;'>
                    <label for='txtFechaFin' id="containerTxtFechaFin">Fecha de Fin</label>
                    <input type='date' class='form-control' id='txtFechaFin' name='txtFechaFin'>
                </div>
                <div class='form-group'>
                    <label for='txtCargo'>Cargo</label>
                    <input type='text' class='form-control' id='txtCargo' name='txtCargo'>
                </div>
            </div>
            <!-- End Principal Fields -->

            <!-- Start Optional fields -->
            <div class='right'>
                <div class='form-group' id='containerTxtTipoPersonaJuridica' style='display: none;'>
                    <label for='txtTipoPersonaJuridica'>Tipo Persona Juridica</label>
                    <input type='text' class='form-control' id='txtTipoPersonaJuridica' name='txtTipoPersonaJuridica'>
                </div>
                <div class='form-group' id='containerTxtNombreEmpresa' style='display: none;'>
                    <label for='txtNombreEmpresa'>Nombre Empresa</label>
                    <input type='text' class='form-control' id='txtNombreEmpresa' name='txtNombreEmpresa'>
                </div>
                <div class='form-group' id='containerTxtNITEmpresa' style='display: none;'>
                    <label for='txtNITEmpresa'>NIT Empresa</label>
                    <input type='text' class='form-control' id='txtNITEmpresa' name='txtNITEmpresa'>
                </div>
                <div class='form-group' id='containerTxtNombrePersonaJuridica' style='display: none;'>
                    <label for='txtNombrePersonaJuridica'>Nombre Persona Juridica</label>
                    <input type='text' class='form-control' id='txtNombrePersonaJuridica' name='txtNombrePersonaJuridica'>
                </div>
                <div class='form-group' id='containerTxtNITPersonaJuridica' style='display: none;'>
                    <label for='txtNITPersonaJuridica'>NIT Persona Juridica</label>
                    <input type='text' class='form-control' id='txtNITPersonaJuridica' name='txtNITPersonaJuridica'>
                </div>
                <div class='form-group' id='containerTxtDocumentoIdentificacion' style='display: none;'>
                    <label for='txtDocumentoIdentificacion'>Documento Identificación</label>
                    <input type='text' class='form-control' id='txtDocumentoIdentificacion' name='txtDocumentoIdentificacion'>
                </div>

                <div class='form-group' id='containerTxtDescripcionRelacion' style='display: none;'>
                    <label for='txtDescripcionRelacion'>Descripción Relación</label>
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
                <div class='form-group' id='containerTxtZona' style='display: none;'>
                    <label for='txtZona'>Zona</label>
                    <select class='form-control' id='txtZona' name='txtZona'>
                        <option value='Urbana'>
                            Urbana
                        </option>
                        <option value='Rural'>
                            Rural
                        </option>
                    </select>
                </div>
                <div class='form-group' id='containerTxtBarrio' style='display: none;'>
                    <label for='txtBarrio'>Barrio</label>
                    <input type='text' class='form-control' id='txtBarrio' name='txtBarrio'>
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