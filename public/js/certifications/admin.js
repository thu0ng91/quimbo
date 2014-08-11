$(document).ready(function() {
    $.getJSON("index.php/certifications/get_DataCertificationByForm/" + formCode, function(JSONresult) {
        for (var item in JSONresult) {
            var baseHtmlTbody = "<tr><td>{1}</td><td>{2}</td><td>{3}</td><td><a style='margin-right: 1em;' class='btn btn-warning' href='index.php/certifications/form?formCode=" + formCode + "&code={4}'>Editar</a><button class='btn btn-danger' onclick='eliminarDetalleCertificacion({4});' >Eliminar</button></td></tr>";
            switch (JSONresult[item].a14TipoCertificacion) {
                case "1":
                    JSONresult[item].a14TipoCertificacion = "Laboral";
                    break;
                case "2":
                    JSONresult[item].a14TipoCertificacion = "Comercial";
                    break;
                case "3":
                    JSONresult[item].a14TipoCertificacion = "Vecindad";
                    break;
                case "3":
                    JSONresult[item].a14TipoCertificacion = "Mixta";
                    break;
            }

            baseHtmlTbody = baseHtmlTbody.replace("{1}", JSONresult[item].a14TipoCertificacion);
            baseHtmlTbody = baseHtmlTbody.replace("{2}", JSONresult[item].a14FechaCreacion);
            baseHtmlTbody = baseHtmlTbody.replace("{3}", JSONresult[item].a14FechaUltimaActualizacion == undefined ? JSONresult[item].a14FechaCreacion : JSONresult[item].a14FechaUltimaActualizacion);
            baseHtmlTbody = baseHtmlTbody.replace("{4}", JSONresult[item].a14Codigo);
            baseHtmlTbody = baseHtmlTbody.replace("{4}", JSONresult[item].a14Codigo);
            $("#contentCertifications").append(baseHtmlTbody);
        }
    });
});

function eliminarDetalleCertificacion(code) {
    if (confirm("¿Esta seguro que desea eliminar la certificación seleccionada?")) {
        $.getJSON("index.php/certifications/do_deleteCertification/" + code, function(JSONresult) {
            window.location.reload();
        });
    }
}