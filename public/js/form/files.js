$(document).ready(function () {

loadControlValues();
$("#txtIdentificador").html(getParameterByName("formCode"));

function loadControlValues(){
    var code = getParameterByName("formCode");
    var tabla = "";
    $(".modal").modal('show');
    $.getJSON("index.php/form/get_FilesN/" + code, function(objRData){
        arrayNDocuments = objRData;

        if (arrayNDocuments.length >= 0){
            tabla += "<table border='1' cellpadding='1' cellspacing='1' style='width: 65%;'><thead><tr><th scope='col'>Tipo de Documento</th><th scope='col'>Detalle</th></tr></thead><tbody>";

            for (var i = arrayNDocuments.length - 1; i >= 0; i--) {
                var ruta = arrayNDocuments[i].a18RutaArchivo.replace("amazon_root", "https://s3.amazonaws.com");
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