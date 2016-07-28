<script type="text/javascript">
var ValidarFicha={
    GuardarFichas:function(data,evento){
        $.ajax({
            url         : 'ficha/validarficha',
            type        : 'POST',
            cache       : false,
            dataType    : 'json',
            data        : data,
            beforeSend : function() {
                $("body").append('<div class="overlay"></div><div class="loading-img"></div>');
            },
            success : function(obj) {
                $(".overlay,.loading-img").remove();
                if(obj.rst==1){
                    evento();
                    msjG.mensaje('success',obj.msj,4000);
                }
                    $("#t_mensaje_final>tbody>tr:eq(0)>td:eq(0)").text('');
                    $("#t_mensaje_final>tbody>tr:eq(0)>td:eq(1)").text('');
                    if(obj.estado.length>0){
                    $("#t_mensaje_final>tbody>tr:eq(0)>td:eq(0)").text(obj.estado[0].buenas);
                    $("#t_mensaje_final>tbody>tr:eq(0)>td:eq(1)").text(obj.estado[0].malas);
                    }
            },
            error: function(){
                $(".overlay,.loading-img").remove();
                msjG.mensaje('danger','<b>Ocurrio una interrupción en el proceso,Favor de intentar nuevamente.',4000);
            }
        });
    },
    BuscarDNI:function(data,evento){
        $.ajax({
            url         : 'ficha/buscardni',
            type        : 'POST',
            cache       : false,
            dataType    : 'json',
            data        : data,
            beforeSend : function() {
                $("body").append('<div class="overlay"></div><div class="loading-img"></div>');
            },
            success : function(obj) {
                $(".overlay,.loading-img").remove();
                if(obj.rst==1){
                    evento(obj.data);
                }
                if(obj.rst==2){
                    evento(obj.data);
                    $("#t_mensaje_final>tbody>tr:eq(0)>td:eq(0)").text('');
                    $("#t_mensaje_final>tbody>tr:eq(0)>td:eq(1)").text('');
                    if(obj.estado.length>0){
                    $("#t_mensaje_final>tbody>tr:eq(0)>td:eq(0)").text(obj.estado[0].buenas);
                    $("#t_mensaje_final>tbody>tr:eq(0)>td:eq(1)").text(obj.estado[0].malas);
                    }
                    msjG.mensaje('warning',obj.msj,4000);
                }
            },
            error: function(){
                $(".overlay,.loading-img").remove();
                msjG.mensaje('danger','<b>Ocurrio una interrupción en el proceso,Favor de intentar nuevamente.',4000);
            }
        });
    },
    BuscarFicha:function(data,evento){
        $.ajax({
            url         : 'ficha/buscarficha',
            type        : 'POST',
            cache       : false,
            dataType    : 'json',
            data        : data,
            beforeSend : function() {
                $("body").append('<div class="overlay"></div><div class="loading-img"></div>');
            },
            success : function(obj) {
                $(".overlay,.loading-img").remove();
                    evento(obj);
            },
            error: function(){
                $(".overlay,.loading-img").remove();
                msjG.mensaje('danger','<b>Ocurrio una interrupción en el proceso,Favor de intentar nuevamente.',4000);
            }
        });
    },
};
</script>
