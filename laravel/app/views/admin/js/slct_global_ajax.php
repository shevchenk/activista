<script type="text/javascript">
var slctGlobal={
    /**
     * mostrar un mulselect
     * @param:
     * 1 controlador..nombre del controlador   modulo
     * 2 slct         nombre del multiselect   slct_modulos
     * 3 tipo         simple o multiple
     * 4 valarray     valores que se seleccionen
     * 5 data         valores a enviar por ajax
     * 6 afectado     si es afectado o no (1,0)
     * 7 afectados    a quien afecta (slct_submodulos)
     * 8 slct_id      identificador que se esta afectando ('M')
     * 9 slctant
     * 10 slctant_id
     * 11 funciones   evento a ejecutar al hacer hacer changed
     *
     * @return string
     */

    listarSlct:function(controlador,slct,tipo,valarray,data,afectado,afectados,slct_id,slctant,slctant_id, funciones){
        $.ajax({
            url         : controlador+'/listar',
            type        : 'POST',
            cache       : false,
            dataType    : 'json',
            data        : data,
            beforeSend : function() {
                //$("body").append('<div class="overlay"></div><div class="loading-img"></div>');
            },
            success : function(obj) {
                if(obj.rst==1){
                    htmlListarSlct(obj,slct,tipo,valarray,afectado,afectados,slct_id,slctant,slctant_id, funciones);
                    if (funciones!=='' && funciones!==undefined) {
                        if (funciones.success!=='' && funciones.success!==undefined) {
                            funciones.success(obj.datos);
                        }
                    }
                }
            },
            error: function(){
                Psi.mensaje('danger', '<?php echo trans("greetings.mensaje_error"); ?>', 6000);
            }
        });
    },
    listarSlctFuncion:function(controlador,funcion,slct,tipo,valarray,data,afectado,afectados,slct_id,slctant,slctant_id, funciones){
        $.ajax({
            url         : controlador+'/'+funcion,
            type        : 'POST',
            cache       : false,
            dataType    : 'json',
            data        : data,
            beforeSend : function() {
                //$("body").append('<div class="overlay"></div><div class="loading-img"></div>');
            },
            success : function(obj) {
                if(obj.rst==1){
                    htmlListarSlct(obj,slct,tipo,valarray,afectado,afectados,slct_id,slctant,slctant_id, funciones);
                    if (funciones!=='' && funciones!==undefined) {
                        if (funciones.success!=='' && funciones.success!==undefined) {
                            funciones.success(obj.datos);
                        }
                    }
                }
            },
            error: function(){
                Psi.mensaje('danger', '<?php echo trans("greetings.mensaje_error"); ?>', 6000);
            }
        });
    },
    listarSlctFijo:function(controlador,slct,val){
        $.ajax({
            url         : controlador+'/listar',
            type        : 'POST',
            cache       : false,
            dataType    : 'json',
            beforeSend : function() {
                //$("body").append('<div class="overlay"></div><div class="loading-img"></div>');
            },
            success : function(obj) {
                var html="";
                var selected="";
                html += "<option value=''>Seleccione</option>";
                if(obj.rst==1){
                    $.each(obj.datos,function(index,data){
                        selected="";
                        dat="";
                        if(typeof(val)!='undefined' && val==data.id){
                            selected="selected";
                        }
                        if(data.dat!='undefined'){
                            dat="data-dat='"+data.dat+"'";
                        }
                        html += "<option "+dat+" value=\"" + data.id + "\" "+selected+">" + data.nombre + "</option>";
                    });
                }
                $("#"+slct).html(html);
            },
            error: function(){
                Psi.mensaje('danger', '<?php echo trans("greetings.mensaje_error"); ?>', 6000);
            }
        });
    },
    listarSlctFijo2:function(controlador,evento,slct,datos,val){
        $.ajax({
            url         : controlador+'/'+evento,
            type        : 'POST',
            cache       : false,
            dataType    : 'json',
            data        : datos,
            beforeSend : function() {
                //$("body").append('<div class="overlay"></div><div class="loading-img"></div>');
            },
            success : function(obj) {
                var html="";
                var selected="";
                html += "<option value=''>Seleccione</option>";
                if(obj.rst==1){
                    $.each(obj.datos,function(index,data){
                        selected="";
                        dat="";
                        if(typeof(val)!='undefined' && val==data.id){
                            selected="selected";
                        }
                        if(data.dat!='undefined'){
                            dat="data-dat='"+data.dat+"'";
                        }
                        html += "<option "+dat+" value=\"" + data.id + "\" "+selected+">" + data.nombre + "</option>";
                    });
                }
                $("#"+slct).html(html);
            },
            error: function(){
                Psi.mensaje('danger', '<?php echo trans("greetings.mensaje_error"); ?>', 6000);
            }
        });
    }
};
</script>
