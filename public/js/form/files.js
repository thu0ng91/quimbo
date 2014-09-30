$(document).ready(function () {

loadControlValues();

loadTutelas();

$("#txtIdentificador").html(getParameterByName("formCode"));
$("#txtCedula").html(getParameterByName("docId"));

/*Validar formulario*/
if (formCode == 'undefined'){
  $("#formulario").css("display","none");
  $("#results").css("display","none");
  $("#docuIdentifica").css("display","block");
}

function loadTutelas(){
    var cedula = getParameterByName("docId");
    var tabtutelas = "";
    $(".modal").modal('show');
    $.getJSON("index.php/form/get_Tutelas/" + cedula, function(objRData){
        arrayTutelas = objRData;

        if (arrayTutelas.length >= 1){
            tabtutelas += "<table border='1' cellpadding='1' cellspacing='1' style='width: 65%'><thead><tr><th scope='col'>Número de proceso</th><th scope='col'>Tema</th><th scope='col'>Detalle</th></tr></thead><tbody>";

            for (var t = arrayTutelas.length -1; t >=0; t--){
                var ruta = arrayTutelas[t].path.replace("Q:emgesaTutelas", "https://s3.amazonaws.com/emgesa/Tutelas/");
                tabtutelas += "<tr><td>" + arrayTutelas[t].numero_proceso + "</td><td>" + arrayTutelas[t].temas + "</td><td>" + "<a href='" + ruta + "' target='_blank' class='btn btn-success'>Ver Detalle</a>" + "</td></tr>";
            }

        }
        else
        {
            $("#tutelas").css("display","none");
        }

        tabtutelas += "</tbody></table><br/>";
        $("#tableTutelasResults").html(tabtutelas);

    });
}

function loadControlValues(){
    var code = getParameterByName("formCode");
    var tabla = "";
    $(".modal").modal('show');
    $.getJSON("index.php/form/get_FilesN/" + code, function(objRData){
        arrayNDocuments = objRData;

        if (arrayNDocuments.length >= 1){
            tabla += "<table border='1' cellpadding='1' cellspacing='1' style='width: 65%;'><thead><tr><th scope='col'>Tipo de Documento</th><th scope='col'>Detalle</th></tr></thead><tbody>";

            for (var i = arrayNDocuments.length - 1; i >= 0; i--) {
                var ruta = arrayNDocuments[i].a18RutaArchivo.replace("amazon_root/emgesa/00REPOSITORIO", "https://s3.amazonaws.com/emgesa/00REPOSITORIO13092014");
                var tipo = "";

                switch(arrayNDocuments[i].a18TipoArchivo) {
                case "01Formato":
                    tipo = "Formato de inscripción y Habeas Data";
                    break;

                case "02Cedula":
                    tipo = "Cédula de ciudadanía";
                    break;

                case "03Poder":
                    tipo = "Poder";
                    break;

                case "04CL":
                    tipo = "Certificación Laboral";
                    break;

                case "05AutoEntidades":
                    tipo = "Auto Entidades";
                    break;

                case "06Terceros":
                    tipo = "Terceros";
                    break;

                case "07CertComercial":
                    tipo = "Certificación Comercial";
                    break;

                case "08Factura":
                    tipo = "Factura";
                    break;

                case "09CertVecindad":
                    tipo = "Certificación de Vecindad";
                    break;
                case "10DerPeticion":
                    tipo = "Derecho de petición";
                    break;

                case "11RadicadosEmgesa":
                    tipo = "Radicados Emgesa";
                    break;

                case "12Otros":
                    tipo = "Otros Documentos";
                    break;

                case "Formato No VÃ¡lido":
                    tipo = "Formato No Válido";
                    break;
                    
                case "Video":
                    tipo = "Video";
                    break;
                }

                tabla += "<tr><td>" + tipo + "</td><td>" + "<a href='" + ruta + "' target='_blank' class='btn btn-success'>Ver Detalle</a>" + "</td></tr>";
            }

            tabla += "</tbody></table><br/>";
            $("#tableResults").html(tabla);
        }

    $(".modal").modal('hide');
    });
}

//-Extraer parametros QueryString-//
function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

});