<script type="text/javascript">
var grupo_id, menus_selec=[], GrupoObj;
var Grupo={
    AgregarEditarGrupo:function(AE){
        $("#form_grupo input[name='menus_selec']").remove();
        $("#form_grupo").append("<input type='hidden' value='"+menus_selec+"' name='menus_selec'>");
        var datos=$("#form_grupo").serialize().split("txt_").join("").split("slct_").join("");
        var accion="grupop/crear";
        if(AE==1){
            accion="grupop/editar";
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
                    $('#t_grupo').dataTable().fnDestroy();

                    Grupo.CargarGrupo(activarTabla);
                    $("#msj").html('<div class="alert alert-dismissable alert-success">'+
                                        '<i class="fa fa-check"></i>'+
                                        '<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>'+
                                        '<b>'+obj.msj+'</b>'+
                                    '</div>');
                    $('#grupoModal .modal-footer [data-dismiss="modal"]').click();
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
    CargarGrupo:function(evento){
        $.ajax({
            url         : 'grupop/cargar',
            type        : 'POST',
            cache       : false,
            dataType    : 'json',
            beforeSend : function() {
                $("body").append('<div class="overlay"></div><div class="loading-img"></div>');
            },
            success : function(obj) {
                if(obj.rst==1){
                    HTMLCargarGrupo(obj.datos);
                    GrupoObj=obj.datos;
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
    CambiarEstadoGrupo:function(id,AD){
        $("#form_grupo input[type='hidden']").remove();
        $("#form_grupo").append("<input type='hidden' value='"+id+"' name='id'>");
        $("#form_grupo").append("<input type='hidden' value='"+AD+"' name='estado'>");
        var datos=$("#form_grupo").serialize().split("txt_").join("").split("slct_").join("");
        $.ajax({
            url         : 'grupop/cambiarestado',
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
                    $('#t_grupo').dataTable().fnDestroy();
                    Grupo.CargarGrupo(activarTabla);
                    $("#msj").html('<div class="alert alert-dismissable alert-info">'+
                                        '<i class="fa fa-info"></i>'+
                                        '<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>'+
                                        '<b>'+obj.msj+'</b>'+
                                    '</div>');
                    $('#grupoModal .modal-footer [data-dismiss="modal"]').click();
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
