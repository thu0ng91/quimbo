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
				tabla += "<tr><td>" + arrayNDocuments[i].a18TipoArchivo + "</td><td>" + "<a href='" + ruta + "' class='btn btn-success'>Ver Detalle</a>" + "</td></tr>";
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