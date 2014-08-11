/*
 * Autor: Juan Camilo Martinez Morales
 * Fecha: 05/08/2014
 * 
 */
$(document).ready(function() {

    $("#saveInformation").click(function() {
        if (validateRequiredFields(idsBlock)) {
            $.ajax({
                url: "index.php/certifications/do_saveForm",
                type: "POST",
                data: {csrf_test_name: get_csrf_hash, "formCode": formCode, "code": code, "dataForm": JSON.stringify($('#controls input, select, textarea').serializeArray())},
                success: function(result) {
                    if (result == "ok") {
                        alert("La información se almaceno correctamente");
                        window.location = 'index.php/certifications/admin?formCode=' + formCode;
                    } else {
                        //Habilitar para mostrar error de PHP
                        //alert(result);
                    }
                },
                error: function() {
                    alert("Opps! Ocurrio un error inesperado, por favor contacte al administrador del sistema.");
                }
            });
        }
    });

    $("#txtIdentificador").html(formCode);

    $("input[name='txtFechaSuministrada']").change(function() {
        if ($("input[name='txtFechaSuministrada']:checked").val() == "1") {
            enabledDates("block");
        } else if ($("input[name='txtFechaSuministrada']:checked").val() == "0") {
            enabledDates("none");
        }
    });

    $("input[name='txtValoresCertificados']").change(function() {
        if ($("input[name='txtValoresCertificados']:checked").val() == "1") {
            enabledUnits("block");
        } else if ($("input[name='txtValoresCertificados']:checked").val() == "0") {
            enabledUnits("none");
        }
    });
    
    $("#txtNITEmpresa, #txtNITPersonaJuridica, #txtDocumentoIdentificacion" ).change(function(){
        $(".alertLabel").remove();
        if(isNaN($(this).val())){
            $(this).parent().append('<span class="alertLabel label label-warning">El valor ingresado no es un número valido</span>');
            $(this).val("");
        }
    });
    
    $("#txtTipoCertificacion").change(function() {
        if ($(this).val() == "1") {
            enabledUnits("none");
            enabledCertificationLocal("none");
            enabledCertificationCommercial("none");
            enabledCertificationMix("none");
            enabledCertificationLabor("block");
        } else if ($(this).val() == "2") {
            enabledCertificationLocal("none");
            enabledCertificationLabor("none");
            enabledCertificationMix("none");
            enabledCertificationCommercial("block");
        } else if ($(this).val() == "3") {
            enabledCertificationLabor("none");
            enabledCertificationCommercial("none");
            enabledUnits("none");
            enabledCertificationMix("none");
            enabledCertificationLocal("block");
        } else if ($(this).val() == "4") {
            enabledCertificationLabor("none");
            enabledCertificationCommercial("none");
            enabledUnits("none");
            enabledCertificationLocal("none");
            enabledCertificationMix("block");

        }
        
        if ($(this).val() == "") {
            enabledCertificationLabor("none");
            enabledCertificationLocal("none");
            enabledCertificationCommercial("none");
            enabledUnits("none");
        }
    });

    $("#txtDescripcionUnidades").change(function() {
        if ($(this).val() == "Otro") {
            $("#containerTxtOtraDescripcionUnidades").css("display", "block");
        } else {
            $("#containerTxtOtraDescripcionUnidades").css("display", "none");
        }
    });

    $("#txtFechaInicio, #txtFechaFin").change(function() {
        if (new Date($("#txtFechaInicio").val()) > new Date($("#txtFechaFin").val())) {
            alert("La fecha de inicio no puede ser mayor a la fecha de fin");
            $(this).val("");
        }
    });

    getLocations();

    $("#txtMunicipioExpedicion").change(function() {

        if ($("#txtMunicipioExpedicion :selected").text() == "Otro") {
            $("#containertxtOtroMunicipio").css("display", "block");
        } else {
            $("#containertxtOtroMunicipio").css("display", "none");
        }

        $.getJSON("index.php/api/get_cities/" + $("#txtMunicipioExpedicion :selected").attr("code"), function(objRData) {
            $("#txtVeredaCertificacion").html("");
            for (var i = 0; i < objRData.length; i++) {
                var objLOption = document.createElement("option");

                $(objLOption).val(objRData[i].a10Codigo).html(objRData[i].a10Nombre)
                        .appendTo("#txtVeredaCertificacion");
            }
            $("#txtVeredaCertificacion").trigger("change");
        });
    });

    $("#txtVeredaCertificacion").change(function() {

        if ($("#txtVeredaCertificacion :selected").text() == "Otro") {
            $("#containertxtOtraVereda").css("display", "block");
        } else {
            $("#containertxtOtraVereda").css("display", "none");
        }

        $.getJSON("index.php/api/get_locations/" + $("#txtVeredaCertificacion :selected").val(), function(objRData) {
            $("#txtPredioCertificacion").html("");
            for (var i = 0; i < objRData.length; i++) {
                var objLOption = document.createElement("option");

                $(objLOption).val(objRData[i].a15Codigo).html(objRData[i].a15Predio)
                        .appendTo("#txtPredioCertificacion");
            }
            
            $("#txtPredioCertificacion").trigger("change");
            
            if (code != "0") {
                $("#txtPredioCertificacion").val(CertObj.a14PredioCertificacion); 
                $("#txtPredioCertificacion").trigger("change");
            }
        });
    });

    $("#txtPredioCertificacion").change(function() {
        if ($("#txtPredioCertificacion :selected").text() == "Otro") {
            $("#containertxtOtroPredio").css("display", "block");
        } else {
            $("#containertxtOtroPredio").css("display", "none");
        }
    });
   
    setTimeout("loadControlValues();", 500);
    setTimeout("reloadSelect();", 1000);
});

var CertObj;

function reloadSelect(){
    $("#txtMunicipioExpedicion").val(CertObj.a14MunicipioExpedicion);
    $("#txtVeredaCertificacion").val(CertObj.a14VeredaCertificacion);
    setTimeout('$("#txtPredioCertificacion").val(CertObj.a14PredioCertificacion); $("#txtPredioCertificacion").trigger("change")', 300);
}

function loadControlValues(){
    if (code != "0") {
        $.getJSON("index.php/certifications/get_DataCertificationByCode/" + code, function(JSONresult) {
            CertObj = JSONresult[0];
            for (var item in JSONresult[0]) {
                var nameControlDOM = item.replace("a14", "txt");
                if (nameControlDOM == "txtFechaSuministrada" || nameControlDOM == "txtValoresCertificados" || nameControlDOM == "txtPersonaNoFigura") {
                    for (var i = 0; i < document.getElementsByName(nameControlDOM).length; i++) {
                        if ($($(document.getElementsByName(nameControlDOM))[i]).val() == JSONresult[0][item]) {
                            $($(document.getElementsByName(nameControlDOM))[i]).trigger("click");
                        }
                    }
                } else {
                    $(document.getElementsByName(nameControlDOM)).val($.trim(JSONresult[0][item]));
                    $(document.getElementsByName(nameControlDOM)).trigger("change");
                }
            }
        });
        
    }
}

var idsBlock;

/*
 * 
 */
function enabledCertificationLabor(isEnabled) {
    idsBlock = "#containerTxtTipoPersonaJuridica, #containerTxtNombrePersonaJuridica, #containerTxtNITPersonaJuridica, #containerTxtDocumentoIdentificacion";
    $(idsBlock).css("display", isEnabled);
    $("#labeltxtNombrePersonaJuridica").html("Nombre de Persona juridica que certifica");
    $("#labeltxtMunicipioExpedicion").html("Municipio de expedición");
    $("#labeltxtDocumentoIdentificacion").html("Documento de identificación de quien firma la certificación");
    $("#labeltxtMunicipioExpedicion").html("Municipio que cubre la certificación");
    $("#labeltxtVeredaCertificacion").html("Vereda que cubre la certificación");
    $("#labeltxtPredioCertificacion").html("Predio que cubre la certificación");
    $("#labeltxtCargo").html("Cargo certificado");
    
}
/*
 * 
 */
function enabledCertificationCommercial(isEnabled) {
    idsBlock = "#containerTxtNombreEmpresa, #containerTxtNITEmpresa, #containerTxtNombrePersonaJuridica, #containerTxtDocumentoIdentificacion, \n\
                        #containerTxtDescripcionRelacion, #containerTxtDescripcionRelacion, #containerTxtValoresCertificados, #containerTxtDescripcionUnidades";
    $(idsBlock).css("display", isEnabled);
    $("#labeltxtNombrePersonaJuridica").html("Nombre persona que firma la certificación");
    $("#labeltxtMunicipioExpedicion").html("Municipio de expedición");
    $("#labeltxtDocumentoIdentificacion").html("Documento de identificación de quien firma la certificación");
    $("#labeltxtMunicipioExpedicion").html("Municipio que cubre la certificación");
    $("#labeltxtVeredaCertificacion").html("Vereda que cubre la certificación");
    $("#labeltxtPredioCertificacion").html("Predio que cubre la certificación");
    $("#labeltxtCargo").html("Cargo de la persona que certifica");
}
/*
 * 
 */
function enabledCertificationLocal(isEnabled) {
    idsBlock = "#containerTxtTipoPersonaJuridica, #containerTxtNombrePersonaJuridica, #containerTxtNITPersonaJuridica, #containerTxtDocumentoIdentificacion, #containerTxtZona, #containerTxtBarrio, #containerTxtDireccionCertificacion";
    $(idsBlock).css("display", isEnabled);
    $("#labeltxtNombrePersonaJuridica").html("Nombre persona jurídica que certifica");
    $("#labeltxtMunicipioExpedicion").html("Municipio de expedición");
    $("#labeltxtDocumentoIdentificacion").html("Documento de identificación de quien firma la certificación");
    $("#labeltxtMunicipioExpedicion").html("Municipio que cubre la certificación");
    $("#labeltxtVeredaCertificacion").html("Vereda que cubre la certificación");
    $("#labeltxtPredioCertificacion").html("Predio que cubre la certificación");
    $("#labeltxtCargo").html("Cargo de la persona que certifica");
}

/*
 * 
 */
function enabledCertificationMix(isEnabled) {
    idsBlock = "#containerTxtTipoPersonaJuridica, #containerTxtNombrePersonaJuridica, #containerTxtNITPersonaJuridica, #containerTxtDocumentoIdentificacion, #containerTxtZona, #containerTxtBarrio, #containerTxtDireccionCertificacion";
    $(idsBlock).css("display", isEnabled);
    $("#labeltxtNombrePersonaJuridica").html("Nombre persona jurídica que certifica");
    $("#labeltxtMunicipioExpedicion").html("Municipio de expedición");
    $("#labeltxtDocumentoIdentificacion").html("Documento de identificación de quien firma la certificación");
    $("#labeltxtMunicipioExpedicion").html("Municipio de expedición");
    $("#labeltxtVeredaCertificacion").html("Vereda que cubre la certificación");
    $("#labeltxtPredioCertificacion").html("Predio que cubre la certificación");
    $("#labeltxtCargo").html("Cargo certificado");
}

/*
 * 
 */
function enabledDates(isEnabled) {
    $("#containerTxtFechaInicio, #containerTxtFechaFin").css("display", isEnabled);
}

/*
 * 
 */
function enabledUnits(isEnabled) {
    $("#containerTxtUnidades, #containerTxtCantidad").css("display", isEnabled);
}
/*
 * 
 *
 */
function validateRequiredFields() {

    var errors = 0;
    $(".alertLabel").remove();

    $(".left, .right").find("input[type='text'], input[type='date'], select, textarea").each(function() {
        $(this).css("border", "");
        if ($.trim($(this).val()) == "") {
            if ($(this).parent().css("display") != "none") {
                if ($("#txtTipoCertificacion").val() == "2" && $(this).attr("id") != "txtNombreEmpresa" && $(this).attr("id") != "txtNITEmpresa" && $(this).attr("id") != "txtCargo" && $(this).attr("id") != "txtDocumentoIdentificacion" || $("#txtTipoCertificacion").val() != "2") {
                    console.log($(this).attr("id"));
                    $(this).css("border", "2px solid #CC0202");
                    $(this).parent().append('<span class="alertLabel label label-danger">Campo requerido</span>');
                    errors++;
                }
            }
        } else {
            $(this).css("border", "2px solid #56AB2E");
        }
    });

    var namePosition = "";
    $(".left, .right").find("input[type='radio']").each(function() {
        if ($(this).attr("name") != namePosition) {
            namePosition = $(this).attr("name");
        }

        if ($(this).parent().parent().parent().css("display") != "none") {
            if (!$("input[name='" + namePosition + "']").is(":checked")) {
                $(this).css("border", "2px solid #CC0202");
                $(this).parent().append('<span class="alertLabel label label-danger">Campo requerido</span>');
                errors++;
            }
        } else {
            $(this).css("border", "2px solid #56AB2E");
        }
    });

    
    if (errors > 0) {
        return false;
    } else {
        return true;
    }
}

/*
 * 
 */
function getLocations() {
    $.getJSON("index.php/api/get_towns/13", function(objRData) {
        for (var i = 0; i < objRData.length; i++) {
            if (objRData[i].a06Estado == "A") {
                var objLOption = document.createElement("option");

                $(objLOption).val(objRData[i].a06DANE).html(objRData[i].a06Nombre).attr("code", objRData[i].a06Codigo)
                        .appendTo("#txtMunicipioExpedicion");
            }
        }
        for (var i = 0; i < objRData.length; i++) {
            if (objRData[i].a06Estado == "I") {
                var objLOption = document.createElement("option");

                $(objLOption).val(objRData[i].a06DANE).html(objRData[i].a06Nombre).attr("code", objRData[i].a06Codigo)
                        .appendTo("#txtMunicipioExpedicion");
            }
        }

        $("#txtMunicipioExpedicion").trigger("change");
    });
}