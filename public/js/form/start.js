// JavaScript Document
// Created by: Alvaro Arturo Montenegro Silva
// Email: arthvrian@yahoo.com
// Date: 2014-04-23
$(document).ready(function() {
    $("#FormInit").validate({
        rules : {
            TxtFormNo: {
                required: true,
                minlength: 3,
                rangelength: [7, 7]
            },
            TxtFormDate: {
                required: true,
                date: true
            },
            TxtFormPlace: {
                required: true,
                minlength: 3
            },
            TxtFormState: {
                required: true
            },
            TxtFormTown: {
                required: true
            }
        },
        submitHandler: function(form) {
            $(form).ajaxSubmit(options);
            return false;
        }
    });
    $("#TxtFormState").change(function() {
        var objLOptionF = $("#TxtFormState option:eq(0)").clone();

        $("#TxtFormTown option").remove();
        $("#TxtFormTown").append(objLOptionF);

        $.getJSON("index.php/api/get_towns/" + $(this).val() + "/true", function(objRData) {
            for (var i = 0; i < objRData.length; i++) {
                var objLOption = document.createElement("option");

                $(objLOption).val(objRData[i].a06Codigo).html(objRData[i].a06Nombre)
                    .appendTo("#TxtFormTown");
            }
        });
    });
});