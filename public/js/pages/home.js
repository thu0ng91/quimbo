// JavaScript Document
// Created by: Alvaro Arturo Montenegro Silva
// Email: arthvrian@yahoo.com
// Date: 2014-04-23
$(document).ready(function() {
    $("#FormLogin").validate({
        rules : {
            TxtUsername: {
                required: true,
                minlength: 3
            },
            TxtPassword: {
                required: true,
                minlength: 3
            }
        },
        submitHandler: function(form) {
            $(form).ajaxSubmit(options);
            return false;
        }
    });
});