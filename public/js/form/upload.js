// JavaScript Document
// Created by: Alvaro Arturo Montenegro Silva
// Email: arthvrian@yahoo.com
// Date: 2014-04-23
$(document).ready(function() {
    $("#FormDocs").validate({
        submitHandler: function(form) {
            $(form).ajaxSubmit(options);
            return false;
        }
    });
});