/*
 * Autor: Juan Camilo Martinez Morales
 * Fecha: 05/08/2014
 * 
 */
$(document).ready(function() {

    $("#saveInformation").click(function() {
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

    $("#txtTipoCertificacion").change(function() {
        if ($(this).val() == "1") {
            enabledUnits("none");
            enabledCertificationLocal("none");
            enabledCertificationCommercial("none");
            enabledCertificationLabor("block");
        } else if ($(this).val() == "2") {
            enabledCertificationLocal("none");
            enabledCertificationLabor("none");
            enabledCertificationCommercial("block");
        } else if ($(this).val() == "3") {
            enabledCertificationLabor("none");
            enabledCertificationCommercial("none");
            enabledUnits("none");
            enabledCertificationLocal("block");

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
            $("#containerTxtOtraDescripcionUnidades").css("display", "block");
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
        $.getJSON("index.php/api/get_cities/" + $("#txtMunicipioExpedicion :selected").attr("code"), function(objRData) {
            $("#txtVeredaCertificacion").html("");
            for (var i = 0; i < objRData.length; i++) {
                var objLOption = document.createElement("option");

                $(objLOption).val(objRData[i].a10Codigo).html(objRData[i].a10Nombre)
                        .appendTo("#txtVeredaCertificacion");
            }
        });
    });

    if (code != "0") {
        $.getJSON("index.php/certifications/get_DataCertificationByCode/" + code, function(JSONresult) {
            for (var item in JSONresult[0]) {
                var nameControlDOM = item.replace("a14", "txt");
                if (nameControlDOM == "txtFechaSuministrada" || nameControlDOM == "txtValoresCertificados") {
                    for (var i = 0; i < document.getElementsByName(nameControlDOM).length; i++) {
                        if ($($(document.getElementsByName(nameControlDOM))[i]).val() == JSONresult[0][item]) {
                            $($(document.getElementsByName(nameControlDOM))[i]).trigger("click");
                        }
                    }
                } else {
                    $(document.getElementsByName(nameControlDOM)).val(JSONresult[0][item]);
                    $(document.getElementsByName(nameControlDOM)).trigger("change");
                }
            }
        });
    }

});

/*
 * 
 */
function enabledCertificationLabor(isEnabled) {
    var idsBlock = "#containerTxtTipoPersonaJuridica, #containerTxtNombrePersonaJuridica, #containerTxtNITPersonaJuridica, #containerTxtDocumentoIdentificacion";
    $(idsBlock).css("display", isEnabled);
}
/*
 * 
 */
function enabledCertificationCommercial(isEnabled) {
    var idsBlock = "#containerTxtNombreEmpresa, #containerTxtNITEmpresa, #containerTxtNombrePersonaJuridica, #containerTxtDocumentoIdentificacion, \n\
                        #containerTxtDescripcionRelacion, #containerTxtDescripcionRelacion, #containerTxtValoresCertificados, #containerTxtDescripcionUnidades";
    $(idsBlock).css("display", isEnabled);
}
/*
 * 
 */
function enabledCertificationLocal(isEnabled) {
    var idsBlock = "#containerTxtTipoPersonaJuridica, #containerTxtNombrePersonaJuridica, #containerTxtNITPersonaJuridica, #containerTxtDocumentoIdentificacion, #containerTxtZona, #containerTxtBarrio, #containerTxtDireccionCertificacion";
    $(idsBlock).css("display", isEnabled);
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