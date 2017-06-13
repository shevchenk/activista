<script type="text/javascript">
$(document).ready(function() {
    $('#valida').click(Exportar.Exportar);
});

var Exportar={
    Exportar:function(  ){
        $.ajax({
            url         : 'firma/exportar',
            type        : 'POST',
            cache       : false,
            dataType    : 'json',
            beforeSend : function() {
                $("body").append('<div class="overlay"></div><div class="loading-img"></div>');
            },
            success : function(obj) {
                $(".overlay,.loading-img").remove();
                if(obj.rst==1){
                    msjG.mensaje('success',obj.msj,4000);
                }
                else if(obj.rst==2){
                    msjG.mensaje('warning',obj.msj,3000);
                }
            },
            error: function(){
                $(".overlay,.loading-img").remove();
                msjG.mensaje('danger','<b>Ocurrio una interrupción en el proceso,Favor de intentar nuevamente.',4000);
            }
        });
    }
};
</script>
