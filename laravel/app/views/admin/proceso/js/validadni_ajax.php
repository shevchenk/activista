<script type="text/javascript">
var Accion={
    ValidaDNI:function( data ){
        $.ajax({
            url         : 'firma/validadni',
            type        : 'POST',
            cache       : false,
            dataType    : 'json',
            data        : data,
            beforeSend : function() {
                $("body").append('<div class="overlay"></div><div class="loading-img"></div>');
            },
            success : function(obj) {
                $(".overlay,.loading-img").remove();
                    alert(obj.msj.split("^^")[0].split("|").join("\n"));
                    if(obj.msj.split("^^")[1]==1){
                        if( confirm("Desea Reservar el DNI ingresado?") ){
                            Accion.ReservaDNI(data);
                        }
                    }
            },
            error: function(){
                $(".overlay,.loading-img").remove();
                msjG.mensaje('danger','<b>Ocurrio una interrupción en el proceso,Favor de intentar nuevamente.',4000);
            }
        });
    },
    ValidaDNI:function( data ){
        $.ajax({
            url         : 'firma/reservadni',
            type        : 'POST',
            cache       : false,
            dataType    : 'json',
            data        : data,
            beforeSend : function() {
                $("body").append('<div class="overlay"></div><div class="loading-img"></div>');
            },
            success : function(obj) {
                $(".overlay,.loading-img").remove();
                    alert(obj.msj);
            },
            error: function(){
                $(".overlay,.loading-img").remove();
                msjG.mensaje('danger','<b>Ocurrio una interrupción en el proceso,Favor de intentar nuevamente.',4000);
            }
        });
    }
};
</script>
