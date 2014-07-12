// JavaScript Document
// Created by: Alvaro Arturo Montenegro Silva
// Email: arthvrian@yahoo.com
// Date: 2014-04-23
$(document).ready(function() {
    $(".modal .btn-primary").click(function() {
        var objLBody = $(this).closest(".modal").find(".modal-body table tbody");
        var objLNewRow = $(objLBody).find("tr:first").clone();

        $(objLNewRow).appendTo(objLBody).find("select, input").val("");
        $(objLNewRow).show().find(".btn-danger").click(function() {
            $(this).closest("tr").remove();
        });
    });
    $(".modal .btn-danger").click(function() {
        $(this).closest("tr").hide();
    });
    // Capitulo A
    $("#TxtFormAP014O02, #TxtFormAP015, #TxtFormAP018O02, #TxtFormAP019O02").closest(".form-group").hide();
    $("#TxtFormAP019O01").closest(".panel").hide();
    $("label[for=TxtFormAP05] span.text-danger, label[for=TxtFormAP07] span.text-danger").hide();

    $("#TxtFormAP03O01").change(function() {
        var objLOptionF = $("#TxtFormAP03O01 option:eq(0)").clone();

        $("#TxtFormAP03O02 option").remove();
        $("#TxtFormAP03O02").append(objLOptionF);

        $.getJSON("index.php/api/get_towns/" + $(this).val(), function(objRData) {
            for (var i = 0; i < objRData.length; i++) {
                var objLOption = document.createElement("option");

                $(objLOption).val(objRData[i].a06Codigo).html(objRData[i].a06Nombre)
                .appendTo("#TxtFormAP03O02");
            }
        });
    });
    $("#TxtFormAP09O01").change(function() {
        $("#TxtFormAP09O02").closest(".form-group").show();
        $("#TxtFormAP09O03").closest(".form-group").show();

        if (this.selectedIndex != 52) {
            $("#TxtFormAP09O02").val("").closest(".form-group").hide();
            $("#TxtFormAP09O03").val("").closest(".form-group").hide();
        }
    });
    $("#TxtFormAP09O02").change(function() {
        var objLOptionF = $("#TxtFormAP09O02 option:eq(0)").clone();

        $("#TxtFormAP09O03 option").remove();
        $("#TxtFormAP09O03").append(objLOptionF);

        $.getJSON("index.php/api/get_towns/" + $(this).val(), function(objRData) {
            for (var i = 0; i < objRData.length; i++) {
                var objLOption = document.createElement("option");

                $(objLOption).val(objRData[i].a06Codigo).html(objRData[i].a06Nombre)
                    .appendTo("#TxtFormAP09O03");
            }
        });
    });
    $("#TxtFormAP014O01").change(function() {
        $("#TxtFormAP014O02").closest(".form-group").hide();
        $("#TxtFormAP015").closest(".form-group").hide();

        if (this.selectedIndex == 6) {
            $("#TxtFormAP014O02").closest(".form-group").show();
        }
        else {
            $("#TxtFormAP014O02").val("");
        }
        if (this.selectedIndex == 2 || this.selectedIndex == 3) {
            $("#TxtFormAP015").closest(".form-group").show();
        }
        else {
            $("#TxtFormAP015").val("");
        }
    });
    $("#TxtFormAP018O01").change(function() {
        $("#TxtFormAP018O02").closest(".form-group").hide();
        $("#TxtFormAP019O01").closest(".panel").show();

        if (this.selectedIndex == 1) {
            $("#TxtFormAP018O02").closest(".form-group").show();
        }
        else {
            $("#TxtFormAP018O02").val("");
        }
        if (this.selectedIndex == 2) {
            $("#TxtFormAP019O01").closest(".panel").hide();
            $("#TxtFormAP019O01").val("");
            $("#TxtFormAP019O02").val("");
        }
    });
    $("#TxtFormAP019O01").change(function() {
        if ($("#TxtSearch").val() == "N") {
            $("button[type=submit] span:first").html("Continuar");
            $("#TxtAction").val("C");
        }

        $("#TxtFormAP019O02").closest(".form-group").hide();

        if (this.selectedIndex == 1) {
            $("#TxtFormAP019O02").closest(".form-group").show();
        }
        else {
            $("#TxtFormAP019O02").val("");
        }
    });

    // Capitulo B
    $("#TxtFormBP04O02, #TxtFormBP07O02").closest(".form-group").hide();
    $("#TxtFormBP07O01, input[name^=TxtFormBP08O01]").closest(".panel").hide();
    $("label[for=TxtFormBP02] span.text-danger, label[for=TxtFormBP08O03] span.text-danger").hide();
    $("[id^=TxtFormBP08]").each(function() {
        $(this).attr("name", $(this).attr("name") + "[]");
    });

    $("#TxtFormBP01O01").change(function() {
        var objLOptionF = $("#TxtFormBP01O01 option:eq(0)").clone();

        $("#TxtFormBP01O02 option").remove();
        $("#TxtFormBP01O02").append(objLOptionF);

        $.getJSON("index.php/api/get_towns/" + $(this).val(), function(objRData) {
            for (var i = 0; i < objRData.length; i++) {
                var objLOption = document.createElement("option");

                $(objLOption).val(objRData[i].a06Codigo).html(objRData[i].a06Nombre)
                .appendTo("#TxtFormBP01O02");
            }
        });
    });
    $("#TxtFormBP08O02").change(function() {
        var objLOptionF = $("#TxtFormBP08O02 option:eq(0)").clone();

        $("#TxtFormBP08O04 option").remove();
        $("#TxtFormBP08O04").append(objLOptionF);

        $.getJSON("index.php/api/get_cities/" + $(this).val(), function(objRData) {
            for (var i = 0; i < objRData.length; i++) {
                var objLOption = document.createElement("option");

                $(objLOption).val(objRData[i].a10Codigo).html(objRData[i].a10Nombre)
                    .appendTo("#TxtFormBP08O04");
            }
        });
    });
    $("#TxtFormBP04O01").change(function() {
        $("#TxtFormBP04O02").closest(".form-group").hide();

        if (this.selectedIndex == 6) {
            $("#TxtFormBP04O02").closest(".form-group").show();
        }
        else {
            $("#TxtFormBP04O02").val("");
        }
    });
    $("#TxtFormBP06").change(function() {
        $("#TxtFormBP07O01").closest(".panel").hide();
        $("input[name^=TxtFormBP08O01]").closest(".panel").hide();

        if (this.selectedIndex == 1) {
            $("#TxtFormBP07O01").closest(".panel").show();
        }
        else {
             $("#TxtFormBP07O01").val("");
        }
    });
    $("#TxtFormBP07O01").change(function() {
        $("#TxtFormBP07O02").closest(".form-group").hide();
        $("[name^=TxtFormBP08O01]").closest(".panel").hide();
        $("[name^=TxtFormBP08]").closest(".form-group").hide();

        if (this.selectedIndex > 0) {
            $("input[name^=TxtFormBP08O01]").closest(".panel").show();
        }
        if (this.selectedIndex == 2 || this.selectedIndex == 3) {
            $("[name^=TxtFormBP08O01]").closest(".form-group").show();
            $("[name^=TxtFormBP08O02], [name^=TxtFormBP08O03], [name^=TxtFormBP08O04], [name^=TxtFormBP08O05], [name^=TxtFormBP08O06], [name^=TxtFormBP08O07]").val("");
        }
        if (this.selectedIndex == 1 || this.selectedIndex == 6
                || this.selectedIndex == 8 || this.selectedIndex == 9) { // naranja
            $("[name^=TxtFormBP08O01]").val("");
            $("[name^=TxtFormBP08O02], [name^=TxtFormBP08O03], [name^=TxtFormBP08O04], [name^=TxtFormBP08O05], [name^=TxtFormBP08O06], [name^=TxtFormBP08O07]").closest(".form-group").show();
            $("[name^=TxtFormBP08O02], [name^=TxtFormBP08O03], [name^=TxtFormBP08O04], [name^=TxtFormBP08O05], [name^=TxtFormBP08O06], [name^=TxtFormBP08O07]").attr("required", true).rules("add", {
                required: true
            });
        }
        if (this.selectedIndex == 4 || this.selectedIndex == 5
                 || this.selectedIndex == 7 || this.selectedIndex == 10) { // azul
            $("[name^=TxtFormBP08O01]").val("");
            $("[name^=TxtFormBP08O02], [name^=TxtFormBP08O03], [name^=TxtFormBP08O04], [name^=TxtFormBP08O05], [name^=TxtFormBP08O06], [name^=TxtFormBP08O07]").closest(".form-group").show();
            $("[name^=TxtFormBP08O03], [name^=TxtFormBP08O04], [name^=TxtFormBP08O05], [name^=TxtFormBP08O06], [name^=TxtFormBP08O07]").removeAttr("required").rules("remove");
        }
        if(this.selectedIndex == 10) {
            $("#TxtFormBP07O02").closest(".form-group").show();
        }
        else {
            $("#TxtFormBP07O02").val("");
        }
    });

    // Capitulo C
    $("#TxtFormCP04O02, #TxtFormCP07O02, #TxtFormCP09O03, #TxtFormCP09O04, #TxtFormCP09O05, input[name*=TxtFormCP09O02]").closest(".form-group").hide();
    $("#TxtFormCP010O02, #TxtFormCP011, #TxtFormCP012O02, #TxtFormCP014, #TxtFormCP015O02").closest(".form-group").hide();
    $("#TxtFormCP018O02, #TxtFormCP018O03, #TxtFormCP018O04, #TxtFormCP018O05").closest(".form-group").hide();
    $("#TxtFormCP07O01, #TxtFormCP08O01, #TxtFormCP09O01, #TxtFormCP014").closest(".panel").hide();
    $("label[for=TxtFormCP02] span.text-danger").hide();
    $("[id^=TxtFormCP08]").each(function() {
        $(this).attr("name", $(this).attr("name") + "[]");
    });
    $("[id^=TxtFormCP018]").each(function() {
        $(this).attr("name", $(this).attr("name") + "[]");
    });
    $("[id^=TxtFormCP019]").each(function() {
        $(this).attr("name", $(this).attr("name") + "[]");
    });

    $("#TxtFormCP01O01").change(function() {
        var objLOptionF = $("#TxtFormCP01O01 option:eq(0)").clone();

        $("#TxtFormCP01O02 option").remove();
        $("#TxtFormCP01O02").append(objLOptionF);

        $.getJSON("index.php/api/get_towns/" + $(this).val(), function(objRData) {
            for (var i = 0; i < objRData.length; i++) {
                var objLOption = document.createElement("option");

                $(objLOption).val(objRData[i].a06Codigo).html(objRData[i].a06Nombre)
                .appendTo("#TxtFormCP01O02");
            }
        });
    });
    $("#TxtFormCP08O02").change(function() {
        var objLOptionF = $("#TxtFormCP08O02 option:eq(0)").clone();

        $("#TxtFormCP08O04 option").remove();
        $("#TxtFormCP08O04").append(objLOptionF);

        $.getJSON("index.php/api/get_cities/" + $(this).val(), function(objRData) {
            for (var i = 0; i < objRData.length; i++) {
                var objLOption = document.createElement("option");

                $(objLOption).val(objRData[i].a10Codigo).html(objRData[i].a10Nombre)
                    .appendTo("#TxtFormCP08O04");
            }
        });
    });

    $("#TxtFormCP04O01").change(function() {
        $("#TxtFormCP04O02").closest(".form-group").hide();

        if (this.selectedIndex == 6) {
            $("#TxtFormCP04O02").closest(".form-group").show();
        }
        else {
            $("#TxtFormCP04O02").val("");
        }
    });
    $("#TxtFormCP06").change(function() {
        $("#TxtFormCP07O01").closest(".panel").hide();
        $("#TxtFormCP08O01").closest(".panel").hide();
        $("#TxtFormCP09O01").closest(".panel").hide();

        if (this.selectedIndex == 1) {
            $("#TxtFormCP07O01").closest(".panel").show();
            $("#TxtFormCP09O01").closest(".panel").show();
        }
        else {
            $("#TxtFormCP07O01").val("");
            $("#TxtFormCP09O01").val("");
            $("#TxtFormCP09O03, #TxtFormCP09O04, #TxtFormCP09O05, input[name*=TxtFormCP09O02]").closest(".form-group").hide();
            $("input[name*=TxtFormCP09]").attr("checked", false);
            $("input[name*=TxtFormCP09]").val("");
       }
    });
    $("#TxtFormCP07O01").change(function() {
        $("#TxtFormCP07O02").closest(".form-group").hide();
        $("#TxtFormCP08O01").closest(".panel").hide();
        $("[name^=TxtFormCP08]").closest(".form-group").hide();

        if (this.selectedIndex > 0) {
            $("input[name^=TxtFormCP08O01]").closest(".panel").show();
        }
        if (this.selectedIndex == 2 || this.selectedIndex == 3) {
            $("[name^=TxtFormCP08O01]").closest(".form-group").show();
            $("[name^=TxtFormCP08O02], [name^=TxtFormCP08O03], [name^=TxtFormCP08O04], [name^=TxtFormCP08O05], [name^=TxtFormCP08O06]").val("");
        }
        if (this.selectedIndex == 1 || this.selectedIndex == 6
                || this.selectedIndex == 8 || this.selectedIndex == 9) { // naranja
            $("[name^=TxtFormCP08O01]").val("");
            $("[name^=TxtFormCP08O02], [name^=TxtFormCP08O03], [name^=TxtFormCP08O04], [name^=TxtFormCP08O05], [name^=TxtFormCP08O06]").closest(".form-group").show();
            $("[name^=TxtFormCP08O02], [name^=TxtFormCP08O03], [name^=TxtFormCP08O04], [name^=TxtFormCP08O05], [name^=TxtFormCP08O06]").attr("required", true).rules("add", {
                required: true
            });
        }
        if (this.selectedIndex == 4 || this.selectedIndex == 5
                 || this.selectedIndex == 7 || this.selectedIndex == 10) { // azul
            $("[name^=TxtFormCP08O01]").val("");
            $("[name^=TxtFormCP08O02], [name^=TxtFormCP08O03], [name^=TxtFormCP08O04], [name^=TxtFormCP08O05], [name^=TxtFormCP08O06]").closest(".form-group").show();
            $("[name^=TxtFormCP08O03], [name^=TxtFormCP08O04], [name^=TxtFormCP08O05], [name^=TxtFormCP08O06]").removeAttr("required").rules("remove");
        }
        if(this.selectedIndex == 10) {
            $("#TxtFormCP07O02").closest(".form-group").show();
        }
        else {
            $("#TxtFormCP07O02").val("");
        }
    });
    $("#TxtFormCP09O01").change(function() {
        $("input[name*=TxtFormCP09O02]").closest(".form-group").hide();

        if (this.selectedIndex == 1) {
            $("input[name*=TxtFormCP09O02]").closest(".form-group").show();
        }
        else {
            $("input[name=TxtFormCP09O02]").attr("checked", false);
            $("#TxtFormCP09O03").val("").closest(".form-group").hide();
            $("#TxtFormCP09O04").val("").closest(".form-group").hide();
            $("#TxtFormCP09O05").val("").closest(".form-group").hide();
        }
    });
    $("input[name*=TxtFormCP09O02]").change(function() {
        $("#TxtFormCP09O03").closest(".form-group").hide();
        $("#TxtFormCP09O04").closest(".form-group").hide();
        $("#TxtFormCP09O05").closest(".form-group").hide();

        $("input[name*=TxtFormCP09O02]").each(function(inRIndex) {
            if ($(this).is(":checked") && inRIndex == 0) {
                $("#TxtFormCP09O03").closest(".form-group").show();
            }
            else {
                $("#TxtFormCP09O03").val("");
            }
            if ($(this).is(":checked") && inRIndex == 1) {
                $("#TxtFormCP09O04").closest(".form-group").show();
            }
            else {
                $("#TxtFormCP09O04").val("");
            }
            if ($(this).is(":checked") && inRIndex == 2) {
                $("#TxtFormCP09O05").closest(".form-group").show();
            }
            else {
                $("#TxtFormCP09O05").val("");
            }
        });
    });
    $("#TxtFormCP010O01").change(function() {
        $("#TxtFormCP010O02").closest(".form-group").hide();
        $("#TxtFormCP011").closest(".form-group").show();

        if (this.selectedIndex == 3) {
            $("#TxtFormCP010O02").closest(".form-group").show();
        }
        else {
            $("#TxtFormCP010O02").val("");
        }
        if (this.selectedIndex == 4) {
            $("#TxtFormCP011").closest(".form-group").hide();
            $("#TxtFormCP011").val("");
        }
    });
    $("#TxtFormCP012O01").change(function() {
        $("#TxtFormCP012O02").closest(".form-group").hide();

        if (this.selectedIndex == 1) {
            $("#TxtFormCP012O02").closest(".form-group").show();
        }
        else {
            $("#TxtFormCP012O02").val("");
        }
    });
    $("#TxtFormCP013").change(function() {
        $("#TxtFormCP014").closest(".form-group").show();

        if (this.selectedIndex == 2) {
            $("#TxtFormCP014").closest(".form-group").hide();
            $("#TxtFormCP014").val("");
        }
    });
    $("input[name=TxtFormCP015O01S09]").change(function() {
        $("#TxtFormCP015O02").closest(".form-group").hide();

        if ($(this).is(":checked")) {
            $("#TxtFormCP015O02").closest(".form-group").show();
        }
    });
    $("#TxtFormCP018O01").change(function() {
        $("#TxtFormCP018O02, #TxtFormCP018O03, #TxtFormCP018O04, #TxtFormCP018O05").closest(".form-group").hide();

        if (this.selectedIndex == 1) {
            $("#TxtFormCP018O02, #TxtFormCP018O03, #TxtFormCP018O04, #TxtFormCP018O05").closest(".form-group").show();
        }
        else {
            $("#TxtFormCP018O02, #TxtFormCP018O03, #TxtFormCP018O04, #TxtFormCP018O05").val("");
        }
    });

    $("#FormChapter").validate({
        rules : {
            TxtFormAP05: {
                required: false
            },
            TxtFormAP07: {
                required: false
            },
            TxtFormAP011O01: {
                number: true,
                rangelength: [2, 2],
                range: [1, 31]
            },
            TxtFormAP011O02: {
                number: true,
                rangelength: [2, 2],
                range: [1, 12]
            },
            TxtFormAP011O03: {
                number: true,
                rangelength: [4, 4],
                range:[1900, 2000]
            },
            TxtFormAP016: {
                number: true
            },
            TxtFormBP02: {
                required: false
            },
            TxtFormBP05: {
                number: true
            },
            TxtFormBP08O03: {
                required: false
            },
            TxtFormCP02: {
                required: false
            },
            TxtFormCP05: {
                number: true
            },
            TxtFormCP012O02: {
                number: true
            },
            TxtFormCP019O02: {
                number: true
            },
        },
        submitHandler: function(form) {
            $(form).ajaxSubmit(options);
            return false;
        }
    });
});