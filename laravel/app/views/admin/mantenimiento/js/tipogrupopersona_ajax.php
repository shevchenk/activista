<script type="text/javascript">
var tgrupo_id, menus_selec=[], TgrupoObj;
var Tgrupo={
    AgregarEditarTgrupo:function(AE){
        $("#form_tgrupo input[name='menus_selec']").remove();
        $("#form_tgrupo").append("<input type='hidden' value='"+menus_selec+"' name='menus_selec'>");
        var datos=$("#form_tgrupo").serialize().split("txt_").join("").split("slct_").join("");
        var accion="tgrupo/crear";
        if(AE==1){
            accion="tgrupo/editar";
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
                    $('#t_tgrupo').dataTable().fnDestroy();

                    Tgrupo.CargarTgrupo(activarTabla);
                    $("#msj").html('<div class="alert alert-dismissable alert-success">'+
                                        '<i class="fa fa-check"></i>'+
                                        '<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>'+
                                        '<b>'+obj.msj+'</b>'+
                                    '</div>');
                    $('#tgrupoModal .modal-footer [data-dismiss="modal"]').click();
                }
                else{ 
                    contador=0;
                    $.each(obj.msj,function(index,data){
                        $("#error_"+index).attr("data-original-title",data);
                        $('#error_'+index).css('display','');

                        contador++;
                        if(contador==1){
                            alert(data[0]);
                        }
                    });
                }
            },
            error: function(){
                $(".overlay,.loading-img").remove();
                $("#msj").html('<div class="alert alert-dismissable alert-danger">'+
                                    '<i class="fa fa-ban"></i>'+
                                    '<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>'+
                                    '<b>Ocurrio una interrupción en el proceso,Favor de intentar nuevamente.'+
                                '</div>');
            }
        });
    },
    CargarTgrupo:function(evento){
        $.ajax({
            url         : 'tgrupo/cargar',
            type        : 'POST',
            cache       : false,
            dataType    : 'json',
            beforeSend : function() {
                $("body").append('<div class="overlay"></div><div class="loading-img"></div>');
            },
            success : function(obj) {
                if(obj.rst==1){
                    HTMLCargarTgrupo(obj.datos);
                    TgrupoObj=obj.datos;
                }
                $(".overlay,.loading-img").remove();
            },
            error: function(){
                $(".overlay,.loading-img").remove();
                $("#msj").html('<div class="alert alert-dismissable alert-danger">'+
                                    '<i class="fa fa-ban"></i>'+
                                    '<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>'+
                                    '<b>Ocurrio una interrupción en el proceso,Favor de intentar nuevamente.'+
                                '</div>');
            }
        });
    },
    CambiarEstadoTgrupo:function(id,AD){
        $("#form_tgrupo input[type='hidden']").remove();
        $("#form_tgrupo").append("<input type='hidden' value='"+id+"' name='id'>");
        $("#form_tgrupo").append("<input type='hidden' value='"+AD+"' name='estado'>");
        var datos=$("#form_tgrupo").serialize().split("txt_").join("").split("slct_").join("");
        $.ajax({
            url         : 'tgrupo/cambiarestado',
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
                    $('#t_tgrupo').dataTable().fnDestroy();
                    Tgrupo.CargarTgrupo(activarTabla);
                    $("#msj").html('<div class="alert alert-dismissable alert-info">'+
                                        '<i class="fa fa-info"></i>'+
                                        '<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>'+
                                        '<b>'+obj.msj+'</b>'+
                                    '</div>');
                    $('#tgrupoModal .modal-footer [data-dismiss="modal"]').click();
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
                $("#msj").html('<div class="alert alert-dismissable alert-danger">'+
                                    '<i class="fa fa-ban"></i>'+
                                    '<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>'+
                                    '<b>Ocurrio una interrupción en el proceso,Favor de intentar nuevamente.'+
                                '</div>');
            }
        });
    }
};
</script>
