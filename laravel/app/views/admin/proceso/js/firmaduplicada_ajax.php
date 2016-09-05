<script type="text/javascript">
var Consulta, ConsultaDetalle, ConsultaDetalle2;
var Accion={
    Consolidado:function( data,evento ){
        $.ajax({
            url         : 'firma/consolidado',
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
                    evento(obj);
                }
            },
            error: function(){
                $(".overlay,.loading-img").remove();
                msjG.mensaje('danger','<b>Ocurrio una interrupción en el proceso,Favor de intentar nuevamente.',6000);
            }
        });
    }
};
</script>
