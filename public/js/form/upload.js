// JavaScript Document
// Created by: Alvaro Arturo Montenegro Silva
// Email: arthvrian@yahoo.com
// Date: 2014-04-23
$(document).ready(function() {
    
    getFilesFromForm();
    
    $("#FormDocs").validate({
        submitHandler: function(form) {
            $(form).ajaxSubmit(options);
            return false;
        }
    });
});

/*
     * Autor: Juan Camilo Martinez Morales
     * Fecha: 04/08/2014
     * Modificacion: Se agrega procedimiento por ajax 
     * para obtener los documentos cargados para el formulario actual 
     */
    function getFilesFromForm() {
        $.ajax({
            url: "index.php/form/do_getFilesPath/" + $("#TxtFormID").val(),
            type: "GET",
            success: function(json) {
                json = JSON.parse(json);
                
                for(var item in json){
                    var baseAnchor = "<a class='label label-primary' href='public/uploads/1/0' alt='0' target='_blank' >0</a>";
                    
                    baseAnchor = baseAnchor.replace(/0/g, json[item].a13Documento);
                    baseAnchor = baseAnchor.replace(/1/, json[item].a13Identificador);
                    
                    if(json[item].a13Tipo < 10){
                        $($("input[id*='0" + json[item].a13Tipo + "']")[0]).parent().append(baseAnchor);
                    }else{
                        $($("input[id*='" + json[item].a13Tipo + "']")[0]).parent().append(baseAnchor);
                    }
                }
            },
            error: function() {
                //Error Message
            }
        });
    }