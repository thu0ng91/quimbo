/*
 * Autor: Juan Camilo Martinez Morales
 * Fecha: 05/08/2014
 * 
 */
$(document).ready(function() {

    var stat = "";

    if (getParameterByName("code") != ""){
        stat = "edit";
    } else {
        stat = "new";
    }

    $("#saveInformation").click(function() {
        if (validateRequiredFields(idsBlock)) {
            generateArrayFechasN();
            generateArrayVeredasN();
            $.ajax({
                url: "index.php/certifications/do_saveForm",
                type: "POST",
                data: {csrf_test_name: get_csrf_hash, "formCode": formCode, "code": code, "fechasN": JSON.stringify(arrayNFechas), "veredasN": JSON.stringify(arrayNVeredas), "dataForm": JSON.stringify($('#controls input, select, textarea').serializeArray())},
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

    $("input[name='txtPersonaNoFigura']").change(function() {
        varControles = ["#txtMunicipioExpedicion", "#txtVeredaCertificacion", "#txtPredioCertificacion", "#txtFechaExpedicion", "#txtOtroPredio", "#addVereda", "#txtCargo", "#txtFechaSuministrada", "#labelFechaExpedicion", "#labeltxtMunicipioExpedicion", "#labeltxtVeredaCertificacion", "#labeltxtPredioCertificacion", "#labelFechaSuministrada", "#labeltxtCargo", "#txtOtroMunicipio", "#txtOtraVereda", "#txtOtroPredio", "#lblCualOtroMunicipio", "#lblCualOtraVereda", "#lblCualOtroPredio", "#txtFechaInicio", "#txtFechaFin", "#labeltxtFechaInicio", "#labeltxtFechafin", "#containerFechaSuministrada"];

        if ($("input[name='txtPersonaNoFigura']:checked").val() == "1") {
            //Persona si figura
            for (var item = 0; item < varControles.length; item++) {
                //Recorre el array de controles
                $(varControles[item]).css("display","block");
                $("#txtMunicipioExpedicion").val("");
                $("#txtVeredaCertificacion").val("");
                $("#txtPredioCertificacion").val("");
            }

        } else if ($("input[name='txtPersonaNoFigura']:checked").val() == "0") {
            //Persona no figura
            for (var item = 0; item < varControles.length; item++) {
                //Recorre el array de controles
                $(varControles[item]).css("display","none");
            }
        }
    });

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

    $("#txtNITEmpresa, #txtNITPersonaJuridica, #txtDocumentoIdentificacion").change(function() {
        $(".alertLabel").remove();
        if (isNaN($(this).val())) {
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
            $("#txtOtroPredio").val("");
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

        });
    });

    $("#txtPredioCertificacion").change(function() {
        if ($("#txtPredioCertificacion :selected").text() == "Otro") {
            $("#containertxtOtroPredio").css("display", "block");
        } else {
            $("#txtOtroPredio").val("");
            $("#containertxtOtroPredio").css("display", "none");
        }
    });

    setTimeout("loadControlValues();", 500);
    setTimeout("reloadSelect();", 1000);

    $("#addDates").click(function() {
        var itemDates = "<br/><legend></legend><label>Fecha Inicio</label><input id='FechaInicio" + countFechasN + "' class='form-control' type='date' value='' /><br/><label>Fecha Fin</label><input id='FechaFin" + countFechasN + "'  class='form-control' type='date' value='' /><br/><legend></legend>";
        $("#contentFechas").append(itemDates);
        $("#FechaInicio" + countFechasN + ", #FechaFin" + countFechasN).change(function() {
            if (new Date($("#FechaInicio" + countFechasN).val()) > new Date($("#FechaFin" + countFechasN).val())) {
                alert("La fecha de inicio no puede ser mayor a la fecha de fin");
                $(this).val("");
            }
        });
        countFechasN++;
    });

    $("#addVereda").click(function(){
        var PredioCert = "";
        var PrpVal = "";
        var VeredaCert = "";
        var VdaVal = "";
        var TwnsVal = "";

        //Predio validation - Option: Other
        if($("#txtPredioCertificacion option:selected").text() == "Otro"){
            PredioCert = "(" + $("#txtOtroPredio").val() + ")";
            PrpVal = "-1";
        } else {
            PredioCert = $("#txtPredioCertificacion option:selected").text();
            PrpVal = $("#txtPredioCertificacion").val();
        }

        //Vereda validation - Option: Other
        if($("#txtVeredaCertificacion option:selected").text() == "Otro"){
            VeredaCert = "(" + $("#txtOtraVereda").val() + ")";
            VdaVal = "-1";
        } else {
            VeredaCert = $("#txtVeredaCertificacion option:selected").text();
            VdaVal = $("#txtVeredaCertificacion").val();
        }

        TwnsVal = $("#txtMunicipioExpedicion").val();

        var itemVered = "</br><div id='divPredio" + countPrediosN + "'><legend></legend><label>Predio</label><input id='NPredio" + countPrediosN + "' class='form-control' type='text' OthTwn='" + $("#txtOtroMunicipio").val() + "' OthSdw='" + $("#txtOtraVereda").val() + "' OthPro='" + $("#txtOtroPredio").val() + "' TwnsVal='" + TwnsVal + "' PropVal='" + PrpVal + "' VdaVal='" + VdaVal + "' value='" + VeredaCert + " - " + PredioCert + "' readonly /> <p id='rmvPredio" + countPrediosN + "' onclick='rmvPredio(" + countPrediosN + ")''>Remover</p> </div>";
        $("#contentPredios").append(itemVered);
        countPrediosN++;
    });

    /* Functions available trough the form stats */
    if (stat == "new"){
        /*New*/
    }else{
        /*Edit*/
        varControles = ["#txtMunicipioExpedicion", "#txtVeredaCertificacion", "#txtPredioCertificacion", "#txtFechaExpedicion", "#txtOtroPredio", "#addVereda", "#txtCargo", "#txtFechaSuministrada", "#labelFechaExpedicion", "#labeltxtMunicipioExpedicion", "#labeltxtVeredaCertificacion", "#labeltxtPredioCertificacion", "#labelFechaSuministrada", "#labeltxtCargo", "#txtOtroMunicipio", "#txtOtraVereda", "#txtOtroPredio", "#lblCualOtroMunicipio", "#lblCualOtraVereda", "#lblCualOtroPredio", "#txtFechaInicio", "#txtFechaFin", "#labeltxtFechaInicio", "#labeltxtFechafin", "#containerFechaSuministrada"];

        if ($("input[name='txtPersonaNoFigura']:checked").val() == "1") {
            //Persona si figura
            for (var item = 0; item < varControles.length; item++) {
                //Recorre el array de controles
                $(varControles[item]).css("display","block");
                $("#txtMunicipioExpedicion").val("");
                $("#txtVeredaCertificacion").val("");
                $("#txtPredioCertificacion").val("");
            }

        } else if ($("input[name='txtPersonaNoFigura']:checked").val() == "0") {
            //Persona no figura
            for (var item = 0; item < varControles.length; item++) {
                //Recorre el array de controles
                $(varControles[item]).css("display","none");
            }
        }

        $("#txtTipoCertificacion").trigger("change");

    }

});

/* Function to remove items in the Predios list */
function rmvPredio(elemento){
    var control = "#divPredio" + elemento;
    var indice = elemento +1;
    $(control).remove();
    arrayNVeredas = arrayNVeredas.slice(indice);
}

var CertObj;
var countPrediosN = 0;
var countFechasN = 0;
;

/*
 * Function reloadSelect
 * Set properties of Municipio, Vereda and one timer later 500 miliseconds for Predio
 */
function reloadSelect() {
    if (code != "0") {
        $("#txtMunicipioExpedicion").val(CertObj.a14MunicipioExpedicion);
        $("#txtMunicipioExpedicion").trigger("change");
        setTimeout('$("#txtVeredaCertificacion").val(CertObj.a14VeredaCertificacion); $("#txtVeredaCertificacion").trigger("change");', 500);
        setTimeout('$("#txtPredioCertificacion").val(CertObj.a14PredioCertificacion); $("#txtPredioCertificacion").trigger("change"); $(".modal").modal("hide");', 1000);
    }
}

/*
 * Function loadControlValues
 * Load information from database to form in update case
 */
function loadControlValues() {
    if (code != "0") {
        $(".modal").modal('show');
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

        $.getJSON("index.php/certifications/get_FechasN/" + code, function(objRData) {
            arrayNFechas = objRData;
            generateNFechas();
        });

        $.getJSON("index.php/certifications/get_VeredasN/" + code, function(objRData){
            arrayNVeredas = objRData;
            generateNVeredas();
        }); 

    }
}

var idsBlock;
/*
 * Function enabledCertificationLabor
 * Enabled controls for certification type = 1
 */
function enabledCertificationLabor(isEnabled) {
    idsBlock = "#containerTxtTipoPersonaJuridica, #containerTxtNombrePersonaJuridica, #containerTxtNITPersonaJuridica, #containerTxtDocumentoIdentificacion, #containerNFechas, #containerTxtNombrePersonaFirma, #containerTxtCargoPersonaFirma, #containerTxtObservaciones";
    $(idsBlock).css("display", isEnabled);
    $("#labeltxtNombrePersonaJuridica").html("Nombre de la persona jurídica que certifica");
    $("#labeltxtMunicipioExpedicion").html("Municipio de expedición");
    $("#labeltxtDocumentoIdentificacion").html("Documento de identificación de quien firma la certificación");
    $("#labeltxtMunicipioExpedicion").html("Municipio donde desempeñó labor");
    $("#labeltxtVeredaCertificacion").html("Vereda donde desempeñó labor");
    $("#labeltxtPredioCertificacion").html("Predio que cubre la certificación");
    $("#labeltxtCargo").html("Cargo certificado");

}
/*
 * Function enabledCertificationCommercial
 * Enabled controls for certification type = 2
 */
function enabledCertificationCommercial(isEnabled) {
    idsBlock = "#containerTxtNombreEmpresa, #containerTxtNITEmpresa, #containerTxtNombrePersonaJuridica, #containerTxtDocumentoIdentificacion, \n\
                        #containerTxtDescripcionRelacion, #containerTxtValoresCertificados, #containerTxtObservaciones";
    $(idsBlock).css("display", isEnabled);
    $("#labeltxtNombrePersonaJuridica").html("Nombre persona que firma la certificación");
    $("#labeltxtMunicipioExpedicion").html("Municipio de expedición");
    $("#labeltxtDocumentoIdentificacion").html("Documento de identificación de quien firma la certificación");
    $("#labeltxtMunicipioExpedicion").html("Municipio donde sostenía la relación comercial");
    $("#labeltxtVeredaCertificacion").html("Vereda donde sostenía la relación comercial");
    $("#labeltxtPredioCertificacion").html("Predio donde sostenia la relación comercial");
    $("#labeltxtDescripcionRelacion").html("Descripción breve y clara de la relación certificada");
    $("#containerTxtCargoPersonaFirma").css("display","block");

    //Hide some controls
    varControles = ["#txtObservaciones", "#labeltxtObservaciones", "#containerTxtValoresCertificados", "#txtDescripcionRelacion", "#labeltxtDescripcionRelacion"];

    if ($("input[name='txtPersonaNoFigura']:checked").val() == "1") {
        //Persona si figura
        for (var item = 0; item < varControles.length; item++) {
            //Recorre el array de controles
            $(varControles[item]).css("display","block");
        }

    } else if ($("input[name='txtPersonaNoFigura']:checked").val() == "0") {
        //Persona no figura
        for (var item = 0; item < varControles.length; item++) {
            //Recorre el array de controles
            $(varControles[item]).css("display","none");
        }
    }

}
/*
 * Function enabledCertificationLocal
 * Enabled controls for certification type = 3
 */
function enabledCertificationLocal(isEnabled) {
    idsBlock = "#containerTxtTipoPersonaJuridica, #containerTxtNombrePersonaJuridica, #containerTxtNITPersonaJuridica, #containerTxtDocumentoIdentificacion, #containerTxtZona, #containerTxtBarrio, #containerTxtDireccionCertificacion, #containerTxtNombrePersonaFirma, #containerTxtCargoPersonaFirma, #containerTxtObservaciones";
    $(idsBlock).css("display", isEnabled);
    $("#labeltxtNombrePersonaJuridica").html("Nombre persona jurídica que certifica");
    $("#labeltxtMunicipioExpedicion").html("Municipio de expedición");
    $("#labeltxtDocumentoIdentificacion").html("Documento de identificación de quien firma la certificación");
    $("#labeltxtMunicipioExpedicion").html("Municipio que cubre la certificación");
    $("#labeltxtVeredaCertificacion").html("Vereda que cubre la certificación");
    $("#labeltxtPredioCertificacion").html("Predio que cubre la certificación");
    $("#containerTxtCargoPersonaFirma").css("display","block");

    //Hide some controls
    varControles = ["#containerTxtBarrio", "#containerTxtZona", "#containerTxtDireccionCertificacion", "#containerTxtTipoPersonaJuridica"];

    if ($("input[name='txtPersonaNoFigura']:checked").val() == "1") {
        //Persona si figura
        for (var item = 0; item < varControles.length; item++) {
            //Recorre el array de controles
            $(varControles[item]).css("display","block");
        }

    } else if ($("input[name='txtPersonaNoFigura']:checked").val() == "0") {
        //Persona no figura
        for (var item = 0; item < varControles.length; item++) {
            //Recorre el array de controles
            $(varControles[item]).css("display","none");
        }
    }

}

/*
 * Function enabledCertificationMix
 * Enabled controls for certification type = 4
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
 * Function enabledDates
 * Show controls with Ids = #containerTxtFechaInicio, #containerTxtFechaFin
 */
function enabledDates(isEnabled) {
    $("#containerTxtFechaInicio, #containerTxtFechaFin").css("display", isEnabled);
}

/*
 * Function enabledUnits
 * Show controls with Ids = #containerTxtUnidades, #containerTxtCantidad
 */
function enabledUnits(isEnabled) {
    $("#containerTxtUnidades, #containerTxtCantidad, #containerTxtDescripcionUnidades").css("display", isEnabled);
}
/*
 * Function validateRequiredFields
 * Execute validation for controls that require
 */
function validateRequiredFields() {

    var errors = 0;
    $(".alertLabel").remove();

    if ($("input[name='txtPersonaNoFigura']:checked").val() == "0") {
        //$(".left > ").css("display","none");
        $("#containerTxtNombrePersonaJuridica, #containerTxtDocumentoIdentificacion").find("input[type='text'], input[type='date'], select, textarea").each(function() {
            $(this).css("border", "");
            if ($.trim($(this).val()) == "") {
                if ($(this).parent().css("display") != "none") {
                    $(this).css("border", "2px solid #CC0202");
                    $(this).parent().append('<span class="alertLabel label label-danger">Campo requerido</span>');
                    errors++;
                }
            } else {
                $(this).css("border", "2px solid #56AB2E");
            }
        });
    } else {
        $(".left, .right").find("input[type='text'], input[type='date'], select, textarea").each(function() {
            $(this).css("border", "");
            if ($.trim($(this).val()) == "") {
                if ($(this).parent().css("display") != "none") {
                    if ($("#txtTipoCertificacion").val() == "2" && $(this).attr("id") != "txtNombreEmpresa" && $(this).attr("id") != "txtNITEmpresa" && $(this).attr("id") != "txtCargo" && $(this).attr("id") != "txtDocumentoIdentificacion" || $("#txtTipoCertificacion").val() != "2") {
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
    }




    if (errors > 0) {
        return false;
    } else {
        return true;
    }
}

/*
 * Function getLocations
 * Get Locations from id municipio
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

//-Extraer parametros QueryString-//
function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

var arrayNFechas = [];
var arrayNVeredas = [];
/*
 * Function generateNFechas
 * Generate controls from arrayNFechas in update case
 */
function generateNFechas() {
    for (var item in arrayNFechas) {
        var itemDates = "<br/><legend></legend><label>Fecha Inicio</label><input id='FechaInicio" + countFechasN + "' class='form-control' type='date' value='" + arrayNFechas[item].FechaInicio + "' /><br/><label>Fecha Fin</label><input id='FechaFin" + countFechasN + "'  class='form-control' type='date' value='" + arrayNFechas[item].FechaFin + "' /><br/><legend></legend>";
        $("#contentFechas").append(itemDates);

        idInicio = "#FechaInicio" + countFechasN;
        idFin = "#FechaFin" + countFechasN;

        $(idInicio + ", " + idFin).change(function() {
            var itemDate = $(this).attr("id").replace("FechaInicio", "").replace("FechaFin", "");

            idInicio = "#FechaInicio" + itemDate;
            idFin = "#FechaFin" + itemDate;

            if (new Date($(idInicio).val()) > new Date($(idFin).val())) {
                alert("La fecha de inicio no puede ser mayor a la fecha de fin");
                $(this).val("");
            }
        });

        countFechasN++;
    }
}

/*
 * Function generateArrayFechasN
 * Load data into arrayNFechas
 */
function generateArrayFechasN() {
    arrayNFechas = [];
    for (var i = 0; i < countFechasN; i++) {
        arrayNFechas.push({"FechaInicio": $("#FechaInicio" + i).val(), "FechaFin": $("#FechaFin" + i).val()});
    }
}

/* Generate controls from arrayNVeredas in update case */
function generateNVeredas(){
    for (var item in arrayNVeredas) {
        
        var LPredio = "";
        var LVereda = "";

        if (arrayNVeredas[item].Predio != "-1"){
            LPredio = arrayNVeredas[item].NPredio;
        } else {
            LPredio = "(" + arrayNVeredas[item].OtroPredio + ")";
        }

        if (arrayNVeredas[item].Vereda != "-1"){
            LVereda = arrayNVeredas[item].NVereda;
        } else {
            LVereda = "(" + arrayNVeredas[item].OtraVda + ")";
        }

        var itemVered = "<br/><div id='divPredio" + countPrediosN + "'><legend></legend><label>Predio</label><input id='Npredio" + countPrediosN + "' class='form-control' type='text' OthTwn='" + arrayNVeredas[item].OtroMun + "' OthSdw='" + arrayNVeredas[item].OtraVda + "' OthPro='" + arrayNVeredas[item].OtroPredio + "' TwnsVal='" + arrayNVeredas[item].Municipio + "' PropVal='" + arrayNVeredas[item].Predio + "' VdaVal='" + arrayNVeredas[item].Vereda + "' value='" + LVereda + " - " + LPredio + "' readonly /> <p id='rmvPredio" + countPrediosN + "' onclick='rmvPredio(" + countPrediosN + ")'>Remover</p> </div>";
        $("#contentPredios").append(itemVered);
    }
}

/* Load data into arrayNVeredas */
function generateArrayVeredasN(){
    arrayNVeredas=[];
    for (var i = 0; i < countPrediosN; i++){
        //Check for undefined array items to skip
        if ($("#NPredio" + i).attr("TwnsVal") != undefined){
            arrayNVeredas.push({"Municipio": $("#NPredio" + i).attr("TwnsVal"), "Vereda": $("#NPredio" + i).attr("VdaVal"), "Predio": $("#NPredio" + i).attr("PropVal"), "OtroMun": $("#NPredio" + i).attr("othtwn"), "OtraVda": $("#NPredio" + i).attr("othsdw"), "OtroPredio": $("#NPredio" + i).attr("othpro")});
        }        
    }
}