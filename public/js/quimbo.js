// JavaScript Document
// Created by: Alvaro Arturo Montenegro Silva
// Email: arthvrian@yahoo.com
// Date: 2014-04-26
var options = {
    beforeSubmit: showRequest,
    success: showResponse,
    dataType: "json"
};
$(document).ready(function() {
    if (jQuery.validator) {
        jQuery.validator.setDefaults({
            highlight: function(element, errorClass, validClass) {
                $(element).closest(".form-group").addClass("has-error").removeClass(validClass);
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).closest(".form-group").removeClass(errorClass).addClass(validClass);
            },
            errorClass : "has-error label label-danger",
            errorPlacement: function(error, element) {
                error.appendTo(element.closest(".form-group").find("div.pull-right"));
            },
        });
    }
    enableBackToTop();

    $(".form-group:first").find("input[type=text]:first").focus();
    $(".form-group:first").find("select:first").focus();
    $(".form-group:first").find("textarea:first").focus();

    $(".btn-group input, .btn-group-vertical input").change(function() {
        var theStatus = $(this).is(":checked");

        if ($(this).attr("type") == "radio") {
            $(this).closest(".btn-group").find("label")
                .removeClass("btn-success").addClass("btn-default");

            if (theStatus) {
                $(this).closest("label").addClass("btn-success");
            }
        }
        if ($(this).attr("type") == "checkbox") {
            $(this).closest("label").removeClass("btn-success")
                .addClass("btn-default");

            if (theStatus) {
                $(this).closest("label").addClass("btn-success");
            }
        }
    });
    $(".modal").on("show.bs.modal", function (theEvent) {
        var theA = theEvent.relatedTarget;
        var theTitle = $(theA).attr("data-title");
        $(this).find("#myModalLabel").html(theTitle);
    });
}).ajaxSend(function(event, jqXHR, ajaxOptions) {
    if(ajaxOptions.url.indexOf("api") == -1) {
        $("#responseLoader").show();
    }
}).ajaxComplete(function(event, jqXHR, ajaxOptions) {
    $("#responseLoader").hide();
    $("button[type=submit]").button("reset");
}).ajaxError(function(event, jqXHR, ajaxSettings, thrownError) {
    $("#responseContainer").find("h4")
        .html("Error!");
    $("#responseText").html("Ocurrió un Error <strong>'" + thrownError + "'</strong> que impidio " +
        "que se terminara de realizar la acción solicitada, por favor " +
        "intente nuevamente");
    $("#responseContainer").find("div.alert")
        .addClass("alert-danger")
        .removeClass("alert-success");
    $("#responseContainer").show();
});
/**
 * Funcion showRequest
 *
 * Ejecuta procesos antes de enviar el formulario
 *
 * @param formData
 * @param jqForm
 * @param options
 */
function showRequest(formData, jqForm, options) {
    $("#responseContainer").hide();
    $("button[type=submit]").click(function () {
        $(this).button("loading");
    });
}
/**
 * Funcion showResponse
 *
 * Ejecuta procesos despesu de enviar el formulario con los datos
 * obtenidos en la respuesta
 *
 * @param responseText
 * @param statusText
 * @param xhr
 * @param $form
 */
function showResponse(responseText, statusText, xhr, $form) {
    if (statusText == "success") {
        $("#responseContainer").find("h4")
            .html(responseText.TxtTitle);

        if (responseText.TxtErrorForm) {
            $("#responseContainer").find("div.alert")
                .addClass("alert-danger")
                .removeClass("alert-success");
            $("#responseText").html(responseText.TxtError);
        }
        if (responseText.TxtSuccessForm) {
            $($form).resetForm();

            $("#responseContainer").find("div.alert")
                .removeClass("alert-danger")
                .addClass("alert-success");
            $("#responseText").html(responseText.TxtSuccess);
        }

        if (responseText.TxtReload) {
            window.setTimeout(function() {
                location.reload();
            }, 2000);
        }
        if (responseText.TxtRedirect) {
            window.setTimeout(function() {
                var stLChapter = responseText.TxtChapter;
                location.href = "index.php/form/" + stLChapter;
            }, 2000);
        }

        $("button[type=submit]").button("reset");
        $(".btn-group input, .btn-group-vertical input").find("label")
            .removeClass("btn-success").addClass("btn-default");
        $("#responseContainer").show();
    }
}
/**
 * Funcion enableBackToTop
 *
 * Muestra el link para volver arriba
 */
function enableBackToTop() {
    var backToTop = $('<a>', { id: 'back-to-top', href: '#top' });
    var icon = $('<i>', { class: 'glyphicon glyphicon-chevron-up' });

    backToTop.appendTo ('body');
    icon.appendTo(backToTop);

    backToTop.hide();

    $(window).scroll(function () {
        if ($(this).scrollTop() > 150) {
            backToTop.fadeIn ();
        } else {
            backToTop.fadeOut ();
        }
    });

    backToTop.click(function (e) {
        e.preventDefault();

        $('body, html').animate({
            scrollTop: 0
        }, 600);
    });
}