<script type="text/javascript">
var Alumno={
    Cargar:function(evento){
        $.ajax({
            url         : "alumno/index",
            type        : 'GET',
            contentType : false,
            processData : false,
            cache       : false,
            dataType    : "json",
            beforeSend : function() {
                $("body").append('<div class="overlay"></div><div class="loading-img"></div>');
            },
            success: function(obj) {
                $(".overlay,.loading-img").remove();
                evento(obj.datos);
            },
            error: function(obj) {
                $(".overlay,.loading-img").remove();
                Psi.mensaje('danger', 'ocurrio un error en la carga', 6000);
            }
        });
    },
    AgregarEditar:function(AE){
        var datos=$("#form_alumno").serialize().split("txt_").join("").split("slct_").join("");
        var accion="alumno/create";
        if(AE==1){
            accion="alumno/update";
        }

        $.ajax({
            url         : accion,
            type        : 'POST',
            cache       : false,
            dataType    : 'json',
            data        : datos,
            beforeSend : function() {
                $("body").append('<div class="overlay"></div><div class="loading-img"></div>');
            },
            success : function(obj) {
                $(".overlay,.loading-img").remove();
                if(obj.rst==1){
                    Psi.mensaje('success', obj.msj, 6000);
                    Alumno.Cargar(alumnosHTML);
                    $('#alumnoModal .modal-footer [data-dismiss="modal"]').click();
                } else { 
                    $.each(obj.msj,function(index,datos){
                        $("#error_"+index).attr("data-original-title",datos);
                        $('#error_'+index).css('display','');
                    });     
                }
            },
            error: function(){
                $(".overlay,.loading-img").remove();
                Psi.mensaje('danger', 'ocurrio un error al registrar', 6000);
            }
        });
        
    },
};
var Problema={
    Crear:function(form){
        $.ajax({
            url         : "registrar_problema/create",
            type        : 'POST',
            cache       : false,
            dataType    : 'json',
            data        : form,
            beforeSend : function() {
                $("body").append('<div class="overlay"></div><div class="loading-img"></div>');
            },
            success: function(obj) {
                if(obj.rst==1){
                    Psi.mensaje('success', obj.msj, 6000);
                    limpiar();
                } else {
                    $.each(obj.msj,function(index,datos){
                        $("#error_"+index).attr("data-original-title",datos);
                        $('#error_'+index).css('display','');
                    });
                }
                $(".overlay,.loading-img").remove();
            },
            error: function(obj) {
                $(".overlay,.loading-img").remove();
                Psi.mensaje('danger', 'ocurrio un error al registrar', 6000);
                //alert('no se cargo archivo');
            }
        });
    }
};
</script>