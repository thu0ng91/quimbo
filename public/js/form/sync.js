// JavaScript Document
// Created by: Alvaro Arturo Montenegro Silva
// Email: arthvrian@yahoo.com
// Date: 2014-04-23
$(document).ready(function() {
    $.getJSON("index.php/api/sync", function(arrRData, textStatus, jqXHR) {
        if (!arrRData) {
            $(".alert-danger").show();
        }
        else {
            $(".alert-success").show();
            $(".alert-success").find("ul li:first span").html(arrRData.forms);
            $(".alert-success").find("ul li:eq(1) span").html(arrRData.answers);
            $(".alert-success").find("ul li:eq(2) span").html(arrRData["answers-n"]);
            $(".alert-success").find("ul li:eq(3) span").html(arrRData.users);
            $(".alert-success").find("ul li:last span").html(arrRData.ftp);
        }
    });
});
