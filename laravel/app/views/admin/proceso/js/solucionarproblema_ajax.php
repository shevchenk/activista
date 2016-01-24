<script type="text/javascript">
var persona_id, cargos_selec=[], ProblemaObj;
var Problemas={
    Crear:function(evento,datos){
        $.ajax({
            url         : 'solucionar_problema/create',
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
                    evento();
                    $('#problemaModal .modal-footer [data-dismiss="modal"]').click();
                    Psi.mensaje('success', obj.msj, 6000);
                }
                else{
                    $.each(obj.msj,function(index,datos){
                        $("#error_"+index).attr("data-original-title",datos);
                        $('#error_'+index).css('display','');
                    });
                }
            },
            error: function(){
                $(".overlay,.loading-img").remove();
                Psi.mensaje('danger', 'Ocurrio una interrupción en el proceso,Favor de intentar nuevamente.', 6000);
            }
        });
    },
    Cargar:function(){
        $.ajax({
            url         : 'solucionar_problema/cargar',
            type        : 'POST',
            cache       : false,
            dataType    : 'json',
            beforeSend : function() {
                $("body").append('<div class="overlay"></div><div class="loading-img"></div>');
            },
            success : function(obj) {
                if(obj.rst==1){
                    HTMLCargar(obj.datos);
                    ProblemaObj=obj.datos;
                }
                $(".overlay,.loading-img").remove();
            },
            error: function(){
                $(".overlay,.loading-img").remove();
                Psi.mensaje('danger', 'Ocurrio una interrupción en el proceso,Favor de intentar nuevamente.', 6000);
            }
        });
    },
    Filtro:function(evento,datos){
        $.ajax({
            url         : 'solucionar_problema/cargarfiltro',
            type        : 'POST',
            cache       : false,
            dataType    : 'json',
            data        : datos,
            beforeSend : function() {
                $("body").append('<div class="overlay"></div><div class="loading-img"></div>');
            },
            success : function(obj) {
                if(obj.rst==1){
                    evento(obj.datos);
                    ProblemaObj=obj.datos;
                }
                $(".overlay,.loading-img").remove();
            },
            error: function(){
                $(".overlay,.loading-img").remove();
                Psi.mensaje('danger', 'Ocurrio una interrupción en el proceso,Favor de intentar nuevamente.', 6000);
            }
        });
    },
    CargarDetalle:function(datos){
        $.ajax({
            url         : 'solucionar_problema/cargardetalle',
            type        : 'POST',
            cache       : false,
            dataType    : 'json',
            data        : datos,
            beforeSend : function() {
                $("body").append('<div class="overlay"></div><div class="loading-img"></div>');
            },
            success : function(obj) {
                if(obj.rst==1){
                    HTMLCargarDetalle(obj.datos);
                }
                $(".overlay,.loading-img").remove();
            },
            error: function(){
                $(".overlay,.loading-img").remove();
                Psi.mensaje('danger', 'Ocurrio una interrupción en el proceso,Favor de intentar nuevamente.', 6000);
            }
        });
    }
};
</script>
